<?php

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/Book.php';

class BookController {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }

    /**
     * Retrieve and return the list of all books from the Book table
     * @return array
     */
    public function listBooks() {
        try {
            $sql = "SELECT * FROM Book ORDER BY id DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $books = $stmt->fetchAll();
            return $books;
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des livres: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve a single book by its ID
     * @param int $id
     * @return array|null
     */
    public function getBookById($id) {
        try {
            $sql = "SELECT * FROM Book WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $book = $stmt->fetch();
            return $book;
        } catch (PDOException $e) {
            die('Erreur lors de la récupération du livre: ' . $e->getMessage());
        }
    }

    /**
     * Delete a book from the database by its ID
     * @param int $id
     * @return bool
     */
    public function deleteBook($id) {
        try {
            $sql = "DELETE FROM Book WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([':id' => $id]);
            return $result;
        } catch (PDOException $e) {
            die('Erreur lors de la suppression du livre: ' . $e->getMessage());
        }
    }

    /**
     * Insert/save a book object into the database
     * @param Book $book
     * @return bool
     */
    public function addBook($book) {
        try {
            $sql = "INSERT INTO Book (title, author, category, copies, status) 
                    VALUES (:title, :author, :category, :copies, :status)";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([
                ':title' => $book->getTitle(),
                ':author' => $book->getAuthor(),
                ':category' => $book->getCategory(),
                ':copies' => $book->getCopies(),
                ':status' => $book->getStatus()
            ]);
            return $result;
        } catch (PDOException $e) {
            die('Erreur lors de l\'ajout du livre: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing book's information in the database
     * @param Book $book
     * @return bool
     */
    public function updateBook($book) {
        try {
            $sql = "UPDATE Book SET title = :title, author = :author, category = :category, 
                    copies = :copies, status = :status WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([
                ':id' => $book->getId(),
                ':title' => $book->getTitle(),
                ':author' => $book->getAuthor(),
                ':category' => $book->getCategory(),
                ':copies' => $book->getCopies(),
                ':status' => $book->getStatus()
            ]);
            return $result;
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour du livre: ' . $e->getMessage());
        }
    }

    /**
     * Display book information using the Book's show() method
     * @param Book $book
     * @return void
     */
    public function showBook($book) {
        echo "<h3>Informations du livre :</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Catégorie</th><th>Exemplaires</th><th>Statut</th></tr>";
        echo $book->show();
        echo "</table>";
        echo "<h4>var_dump() du livre :</h4>";
        var_dump($book);
    }
}
?>
