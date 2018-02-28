<?php
	if ($_SESSION['account'] == null || $_SESSION['account'] == "") {		
		exit("<meta http-equiv=REFRESH CONTENT=0;url=../directLogin.php>");	
	}
?>