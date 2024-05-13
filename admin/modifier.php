<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin'])) {
    // L'administrateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: register.php');
    exit();
}

// Vérifier si l'ID du produit à modifier est spécifié dans l'URL
if (isset($_GET['id'])) {
    $produitId = $_GET['id'];

    // Récupérer les détails du produit à modifier
    try {
        $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'Rout02192016*');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM product WHERE id_product = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $produitId);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        exit();
    }

    // Vérifier si le formulaire de modification est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $nomProduit = $_POST['nom_produit'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        // Effectuer la mise à jour du produit dans la base de données
        try {
            $query = "UPDATE product SET nom_produit = :nom, prix = :prix, description = :description, category = :category WHERE id_product = :id";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':nom', $nomProduit);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':id', $produitId);
            $stmt->execute();

            // Rediriger vers la page de succès ou une autre page d'administration
            header('Location: admin_success.php');
            exit();
        } catch (PDOException $e) {
            echo 'Erreur de mise à jour du produit : ' . $e->getMessage();
        }
    }
} else {
    // L'ID du produit n'est pas spécifié, rediriger vers la page de gestion des produits
    header('Location: gestion_produits.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="stylenav.css">
</head>
<body>

<?php
            include 'nav_admin.php';
        ?>
   <h1 style=" padding-top: 20px; " >admin :  <?php echo $_SESSION['admin']; ?> </h1>

<h2 style="color: #ff7831; font-size: 30px; text-align: center; margin: 20px;">Liste des commandes</h2>

    <form method="POST">
    <label for="nom_produit">Nom du produit:</label>
    <input type="text" id="nom_produit" name="nom_produit" value="<?php echo $product['nom_produit']; ?>" required><br>

    <label for="prix">Prix:</label>
    <input type="number" id="prix" name="prix" value="<?php echo $product['prix']; ?>" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea><br>

    <label for="category">Catégorie:</label>
    <select id="category" name="category" required>
        <option value="adultes" <?php if ($product['category'] === 'adultes') echo 'selected'; ?>>Adultes</option>
        <option value="enfants" <?php if ($product['category'] === 'enfants') echo 'selected'; ?>>Enfants</option>
    </select><br>

    <button type="submit">Modifier</button>

    
</form>

</body>
</html>
