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

// Vérifier si l'ID de la commande est spécifié dans l'URL
if (!isset($_GET['id'])) {
    // L'ID de la commande n'est pas spécifié, rediriger vers une autre page
    header('Location: autre-page.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .confirmation {
            margin-top: 50px;
            padding: 20px;
            border-radius: 5px;
        }

        h1 {
            font-size: 30px;
            color: #ff7831;
        }

        p {
            font-size: 30px;
            margin: 10px 0;
        }
        a{
            color: #ff7831;
            
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="confirmation">
        <h1>THANKS. Your commande has been received</h1>
        <p>Merci <?php echo $_SESSION['firstname']; ?> pour votre commande.</p>
        <p>Votre commande avec l'ID <?php echo $_GET['id']; ?> a été validée avec succès.</p>
        
        <p>Si vous avez des questions ou avez besoin d'assistance, veuillez nous <a href="contact.php">contacter.</a></p>
        <p>Merci de votre confiance.</p>
    </div>
</body>

</html>
