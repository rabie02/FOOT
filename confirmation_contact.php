<!DOCTYPE html>
<html>
<head>
    <title>Confirmation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="confirmation_contact.css">
    <meta http-equiv="refresh" content="11;url=index.php"> <!-- Rediriger vers index.php après 5 secondes -->
    <script>
        window.onload = function() {
            var countdown = 10; // Nombre de secondes à compter

            // Fonction pour mettre à jour le compteur de secondes
            function updateCountdown() {
                var countdownElement = document.getElementById("countdown");
                countdownElement.textContent = countdown; // Mettre à jour le contenu du compteur

                if (countdown === 0) {
                    window.location.href = "index.php"; // Rediriger vers index.php
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
    <h1 style="color: #ff7831;">Confirmation</h1>
    <p>Votre message a été envoyé avec succès.</p>
    <p>Vous serez redirigé vers la page d'accueil dans <span id="countdown"  style="color: #ff7831;" >10</span> secondes. Si la redirection ne fonctionne pas, veuillez cliquer <a href="index.php" style="color: #ff7831;">ici</a>.</p>
</div>
</body>
</html>

