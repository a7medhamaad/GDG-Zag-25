<?php
class User
{
    private $pdo;
    public $id;
    public $name;
    public $email;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        if (isset($_SESSION['user_id'])) {
            $this->id = $_SESSION['user_id'];
        } else {
            $this->id = null;
        }
    }

    public function register($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $hashedPassword]);
    }

    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            return true;
        }
        return false;
    }
    public function getBorrowedBooks($userId)
    {
        $stmt = $this->pdo->prepare("
            SELECT books.id, books.title, books.author 
            FROM books 
            JOIN borrowed_books ON books.id = borrowed_books.book_id 
            WHERE borrowed_books.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getUserById($userId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, email FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching user: " . $e->getMessage());
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: ../views/login.php");
    }

    public function returnBook($userId, $bookId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id FROM borrowed_books WHERE book_id = ? AND user_id = ?");
            $stmt->execute([$bookId, $userId]);

            if (!$stmt->fetch()) {
                return "You can only return books you have borrowed.";
            }
            $stmt = $this->pdo->prepare("DELETE FROM borrowed_books WHERE book_id = ? AND user_id = ?");
            $stmt->execute([$bookId, $userId]);

            $stmt = $this->pdo->prepare("UPDATE books SET isAvailable = 1 WHERE id = ?");
            $stmt->execute([$bookId]);

            return "Book returned successfully.";
        } catch (PDOException $e) {
            die("Error returning book: " . $e->getMessage());
        }
    }

    public function borrowBook($userId, $bookId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id FROM borrowed_books WHERE book_id = ?");
            $stmt->execute([$bookId]);
            if ($stmt->fetch()) {
                return "This book is already borrowed.";
            }

            $stmt = $this->pdo->prepare("INSERT INTO borrowed_books (user_id, book_id) VALUES (?, ?)");
            $stmt->execute([$userId, $bookId]);
            $stmt = $this->pdo->prepare("UPDATE books SET isAvailable = 0 WHERE id = ?");
            $stmt->execute([$bookId]);

            return "Book borrowed successfully.";
        } catch (PDOException $e) {
            die("Error borrowing book: " . $e->getMessage());
        }
    }
}
