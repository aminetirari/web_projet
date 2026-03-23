<?php
/**
 * Update Book Form
 * Displays a form to edit an existing book
 * The form is submitted to Verification.php
 */

require_once __DIR__ . '/../../Controller/BookController.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: showBook.php?error=invalid_id');
    exit;
}

$controller = new BookController();
$book = $controller->getBookById($id);

if (!$book) {
    header('Location: showBook.php?error=book_not_found');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Livre | EspritBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; }
        .form-container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Modifier le Livre</h2>
        
        <form method="POST" action="Verification.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
            
            <div class="mb-3">
                <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" required value="<?php echo htmlspecialchars($book['title']); ?>">
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Auteur <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="author" name="author" required value="<?php echo htmlspecialchars($book['author']); ?>">
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie <span class="text-danger">*</span></label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <option value="Science" <?php echo $book['category'] === 'Science' ? 'selected' : ''; ?>>Science</option>
                    <option value="Literature" <?php echo $book['category'] === 'Literature' ? 'selected' : ''; ?>>Littérature</option>
                    <option value="Technology" <?php echo $book['category'] === 'Technology' ? 'selected' : ''; ?>>Technologie</option>
                    <option value="History" <?php echo $book['category'] === 'History' ? 'selected' : ''; ?>>Histoire</option>
                    <option value="Arts" <?php echo $book['category'] === 'Arts' ? 'selected' : ''; ?>>Arts</option>
                    <option value="Other" <?php echo $book['category'] === 'Other' ? 'selected' : ''; ?>>Autre</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="copies" class="form-label">Nombre d'exemplaires <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="copies" name="copies" min="1" required value="<?php echo htmlspecialchars($book['copies']); ?>">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Disponible" <?php echo $book['status'] === 'Disponible' ? 'selected' : ''; ?>>Disponible</option>
                    <option value="Indisponible" <?php echo $book['status'] === 'Indisponible' ? 'selected' : ''; ?>>Indisponible</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">Mettre à jour</button>
                <a href="showBook.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>