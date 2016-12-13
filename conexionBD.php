<?php
function conectarBD(){
    if(!($link=  mysql_connect("171.16.69.105", "root", "2016rys#."))){
        echo "Error conectando a la base de datos";
        exit();
    }
    if(!mysql_select_db("dispositivos",$link)){
        echo "Error seleccionando la base de datos";
        exit();
    }
    return $link;
}
?>
