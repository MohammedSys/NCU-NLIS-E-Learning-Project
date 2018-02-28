<?php session_start(); ?>
<?php
	require 'php/permission.php';
	include("php/connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");

	$pwd = htmlspecialchars($_POST['password']);
	$pwd2 = htmlspecialchars($_POST['password2']);
	$email = htmlspecialchars($_POST['email']);
	$cellphone = htmlspecialchars($_POST['cellphone']);

	$pwd2Err = "";
	$phoneErr = "";
	$dbMessage ="";


	$id = $_SESSION['account'];
	//若以下$id直接用$_SESSION['username']將無法使用
	$sql1 = "SELECT * FROM userAccount where name='$id'";
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
		else {
			$pwd2Err = "";
		}


		//驗證手機號碼輸入
		if ( !preg_match("/^09[0-9]{8}$/", $cellphone) ) 
		{
			$phoneErr = "手機號碼需以09開頭，需要10碼";	
			$valid = false;
		}
		else 
		{
			$phoneErr = "";
		}

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
			else 
			{
				$dbMessage ="伺服器修改失敗";	                
			}
		}//end of add account
	}// isset
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
		<link href="assets/img/newlife_circle.png" rel="SHORTCUT ICON">
		
		<!--Bootstrap-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="assets/css/font-awesome.css">
		
		<!--Customized CSS Settings-->
		<link rel="stylesheet" href="assets/css/hippo.css">
		<link rel="stylesheet" href="assets/css/sidebar.css" >
		<link rel="stylesheet" href="assets/css/main-menu.css" >
		<link rel="stylesheet" href="assets/css/modify.css">
		<style>
			
		</style>
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<script type="text/javascript" src="assets/js/submitCheck.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-toggled.js"></script>
	</head>
	
	<body class="full">
		<?php include 'objects/siderbar.php'; ?>
		
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
								<tr id="left-menu-toggle">
									<a href="#left-menu"></a>
									<td><img alt="Brand" class="brand-icon" src="assets/img/newlife_circle.png"></td>
									<td width="40px"><div class="systemname"><span class="glyphicon glyphicon-menu-hamburger"></span></div></td>
								</tr>
							</table>
						</div>
					</div>
						
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
				<form method="post">
					<div class="img-div" onclick="javascript:location.href='upload-user-img.php'">
						<div class="accImg"><img class="accImg" src=<?php echo "/uploads/".$_SESSION['account'].".JPG";?>>
							<div class="overlay"><span>更改</span></div>
						</div>
					</div>
					
					<div class="accInfo"><?php echo $_SESSION['account'] ?></div>
					<div class="contactInfo"><?php echo $row[3] ?></div><div class="contactInfo"><?php echo $row[4] ?></div>
					
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
					<input class="inputCss" id="email" name="email" type="email" value ="<?php echo $row[3]; ?>" required placeholder="請輸入電子信箱地址"/><br />
					<p class="signError" id="emailErr"></p>
					<span class="columnText">手機：</span>
					<input class="inputCss" id="cellphone" name="cellphone" type="text" value ="<?php echo $row[4]; ?>"  maxlength="10" required placeholder="請輸入手機號碼"/><br />
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
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<ul class="list-inline text-center">
							<li><a class="transparent-btn" href="http://vivialife.com/TW/" target="_blank">好日子購物網</a>
							</li>
							<li><a class="transparent-btn" href="http://www.sci.org.tw/" target="_blank">脊髓新樂園</a>
							</li>
							<li><a class="transparent-btn" href="http://www.sci.org.tw/" target="_blank">脊髓損傷潛能發展中心</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="row row-margin">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<ul class="list-inline text-center">
							<li><a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/nlishsinchu?hc_location=stream" target="_blank">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
						</ul>
						<p class="copyright">Copyright &copy; ISQ Lab. NCU 2015</p>
					</div>
				</div>
			</div>
    	</footer>
	</body>
</html>