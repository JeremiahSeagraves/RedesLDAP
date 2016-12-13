<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    </head>
    <body>
        <?php
        include 'ConexionLDAP.php';

        $usuario = $_POST['matricula'];
        $contrasenia = $_POST['password'];

        $conexion = conectarse();
        if (!validar($conexion, $usuario, $contrasenia)) {
            header("Location:index.html");
        }

        $info = obtenerDatosUsuarioValidado($conexion, $usuario);


        for ($i = 0; $i < $info["count"]; $i++) {
            $nombreUsuario = $info[$i]["cn"][0];
            $matriculaUsuario = $info[$i]["mail"][0];
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
                <label for="formGroupInput2">Correo:</label>
                <input type="text" name="correo" class="form-control" id="matriculaExampleInput" value="<?php echo $matriculaUsuario; ?>" disabled="true">
            </div>
        </form>
    </div>


    <div class="container">
        <h3>Registre su dispositivo</h3>
        <form class="form-inline">
            <div class="form-group">
                <label class="sr-only" for="inputMac">Mac</label>
                <input type="text" class="form-control" id="inputMac" name="inputMac" placeholder="Introduzca su Mac Adress">
                <button type="submit" class="btn btn-secondary" onclick="foo()">Determinar Mac Adress</button>    
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seleccione su Dispositivo
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                </div>
            </div>

            <button type="button" class="btn btn-primary">Agregar</button>
        </form>
    </div>
<?php
include 'ConexionBD';
$enlace = conectarBD();
$listaDispositivos = mysql_query("select * from usuarios where Matricula = $usuario", $link);

?>
    <div class="container">
        <h2>Dispositivos Registrados</h2>
        <table class="table table-bordered" align="center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mac Adress</th>
                    <th>Dispositivo</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysql_fetch_array($result)){ $numero=0;?>
                <tr>
                    <th scope="row"><?php echo $numero;?></th>
                    <td><?php echo $row["MAC"];?> </td>
                    <td><?php echo $row["Tipo"];?> </td>
                    <td><?php echo $row["Marca"];?> </td>
                    <td>
                        <a class="btn btn-primary" href="#" role="button" onclick="eliminarDisp()">Eliminar</a>
                    </td>
                </tr>
                <?php $numero++;}?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    <script>
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
    </script>

    <script>
        function eliminarDisp() {
            alert("Hola");
        }
    </script>
</body>
</html>

