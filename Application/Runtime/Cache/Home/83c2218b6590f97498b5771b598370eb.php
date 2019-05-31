<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>留言板首页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function display_alert()
        {
            if(confirm("确定退出登录？")){
                location.href="<?php echo U('User/logout');?>";
            }
        }

    </script>
</head>
<body>
<div align="center">
    <h1>留言板</h1>
</div>
<nav class="navbar navbar-default" role="navigation">

    <?php if(empty($_SESSION['user']['username'])): ?><ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo U('Home/User/login');?>"><span class="glyphicon glyphicon-user"></span>登录</a></li>
            <li><a href="<?php echo U('User/register');?>"><span class="glyphicon glyphicon-log-in"></span>注册</a></li>
        </ul>

        <?php else: ?><!--else标签-->
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo U('Index/post');?>"><span class="btn btn-info"></span>发表留言</a></li>
            <li class="dropdown all-camera-dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php echo ($_SESSION['user']['username']); ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li ><a href="#" onclick="display_alert()">退出登录</a></li>
                    <li><a href="<?php echo U('User/edit');?>">修改密码</a></li>
                </ul>
            </li>

        </ul><?php endif; ?>

    <form class="navbar-form navbar-left" role="search" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="content" id="content">
        </div>
        <button type="submit" class="btn btn-default">查询</button>
    </form>
</nav>

</body>

</html>