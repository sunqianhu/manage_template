<div class="page_header">
<div class="app_name"><?php echo $config['app_name'];?></div>
<div class="link">
<ul>
<li class="user">
<a href="javascript:;" class="title"><span class="iconfont icon-user icon"></span><?php echo $_SESSION['user']['name'];?></a>
<div class="content">
<ul>
<li><a href="javascript:;" onClick="frameMain.editPassword();">修改密码</a></li>
<li><a href="<?php echo $config['app_domain'];?>login/exit.php">退出登录</a></li>
</ul>
</div>
</li>
</ul>
</div>
</div>