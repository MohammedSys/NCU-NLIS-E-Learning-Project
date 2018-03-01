<?php
    include( "config.php" );

    // create connection
    $conn = mysql_connect( $servername, $username, $password );

    // check connection
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);

    if(!@mysql_select_db($db_name)) die("connect fail");
?>