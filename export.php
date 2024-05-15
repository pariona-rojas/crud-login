<?php
// Incluir la autocarga de Composer
require 'vendor/autoload.php';

// Utilizar las clases de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Verificar si se enviaron las fechas desde la página de filtrado
if(isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin']) && !empty($_GET['fecha_inicio']) && !empty($_GET['fecha_fin'])) {

    // Incluir el archivo de conexión a la base de datos
    include("database/db.php");

    // Obtener las fechas del formulario
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin = $_GET['fecha_fin'];

    // Consultar la base de datos para obtener los registros filtrados
    $query = "SELECT * FROM tabla WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    $resultado = mysqli_query($conn, $query);

    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar encabezados a la hoja de cálculo
    $sheet->setCellValue('A1', 'Parte');
    $sheet->setCellValue('B1', 'Delito');
    $sheet->setCellValue('C1', 'Fecha');
    $sheet->setCellValue('D1', 'Hora');
    $sheet->setCellValue('E1', 'Grupo');
    $sheet->setCellValue('F1', 'Direccion');
    $sheet->setCellValue('G1', 'Zona');
    $sheet->setCellValue('H1', 'Efectivo');
    $sheet->setCellValue('I1', 'Resumen');

    // Iterar sobre los resultados de la consulta y agregar los datos a la hoja de cálculo
    $rowIndex = 2;
    while ($row = mysqli_fetch_array($resultado)) {
        $sheet->setCellValue('A' . $rowIndex, $row['parte']);
        $sheet->setCellValue('B' . $rowIndex, $row['delito']);
        $sheet->setCellValue('C' . $rowIndex, $row['fecha']);
        $sheet->setCellValue('D' . $rowIndex, $row['hora']);
        $sheet->setCellValue('E' . $rowIndex, $row['grupo']);
        $sheet->setCellValue('F' . $rowIndex, $row['direccion']);
        $sheet->setCellValue('G' . $rowIndex, $row['zona']);
        $sheet->setCellValue('H' . $rowIndex, $row['efectivo']);
        $sheet->setCellValue('I' . $rowIndex, $row['resumen']);
        $rowIndex++;
    }

    // Crear un objeto Writer para enviar el contenido al navegador
    $writer = new Xlsx($spreadsheet);
    $filename = 'registros_' . $fecha_inicio . '_to_' . $fecha_fin . '.xlsx';

    // Establecer encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Enviar el contenido al navegador
    $writer->save('php://output');
    exit;
} else {
    // Si no se encontraron las fechas, redirigir a la página de filtrado con un mensaje de advertencia
    header("Location: page.php?error=missing_dates");
    exit;
}
?>
