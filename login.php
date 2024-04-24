<?php 

    session_start();

    if(isset($_SESSION['user_id'])){
        header('Location: /web');
    }
    require 'database/db.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $connn->prepare('SELECT id, email, password FROM usuario WHERE email=:email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id']=$results['id'];
            header('Location: /web');
        } else{
            $message = 'Sorry your credential do not match';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php require 'partials/header.php'?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <?php if(!empty($message)):?>
        <p><?php echo $message ?></p>
    <?php endif; ?>


    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter Your Email">
        <input type="password" name="password" placeholder="Enter Your Password">
        <input type="submit" value="Send">
    </form>
</body>
</html>