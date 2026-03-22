<?php
require_once __DIR__ . '/../Controller/BookController.php';
require_once __DIR__ . '/../Model/Book.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $pub_date = $_POST['publication_date'];
    $language = $_POST['language'];
    $status = $_POST['status'];
    $copies = (int)$_POST['number_of_copies'];
    $category = $_POST['category'];

    // Validation
    $errors = [];
    if (strlen($title) < 3) $errors[] = "Le titre doit contenir au moins 3 caractères.";
    if (!preg_match('/^[A-Za-z\s]{3,}$/', $author)) $errors[] = "Auteur : lettres et espaces (min 3).";
    if (empty($pub_date)) $errors[] = "Date de publication obligatoire.";
    if (!in_array($language, ['AN','FR'])) $errors[] = "Langue invalide.";
    if (!in_array($status, ['Disponible','Indisponible'])) $errors[] = "Statut invalide.";
    if ($copies < 1) $errors[] = "Nombre d'exemplaires ≥ 1.";
    if (empty($category)) $errors[] = "Catégorie obligatoire.";

    if (empty($errors)) {
        $book = new Book(null, $title, $author, $pub_date, $language, $status, $copies, $category);
        $controller = new BookController();
        $controller->addBook($book);
        header('Location: index.html?success=added');
        exit;
    } else {
        // En cas d'erreur, on peut rediriger avec un message
        header('Location: addBook.html?error=' . urlencode(implode(', ', $errors)));
        exit;
    }
} else {
    header('Location: addBook.html');
    exit;
}
?>