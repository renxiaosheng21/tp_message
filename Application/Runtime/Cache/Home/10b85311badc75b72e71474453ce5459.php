<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言内容修改</title>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script>
        function getUrlParam(name) {
            //构造一个含有目标参数的正则表达式对象
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg); //匹配目标参数
            if (r != null) {
                return unescape(r[2]);
            } else {
                return null; //返回参数值
            }
        }
    </script>

</head>
<body>
<form method="POST">
    <p>content:<input type="text" name="content" id="content"  value="<?php echo ($data["content"]); ?>"></p>

    <p><input type="submit" value="更新"></p>
</form>

</body>
</html>