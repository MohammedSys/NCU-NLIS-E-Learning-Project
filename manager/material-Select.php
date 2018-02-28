<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include("php/connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="Author" content="NCU ISQ Group 16">
		<meta name="Description" content="The manager interface of New Life Co. E-learning System.">
		<meta name="Creation-Date" content="01-Sep-2015 08:00">		
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<title>E-learning System</title>	
		<!--icon-->
		<link href="../assets/img/newlife_circle.png" rel="SHORTCUT ICON">
		<!--Bootstrap-->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="../assets/css/font-awesome.css">	
		
		<!--Customized CSS Settings-->
		<!-- fixed menu setting -->
		<link href="../assets/css/hippo.css" rel="stylesheet">
		<link href="assets/css/simple-sidebar.css" rel="stylesheet">
		<link href="assets/css/material-select.css" rel="stylesheet">
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	-->
		
		<!--Customized JS Codes-->
		<script type="text/javascript" src="assets/js/resize-iframe.js"></script>
	</head>

	<body>
		<div id="wrapper" class="toggled"><!-- Sidebar -->
	        <?php include 'manager-menu.php'; ?>
	        <?php include 'manager-header.php'; ?>
			<div class="container-fluid fixed center-view">
				<div class="row">	
					<div class="col-md-2 col-sm-4 selection-box">
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h4 class="text-danger">教材主題列表</h4>
						  </div>
						  <div class="panel-body">
						  <?php 						  	
						  	$formCounter = 1; //表單計數器，控制表單id	
						  	$sql = "SELECT DISTINCT subject FROM teachingMaterial";
							$result = mysql_query($sql);																			
							while( $row = mysql_fetch_row($result) ) {
								echo "<form id=\"form".$formCounter."\" class=\"form-horizontal\" target=\"iframe-material\" method=\"post\" action=\"material-View.php\">";
								echo "<input type=\"hidden\" name=\"subject\" value=\"".$row[0]."\" />";
								echo "<button class=\"btn btn-default\" type=\"submit\" form=\"form".$formCounter."\"><span class=\"glyphicon glyphicon-th-list\" > ".$row[0]."</span></button>";
								echo "</form>";
								//表單計數器+1
								$formCounter++;
							}
						  ?>			    
						  </div>
						</div><!--end of panel-->							
					</div>
					
					<!--<div class="col-md-10 col-sm-8 content-box">
						<div class="embed-responsive embed-responsive-4by3">
						  <iframe name="iframe-material" class="embed-responsive-item" src="material-View.php"></iframe>
						</div>
					</div>-->
					<div class="col-md-10 col-sm-8 iframe-box">
						<div id="iframe-parent" class="embed-responsive embed-responsive-hippo">
							<iframe id="iframe" name="iframe-material" class="embed-responsive-item" src="material-View.php" frameborder="1" onload='javascript:resizeIframe(this);'></iframe>
						</div>
					</div>
													
				</div><!--end of div row-->
			</div><!--end of div container-fluid-->			
		</div><!-- /#sidebar-wrapper -->
		
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-trigger.js"></script>
	</body>
</html>
