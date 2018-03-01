<?php session_start(); ?>
<?php
	require 'php/permission.php';
	include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );
?>
<?php    
    //經點選側邊選單來到classroom的資料處裡
    if ( $_POST['chapter'] != null ) {
        $URL = $_POST['chapter'];           
        if ( preg_match("/(.+)\/Chapter-(.+)-slide\.pdf/",$URL,$res) ) {
            $subject = $res[1];
            $recordChapter = $res[2];
        }
		
        $_SESSION['classURL'] = $URL;
        $_SESSION['subject'] = $subject;
        $_SESSION['chapter'] = $recordChapter;
    }
	
	//經點選歷史紀錄書籤連結來到classroom的資料處理
	if ($_POST['classNumber'] != null) {
		$classNumber = $_POST['classNumber'];
		$marksql = "SELECT URL,subject,chapter,page FROM bookMark WHERE bookMarkID = '$classNumber'";
		$markconn = mysql_query($marksql);
		$markRow = mysql_fetch_row($markconn);
        $_SESSION['classURL'] = $markRow[0];
        $_SESSION['subject'] = $markRow[1];
        $_SESSION['chapter'] = $markRow[2];
		$page = $markRow[3];
	}
    //將session資訊存入變數以方便使用
    $name = $_SESSION['account'];
    $subject = $_SESSION['subject'];
    $chapter = $_SESSION['chapter'];
	$URL = $_SESSION['classURL'];
    //連線資料庫取得筆記資料
    $sql = "SELECT note FROM classNote WHERE name = '$name' AND subject = '$subject' AND chapter = '$chapter'";
    $result = mysql_query($sql);
    $row = mysql_fetch_row($result);
    $error = mysql_error();
	
	//記錄課程瀏覽次數至資料庫
	$recordCheck = true; //判斷是否課程瀏覽紀錄重複
	$result = mysql_query("SELECT COUNT(name) AS number FROM userReview WHERE name = '$name'");
	$classRow = mysql_fetch_assoc($result);
	//資料數未達5筆，直接insert
	if ($classRow['number'] < 5) {
		$classSql = "SELECT name,classURL FROM userReview WHERE name = '$name'";
		$result = mysql_query($classSql);
		while ( $classRow = mysql_fetch_row($result) ) {
			//如果現在瀏覽課程已經在最近瀏覽紀錄中，則不重複記錄	
			if ( $classRow[1] == $URL ) {
				$recordCheck = false;
			}
		}
		//記錄未重複的課程瀏覽紀錄
		if ($recordCheck == true) {
			$classSql = "INSERT INTO userReview (name,classURL) VALUES ('$name','$URL')";
			if ( mysql_query($classSql) ) {
				//echo '<script type="text/javascript">alert("成功");</script>';
			} else {
				//echo '<script type="text/javascript">alert("紀錄新增失敗：'.mysql_error().'。返回上一頁");</script>';
			}

		}
	} 
	//資料數達5筆，先刪除最舊資料、新增新資料
	else {
		$classSql = "SELECT name,classURL FROM userReview WHERE name = '$name'";
		$result = mysql_query($classSql);
		while ( $classRow = mysql_fetch_row($result) ) {
			//如果現在瀏覽課程已經在最近瀏覽紀錄中，則不重複記錄	
			if ($classRow[1] == $_SESSION['classURL']) {
				$recordCheck = false;
			}
		}
		
		if ($recordCheck == true) {
			//搜尋最舊資料的ID
			$classSql = "SELECT MIN(userReviewID) FROM userReview WHERE name = '$name'";
			$result = mysql_query($classSql);
			if ($classRow = mysql_fetch_row($result)) {
				$select = $classRow[0];
			}
			//刪除指定帳號中，最舊ID的資料
			$classSql = "DELETE FROM userReview WHERE userReviewID = '$select'";
			if (mysql_query($classSql)) {
				//刪除成功，新增新的資料	
				$classSql = "INSERT INTO userReview (name,classURL) VALUES ('$name','$URL')";
				if (mysql_query($classSql)) {
					
				}else {
					//echo '<script type="text/javascript">alert("填滿紀錄新增失敗：'.mysql_error().'。返回上一頁");</script>';
				}
			} 
			else {
				//echo '<script type="text/javascript">alert("舊紀錄刪除失敗：'.mysql_error().'。返回上一頁");</script>';
			}
		}
	}

	//記錄課程瀏覽次數
	// if ( isset($_SESSION['classURL']) ) 
	// {
		// if ( isset($_SESSION['chIndex']) ) 
		// {
			// $valid = true;	
			// //檢查最近瀏覽課程是否重複		
			// for ($i=0; $i < 5 ; $i++) { 
				// if ($_SESSION['chapterFrquency'][$i] == $_SESSION['classURL']) {
					// $valid = false;
				// }
			// }	
			// if ($valid == true) {
				// if ($_SESSION['chIndex'] < 4) 
				// {
					// $_SESSION['chIndex'] += 1;
				// }
				// else 
				// {
					// $_SESSION['chIndex'] = 0;
				// }	
				// $_SESSION['chapterFrquency'][$_SESSION['chIndex']] = $_SESSION['classURL'] ;					
			// }								
		// }
		// else 
		// {
			// $_SESSION['chIndex'] = 0;
			// $_SESSION['chapterFrquency'][$_SESSION['chIndex']] = $_SESSION['classURL'] ;				
		// }	
	// }
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head.html'; ?>

