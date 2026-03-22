<?php
require_once __DIR__ . '/../Controller/BookController.php';

if (isset($_GET['id'])) {
    $controller = new BookController();
    $controller->deleteBook($_GET['id']);
}
header('Location: index.html?success=deleted');
exit;
?>