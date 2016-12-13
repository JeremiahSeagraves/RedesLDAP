<html>
    <head>
    </head>
    <body>
        <?php
// specify the LDAP server to connect to
        $ldaphost = '148.209.67.42';  // servidor LDAP
        $ldapport = 389;                 // puerto del servidor LDAP

        $conn = ldap_connect($ldaphost, $ldapport) or die("Could not connect to {$ldaphost}");

        $usuario = $_POST['matricula'];
        $contrasenia = $_POST['password'];

// bind to the LDAP server specified above

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        $bind = @ldap_bind($conn, $usuario . "@inet.uady.mx", $contrasenia);

        if ($bind) {
            $filter = "(sAMAccountName=$usuario)";

            $result = ldap_search($conn, "ou=Facultad de Matematicas, ou=INET, dc=inet, dc=uady, dc=mx", $filter) or die("Error in search
query");

// get entry data as array
            ldap_sort($conn, $result, "n");
            $info = ldap_get_entries($conn, $result) or die("No hay entradas");
// iterate over array and print data for each entry
            for ($i = 0; $i < $info["count"]; $i++) {
                echo "dn is: " . $info[$i]["dn"] . "<br>";
                echo "first cn is: " . $info[$i]["cn"][0] . "<br>";
                echo "first email address is: " . $info[$i]["mail"][0] . "<p>";
            }
// print number of entries found
            echo "Number of entries found: " . ldap_count_entries($conn, $result) . "<p>";
        }else{
            $msg = "Invalid email address / password";
            echo $msg;
        }

// all done? clean up
        ldap_close($conn);
        ?>
    </body>
</html>

