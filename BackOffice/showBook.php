<?php
// Inclusion des classes nécessaires
require_once __DIR__ . '/../Controller/BookController.php';
require_once __DIR__ . '/../Model/Book.php';

// ========== Partie 2.1 ==========
echo "<h2>Partie 2.1 : Création d'un livre manuellement</h2>";
$book1 = new Book(1, 'Simple Way Of Life', 'Armor Ramsey', '2025-04-01', 'AN', 'Disponible', 5, 'Literature');

// Affichage avec var_dump()
echo "<h3>var_dump() du livre :</h3>";
var_dump($book1);

// Affichage avec la méthode show()
echo "<h3>Affichage avec show() :</h3>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Date</th><th>Langue</th><th>Statut</th><th>Exemplaires</th><th>Catégorie</th></tr>";
echo $book1->show();
echo "</table>";

// ========== Partie 2.2 ==========
echo "<h2>Partie 2.2 : Création d'un livre à partir d'un formulaire</h2>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $book2 = new Book(
        null,
        $_POST['title'],
        $_POST['author'],
        $_POST['pub_date'],
        $_POST['language'],
        $_POST['status'],
        (int)$_POST['copies'],
        $_POST['category']
    );

    // Utilisation du contrôleur pour afficher
    $controller = new BookController();
    $controller->showBook($book2);
} else {
    // Affichage du formulaire de saisie
    ?>
    <form method="post">
        <label>Titre :</label> <input type="text" name="title" required><br>
        <label>Auteur :</label> <input type="text" name="author" required><br>
        <label>Date de publication :</label> <input type="date" name="pub_date" required><br>
        <label>Langue :</label>
        <select name="language">
            <option value="AN">AN</option>
            <option value="FR">FR</option>
        </select><br>
        <label>Statut :</label>
        <select name="status">
            <option value="Disponible">Disponible</option>
            <option value="Indisponible">Indisponible</option>
        </select><br>
        <label>Nombre d'exemplaires :</label> <input type="number" name="copies" min="1" value="1"><br>
        <label>Catégorie :</label>
        <select name="category">
            <option value="Science">Science</option>
            <option value="Literature">Literature</option>
            <option value="Technology">Technology</option>
            <option value="History">History</option>
            <option value="Arts">Arts</option>
        </select><br>
        <button type="submit">Afficher le livre</button>
    </form>
    <?php
}
?>