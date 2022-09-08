<?php
/**
 * 修改
 */
require_once '../../library/app.php';

use \library\Db;
use \library\Config;
use \library\Validate;
use \library\Safe;
use \library\Auth;

$config = Config::getAll();
$dictionary = array();
$sql = '';
$data = array();

// 验证
if(!Auth::isLogin()){
    header('location:../../my/login.php');
    exit;
}
if(!Auth::isPermission('system_dictionary')){
    header('location:../../error.php?message='.urlencode('无权限'));
    exit;
}

Validate::setRule(array(
    'id' => 'require|number'
));
Validate::setMessage(array(
    'id.require' => 'id参数错误',
    'id.number' => 'id必须是个数字'
));
if(!Validate::check($_GET)){
    header('location:../../error.php?message='.urlencode(Validate::getErrorMessage()));
    exit;
}

$sql = 'select id, type, `key`, `value`, `sort` from dictionary where id = :id';
$data = array(
    ':id'=>$_GET['id']
);
$dictionary = Db::selectRow($sql, $data);
$dictionary = Safe::entity($dictionary);

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>修改字典</title>
<script type="text/javascript" src="<?php echo $config['app_domain'];?>js/jquery-1.12.4/jquery.min.js"></script>
<link href="<?php echo $config['app_domain'];?>js/sun-1.0.0/sun.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $config['app_domain'];?>js/sun-1.0.0/sun.js"></script>
<link href="<?php echo $config['app_domain'];?>css/system/dictionary/edit.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $config['app_domain'];?>js/system/dictionary/edit.js"></script>
</head>

<body class="page">
<form method="post" action="edit_save.php" class="sun-form-brief form">
<div class="page_body">
<input type="hidden" name="id" value="<?php echo $dictionary['id'];?>" />
<div class="row">
<div class="title"><span class="required">*</span> 字典类型</div>
<div class="content">
<input type="text" name="type" id="type" value="<?php echo $dictionary['type'];?>" />
</div>
</div>

<div class="row">
<div class="title"><span class="required">*</span> 字典键</div>
<div class="content">
<input type="text" name="key" id="key" value="<?php echo $dictionary['key'];?>" />
</div>
</div>

<div class="row">
<div class="title"><span class="required">*</span> 字典值</div>
<div class="content">
<input type="text" name="value" id="value" value="<?php echo $dictionary['value'];?>" />
</div>
</div>

<div class="row">
<div class="title"><span class="required">*</span> 排序</div>
<div class="content">
<input type="number" name="sort" id="sort" value="<?php echo $dictionary['sort'];?>" />
</div>
</div>

</div>
<div class="page_button">
<a href="javascript:;" class="sun-button plain" onClick="window.parent.sun.layer.close('layer_dictionary_edit');">关闭</a>
<input type="submit" class="sun-button" value="提交" />
</div>
</form>
</body>
</html>