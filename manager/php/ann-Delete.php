<?php 
   include("connection.php");
   //設定編碼，避免中文字出現亂碼
   mysql_query("set names 'utf8'");	
   $numberArray = array();
   $numberArray = $_POST['number']; //接受瀏覽頁面勾選的編號，存進陣列
   $sucess = 0; //刪除題數計數器
   //foreach迴圈一筆一筆刪除$numberArray的題號題目
   foreach ( $numberArray as $postID ) {
      $sql = "DELETE FROM bulletin WHERE postID = '$postID'";
	  $error = mysql_error();
	  if ( mysql_query($sql) ) {
	    $sucess++; //成功刪除總題數+1
	  }
	  else {
	  	$Message = "刪除失敗。錯誤訊息:".$error;
		echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	  }
  
   }
     
   if ( $sucess != 0 ) {
		$Message = "【刪除結果】\\n已刪除".$sucess."筆公告。";
		echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	 } 
   echo "<meta http-equiv=REFRESH CONTENT=0;url=../ann-View.php>";
   
?>