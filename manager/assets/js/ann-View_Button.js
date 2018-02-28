
	function changeAction(action_name) {
		var form = document.getElementById("annForm");
		
		if ( $("input[name='number[]']:checked").length != 0 ) { 
			if ( action_name == "update" && $("input[name='number[]']:checked").length == 1 ) {
				form.action = "ann-Update.php";
				form.submit();
			}
			else if ( action_name == "update" && $("input[name='number[]']:checked").length != 1) {
				alert("修改公告只能勾選一個項目。");
			}
			else if( action_name == "del" ) {
				form.action = "php/ann-Delete.php";
				form.submit();
			}
			
		}else {
			alert("至少需要勾選一個項目。");
		}
	}

