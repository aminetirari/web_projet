<?php
require_once __DIR__ . '/../Controller/BookController.php';
$controller = new BookController();

// Gestion de la suppression (voir point 3.3)
if (isset($_GET['delete_id'])) {
    $controller->deleteBook($_GET['delete_id']);
    header('Location: listBooks.php');
    exit;
}

$books = $controller->listBooks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des livres - BackOffice</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="container mt-5">
    <h2>Gestion des livres</h2>
    <a href="addBook.php" class="btn btn-primary mb-3">Ajouter un livre</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Date</th><th>Langue</th><th>Statut</th><th>Exemplaires</th><th>Catégorie</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
         <tr>
             <td><?= $book->getId() ?></td>
             <td><?= htmlspecialchars($book->getTitle()) ?></td>
             <td><?= htmlspecialchars($book->getAuthor()) ?></td>
             <td><?= $book->getPublicationDate() ?></td>
             <td><?= $book->getLanguage() == 'AN' ? 'Anglais' : 'Français' ?></td>
             <td><?= $book->getStatus() ?></td>
             <td><?= $book->getCopies() ?></td>
             <td><?= $book->getCategory() ?></td>
             <td>
                 <a href="updateBook.php?id=<?= $book->getId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                 <a href="?delete_id=<?= $book->getId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce livre ?')">Supprimer</a>
             </td>
         </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>