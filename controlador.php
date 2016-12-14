


<?php

    

    
    function insert_device($mac_address="", $matricula=""){
        
        $host = '192.168.69.18';
        $port = 22;
        $user = 'rys2016';
        $password = "2016RyS";
        
        if($ssh = ssh2_connect($host, $port)){
            
            ssh2_auth_none($ssh, $user);
            $stdio_stream = ssh2_shell($ssh);
            fwrite($stdio_stream,$user."\n"); 
            sleep(1); 
            fwrite($stdio_stream , $password."\n"); 
            sleep(1);
            $command = "config macfilter add ".$mac_address." 5 wl-labs ".$matricula;
            fwrite($stdio_stream , $command."\n"); 
            sleep(5);
            fwrite($stdio_stream,"logout \n");
            sleep(3);
            fwrite($stdio_stream,"y \n");
            sleep(1);
        }else{
            echo"No se conecto";
        }
    }
    
    
    function delete_device($mac_address=""){
        $host = '192.168.69.18';
        $port = 22;
        $user = 'rys2016';
        $password = "2016RyS";
        
        if($ssh = ssh2_connect($host, $port)){
            ssh2_auth_none($ssh, $user);
            $stdio_stream = ssh2_shell($ssh);
            fwrite($stdio_stream,$user."\n"); 
            sleep(1); 
            fwrite($stdio_stream , $password."\n"); 
            sleep(1);
            $command = "config macfilter delete ".$mac_address;
            fwrite($stdio_stream , $command."\n"); 
            sleep(5);
            fwrite($stdio_stream,"logout \n");
            sleep(3);
            fwrite($stdio_stream,"y \n");
            sleep(1);
        }else{
            echo"No se conecto";
        }
    
    
    

}

?>