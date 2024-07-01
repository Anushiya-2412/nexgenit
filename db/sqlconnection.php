<?php

    // Local Server
        $host = "localhost"; $user = "root"; $pass = ""; $db = "db_cafe";
    
         

    $conn = mysqli_connect($host, $user, $pass, $db);
    if(mysqli_connect_errno())
     {
         echo mysqli_connect_errno();
         die();
     }

?>