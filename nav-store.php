<?php session_start(); ?>

<section class="header">
    <a href="index.php" class="logo">Urbain store</a>

    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">Aide</a>
        <a href="contact.php">Contact</a>
        <a href="book_form.php">Reserve</a>

        <?php
        if (isset($_SESSION['firstname'])) {
            echo '<div class="dropdown">';
            echo '<div class="circle">';
            echo '<span class="initial">' . substr($_SESSION['firstname'], 0, 1) . '</span>';
            echo '<i class="fas fa-chevron-down" style=" color: white; font-weight: 700; margin-left: 2px;" ></i>'; // Ajout de l'icône de la flèche vers le bas
            echo '</div>';
            echo '<div class="dropdown-content">';
            echo '<a class="">' . $_SESSION['firstname'] . '</a>';
            echo '<a href="logout.php" style=" background: #f1f1f1; color: var(--main-color); " > <i class="fa-solid fa-right-from-bracket"></i> Logout</a>';
            echo '</div>';
            echo '</div>';
        } elseif (isset($_SESSION['firstname']) && $_SESSION['firstname'] != "aide") {
            echo '<a href="aide.php">Aide</a>';
        } else {
            echo '<a href="register.php"><span class="log"><i class="fa-solid fa-user" style=" margin-right: 10px; " ></i>connexion</span></a>';
        }
        ?>
           
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>
</section>
