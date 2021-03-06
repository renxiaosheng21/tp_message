<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>后台登录</title>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<div align="center">
    <h3>用户登录</h3>
    <form>
        <!--使用jquery来验证账户的唯一性，需要加onblur="checkName()",原生js不用-->
        <p>帐号: <input type="text" name="username" id="username" onblur="checkName()"></p>
        <span id="warning" style="color:red"></span>
        <p>密码: <input type="password" name="password" id="password"></p>
        <p><input type="submit" id="submit" value="提交" onclick = "check_login()"></p>
        <p id="tips"></p>
    </form>
    <p>
        <a href="/self_demo/tp_message/index.php/Home/User/register">去注册</a>
    </p>
</div>

</body>

<!--使用js ajax-->
<!--<script>
    var user = document.getElementById('username');  //获取用户控件

    user.onblur = function ()
    {  //当用户离开当前文本框时进行验证
        //1.创建Ajax对象
        var xhr = new XMLHttpRequest();
        //2.创建请求事件的监听
        xhr.onreadystatechange = function () {

            if(xhr.readyState==4 && xhr.status == 200){
                // console.log(xhr.responseText);
                var tips = document.getElementById('tips');
                //解析返回的json字符串
                var json = JSON.parse(xhr.responseText);

                if(json.code == 0){
                    var warning = document.getElementById('warning');
                    warning.innerHTML = json.data+"是新用户,请先注册再登录";
                    document.getElementById('submit').disabled = true;
                }
            }
        }

        //3.初始化一个url请求
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var data = 'username='+username+'&password='+password; //生成post请求数据
        var url = "/self_demo/tp_message/index.php/Home/User/check_user";
        xhr.open('post',url,true); //请求类型为post，交互方式为异步

        //4.设置请求头
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

        //5.发送url请求,需要传入参数
        xhr.send(data);
    };

    var submit  = document.getElementById('submit');
    submit.onclick = function () {
        //1.创建Ajax对象
        var xhr = new XMLHttpRequest();
        //2.创建请求事件的监听
        xhr.onreadystatechange = function () {
            // console.log(xhr);
            if(xhr.readyState==4 && xhr.status == 200){
               console.log(xhr.responseText);
                var tips = document.getElementById('tips');
                //解析返回的json字符串
                var json = JSON.parse(xhr.responseText);
                if(json.code == 1){
                    window.location.href="/self_demo/tp_message/index.php/Home/User/do_login";//跳转
                }
                else{
                    tips.innerHTML = '密码错误';
                }

            }
        };

        //3.初始化一个url请求
        var user = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var data = 'username='+user+'&password='+password; //生成post请求数据
        var url = "/self_demo/tp_message/index.php/Home/User/check_login";
        xhr.open('post',url,true); //请求类型为post，交互方式为异步

        //4.设置请求头
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

        //5.发送url请求,需要传入参数
        xhr.send(data);
        return false;  //禁止提交按钮的默认行为
    }
</script>-->
<!--使用jquery ajax-->
<script>
    function checkName() {
        var username = document.getElementById('username').value;
        //获取账号后的提示信息文本
        var tishi = document.getElementById("warning");
        $.ajax({
            url: "/self_demo/tp_message/index.php/Home/User/check_user", //后台查询验证的方法
            data: {
                "username": username
            }, //携带的参数，传递给控制器的参数
            type: "post",

            success: function (msg) {
                console.log(msg);
                //根据后台返回前台的msg给提示信息加HTML
                if (msg.code == 0) {
                    // 账号已经存在
                    tishi.innerHTML = "<font color='green'>" + msg.data + "是新用户,请先注册再登录</font>"
                    document.getElementById('submit').disabled = true;//禁用提交按钮
                }
            }
        });
    }
    /*验证登录账户的账户和密码是否则正确*/
    function check_login(){
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var tishi = document.getElementById("warning");
        $.ajax({
            url: "/self_demo/tp_message/index.php/Home/User/check_login", //后台查询验证的方法
            data: {
                "username": username,
                "password": password
            }, ///携带的参数，传递给控制器的参数
            type: "post",
            success: function (msg) {
                console.log(msg);
                if (msg.code == 1) {
                    // 账号已经存在
                    window.location.href="/self_demo/tp_message/index.php/Home/User/do_login";//跳转
                }
                //根据后台返回前台的msg给提示信息加HTML
                if (msg.code == 0) {
                    // 账号密码输入错误
                    tishi.innerHTML = msg.data ;
                }
            }
        });
    }
</script>

</html>