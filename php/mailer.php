<?php	
	include("connection.php");	
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	//接收使用者輸入的帳號與信箱
	$userAccount = htmlspecialchars($_POST['account']);
	$userEmail = htmlspecialchars($_POST['email']) ;
	//連結資料庫
	$sql = "SELECT name,email,password FROM userAccount WHERE name = '$userAccount'";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	if( $row[0] == $userAccount && $row[1] == $userEmail) {
		require '../assets/comps/phpmailer/PHPMailerAutoload.php';
		mb_internal_encoding('UTF-8');    // 內部預設編碼改為UTF-8，解決信件標題亂碼問題
		ini_set('display_errors', 1);
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->Port = 465; 
		$mail->Username = "elearning.nlis@gmail.com";
		$mail->Password = "elearning0901@nlis";
		//這邊是你的gmail帳號和密碼
		$mail->FromName = "NewLife";
		// 寄件者名稱(你自己要顯示的名稱)
		$webmaster_email = "elearning.nlis@gmail.com"; 
		//回覆信件至此信箱

		$email = $userEmail;
		// 收件者信箱
		$name = "新生命使用者";
		// 收件者的名稱or暱稱
		$mail->From = $webmaster_email;
			
		$mail->AddAddress($email,$name);
		$mail->AddReplyTo($webmaster_email,"Squall.f");
		//這不用改
		
		$mail->WordWrap = 50;
		//每50行斷一次行
		
		//$mail->AddAttachment("/XXX.rar");
		// 附加檔案可以用這種語法(記得把上一行的//去掉)
		
		$mail->IsHTML(true); // send as HTML
		$mail->Subject = mb_encode_mimeheader("新生命資訊服務公司_Elearning-System_忘記密碼", "UTF-8");
		// 信件標題
		$message = "親愛的使用者".$userAccount.":<br><br>您的E-learning學習平台密碼為: ".$row[2]."<br>請依帳密再次登入系統。<br>新生命資訊公司 敬上";
		$mail->Body = mb_detect_encoding($message);
		//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
		$mail->AltBody = mb_detect_encoding($message); 
		//信件內容(純文字版)
		
		if(!$mail->Send())
		{
			$message = "寄信發生錯誤：".$mail->ErrorInfo;
			//如果有錯誤會印出原因
			echo '<script type="text/javascript">alert("'.$message.'");</script>';
			echo "<meta http-equiv=REFRESH CONTENT=2;url=../forgetPassword.php>";
		}
		else
		{ 
			$message = "密碼寄出成功!";
			echo '<script type="text/javascript">alert("'.$message.'");</script>';
			echo "<meta http-equiv=REFRESH CONTENT=2;url=../index.php>";		
		}
	}
	else 
	{
		$message = "輸入帳號或信箱不符，請重新輸入。";
		echo '<script type="text/javascript">alert("'.$message.'");</script>';
		echo "<meta http-equiv=REFRESH CONTENT=2;url=../forgetPassword.php>";
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
		<style>
			
		</style>
	</head>
	
	<body class="full">		
		<!-- Main Content -->
		<div id="content margin-t-60">
			<div class="loader">Loading...</div>
		</div>
	</body>
</html>