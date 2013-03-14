iUpload-pcs
===========

使用百度bae上的个人云存储（PCS）进行文件上传

百度个人云存储PCS文档：
http://developer.baidu.com/wiki/index.php?title=docs/pcs


# 使用方法

## 1. 部署iupload
- 将iupload文件夹拷贝到某目录，示例中为与index.php同一目录

## 2. 设置上传目录
- 修改iupload/upload.php中的设置

````php 
$uploadDir = '../upload_images/';
````

## 3. 引入iupload.js

````php 
<script src="./iupload/i_upload.js" type="text/javascript" ></script>
````

## 4. HTML代码

````php 
  <div class="controls">
  <div id="uploader_image" style="width:220px;height:30px;">
  </div>
  <input type="hidden"  id="image_url" name="image_url">
  <div id="uploader_image_display" style="width:220px;">
  </div>
  </div>
````

## 5. Javascript调用iupload代码

````javascript 
<script type="text/javascript" >
$(function(){
  var uploader_image = new dpm.IUpload( {
    container:'#uploader_image',
    action:"./upload.php",
    iframe_src:"./iupload/iframe.html",
    label:"上传截图"
  } );  

  uploader_image.uploadComplete = function(response){
    if( response.status == "success" ){
    $("#image_url").val(response.file);
    $('#uploader_image_display').html('<img src="'+response.file+'" width="220px" />');
    }else{
    alert(response.message);
    }
  };
});
</script>
````
