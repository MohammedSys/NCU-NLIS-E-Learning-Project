<?php
	include( "php/connection.php" );

	$account = htmlspecialchars($_POST['account']);
	$name = htmlspecialchars($_POST['name']);
	$pwd = htmlspecialchars($_POST['password']);
	$pwd2 = htmlspecialchars($_POST['password2']);
	$email = htmlspecialchars($_POST['email']);
	$cellphone = htmlspecialchars($_POST['cellphone']);
	$memberID = htmlspecialchars($_POST['memberID']);

	$accountErr = "";
	$pwd2Err = "";
	$phoneErr = "";
	$memberIDErr ="";
	$dbMessage ="";

	if ( isset($_POST["cancel"]) ) return_index();

	//submit被點，開始資料驗證
	if ( isset($_POST["submit"]) )
	{
		//valid設為true,認證失敗改為false
		$valid = true;

		//檢查帳號是否已經存在
		// $sql = "SELECT name FROM userAccount where name = '$account'";
		$sql = "SELECT username FROM userAccount where username = '$account'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		if ($row[0] != null)
		{
			$accountErr = "該帳號名稱已經存在!";
			$valid = false;
		}
		else $accountErr = "";

		//驗證二次輸入密碼有無正確
		if ($pwd != $pwd2 )
		{
			$pwd2Err = "驗證密碼與原密碼不符";
			$valid = false;
		}
		else $pwd2Err = "";

		//驗證手機號碼輸入
		if ( !preg_match("/^09[0-9]{8}$/", $cellphone) )
		{
			$phoneErr = "手機號碼需以09開頭，需要10碼";
			$valid = false;
		}
		else $phoneErr = "";

		//新增帳號至資料庫
		if ($valid == true) 
		{
			// $sql = "INSERT into userAccount(name, password, email, cellphone, memberID) VALUES ('$account', '$pwd', '$email', '$cellphone', '$memberID')";
			$sql = "INSERT into userAccount(username, name, password, email, cellphone) VALUES ('$account', '$name', PASSWORD('$pwd'), '$email', '$cellphone')";
			$accountJPG = "uploads/newAccount.jpg";
			$dest = "uploads/".$account.".jpg";
			if ( copy($accountJPG, $dest) ) {
				if( mysql_query($sql) ) 
				{
					$dbMessage ="註冊成功，將自動導向登入頁";
					return_index();
				}
				else $dbMessage ="伺服器新增帳號失敗";
			}
			else $dbMessage ="註冊失敗，預設使用者圖片複製失敗";
		}//end of add account
	}// isset

	function return_index()
	{
		echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head.html'; ?>
<script>
function back() {
	location.href='./index.php'
}
</script>
</head>
<body class="full">
	<!-- Page Header -->
	<header>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div id="logo_printer">
						<table class="a-hover txt-white" border="0" cellspacing="0" cellpadding="0">
							<tr onclick="openlink('./index.php')">
								<td><img alt="Brand" class="brand-icon" src="assets/img/newlife_circle.png"></td>
								<td width="150px"><div class="systemname">E-learning System<br/>新生命資訊服務 Co.</div></td>
							</tr>
						</table>
					</div>
				</div>
					
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php include 'objects/outsystem-nav-link.php'; ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="./index.php">已有帳號&nbsp;<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a></li>
						<li><a href="forgetPassword.php">忘記密碼&nbsp;<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	
	<!-- Main Content -->
	<div id="content">
		<div id="centerDiv">
			<h2>會員註冊</h2>
			<form id="inputArea" method="post" onsubmit="return submitCheck()">
				<span class="columnText">帳號：</span>
				<input class="inputCss" id="account" name="account" type="text" value ="<?php echo $account; ?>" required placeholder="請輸入帳號"/>
				<p class="signError" id="accountErr"><?php echo $accountErr; ?></p>
				<span class="columnText">姓名：</span>
				<input class="inputCss" id="name" name="name" type="text" value ="<?php echo $name; ?>" required placeholder="請輸入姓名"/>
				<span class="columnText">密碼：</span>
				<input class="inputCss" id="password" name="password" type="password" value ="<?php echo $pwd; ?>" required placeholder="請輸入密碼"/><br />
				<p class="signError" id="pwdErr"></p>
				<span class="columnText">密碼確認：</span>
				<input class="inputCss" id="password2" name="password2" type="password" value ="<?php echo $pwd2; ?>" required placeholder="請再次輸入密碼"/><br />
				<p class="signError" id="pwd2Err"><?php echo $pwd2Err; ?></p>
				<span class="columnText">電子信箱：</span>
				<input class="inputCss" id="email" name="email" type="email" value ="<?php echo $email; ?>" required placeholder="請輸入電子信箱地址"/><br />
				<p class="signError" id="emailErr"></p>
				<span class="columnText">手機：</span>
				<input class="inputCss" id="cellphone" name="cellphone" type="text" value ="<?php echo $cellphone; ?>"  maxlength="10" required placeholder="請輸入手機號碼"/><br />
				<p class="signError" id="cellphoneErr"><?php echo $phoneErr; ?></p>
				<span class="columnText">員工 ID：</span>
				<input class="inputCss" id="memberID" name="memberID" type="text" value ="<?php echo $memberID; ?>" placeholder="請輸入員工ID"/><br />
				<p class="signError" id="IDErr"><?php echo $memberIDErr; ?></p>
				<div style="width: 100%;">
					<div class="submit" style="float: left; width: 50%;">
						<input style="width: 90%;" class="transparent-btn transparent-btn-orange transparent-btn-input" name="submit" type="submit" value="註冊"/><br />
					</div>
					<div class="submit" style="float: right; width: 50%;">
						<input style="width: 90%;" class="transparent-btn transparent-btn-orange transparent-btn-input" name="cancel" type="submit" value="取消" onclick="back()"/><br />
					</div>
				</div>
			</form>
			<div class="dbmsg">
				<?php echo $dbMessage; ?>
			</div>
		</div>
	</div>
	
	<!-- Footer -->
	<?php include 'objects/footer.php'; ?>
</body>
</html>