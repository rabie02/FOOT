
    <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    // Vérifier si l'utilisateur est connecté en tant qu'administrateur
    if (!isset($_SESSION['admin'])) {
        // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page de connexion de l'administrateur
        header('Location: admin-login.php');
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

    // Récupérer les commandes en fonction de l'état sélectionné
    $filters = array();
    if (isset($_GET['filter-in-progress'])) {
        $filters[] = "etat_commande = 'En cours'";
    }
    if (isset($_GET['filter-confirmed'])) {
        $filters[] = "etat_commande = 'Confirmée'";
    }
    if (isset($_GET['filter-cancelled'])) {
        $filters[] = "etat_commande = 'Annulée'";
    }

    // Récupérer les commandes par date si une date est sélectionnée
    $dateFilter = isset($_GET['date-filter']) ? $_GET['date-filter'] : '';

    // Construction de la requête SQL avec les filtres
    $query = "SELECT * FROM commande";
    if (!empty($filters) || !empty($dateFilter)) {
        $query .= " WHERE ";

        if (!empty($filters)) {
            $query .= "(" . implode(" OR ", $filters) . ")";
        }

        if (!empty($filters) && !empty($dateFilter)) {
            $query .= " AND ";
        }

        if (!empty($dateFilter)) {
            $query .= "date_commande = '$dateFilter'";
        }
    }

    $stmt = $connection->query($query);
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les dates distinctes pour les filtres de date
    $queryDates = "SELECT DISTINCT date_commande FROM commande ORDER BY date_commande DESC";
    $stmtDates = $connection->query($queryDates);
    $dates = $stmtDates->fetchAll(PDO::FETCH_COLUMN);
    ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration - Commandes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #filter-bar {
            display: none;
        }
        
        #filter-button {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>

<body>

    <div>
        <?php include 'nav_admin.php'; ?>
    </div>

    <h1 style="padding-top: 20px;">admin : <?php echo $_SESSION['admin']; ?></h1>

    <h2 style="color: #ff7831; font-size: 30px; text-align: center; margin: 20px;">Liste des commandes</h2>

    <button id="filter-button" onclick="toggleFilterBar()">Afficher les filtres</button>

    <div class="filter-bar" id="filter-bar">
        <form method="GET" action="">

            <label for="date-filter">Filtrer par date :</label>
            <select id="date-filter" name="date-filter">
                <option value="">Toutes les dates</option>
                <?php foreach ($dates as $date) : ?>
                    <option value="<?php echo $date; ?>" <?php if ($date == $dateFilter) echo 'selected'; ?>><?php echo $date; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="filter-in-progress">
                <input type="checkbox" id="filter-in-progress" name="filter-in-progress" value="1" <?php if (isset($_GET['filter-in-progress'])) echo 'checked'; ?>>
                En cours
            </label>
            <label for="filter-confirmed">
                <input type="checkbox" id="filter-confirmed" name="filter-confirmed" value="1" <?php if (isset($_GET['filter-confirmed'])) echo 'checked'; ?>>
                Confirmée
            </label>
            <label for="filter-cancelled">
                <input type="checkbox" id="filter-cancelled" name="filter-cancelled" value="1" <?php if (isset($_GET['filter-cancelled'])) echo 'checked'; ?>>
                Annulée
            </label>

            <button type="submit">Filtrer</button>
            <button type="button" onclick="resetFilters()">Réinitialiser</button>

        </form>
    </div>

    <table>
        <tr>
            <th>ID Commande</th>
            <th>Nom du client</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Code Postal</th>
            <th>Méthode de paiement</th>
            <th>Date de commande</th>
            <th>Heure de commande</th>
            <th>Produits</th>
            <th>État</th>
            <th>Action</th>
        </tr>

        <?php foreach ($commandes as $commande) : ?>
            <tr>
                <td><?php echo $commande['id_commande']; ?></td>
                <td><?php echo $commande['nom']; ?></td>
                <td><?php echo $commande['adresse']; ?></td>
                <td><?php echo $commande['ville']; ?></td>
                <td><?php echo $commande['code_postal']; ?></td>
                <td><?php echo $commande['paiement']; ?></td>
                <td><?php echo $commande['date_commande']; ?></td>
                <td><?php echo $commande['heure_commande']; ?></td>
                <td>
                    <?php
                    // Décoder les produits en JSON
                    $produits = json_decode($commande['produits'], true);
                    foreach ($produits as $idProduit => $quantite) {
                        // Récupérer les informations du produit depuis la base de données
                        $query = "SELECT * FROM product WHERE id_product = :id";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(':id', $idProduit);
                        $stmt->execute();
                        $produit = $stmt->fetch();

                        // Afficher les informations du produit
                        echo '<div>';
                        echo '<img src="img/' . $produit['photo'] . '" alt="' . $produit['nom_produit'] . '" width="50" height="50">';
                        echo '<p>Nom : ' . $produit['nom_produit'] . '</p>';
                        echo '<p>Prix : ' . $produit['prix'] . ' MAD </p>';
                        echo '<p>Quantité : ' . $quantite . '</p>';
                        echo '</div>';
                    }
                    ?>
                </td>
                <td><?php echo $commande['etat_commande']; ?></td>
                <td>
                    <form method="post" action="traiter_commande.php">
                        <input type="hidden" name="commande_id" value="<?php echo $commande['id_commande']; ?>">
                        <button type="submit" name="confirm" style="background-color: green;"><i class="fas fa-check"></i></button>
                        <button type="submit" name="cancel" style="background-color: red;"><i class="fas fa-times"></i></button>
                        <!-- Ajoutez d'autres boutons ou actions selon vos besoins -->
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function toggleFilterBar() {
            const filterBar = document.getElementById('filter-bar');
            const filterButton = document.getElementById('filter-button');
            if (filterBar.style.display === 'none') {
                filterBar.style.display = 'block';
                filterButton.innerText = 'Masquer les filtres';
            } else {
                filterBar.style.display = 'none';
                filterButton.innerText = 'Afficher les filtres';
            }
        }

        // Réinitialiser les filtres et soumettre le formulaire
        function resetFilters() {
            const checkboxes = document.querySelectorAll('.filter-bar input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            const dateFilter = document.getElementById('date-filter');
            dateFilter.value = '';

            const form = document.querySelector('.filter-bar form');
            form.submit();
        }
    </script>

</body>

</html>
