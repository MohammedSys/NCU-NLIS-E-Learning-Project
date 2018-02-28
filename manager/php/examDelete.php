<?php 
   include("connection.php");
   //設定編碼，避免中文字出現亂碼
   mysql_query("set names 'utf8'");	
   //前頁表單傳送的考題主題、章節、類型
   $subject = $_POST['subject'];
   $type = $_POST['type'];
   $chapter = $_POST['chapter'];	
   $numberArray = array();
   $numberArray = $_POST['number']; //接受瀏覽頁面勾選的刪除題號，存進陣列
   $sucess = 0; //刪除題數計數器
   //foreach迴圈一筆一筆刪除$numberArray的題號題目
   foreach ( $numberArray as $number ) {
      $sql = "DELETE FROM questionBase WHERE subject = '$subject' AND chapter = '$chapter' AND type = '$type' AND number = '$number'";
	  $error = mysql_error();
	  if ( mysql_query($sql) ) {
	    $sucess++; //成功刪除總題數+1
	  }else {
	  	$Message = "考題刪除失敗。錯誤訊息:".$error;
		echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	  }
  
   }
   
   if ( $sucess != 0 ) {
		 $Message = "考題刪除成功!\\n類型:".$type."\\n主題:".$subject."\\n章節:第".$chapter."章\\n刪除題數:".$sucess."題";
		 echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	 } 

   
?>