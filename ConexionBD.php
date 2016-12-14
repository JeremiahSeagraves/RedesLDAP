<?php
function conectarBD(){
    $link=mysqli_connect("localhost", "root", "2016rys#.","dispositivos");
       
    if(!$link){
        echo "Error conectando a la base de datos";
        exit();
    }
    return $link;
}
?>
