<?php

require_once '../libs/BaiduPCS.class.php';

$allowedTypes = array("image/gif","image/jpeg","image/pjpeg","image/png","image/x-png");
$allowedExts = array('jpg','jpeg','gif','bmp','png');

$fieldName = 'iuploadFile';
$uploadDir = '../upload_images/';
$json = array();

$prefix = $_SERVER['HTTP_HOST'].'/'.str_replace( 'upload.php', '', $_SERVER['REQUEST_URI'] ).'/';
$prefix = 'http://'.str_replace('//','/', $prefix);

$org_filename = $_FILES[$fieldName]["name"];
$file_ext = substr(strrchr($org_filename,"."),1); 

//检查扩展名
if(in_array(strtolower($file_ext),$allowedExts)) {
	//检查文件类型(content_type)
	if( in_array(strtolower($_FILES[$fieldName]["type"]), $allowedTypes )){
		if( $_FILES[$fieldName]["error"] > 0 ){
			$json['status'] = 'error';
			$json['message']= $_FILES[$fieldName]["error"];    
		} else {



//请根据实际情况更新$access_token与$appName参数
$access_token = '3.484e4b5df221b18239299071af96e433.2592000.1365768505.2432987871-597199';
//应用目录名
$appName = '小明相册';
//应用根目录
$root_dir = '/apps' . '/' . $appName . '/';

//上传文件的目标保存路径，此处表示保存到应用根目录下
$targetPath = $root_dir;
//要上传的本地文件路径
//$file = dirname(__FILE__) . '/' . 'yun.jpg';
$file = $_FILES[$fieldName]["tmp_name"];
//print_r($_FILES);
//文件名称
$fileName = basename($file);
//新文件名，为空表示使用原有文件名
$newFileName = md5(time(). "_" . $_FILES[$fieldName]["name"]) . "." . $file_ext;;

$pcs = new BaiduPCS($access_token);

if (!file_exists($file)) {
	exit('文件不存在，请检查路径是否正确');
} else {
	$fileSize = filesize($file);
	$handle = fopen($file, 'rb');
	$fileContent = fread($handle, $fileSize);

	$result = $pcs->upload($fileContent, $targetPath, $fileName, $newFileName);
	fclose($handle);
	
	print_r($result);
	$json['status'] = 'success';
	$json['file'] = $root_dir . $newFileName;
}		
		}	  
	}else{
	  $json['status'] = 'error';
	  $json['message'] = 'File type '. stripslashes($_FILES[$fieldName]["type"]).' is not allowed';
	}
} else {
    $json['status'] = 'error';
    $json['message']= 'invalid file extention';  
}
?>

<script type="text/javascript" charset="utf-8">
  window.response = <?php echo json_encode($json); ?>;
</script>

