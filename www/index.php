<?php
/**
 * 首页
 */
require_once 'library/app.php';

use library\Config;
use library\FrameMain;
use library\Auth;

$config = array();
$frameMainMenu = '';
$timeLogin = '无';
$ip = '无';

if(!Auth::isLogin()){
    header('location:my/login.php');
    exit;
}

$config = Config::getAll();
$frameMainMenu = FrameMain::getPageLeftMenu('home');
if($_SESSION['user']['time_login'] > 0){
    $timeLogin = date('Y-m-d H:i:s', $_SESSION['user']['time_login']);
}
if($_SESSION['user']['ip']){
    $ip = $_SESSION['user']['ip'];
}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $config['app_name'];?></title>
<script type="text/javascript" src="<?php echo $config['app_domain'];?>js/jquery-1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $config['app_domain'];?>js/inc/frame_main.js"></script>
<link href="<?php echo $config['app_domain'];?>js/sun-1.0.0/sun.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $config['app_domain'];?>js/sun-1.0.0/sun.js"></script>
<link href="<?php echo $config['app_domain'];?>css/index.css" rel="stylesheet" type="text/css" />
</head>

<body class="page">
<?php require_once __DIR__.'/public/frame_main_header.php';?>
<div class="page_body">
<?php require_once __DIR__.'/public/frame_main_left.php';?>
<div class="page_right">
<div class="header">
<div class="location">
<span class="iconfont icon-home icon"></span> 系统首页
</div>
<a href="javascript:;" onClick="location.reload();" class="refresh"><span class="iconfont icon-refresh icon"></span>刷新</a>
</div>
<div class="body">

<div class="welcome">
欢迎<span><?php echo $_SESSION['user']['name'];?></span>登录系统，
上次登录时间：<?php echo $timeLogin;?>，
上次登录ip：<?php echo $ip;?>
<div>

</div>
</div>

</div>
</div>
</div>
</body>
</html>