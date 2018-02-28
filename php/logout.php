<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
unset($_SESSION['account']);
echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
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
			<div class="loader">Loading...</div>
		</div>
	</body>
</html>