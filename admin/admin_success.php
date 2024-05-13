<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    // L'administrateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: admin-login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succès de l'opération</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body  ><style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f2f2f2;
    }

    h1, h2 {
        color: #ff7831;
        text-align: center;
    }

    p {
        text-align: center;
        margin-top: 20px;
        font-size: 24px;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        background-color: #ff7831;
        padding: 10px;
        border: 2px solid #ff7831;
        transition: all .5s;
        border-radius: 20px;
    }

    a:hover {
        background-color: transparent;
        color: #ff7831;
    }
</style>
    <script>
        window.onload = function() {
            var countdown = 10; // Nombre de secondes à compter

            // Fonction pour mettre à jour le compteur de secondes
            function updateCountdown() {
                var countdownElement = document.getElementById("countdown");
                countdownElement.textContent = countdown; // Mettre à jour le contenu du compteur

                if (countdown === 0) {
                    window.location.href = "admin.php"; // Rediriger vers index.php
                } else {
                    countdown--; // Décrémenter le compteur
                    setTimeout(updateCountdown, 1000); // Appeler la fonction après 1 seconde
                }
            }

            // Démarrer la mise à jour du compteur de secondes
            updateCountdown();
        };
    </script>
</head>
<body>
<div class="container">
    <h1>Confirmation</h1>
    <p>Votre operation a été effectuée avec succès.</p>
    <p>Vous serez redirigé vers la page d'accueil dans <span id="countdown"  style="color: #ff7831;" >10</span> secondes. Si la redirection ne fonctionne pas, veuillez cliquer <a href="admin.php">ici</a></p>
</div>
</body>
</html>
