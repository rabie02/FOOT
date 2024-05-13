<?php
session_start();

if (!isset($_SESSION['admin'])) {
    // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page de connexion de l'administrateur
    header('Location: admin-login.php');
    exit();
}

if (isset($_POST['confirm'])) {
    $reservationId = $_POST['reservation_id'];
    // Mettre à jour l'état de réservation à "valider" dans la base de données
    try {
        $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'root');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "UPDATE reservation SET etat_reservation = 'valider' WHERE id_reservation = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $reservationId);
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
} elseif (isset($_POST['cancel'])) {
    $reservationId = $_POST['reservation_id'];
    // Mettre à jour l'état de réservation à "annule" dans la base de données
    try {
        $connection = new PDO('mysql:host=localhost;dbname=urbain_db', 'root', 'root');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "UPDATE reservation SET etat_reservation = 'annule' WHERE id_reservation = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $reservationId);
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

// Rediriger l'administrateur vers la page des réservations après le traitement
header('Location: reservation.php');
exit();
?>
