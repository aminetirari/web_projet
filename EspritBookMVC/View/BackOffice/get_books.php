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
        'publication_date' => $book->getPublicationDate(),
        'language' => $book->getLanguage(),
        'status' => $book->getStatus(),
        'copies' => $book->getCopies(),
        'category' => $book->getCategory()
    ];
}
echo json_encode($data);
?>