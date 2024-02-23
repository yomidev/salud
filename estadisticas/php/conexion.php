<?php
    $servername = "127.0.0.1:8889";
    $username = "root";
    $password = "root";
    $dbname = "correosfoprode";
    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    

?>