<?php
include("../database/db.php");

if(isset($_GET["id"])){
    $id = $_GET['id'];
    $query = "SELECT * FROM tabla WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);
        $parte = $row['parte'];
        $delito = $row['delito'];
        $resumen = $row['resumen'];
    }

    if(isset($_POST['update'])){
        $id = $_GET['id'];
        $parte = $_POST['parte'];
        $delito = $_POST['delito'];
        $resumen = $_POST['resumen'];
        $query = "UPDATE tabla SET parte='$parte', delito='$delito', resumen='$resumen' WHERE id=$id";
        mysqli_query($conn, $query);
        $_SESSION["message"] = 'Incidencia Actualizada Correctamente';
        $_SESSION["message_type"] = 'success';
        header("Location: ../page.php");
    }
}
?>
<?php include("../includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="parte" value="<?php echo $parte; ?>" class="form-control" placeholder="Update Part">
                    </div>
                    <div class="form-group">
                        <input type="text" name="delito" value="<?php echo $delito; ?>" class="form-control" placeholder="Update Delit">
                    </div>
                    <div class="form-group">
                        <textarea name="resumen" rows="2" class="form-control" placeholder="Update Resume"><?php echo $resumen ?></textarea>
                    </div>
                    <button class="btn btn-success" name="update">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php") ?>
