<?php
    $con = mysqli_connect('sql3.freemysqlhosting.net','sql3423344','EFcYepLlVD','sql3423344'); //parameters for acces to db

    if(mysqli_connect_errno()){
        echo "1: Conexion fallida";//error code #1
        exit();
    }

    $playerName = $_POST["name"];

    if(!$playerName){
        echo "No data";
        exit();
    }

    //check name exists
    $playerCheckQuery = "SELECT id, nombre  FROM usuario WHERE nombre='". $playerName."';";

    $playerCheck = mysqli_query($con, $playerCheckQuery) or die("2: Verificacion del nombre a fallo"); //error code # 2
    if(mysqli_num_rows($playerCheck) != 1){
        echo "5: el nombre de los jugadores es mas de 1";//error code #5
        exit();
    }

    //get data of query  of player
    $findInfo = mysqli_fetch_assoc($playerCheck);

    $playerLevelsQuery = "SELECT * FROM usuario_nivel WHERE id_usuario='".$findInfo["id"]."' AND estado != 0 AND tiempo_nivel > 0;"; //get lvl in the ultimate checkpoint
    
    $playerLevelCheck = mysqli_query($con, $playerLevelsQuery) or die("6: verificacion del id del jugador fallo"); //error code # 2
    if(mysqli_num_rows($playerLevelCheck) < 1){
        echo "7";//si el usuario aun no tiene un check point en ninugn lvl o si ya temino el juego
        exit();
    }

    $cadena = "0\t";
    while($data = mysqli_fetch_array($playerLevelCheck)){
        $lista = $data["id_usuario_nivel"]."\t".$data["check_point_x"]."\t".$data["check_point_y"]."\t".
        $data["tiempo_nivel"]."\t".$data["numero_repeticion"]."\t".$data["puntuacion_nivel"]."\t".
        $data["numero_respuestas_fallidas"]."\t".$data["distancia_recorida"]."\t".$data["id_nivel"]."\n";
        $cadena = $cadena . $lista;
    }
    mysqli_close($con); 
    echo $cadena;
?>  