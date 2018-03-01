<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include("connection.php");
	$username = $_POST['account'];
	$password = $_POST['password'];

	if( $username == null && $password == null ) errorLogin();

	$sql ="SELECT * FROM userAccount where name = '$username' and password = PASSWORD( '$password' )";
	$result = mysql_query($sql);

	if( $row = @mysql_fetch_row($result) )
	{
		// if the user is manager, open the manager system
		if ( $row[ 2 ] ) echo '<meta http-equiv=REFRESH CONTENT=3;url=../manager/material-Select.php>';
		// otherwise, open the ordinary system
		else echo '<meta http-equiv=REFRESH CONTENT=3;url=../main.php>';
		$_SESSION['account'] = $username;
	}
	// else errorLogin();

	function errorLogin()
	{
		echo '<meta http-equiv=REFRESH CONTENT=0;url=../relogin.php>';
	}
?>
<?php include '../objects/progressbar.php'; ?>