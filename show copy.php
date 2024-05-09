<?php
if(isset($_GET['ruta'])){
    $ruta_archivo = $_GET['ruta'];
    //echo "Ruta del archivo: $ruta_archivo"; 
    echo "<img src='$ruta_archivo' alt='Imagen'><br>";

    // Obtener el nombre del archivo
    $nombre_archivo = basename($ruta_archivo);

    // Mostrar enlace de descarga
    echo "<a href='$ruta_archivo' download='$nombre_archivo'>Descargar archivo</a>";
} else {
    echo "Ruta del archivo no proporcionada";
}
?>



