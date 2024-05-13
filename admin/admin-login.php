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
    
    <title>Register</title>
</head>
<body>
 <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>Sign in</h1>
                
                <span>to use your account</span>
                <input type="email" placeholder="Email"   name="email" required/>
                <input type="password" placeholder="Password" name="password" required />
                <a href="#">Forgot your password?</a>
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
                    <h1> <span  >ADMIN</span>   URBAIN</h1>
                    <p>Enter your personal details and start journey with us</p>
                    
                </div>
            </div>
        </div>

        

    </div>


        <?php
    require_once('connexion.php');

    try {
        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['envoyer'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM adminn WHERE email = :email AND password = :password";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);
            $statement->execute();
            $data = $statement->fetch();
            
            $_SESSION['admin'] = $data['firstname_ad'];
          
            

            $_SESSION['id_ad'] = $data['id_ad'];

            if ($statement->rowCount() == 1) {
                header('Location: admin.php');
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

</body>
</html>




