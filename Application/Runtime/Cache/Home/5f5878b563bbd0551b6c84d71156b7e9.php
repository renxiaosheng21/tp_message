<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>留言板首页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        #header {
            text-align:center;
            padding:5px;
        }
        #nav {
            line-height:40px;
            background-color:#eeeeee;
            height:530px;
            width:100px;
            float:left;
            padding:5px;
        }
        #section {
            width:950px;
            float:left;
            padding:10px;
        }
        #footer {
            clear:both;
            text-align:center;
            padding:5px;
        }
    </style>
</head>
<div id="header">
    <!DOCTYPE html>
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

<nav class="navbar navbar-default" role="navigation">
   <!-- <div align="center">
        留言板
    </div>-->
    <?php if(empty($_SESSION['user']['username'])): ?><ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo U('Home/User/login');?>"><span class="glyphicon glyphicon-user"></span>登录</a></li>
            <li><a href="<?php echo U('Home/User/register');?>"><span class="glyphicon glyphicon-log-in"></span>注册</a></li>
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
</div>

<div id="nav">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>留言板首页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="page-sidebar" id="sidebar">
    <div class="sidebar-header-wrapper">
        <i class="searchicon fa fa-search"></i>
    </div>
    <ul class="nav sidebar-menu">
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">管理员</span>
                <i class="menu-expand"></i>
            </a>

        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text">
                        栏目管理
                    </span>
                <i class="menu-expand"></i>
            </a>

        </li>


        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-file-text"></i>
                <span class="menu-text">文档</span>
                <i class="menu-expand"></i>
            </a>

        </li>

    </ul>
</div>
</body>
</html>
</div>

<div id="section">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>内容</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">

    <table class="table table-bordered">
        <thead>
        <tr>
            <td align="center" valign="middle" width="600">留言内容</td>
            <td align="center" valign="middle" width="200">留言时间</td>
            <td align="center" valign="middle" width="100">留言者</td>
            <?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(($_SESSION['user']['userId']) == $item["user_id"]): ?><td align="center" valign="middle" width="100">
                        操作
                    </td><?php endif; endforeach; endif; else: echo "" ;endif; ?>

        </tr>
        </thead>

        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tbody>
            <tr>
                <td align="center" valign="middle" width="600"><?php echo ($item["content"]); ?></td>
                <td align="center" valign="middle" width="200"><?php echo (date('Y-m-d H:i:s',$item["created_at"])); ?></td>
                <td align="center" valign="middle" width="100"><?php echo ($item["username"]); ?></td>

                <?php if(($_SESSION['user']['userId']) == $item["user_id"]): ?><td align="center" valign="middle" width="100">
                        <a href="<?php echo U('edit?id='.$item['message_id']);?>">
                            编辑
                        </a>
                        <a href="<?php echo U('delete?id='.$item['message_id']);?>" onclick="return confirm('确定删除此条留言？')">
                            删除
                        </a>
                    </td><?php endif; ?>

            </tr>

            </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>
</div>

</html>