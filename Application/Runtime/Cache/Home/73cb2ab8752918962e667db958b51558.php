<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言内容修改</title>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

</head>
<body>

<form method="POST">
    <input type="hidden" name="id" id= "id" value="<?php echo ($data['message_id']); ?>" >
    <p>username:<input type="text" name="username" id="username"  value="<?php echo ($data['username']); ?>"></p>
    <p>password:<input type="password" name="password" id="password"></p>

    <p><input type="submit" value="更新"></p>
</form>

</body>
</html>