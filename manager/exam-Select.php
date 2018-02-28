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
		<!-- fixed menu setting -->
		<link href="../assets/css/hippo.css" rel="stylesheet">
		<link href="assets/css/simple-sidebar.css" rel="stylesheet">
		<!--Customized CSS Settings-->
		<link href="assets/css/exam-Select.css" rel="stylesheet">
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	
		
	</head>

	<body>
		<div id="wrapper" class="toggled"><!-- Sidebar -->
	        <?php include 'manager-menu.php'; ?>
	        <?php include 'manager-header.php'; ?>	        
			<div class="container-fluid fixed">
				<div class="row">
					<div id="selectDiv" class="col-md-2">
						<div class="panel panel-default">
							<div class="panel-heading">
						    	<h4 class="text-danger">考題主題列表</h4>
						  	</div>
						  	<div class="panel-body"> <!--迴圈印出考題樹狀瀏覽選單-->
						  		<?php 
									echo "<div class=\"panel-group\" id=\"outside-group\" role=\"tablist\" aria-multiselectable=\"true\">";
									$sql = "SELECT DISTINCT subject FROM questionBase";
									$result = mysql_query($sql);	
									//第一層迴圈擷取課程主題
									while ( $subjectArray = mysql_fetch_row($result) ) {
										echo "<div class=\"panel panel-default\">";
										
										echo "<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#outside-group\" href=\"#subject".$subjectArray[0]."Content\" aria-expanded=\"false\" aria-controls=\"subject".$subjectArray[0]."Content\">";
										echo "<div class=\"panel-heading panel-heading-customized\" role=\"tab\" id=\"subject".$subjectArray[0]."Heading\">";
										echo "<h4 class=\"panel-title\">";
										echo "<span class=\"glyphicon glyphicon-folder-close\" aria-hidden=\"true\"></span> ".$subjectArray[0];
									    echo "</h4></div></a>"; 
										
										echo "<div id=\"subject".$subjectArray[0]."Content\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"subject".$subjectArray[0]."Heading\">";
										echo "<div class=\"panel-body\">"; //第二內層開始
										echo "<div class=\"panel-group\" id=\"".$subjectArray[0]."typeGroup\" role=\"tablist\" aria-multiselectable=\"true\">";
										echo "<div class=\"panel panel-default\">";
										
										echo "<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#".$subjectArray[0]."typeGroup\" href=\"#".$subjectArray[0]."chapterContent\" aria-expanded=\"false\" aria-controls=\"".$subjectArray[0]."chapterContent\">";
										echo "<div class=\"panel-heading panel-heading-customized\" role=\"tab\" id=\"".$subjectArray[0]."chaptertypeHeading\">";
										echo "<h4 class=\"panel-title\">";
										echo "<span class=\"glyphicon glyphicon-folder-close\" aria-hidden=\"true\"></span>	 章節習題";
									    echo "</h4></div></a>";
										
										echo "<div id=\"".$subjectArray[0]."chapterContent\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"".$subjectArray[0]."chaptertypeHeading\">";
										echo "<div class=\"panel-body\">";
										//內層迴圈擷取章節習題中的考試章節
										$sql1 ="SELECT DISTINCT chapter FROM questionBase WHERE subject = '$subjectArray[0]' AND type = 'chapter' ORDER BY chapter";
										$innerResult = mysql_query($sql1);
										while ( $chapterArray = mysql_fetch_row($innerResult) ) {
											echo "<form method =\"post\" target=\"iframe-exam\" action=\"exam-View.php\">";
											echo "<span class=\"glyphicon glyphicon-file\" aria-hidden=\"true\"></span><input type=\"submit\" class=\"btn btn-default btn-xs\" value=\"Ch".$chapterArray[0]."\" />";
											echo "<input type=\"hidden\" name=\"type\" value=\"chapter\"/>";
											echo "<input type=\"hidden\" name=\"subject\" value=\"$subjectArray[0]\"/>";
											echo "<input type=\"hidden\" name=\"chapter\" value=\"$chapterArray[0]\" />";
											echo "</form>";
										}
										echo "</div></div></div>";
										echo "<div class=\"panel panel-default\">";
										
										echo "<a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"".$subjectArray[0]."typeGroup\" href=\"#".$subjectArray[0]."mixContent\" aria-expanded=\"false\" aria-controls=\"".$subjectArray[0]."mixContent\">";
										echo "<div class=\"panel-heading panel-heading-customized\" role=\"tab\" id=\"".$subjectArray[0]."mixHeading\">";
										echo "<h4 class=\"panel-title\">";
										echo "<span class=\"glyphicon glyphicon-folder-close\" aria-hidden=\"true\"></span>  綜合習題";
									    echo "</h4></div></a>";
										
										echo "<div id=\"".$subjectArray[0]."mixContent\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"".$subjectArray[0]."mixHeading\">";
										echo "<div class=\"panel-body\">";
										$sql2 ="SELECT DISTINCT chapter FROM questionBase WHERE subject = '$subjectArray[0]' AND type = 'mix' ORDER BY chapter";
										$innerResult = mysql_query($sql2);
										while ($chapterArray = mysql_fetch_row($innerResult)) {
											echo "<form method =\"post\" target=\"iframe-exam\" action=\"exam-View.php\">";
											echo "<span class=\"glyphicon glyphicon-file\" aria-hidden=\"true\"></span><input type=\"submit\" class=\"btn btn-default btn-xs\" value=\"Ch".$chapterArray[0]."\" />";
											echo "<input type=\"hidden\" name=\"type\" value=\"mix\"/>";
											echo "<input type=\"hidden\" name=\"subject\" value=\"$subjectArray[0]\"/>";
											echo "<input type=\"hidden\" name=\"chapter\" value=\"$chapterArray[0]\" />";
											echo "</form>";
										}
										echo "</div></div></div></div>"; //end of inner body,content,panel,group
										echo "</div></div></div>"; //end of ouside body,content,panel
									}
									echo "</div>"; //end of groupPanel
								?>
						  	</div>
						</div>
					</div> <!--end of examInfo div-->
					<div id="resultDiv" class="col-md-10">
						<div class="embed-responsive embed-responsive-4by3">
						  <iframe name="iframe-exam" class="embed-responsive-item" src="exam-View.php"></iframe>
						</div>
					</div>
				</div> <!--end of row-->
			</div>	<!--end of container-fluid-->				     
	    </div><!-- /#sidebar-wrapper -->
		
		<!-- Menu Toggle Script -->
	    <script type="text/javascript" src="assets/js/menu-trigger.js"></script>
	</body>
</html>
