<?php session_start(); ?>
<?php 
	require 'php/permission.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../objects/head-meta.php'; ?>
<?php include '../objects/head-link-sub.php'; ?>
<!--Customized CSS Settings-->
<link href="assets/css/simple-sidebar.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/exam-Upload.css">
</head>
<body>
	<div id="wrapper" class="toggled"><!-- Sidebar -->
		<?php include 'manager-menu.php'; ?>
		<?php include 'manager-header.php'; ?>
		<div id="content" class="fixed">				
			<div id="headerDiv" class="page-header">
				<h2 class="text-primary">章節練習題上傳 <small>請依順序輸入練習題的主題、章節、類型後，繼續填寫練習題內容並送出。</small></h2>				
				<hr>
			</div>		
			<form id="examInfo" class="form-horizontal" action="php/exam-Upload-process.php" method="post">
				<div id="topicDiv">
					<label for="examSubject" class="col-md-2" control-label >主題名稱</label>
					<div class="col-md-10">
						<input id="examSubject" class="form-control" type="text" name="subject" value="" required>
					</div>
					<label for="examType" class="col-md-2" control-label >類型</label>
					<div class="col-md-10">
						<select id="examType" class="form-control" name="examType" form="examInfo" required >
							<option value="chapter">章節考題</option>
							<option value="mix">綜合考題</option>
						</select>
						<span class="help-block" >單章節的練習題為章節考題；跨章節的練習題選綜合考題</span>
					</div>
					<label for="examChapter" class="col-md-2" control-label >考試章節</label>
					<div class="col-md-10" >
						<input id="examChapter" class="form-control" type="text" name="chapter" value="" required  >
						<span class="help-block" >若為綜合考題，請以逗號分開包含的章節。例如：1, 3, 10</span>
					</div>
				</div>			

				<div id="questionSection"></div> <!-- end of questionSection -->
					
				<div class="col-md-10" id="submitDiv">
					<button class="btn btn-info" type="button" onclick="addColumn()">新增考題欄位</button>
					<button class="btn btn-info" type="button" onclick="deleteColumn()">清除最後一筆考題欄位</button>
					<button class="btn btn-primary" type="submit" form="examInfo">上傳考題資料</button>
				</div>				
			</form>	
		</div><!-- end of content Div -->
	</div><!-- /#sidebar-wrapper -->
			
<!-- 新增考題 js，須放在 content 之下，才能讀取到需要的元素 -->
<script type="text/javascript">
var qCount = 1; // 題號計數器
// 宣告父 div 元素
var parentDiv = document.getElementById("questionSection");
function addColumn()
{
	//建立考題輸入 div 子元素
	var childDiv = document.createElement("div");
	//設定考題輸入 div 的內容，以 innerHTML 來添加
	childDiv.innerHTML += "<h3>第 "+qCount+" 筆資料</h3>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"Number\" class=\"col-md-2\" control-label >題號：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"Number\" class=\"form-control\" name=\"q"+qCount+"\" type=\"number\" min=\"1\" \" ><span class=\"help-block\" >題號純數字，由第1題開始算起。</span><p class=\"text-danger\" >重複的題號將導致資料庫新增資料失敗!</p></div>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"Textarea\" class=\"col-md-2\" control-label >題目敘述：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><textarea id=\"q"+qCount+"Textarea\" class=\"form-control\" name=\"q"+qCount+"Descript\" form=\"examInfo\" required=\"required\" ></textarea><span class=\"help-block\" >輸入題目敘述，不需包含配分說明</span></div>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"option1\" class=\"col-md-2\" control-label >選項一敘述：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option1\" class=\"form-control\" name=\"q"+qCount+"-1\" type=\"text\" required=\"required\" value=\"\" ></div>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"option2\" class=\"col-md-2\" control-label >選項二敘述：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option2\" class=\"form-control\" name=\"q"+qCount+"-2\" type=\"text\" required=\"required\" value=\"\" ></div>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"option3\" class=\"col-md-2\" control-label >選項三敘述：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option3\" class=\"form-control\" name=\"q"+qCount+"-3\" type=\"text\" required=\"required\" value=\"\" ></div>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"option4\" class=\"col-md-2\" control-label >選項四敘述：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"option4\" class=\"form-control\" name=\"q"+qCount+"-4\" type=\"text\" required=\"required\" value=\"\" ></div>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"Answer\" class=\"col-md-2\" control-label >正確答案：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><select id=\"q"+qCount+"Answer\" class=\"form-control\" name=\"q"+qCount+"Ans\" form=\"examInfo\" required=\"required\"><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option></select></div>";
	childDiv.innerHTML += "<label for=\"q"+qCount+"point\" class=\"col-md-2\" control-label >配分：</label>";
	childDiv.innerHTML += "<div class=\"col-md-10\" ><input id=\"q"+qCount+"point\" class=\"form-control\" name=\"q"+qCount+"Point\" type=\"number\" min=\"1\" required=\"required\" value=\"\" ><span class=\"help-block\" >輸入純數字，無須加其餘文字與符號</span></div>";
	//新增子元素至父元素中
	parentDiv.appendChild(childDiv);	
	//題號計數器+1
	qCount++;
}

function deleteColumn()
{
	if( qCount > 2)
	{
		parentDiv.removeChild(parentDiv.lastChild);
		qCount--;
	}		
}

$('document').ready( function()
{
	addColumn();
});
</script>
</body>
</html>
