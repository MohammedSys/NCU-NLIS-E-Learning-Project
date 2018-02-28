<?php session_start(); ?>
<?php
	include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	$name = $_SESSION['account']; //會員帳號
	$type = $_GET['type']; //記錄考試類別
	$subject = $_GET['getSubject']; //記錄考試主題
	$chapter = $_GET['chapterPOST']; //記錄考試章節
	$qAns = $_POST['ans']; //記錄學員答案
	$qNum = $_POST['questionNum']; //記錄題號
	$markType = $_POST['classify']; //記錄書籤類型
	$descript = $_POST['markDescript']; //記錄書籤敘述
	
	$sql = "INSERT INTO testMark ( name, type, subject, chapter, number, studentAns, noteType, descript) VALUES ('$name','$type','$subject','$chapter','$qNum','$qAns','$markType','$descript')";
	$error = mysql_error();
	//新增成功，顯示新增內容並回到上一頁
	if ( mysql_query($sql) ) {
		$markMessage = "考試書籤新增成功!\\n類型:".$type."\\n主題:".$subject."\\n章節:第".$chapter."章\\n題目:第".$qNum."題";
		echo "<script>alert('".$markMessage."');window.opener=null;window.close();</script>";
	} 
	//新增失敗，顯示錯誤訊息並回到上一頁
	else {
		$markMessage = "新增失敗:".$error;
		echo "<script>window.opener=null;window.close();</script>";
	}
?>