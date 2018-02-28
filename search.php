<?php session_start(); ?>
<?php
	require 'php/permission.php';
	include("php/connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
?>
<?php
//PDFParser 預設載入項目
include 'assets/comps/search-engine/autoload.php';
// searching time limit
set_time_limit("600");
//get the searching keyword
$keyword = htmlspecialchars(trim($_GET["keyword"]));
$nokeyword = 0;
//check if keyword is empty
if ($keyword == "") {
	// echo "您的搜尋關鍵字不能為空";
	$nokeyword = 1;
	// exit(); 
}
//關鍵字比對function
function listFiles($dir,$keyword,&$resultArray){
	$handle = opendir($dir);
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != "..") {
			//如果是資料夾，遞迴呼叫function listFile	
			if (is_dir("$dir/$file")) {
				listFiles("$dir/$file",$keyword,$resultArray);
			}
			//如果是檔案
			else {
				//組合檔案路徑(含檔名)
				$dirFile = $dir.'/'.$file;
				//建立PDFParser必要物件，讀取PDF內容
				$parser = new \Smalot\PdfParser\Parser();
				//PDFParser讀取PDF內容
				$pdf = $parser->parseFile($dirFile);
				//取得PDF內的文字
				$pdfText = htmlspecialchars($pdf->getText());				
				//取得文字與關鍵字進行比對
				if (preg_match("/$keyword/i",$pdfText)) {
					//關鍵字吻合，比對檔案路徑，從中擷取主題與章節
					if (preg_match("/assets\/tms\/(.+)\/Chapter-(.+)-slide\.pdf/", $dirFile,$res)) {
						$searchSubject = $res[1];
						$searchChapter = $res[2];
						$classDir = $res[1].'/Chapter-'.$res[2].'-slide.pdf';
					}
					//將檔案路徑、主題、章節、名稱存入resultArray陣列，章節敘述存入description陣列
					$resultArray[] = "$searchSubject $searchChapter $classDir";
				}//end of comparising
				//消滅PDFParser所用的變數
				unset($parser);	
				unset($pdf);	
				unset($pdfText);	
			}//end of if is_dir else
		}
	}
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
		<link href="assets/img/newlife_circle.png" rel="SHORTCUT ICON">
		
		<!--Bootstrap-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="assets/css/font-awesome.css">
		
		<!--Customized CSS Settings-->
		<link rel="stylesheet" href="assets/css/hippo.css">
		<link rel="stylesheet" href="assets/css/sidebar.css">
		<link rel="stylesheet" href="assets/css/main-menu.css">
		<link rel="stylesheet" href="assets/css/search.css">
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
			<div id="content" class="margin-t-60">
				<?php
					if($nokeyword == 1)
					{
						echo "<h2>您的搜尋關鍵字不能為空</h2>";
						exit();
					}
					
					//比對關鍵字function結果儲存於此陣列
					$resultArray = array();
					//呼叫比對關鍵字function
					listFiles("./assets/tms",$keyword,$resultArray);	
					//變數i紀錄搜尋筆數
					$i = 1;
					//如果搜尋有吻合資料					
					foreach($resultArray as $value){				
					//拆開陣列值，分別取得路徑、主題、章節
					list($searchSubject,$searchChapter,$classDir) = split("[ ]",$value,3);   							   
					//連結資料庫，以搜尋到的主題章節路徑，去資料庫撈取教材敘述
					$sql = "SELECT descript,title FROM teachingMaterial WHERE subject = '$searchSubject' AND chapter = '$searchChapter'";
					$materialResult = mysql_query($sql);
					$descriptRow = mysql_fetch_row($materialResult);
					//输出					   
					echo "<div class=\"search-result\">";
					// echo "<div class=\"table-td\">第".$i."筆</div>";
					echo "<div class=\"title\">";	
					echo "<form method=\"post\" action=\"classroom.php\">";
					echo "<input class=\"custom-input\" value=\"".$descriptRow[1]."\" type=\"submit\" name=\"submit\" />";
					echo "<input value =\"$classDir\" type=\"hidden\" name=\"chapter\" />";
					echo "</form></div>";
					echo "<div class=\"came-from\">";
					echo "<div class=\"theme\">$searchSubject</div>";
					echo "<div class=\"chapter\">Chapter-$searchChapter</div>";
					echo "</div>";
					echo "<div class=\"abstract\">".$descriptRow[0]."</div>";
					// if ($description[$i-1] != null && $description[$i-1] != "Array") {
						// echo "<div class=\"abstract\">".$description[$i-1]."</div>";
					// }					
					echo "</div>";
					unset($materialResult);
					unset($descriptRow);
					// $i++;
					}// end of foreach
					//如果搜尋無吻合資料 
					if ($resultArray[0] == null) {
						echo "<h2>查無結果</h2>";
					}
					
					echo "<script type=\"text/javascript\">
							$(document).ready( function ()
							{
								document.getElementById('searchInput').value = \"$keyword\";
							});</script>";								
				?>
			</div>
			
			<!-- Footer -->
			<!--<footer>
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
							<ul class="list-inline text-center">
								<li><a class="transparent-btn" href="http://vivialife.com/TW/" target="_blank">好日子購物網</a>
								</li>
								<li><a class="transparent-btn" href="http://www.sci.org.tw/" target="_blank">脊髓新樂園</a>
								</li>
								<li><a class="transparent-btn" href="http://www.sci.org.tw/" target="_blank">脊髓損傷潛能發展中心</a>
								</li>
							</ul>
						</div>
					</div>
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
			</footer>-->
		</div>
	</body>
</html>