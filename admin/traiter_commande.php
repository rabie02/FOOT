<?php

session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin'])) {
    // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page de connexion de l'administrateur
    header('Location: admin-login.php');
    exit();
}

// Vérifier si la commande ID est spécifiée dans la requête
if (!isset($_POST['commande_id'])) {
    // La commande ID n'est pas spécifiée, rediriger vers la page des commandes
    header('Location: commandes.php');
    exit();
}

// Récupérer l'ID de la commande à traiter
$commandeId = $_POST['commande_id'];

// Récupérer l'action à effectuer (confirm ou cancel)
$action = isset($_POST['confirm']) ? 'confirm' : 'cancel';

// Connexion à la base de données
$host = 'localhost';
$dbname = 'urbain_db';
$username = 'root';
$password = 'root';

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

// Mettre à jour l'état de la commande
if ($action === 'confirm') {
    $etatCommande = 'Confirme';
} else {
    $etatCommande = 'Annule';
}

$query = "UPDATE commande SET etat_commande = :etat WHERE id_commande = :id";
$stmt = $connection->prepare($query);
$stmt->bindParam(':etat', $etatCommande);
$stmt->bindParam(':id', $commandeId);
$stmt->execute();

// Rediriger vers la page des commandes
header('Location: commande.php');
exit();
