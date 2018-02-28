
	function changeAction(action_name) {
		var form = document.getElementById("materialForm");
		
		if ( $("input[name='chapter[]']:checked").length != 0 ) { 
			if ( action_name == "update" ) {
			form.action = "material-Update.php";
			form.submit();
			}
			else if( action_name == "del" ) {
				form.action = "php/material-Delete.php";
				form.submit();
			}
			
		}else {
			alert("至少需要勾選一個項目。");
		}
	}
	

