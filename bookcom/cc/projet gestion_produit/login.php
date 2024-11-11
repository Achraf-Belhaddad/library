<?php

include 'conn.php';
session_start();

if(isset($_POST['submit'])){

    
    $email =$_POST['email'];
    $pass =$_POST['password'];
    


    // Utiliser une requête préparée pour éviter les injections SQL
    $stmt = $conn->prepare("SELECT * FROM `user_form` WHERE email = :email AND password = :password");
    $stmt->execute(['email' => $email, 'password' => $pass]);
    if ($stmt->rowCount() > 0) {

        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_id'] = $row['id'];
        header('Location: index.php');
        exit; 
        

    } else {
        echo 'incorrect password or email!';

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--custom css file link-->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div class="form-container">

        <form action="" method="post">
            <h3>login now</h3>
            
            <input type="email" name="email" required placeholder="entrer email" class="box">
            <input type="password" name="password" required placeholder="entrer password" class="box">
            <input type="submit" name="submit"  class="btn" value="login now">
            <p>
                don't have an account? <a href="register.php">register now</a>
            </p>

        </form>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>