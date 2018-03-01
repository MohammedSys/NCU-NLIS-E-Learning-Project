<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head.php'; ?>
<script>
$( document ).ready( function()
{
	document.getElementById( "info" ).innerHTML = '<h1><span class="label label-warning">您尚未登入!</span></h1> \
		<br><p>將自動轉址至登入頁面</p>';
	document.getElementById( "info" ).style.display = "block";
});
</script>
</head>
<body class="full">
<?php include 'objects/pgbar-content.php'; ?>
</body>
</html>
