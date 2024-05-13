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

$dsn = 'mysql:host=localhost;dbname=urbain_db';
$username = 'root';
$password = 'Rout02192016*';

try {
    // Créer une connexion à la base de données
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur et arrêter l'exécution du script
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}

// Variables pour stocker les messages d'erreur
$passwordError = "";

// Vérifier si le formulaire de modification a été soumis
if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $telephone = $_POST['telephone'];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirmPassword) {
        $passwordError = "Les mots de passe ne correspondent pas.";
    } else {
        // Mettre à jour les coordonnées dans la base de données
        $query = "UPDATE client SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, telephone = :telephone WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->execute();

        // Mettre à jour les coordonnées dans la session
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['telephone'] = $telephone;

        // Rediriger vers la page de compte après la modification
        header('Location: account.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Account</title>
</head>
<body>
    <div>
        <?php include 'navbar.php'; ?>
    </div>

    <section class="content">
     
        <h1 style="font-size: 24px; color: #ff7831 "  ><i class="fa-solid fa-user" style="margin-right: 10px;" ></i>Account Information</h1>
        <p style="font-size: 20px;" >First Name: <?php echo $_SESSION['firstname']; ?></p>
        <p style="font-size: 20px;">Last Name: <?php echo $_SESSION['lastname']; ?></p>
        <p style="font-size: 20px;">Email: <?php echo $_SESSION['email']; ?></p>
        <p style="font-size: 20px;">Telephone: <?php echo $_SESSION['telephone']; ?></p>

        <h2 style="font-size: 24px; color: #ff7831 " ><i class="fa-solid fa-pen" style="margin-right: 10px;" ></i>Modify Account Details</h2>
        <form action="" method="post">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $_SESSION['lastname']; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">

            <label for="telephone">Telephone:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $_SESSION['telephone']; ?>">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="new password">

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="confirm new password">

            <?php if (!empty($passwordError)): ?>
                <p class="error"><?php echo $passwordError; ?></p>
            <?php endif; ?>

            <button type="submit" name="update">Save Changes</button>
        </form>
    </section>
</body>
</html>
