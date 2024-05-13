<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<section class="header">
<a href="index.php" class="logo"><img src="img/logo1.png" alt="" class="logo"  >  </a>

    <nav class="navbar">
        <!-- <a href="#">Home</a> -->
        <a href="admin.php">ajouter un produit</a>
        <a href="gestion_produit.php">gestion des produit</a>
        <a href="commande.php">commandes </a>
        <a href="reservation.php">Reservation</a>



        <?php
        if (isset($_SESSION['admin'])) {
            echo '<div class="dropdown">';
            echo '<div class="circle">';
            echo '<span class="initial">' . substr($_SESSION['admin'], 0, 1) . '</span>';
            echo '<i class="fas fa-chevron-down" style=" color: white; font-weight: 700; margin-left: 2px;" ></i>'; // Ajout de l'icône de la flèche vers le bas
            echo '</div>';
            echo '<div class="dropdown-content">';
            echo '<a class="">' . $_SESSION['admin'] . '</a>';
            echo '<a href="contact.php"> <i class="fa-solid fa-envelope"  style=" margin-right: 10px; " ></i> Contact</a>';
            echo '<a href="logout.php" style=" background: #f1f1f1; color: var(--main-color); " > <i class="fa-solid fa-right-from-bracket"></i> Logout</a>';
            echo '</div>';
            echo '</div>';
        }
       else {
            echo '<a href="register.php"><span class="log"><i class="fa-solid fa-user" style=" margin-right: 10px; " ></i>connexion</span></a>';
        }
        ?>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>
</section>