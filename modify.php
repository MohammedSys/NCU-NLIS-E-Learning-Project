<?php session_start(); ?>
<?php
	require 'php/permission.php';
	include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );

	$pwd = htmlspecialchars($_POST['password']);
	$pwd2 = htmlspecialchars($_POST['password2']);
	$email = htmlspecialchars($_POST['email']);
	$cellphone = htmlspecialchars($_POST['cellphone']);

	$pwd2Err = "";
	$phoneErr = "";
	$dbMessage ="";

	$id = $_SESSION['account'];
	//若以下$id直接用$_SESSION['username']將無法使用
	$sql1 = "SELECT * FROM userAccount where username='$id'";
	$result = mysql_query($sql1);
	$row = mysql_fetch_row($result);

	//submit被點，開始資料驗證
	if ( isset($_POST["submit"]) ) 
	{
		//valid設為true,認證失敗改為false
		$valid = true;

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

		//修改資料
		if ($valid == true) 
		{
			$sql = "UPDATE userAccount SET password='$pwd', email='$email', cellphone='$cellphone' where name='$id'";			 
			if( mysql_query($sql) ) 
			{
				//導向至首頁
				$dbMessage ="修改成功，將自動導向主頁";
				echo '<meta http-equiv=REFRESH CONTENT=2;url=main.php>';
			}
			else $dbMessage = "伺服器修改失敗";	                

		} //end of add account
	} // isset
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head-insystem.php'; ?>
<link rel="stylesheet" href="assets/css/modify.css">
<script type="text/javascript" src="assets/js/submitCheck.js"></script>
</head>

<body class="full">
	<?php include 'objects/siderbar.php'; ?>
	
	<!-- Page Header -->
	<header>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<?php include 'objects/insystem-navbar-left.php'; ?>	
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav header-text">
						<?php include 'objects/home-btn.php'; ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="main.php">取消&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	
	<!-- Main Content -->
	<div id="content">
		<div id="centerDiv" class="acc-div margin-t-80">
			<form method="post" style="padding-bottom: 30px;">
				<div class="img-div" onclick="javascript:location.href='upload-user-img.php'">
					<div class="accImg"><img class="accImg" src=<?php echo "uploads/".$_SESSION['account'].".jpg";?>>
						<div class="overlay"><span>更改</span></div>
					</div>
				</div>
				<div class="accInfo"><?php echo $_SESSION['account'] ?></div>
				<div class="contactInfo"><?php echo $row[3] ?></div>
				<div class="contactInfo"><?php echo $row[5] ?></div>
				<div class="contactInfo" sytle="margin-bottom: 50px;"><?php echo $row[6] ?></div>
			</form>
		</div>
		<div id="centerDiv" class="editBox">
			<h2>修改資料</h2>
			<div class="msg">
				<?php echo $dbMessage; ?>
			</div>
			<form method="post" onsubmit="return modifyCheck()">
				<span class="columnText">密碼：</span>
				<input class="inputCss" id="password" name="password" type="password" value ="" required placeholder="請輸入密碼"/><br />
				<p class="signError" id="pwdErr"></p>
				<span class="columnText">密碼確認：</span>
				<input class="inputCss" id="password2" name="password2" type="password" value ="" required placeholder="請再次輸入密碼"/><br />
				<p class="signError" id="pwd2Err"><?php echo $pwd2Err; ?></p>
				<span class="columnText">電子信箱：</span>
				<input class="inputCss" id="email" name="email" type="email" value ="<?php echo $row[5]; ?>" required placeholder="請輸入電子信箱地址"/><br />
				<p class="signError" id="emailErr"></p>
				<span class="columnText">手機：</span>
				<input class="inputCss" id="cellphone" name="cellphone" type="text" value ="<?php echo $row[6]; ?>"  maxlength="10" required placeholder="請輸入手機號碼"/><br />
				<p class="signError" id="cellphoneErr"><?php echo $phoneErr; ?></p>
				<table class="margin-t-40" width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center"><input style="width: 90%;" class="transparent-btn transparent-btn-orange transparent-btn-input" type="submit" name="submit" value="完成"/></td>
						<td align="center"><input style="width: 90%;" class="transparent-btn transparent-btn-orange transparent-btn-input" type="button" value="取消" onclick="javascript:location.href='main.php'"/></td>
					</tr>
				</table>
			</form>
			<div class="gap"></div>
		</div>
	</div>

	<!-- Footer -->
	<?php include 'objects/footer.php'; ?>
</body>
</html>