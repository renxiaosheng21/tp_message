<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>发表留言</title>
    <script type="text/javascript" src="/self_demo/tp_message/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/self_demo/tp_message/Public/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/self_demo/tp_message/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    <div align="center">
        <h1>发表留言</h1>
        <form action="/self_demo/tp_message/index.php/Home/Index/do_post" method="post">
            <textarea rows="30" cols="100" name="content" id="content"></textarea>
            <br>
            <button>发表</button>
            <button type="reset">重置</button>
        </form>

        <P>
            <a href="/self_demo/tp_message/index.php/Home/Index/index">首页</a>
        </P>
    </div>
</body>
<script type="text/javascript">
    UE.getEditor('content',{initialFrameWidth:800,initialFrameHeight:200})
</script>
</html>