<?php
/**
 * Verification.php
 * Handles form submissions for book operations (add, update, delete)
 * Receives POST data from addBook.php or update_book.php
 * Receives GET delete_id from showBook.php
 */

require_once __DIR__ . '/../../Controller/BookController.php';
require_once __DIR__ . '/../../Model/Book.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle ADD or UPDATE operations
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $author = isset($_POST['author']) ? trim($_POST['author']) : '';
    $category = isset($_POST['category']) ? trim($_POST['category']) : '';
    $copies = isset($_POST['copies']) ? (int)$_POST['copies'] : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : 'Disponible';

    // Validation
    if (empty($title) || empty($author) || empty($category) || $copies <= 0) {
        header('Location: addBook.php?error=invalid_input');
        exit;
    }

    // Create Book object
    $book = new Book($title, $author, $category, $copies, $status);

    // Check if this is an update (has hidden id field)
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // UPDATE existing book
        $book->setId((int)$_POST['id']);
        $controller = new BookController();
        $success = $controller->updateBook($book);
        if ($success) {
            header('Location: showBook.php?success=updated');
        } else {
            header('Location: update_book.php?id=' . $_POST['id'] . '&error=update_failed');
        }
    } else {
        // ADD new book
        $controller = new BookController();
        $success = $controller->addBook($book);
        if ($success) {
            header('Location: showBook.php?success=added');
        } else {
            header('Location: addBook.php?error=add_failed');
        }
    }
    exit;
} elseif (isset($_GET['delete_id'])) {
    // Handle DELETE operation
    $controller = new BookController();
    $success = $controller->deleteBook((int)$_GET['delete_id']);
    if ($success) {
        header('Location: showBook.php?success=deleted');
    } else {
        header('Location: showBook.php?error=delete_failed');
    }
    exit;
} else {
    // Invalid request
    header('Location: showBook.php');
    exit;
}
?>
