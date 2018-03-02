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
<?php include 'objects/head-insystem.php'; ?>
</head>
<body id="B" class="full">
<?php include 'objects/siderbar.php'; ?>

<!-- Page Header -->
<header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<?php include 'objects/insystem-navbar-left.php'; ?>
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
					<!-- automatically includes all the ads using php -->
					<?php
						$ads = preg_grep( '/^([^.])/', scandir( 'ads/' ) );
						foreach( $ads as $ad ) include $ad;
					?>
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