/**
 * 添加用户
 */
var add = {};

/**
 * 提交表单
 */
add.formSubmit = function(){
    var layerIndex = 0;
    
    
    layerIndex = parent.layer.getFrameIndex(window.name);
    parent.layer.close(layerIndex);
}

$(function(){
    $('#example-getting-started').multiselect({
            enableFiltering: true,
            includeSelectAllOption: true,
            selectAllText: '全选'
        });
});