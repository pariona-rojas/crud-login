<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidencia del Incidente</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+j6q5s5u4L8be/iqXlFo0n+d+j8pTq2N5gMvJ6B" crossorigin="anonymous">
    <style>
        /* Estilos personalizados */
        .container {
            margin-top: 50px; /* Espacio en la parte superior del contenido */
        }
        .image-container {
            text-align: center; /* Centra la imagen horizontalmente */
            margin-bottom: 20px; /* Espacio en la parte inferior de la imagen */
        }
        .image-title {
            font-size: 24px; /* Tamaño del título */
            font-weight: bold; /* Fuente en negrita */
            color: #333; /* Color del texto */
            margin-bottom: 10px; /* Espacio entre el título y la imagen */
        }
        .download-button {
            display: inline-block; /* Botón en línea con el texto */
            padding: 10px 20px; /* Relleno interno del botón */
            background-color: #007bff; /* Color de fondo del botón */
            color: #fff; /* Color del texto del botón */
            border: none; /* Sin borde */
            border-radius: 5px; /* Esquinas redondeadas */
            text-decoration: none; /* Sin subrayado */
            margin-top: 20px; /* Espacio sobre el botón */
        }
        .download-button:hover {
            background-color: #0056b3; /* Cambio de color al pasar el ratón */
        }
        .error-message {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            font-size: 22px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="image-container">
        <?php
        if(isset($_GET['ruta'])){
            $ruta_archivo = $_GET['ruta'];
            if(file_exists($ruta_archivo)) {
                echo "<h2 class='image-title'>Esta es la evidencia del incidente</h2>";
                echo "<img src='$ruta_archivo' alt='Imagen'><br>";

                // Obtener el nombre del archivo
                $nombre_archivo = basename($ruta_archivo);

                // Mostrar enlace de descarga
                echo "<a href='$ruta_archivo' download='$nombre_archivo' class='download-button'>Descargar archivo</a>";
            } else {
                echo "<div class='error-message'>No existe el archivo seleccionado en la base de datos.</div>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>





