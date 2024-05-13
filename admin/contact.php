<?php

// Se connecter à la base de données
require_once('connexion.php');

try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Récupérer les messages depuis la table "contact"
$query = "SELECT * FROM contact";
$statement = $connection->prepare($query);
$statement->execute();
$messages = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
<?php
    include 'nav_admin.php';
?>

<h1 style=" padding-top: 20px; " >admin :  <?php echo $_SESSION['admin']; ?> </h1>
<div class="container">
    <h2 style="color: #ff7831; font-size: 30px; text-align: center; margin: 20px;" > Messages</h2>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($messages as $message) { ?>
            <tr>
                <td><?php echo $message['name']; ?></td>
                <td><?php echo $message['email']; ?></td>
                <td><?php echo $message['phone']; ?></td>
                <td><?php echo $message['message']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
