<?php 
    include("database/db-crud.php");
    include("function.php");
    include("includes/header.php");

    if(isset($_SESSION['message'])) {
        ?>
        <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
        session_unset(); 
    }?>    

    <div class="container p-4">
        <div class="row">
            <div class="col-md-6">
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
        </div>
    </div>

<?php include("includes/footer.php") ?> 
