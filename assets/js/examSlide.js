//考試詳細資料滑出功能
function toggle(btn) {										
	var nextTr = btn.parentElement.parentElement.nextElementSibling;										
	var childTd = nextTr.firstElementChild;
	if(childTd.className == "DIVclose") {
		childTd.className = "DIVopen";
	}else {
		childTd.className = "DIVclose";
	}
}