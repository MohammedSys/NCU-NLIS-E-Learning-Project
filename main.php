<?php session_start(); ?>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<?php 
	require 'php/permission.php';
	include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head.php'; ?>
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
			<!--<div class="container-fluid">-->
			<!--<div class="row-fluid">-->
			<!--<div class="span12">-->
			<div class="slideshow-main">		
				<div class="carousel slide" id="myCarousel">
					<div class="carousel-inner">
			
						<div class="item active">
						
							<div class="bannerImage">
								<a href="#"><img src="assets/img/mslide01.png" alt=""></a>
							</div>
										
							<div class="caption row-fluid">
								<div class="span4"><h3>新課程上線！<br /><br />CSS3 基礎課程</h3></div>                	
								<!--<div class="span8"><p>層疊樣式表（英語：Cascading Style Sheets，簡寫CSS），又稱串樣式清單、級聯樣式表、串接樣式表、層疊樣式表、階層式樣式表，一種用來為結構化文件（如HTML文件或XML應用）添加樣式（字型、間距和顏色等）的電腦語言。本課程希望藉由程式碼與實際執行結果，讓同學能更加容易上手！</p></div>-->
							</div>
						</div><!-- /Slide1 -->
			
						<div class="item">
						
							<div align="center" class="bannerImage">
								<a href="#"><img src="assets/img/mslide02.png" alt=""></a>
							</div>
										
							<div class="caption row-fluid">
								<div class="span4"><h3>新課程預告：<br /><br />JavaScript 基礎課程</h3>
									<!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
								</div>                	
								<!--<div class="span8"><p><br />JavaScript，一種直譯式程式語言，是一種動態型別、基於原型的語言，內建支援類別。它的直譯器被稱為 JavaScript引擎，為瀏覽器的一部分，廣泛用於用戶端的腳本語言，最早是在HTML網頁上使用，用來給 HTML網頁增加動態功能。在設計動態網頁時，必定會使用 JS，這也使得 JS 同樣為撰寫網頁必備的技能之一。</p></div>-->
							</div>
																	
						</div><!-- /Slide2 -->
					</div>
					
					<div class="control-box">                            
						<a data-slide="prev" href="#myCarousel" class="carousel-control left"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
						<a data-slide="next" href="#myCarousel" class="carousel-control right"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
					</div><!-- /.control-box -->   
										
				</div><!-- /#myCarousel -->
			</div>
		</div>
		
		<!--<div class="container">-->
		<div class="row well recent margin-t-10">
			<h3>最近瀏覽課程</h3>
			<?php
				$name = $_SESSION['account'];
				$sql = "SELECT classURL FROM userReview WHERE name = '$name'";
				$result = mysql_query($sql);
				$ifnone = 1;
				$form_counter = 1; 
				while ( $classRow = mysql_fetch_row($result) ) 
				{
						if (preg_match("/(.+)\/Chapter-(.+)-slide\.pdf/",$classRow[0],$res))
						{
							$subject = $res[1];
							$recordChapter = $res[2];
						}	
						echo "<div class=\"recent-btn\"><form id=\"form".$form_counter."\" method=\"post\" action=\"classroom.php\">
								<input type=\"hidden\" name=\"chapter\" value=\"".$classRow[0]."\" />
								<button class=\"btn btn-danger\" type=\"submit\" form=\"form".$form_counter."\" >".$subject." Ch. ".$recordChapter."</button>
							</form></div>";
							
						$ifnone = 0;
						$form_counter++;					
				}
				// If $ifnone is equal to 5, that means recently there are no record of this user about recently viewed courses.
				if( $ifnone == 1 )
				{
					echo "<hr width=\"95%\" /><h4>目前無紀錄</h4>";
				}
				
				// $ifnone = 0;							
				// for ($i=0; $i < 5; $i++) 
				// {
// 						
					// if ($_SESSION['chapterFrquency'][$i] != null) {
						// $frequency = $_SESSION['chapterFrquency'][$i];
						// if (preg_match("/(.+)\/Chapter-(.+)-slide\.pdf/",$frequency,$res))
						// {
							// $subject = $res[1];
							// $recordChapter = $res[2];
						// }
// 							
						// echo "<div class=\"col-md-1 recent-btn\"><form id=\"form".$i."\" method=\"post\" action=\"classroom.php\">
								// <input type=\"hidden\" name=\"chapter\" value=\"".$frequency."\" />
								// <button class=\"btn btn-danger\" type=\"submit\" form=\"form".$i."\" >".$subject." Ch. ".$recordChapter."</button>
							// </form></div>";
					// }
					// else{ $ifnone++; }
				// }
				// If $ifnone is equal to 5, that means recently there are no record of this user about recently viewed courses.
				// if( $ifnone == 5 )
				// {
					// echo "<hr width=\"95%\" /><h4>目前無紀錄</h4>";
				// }
			?>
		</div>
		<!--</div>-->
		
		<!-- Footer -->
		<?php include 'objects/footer.php'; ?>
	</div>
</body>
</html>