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

// Vérifier si l'ID du produit à supprimer est spécifié dans l'URL
if (isset($_GET['id'])) {
    $produitId = $_GET['id'];

    // Supprimer le produit de la base de données
    try {
        $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'Rout02192016*');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "DELETE FROM product WHERE id_product = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $produitId);
        $stmt->execute();

        // Rediriger vers la page de succès ou une autre page d'administration
        header('Location: admin_success.php');
        exit();
    } catch (PDOException $e) {
        echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }
}

// Récupérer tous les produits de la base de données
try {
    $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'Rout02192016*');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM product";
    $stmt = $connection->query($query);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ajouter le chemin d'accès relatif à la colonne 'photo'
    foreach ($products as &$product) {
        $product['photo'] = 'img/' . $product['photo'];
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer les produits</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php
            include 'nav_admin.php';
        ?>
<h1 style=" padding-top: 20px; " >admin :  <?php echo $_SESSION['admin']; ?> </h1>

<h2 style="color: #ff7831; font-size: 30px; text-align: center; margin: 20px;">gestion des produits</h2>
    <table>
        <tr>
            <th>Photo</th>
            <th>Nom du produit</th>
            <th>Prix</th>
            <th>Description</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><img src="<?php echo $product['photo']; ?>" width="100"></td>
                <td><?php echo $product['nom_produit']; ?></td>
                <td><?php echo $product['prix']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo $product['category']; ?></td>
                <td>
                    <a href="gestion_produit.php?id=<?php echo $product['id_product']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                        <button  ><i class="fa-solid fa-trash"></i></button>
                    </a>
                    <a href="modifier.php?id=<?php echo $product['id_product']; ?>">
                        <button style="background-color: green;" ><i class="fa-solid fa-pen-to-square"></i></button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<script >
    let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');



menu.onclick = ()  => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};


window.onscroll = ()  => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

</script>
