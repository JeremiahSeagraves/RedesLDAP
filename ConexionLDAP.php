<html>
    <head>
    </head>
    <body>
        <?php

        function conectarse() {


            // specify the LDAP server to connect to
            $ldaphost = '148.209.67.42';  // servidor LDAP
            $ldapport = 389;                 // puerto del servidor LDAP

            $conn = ldap_connect($ldaphost, $ldapport) or die("Could not connect to {$ldaphost}");
            return $conn;
        }

        function validar($connection,$usuario,$contrasenia) {
            

// bind to the LDAP server specified above

            ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($connection, LDAP_OPT_REFERRALS, 0);

            $bind = @ldap_bind($connection, $usuario . "@inet.uady.mx", $contrasenia);
            return $bind;
        }

        function obtenerDatosUsuarioValidado($connection,$usuario) {
            $filter = "(sAMAccountName=$usuario)";
            $result = ldap_search($connection, "ou=Facultad de Matematicas, ou=INET, dc=inet, dc=uady, dc=mx", $filter) or die("Error in search
query");

            $info = ldap_get_entries($connection, $result) or die("No hay entradas");


            return $info;
        }
        ?>
    </body>
</html>


