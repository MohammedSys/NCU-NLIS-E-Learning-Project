<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head.html'; ?>

<link rel="stylesheet" href="assets/css/forgetPassword.css">

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
						<!-- <li><a href="forgetPassword.php">忘記密碼&nbsp;<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></li> -->
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	
	<!-- Main Content -->
	<div id="content">
		<form id="form" class="form-signin relogin-form" name="form" action="php/mailer.php" method="post">
			<h2>忘記密碼</h2>
			<hr color="#ff7575" size="2px" width="100%" align="center"/>
			<div class="message">
				<span>請輸入註冊帳號以及信箱</span>
				<span><br/>密碼會透過郵件的方式寄至您的信箱。</span>
			</div>
			<br />
			<label for="inputAcc" class="sr-only">註冊的帳號</label>
			<!--if needed, add-on: required autofocus-->
			<input id="account" type="text" name="account" value="" class="form-control" placeholder="輸入註冊帳號" required>
			<p class="signError" id="accountErr"></p>
			<label for="inputPassword" class="sr-only">信箱</label>
			<input id="email" type="email" name="email" value="" class="form-control" placeholder="輸入註冊信箱" required>
			<p class="signError" id="emailErr"></p>
			<button class="btn btn-lg btn-primary btn-block" type="button" onclick="emailCheck()">送出</button>
		</form>
		
		<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
			<ul class="list-inline text-center">
				<li><a class="transparent-btn transparent-btn-orange" href="index.php">回到登入頁</a>
				</li>
				<li><a class="transparent-btn transparent-btn-orange" href="sign-up.php">帳號註冊</a>
				</li>
			</ul>
		</div>
	</div>
	
	<!-- Footer -->
	<?php include 'objects/footer.php'; ?>
</body>
</html>