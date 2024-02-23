<?php
//Conexion a Base de Datos
    $host = "127.0.0.1:8889";
    $dbname = "foprodev2";
    $username = "root";
    $password = "root";

    $conn = mysqli_connect($host, $username, $password, $dbname);
    //Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

