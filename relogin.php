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
		<link rel="stylesheet" href="assets/css/signin.css">
		<style>
			.relogin-form
			{
				width: 50% !important;
				min-width: 320px;
				
				margin: 0px auto;
				margin-top: 80px;
			}
			.errorM
			{
				margin-top: 5px;
				color: rgba(255, 187, 187, 1);
				font-size: 1.3em;
				font-weight: 900;
				background: rgba(68, 68, 68, 0.7);
				border-radius: 10px;
				padding: 5px;
			}
			.relogin-form > h2
			{
				color: white;
			}
		</style>
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<script>
		
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
									<td width="130px"><div class="systemname">E-learning System<br/>新生命資訊服務 Co.</div></td>
								</tr>
							</table>
						</div>
					</div>
						
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php include 'objects/outsystem-nav-link.php'; ?>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="sign-up.php">沒有帳號嗎&nbsp;<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></li>
							<li><a href="forgetPassword.php">忘記密碼&nbsp;<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		
		<!-- Main Content -->
		<div id="content">
			<form class="form-signin relogin-form" name="form" action="php/accountConfirm.php" method="post">
				<h2>帳號或密碼有誤喔！</h2>
				<hr color="#ff7575" size="2px" width="100%" align="center"/>
				<div class="errorM">
					<span>請重新輸入！！</span>
					<span><br />如果沒有帳號或是忘記密碼<br />請由下方橘色連結取得協助。</span>
				</div>
				<br />
				<label for="inputAcc" class="sr-only">帳號</label>
				<!--if needed, add-on: required autofocus-->
				<input type="account" name="account" id="inputAcc" class="form-control" placeholder="帳號" required>
				<label for="inputPassword" class="sr-only">密碼</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="密碼" required>
				<button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
			</form>
			
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<ul class="list-inline text-center">
					<li><a class="transparent-btn transparent-btn-orange" href="forgetPassword.php">忘記密碼</a>
					</li>
					<li><a class="transparent-btn transparent-btn-orange" href="sign-up.php">帳號註冊</a>
					</li>
				</ul>
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