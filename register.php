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
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Register</title>
</head>
<body>
    



    




                <!-- s'inscrire   -->

 
    
    <div class="container" id="container">
        
        <div class="form-container sign-up-container">

        

            <form action="register_book.php" method="post">
                <h1> Create Account</h1>
                
                <span>to join urbain community </span>
                <input type="text" placeholder="firstname"  name="firstname" required />
                <input type="text" placeholder="lastname" name="lastname" required />
                <input type="email" placeholder="Email"   name="email" required/>
                <input type="number" placeholder="phone"  name="telephone" required />
                <input type="password" placeholder="Password" name="password" required />


                <input  class="btn-i" type="submit" value="Sign in" name="submit" required />
                
            </form>
            <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
        </div> 

        



                    <!-- se connecter  -->

         <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>Sign in</h1>
                
                <span>to use your account</span>
                <input type="email" placeholder="Email"   name="email" required/>
                <input type="password" placeholder="Password" name="password" required />
                <a href="inscrir.php">Forgot your password?</a>
                <input  class="btn-i" type="submit" value="sign in"  name="envoyer" />
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1> <span  >MY</span>   URBAIN</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>

        

    </div>

    







                <!-- code de connection avec l affichage de l erreur dans la meme page  start -->


                <?php
    require_once('connexion.php');

    try {
        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['envoyer'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM client WHERE email = :email AND password = :password";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);
            $statement->execute();
            $data = $statement->fetch();
            $_SESSION['firstname'] = $data['firstname'];
            $_SESSION['lastname'] = $data['lastname'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['telephone'] = $data['telephone'];
            

            $_SESSION['id'] = $data['id'];
if ($statement->rowCount() == 1) {
                header('Location: index.php');
                exit();
            } else {
                // Incorrect identifiers, display an error message
                echo '<p style="color: #fff; font-size: 18px;">Identifiants incorrects. Veuillez réessayer.</p>';
            }
        }

        // Close the database connection
        $connection = null;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>




  <!-- code de connection avec l affichage de l erreur dans la meme page end -->


    


</body>
</html>

        




<script>

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>




