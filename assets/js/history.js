//改變form action的按鈕方法，第一個參數是改變後的action值，第二個參數是所屬表單的id
function checkSubmit(action,form) {    			    
    //根據傳入參數宣告表單物件
    var submitForm = document.getElementById(form);
    submitForm.action = action;
    submitForm.submit();
}


//讓使用者只能勾選一項，參數select是使用者點擊的checkbox => checkbox使用
function checkOne(select){
	//先取得同name為account的chekcbox的集合物件
	var checkbox = document.getElementsByName("examID");
	for (i=0; i<checkbox.length; i++){
		//判斷checkbox集合中的i元素是否為被點擊的元素，若否則表示未被點選
		if (checkbox[i] != select) {
			checkbox[i].checked = false;
		}
		//如果是checkbox[i]物件與使用者點擊的checkbox是同一個，則設定i元素的狀態跟使用者點擊的checkbox狀態一樣
		else {
			checkbox[i].checked = select.checked;
		}	
	}
}	