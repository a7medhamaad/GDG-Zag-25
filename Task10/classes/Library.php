<?php
require_once '../config/database.php';

class Library
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addBook($title, $author)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO books (title, author, isAvailable, borrowed_by) VALUES (?, ?, TRUE, NULL)");
            return $stmt->execute([$title, $author]);
        } catch (PDOException $e) {
            die("Error adding book: " . $e->getMessage());
        }
    }

    public function removeBook($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Error removing book: " . $e->getMessage());
        }
    }

    public function listBooks()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM books");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error listing books: " . $e->getMessage());
        }
    }

    public function listAvailableBooks()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM books WHERE isAvailable = TRUE");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error listing available books: " . $e->getMessage());
        }
    }

    public function listUserBorrowedBooks($userId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM books WHERE borrowed_by = ?");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error listing user borrowed books: " . $e->getMessage());
        }
    }

    public function findBook($keyword)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ?");
            $stmt->execute(["%$keyword%", "%$keyword%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error searching books: " . $e->getMessage());
        }
    }
}
