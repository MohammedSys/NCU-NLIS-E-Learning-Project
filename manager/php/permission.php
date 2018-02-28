<?php

	if ($_SESSION['account'] == null || $_SESSION['account'] != "newlife") {		
		exit("<meta http-equiv=REFRESH CONTENT=0;url=../directLogin.php>");	
	}
	
?>