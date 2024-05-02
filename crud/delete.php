<?php

include("../database/db-crud.php");

if(isset($_GET["id"])){
    $id = $_GET['id'];
    $query = "DELETE FROM tabla WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed");
    }
    $_SESSION['message'] = 'Incidencia Removida Satisfactoriamente';
    $_SESSION['message_type'] = 'danger';
    header("Location: ../index.php");
}

?>