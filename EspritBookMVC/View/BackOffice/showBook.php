<?php
/**
 * Show Books - List all books in the database
 * Displays books in a table with edit/delete actions
 */

require_once __DIR__ . '/../../Controller/BookController.php';

$controller = new BookController();
$books = $controller->listBooks();
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des Livres | EspritBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; }
        .container { max-width: 1200px; margin-top: 40px; }
        .btn-group { margin-bottom: 20px; }
        .table { background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Gestion des Livres</h1>

        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✓ Opération réussie (<?php echo htmlspecialchars($successMessage); ?>)
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ✗ Erreur : <?php echo htmlspecialchars($errorMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="btn-group mb-3">
            <a href="addBook.php" class="btn btn-primary">+ Ajouter un Livre</a>
            <a href="../../FrontOffice/index.html" class="btn btn-secondary">← Bibliothèque</a>
        </div>

        <?php if (empty($books)): ?>
            <div class="alert alert-info">Aucun livre trouvé. <a href="addBook.php">Ajouter un livre</a></div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Catégorie</th>
                            <th>Exemplaires</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($book['id']); ?></td>
                                <td><?php echo htmlspecialchars($book['title']); ?></td>
                                <td><?php echo htmlspecialchars($book['author']); ?></td>
                                <td><?php echo htmlspecialchars($book['category']); ?></td>
                                <td><?php echo htmlspecialchars($book['copies']); ?></td>
                                <td>
                                    <span class="badge <?php echo ($book['status'] === 'Disponible') ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo htmlspecialchars($book['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="update_book.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="Verification.php?delete_id=<?php echo $book['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>