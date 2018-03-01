<?php session_start(); ?>
<?php
	include( "connection.php" );
	$username = $_POST['account'];
	$password = $_POST['password'];

	if( $username == null && $password == null ) errorLogin();

	$sql ="SELECT * FROM userAccount where username = '$username' and password = PASSWORD( '$password' )";
	$result = mysql_query($sql);

	$num = mysql_num_rows( $result );
	if( $num != 0 )
	{
		$row = @mysql_fetch_row($result);
		// if the user is manager, open the manager system
		if ( $row[ 1 ] == 1 ) echo '<meta http-equiv=REFRESH CONTENT=3;url=../manager/material-Select.php>';
		// otherwise, open the ordinary system
		else echo '<meta http-equiv=REFRESH CONTENT=3;url=../main.php>';
		$_SESSION['account'] = $username;
	}
	else errorLogin();

	function errorLogin()
	{
		echo '<meta http-equiv=REFRESH CONTENT=0;url=../relogin.php>';
	}
?>
<?php include '../objects/progressbar.php'; ?>