<?php
require_once __DIR__ . '/../Controller/BookController.php';
$controller = new BookController();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$book = $controller->getBookById($id);
if (!$book) {
    die('Livre introuvable.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book->setTitle($_POST['title']);
    $book->setAuthor($_POST['author']);
    $book->setPublicationDate($_POST['publication_date']);
    $book->setLanguage($_POST['language']);
    $book->setStatus($_POST['status']);
    $book->setCopies((int)$_POST['number_of_copies']);
    $book->setCategory($_POST['category']);
    $controller->updateBook($book);
    header('Location: index.html?success=updated');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier un livre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier le livre</h2>
    <form method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Auteur</label>
            <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($book->getAuthor()) ?>" required>
        </div>
        <div class="mb-3">
            <label for="publication_date" class="form-label">Date de publication</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" value="<?= $book->getPublicationDate() ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Langue</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="language" value="AN" <?= $book->getLanguage() == 'AN' ? 'checked' : '' ?> required>
                <label class="form-check-label">AN</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="language" value="FR" <?= $book->getLanguage() == 'FR' ? 'checked' : '' ?> required>
                <label class="form-check-label">FR</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-select" id="status" name="status" required>
                <option value="Disponible" <?= $book->getStatus() == 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                <option value="Indisponible" <?= $book->getStatus() == 'Indisponible' ? 'selected' : '' ?>>Indisponible</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="number_of_copies" class="form-label">Nombre d'exemplaires</label>
            <input type="number" class="form-control" id="number_of_copies" name="number_of_copies" min="1" value="<?= $book->getCopies() ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <select class="form-select" id="category" name="category" required>
                <option value="Science" <?= $book->getCategory() == 'Science' ? 'selected' : '' ?>>Science</option>
                <option value="Literature" <?= $book->getCategory() == 'Literature' ? 'selected' : '' ?>>Literature</option>
                <option value="Technology" <?= $book->getCategory() == 'Technology' ? 'selected' : '' ?>>Technology</option>
                <option value="History" <?= $book->getCategory() == 'History' ? 'selected' : '' ?>>History</option>
                <option value="Arts" <?= $book->getCategory() == 'Arts' ? 'selected' : '' ?>>Arts</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="index.html" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>