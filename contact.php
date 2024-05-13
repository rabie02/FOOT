<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Se connecter à la base de données
require_once('connexion.php');

try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérer les valeurs du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Insérer les données dans la table "contact"
    $query = "INSERT INTO contact (id_clt, name, email, phone, message) 
              VALUES (:id_clt, :name, :email, :phone, :message)";
    $statement = $connection->prepare($query);
    $statement->bindValue(':id_clt', $_SESSION['id'] ?? null);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':message', $message);
    $statement->execute();

    // Rediriger vers une page de confirmation ou afficher un message de succès
    header('Location: confirmation_contact.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Contact us</title>
    <link rel="stylesheet" type="text/css" href="contact.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
<div>
    <?php
    include 'navbar.php';
    ?>
</div>

<div class="container">
    <div class="contact-box">
        <div class="left"></div>
        <div class="right">
            <h2>Contact Us</h2>
            <form method="POST" action="">
                <input type="text" class="field" placeholder="Your Name" name="name" required >
                <input type="email" class="field" placeholder="Your Email" name="email" required >
                <input type="text" class="field" placeholder="Phone" name="phone"  required>
                <textarea placeholder="Message" class="field" name="message"  required></textarea>
                <button class="btn" name="submit">Send</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
