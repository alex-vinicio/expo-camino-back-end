<?php
    $con = mysqli_connect('localhost','alex','1234','expo-camino-db'); //parameters for acces to db

    if(mysqli_connect_errno()){
        echo "1: Conexion fallida";
        exit();
    }

    $playerName = $_POST["name"];
    $visionLevel = $_POST["nivelVision"];

    $playerCheckQuery = "SELECT nombre FROM usuario WHERE nombre='". $playerName."';";

    $playerCheck = mysqli_query($con, $playerCheckQuery) or die("2: Verificacion del nombre fallo");

    if(mysqli_num_rows($playerCheck) > 0 ){
        // $random = rand(1,500);
        // $playerName = $playerName."-".$random;
        echo "existe";
        exit();
    }

    // add user tot able un mysql
    $posicion = 0;
    $insertPlayerQuery = "INSERT INTO usuario (nombre, fecha_ingreso, nivel_vision ,clasificacion_puntuacion) VALUES('".$playerName."','".date("Y/m/d h:i:sa")."','".$visionLevel."','".$posicion."');";
    mysqli_query($con, $insertPlayerQuery) or die("4: Registro del jugador fallo");

    echo "0";   
?> 
