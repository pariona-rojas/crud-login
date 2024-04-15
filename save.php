<?php 

include("db-crud.php");

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


    // Convertir la fecha al formato "aa/mm/dd"
    $fecha_array = explode('/', $fecha);
    $dia = $fecha_array[0];
    $mes = $fecha_array[1];
    $anio = $fecha_array[2];

    // Construir la fecha en el formato "aa/mm/dd"
    $fecha_convert = $anio . '-' . $mes . '-' . $dia;
    
    $query="INSERT INTO tabla(parte, delito, fecha, hora, grupo, direccion, zona, efectivo, resumen) 
    VALUES ('$parte', '$delito', '$fecha_convert', '$hora', '$grupo', '$direccion', '$zona', '$efectivo', '$resumen')";
    $result = mysqli_query($conn, $query);
    if (!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Incidencia registrada correctamente';
    $_SESSION['message_type'] = 'success';


    header("location: index.php");
};

?>