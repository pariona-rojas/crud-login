<?php 
include("database/db.php");
include("function.php");
include("includes/header.php");

// Establecer el número de registros por página
$registros_por_pagina = 10;

// Calcular la página actual
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el índice del primer registro para la consulta SQL
$indice_primer_registro = ($pagina - 1) * $registros_por_pagina;

// Consulta SQL para obtener los registros con paginación
if(isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])){
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin = $_GET['fecha_fin'];
    $query = "SELECT * FROM tabla WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' LIMIT $indice_primer_registro, $registros_por_pagina";
} else {
    $query = "SELECT * FROM tabla LIMIT $indice_primer_registro, $registros_por_pagina";
}
$consulta = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); }?>
            
            <!-- Formulario de filtrado por rango de fechas -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filtrar por Fecha</h5>
                    <form action="" method="GET">
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Parte</th>
                            <th style="width: 25%;">Delito</th>
                            <th style="width: 15%;">Fecha</th>
                            <th>Hora</th>
                            <th>Zona</th>
                            <th>Acciones</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=mysqli_fetch_array($consulta)){ ?>
                            <?php $ruta_archivo = obtener_ruta_archivo_desde_bd($conn, $row['id']); ?>
                            <tr>
                                <td><?php echo $row['parte'] ?></td>
                                <td><?php echo $row['delito'] ?></td>
                                <td><?php echo $row['fecha'] ?></td>
                                <td><?php echo $row['hora'] ?></td>
                                <td><?php echo $row['zona'] ?></td>
                                <td>
                                    <a href="crud/edit.php?id=<?php echo $row['id']?>" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a href="crud/delete.php?id=<?php echo $row['id']?>" class="btn btn-sm btn-danger">
                                        <i class="far fa-trash-alt"></i> Eliminar
                                    </a>
                                </td>
                                <td>
                                    <a href="show.php?ruta=<?php echo $ruta_archivo; ?>" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="far fa-file"></i> Ver Archivo
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
            // Calcular el número total de registros y páginas
            $query_total_registros = "SELECT COUNT(*) as total FROM tabla";
            $resultado_total_registros = mysqli_query($conn, $query_total_registros);
            $total_registros = mysqli_fetch_assoc($resultado_total_registros)['total'];
            $total_paginas = ceil($total_registros / $registros_por_pagina);
            ?>

            <?php if ($total_paginas > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="page-item <?php echo $pagina == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php include("includes/footer.php") ?>

