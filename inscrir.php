<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test1.css">
    <title>Document</title>
</head>
<body>
     

        
       

        

            <form action="register_book.php" method="post">
                <h1> Create </h1>
                
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
       
        
</body>
</html>