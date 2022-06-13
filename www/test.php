<?php

require_once 'library/app.php';

use think\facade\Db;
use library\model\BaseModel;
use library\service\ConfigService;

$baseModel = new BaseModel();


?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<script type="text/javascript" src="js/plug/jquery-1.12.4/jquery.min.js"></script>
<link href="js/plug/sun-1.0.0/sun.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/plug/sun-1.0.0/sun.js"></script>
<script type="text/javascript">
$(function(){
    /*
    sun.dropDownHover({
        element: ".sun_dropdown"
    });
    */
    
    sun.fileUpload({
        element: ".sun_button",
        name: "file",
        url: "test2.php",
        success: function(ret){
            alert(JSON.stringify(ret));
        }
    });
    
});
</script>
</head>

<body style="padding-left: 300px; padding-top: 100px">

<!--
<span class="sun_dropdown">
<div class="title">标题</div>
<div class="content">content</div>
</span>
-->

<span class="sun_button">上传</span>

</body>
</html>