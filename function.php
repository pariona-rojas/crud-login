<?php
// Esta función obtiene la ruta del archivo desde la base de datos
function obtener_ruta_archivo_desde_bd($conn, $id) {
    // Realizar una consulta a la base de datos para obtener la ruta del archivo
    $query = "SELECT archivo FROM tabla WHERE id = $id"; // Ajusta 'tabla' y 'id' según tu estructura de base de datos
    $resultado = mysqli_query($conn, $query);

    // Verificar si se encontró un resultado
    if($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['archivo']; // Devolver la ruta del archivo
    } else {
        return null; // Devolver null si no se encuentra la ruta del archivo
    }
}
?>
