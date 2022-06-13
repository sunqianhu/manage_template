/**
 * 部门管理
 */
var index = {};

/**
 * 添加
 * @param int parentId 上级id
 */
index.add = function(parentId){
    var url = "add.php?parent_id="+parentId;
    sun.layer.open({
        id: "layer_department_add",
        name: "添加部门",
        url: url,
        width: 600,
        height: 400
    });
}

/**
 * 修改
 */
index.edit = function(id){
    var url = "edit.php?id="+id;
    sun.layer.open({
        id: "layer_department_edit",
        name: "修改部门",
        url: url,
        width: 600,
        height: 400
    });
}

/**
 * 删除
 */
index.delete = function(id){
    var url = "delete.php?id="+id;
    var domTr = $(".data table .tr"+id);
    if(!confirm("确定删除吗？")){
        return;
    }
    
    $.getJSON(url, function(ret){
        if(ret.status == "error"){
            sun.toast("error", ret.message, 3000);
            return;
        }
        domTr.remove();
    });
}

$(function(){
    // 表格树
    sun.treeTable.init({
        element: ".sun_treetable",
        column: 1,
        expand: 3
    });
    
    sun.dropDownClickMenu({
        element: ".data table .operation_more"
    });
});