<?php 
    require 'db.php';

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO usuario (email, password) VALUES (:email, :password)";
        $stmt = $connn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_ARGON2ID);
        $stmt->bindParam(':password',$password);
    
        if($stmt->execute()){
            $message = "Succesfully created new user";   
        } else{
            $message = "Sorry there must have been an issue creating your account";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php require 'partials/header.php'?>


    <?php if(!empty($message)):?>
        <p><?php echo $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter Your Email">
        <input type="password" name="password" placeholder="Enter Your Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <input type="submit" value="Send">
    </form>
    
</body>
</html>