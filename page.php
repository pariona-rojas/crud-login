<?php include("database/db-crud.php") ?>
<?php include("function.php")  ?>
<?php include("includes/header.php") ?>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
                <?php if(isset($_SESSION['message'])) {?>
                    <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message']?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php session_unset(); }?>    
                <div class="card card-body">
                    <form action="crud/save.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="parte" class="form-control" placeholder="Parte" autofocus>  
                        </div>
                        <div class="form-group">
                            <input type="text" name="delito" class="form-control" placeholder="Delito">  
                        </div>
                        <div class="form-group">
                            <input type="text" name="fecha" class="form-control" placeholder="Fecha">  
                        </div>
                        <div class="form-group">
                            <input type="text" name="hora" class="form-control" placeholder="Hora">  
                        </div>
                        <div class="form-group">
                            <input type="text" name="grupo" class="form-control" placeholder="Grupo">  
                        </div>
                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion">  
                        </div>
                        <div class="form-group">
                            <input type="text" name="zona" class="form-control" placeholder="Zona">  
                        </div>
                        <div class="form-group">
                            <input type="text" name="efectivo" class="form-control" placeholder="Efectivo">  
                        </div>
                        <div class="form-group">
                            <textarea name="resumen" rows="2" placeholder="Resumen"></textarea>  
                        </div>
                        <div class="form-group">  
                        <input type="file" name="archivo" class="form-control" accept="image/*"> <!-- Acepta solo imágenes --> 
                        </div>

                        <input type="submit" class="btn btn-success btn-block" name="registrar" value="Registrar">
                    </form>
                </div>
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
                            $query = "SELECT * FROM tabla";
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
