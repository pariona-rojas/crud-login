<?php
    // session_start(); // No olvides descomentar esta línea si necesitas usar sesiones.
    require 'database/db.php';
    
    if(isset($_SESSION['user_id'])){
        header('Location: /web');
    }
    
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $connn->prepare('SELECT id, email, password FROM usuario WHERE email=:email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        if($results && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id']=$results['id'];
            header('Location: /web');
        } else{
            $message = 'Sorry, your credentials do not match';
        }
    } else {
        $message = 'Please enter both email and password';
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
    <style>
        /* Estilos personalizados para el formulario de inicio de sesión */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container form input[type="text"],
        .login-container form input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .login-container form input[type="submit"] {
            padding: 10px;
            background-color: #0098cb;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container form input[type="submit"]:hover {
            background-color: #0077a9;
        }
        .login-container form p.error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php require 'partials/header.php'?>

    <div class="login-container">
        <h1>Login</h1>
        <span>or <a href="signup.php">SignUp</a></span>

        <?php if(!empty($message)):?>
            <p class="error-message"><?php echo $message ?></p>
        <?php endif; ?>

        <form action="login.php" method="post" id="login-form">
            <input type="text" name="email" placeholder="Enter Your Email" required>
            <input type="password" name="password" placeholder="Enter Your Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
