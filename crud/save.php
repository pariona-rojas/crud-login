<?php 
include("../database/db.php");

if (isset($_POST['registrar'])){
    $parte = $_POST['parte'];
    $delito = $_POST['delito'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $grupo = $_POST['grupo'];
    $direccion = $_POST['direccion'];
    $zona = $_POST['zona'];
    $efectivo = $_POST['efectivo'];
    $resumen = $_POST['resumen'];

    // Procesamiento del archivo
    $archivo_nombre_original = $_FILES['archivo']['name']; // Obtener el nombre original del archivo
    $archivo_temporal = $_FILES['archivo']['tmp_name']; // Obtener la ubicación temporal del archivo
    $extension_archivo = pathinfo($archivo_nombre_original, PATHINFO_EXTENSION); // Obtener la extensión del archivo

    // Generar un nombre de archivo basado en la fecha y hora proporcionadas
    $nombre_archivo = $efectivo . "_" . str_replace('-', '', $fecha) . "_" . str_replace(':', '', $hora) . ".$extension_archivo";

    // Definir la ruta de destino
    //$ruta_destino = "../archivos/" . $nombre_archivo;
    $ruta_destino = "C:/Users/Administrador/Desktop/registros/" . $nombre_archivo; // Ruta específica en tu sistema

    // Mover el archivo a la carpeta de destino
    move_uploaded_file($archivo_temporal, $ruta_destino);

    // Insertar la ruta relativa del archivo en la base de datos
    $ruta_archivo_bd = "archivos/" . $nombre_archivo;

    $query = "INSERT INTO tabla(parte, delito, fecha, hora, grupo, direccion, zona, efectivo, resumen, archivo) 
    VALUES ('$parte', '$delito', '$fecha', '$hora', '$grupo', '$direccion', '$zona', '$efectivo', '$resumen', '$ruta_archivo_bd')";

    $result = mysqli_query($conn, $query);
    if (!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Incidencia registrada correctamente';
    $_SESSION['message_type'] = 'success';

    header("location: ../register.php");
}
?>
