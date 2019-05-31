<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>留言内容修改</title>
    <script type="text/javascript" src="/self_demo/tp_message/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/self_demo/tp_message/Public/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/self_demo/tp_message/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div align="center" id="section">

    <h1>留言修改</h1>
    <form method="post">
        <input type="hidden" name="id" id= "id" value="<?php echo ($data['message_id']); ?>" >
        <textarea rows="30" cols="80" name="content" id="content" ><?php echo ($data['content']); ?></textarea>
        <br>
        <button>修改</button>
        <button type="reset">重置</button>
    </form>

</div>

</body>
<script type="text/javascript">
    UE.getEditor('content',{initialFrameWidth:800,initialFrameHeight:200})
</script>
</html>