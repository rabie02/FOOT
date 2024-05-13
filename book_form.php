<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['firstname'])) {
    header('Location: register.php');
    exit();
}

require_once('connexion.php');

try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les informations du client
    $query = "SELECT email, telephone FROM client WHERE id = :client_id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':client_id', $_SESSION['id']);
    $statement->execute();
    $client = $statement->fetch(PDO::FETCH_ASSOC);

    // Vérifier si les informations du client ont été récupérées avec succès
    if ($client) {
        // Utiliser les informations du client pour remplir les variables
        $email = $client['email'];
        $phone = $client['telephone'];
    } else {
        // Gérer le cas où les informations du client ne sont pas disponibles
        echo 'Failed to retrieve client information.';
        exit();
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

// Gérer la soumission du formulaire de réservation
if (isset($_POST['send'])) {
    require_once('connexion.php');

    try {
        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $type = $_POST['type'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $query = "INSERT INTO reservation (id_clt, name, email, phone, type, date, time) 
                  VALUES (:id_clt, :name, :email, :phone, :type, :date, :time)";
        $statement = $connection->prepare($query);
        $statement->bindValue(':id_clt', $_SESSION['id']);
        $statement->bindValue(':name', $_SESSION['firstname'] . ' ' . $_SESSION['lastname']);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':time', $time);
        $statement->execute();

        header('Location: book_form.php');
        exit();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>
    <!-- swipper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
</head>
<body>
    <!-- header section start -->
    <div>
        <?php include 'navbar.php'; ?>
    </div>
    <!-- header section end   -->

    <div class="heading" style="background: url(img/back-home-1.png) no-repeat">
        <h1>Reserve now</h1>
    </div>

    <!-- booking section start -->
    <section class="booking">
        <form action="book_form.php" method="post" class="book-form">
            <div class="flex">
            

                <div class="inputBox">
                    <span>Date :</span>
                    <input type="date" name="date" id="datePicker">
                </div>

                <div class="inputBox">
                    <span>Hour :</span>
                    <select name="time" id="hour" required>
                        <?php
                            $currentHour = date("H");
                            for ($i = 0; $i <= 23; $i++) {
                                $hour = str_pad($i, 2, "0", STR_PAD_LEFT);
                                if ($hour < $currentHour + 2) {
                                    echo "<option value=\"$hour\" disabled>$hour (heure non disponible)</option>";
                                } else {
                                    echo "<option value=\"$hour\">$hour</option>";
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="inputBox">
                    <span>Type  :</span>
                    <select name="type" id="">
                        <option value="foot 5">foot 5</option>
                        <option value="foot 7">foot 7</option>
                        <option value="foot 9">foot 9</option>
                        <option value="foot 11">foot 11</option>
                    </select>
                </div>

            </div>
            <input type="submit" value="Reserve" class="btn" name="send">
        </form>
    </section>
    <!-- booking section end  -->

    <!-- footer section start -->
    <section class="footer">

        <div class="box-container">
            <div class="box">
                <h3>Quick links</h3>
                <a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
                <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
                <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
                <a href="book_form.php"> <i class="fas fa-angle-right"></i> Book</a>
            </div>

            <div class="box">
                <h3>Extra links</h3>
                <a href="#"> <i class="fas fa-angle-right"></i> Ask questions</a>
                <a href="#"> <i class="fas fa-angle-right"></i> About us</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Privacy policy</a>
                <a href="#"> <i class="fas fa-angle-right"></i> Term of use</a>
            </div>



            <div class="box">
                <h3>Contact info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +212 65549-5342 </a>
                <a href="#"> <i class="fas fa-phone"></i> +212 65549-5342 </a>
                <a href="#"> <i class="fas fa-envelope"></i> Ahmedad@gmail.com </a>
                <a href="#"> <i class="fas fa-map"></i> Marrakech, Morocco, 102030 </a>
               
            </div>


            <div class="box">
                <h3>Follow us</h3>
                <a href="#"> <i class="fab fa-facebook-f"></i> Facebook </a>
                <a href="#"> <i class="fab fa-instagram"></i> Instagram </a>
                <a href="#"> <i class="fab fa-twitter"></i> Twitter </a>
                <a href="#"> <i class="fab fa-linkedin"></i> Linkedin </a>
            </div>


        </div>

        <div class="credit">Created by <span>Urbain Foot</span> all right reserved!</div>


    </section>


    <!-- footer section end -->

    <!-- swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <!-- custum js file -->
    <script src='script.js'></script>

    <!-- script js for date selection -->
    <script>
        // Obtenir la date d'aujourd'hui
        var today = new Date().toISOString().split('T')[0];

        // Sélectionner l'élément de champ de date
        var datePicker = document.getElementById("datePicker");

        // Définir la valeur minimale du champ de date sur aujourd'hui
        datePicker.min = today;

        // Ajouter un écouteur d'événement pour vérifier la sélection de date
        datePicker.addEventListener("change", function() {
            var selectedDate = new Date(datePicker.value);
            var todayDate = new Date(today);

            if (selectedDate < todayDate) {
                alert("Choisissez une date disponible !");
                datePicker.value = ""; // Réinitialiser la valeur du champ de date
            }
        });
    </script>
</body>
</html>
