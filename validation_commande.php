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

// Vérifier si le panier existe dans la session
if (!isset($_SESSION['panier'])) {
    // Le panier est vide, rediriger vers la page des produits
    header('Location: products.php');
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

// Traitement de la commande
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les informations du formulaire
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $codePostal = $_POST['code_postal'];
    $methodePaiement = $_POST['methode_paiement'];

    // Obtenir la date et l'heure actuelles
    $dateCommande = date('Y-m-d');
    $heureCommande = date('H:i:s');

    // Insertion de la commande dans la base de données
    $query = "INSERT INTO commande (nom, adresse, ville, code_postal, produits, id, paiement, date_commande, heure_commande) VALUES (:nom, :adresse, :ville, :code_postal, :produits, :id, :paiement, :date_commande, :heure_commande)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':nom', $_SESSION['firstname']);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':code_postal', $codePostal);
    $stmt->bindParam(':produits', $produits);
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->bindParam(':paiement', $methodePaiement);
    $stmt->bindParam(':date_commande', $dateCommande);
    $stmt->bindParam(':heure_commande', $heureCommande);

    // Convertir le panier en JSON et l'assigner à la colonne "produits"
    $produits = json_encode($_SESSION['panier']);
    $stmt->bindParam(':produits', $produits);

    $stmt->execute();

    // Récupérer l'ID de la commande insérée
    $idCommande = $connection->lastInsertId();

    // Vider le panier
    unset($_SESSION['panier']);

    // Rediriger vers une page de confirmation de commande
    header('Location: confirmation_commande.php?id=' . $idCommande);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validation de commande</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="valider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div>
        <?php include 'navbar.php'; ?>
    </div>

    <h2 style="color: #ff7831; font-size: 30px; text-align: center; margin: 20px;">Validation de commande</h2>

    <form method="post" action="" style="text-align: center;">
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required>
        </div>

        <div class="form-group">
            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" required>
        </div>

        <div class="form-group">
            <label for="code_postal">Code postal :</label>
            <input type="text" id="code_postal" name="code_postal" required>
        </div>

        <div class="form-group">
            <label for="methode_paiement">Méthode de paiement :</label>
            <select id="methode_paiement" name="methode_paiement" required>
                <option value="paiement a la livraison">paiement a la livraison </option>
                <option value="paypal">PayPal</option>
                <option value="virement bancaire">Virement bancaire</option>
            </select>
        </div>

        <div style="text-align: center;">
            <button type="submit" class="btn-valider">Valider la commande</button>
        </div>
    </form>

    <div style="text-align: center;">
        <a href="panier.php" class="btn-retour">Retourner au panier</a>
    </div>

</body>

</html>

