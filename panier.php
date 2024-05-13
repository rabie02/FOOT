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

// Connexion à la base de données
$host = 'localhost';
$dbname = 'urbain_db';
$username = 'root';
$password = 'Rout02192016*';

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panier</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="panier.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div>
        <?php include 'navbar.php'; ?>
    </div>

    <h2 style="color: #ff7831;font-size: 30px;text-align: center;margin: 20px;" >Votre Panier</h2>

    <table>
        <tr>
            <th>ID produit</th>
            <th>Photo du produit</th>
            <th>Nom du produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>

        <?php
        // Vérifier si le panier existe dans la session
        if (isset($_SESSION['panier'])) {
            $somme = 0; // Variable pour stocker la somme totale des produits

            foreach ($_SESSION['panier'] as $idProduit => $quantite) {
                // Récupérer les informations du produit depuis la base de données
                $id = $idProduit;

                // Utiliser une requête SQL pour récupérer les informations du produit en fonction de son ID
                $query = "SELECT * FROM product WHERE id_product = '$id'"; // Remplacez "product" par le nom de votre table de produits
                $stmt = $connection->query($query);
                $data = $stmt->fetch();

                // Extraire les informations du produit
                $nomProduit = $data['nom_produit'];
                $prixProduit = $data['prix'];
                $descriptionProduit = $data['description'];
                $photoProduit = $data['photo'];

                echo '<tr>';
                echo '<td>' . $id . '</td>';
                echo '<td><img src="img/' . $photoProduit . '" alt="Photo du produit" width="100" height="100"></td>';
                echo '<td>' . $nomProduit . '</td>';
                echo '<td>' . $prixProduit . ' MAD</td>';
                echo '<td><input type="number" name="quantite[]" value="' . $quantite . '" style="margin: 5px; padding: 15px; background-color: #f2f2f2;"></td>';

                echo '<td>' . $descriptionProduit . '</td>';
                echo '<td><a href="panier.php?action=supprimer&id=' . $idProduit . '"><i class="fas fa-trash"></i></a></td>'; // Lien pour supprimer le produit
                echo '</tr>';

                $somme += $prixProduit * $quantite; // Ajouter le prix du produit multiplié par sa quantité à la somme totale
            }

            echo '<tr><td colspan="7" style="font-size: 25px;color: #ff7831;text-align: center;" >Somme totale : ' . $somme . ' MAD</td></tr>'; // Afficher la somme totale
        } else {
            echo '<tr><td colspan="7" style="text-align: center;">Votre panier est vide. <a href="products.php" class="btn-retour">Retourner aux produits</a></td></tr>';
        }
        ?>
    </table>

    <br><br>

    <div style="text-align: center;">
        <?php
        if (isset($_SESSION['panier'])) {
            echo '<a href="panier.php?action=effacerpanier" class="btn-vider-panier">Vider le panier</a>';
            echo '<a href="validation_commande.php" class="btn-valider-commande">Valider la commande</a>';
            echo '<tr><td colspan="7" style="text-align: center;"><a href="products.php" class="btn-retour">Retourner aux produits</a></td></tr>';
        }
        ?>
    </div>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == "effacerpanier") {
        // Effacer le panier
        unset($_SESSION['panier']);
        echo '<script type="text/javascript">';
        echo 'alert("Panier effacé");';
        echo 'location.replace("panier.php");';
        echo '</script>';
    } elseif (isset($_GET['action']) && $_GET['action'] == "supprimer" && isset($_GET['id'])) {
        // Supprimer un produit du panier
        $idProduit = $_GET['id'];
        unset($_SESSION['panier'][$idProduit]);
        echo '<script type="text/javascript">';
        echo 'alert("Produit supprimé du panier");';
        echo 'location.replace("panier.php");';
        echo '</script>';
    }
    ?>

</body>

</html>
