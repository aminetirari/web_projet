<?php
require_once __DIR__ . '/../Controller/BookController.php';
header('Content-Type: application/json');

$controller = new BookController();
$books = $controller->listBooks();

$data = [];
foreach ($books as $book) {
    $data[] = [
        'id' => $book->getId(),
        'title' => $book->getTitle(),
        'author' => $book->getAuthor(),
        'category' => $book->getCategory(),
        'copies' => $book->getCopies(),
        'status' => $book->getStatus()
    ];
}
echo json_encode($data);
?>