<?php


$server = 'localhost';
$username = 'root';
$password = '';
$database = 'data';


try{
    $connn = new PDO("mysql:host=$server;dbname=$database",$username,$password);
} catch(PDOException $e){
    die('Connected Failed: '.$e->getMessage());
}


?>