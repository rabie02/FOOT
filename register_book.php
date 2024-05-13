<?php
    // Inclure le fichier de connexion
    require_once('connexion.php');

    try {
        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $errorMessage = ''; // Variable pour stocker le message d'erreur

        if (isset($_POST['submit'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telephone = $_POST['telephone'];

            // Vérifier l'unicité de l'email
            $query = "SELECT * FROM client WHERE email = :email";
            $statement = $connection->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                $errorMessage = "Cet email est déjà utilisé par un autre utilisateur. Veuillez en choisir un autre.";
            } else {
                // Insérer les données de l'utilisateur dans la base de données
                $query = "INSERT INTO client (firstname, lastname, email, password, telephone) 
                          VALUES (:firstname, :lastname, :email, :password, :telephone)";
                $statement = $connection->prepare($query);
                $statement->bindParam(':firstname', $firstname);
                $statement->bindParam(':lastname', $lastname);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':password', $password);
                $statement->bindParam(':telephone', $telephone);
                $statement->execute();

                header('Location: register.php');
            }
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>

<!-- Afficher le formulaire d'inscription et le message d'erreur -->
<form method="post" action="">
    <!-- Reste du code du formulaire d'inscription... -->
    <span class="error-message"><?php echo $errorMessage; ?></span>
</form>
