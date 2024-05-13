<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!-- custum css file -->
</head>
<body>
    

        <!-- header section start -->
        <div>
       
        <?php
            include 'navbar.php';
        ?>
        </div>


        <!-- header section end   -->

    <div class="heading" style="background: url(img/bach-3.png) no-repeat">
        <h1>Reservation</h1>
    </div>


    <!-- product section start -->

        <section class="packages">

            <h1 class="heading-title">Our plans</h1>

            <div class="box-container">

                <div class="box">

                    <div class="image">
                        <img src="img/foot5.png" alt="">
                    </div>
                    <div class="content">
                        <h3> plan Foot 5</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book_form.php" class="btn"> order now</a>
                    </div>
                </div>


                <div class="box">

                    <div class="image">
                        <img src="img/foot7.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Plan foot 7</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book_form.php" class="btn"> order now</a>
                    </div>
                </div>


                <div class="box">

                    <div class="image">
                        <img src="img/foot9.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Plan foot 9</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book_form.php" class="btn"> order now</a>
                    </div>
                </div>


                <div class="box">

                    <div class="image">
                        <img src="img/foot11.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Plan foot 11</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book_form.php" class="btn"> order now</a>
                    </div>
                </div>


            
             
            </div>

           

        </section>




    <!-- product section ends -->


            <!-- abonnement plan start  -->
    <!-- <section class="packages">

            <h1 class="heading-title">Our Packages</h1>

            <div class="box-container">

                <div class="box">

                    <div class="image">
                        <img src="img/ballon.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>pro</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book.php" class="btn"> order now</a>
                    </div>
                    
                </div>


                <div class="box">

                    <div class="image">
                        <img src="img/ballon.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>pro+</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book.php" class="btn"> order now</a>
                    </div>
                </div>


                <div class="box">

                    <div class="image">
                        <img src="img/ballon.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Premium</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book.php" class="btn"> order now</a>
                    </div>
                </div>


                <div class="box">

                    <div class="image">
                        <img src="img/ballon.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Premium+</h3>
                        <p>Lorem ipsum dolor
                         sit amet consectetur adipisicing elit.
                          Incidunt, velit.</p>
                        <a href="book.php" class="btn"> order now</a>
                    </div>
                </div>


             

             
            </div>

           

        </section> -->


<!-- abonnement plan end -->















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
</body>
</html>