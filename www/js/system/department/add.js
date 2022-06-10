/**
 * 添加部门
 */

var add = {};

/**
 * 选择部门
 */
add.selectDepartment = function(){
    var url = "add_select_department.php";
    window.parent.sun.layer.open({
        id: "layer_add_select_department",
        name: "选择上级部门",
        url: url,
        width: 500,
        height: 300
    });
}

/**
 * 选择部门回调
 * @param json node 节点数据
 */
add.selectDepartmentCallback = function(node){
    var domParentId = $("#parent_id");
    var domParentName = $("#parent_name");
    
    domParentId.val(node.id);
    domParentName.val(node.name);
}

/**
 * 提交表单
 */
add.formSubmit = function(){
    sun.formSubmit({
        selector: ".form",
        success: function(ret){
            if(ret.status == "error"){
                sun.toast("error", ret.message, 3000);
                if(ret.data && ret.data.dom){
                    $(ret.data.dom).focus();
                }
                return;
            }
            sun.toast("success", ret.message, 1000, function(){
                window.parent.location.reload();
            });
        }
    });
}

$(function(){
    add.formSubmit();
});