<script type="text/javascript" src="assets/js/class-btn.js"></script>
<script type="text/javascript" src="assets/comps/oe/assets/js/online-editor.js"></script>
<script type="text/javascript" src="assets/js/classroom-markType.js"></script>

<script type="text/javascript">
	//add BookmarkPage function			
	function addPage(){			
		// $('#displayFrame').load(function() {						
			//get pageNum div in iframe
			var iframe = $('#displayFrame');
			var methodValue;										
			methodValue = iframe.get(0).contentWindow.setpageValue();								
			document.getElementById("page").innerHTML = "目前記錄頁數：" + methodValue;
			document.getElementById("mark").value = methodValue;
			// document.getElementById("markForm").submit()			
		// });					
	}// end of addPage()
	
	//search Input column detects enter key
	$("#searchInput").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("#searchForm").submit();
		}
	});
	
	var flag = 0;
	//筆記滑出功能
	$(document).ready(function(){
		$('#bs-example-navbar-collapse-1 ul li a').on("click", function(e){
			
			var hrefval = $(this).attr("href");
			if(hrefval == "#right-menu") {
				e.preventDefault();
				var distance = $('#right-menu').css('right');
				if( distance == "-350px" )
				{
					openSidepage();
					flag = 1;
				}
				else
				{
					closeSidePage();
					flag = 0;
				}
			}		
		});//end of click event handler
		
		function openSidepage()
		{
			$('#right-menu').animate({
				right: '0px'
			}, 400);
			
			document.getElementById("classNote").innerHTML='關閉筆記&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';	 
		}
		
		function closeSidePage()
		{
			$('#right-menu').animate({
				right: '-350px'
			}, 400);
			
			document.getElementById("classNote").innerHTML='筆記&nbsp;<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>';
		}
	});// end of 筆記滑出
	
	// $(window).scroll(function()
	// {
	// 	if ($(window).scrollTop() >= 60 && flag)
	// 	{
	// 		$('#notesF').addClass('fixed-header');
	// 	}
	// 	else
	// 	{
	// 		$('#notesF').removeClass('fixed-header');
	// 	}
	// });
</script>
</head>

