<?php
namespace Home\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        $mydbname='yyjh_'.session('admin')['hid'];
        session('mydbname',$mydbname);

//        $xtflag=session('xt');
        $admin = session('admin');
        $where['mstatus'] = 0;
        if ($admin['username'] == 'admin') {
            //是超级用户时显示所有可用功能项
            $sysmenu = M('sys_module')->where($where)->order('pid,msort')->select();
        } else {
            //非超级用户时根据分配的功能项显示相应菜单

            $sysmenu = M('sys_module')->where($where)->order('pid,msort')->select();
        }
        $sysmenu =sysMenu_merge($sysmenu);

        $this->sysmenu=$sysmenu;

        $this->display();
    }
}