<?php
// This file displays the form for adding a new book
// The form is submitted to Verification.php which handles the CRUD operation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre | EspritBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; }
        .form-container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Ajouter un Nouveau Livre</h2>
        
        <form method="POST" action="Verification.php">
            <div class="mb-3">
                <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="Entrez le titre">
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Auteur <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="author" name="author" required placeholder="Entrez le nom de l'auteur">
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie <span class="text-danger">*</span></label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <option value="Science">Science</option>
                    <option value="Literature">Littérature</option>
                    <option value="Technology">Technologie</option>
                    <option value="History">Histoire</option>
                    <option value="Arts">Arts</option>
                    <option value="Other">Autre</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="copies" class="form-label">Nombre d'exemplaires <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="copies" name="copies" min="1" required placeholder="Entrez le nombre d'exemplaires" value="1">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">-- Sélectionnez le statut --</option>
                    <option value="Disponible" selected>Disponible</option>
                    <option value="Indisponible">Indisponible</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Ajouter le Livre</button>
                <a href="showBook.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>