<body id="B" class="full" onload="startup();">
	<a href="#" class="back-to-top"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></a>
	
	<?php include 'objects/siderbar.php'; ?>
	
	<div id="right-menu">
		<form id="noteForm" method="post" action="php/addNote.php" >
			<nav id="notesF">
				<div class="notesTitle">個人筆記</div><input class="saveButton" type="submit" value="儲存" />
			</nav>
			<textarea class="notes-ta" name="note"><?php echo $row[0]; ?></textarea>
		</form>
	</div>
	
	<!-- Page Header -->
	<header>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div id="logo_printer">
						<table class="a-hover txt-white" border="0" cellspacing="0" cellpadding="0">
							<tr id="left-menu-toggle">
								<a href="#left-menu"></a>
								<td><img alt="Brand" class="brand-icon" src="assets/img/newlife_circle.png"></td>
								<td width="40px"><div class="systemname"><span class="glyphicon glyphicon-menu-hamburger"></span></div></td>
							</tr>
						</table>
					</div>
				</div>
					
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php include 'objects/insystem-nav.html'; ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a data-toggle="modal" data-target="#noteInfo" onclick="addPage()">紀錄書籤</a></li>
						<!-- <li> -->
							<!-- <a href="#" id="setMark" onclick="addPage()" >加入書籤&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></a>
							<form id="markForm" method="post" target="_blank" action="php/addBookmark.php">					
								<input id="mark" type="hidden" name="mark" value=""/>
							</form> -->
						<!-- </li> -->
						<li><a href="#right-menu" id="classNote">筆記&nbsp;<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
						<li><?php include 'objects/usermenu.php'; ?></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	
	<!-- Page Content -->
	<div id="page-content-wrapper" class="margin-t-60">
		<!-- (Default) 16:9 aspect ratio -->
		<div id="slides-printer" class="embed-responsive embed-responsive-16by9">
			<iframe name="tmsbox" id="displayFrame" class="embed-responsive-item" src="assets/comps/pdf-js/web/viewer.html?file=./assets/tms/<?php echo $URL; if ($page != null) {echo "#page=".$page;} else {echo "#page=1";} ?>"></iframe>
		</div>
		
		<div>
			<iframe name="editbox" class="oe-body-frame" src="assets/comps/oe/oe_body.html" id="realTime" frameborder="0"></iframe>
		</div>
		<div>
			<iframe name="resultHead" class="oe-result-head-frame" src="assets/comps/oe/oe_result.html" id="realTime" frameborder="0"></iframe>
		</div>
		<!-- 4:3 aspect ratio -->
		<div class="embed-responsive embed-responsive-4by3">
			<iframe name="dynamicframe" class="dynamic-frame"></iframe>
		</div>			
		
		<!-- Modal -->
		<div id="noteInfo" class="modal fade" role="dialog">
			<div class="modal-dialog">	
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">紀錄書籤</h4>
				</div>
				<div class="modal-body">
				<p>請選擇書籤分類並輸入書籤敘述</p>
				<p>主題：<?php echo $subject; ?><br />目前章節：<?php echo $chapter; ?></p>
				<p id="page"></p>
				<form id="markForm" method="post" target="_blank" action="php/addBookmark.php" >
					<div class="form-group">
						<label for="classify">選擇分類</label>
						<div class="margin-t-5 margin-b-5">
							<button type="button" class="btn btn-sm btn-primary" onclick="markType(this)">進度</button>
							<button type="button" class="btn btn-sm btn-primary" onclick="markType(this)">重點</button>
							<button type="button" class="btn btn-sm btn-primary" onclick="markType(this)">常用</button>
						</div>	      
						<input type="text" class="form-control" id="classify" name="classify" placeholder="自行輸入分類">
					</div>
					<div class="form-group">
						<label for="markDescript">書籤敘述</label>
						<textarea maxlength="64" class="form-control" id="markDescript" name="markDescript" placeholder="輸入上限為 64 字" rows="3" required ></textarea>
					</div>
					<!--紀錄書籤頁數的input-->
					<input id="mark" type="hidden" name="mark" value=""/>
				</form>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="markSubmit()">紀錄書籤</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">取消紀錄</button>
				</div>
			</div>
		
			</div>
		</div>
		
		<!-- Footer -->
		<?php include 'objects/footer.php'; ?>
	</div>
	
	<!-- Menu Toggle Script -->
	<!-- And also checking the screen width to determine which ratio of slides printer should use -->
	<script>
		$(document).ready( function() { checkingSWidth(); });

		$(window).resize(function() {
			checkingSWidth();
		});
		
		function checkingSWidth()
		{
			if( $(window).width() > 767 )
			{
				$('#slides-printer').removeClass('embed-responsive-4by3');
				$('#slides-printer').addClass('embed-responsive-16by9');
				// alert("not responsive!");
			}
			else
			{
				$('#slides-printer').removeClass('embed-responsive-16by9');
				$('#slides-printer').addClass('embed-responsive-4by3');
				// alert("responsive!");
			}
		}
	</script>
</body>
</html>