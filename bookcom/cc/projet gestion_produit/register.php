<?php
include 'conn.php' ;

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    
    $select ="SELECT  * FROM `user_form` WHERE email='$email' AND password='$pass'";
    $RES=$conn-> query($select);

    if ($RES->rowCount() > 0) {
        // L'utilisateur existe déjà
        echo 'User already exists!';
    } 
    
    else {
        // Ajouter un nouvel utilisateur
        $nb = $conn->exec("INSERT INTO user_form (name, email, password) VALUES ('$name', '$email', '$pass')");
        if ($nb > 0) {
            echo "Registered successfully!";
            header('Location: login.php');
            exit(); // Pour s'assurer que le script s'arrête après la redirection
        } else {
            echo "Failed to register!";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">


    <!--custom css file link-->
    <link rel="stylesheet" href="styles.css">


</head>

<body>
    
    <div class="form-container">

    <form action="" method="post">
        <h3>register now</h3>
        <input type="text" name="name" required placeholder="entrer username" class="box">
        <input type="email" name="email" required placeholder="entrer email" class="box">
        <input type="password" name="password" required placeholder="entrer password" class="box">
        <input type="password" name="cpassword" required placeholder="confirm  password" class="box">
        <input type="submit" name="submit"  class="btn" value="register now">
        <p>already have an account? <a href="login.php">login now</a></p>

    </form>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>  
</html>