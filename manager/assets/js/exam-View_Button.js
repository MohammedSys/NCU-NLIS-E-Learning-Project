
	function changeAction(action_name) {
		var form = document.getElementById("examForm");
		
		if ( $("input[name='number[]']:checked").length != 0 ) { 
			if ( action_name == "update" ) {
			form.action = "exam-Update.php";
			form.submit();
			}
			else if( action_name == "del" ) {
				form.action = "php/exam-Delete.php";
				form.submit();
			}
			
		}else {
			alert("至少需要勾選一個項目。");
		}
	}

