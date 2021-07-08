<?php
   $con = mysqli_connect('sql3.freemysqlhosting.net','sql3423344','EFcYepLlVD','sql3423344'); //parameters for acces to db

    if(mysqli_connect_errno()){
        echo "1: Conexion fallida";
        exit();
    }

    $playerName = $_POST["name"];
    $visionLevel = $_POST["nivelVision"];

    if(!$playerName){
        echo "No data";
        exit();
    }


    $playerCheckQuery = "SELECT nombre FROM usuario WHERE nombre='". $playerName."';";

    $playerCheck = mysqli_query($con, $playerCheckQuery) or die("2: Verificacion del nombre a fallo");

    if(mysqli_num_rows($playerCheck) > 0 ){
        // $random = rand(1,500);
        // $playerName = $playerName."-".$random;
        echo "3"; // jugador ya existe
        exit();
    }

    // add user tot able un mysql
    $posicion = 0;
    //register new user
    $insertPlayerQuery = "INSERT INTO usuario (nombre, fecha_ingreso, nivel_vision ,clasificacion_puntuacion) VALUES('".$playerName."','".date("Y/m/d h:i:sa")."','".$visionLevel."','".$posicion."');";
    mysqli_query($con, $insertPlayerQuery) or die("4: Registro del jugador fallo");

    $playerVerifyQuery = "SELECT nombre,id FROM usuario WHERE nombre='". $playerName."';";
    $playerCheck = mysqli_query($con, $playerVerifyQuery) or die("2: Verificacion del nombre a fallo");
    if(mysqli_num_rows($playerCheck) != 1 ){
        // $random = rand(1,500);
        // $playerName = $playerName."-".$random;
        echo "3"; // el jguador tiene mas de 1 nombre o no existe
        exit();
    }

    $findInfo = mysqli_fetch_assoc($playerCheck);
    //register level 1 but data is 0
    $insertPlayerLevel1Query = "INSERT INTO `usuario_nivel`( `check_point_x`, `check_point_y`, `tiempo_nivel`, `numero_repeticion`, `puntuacion_nivel`, `numero_respuestas_fallidas`, `distancia_recorida`, `estado`, `id_usuario`, `id_nivel`) VALUES ('0','0','0','0','0','0','0','1','".$findInfo["id"]."','1')";
    mysqli_query($con, $insertPlayerLevel1Query) or die("8: Registro del check point fallo");
    mysqli_close($con);

    echo "0";   
?> 
