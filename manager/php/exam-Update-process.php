<?php
   include("connection.php"); 
   //設定編碼，避免中文字出現亂碼
   mysql_query("set names 'utf8'");
   $subject = $_POST['subject'];
   $type = $_POST['type'];
   $chapter = $_POST['chapter'];
   $numCount = 1; //題數計數器
   $sucess = 0; //刪除題數計數器
   while ( !empty($_POST['q'.$numCount]) ) {
     $number = $_POST['q'.$numCount];
	 $context = htmlspecialchars($_POST['q'.$numCount.'Descript']);
	 $a1 = htmlspecialchars($_POST['q'.$numCount.'-1']);
	 $a2 = htmlspecialchars($_POST['q'.$numCount.'-2']);
	 $a3 = htmlspecialchars($_POST['q'.$numCount.'-3']);
	 $a4 = htmlspecialchars($_POST['q'.$numCount.'-4']);
	 $ans = $_POST['q'.$numCount.'Ans'];
	 $point = $_POST['q'.$numCount.'Point'];
	 
	 $sql = "UPDATE questionBase SET context = '$context', A1 = '$a1', A2 = '$a2', A3 = '$a3', A4 = '$a4', answer = '$ans', point = '$point' WHERE subject = '$subject' AND chapter = '$chapter' AND type = '$type' AND number = '$number'";
	 $error = mysql_error();
	 if ( mysql_query($sql) ) {
		 $sucess += 1;	 
	 }else {
	 	 $Message = "考題更新失敗。錯誤訊息:".$error;
		 echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	 }
	 
	 $numCount++;
   }
	if ( $sucess != 0 ) {
		 $Message = "考題更新成功!\\n類型:".$type."\\n主題:".$subject."\\n章節:第".$chapter."章\\n更新題數:".$sucess."題";
		 echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	 } 
	echo "<meta http-equiv=REFRESH CONTENT=0;url=../exam-View.php>";

?>