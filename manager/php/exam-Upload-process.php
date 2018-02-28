<?php
    include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");	
    //接收POST來的考題主題、類型、章節
    $subject = $_POST['subject'];
	$type = $_POST['type'];
	$chapter = $_POST['chapter'];
	$sucess = 0; //上傳題數計數器
	$questCount = 1; //題目計數器
	while( !empty($_POST['q'.$questCount]) ) {
		$number = (int)($_POST['q'.$questCount]); //題號
		$descript = htmlspecialchars($_POST['q'.$questCount.'Descript']); //題目敘述
		$a1 = htmlspecialchars($_POST['q'.$questCount.'-1']); //答案選項一
		$a2 = htmlspecialchars($_POST['q'.$questCount.'-2']); //答案選項二
		$a3 = htmlspecialchars($_POST['q'.$questCount.'-3']); //答案選項三
		$a4 = htmlspecialchars($_POST['q'.$questCount.'-4']); //答案選項四
		$ans = $_POST['q'.$questCount.'Ans'];	//題目正解
		$point = ($_POST['q'.$questCount.'Point']); //題目配分	
		$questCount += 1; //題號計數器+1
		//搜尋考題資料庫，檢查考題是否已經存在
		$sql1 = "SELECT number FROM questionBase WHERE subject = '$subject' AND chapter = '$chapter' AND type = '$type' AND number = '$number'";
		$result = mysql_query($sql1);
		$row = mysql_fetch_row($result);
		//如果考題不存在，則新增考題
		if($row[0] == null ) {
			$sql2 = "INSERT INTO questionBase ( type, subject, chapter, number, context, A1, A2, A3, A4, answer, point ) VALUES ('$type','$subject','$chapter','$number','$descript','$a1','$a2','$a3','$a4','$ans','$point')";

			if ( mysql_query($sql2) ) {
				$sucess++; //考題新增成功，總新增考題數+1
			}
			else {
				$error = mysql_error();
				$Message = '考題新增失敗!錯誤訊息：'.$error;
				echo '<script type="text/javascript">alert("'.$Message.'");</script>';
			}
		}
		//考題已存在，新增錯誤訊息
		else {
			$Message = '考題:'.$row[0].'已存在!';
			echo '<script type="text/javascript">alert("'.$Message.'");</script>';
		}	

	}
	

	//顯示總上傳考題數
	if ( $sucess != 0 ) {
		$Message = "考題上傳成功!\\n類型:".$type."\\n主題:".$subject."\\n章節:第".$chapter."章\\n上傳題數:".$sucess."題";
		echo '<script type="text/javascript">alert("'.$Message.'");</script>';
	}
	echo "<meta http-equiv=REFRESH CONTENT=0;url=../exam-Select.php>";
?>