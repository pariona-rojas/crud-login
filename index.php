<?php 
require 'database/db.php';

// Verificar si el usuario está autenticado
if(isset($_SESSION['user_id'])){
    $records = $connn->prepare('SELECT id, email, password FROM usuario WHERE id=:id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if(count($results) > 0){
        $user = $results;
    } 

    // Redireccionar según la acción elegida
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
        if($action === 'register') {
            header("Location: register.php");
            exit;
        } elseif($action === 'consult') {
            header("Location: page.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEOPLE SECURITY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Estilos para el contenedor del formulario */
        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
            width: 30%; /* Ancho máximo del contenedor */
            margin-left: auto;
            margin-right: auto;
        }

        .form-container .card-header {
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }

        .form-container h4, .form-container h5 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .form-container p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .form-container .btn {
            padding: 12px 24px;
            font-size: 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 20px; /* Espacio entre el botón y el selector de acción */
        }

        .form-container .btn-primary {
            background-color: #0098cb;
            border-color: #0098cb;
            color: white;
        }

        .form-container .btn-primary:hover {
            background-color: #007999;
            border-color: #007999;
        }

        .form-container select {
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            margin-bottom: 20px;
            margin-top: 20px; /* Aumentar la separación entre el botón y el selector de acción */
        }

        .form-container .col-md-6 {
            max-width: 300px; /* Reducir el ancho máximo del cuadro */
            margin: 30px auto; /* Centrar horizontalmente y aumentar la separación vertical */
        }

        .form-container .card-body {
            margin-bottom: 20px; /* Espacio entre el botón de logout y el selector de acción */
        }
    </style>
</head>

<body>

<?php require 'partials/header.php'?>

<?php if(!empty($user)): ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4 class="display-8">Welcome <?= $user['email'] ?></h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">You are logged in this web page</h5>
                            <a href="logout.php" class="btn btn-primary" style="margin-bottom: 20px;">Logout</a> <!-- Agregado el margen inferior -->
                        </div>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="POST">
                        <div class="mb-3">
                            <label for="action" class="form-label">Choose an action:</label>
                            <select name="action" id="action" class="form-select" style="margin-top: 20px;"> <!-- Agregado el margen superior -->
                                <option value="register">Register Data</option>
                                <option value="consult">Consult Data</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Go</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p class="custom-paragraph">Esta página web local está destinada exclusivamente para el registro de las incidencias diarias de seguridad ciudadana, y se requiere que todos los usuarios asuman la responsabilidad correspondiente.</p>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center">
                    <a href="login.php" class="btn btn-primary btn-oval">Login</a>
                    <a href="signup.php" class="btn btn-secondary btn-oval">Signup</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>






