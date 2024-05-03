<?php 

include("../database/db-crud.php");

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
    $archivo_nombre = $_FILES['archivo']['name']; // Obtener el nombre del archivo
    $archivo_temporal = $_FILES['archivo']['tmp_name']; // Obtener la ubicación temporal del archivo

    // Verificar errores en la carga del archivo
    // if ($_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
    //     die("Error al cargar el archivo. Código de error: " . $_FILES['archivo']['error']);
    // }

    // Mover el archivo a la carpeta de destino (archivos/)
    $ruta_archivo = "../archivos/" . $archivo_nombre;
    move_uploaded_file($archivo_temporal, $ruta_archivo);

    // Insertar la ruta relativa del archivo en la base de datos
    $ruta_archivo_bd = "archivos/" . $archivo_nombre;

    $query = "INSERT INTO tabla(parte, delito, fecha, hora, grupo, direccion, zona, efectivo, resumen, archivo) 
    VALUES ('$parte', '$delito', '$fecha', '$hora', '$grupo', '$direccion', '$zona', '$efectivo', '$resumen', '$ruta_archivo_bd')";

    $result = mysqli_query($conn, $query);
    if (!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Incidencia registrada correctamente';
    $_SESSION['message_type'] = 'success';

    header("location: ../register.php");
};

?>