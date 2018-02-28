<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$servername = "localhost";
$username = "";
$password = "";
$db_name = "";

// Create connection
$conn = mysql_connect($servername,$username,$password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!@mysql_select_db($db_name))
        die("connect fail"); 
?>