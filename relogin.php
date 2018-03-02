<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head-outsystem.php'; ?>
<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
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
</head>
<body class="full">
	<!-- Page Header -->
	<header>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<?php include 'objects/outsystem-navbar-left.php'; ?>
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
	<?php include 'objects/footer.php'; ?>
</body>
</html>