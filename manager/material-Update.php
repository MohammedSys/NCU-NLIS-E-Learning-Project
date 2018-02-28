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
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	-->
	</head>

	<body>
		<div class="page-header">
			<h2 class="text-primary">教材資訊更新 <small>請依欄位輸入相關資料</small></h2>
		</div>
		<div>			
			<form id="materialForm" class="form-horizontal" method="post" enctype="multipart/form-data" action="php/material-Update-process.php">
			<?php 
				$subject = $_POST['subject'];
				$chapterArray = $_POST['chapter'];
				$count = 1; //更新欄位的input name編號
				foreach ($chapterArray as $chapter) {
					//資料庫取出原本的教材資料，印在對應欄位中作為預設值
					$sql = "SELECT * FROM teachingMaterial WHERE subject = '$subject' AND chapter = '$chapter'";
					$result = mysql_query($sql);
					$row = mysql_fetch_row($result);
					//一筆資料開頭的div	
					echo "<div>";
					//教材主題
					echo "<div class=\"form-group\">";
					echo "<label for=\"subjectInput".$count."\" class=\"col-md-2 control-label\">教材主題名稱:</label>";
					echo "<div class=\"col-md-10\">";
					echo "<input id=\"subjectInput".$count."\" class=\"form-control\" type=\"text\" name=\"subject".$count."\" value=\"".$row[1]."\" required />";
					echo "<input name=\"pre-subject".$count."\" type=\"hidden\" value=\"".$row[1]."\">";
					echo "<span class=\"help-block\">輸入教材主題。 ex:CSS</span></div></div>";
					//教材章節
					echo "<div class=\"form-group\">";
					echo "<label for=\"chapterInput".$count."\" class=\"col-md-2 control-label\">教材章節:</label>";
					echo "<div class=\"col-md-10\">";
					echo "<input id=\"chapterInput".$count."\" class=\"form-control\" min=\"0\" type=\"number\" name=\"chapter".$count."\" value=\"".$row[2]."\" required />";
					echo "<input name=\"pre-chapter".$count."\" type=\"hidden\" value=\"".$row[2]."\">";
					echo "<span class=\"help-block\">輸入教材章節，請輸入純數字。</span></div></div>";
					//教材標題
					echo "<div class=\"form-group\">";
					echo "<label for=\"titleInput".$count."\" class=\"col-md-2 control-label\">教材標題:</label>";
					echo "<div class=\"col-md-10\">";
					echo "<input id=\"titleInput".$count."\" class=\"form-control\" type=\"text\" name=\"title".$count."\" value=\"".$row[3]."\" required />";
					echo "<span class=\"help-block\">輸入教材標題，無須包含章節與主題。</span></div></div>";
					//教材簡介
					echo "<div class=\"form-group\">";
					echo "<label for=\"introInput".$count."\" class=\"col-md-2 control-label\">教材簡介:</label>";
					echo "<div class=\"col-md-10\">";
					echo "<input id=\"introInput".$count."\" class=\"form-control\" type=\"text\" name=\"intro".$count."\" value=\"".$row[4]."\" required />";
					echo "<span class=\"help-block\">輸入簡短的教材簡介，將用於首頁的教材介紹。</span></div></div>";
					//教材敘述
					echo "<div class=\"form-group\">";
					echo "<label for=\"descriptInput".$count."\" class=\"col-md-2 control-label\">教材敘述:</label>";
					echo "<div class=\"col-md-10\">";
					echo "<textarea id=\"descriptInput".$count."\" class=\"form-control\" form=\"materialForm\" name=\"descript".$count."\" required >".$row[5]."</textarea>";
					echo "<span class=\"help-block\">輸入教材敘述，敘述這個章節大致的學習內容，將用於搜尋頁面。</span></div></div>";
					//教材講師
					echo "<div class=\"form-group\">";
					echo "<label for=\"teacherInput".$count."\" class=\"col-md-2 control-label\">教材講師:</label>";
					echo "<div class=\"col-md-10\">";
					echo "<input id=\"teacherInput".$count."\" class=\"form-control\" type=\"text\" name=\"teacher".$count."\" value=\"".$row[6]."\" required />";
					echo "<span class=\"help-block\">輸入講師名稱，用來區別同主題不同講師的教材。</span></div></div>";
					//教材檔案
					echo "<div class=\"form-group\">";
					echo "<label for=\"fileInput".$count."\" class=\"col-md-2 control-label\">教材檔案:</label>";
					echo "<div class=\"col-md-10\">";
					echo "<input id=\"fileInput".$count."\" type=\"file\" name=\"material_file".$count."\" required />";
					echo "<span class=\"help-block\">選擇上傳檔案，必須為.pdf檔。</span></div></div>";
					//一筆資料的div結尾
					echo "</div>";		
					
					$count++; //處理資料數+1
				}
			?>					
				<div>
					<button class="btn btn-sucess" type="submit" form="materialForm">更新教材資料</button>
					<button class="btn btn-sucess" type="button" onclick="javascript:location.href='material-View.php'" >取消更新</button>
				</div>
			</form>
		</div>	
	</body>
</html>
