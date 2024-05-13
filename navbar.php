<?phpif (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<section class="header">
    <a href="index.php" class="logo"><img src="img/logo1.png" alt="" class="logo"  >  </a>
    <!-- <img src="img/logo1.png" alt="" class="logo"  > -->

    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">about</a>
        <a href="package.php">plans</a>
        <a href="book_form.php">Reserve</a>
        
        <?php
            if (isset($_SESSION['firstname'])) {
                echo '<a href="historique.php" class="logout" ><i class="fa-solid fa-clock" style=" margin-right: 5px; "></i>Historique</a>';
                echo  '<a href="account.php" class="logout" ><i class="fa-solid fa-user" style=" margin-right: 10px; "></i>My Profil</a>';
                echo '<a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket" style=" margin-right: 10px; " ></i>Logout</a>';
            }
        ?>


        <a href="products.php">
            <span class="log"><i class="fa-solid fa-store" style=" margin-right: 10px; "></i>Urbain store</span></a>

        <?php
        if (isset($_SESSION['firstname'])) {
            echo '<div class="dropdown">';
            echo '<div class="circle">';
            $initials = substr($_SESSION['firstname'], 0, 1) . substr($_SESSION['lastname'], 0, 1);
            echo '<span class="initial">' . $initials . '</span>';

            echo '<i class="fas fa-chevron-down" style=" color: white; font-weight: 700; margin-left: 2px;"></i>'; // Ajout de l'icône de la flèche vers le bas
            echo '</div>';
            echo '<div class="dropdown-content">';
            $name = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
            echo '<a class="">' . $name . '</a>';
            
            echo '<a href="account.php"><i class="fa-solid fa-user" style=" margin-right: 10px; "></i>My Profil</a>';
            echo '<a href="historique.php"><i class="fa-solid fa-clock" style=" margin-right: 5px; "></i>Historique</a>';
            echo '<a href="contact.php"><i class="fa-solid fa-envelope"  style=" margin-right: 10px; " ></i>Contact</a>';
            echo '<a href="logout.php" style=" background: #f1f1f1; color: var(--main-color); "><i class="fa-solid fa-right-from-bracket" style=" margin-right: 10px; " ></i>Logout</a>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<a href="register.php"><span class="log"><i class="fa-solid fa-user" style=" margin-right: 10px; "></i>connexion</span></a>';
        }
        ?>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>
</section>
