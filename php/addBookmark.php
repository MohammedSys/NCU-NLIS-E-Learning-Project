<?php session_start();?>
<?php	 
	include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	//書籤敘述、分類、頁數從POST取得，主題、章節從SESSION取得
    $classify = $_POST['classify'];
    $descript = $_POST[markDescript];
    $page = $_POST['mark'];
	$username = $_SESSION['account'];	
	$URL = $_SESSION['classURL'];
	$subject = $_SESSION['subject'];
	$chapter = $_SESSION['chapter'];
	//get bookmark page from POST method
	
    $sql = "SELECT * FROM bookMark WHERE name = '$username' AND URL = '$URL' AND page = '$page'";
	$result = mysql_query($sql);
    $row = mysql_fetch_row($result);
	$error = mysql_error();
	
		if( $row[0] == null ) {
		 	$sql1 = "INSERT INTO bookMark ( name, URL, subject, chapter, page, type, descript ) VALUES ('$username', '$URL', '$subject', '$chapter', '$page', '$classify', '$descript')";
		 	if (mysql_query($sql1)) {
				 $markMessage = "書籤新增成功!";
				echo '<script type="text/javascript">alert("'.$markMessage.'");</script>';
				 echo '<script>window.opener=null;window.close();</script>';
			 }
			else {
				$markMessage = "新增書籤錯誤!錯誤訊息:".$error;
				echo '<script type="text/javascript">alert("'.$markMessage.'");</script>';
				echo '<script>window.opener=null;window.close();</script>';
			}			
   		 }
   		 else {
   		 	//bookmark adding fail
            $markMessage = "書籤已存在!錯誤訊息:".$error;
			echo '<script type="text/javascript">alert("'.$markMessage.'");</script>';
			echo '<script>window.opener=null;window.close();</script>';             
		 }
		 
?>