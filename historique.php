<?php
session_start();

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

// Récupérer l'historique des commandes de produits du client
$queryCommandes = "SELECT * FROM commande WHERE id = :id";
$stmtCommandes = $connection->prepare($queryCommandes);
$stmtCommandes->bindParam(':id', $_SESSION['id']);
$stmtCommandes->execute();
$historiqueCommandes = $stmtCommandes->fetchAll(PDO::FETCH_ASSOC);

// Récupérer l'historique des réservations du client
$queryReservations = "SELECT * FROM reservation WHERE id_clt = :id";
$stmtReservations = $connection->prepare($queryReservations);
$stmtReservations->bindParam(':id', $_SESSION['id']);
$stmtReservations->execute();
$historiqueReservations = $stmtReservations->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Historique des commandes</title>

    <!-- Autres liens CSS et scripts -->
    <style>
        .container {
            width: 90%;
            margin: 0 auto 30px auto;
        }

        h2 {
            text-align: center;
            color: #ff7831;
            font-size: 35px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            font-size: 15px;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .container div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .container div img {
            margin-right: 10px;
            width: 100px;
            height: 100px;
        }

        .container div p {
            margin: 0;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="heading" style="background: url(img/bach-1.png) no-repeat ">
        <h1> historique </h1>
        
    </div>

    <div style="margin-top: 20px;text-align: center;">
            <button class="btn-heading" onclick="showCommandes()" >mes commandes</button>
            <button class="btn-heading" onclick="showReservations()"  >mes réservations</button>
        </div>

    <div id="sectionCommandes" class="container">
        <h2>Historique des commandes</h2>

        <table>
            <tr>
                <th>ID Commande</th>
                <th>Date de commande</th>
                <th>Heure de commande</th>
                <th>Produits</th>
                <th>Mode de paiement</th>
                <th>Somme payée</th>
                <th>État</th>
            </tr>

            <?php foreach ($historiqueCommandes as $commande) : ?>
                <tr>
                    <td><?php echo $commande['id_commande']; ?></td>
                    <td><?php echo $commande['date_commande']; ?></td>
                    <td><?php echo $commande['heure_commande']; ?></td>
                    <td>
                        <?php
                        // Décoder les produits en JSON
                        $produits = json_decode($commande['produits'], true);
                        $sommePayee = 0; // Variable pour stocker la somme payée
                        foreach ($produits as $idProduit => $quantite) {
                            // Récupérer les informations du produit depuis la base de données
                            $query = "SELECT * FROM product WHERE id_product = :id";
                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(':id', $idProduit);
                            $stmt->execute();
                            $produit = $stmt->fetch();
    
                            // Calculer le prix total pour chaque produit
                            $prixTotal = $produit['prix'] * $quantite;
                            $sommePayee += $prixTotal; // Ajouter au total de la somme payée
    
                            // Afficher les informations du produit
                            echo '<div>';
                            echo '<img src="img/' . $produit['photo'] . '" alt="' . $produit['nom_produit'] . '" width="100" height="100">';
                            echo '<p>Nom : ' . $produit['nom_produit'] . '</p>';
                            echo '<p>Prix : ' . $produit['prix'] . ' MAD</p>';
                            echo '<p>Quantité : ' . $quantite . '</p>';
                            echo '</div>';
                        }
                        ?>
                    </td>
                    <td><?php echo $commande['paiement']; ?></td>
                    <td><?php echo $sommePayee; ?> MAD</td>
                    <td><?php echo $commande['etat_commande']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
    <div id="sectionReservations" class="container" style="display: none;">
        <h2>Historique des réservations</h2>
    
        <table>
            <tr>
                <th>ID Réservation</th>
                <th>Date de réservation</th>
                <th>Heure de réservation</th>
                <th>Type du terrain</th>
                <th>État</th>
            </tr>
    
            <?php foreach ($historiqueReservations as $reservation) : ?>
                <tr>
                    <td><?php echo $reservation['id_reservation']; ?></td>
                    <td><?php echo $reservation['date']; ?></td>
                    <td><?php echo $reservation['time']; ?>:00 h</td>
                    <td><?php echo $reservation['type']; ?></td>
                    <td><?php echo $reservation['etat_reservation']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <section class="footer">

<div class="box-container">
    <div class="box">
        <h3>Quick links</h3>
        <a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
        <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
        <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
        <a href="book_form.php"> <i class="fas fa-angle-right"></i> Book</a>
    </div>

    <div class="box">
        <h3>Extra links</h3>
        <a href="#"> <i class="fas fa-angle-right"></i> Ask questions</a>
        <a href="#"> <i class="fas fa-angle-right"></i> About us</a>
        <a href="#"> <i class="fas fa-angle-right"></i> Privacy policy</a>
        <a href="#"> <i class="fas fa-angle-right"></i> Term of use</a>
    </div>



    <div class="box">
        <h3>Contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> +212 65549-5342 </a>
        <a href="#"> <i class="fas fa-phone"></i> +212 65549-5342 </a>
        <a href="#"> <i class="fas fa-envelope"></i> Ahmedad@gmail.com </a>
        <a href="#"> <i class="fas fa-map"></i> Marrakech, Morocco, 102030 </a>
       
    </div>


    <div class="box">
        <h3>Follow us</h3>
        <a href="#"> <i class="fab fa-facebook-f"></i> Facebook </a>
        <a href="#"> <i class="fab fa-instagram"></i> Instagram </a>
        <a href="#"> <i class="fab fa-twitter"></i> Twitter </a>
        <a href="#"> <i class="fab fa-linkedin"></i> Linkedin </a>
    </div>


</div>

<div class="credit">Created by <span>Urbain Foot</span> all right reserved!</div>


</section>
    
    <script>
        function showCommandes() {
            document.getElementById("sectionCommandes").style.display = "block";
            document.getElementById("sectionReservations").style.display = "none";
        }
    
        function showReservations() {
            document.getElementById("sectionCommandes").style.display = "none";
            document.getElementById("sectionReservations").style.display = "block";
        }
    </script>
    <script src='script.js'></script>
    
