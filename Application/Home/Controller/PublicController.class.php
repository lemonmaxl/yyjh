<?php
namespace Home\Controller;

use Think\Controller;

class PublicController extends Controller
{
    public function login()
    {
        $this->display();
    }

    public  function  login_do(){
        $username = I('username');
        $password = I('password');

        if (!preg_match('/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{2,16}$/u', $username)) {
            $this->error('请输入合法的用户名', 0, 0);
        }
        if (strlen($password) < 6 || strlen($password) > 18) {
            $this->error('请输入6位数以上的密码', 0, 0);
        }
        $where['username'] = $username;
        $data = M('sys_user')->where($where)->find();
        if (empty($data)) {
            $this->error('用户名异常，请联系系统管理员', 0, 0);
        }
        if ($data['password'] != sha1(md5($password))) {
            $this->error('密码错误，请重新输入', 0, 0);
        }
        session('admin',$data);
        $this->success('恭喜您，登陆成功!', U('Index/index'), 1);
    }

    public function logout(){
        session('admin',null);
        $this->redirect('Public/login');
    }
}