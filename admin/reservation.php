<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'Rout02192016*');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer toutes les réservations des clients de la base de données
    $query = "SELECT * FROM reservation";

    // Récupérer les dates uniques des réservations
    $dateQuery = "SELECT DISTINCT date FROM reservation";
    $dateStmt = $connection->query($dateQuery);
    $dates = $dateStmt->fetchAll(PDO::FETCH_COLUMN);

    // Vérifier les filtres de date et d'état
    $stateFilters = isset($_GET['state-filter']) ? $_GET['state-filter'] : array();
    $dateFilter = isset($_GET['date-filter']) ? $_GET['date-filter'] : '';

    // Construire la clause WHERE pour les filtres d'état
    $stateWhere = '';
    if (!empty($stateFilters)) {
        $stateWhere = "WHERE etat_reservation IN ('" . implode("', '", $stateFilters) . "')";
    }

    // Ajouter les filtres à la requête SQL
    if (!empty($stateFilters) && !empty($dateFilter)) {
        $query .= " WHERE date = '$dateFilter' AND etat_reservation IN ('" . implode("', '", $stateFilters) . "')";
    } elseif (!empty($stateFilters)) {
        $query .= " WHERE etat_reservation IN ('" . implode("', '", $stateFilters) . "')";
    } elseif (!empty($dateFilter)) {
        $query .= " WHERE date = '$dateFilter'";
    }

    $stmt = $connection->query($query);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Gérer les réservations</title>
</head>
<body>
    <?php include 'nav_admin.php'; ?>
    <h1 style="padding-top: 20px;">admin : <?php echo $_SESSION['admin']; ?></h1>

    <h2 style="color: #ff7831; font-size: 30px; text-align: center; margin: 20px;">Liste des réservations</h2>

    <div class="filter-bar">
        <form method="GET" action="">
            <label for="date-filter">Filtrer par date :</label>
            <select id="date-filter" name="date-filter">
                <option value="">Toutes les dates</option>
                <?php foreach ($dates as $date) : ?>
                    <option value="<?php echo $date; ?>" <?php if ($dateFilter == $date) echo 'selected'; ?>><?php echo $date; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="state-filter">Filtrer par état :</label>
            <div id="state-filter">
                <label>
                    <input type="checkbox" name="state-filter[]" value="En cours" <?php if (in_array('En cours', $stateFilters)) echo 'checked'; ?>>
                    En cours
                </label>
                <label>
                    <input type="checkbox" name="state-filter[]" value="valider" <?php if (in_array('valider', $stateFilters)) echo 'checked'; ?>>
                    Confirmée
                </label>
                <label>
                    <input type="checkbox" name="state-filter[]" value="Annule" <?php if (in_array('Annule', $stateFilters)) echo 'checked'; ?>>
                    Annulée
                </label>
            </div>
                            <br>
            <button type="submit">Filtrer</button>
            <a href="?"><button type="button">Réinitialiser</button></a>
        </form>
    </div>

    <table>
        <tr>
            <th>ID réservation</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Type</th>
            <th>Date</th>
            <th>Heure</th>
            <th>État</th>
            <th>Action</th>
        </tr>
        <?php foreach ($reservations as $reservation) : ?>
            <tr>
                <td><?php echo $reservation['id_reservation']; ?></td>
                <td><?php echo $reservation['name']; ?></td>
                <td><?php echo $reservation['email']; ?></td>
                <td><?php echo $reservation['phone']; ?></td>
                <td><?php echo $reservation['type']; ?></td>
                <td><?php echo $reservation['date']; ?></td>
                <td><?php echo $reservation['time']; ?></td>
                <td><?php echo $reservation['etat_reservation']; ?></td>
                <td>
                    <!-- Boutons d'action -->
                    <form method="post" action="traiter_reservation.php">
                        <input type="hidden" name="reservation_id" value="<?php echo $reservation['id_reservation']; ?>">
                        <button type="submit" name="confirm" style="background-color: green;"><i class="fas fa-check"></i></button>
                        <button type="submit" name="cancel"><i class="fas fa-times"></i></button>
                        <!-- Ajoutez d'autres boutons ou actions selon vos besoins -->
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
