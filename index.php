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
</head>

<body>

<?php require 'partials/header.php'?>

<?php if(!empty($user)): ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h4 class="display-8">Welcome <?= $user['email'] ?></h4> <!-- Aumento de tamaño de texto -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">You are logged in this web page</h5>
                        <a href="logout.php" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5"><!-- Espacio adicional al final del contenido -->
    <!-- Aquí añadimos un formulario simple para elegir entre registrar datos o consultar datos -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="POST">
                    <div class="mb-3">
                        <label for="action" class="form-label">Choose an action:</label>
                        <select name="action" id="action" class="form-select">
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
    <h1>Please Login or SignUp</h1>
    <a href="login.php">Login</a> or
    <a href="signup.php">Signup</a>
<?php endif; ?>

</body>
</html>
