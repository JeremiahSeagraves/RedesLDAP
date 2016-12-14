<?php
    
    include 'ConexionBD.php';
    $MAC= $_POST['inputMac'];
    $marca= $_POST['inputMarca'];
    $matricula= $_COOKIE['usuario'];
    $tipo =$_POST['inputTipo'];
    $conexion = conectarBD();
    
    $query_count = "SELECT * FROM usuarios WHERE Matricula = $matricula";
    $result = mysqli_query($conexion, $query_count);
    $count = sizeof($arreglo = mysqli_fetch_array($result));
    
    if($count["CANTIDAD"]<3){
        $query_insert ="insert into usuarios (Matricula,MAC,Tipo,Marca) values ('$matricula','$MAC','$tipo','$marca')";
        mysqli_query($conexion, $query_insert);

        include 'controlador.php';
        insert_device($MAC, $matricula);
    }else{
        echo("Haz registrado el número máximo de dispositivos. Elimina alguno para poder registrar uno nuevo");
    }
    
    
   
    
    
    
?>

