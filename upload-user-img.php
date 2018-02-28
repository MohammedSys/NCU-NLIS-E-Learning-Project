<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		$cellphoneErr = "";
		$dbMessage ="";


		$id = $_SESSION['account'];
        //若以下$id直接用$_SESSION['username']將無法使用
        $sql1 = "SELECT * FROM userAccount where name='$id'";
        $result = mysql_query($sql1);
        $row = mysql_fetch_row($result);
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
		<link rel="stylesheet" href="assets/css/sidebar.css">
		<link rel="stylesheet" href="assets/css/main-menu.css">
		<link rel="stylesheet" href="assets/css/upload-user-img.css">
		<style>
			
		</style>
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-toggled.js"></script>
		<script>
			$(document).ready(function() {
				document.getElementById("file").onchange = function ()
				{
					var div = document.getElementById('file-name');
					
					var fn = $('#file').val().replace(/.*[\/\\]/, '');
					div.innerHTML = div.innerHTML + fn;
				};
			});
		</script>
	</head>
	
	<body id="B" class="full">
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
							<li><a href="modify.php">取消&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		
		<!-- Page Content -->
		<div id="page-content-wrapper">
			<!-- Main Content -->
			<div id="content" class="margin-t-60">
                <div class="center-div">
                    <h2>請選擇圖片檔案上傳</h2>
                    <form action="php/userimg-upload.php" enctype="multipart/form-data" method="post">
						<div class="center-div">
							<label for="file" class="transparent-input custom-file-upload">
								<i class="fa fa-cloud-upload"> 選擇檔案</i>
							</label>
							<input id="file" name="uploaded_file" type="file">
							<input id="submit" class="transparent-input custom-file-upload" name="submit" type="submit" value="開始上傳">
							<div id="file-name"></div>
						</div>
                    </form>
					
					<output id="list"></output>

					<script>
						var count = 0;
						function handleFileSelect(evt)
						{
							var files = evt.target.files; // FileList object
							var f = files[0];
							
							// Loop through the FileList and render image files as thumbnails.
							// for (var i = 0, f; f = files[i]; i++)
							// {
								
							// }
							if (!f.type.match('image.*')) {
								alert('No a Img file!');
							}
							// Only process image files.
							var d = document.getElementById('myDiv'+count);
							var olddiv = document.getElementById( count );
							if (olddiv != null)
							{
								$( "#file-name" ).empty();
								d.removeChild(olddiv);
							}
							var reader = new FileReader();
							
							// Closure to capture the file information.
							reader.onload = (function(theFile) {
								return function(e) {
									// Render thumbnail.
									var span = document.createElement('span');
									var divIdName = 'myDiv'+count;
									span.setAttribute('id', divIdName);
									span.innerHTML = ['<img class="thumb" id="', count, '" src="', e.target.result,
													'" title="', escape(theFile.name), '"/>'].join('');
									document.getElementById('list').insertBefore(span, null);
								};
							})(f);
							
							// Read in the image file as a data URL.
							reader.readAsDataURL(f);
							
							count++;
						}
						document.getElementById('file').addEventListener('change', handleFileSelect, false);
					</script>
                </div>
			</div>
			
			<!-- Footer -->
			<footer>
				<div class="container">
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
		</div>
	</body>
</html>