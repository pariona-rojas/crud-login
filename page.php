<?php include("database/db.php") ?>
<?php include("function.php") ?>
<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

        <?php if(isset($_SESSION['message'])) {?>
        <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); }?> 


            <!-- Formulario de filtrado por rango de fechas -->
            <form action="" method="GET">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
            </form>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Parte</th>
                        <th>Delito</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Zona</th>
                        <th>Actions</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // Verificar si se envió el formulario de filtrado
                        if(isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])){
                            $fecha_inicio = $_GET['fecha_inicio'];
                            $fecha_fin = $_GET['fecha_fin'];
                            $query = "SELECT * FROM tabla WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
                        } else {
                            $query = "SELECT * FROM tabla";
                        }
                        $consulta = mysqli_query($conn, $query);
                        while($row=mysqli_fetch_array($consulta)){ ?>
                            <?php $ruta_archivo = obtener_ruta_archivo_desde_bd($conn, $row['id']); ?>
                            <tr>
                                <td><?php echo $row['parte'] ?></td>
                                <td><?php echo $row['delito'] ?></td>
                                <td><?php echo $row['fecha'] ?></td>
                                <td><?php echo $row['hora'] ?></td>
                                <td><?php echo $row['zona'] ?></td>
                                <td>
                                    <a href="crud/edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                        <i class="fas fa-marker" ></i>
                                    </a>
                                    <a href="crud/delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                        <i class="far fa-trash-alt" ></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="show.php?ruta=<?php echo $ruta_archivo; ?>" target="_blank">
                                        <i class="far fa-file" ></i>
                                    </a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>
