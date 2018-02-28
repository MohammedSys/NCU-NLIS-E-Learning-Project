<?php session_start(); ?>
<?php
	include("connection.php");	
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	$name = $_SESSION['account'];
	$type = $_GET['type'];
	$subject = $_GET['getSubject']; 
	$chapter = $_GET['chapterPOST'];   
	$grade = $_POST['examGrade'];
	$correctAns = $_POST['correctAns'];
	$wrongAns = $_POST['wrongAns'];
	$totalQuest = $_POST['totalQuest'];
	$examTime = $_POST['examTime'];
	$examDate = date('o-m-d');
	$stuAns = $_POST['examOptions'];	
	$ansStatus = $correctAns."/".$wrongAns."/".($totalQuest-$correctAns-$wrongAns)."/".$totalQuest;
	$sql = "INSERT INTO testGrade (name,type,subject,chapter,score,ansTime,ansDate,recordAns,ansStatus) VALUES ('$name','$type','$subject','$chapter','$grade','$examTime','$examDate','$stuAns','$ansStatus')";
	$error = mysql_errno();
	//如果新增成功，頁面跳轉至首頁
	if (mysql_query($sql)) {
		$MSG = "考試記錄新增成功，將跳轉至測驗區";
		// echo '<script type="text/javascript">document.getElementById("message").innerHtml="<span>考試記錄新增成功，將跳轉自首頁</span>";</script>';
		echo '<meta http-equiv=REFRESH CONTENT=3;url=../exam-selection.php>';
	}
	//如果新增失敗，返回上一頁(不會刷新頁面)
	else {
		$MSG = "紀錄新增失敗";
		echo '<script type="text/javascript">alert("紀錄新增失敗：'.$error.'。返回上一頁");</script>';
		echo "<script>history.go(-1)</script>";
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
		<link rel="stylesheet" href="../assets/css/php-msg.css">
		<style>
			
		</style>
	</head>
	
	<body class="full">
		
		<!-- Main Content -->
		<div id="content">
			<div class="php-msg" id="message"><?php echo $MSG; ?></div>
			
			<div class="p-box">
				<div class="loader">Loading...</div>
			</div>
		</div>
	</body>
</html>