<?php 
	include( "connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );

	// $title=htmlspecialchars($_POST['title']);
	$title = $_POST['title'];
	$type = $_POST['type'];
	$context = $_POST['context'];
	$sql = "INSERT INTO bulletin (title , type , context) VALUES ('$title' , '$type' , '$context')";
	if ( mysql_query($sql) ) $Message = '公告新增成功!';
	else
	{
		$error = mysql_error();
		$Message = '公告新增失敗!錯誤訊息：'.$error;		
	}
	echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	echo "<meta http-equiv=REFRESH CONTENT=0;url=../ann-View.php>";
 ?>