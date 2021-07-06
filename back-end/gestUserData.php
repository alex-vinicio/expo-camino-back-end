<?php
    $con = mysqli_connect('localhost','alex','1234','expo-camino-db'); //parameters for acces to db

    if(mysqli_connect_errno()){
        echo "1: Conexion fallida";
        exit();
    }

    $playerName = $_POST["name"];

    $playerCheckQuery = "SELECT * FROM usuario WHERE nombre='". $playerName."';";

?>