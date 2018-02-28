<?php session_start();?>
<?php
    include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	//get username,bookmark Info from session
	$username = $_SESSION['account'];	
	$subject = $_SESSION['subject'];
	$chapter = $_SESSION['chapter'];
	//get note from POST method
    $note = htmlspecialchars($_POST['note']);
	//查詢筆記是否已存在於資料庫，用$row陣列紀錄查詢結果
	$sql = "SELECT note FROM classNote WHERE name = '$username' AND subject = '$subject' AND chapter = '$chapter'";
	$result = mysql_query($sql);
    $row = mysql_fetch_row($result);
	//記錄錯誤訊息
	$error = mysql_error();
	//如果筆記已存在，更新筆記內容至資料庫
	if ( $row[0] != null) {
		$sql1 = "UPDATE classNote SET note = '$note' WHERE name = '$username' AND subject = '$subject' AND chapter = '$chapter'";
		if (mysql_query($sql1)) {
			$Message = "筆記更新成功!"; 
			echo '<meta http-equiv=REFRESH CONTENT=0;url=../classroom.php>';
		}
		else {
			$Message = "筆記更新失敗:".$error;
			echo '<meta http-equiv=REFRESH CONTENT=0;url=../classroom.php>'; 
		}
		
	}
	//如果筆記不存在(如使用者第一次使用筆記)，則新增筆記資料庫
	else {
		$sql1 = "INSERT INTO classNote ( name, subject, chapter, note ) VALUES ('$username', '$subject', '$chapter', '$note' )";
		if (mysql_query($sql1)) {
			$Message = "筆記新增成功!"; 
			echo '<meta http-equiv=REFRESH CONTENT=0;url=../classroom.php>';
		}
		else {
			$Message = "筆記新增失敗:".$error;
			echo '<meta http-equiv=REFRESH CONTENT=0;url=../classroom.php>'; 
		}
	}
	
	echo '<script type="text/javascript">alert("'.$Message.'");</script>';
?>