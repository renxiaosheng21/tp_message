<?php

namespace Home\Controller;

use Think\Controller;
use Think\Model;

/**
*用户控制器
*/
class UserController extends Controller
{
    /**
    *注册表单
    */
    public function register(){
        $this->display();
    }

    /**
    *注册处理
    */

    public function do_register(){
        $username = I('username');
        $password = I('password');
        $repassword = I('repassword');

        if(empty($username)){
            $this->error('用户名不能为空');
        }
        if(empty($password)){
            $this->error('密码不能为空');
        }
        if($password != $repassword){
            $this->error('确认密码错误');
        }

        //检测用户是否被注册
        $model = new Model('user');//数据库表user
        $user = $model->where(array('username'=>$username))->find();
        if(!empty($user)){
            $this->error('用户名已存在');
        }

        $data = array(
            'username' => $username,
            'password' => md5($password),
            'created_at' => time()
        ); 

        if(!($model->create($data) && $model->add())){
            $this->error('注册失败',$model->getDbError());
        }
        $this->redirect('login');
//        $this->success('注册成功',U('login'));
    }
  /**
  *用户登录
  */
  public function login(){
    $this->display();
  }

  /**
  *登录处理
  */
    public function check_user(){
        $username = I('username');
//        $data = I('post.','','trim');//获取的是ajax提交过来的数据，不是表单提交过来的
        $model = new Model('user');
        $userList = $model->field( 'username')->select();
        $arr_username = array();

        for($i = 0; $i < count($userList); $i++) {
            $arr_username[]= $userList[$i]['username'];
        }
        //$a = in_array($data['username'],$arr_username)?1:0;
        //$this->ajaxReturn(array('code'=> $a,'data'=>$data['username']));
        $a = in_array($username,$arr_username)?1:0;
        $this->ajaxReturn(array('code'=> $a,'data'=>$username));
    }
  public function check_login(){
      //ajax判断是否是新用户
    $username = I('username');
    $password = I('password');
    $model = new Model('user');
    $user = $model->where(array('username'=>$username))->find();
    if(empty($user) || $user['password'] !=md5($password)){
        $this->ajaxReturn(array('code'=> 0,'data'=>'账号密码错误'));
    }
    //写入session
    session('user.userId',$user['user_id']);
    session('user.username',$user['username']);

    $this->ajaxReturn(array('code'=>  1,'data'=>$_POST['username']));

  }
    public function do_login(){
        $this->redirect('Index/index');
    }
  /**
  *退出登录
  */
  public function logout(){
    if(!session('user.userId')){
        $this->error('请登录');
    }
    session_destroy();
    $this->redirect('Index/index');
  }

    //修改密码
    public function edit()
    {
        $user_id = session('user.userId');
        $model = new Model('user');
        $data = $model->find($user_id);
//        var_dump($data);exit;//可以读出数据
        if (!$data)
        {
            $this->error('查询失败');
        }
        if(IS_POST){
            $arr=[
                'password'=>md5(I('password')),
            ];
            // 更新数据表中的数据
            $edited = $model->where(array('user_id' => session('user.userId')))->save($arr);
//            var_dump($edited);exit;//可以读出数据
            if($edited!==false){
                $this->redirect('Index/index');
            }else{
                $this->error('修改信息失败！！');
            }
            return;
        }
        $this->assign('data',$data);//在view中直接使用$data
        $this->display();
    }

}