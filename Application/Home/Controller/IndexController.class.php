<?php
namespace Home\Controller;

use Home\Model\MessageViewModel;
use Think\Controller;
use Think\Model;
use Think\Page;

class IndexController extends Controller
{
    /**
     * 检测登录
     */
    private function checkLogin()
    {
        if (!session('user.userId'))
        {
            $this->error('请登录', U('User/login'));
        }
    }

    /**
     * 留言列表
     */
    public function index()
    {

        $model = new MessageViewModel();
        if(IS_POST) {
            $content = I('content');
            $where['content'] = array('like','%'.$content.'%');//表达式查询
            $list = $model->where($where)->select();
            // 更新数据表中的数据

            $this->assign('list', $list);
            $this->display();
        }
        else{
            $count = $model->count();//当前页码
            $page = new Page($count, 2);//一页显示10条记录
            $show = $page->show();
            $list = $model->order('message_id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
            $this->assign('page', $show);
            $this->assign('list', $list);//index.html中的volist标签
            $this->display();
        }
    }

    /**
     * 发表留言
     */
    public function post()
    {
        $this->checkLogin();
        $this->display();
    }

    /**
     * 留言处理
     */
    public function do_post()
    {
        $this->checkLogin();
        $content = I('content');//获取系统输入变量
        $content = strip_tags(htmlspecialchars_decode($content),"");
        if (empty($content))
        {
            $this->error('留言内容不能为空');
        }
        if (mb_strlen($content, 'utf-8') > 100)
        {
            $this->error('留言内容最多100字');
        }
        $model = new Model('message');
        $userId = session('user.userId');//不是model里面定义的，前面会定义响应的写入
        $data = array(
            'content' => $content,
            'created_at' => time(),
            'user_id' => $userId
        );
        if (!($model->create($data) && $model->add()))
        {
            $this->error('留言失败');
        }
        $this->redirect('Index/index');
    }

    public function delete()
    {
        $id = I('id');
        if (empty($id))
        {
            $this->error("缺少参数");
        }
        $this->checkLogin();
        $model = new Model('message');
        //数组作为查询条件
        $arr = array('message_id' => $id, 'user_id' => session('user.userId'));
        $result = $model->where($arr)->delete();
        $result = $model->where(array('message_id' => $id, 'user_id' => session('user.userId')))->delete();
        if (!$result)
        {
            $this->error('删除失败');
        }
        $this->redirect('Index');
    }

    //留言修改
    public function edit()
    {
        $id = I('id');
        $model = new Model('message');
        $data = $model->find($id);
        $content = I('content');//获取系统输入变量
        $content = strip_tags(htmlspecialchars_decode($content),"");
//        var_dump($data['message_id']);exit;//可以读出数据
        if (!$data)
        {
            $this->error('查询失败');
        }
        if(IS_POST){
            $arr=[
                'content'=>$content,
            ];

            // 更新数据表中的数据
            $edited = $model->where(array('message_id' => $id, 'user_id' => session('user.userId')))->save($arr);
            if($edited!==false){
                $this->redirect('index');
            }else{
                $this->error('修改信息失败！！');
            }
            return;
        }
        $this->assign('data',$data);//在view中直接使用$data
//        $this->redirect('edit');
        //return $this->fetch();  这两个都不行
        $this->display();

    }

}