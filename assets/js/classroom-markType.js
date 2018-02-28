function markType(button) {
	
	var btnText = button.innerHTML;
	var inputClassify = document.getElementById("classify");
	inputClassify.value = btnText;

}

function markSubmit() {
	document.getElementById("markForm").submit();
	$('#noteInfo').modal('hide');
}
