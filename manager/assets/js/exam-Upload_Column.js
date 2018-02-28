	var qCount = 2; //題號計數器，從第二題開始
	//宣告父Div元素
	var parentDiv = document.getElementById("questionSection");
	function addColumn() {
		//建立考題輸入div子元素
		var childDiv = document.createElement("div");
		//設定考題輸入div的內容，以innerHTML來添加
		childDiv.innerHTML += "<h3>第"+qCount+"筆資料</h3>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"Number\" class=\"col-md-2\" control-label >請輸入題號：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"Number\" class=\"form-control\" name=\"q"+qCount+"\" type=\"number\" min=\"1\" \" /><span class=\"help-block\" >題號請輸入純數字，由第1題開始算起。</span><p class=\"text-danger\" >重複的題號將導致資料庫新增資料失敗!</p></div>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"Textarea\" class=\"col-md-2\" control-label >請輸入題目敘述：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><textarea id=\"q"+qCount+"Textarea\" class=\"form-control\" name=\"q"+qCount+"Descript\" form=\"examInfo\" required=\"required\" ></textarea><span class=\"help-block\" >輸入題目敘述，不需包含配分說明</span></div>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"option1\" class=\"col-md-2\" control-label >請輸入選項一敘述：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option1\" class=\"form-control\" name=\"q"+qCount+"-1\" type=\"text\" required=\"required\" value=\"\" /></div>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"option2\" class=\"col-md-2\" control-label >請輸入選項二敘述：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option2\" class=\"form-control\" name=\"q"+qCount+"-2\" type=\"text\" required=\"required\" value=\"\" /></div>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"option3\" class=\"col-md-2\" control-label >請輸入選項三敘述：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option3\" class=\"form-control\" name=\"q"+qCount+"-3\" type=\"text\" required=\"required\" value=\"\" /></div>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"option4\" class=\"col-md-2\" control-label >請輸入選項四敘述：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option4\" class=\"form-control\" name=\"q"+qCount+"-4\" type=\"text\" required=\"required\" value=\"\" /></div>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"Answer\" class=\"col-md-2\" control-label >請選擇正確答案：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><select id=\"q"+qCount+"Answer\" class=\"form-control\" name=\"q"+qCount+"Ans\" form=\"examInfo\" required=\"required\"><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option></select></div>";
		childDiv.innerHTML += "<label for=\"q"+qCount+"point\" class=\"col-md-2\" control-label >請輸入配分：</label>";
		childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"point\" class=\"form-control\" name=\"q"+qCount+"Point\" type=\"number\" min=\"1\" required=\"required\" value=\"\" /><span class=\"help-block\" >輸入純數字，無須加其餘文字與符號</span></div>";	
		childDiv.innerHTML += "<hr />";	
		//新增子元素至父元素中
		parentDiv.appendChild(childDiv);	
		//題號計數器+1
		qCount++;
	}
	
	function deleteColumn() {				
		if( qCount > 2) {
			parentDiv.removeChild(parentDiv.lastChild);
			qCount--;
		}		
	}