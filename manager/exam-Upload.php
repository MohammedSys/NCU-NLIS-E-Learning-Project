<?php session_start(); ?>
<?php 
	require 'php/permission.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="Author" content="NCU ISQ Group 16">
		<meta name="Description" content="The manager interface of New Life Co. E-learning System.">
		<meta name="Creation-Date" content="01-Sep-2015 08:00">		
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<title>E-learning System</title>	
		<!--icon-->
		<link href="../assets/img/newlife_circle.png" rel="SHORTCUT ICON">
		<!--Bootstrap-->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="../assets/css/font-awesome.css">	
		
		<!--Customized CSS Settings-->
		<!-- fixed menu setting -->
		<link href="../assets/css/hippo.css" rel="stylesheet">
		<link href="assets/css/simple-sidebar.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="assets/css/exam-Upload.css">
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	-->
	</head>

	<body>	
		<div id="wrapper" class="toggled"><!-- Sidebar -->
	        <?php include 'manager-menu.php'; ?>
	        <?php include 'manager-header.php'; ?>
			<div id="content" class="fixed">				
				<div id="headerDiv" class="page-header">
					<h2 class="text-primary">章節練習題上傳 <small>請依順序輸入練習題的主題、章節、類型後，繼續填寫練習題內容並送出。</small></h2>				
					<hr />
				</div>		
				<form id="examInfo" class="form-horizontal" action="php/exam-Upload-process.php" method="post">
					<div id="topicDiv">
						<label for="examSubject" class="col-md-2" control-label >主題名稱</label>
						<div class="col-md-10" >
							<input id="examSubject" class="form-control" type="text" name="subject" value="" required/>
						</div>
						<label for="examType" class="col-md-2" control-label >類型</label>
						<div class="col-md-10" >
							<select id="examType" class="form-control" name="type" form="examInfo" required >
									<option value="chapter">章節考題</option>
									<option value="mix">綜合考題</option>
							</select>
							<span class="help-block" >單章節的練習題為章節考題；跨章節的練習題選綜合考題</span>
						</div>
						<label for="examChapter" class="col-md-2" control-label >請輸入考試章節</label>
						<div class="col-md-10" >
							<input id="examChapter" class="form-control" type="text" name="chapter" value="" required  />
							<span class="help-block" >若為綜合考題，請以逗號分開包含的章節。例如：1, 3, 10</span>
						</div>
						<hr />
					</div>			
	
					<div id="questionSection">
						<div>
							<h3>第1筆資料</h3>
							<label for="q1Number" class="col-md-2" control-label >請輸入題號</label>
							<div class="col-md-10" >
								<input id="q1Number" class="form-control" name="q1" type="number" min="1" />
								<span class="help-block" >題號請輸入純數字，由第 1 題開始算起。</span>
								<p class="text-danger" >重複的題號將導致資料庫新增資料失敗！</p>
							</div>
							<label for="q1Textarea" class="col-md-2" control-label >請輸入題目敘述</label>
							<div class="col-md-10" >
								<textarea id="q1Textarea" class="form-control" name="q1Descript" form="examInfo" required="required" ></textarea>
								<span class="help-block" >輸入題目敘述，不需包含配分說明</span>
							</div>
							<label for="q1option1" class="col-md-2" control-label >請輸入選項一</label>
							<div class="col-md-10" >
								<input id="q1option1" class="form-control" name="q1-1" type="text" required="required" value="" />
							</div>
							<label for="q1option2" class="col-md-2" control-label >請輸入選項二</label>
							<div class="col-md-10" >
								<input id="q1option2" class="form-control" name="q1-2" type="text" required="required" value="" />
							</div>
							<label for="q1option3" class="col-md-2" control-label >請輸入選項三</label>
							<div class="col-md-10" >
								<input id="q1option3" class="form-control" name="q1-3" type="text" required="required" value="" />
							</div>
							<label for="q1option4" class="col-md-2" control-label >請輸入選項四</label>
							<div class="col-md-10" >
								<input id="q1option4" class="form-control" name="q1-4" type="text" required="required" value="" />
							</div>
	 						<label for="q1Answer" class="col-md-2" control-label >請選擇正確答案</label>
							<div class="col-md-10" >
								<select id="q1Answer" class="form-control" name="q1Ans" form="examInfo" required="required">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</div>
							<label for="q1point" class="col-md-2" control-label >請輸入配分</label>
							<div class="col-md-10" >
								<input id="q1point" class="form-control" name="q1Point" type="number" min="1" required="required" value="" />
								<span class="help-block" >輸入純數字，無須加其餘文字與符號</span>
							</div> 
							<hr />
						</div>					
					</div> <!-- end of questionSection -->
						
					<div class="col-md-10" id="submitDiv">
						<button class="btn btn-info" type="button" onclick="addColumn()">新增考題欄位</button>
						<button class="btn btn-info" type="button" onclick="deleteColumn()">清除最後一筆考題欄位</button>
						<button class="btn btn-primary" type="submit" form="examInfo">上傳考題資料</button>
					</div>				
				</form>	
			</div><!-- end of content Div -->
		</div><!-- /#sidebar-wrapper -->
				
		<!-- 新增考題js，須放在content之下，才能讀取到需要的元素 -->
		<script type="text/javascript" src="assets/js/exam-Upload_Column.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-trigger.js"></script>
	</body>
</html>
