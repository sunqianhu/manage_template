<?php
/**
 * 部门服务
 */
namespace library\service\system;

class DepartmentService{
    
    /**
     * 得到首页节点树
     * @param array $datas 数据
     * @return array
     */
    static function getIndexTreeNode($departments, $level = 1){
        $node = '';
        if(!empty($departments)){
        foreach($departments as $department){
            $node .= '
<tr tree_table_id="'.$department['id'].'" tree_table_parent_id="'.$department['parent_id'].'" tree_table_level="'.$level.'" class="tr tr'.$department['id'].'">
<td>'.$department['id'].'</td>
<td class="column">'.$department['name'].'</td>
<td>'.$department['sort'].'</td>
<td>'.$department['remark'].'</td>
<td>
<a href="javascript:;" class="sun_button sun_button_secondary sun_button_small sun_mr5" onclick="index.add('.$department['id'].');" title="添加子部门">添加</a>
<a href="javascript:;" class="sun_button sun_button_small sun_button_secondary sun_mr5" onclick="index.edit('.$department['id'].');">修改</a>
<span class="sun_dropdown_menu sun_dropdown_menu_align_right operation_more">
<div class="title"><a href="javascript:;" class="sun_button sun_button_secondary sun_button_small">更多 <span class="iconfont icon-arrow_down arrow"></span></a></div>
<div class="content">
<ul>
<li><a href="javascript:;" onClick="index.delete('.$department['id'].')">删除</a></li>
</ul>
</div>
</span>
</td>
</tr>
';
            if(!empty($department['child'])){
                $node .= self::getIndexTreeNode($department['child'], ($level + 1));
            }
        }
        }else{
            $node = '<tr><td colspan="5" align="center">无部门</td></td>';
        }
        return $node;
    }
    
}
