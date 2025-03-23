<?php
class Book {
    private $pdo;
    public $id;
    public $title;
    public $author;
    public $isAvailable;

    public function __construct($pdo, $id = null, $title = null, $author = null, $isAvailable = true) {
        $this->pdo = $pdo;
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = $isAvailable;
    }

    public function addBook($title, $author,$added_by) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO books (title, author,added_by, isAvailable) VALUES (?, ?,?, 1)");
            return $stmt->execute([$title, $author,$added_by]);
        } catch (PDOException $e) {
            die("Error adding book: " . $e->getMessage());
        }
    }

    public function removeBook($id) {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getBookDetails($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function markAsBorrowed() {
        $stmt = $this->pdo->prepare("UPDATE books SET isAvailable = FALSE WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
    
    public function markAsReturned() {
        $stmt = $this->pdo->prepare("UPDATE books SET isAvailable = TRUE WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}
?>
