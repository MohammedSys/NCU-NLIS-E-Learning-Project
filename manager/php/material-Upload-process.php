<?php
 	include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	//接收教材資訊
	$subject = htmlspecialchars($_POST['subject']) ; //教材主題
	$chapter = htmlspecialchars($_POST['chapter']); //教材章節
	$title = htmlspecialchars($_POST['title']); //教材名稱
	$intro = htmlspecialchars($_POST['intro']); //教材簡介
	$descript = htmlspecialchars($_POST['descript']); //教材敘述
	$teacher = htmlspecialchars($_POST['teacher']);  //教材講師
	// 檢查上傳資料夾是否存在，不存在則建立資料夾;
	$upload_folder = "../../assets/tms/".$subject;
	if( !is_dir($upload_folder) ) {
		chdir("../../assets/tms/");
		if(!mkdir($subject, 0777, true)) {
			// var_dump(realpath($upload_folder)); 印出實體位置
			// echo getcwd()."<br>";
			// echo $subject."<br>";	
			die("上傳目錄不存在，並且建立資料夾失敗");
		}
	}

	//上傳教材資訊至資料庫
	$sql = "SELECT chapter FROM teachingMaterial WHERE subject = '$subject' AND chapter = '$chapter'";
	$result = mysql_query($sql);
	$error = mysql_error();
	$row = mysql_fetch_row($result);
	if ($row[0] == null) {
		//上傳檔案變數宣告
		$fileName = $_FILES["material_file"]["name"]; //the files name takes from the HTML form
		$fileTmpLoc = $_FILES["material_file"]["tmp_name"]; //file in the PHP tmp folder
		$fileType = $_FILES["material_file"]["type"]; //the type of file 
		$fileSize = $_FILES["material_file"]["size"]; //file size in bytes
		$fileErrorMsg = $FILES["material_file"]["error"]; //0 for false and 1 for true
		$target_path = "../../assets/tms/".$subject."/".basename($_FILES["material_file"]["name"]);
		//開始上傳檔案錯誤處理
		if(!$fileSize > 16777215)//if file is > 16MB (Max size of MEDIUMBLOB)
	    {
	        echo "ERROR: Your file was larger than 16 Megabytes";
	        unlink($fileTmpLoc);//remove the uploaded file from the PHP folder
	        exit();
	    }
	    else if(!preg_match("/\.(pdf)$/i", $fileName))//this codition allows only the type of files listed to be uploaded
	    {      	
	        echo "ERROR: Your file was not .pdf";		
	        unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder
	        exit();
	    }
	    else if($fileErrorMsg == 1)//if file uploaded error key = 1 ie is true
	    {
	        echo "ERROR: An error occured while processing the file. Please try again.";
	        exit();
	    }
		
		//將檔案從暫存資料夾移至教材資料夾
		 if(!move_uploaded_file($_FILES["material_file"]["tmp_name"], $target_path))
	    {
	        echo "ERROR: File not uploaded. Please Try again.";
	        unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder
			ini_set('display_errors',1);
			error_reporting(-1);			
	    }
	    else
	    {
		    //重新命名上傳檔案	
		    rename($target_path, "../../assets/tms/".$subject."/Chapter-".$chapter."-slide.pdf");	
			$message .= '檔案庫上傳成功\\n';
			$sql2 = "INSERT INTO teachingMaterial ( subject, chapter, title, intro, descript, teacher ) VALUES ('$subject','$chapter','$title','$intro','$descript','$teacher')";
			//如果資料庫新增成功，處理上傳檔案
			if ( mysql_query($sql2) ) {
				$message .= '資料庫上傳成功\\n';				
	  	
			}else {
				$message = '資料庫上傳失敗:'.$error.'。';				
			}						   	
	    }// end of move file
					
	}else {
		$message = '教材章節已存在!';
	}

	echo '<script type="text/javascript">alert("'.$message.'");</script>';
	echo "<meta http-equiv=REFRESH CONTENT=0;url=../material-Select.php>";
	
	
	
?>