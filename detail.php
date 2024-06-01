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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="card.css">
    <!-- swipper css link -->
    
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Document</title>
</head>
<body>

<?php
include 'navbar.php';
?>
<div class="card-dtl" >
<?php
require_once('connexion.php');

if (isset($_GET['afficher'])) {
    $id = $_GET['afficher'];

    try {
        $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'Rout02192016*');

        $query = "SELECT * FROM product WHERE id_product = '$id'";

        $stmt = $connection->query($query);
        $data = $stmt->fetch();

        echo '<div class="articled" align="center" >';
        echo '<h2>Détail product : '.$data['nom_produit'].'</h2>';
        echo '<img src="img/'.$data['photo'].'" width="400px" height="350px">';
        echo '<br>';
        echo '<h3>'.$data['nom_produit'].'</h3>';
        echo '<br>';
        echo '<h3>'.$data['prix'].' MAD'. '</h3>';
        echo '<br>';
        echo '<div class="description">'.$data['description'].'</div>';
        echo '<form action="products.php?id='.$id.'" method="post">';
        echo '<button type="submit" name="ajouter" class="btnd">Ajouter au panier</button>';
        echo '</form>';
        echo '</div>';

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
?>
</div>
</body>
</html>
