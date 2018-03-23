<?php session_start() ?>
<?php

include( "config.php" );

$pageLook_U =
'<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Author" content="NCU IM Group 16">
<meta name="Description" content="This is a learning system to help the members of New Life Co. learn how to write webpages.">
<meta name="Creation-Date" content="01-Sep-2015 08:00">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>E-learning System</title>

<!--icon-->
<link href="assets/img/favicon.ico" rel="SHORTCUT ICON">

<!--Bootstrap-->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap-social.css">
<link rel="stylesheet" href="../assets/css/font-awesome.css">

<!--Customized CSS Settings-->
<link rel="stylesheet" href="../assets/css/hippo.css">
<link rel="stylesheet" href="../assets/css/progress-bar.css">
<link rel="stylesheet" href="../assets/css/php-msg.css">
<style>
</style>
</head>

<body class="full">

<!-- Main Content -->
<div id="content">
<div class="php-msg" id="message">';

$pageLook_L =
'</div>
<div class="p-box">
    <div class="loader">Loading...</div>
</div>
</div>
</body>
</html>';

$pageLook_LL =
'</div>
</div>
</body>
</html>';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * PHP file that uploads files and handles any errors that may occur
 * when the file is being uploaded. Then places that file into the 
 * "uploads" directory. File cannot work is no "uploads" directory is created in the
 * same directory as the function. 
 */

$fileName = $_FILES["uploaded_file"]["name"];//the files name takes from the HTML form
$fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"];//file in the PHP tmp folder
$fileType = $_FILES["uploaded_file"]["type"];//the type of file 
$fileSize = $_FILES["uploaded_file"]["size"];//file size in bytes
$fileErrorMsg = $FILES["uploaded_file"]["error"];//0 for false and 1 for true
$target_path = "../uploads/" . basename($_FILES["uploaded_file"]["name"]); 

$flag = 0;
//START PHP Image Upload Error Handling---------------------------------------------------------------------------------------------------

    //no file was chosen ie file = null
    if ( !$fileTmpLoc )
    {
        $MSG = "請選擇檔案上傳喔！即將跳轉回前一頁";
        echo $pageLook_U.$MSG.$pageLook_L;
        $flag = 1;
        echo '<meta http-equiv=REFRESH CONTENT=3;url=../upload-user-img.php>';
    }
    //if file is > 16MB (Max size of MEDIUMBLOB)
    else if ( !$fileSize > 16777215 && $flag != 1 )
    {
        $MSG = "您的檔案大於 16 Megabytes（MB）喔！即將跳轉回前一頁";
        echo $pageLook_U.$MSG.$pageLook_L;
        unlink($fileTmpLoc);//remove the uploaded file from the PHP folder
        $flag = 1;
        echo '<meta http-equiv=REFRESH CONTENT=3;url=../upload-user-img.php>';
    }
    //this codition allows only the type of files listed to be uploaded
    else if ( !preg_match("/\.(jpg|jpeg|png|gif)$/i", $fileName) && $flag != 1 )
    {
        $MSG = "您上傳檔案的格式不合喔！<br />支援的檔案為 .gif, .jpg, .jpeg 或 .png<br />即將跳轉回前一頁";          
        echo $pageLook_U.$MSG.$pageLook_L;
        unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder
        $flag = 1;
        echo '<meta http-equiv=REFRESH CONTENT=3;url=../upload-user-img.php>';
    }
    //if file uploaded error key = 1 ie is true
    else if ( $fileErrorMsg == 1 && $flag != 1 )
    {
        $MSG = "對不起！<br />因為發生錯誤，檔案無法上傳，請再試一次。<br />若問題仍無法解決，請聯絡系統管理員，感謝您！";
        echo $pageLook_U.$MSG.$pageLook_L;
        $flag = 1;
        echo '<meta http-equiv=REFRESH CONTENT=3;url=../upload-user-img.php>';
    }


    //END PHP Image Upload Error Handling---------------------------------------------------------------------------------------------------------------------


    //Place it into your "uploads" folder using the move_uploaded_file() function


    //Check to make sure the result is true before continuing
    if(!move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_path))
    {
        $MSG = "發生錯誤：檔案無法上傳，請再試一次！";
        unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder
        echo $pageLook_U.$MSG.$pageLook_LL;
        echo '<meta http-equiv=REFRESH CONTENT=3;url=../upload-user-img.php>';
        ini_set('display_errors',1);
        error_reporting(-1);
    }
    else
    {
        $path = "../uploads/".$_SESSION['account'].$dft_img_format;
        rename( $target_path, $path );
        chmod( $path, 0644 );
        $MSG = "上傳成功<br />等待網頁跳轉";
        echo $pageLook_U.$MSG.$pageLook_L;
        echo '<meta http-equiv=REFRESH CONTENT=3;url=../modify.php>';
    }
?>