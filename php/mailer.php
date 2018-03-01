<?php
	require_once __DIR__ . '/../assets/comps/vendor/autoload.php';
	include( "config.php" );
	include( "connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );
	//接收使用者輸入的帳號與信箱
	$userAccount = htmlspecialchars($_POST['account']);
	$userEmail = htmlspecialchars($_POST['email']) ;
	//連結資料庫
	// create temporary password
	$tmppass = generateRandomString( 10 );
	$sql = "UPDATE userAccount SET password= PASSWORD('$tmppass') WHERE username = '$userAccount'";
	mysql_query($sql);
	// $sql = "SELECT name,email,password FROM userAccount WHERE name = '$userAccount'";
	$sql = "SELECT username,email,password FROM userAccount WHERE username = '$userAccount'";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);

	if( $row[0] == $userAccount && $row[1] == $userEmail)
	{
		mb_internal_encoding('UTF-8');    // 內部預設編碼改為UTF-8，解決信件標題亂碼問題
		ini_set('display_errors', 1);

		$mail = new PHPMailer\PHPMailer\PHPMailer();
		// Ref. https://stackoverflow.com/questions/46059612/uncaught-error-class-phpmailer-not-found

		$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';	// set encoding to UTF-8
		$mail->Sendmail = '/opt/sbin/sendmail';
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = $mailing_server;
		$mail->Port = $mailing_port;

		// 這邊是你的 mail 帳號和密碼
		$mail->Username = $mail_acc;
		$mail->Password = $mail_pwd;
		// 寄件者名稱(你自己要顯示的名稱)
		$mail->FromName = $mail_name;

		// 收件者信箱
		$email = $userEmail;
		// 收件者的名稱 or 暱稱
		$name = "新生命使用者";

		$mail->From = $mail_acc;

		$mail->AddAddress( $email, $name );
		//回覆信件至此信箱
		$mail->AddReplyTo( $mail_acc, "Squall.f" );
		//這不用改
		
		$mail->WordWrap = 50; // 每 50 行斷一次行
		
		//$mail->AddAttachment("/XXX.rar"); // 附加檔案可以用這種語法
		
		$mail->Subject = mb_encode_mimeheader( $mail_subject, "UTF-8" );
		// 信件標題
		$message = "親愛的 ".$userAccount."：<br><br>您的 E-learning 學習平台 暫時密碼 為：".$tmppass."。<br><br>請以該密碼登入系統後，儘速更新您的密碼。<br><br>E-learning 學習平台 管理者 敬上";
		$message = $message."<br><br><hr noshade/><br>";
		$message = $message."Dear ".$userAccount.":<br><br>Your temproary password for E-learning system is: ".$tmppass.".<br><br>After using it to login to the system, please change the password immediately!<br>Thank you!<br><br>Sincerely,<br><br>E-learning System Support";
		// 信件內容 (html版，就是可以有 html 標籤的如粗體、斜體之類)
		$mail->Body = $message;
		// 信件內容 (txt版)
		$mail->AltBody = $message;

		$mail->IsHTML(true); // send as HTML

		if(!$mail->Send())
		{
			$message = "寄信發生錯誤：".$mail->ErrorInfo;
			//如果有錯誤會印出原因
			alertMsg( $message );
			backToFgtPwd();
		}
		else
		{ 
			$message = "密碼取回信寄出成功!";
			alertMsg( $message );
			backToIndex();
		}
	}
	else 
	{
		$message = "輸入帳號或信箱不符，請重新輸入。";
		alertMsg( $message );
		backToFgtPwd();
	}

	function alertMsg( $message )
	{
		echo '<script type="text/javascript">alert("'.$message.'");</script>';
	}

	function backToIndex()
	{
		echo "<meta http-equiv=REFRESH CONTENT=2;url=../index.php>";
	}
	function backToFgtPwd()
	{
		echo "<meta http-equiv=REFRESH CONTENT=2;url=../forgetPassword.php>";
	}

	function generateRandomString( $length = 10 )
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
?>
<?php include '../objects/progressbar.php'; ?>