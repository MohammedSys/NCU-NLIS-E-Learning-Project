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
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="Author" content="NCU IM Group 16">
		<meta name="Description" content="This is a learning system to help the members of New Life Co. learn how to write webpages.">
		<meta name="Creation-Date" content="01-Sep-2015 08:00">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>E-learning System</title>
		
		<!--icon-->
		<link href="assets/img/newlife_circle.png" rel="SHORTCUT ICON">
		
		<!--Bootstrap-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="assets/css/font-awesome.css">
		
		<!--Customized CSS Settings-->
		<link rel="stylesheet" href="assets/css/hippo.css">
		<link rel="stylesheet" href="assets/css/sidebar.css" >
		<link rel="stylesheet" href="assets/css/main-menu.css" >
		<link rel="stylesheet" href="assets/css/slideshow.css">
		<link rel="stylesheet" href="assets/css/exam-selection.css">
		<style>
		</style>
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-toggled.js"></script>
		<script>
			
		</script>
	</head>
	
	<body id="B" class="full">
		<?php include 'objects/siderbar.php'; ?>
		
		<!-- Page Header -->
		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div id="logo_printer">
							<table class="a-hover txt-white" border="0" cellspacing="0" cellpadding="0">
								<tr id="left-menu-toggle">
									<a href="#left-menu"></a>
									<td><img alt="Brand" class="brand-icon" src="assets/img/newlife_circle.png"></td>
									<td width="40px"><div class="systemname"><span class="glyphicon glyphicon-menu-hamburger"></span></div></td>
								</tr>
							</table>
						</div>
					</div>
						
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php include 'objects/insystem-nav.php'; ?>
						<?php include 'objects/insystem-nav-link.php'; ?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		
		<!-- Page Content -->
		<div id="page-content-wrapper">
			<!-- Main Content -->
			<div id="content">
				<div class="margin-t-60">
					<h2>選擇考題</h2>
					<p class="title-p">章節練習：依章節區分的練習題</p>
					<p class="title-p">綜合練習：結合數個章節所學的練習題</p>
				</div>
				<?php 
					$sql = "SELECT DISTINCT subject FROM questionBase";
					$result = mysql_query($sql);
   					// $row = mysql_fetch_row($result);
					//第一層迴圈擷取課程主題
					while ($row = mysql_fetch_row($result)) {
						echo "<div class=\"section-div\">";	
						echo "<h2>".$row[0]."</h2>";
						echo "<div class=\"inner-section-div\">";
						echo "<span>章節練習</span>";
						echo "<ul class=\"list-inline text-center margin-t-5 margin-b-5\">";		
						//內層迴圈擷取章節習題
						$q1 = "SELECT DISTINCT chapter FROM questionBase WHERE subject = '$row[0]' AND type = 'chapter' ORDER BY CAST(chapter AS UNSIGNED)";
						$resultCh = mysql_query($q1);
						// $rowCh = mysql_fetch_row($resultCh);
						while ($rowCh = mysql_fetch_row($resultCh)) {
							echo "<li><form method =\"post\" action=\"exam.php\">
								  <input class=\"red-filled-input\" type=\"submit\" name=\"chapterSubmit\" value=\"Ch. ".$rowCh[0]."\" />
								  <input type=\"hidden\" name=\"send\" value=\"".$rowCh[0]."\" />
								  <input type=\"hidden\" name=\"getSubject\" value=\"".$row[0]."\" />
								  <input type=\"hidden\" name=\"type\" value=\"chapter\" />
								  </form></li>";
						}					
						echo "</ul><br /><span>綜合練習</span><br />";
						echo "<ul class=\"list-inline text-center margin-t-5\">";
						//內層迴圈擷取章節習題
						$q2 = "SELECT DISTINCT chapter FROM questionBase WHERE subject = '$row[0]' AND type = 'mix' ORDER BY chapter";
						$resultCh = mysql_query($q2);
						// $rowCh = mysql_fetch_row($resultCh);
						while ($rowCh = mysql_fetch_row($resultCh)) {
							echo "<li><form method =\"post\" action=\"exam.php\">
								  <input class=\"red-filled-input\" type=\"submit\" name=\"chapterSubmit\" value=\"Ch. ".$rowCh[0]."\" />
								  <input type=\"hidden\" name=\"send\" value=\"".$rowCh[0]."\" />
								  <input type=\"hidden\" name=\"getSubject\" value=\"".$row[0]."\" />
								  <input type=\"hidden\" name=\"type\" value=\"mix\" />
								  </form></li>";
						}
						echo "</ul><br /></div></div>";
					}//end of outer foreach
				?>
			</div>
			
			<!-- Footer -->
			<footer>
				<div class="container">
					<div class="row row-margin">
						<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
							<ul class="list-inline text-center">
								<li><a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/nlishsinchu?hc_location=stream" target="_blank">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
							</ul>
							<p class="copyright">Copyright &copy; ISQ Lab. NCU 2015</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</body>
</html>