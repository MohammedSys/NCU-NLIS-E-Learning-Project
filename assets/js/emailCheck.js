function emailCheck() {
	//declare input field value				
	var email = document.getElementById("email").value;								
	$("#emailErr").text("");

	//Verify email
	var atPos = email.indexOf("@");
	var lastDotPos = email.lastIndexOf(".");
	if (atPos == -1 && lastDotPos == -1 )
	{
		$("#emailErr").text("至少要有一個 @ 與一個 .");
		return false;
	}
	if (atPos == 0)
	{
		$("#emailErr").text("@不可以在第一個位置");
		return false;				
	}
	if (lastDotPos - atPos < 2 )
	{
		$("#emailErr").text("最後一個.必須在@之後且不能相連");
		return false;
	}
	if (email.length - lastDotPos < 2)
	{
		$("#emailErr").text("最後一個.之後最少還有兩個字元");
		return false;
	}
	if (email == "")
	{
		$("#emailErr").text("此項不能是空的");
		return false;
	}
	return true;
}
