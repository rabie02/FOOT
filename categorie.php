<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si la session est active
if (!isset($_SESSION['firstname'])) {
    // La session n'est pas active, rediriger vers la page de connexion
    header('Location: register.php');
    exit();
}
$panierCount = 0;
if (isset($_SESSION['panier'])) {
    $panierCount = count($_SESSION['panier']);
}


require_once('connexion.php');

// Vérifier si le formulaire d'ajout au panier a été soumis
if (isset($_POST['ajouter']) && isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Vérifier si le panier existe dans la session, sinon le créer
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Vérifier si le produit est déjà dans le panier
    if (array_key_exists($productId, $_SESSION['panier'])) {
        // Le produit existe déjà dans le panier, augmenter la quantité
        $_SESSION['panier'][$productId]++;
    } else {
        // Le produit n'est pas encore dans le panier, l'ajouter avec une quantité de 1
        $_SESSION['panier'][$productId] = 1;
    }

    // Rediriger vers la page panier.php après avoir ajouté le produit
    header('Location: products.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="card.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- swipper css link -->
    
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Document</title>
</head>
<body>
    <div>
        <?php include 'navbar.php'; ?>
        <a href="panier.php" class="cart-button">
        <span class="cart-count" style="font-size: 15px; color: #ff7831; font-size: 15px;  position: absolute; top: -5px; right: 4px;" ><?php echo $panierCount; ?></span>
            <i class="fas fa-shopping-cart"></i>
            
        </a>
    </div>

    <section class="product">
        <?php
        try {
            $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'Rout02192016*');

            // Requête pour les produits de la catégorie "Enfants"
            $queryEnfants = "SELECT * FROM product WHERE categorie = 'Enfants'";
            $stmtEnfants = $connection->query($queryEnfants);

            // Vérifier s'il y a des produits dans la catégorie "Enfants"
            if ($stmtEnfants->rowCount() > 0) {
                echo '<h1>Enfants</h1>';

                while ($data = $stmtEnfants->fetch()) {
                    $id = $data['id_product'];
                    echo '<div class="card">';
                    echo '<img src="img/'.$data['photo'].'" alt="'.$data['nom_produit'].'">';
                    echo '<div class="title">'.$data['nom_produit'].'</div>';
                    echo '<div class="price">'.$data['prix'].' MAD</div>';
                    echo '<div class="description">'.$data['description'].'</div>';
                    echo '<a href="detail.php?afficher='.$id.'" class="btnd">Voir Détail</a>';
                    echo '<form action="products.php?id='.$id.'" method="post">';
                    echo '<button type="submit" name="ajouter" class="btnd">Ajouter au panier</button>';
                    echo '</form>';
                    echo '</div>';
                }
            }

            // Requête pour les produits de la catégorie "Adultes"
            $queryAdultes = "SELECT * FROM product WHERE categorie = 'Adultes'";
            $stmtAdultes = $connection->query($queryAdultes);

            // Vérifier s'il y a des produits dans la catégorie "Adultes"
            if ($stmtAdultes->rowCount() > 0) {
                echo '<h1>Adultes</h1>';

                while ($data = $stmtAdultes->fetch()) {
                    $id = $data['id_product'];
                    echo '<div class="card">';
                    echo '<img src="img/'.$data['photo'].'" alt="'.$data['nom_produit'].'">';
                    echo '<div class="title">'.$data['nom_produit'].'</div>';
                    echo '<div class="price">'.$data['prix'].' MAD</div>';
                    echo '<div class="description">'.$data['description'].'</div>';
                    echo '<a href="detail.php?afficher='.$id.'" class="btnd">Voir Détail</a>';
                    echo '<form action="products.php?id='.$id.'" method="post">';
                    echo '<button type="submit" name="ajouter" class="btnd">Ajouter au panier</button>';
                    echo '</form>';
                    echo '</div>';
                }
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        ?>
    </section>
</body>
</html>
