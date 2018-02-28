function submitCheck() {
	
	//declare input field value											
	var account = document.getElementById("account").value;	
	var password = document.getElementById("password").value;
	var password2 = document.getElementById("password2").value;	
	var email = document.getElementById("email").value;	
	var cellphone = document.getElementById("cellphone").value;		
	
	//set input err null
	$("#accountErr").text("");
	$("#pwdErr").text("");
	$("#pwd2Err").text("");
	$("#emailErr").text("");
	$("#cellphoneErr").text("");
	
	//declare boolean varify
	var varify = true;
	
	//Verify account
	if (account == "") {
		$("#accountErr").text("請輸入帳號");
		varify =  false;
	}
	//Verify passward
	if (password == "") {
		$("#pwdErr").text("請輸入密碼");
		varify =  false;
	}else {
		if (password.length < 6) {
			$("#pwdErr").text("密碼需要至少6碼長度");
			varify =  false;
		}
	}
	
	if (password != password2) {
		$("#pwd2Err").text("驗證密碼與原密碼不符");
		varify =  false;
	}
	
	//Verify cellphone
	if (cellphone == "") {
		$("#cellphoneErr").text("請輸入手機號碼");
		varify =  false;
	}else {
		var regularCheck = new RegExp("^09[0-9]{8}$");
		var res = regularCheck.test(cellphone);
		if (!res) {
			$("#cellphoneErr").text("手機號碼需以09開頭，需要10碼");
			varify =  false;
		}
	}
	
	//Verify email
	if (email == "") {
		$("#emailErr").text("請輸入email");
		varify =  false;
	}else {
		var atPos = email.indexOf("@");
		var lastDotPos = email.lastIndexOf(".");
		if (atPos == -1 && lastDotPos == -1 )
		{
			$("#emailErr").text("至少要有一個 @ 與一個 .");
			varify =  false;
		}
		if (atPos == 0)
		{
			$("#emailErr").text("@不可以在第一個位置");
			varify =  false;				
		}
		if (lastDotPos - atPos < 2 )
		{
			$("#emailErr").text("最後一個.必須在@之後且不能相連");
			varify =  false;
		}
		if (email.length - lastDotPos < 2)
		{
			$("#emailErr").text("最後一個.之後最少還有兩個字元");
			varify =  false;
		}
	}
	
	return varify;
}

function modifyCheck() {
	
	var password = document.getElementById("password").value;
	var password2 = document.getElementById("password2").value;	
	var email = document.getElementById("email").value;	
	var cellphone = document.getElementById("cellphone").value;		
	
	//set input err null
	$("#pwdErr").text("");
	$("#pwd2Err").text("");
	$("#emailErr").text("");
	$("#cellphoneErr").text("");
	
	//declare boolean varify
	var varify = true;
	
	//Verify passward
	if (password == "") {
		$("#pwdErr").text("請輸入密碼");
		varify =  false;
	}
	else 
	{
		if (password.length < 6) 
		{
			$("#pwdErr").text("密碼需要至少6碼長度");
			varify =  false;
		}
	}
	
	if (password != password2) {
		$("#pwd2Err").text("驗證密碼與原密碼不符");
		varify =  false;
	}
	//Verify cellphone
	if (cellphone == "") {
		$("#cellphoneErr").text("請輸入手機號碼");
		varify =  false;
	}
	else 
	{
		var regularCheck = new RegExp("^09[0-9]{8}$");
		var res = regularCheck.test(cellphone);
		if (!res) 
		{
			$("#cellphoneErr").text("手機號碼需以09開頭，需要10碼");
			varify =  false;
		}
	}
	
	//Verify email
	if (email == "") {
		$("#emailErr").text("請輸入email");
		varify =  false;
	}
	else 
	{
		var atPos = email.indexOf("@");
		var lastDotPos = email.lastIndexOf(".");
		
		if (atPos == -1 && lastDotPos == -1 )
		{
			$("#emailErr").text("至少要有一個 @ 與一個 .");
			varify =  false;
		}
		if (atPos == 0)
		{
			$("#emailErr").text("@不可以在第一個位置");
			varify =  false;				
		}
		if (lastDotPos - atPos < 2 )
		{
			$("#emailErr").text("最後一個.必須在@之後且不能相連");
			varify =  false;
		}
		if (email.length - lastDotPos < 2)
		{
			$("#emailErr").text("最後一個.之後最少還有兩個字元");
			varify =  false;
		}
	}

	return varify;
}

function emailCheck() {
	
	//declare input field value				
	var account = document.getElementById("account").value;
	var email = document.getElementById("email").value;		
	var form = document.getElementById("form");						
	
	//reset error message
	$("#emailErr").text("");
	$("#accountErr").text("");
	
	// declare boolean check
	var check = 1;
	
	//Verify account
	if (account == "") {
		$("#accountErr").text("請輸入帳號");
		check = 0;
	}
	
	//Verify email
	if (email == "") {
		$("#emailErr").text("請輸入信箱");
		check = 0;
	}
	else {
		var atPos = email.indexOf("@");
		var lastDotPos = email.lastIndexOf(".");
		if (atPos == -1 && lastDotPos == -1 )
		{
			$("#emailErr").text("至少要有一個 @ 與一個 .");
			check = 0;
		}
		if (atPos == 0)
		{
			$("#emailErr").text("@不可以在第一個位置");
			check = 0;				
		}
		if (lastDotPos - atPos < 2 )
		{
			$("#emailErr").text("最後一個.必須在@之後且不能相連");
			check = 0;
		}
		if (email.length - lastDotPos < 2)
		{
			$("#emailErr").text("最後一個.之後最少還有兩個字元");
			check = 0;
		}

	}

	//pass check,submit the form
	if ( check == 1 ) {
		form.submit();
	}
	
}

function accountCheck() {
	//declare input field value	
	var account = document.getElementById("inputAcc").value;
	var password = document.getElementById("inputPassword").value;		
	var form = document.getElementById("form");	
	
	//reset error message
	$("#accountErr").text("");
	$("#pwdErr").text("");
	
	// declare boolean check
	var check = 1; 
	
	//check account
	if (account == "") {
		$("#accountErr").text("請輸入帳號");
		check = 0;
	}
	
	//check password
	if (password == "") {
		$("#pwdErr").text("請輸入密碼");
		check = 0;
	}
	
	if (check == 1) {
		form.submit();
	}
}
