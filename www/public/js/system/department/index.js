/**
 * 部门管理
 */
var index = {};

/**
 * 添加
 */
index.add = function(){
    var url = "department-add.html";
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
    var url = "department-edit.html?id="+id;
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
    var url = "department-delete.json?id="+id;
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

/**
 * 提示框
 */
index.bootstrapTooltip = function(){
    $('[data-toggle="tooltip"]').tooltip();
}

/**
 * 表格树展开关闭
 */
index.treeTableToggle = function(th){
    var domArrow = $(th);
    var domTr = domArrow.parents("tr").eq(0);
    var id = domTr.attr("tree_table_id");
    var close = domTr.hasClass("parent_close"); // 是否关闭
    
    if(close){
        domTr.removeClass("parent_close");
        index.treeTableSonOpen(id);
    }else{
        domTr.addClass("parent_close");
        // 递归关闭子项 添加 child_close
        index.treeTableChildClose(id);
    }
    
}

/**
 * 表格树打开儿子层
 */
index.treeTableSonOpen = function(id){
    var domTrs = $(".data table tr[tree_table_parent_id='"+id+"']");
    var domTr;
    var trLength = domTrs.length;
    
    if(trLength == 0){
        return;
    }
    
    domTrs.each(function(){
        domTr = $(this);
        domTr.removeClass("child_close");
    });
}

/**
 * 表格树递归关闭子项
 */
index.treeTableChildClose = function(id){
    var domTrs = $(".data table tr[tree_table_parent_id='"+id+"']");
    var domTr;
    var trLength = domTrs.length;
    var id = 0;
    
    if(trLength == 0){
        return;
    }
    
    domTrs.each(function(){
        domTr = $(this);
        id = domTr.attr("tree_table_id");
        
        domTr.addClass("child_close");
        domTr.addClass("parent_close");
        index.treeTableChildClose(id);
    });
}

$(function(){
    index.bootstrapTooltip();
});