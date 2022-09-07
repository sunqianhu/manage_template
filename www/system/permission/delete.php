<?php
/**
 * 删除
 */
require_once '../../library/session.php';
require_once '../../library/app.php';

use library\Db;
use library\Validate;
use library\Auth;

$return = array(
    'status'=>'error',
    'message'=>''
);
$permissionChild = array();
$permissionModel = new PermissionModel();

// 验证
if(!Auth::isLogin()){
    $return['message'] = '登录已失效';
    echo json_encode($return);
    exit;
}
if(!Auth::isPermission('system_permission')){
    $return['message'] = '无权限';
    echo json_encode($return);
    exit;
}

Validate::setRule(array(
    'id' => 'require:number'
);
Validate::setMessage(array(
    'id.require' => 'id参数错误',
    'id.number' => 'id必须是个数字'
);
if(!Validate::check($_GET)){
    $return['message'] = Validate::getErrorMessage();
    echo json_encode($return);
    exit;
}
if($_GET['id'] == '1'){
    $return['message'] = '不能删除根权限';
    echo json_encode($return);
    exit;
}

$permissionChild = Db::selectRow(
    'id',
    array(
        'mark'=>'parent_id = :id',
        'value'=> array(
            ':id'=>$_GET['id']
        )
    )
);
if(!empty($permissionChild)){
    $return['message'] = '该权限存在下级权限';
    echo json_encode($return);
    exit;
}

try{
    Db::delete(
        array(
            'mark'=>'id = :id',
            'value'=> array(
                ':id'=>$_GET['id']
            )
        )
    );
}catch(Exception $e){
    $return['message'] = $e->getMessage();
    echo json_encode($return);
    exit;
}

$return['status'] = 'success';
$return['message'] = '删除成功';
echo json_encode($return);
?>