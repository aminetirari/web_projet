<?php
/**
 * Delete Book Handler
 * Receives delete_id via GET parameter and deletes the book
 * Then redirects back to showBook.php
 */

require_once __DIR__ . '/../../Controller/BookController.php';

if (isset($_GET['id'])) {
    $controller = new BookController();
    $success = $controller->deleteBook((int)$_GET['id']);
    
    if ($success) {
        header('Location: showBook.php?success=deleted');
    } else {
        header('Location: showBook.php?error=delete_failed');
    }
} else {
    header('Location: showBook.php');
}
exit;
?>