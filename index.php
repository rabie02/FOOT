<?php
session_start();
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


        <!-- home section start -->
    <section class="home">
        <div class="swiper home-slider ">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide" style="background:url(img/back-home-1.png) no-repeat">
                    <div class="content">
                        <span> play, train, be happy</span>
                        <h3>It's time to play soccer</h3>
                        <a href="package.php" class="btn">Reserve now</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url(img/back-about-1.png) no-repeat">
                    <div class="content">
                        <span> play, train, be happy</span>
                        <h3>we are all players</h3>
                        <a href="package.php" class="btn">Reserve now</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url(img/bach.png) no-repeat">
                    <div class="content">
                        <span> play, train, be happy</span>
                        <h3>let's play</h3>
                        <a href="package.php" class="btn">Reserve now</a>
                    </div>
                </div>

            </div>
     <!-- boutton slider  -->
             <div class="swiper-button-next" style=" color: #ff7831; " ></div>
             <div class="swiper-button-prev" style=" color: #ff7831; " ></div>

            

        </div>

    </section>
    <section class="home-offer">
            <div class="content">
                <h3>Up to 50% off in our plans</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing 
                    elit. Eum repudiandae a debitis? Pariatur rerum 
                    sed eum odit consectetur, excepturi veritatis.</p>
                <a href="package.php" class="btn">Reserve now</a>
            </div>
        </section>


        <!-- home section end -->
        <div class="ad-container" id="adContainer"  >
    <video controls autoplay muted loop class="ad-video">
        <source src="img/brikol.mp4" type="video/mp4">
    </video>
    <button class="close-btn" id="closeAdBtn">&times;</button>
</div>




        <!-- services section start -->
    <section class="services">


        <h1 class="heading-title">Our services</h1>

        <div class="box-container">
        

            <div class="box">
                <img src="img/ball.png" alt="">
                <h3>Football</h3>
            </div>

            <div class="box">
                <img src="img/cam.png" alt="">
                <h3>pictures</h3>
            </div>


            <div class="box">
                <img src="img/comp.png" alt="">
                <h3>league</h3>
            </div>


            <div class="box">
                <img src="img/store.png" alt="">
                <h3>shop</h3>
            </div>

            <div class="box">
                <img src="img/ball.png" alt="">
                <h3>foot 5. 7. 9. 11</h3>
            </div>

            <div class="box">
                <img src="img/comp.png" alt="">
                <h3>competition</h3>
            </div>


        </div>


    </section>    


        <!-- services section end -->


        <!-- home about section start  -->


        <!-- about-1  -->
    <section class="home-about">

        <div class="image">

            <img src="img/photo-about-1.png" alt="">

        </div>

        <div class="content">
            <h3>About us</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Maxime alias delectus eaque, eius et soluta libero, 
                quisquam molestias nobis eos est, consequatur facilis 
                officiis maiores esse pariatur neque distinctio nisi!</p>
            <a href="about.php"  class="btn" >Read more</a>    
        </div>
        

        <!-- about-2 -->

    </section>


    <section class="home-about-1">

     

        <div class="content">
            <h3>My Urbain</h3>
            <p>Download the UrbanSoccer application, to take advantage 
                of the developed features of MyUrban. In a few clicks,
                 you can reserve your zone, tag ur players, review 
                 your goals at the end of the match.</p>
            <a href="#"  class="btn" >Download now</a>    
        </div>

        <div class="image">

<img src="img/my-pic-3.jpg" alt="">

</div>
        
    </section>



    <!-- about-3  -->



    





        <!-- home about section end  -->



        <!-- home package section start  -->
    <section class="home-packages">

        <h1 class="heading-title">Our products</h1>

        <div class="box-container">
          
        
            <!-- book 1  -->

            <div class="box">
                <div class="image">
                    <img src="img/tenue.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Football shirts</h3>
                    <p>Lorem ipsum dolor sit amet consectetur 
                        adipisicing elit. Nihil, pariatur.</p>
                    <a href="#" class="btn">Buy now</a>
                </div>
            </div>
    
               <!-- book 2  -->

            <div class="box">
                <div class="image">
                    <img src="img/spadrille.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Football boots</h3>
                    <p>Lorem ipsum dolor sit amet consectetur 
                        adipisicing elit. Nihil, pariatur.</p>
                    <a href="#" class="btn">Buy now</a>
                </div>
            </div>

                <!-- book 3  -->

            <div class="box">
                <div class="image">
                    <img src="img/ballon.jpg" alt="">
                </div>
                <div class="content">
                    <h3>football</h3>
                    <p>Lorem ipsum dolor sit amet consectetur 
                        adipisicing elit. Nihil.  pariatur.</p>
                    <a href="#" class="btn">Buy now</a>
                </div>
            </div>



        </div>

        <div class="load-more"> <a href="products.php" class="btn">  Explore our products</a></div>
    </section>



        <!-- home package section end -->




        <!-- home offer section start -->
    



        <!-- home offer section end -->

























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
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<!-- custum js file -->
<script src='script.js'></script>
<!-- Annonces vidéo -->
<script>// JavaScript pour gérer l'affichage et la fermeture de la barre d'annonces vidéo
const adContainer = document.getElementById('adContainer');
const closeAdBtn = document.getElementById('closeAdBtn');

// Afficher la barre d'annonces vidéo
function showAd() {
    adContainer.style.display = 'block';
}

// Masquer la barre d'annonces vidéo
function hideAd() {
    adContainer.style.display = 'none';
}

// Fermer la vidéo et masquer la barre d'annonces vidéo
closeAdBtn.addEventListener('click', function () {
    hideAd();
});

// Afficher la barre d'annonces vidéo une fois que la page est chargée
window.addEventListener('load', function () {
    showAd();
});
</script>


</body>
</html>