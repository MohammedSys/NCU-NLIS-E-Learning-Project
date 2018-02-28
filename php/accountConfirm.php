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
	else errorLogin();

	function errorLogin()
	{
		echo '<meta http-equiv=REFRESH CONTENT=0;url=../relogin.php>';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="Author" content="NCU IM Group 16">
		<meta name="Description" content="This is a learning system to help the members of New Life Co. learn how to write webpages.">
		<meta name="Creation-Date" content="01-Sep-2015 08:00">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>E-learning System</title>
		
		<!--icon-->
		<link href="assets/img/favicon.ico" rel="SHORTCUT ICON">
		
		<!--Bootstrap-->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="../assets/css/font-awesome.css">
		
		<!--Customized CSS Settings-->
		<link rel="stylesheet" href="../assets/css/hippo.css">
		<link rel="stylesheet" href="../assets/css/progress-bar.css">
		<style>
			
		</style>
	</head>
	
	<body class="full">
		
		<!-- Main Content -->
		<div id="content margin-t-60">
			<div class="p-box">
				<div class="loader">Loading...</div>
			</div>
		</div>
	</body>
</html>