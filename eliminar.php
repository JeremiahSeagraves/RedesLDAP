<?php

 include 'ConexionBD.php';
  
    if($_POST["1"]){
         $MAC= $_COOKIE['mac1'];
    }else if($_POST["2"]){
        $MAC= $_COOKIE['mac2'];
    }else{
         $MAC= $_COOKIE['mac3'];
    }
   
    $conexion = conectarBD();
    $query ="delete from usuarios where MAC = '$MAC'";
    mysqli_query($conexion, $query);
   
    
    include 'controlador.php';
    delete_device($MAC);
?>
