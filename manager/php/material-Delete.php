<?php
	include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");	
	$subject = $_POST['subject'];
	$chapterArray = $_POST['chapter'];
	$fileDelNum = 0; //紀錄刪除了多少檔案
	$dataDelNum = 0; //紀錄刪除了多少筆資料
	$message = ""; //紀錄處理訊息
	chdir("../../assets/tms/"); //改變目前路徑至教材檔案庫
	//迴圈刪除資料庫教材資料、檔案庫教材檔案
	foreach ($chapterArray as $chapter) {	
		//刪除檔案庫中的檔案	
		if ( !unlink($subject."/Ch-".$chapter."-slide.pdf") ) {
			$message .= "檔案庫刪除失敗:".$subject."-".$chapter."。\\n";
			echo "error:delete file fail";				
		}else {	
			$fileDelNum ++; //教材檔案刪除成功，檔案刪除數+1
			//開始刪除資料庫教材資料
			$sql = "DELETE from teachingMaterial WHERE subject = '$subject' AND chapter = '$chapter'";
			if (mysql_query($sql)) {
				$dataDelNum ++;
			}else {
				$message .= "資料庫刪除失敗:".$subject."-".$chapter."。\\n";
			}
		}		
		
		
	}
	
	$message .= "【刪除完成】\\n共刪除".$fileDelNum."個檔案。\\n".$dataDelNum."筆資料。";
	echo '<script type="text/javascript">alert("'.$message.'");</script>';
	echo "<meta http-equiv=REFRESH CONTENT=0;url=../material-View.php>";
?>