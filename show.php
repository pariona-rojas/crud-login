<?php
if(isset($_GET['ruta'])){
    $ruta_imagen = $_GET['ruta'];
    echo "Ruta de la imagen: $ruta_imagen"; // Comprueba que la ruta sea correcta
    echo "<img src='$ruta_imagen' alt='Imagen'>";
} else {
    echo "Ruta de la imagen no proporcionada";
}
?>
