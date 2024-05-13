<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin'])) {
    // L'administrateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: admin-login.php');
    exit();
}

// Vérifier si le formulaire d'ajout de produit a été soumis
if (isset($_POST['ajouter_produit'])) {
    // Récupérer les données du formulaire
    $nom_produit = $_POST['nom_produit'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $type = $_POST['type'];

    // Vérifier si un fichier d'image a été envoyé
    if (isset($_FILES['photo'])) {
        $photo = $_FILES['photo'];

        // Déplacer le fichier vers le dossier d'images
        $target_file = basename($photo['name']);
        move_uploaded_file($photo['tmp_name'], $target_file);

        // Enregistrer le produit dans la base de données
        try {
            $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'Rout02192016*');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO product (nom_produit, prix, description, photo, category, type) VALUES (:nom_produit, :prix, :description, :photo, :category, :type)";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':nom_produit', $nom_produit);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':photo', $target_file);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':type', $type);
            $stmt->execute();

            // Rediriger vers la page de succès ou une autre page d'administration
            header('Location: admin_success.php');
            exit();
        } catch (PDOException $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php
    include 'nav_admin.php';
?>

<h1 style="padding-top: 20px;">admin : <?php echo $_SESSION['admin']; ?></h1>

<h2 style="color: #ff7831; font-size: 30px; text-align: center; margin: 20px;">Ajouter un produit</h2>


<form action="admin.php" method="POST" enctype="multipart/form-data">
    <label for="nom_produit">Nom du produit:</label>
    <input type="text" id="nom_produit" name="nom_produit" required><br>

    <label for="prix">Prix:</label>
    <input type="number" id="prix" name="prix" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="category">Catégorie:</label>
    <select id="category" name="category" required>
        <option value="adultes">Adultes</option>
        <option value="enfants">Enfants</option>
    </select><br>

    <label for="type">Type de produit:</label>
    <select id="type" name="type" required>
        <option value="ballon">Ballon</option>
        <option value="tenue">Tenue</option>
        <option value="gant">Gant</option>
        <option value="chaussure">Chaussure</option>
        <option value="sac">Sac</option>
        <option value="protege">Protège</option>
        <option value="autre">Autre</option>
    </select><br>

    <label for="photo">Photo:</label>
    <input type="file" id="photo" name="photo" required><br>

    <input type="submit" name="ajouter_produit" value="Ajouter le produit">
</form>

<script>
    let menu = document.querySelector('#menu-btn');
    let navbar = document.querySelector('.header .navbar');

    menu.onclick = () => {
        menu.classList.toggle('fa-times');
        navbar.classList.toggle('active');
    };

    window.onscroll = () => {
        menu.classList.remove('fa-times');
        navbar.classList.remove('active');
    };
</script>



</body>
</html>
