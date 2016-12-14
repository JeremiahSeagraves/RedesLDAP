<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    </head>
    <body>
        <?php
        include 'ConexionLDAP.php';

        $usuario = $_POST['matricula'];
        $contrasenia = $_POST['password'];
        setcookie("usuario",$usuario);

        $conexion = conectarse();
        if (!validar($conexion, $usuario, $contrasenia)) {
            header("Location:index.html");
        }
        $info = obtenerDatosUsuarioValidado($conexion, $usuario);


        for ($i = 0; $i < $info["count"]; $i++) {
            $nombreUsuario = $info[$i]["cn"][0];
        }
        ?>

    <center>
        <h1>Bienvenido a la Facultad de Matematicas</h1>
    </center>
    <div class="container">	
        <form>
              <div class="form-group">
                <label for="formGroupInput">Nombre:</label>
                <input type="text" name="nombre" class="form-control" id="nombreGroupInput" value="<?php echo $nombreUsuario; ?>" disabled="true">
            </div>
            <div class="form-group">
                <label for="formGroupInput2">Matricula:</label>
                <input type="text" name="matricula" class="form-control" id="matriculaInput" value="<?php echo $usuario; ?>" disabled="true">
            </div>
        </form>
    </div>


    <div class="container">
        <form class="form-inline" action="registrarMacAdress.php" method="POST">
            <h3>Registre su dispositivo</h3>
            
            <div class="form-group">
                <label class="sr-only" for="inputMac">Mac</label>
                <input type="text" class="form-control" id="inputMac" name="inputMac" placeholder="Introduzca su Mac Adress">   
            </div>
            <br>
            
            <div class="form-group">
                <label class="sr-only" for="inputTipo">Tipo</label>
                <input type="text" class="form-control" id="inputTipo" name="inputTipo" placeholder="Tipo de Dispositivo">   
            </div>
            <div class="form-group">
                <label class="sr-only" for="inputMarca">Marca</label>
                <input type="text" class="form-control" id="inputMarca" name="inputMarca" placeholder="Marca de Dispositivo">   
            </div>
            <br> <br>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
<?php
include 'ConexionBD.php';
$enlace = conectarBD();
$listaDispositivos = mysqli_query( $enlace,"select * from usuarios where Matricula = '$usuario'");

?>
    <div class="container">
        <h2>Dispositivos Registrados</h2>
        <table class="table table-bordered" align="center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mac Adress</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php $numero=0; while ($row = mysqli_fetch_array($listaDispositivos)){;?>
                <tr>
                    <th scope="row"><?php echo ++$numero?></th>
                    <td><?php echo $row["MAC"];?> </td>
                    <td><?php echo $row["Tipo"];?> </td>
                    <td><?php echo $row["Marca"];?> </td>
                    <td>
                        <form action="eliminar.php" method="POST">
                            <?php $name = "mac".$numero; setcookie($name,$row["MAC"]);?>
                            <input type="submit" name="<?php echo $numero;?>" value="Eliminar" class="btn btn-primary"/>
                        
                        </form>
                    </td>
                    
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<!--    <script>
                  function foo() {
                      $.ajax({
                          url: "getMacAdress.php",
                          type: "POST",
                          success: function (result) {
                              alert(result);
                          },
                          error: function () {
                              alert('Error');
                          }
                      });
                  }
    </script>-->

    <script>
        function agregarDisp() {
            $.ajax({
                type:"POST",
                url:"registrarMacAdress.php",
                data:{mac:document.getElementById("inputMac").value, 
                matricula:document.getElementById("matriculaInput").value,
                tipo:$("tipo").text(),
                marca:document.getElementById("inputMarca").value},
                success:function(){
                    alert("Exito");
                },
                error:function(){
                    alert("Error");
                }
            });
            alert("Hola")
        };
    </script>
</body>
</html>

