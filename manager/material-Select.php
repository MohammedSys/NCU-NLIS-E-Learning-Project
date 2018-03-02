<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../objects/head-meta.php'; ?>
<?php include '../objects/head-link-sub.php'; ?>
<link href="assets/css/simple-sidebar.css" rel="stylesheet">
<link href="assets/css/material-select.css" rel="stylesheet">
<!--Customized JS Codes-->
<script>
function resizeIframe(obj)
{
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	$('#iframe-parent').css("height", obj.style.height);
}
</script>
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

	<!-- Modal Message -->
	<?php include '../objects/modal.php'; ?>

</body>
</html>
