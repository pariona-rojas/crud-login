<?php

session_start();

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'datax';

$conn = mysqli_connect(
    $server,
    $username,
    $password,
    $database
);

try{
    $connn = new PDO("mysql:host=$server;dbname=$database",$username,$password);
} catch(PDOException $e){
    die('Connected Failed: '.$e->getMessage());
}


?>