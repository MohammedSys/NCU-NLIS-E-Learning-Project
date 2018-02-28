<?php
 	include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	$count = 1; //題數計數器
	$dataCount = 0; //資料更新筆數
	$fileCount = 0; //檔案更新筆數
	$message = ""; //更新資訊
	
	while( !empty($_POST['subject'.$count]) ) {
		//取得資料庫所需欄位的資料	
		$preSubject = $_POST['pre-subject'.$count];
		$preChapter = $_POST['pre-chapter'.$count];
		$subject =  htmlspecialchars($_POST['subject'.$count]);
		$chapter =  htmlspecialchars($_POST['chapter'.$count]);
		$title =  htmlspecialchars($_POST['title'.$count]);
		$intro =  htmlspecialchars($_POST['intro'.$count]);
		$descript =  htmlspecialchars($_POST['descript'.$count]);
		$teacher =  htmlspecialchars($_POST['teacher'.$count]);		
		// 檢查更新資料夾是否存在，不存在則建立資料夾;
		$upload_folder = "../../assets/tms/".$subject;
		if( !is_dir($upload_folder) )
		{
			chdir("../../assets/tms/");
			if(!mkdir($subject, 0777, true)) {
				// var_dump(realpath($upload_folder)); 印出實體位置
				// echo getcwd()."<br>";
				// echo $subject."<br>";	
				die("上傳目錄不存在，並且建立資料夾失敗");
			}
		}
		//上傳檔案變數宣告
		$fileName = $_FILES["material_file".$count]["name"]; //the files name takes from the HTML form
		$fileTmpLoc = $_FILES["material_file".$count]["tmp_name"]; //file in the PHP tmp folder
		$fileType = $_FILES["material_file".$count]["type"]; //the type of file 
		$fileSize = $_FILES["material_file".$count]["size"]; //file size in bytes
		$fileErrorMsg = $FILES["material_file".$count]["error"]; //0 for false and 1 for true
		$target_path = "../../assets/tms/".$subject."/".basename($_FILES["material_file".$count]["name"]);
		//開始上傳檔案錯誤處理
		if(!$fileSize > 16777215)//if file is > 16MB (Max size of MEDIUMBLOB)
	    {
	        echo "ERROR: Your file was larger than 16 Megabytes";
			echo '<script type="text/javascript">alert("ERROR:Your file '.$fileName.' was larger than 16 Megabytes");</script>';		
	        unlink($fileTmpLoc);//remove the uploaded file from the PHP folder
	        exit();
	    }
	    else if(!preg_match("/\.(pdf)$/i", $fileName))//this codition allows only the type of files listed to be uploaded
	    {
	        echo '<script type="text/javascript">alert("ERROR:Your file '.$fileName.' was not .pdf ");</script>';	      	
	        echo "ERROR: Your file was not .pdf";		
	        unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder
	        exit();
	    }
	    else if($fileErrorMsg == 1)//if file uploaded error key = 1 ie is true
	    {
	        echo "ERROR: An error occured while processing the file. Please try again.";
			echo '<script type="text/javascript">alert("ERROR:An error occured while processing the file:'.$fileName.'. Please try again");</script>';
	        exit();
	    }
		
		//將檔案從暫存資料夾移至教材資料夾
		 if(!move_uploaded_file($_FILES["material_file".$count]["tmp_name"], $target_path))
	    {
			echo '<script type="text/javascript">alert("ERROR: File'.$fileName.' not uploaded. Please Try again.");</script>';
	        unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder
			ini_set('display_errors',1);
			error_reporting(-1);	
			exit();		
	    }
	    else
	    {
		    //重新命名上傳檔案	
		    rename($target_path, "../../assets/tms/".$subject."/Chapter-".$chapter."-slide.pdf");	
			$fileCount++;	
			//更新資料庫教材資料
			$sql = "UPDATE teachingMaterial SET subject = '$subject', chapter = '$chapter', title = '$title', intro = '$intro', descript = '$descript', teacher = '$teacher' WHERE subject = '$preSubject' AND chapter ='$preChapter'";
			$error = mysql_error();
			if ( mysql_query($sql) ) {
				$dataCount++;		    
			}else {
				$message .= "資料庫更新失敗:".$subject.",".$chapter."。\\n";
				echo $error;
				exit();
			}	
									   	
	    }// end of move file
		$count++; //題數計數器+1
	}
	
	$message .= "【更新結果】\\n資料庫更新:".$dataCount."題\\n檔案庫更新:".$fileCount."題";
	echo '<script type="text/javascript">alert("'.$message.'");</script>';
	echo "<meta http-equiv=REFRESH CONTENT=0;url=../material-View.php>";
?>