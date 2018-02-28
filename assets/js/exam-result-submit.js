function markType(button,input) {
	
	var btnText = button.innerHTML;
	var inputClassify = document.getElementById(input);
	inputClassify.value = btnText;

}

function markSubmit(form) {
	$('#examInfo'+form).modal('hide');

}
