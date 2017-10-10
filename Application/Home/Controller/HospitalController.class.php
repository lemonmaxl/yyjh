<?php
namespace Home\Controller;

use Think\Controller;

class HospitalController extends BaseController{
    //微信菜单
    public function index(){
        $hid = session('admin')['hid'];
        if($hid == 0){
            $data = M('hospital')
                ->order('id desc')
                ->select();
        }
        //dump($data);
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    //微信菜单添加
    public function add(){
        $this->display();
    }

    public function add_do(){
        $data = I('post.');
        $result = M('hospital')->add($data);
        
        if ($result) {
            $data['hid'] = $result;
            $res = M('hospital_ext')->add($data);
            if ($res) {
                unset($data);
                $data['info'] = 'success';
                $data['status'] = 0;
                $this->ajaxReturn($data);
            }
            
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }


    //微信菜单修改
    public function edit(){
        $id = I('id');
        $data = M('hospital')->alias('a')
        ->join("LEFT JOIN __HOSPITAL_EXT__ c ON a.id=c.hid")
        -> where (array('a.id' => $id)) -> find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do(){
        $data = $_POST;
        $result = M('hospital')->save($data);

        if ($result) {
            M('hospital_ext')->where(array('hid'=>$data['id']))->save($data);
            unset($data);
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }

    //添加管理员
    public function admin(){
        $id = I('id');

        $where['type'] = '1';
        $where['hid'] = $id;
        $data = M('user') -> where($where) -> find();
        $this->data = $data;
        $this->hid = $id;
        $this->type = 1;
        $this->display();
    }

    public function admin_do(){
        $data = $_POST;
        $password = $data['password'];
        $data['password'] = sha1(md5($password));
        if($data['id']){
            $res = M('user') -> where(array('id'=>$data['id'])) -> save($data);
        }else{
            $user = M('user') -> where(array('username'=>$data['username'])) -> find();
            if($user){
                $this->ajaxReturn('用户名已存在！');
            }else{
                
                
                $res = M('user') -> add($data);
            }
        }
        if ($res) {
            unset($data);
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }

    public function wmenu()
    {
        $where['id'] = I('id');
        //echo $where['id'];
        $admin = M('user') -> where(array('hid'=>I('id'),'type'=>'1')) ->find();


        if(!$admin){
            echo "<script>alert('管理员不存在，请完善管理员信息!');var index = parent.layer.getFrameIndex(window.name);parent.$('.btn-refresh').click();parent.location.reload();parent.layer.close(index);</script>";
            exit;
        }

        $menu = M('menu') -> where("hid = 0") ->select();

        $fundatafirst = M('hospital_menu') -> alias('a')
            ->join(array("LEFT JOIN __USER__ b ON a.uid = b.id"))
            ->field('a.zid,a.id')
            ->where(array('a.uid' => $admin['id'],'a.hid'=>0))
            ->select();

        //生成所有功能选项
        $funString = '';
        $datacount = count($menu);
        for ($i = 0; $i < $datacount; $i++) {

            $funString = $funString . '<dl class="permission-list"><dt>';
            $funString = $funString . '<label><input type="checkbox" value="'
                . $menu[$i]['id'] . '" name="funcheck" ';
            for($ii=0;$ii<count($fundatafirst);$ii++){
                if ($fundatafirst[$ii]['zid'] == $menu[$i]['id']) {
                    $funString = $funString . ' checked ';
                }
            }

            $funString = $funString . ' >' . $menu[$i]['title'] . '</label></dt>';

            //二级菜单

            $sebmenu = M('menu') -> where(array('hid'=>$menu[$i]['id'])) ->select();

            $fundatasccond = M('hospital_menu') -> alias('a')
                ->join(array("LEFT JOIN __USER__ b ON a.uid = b.id"))
                ->field('a.zid')
                ->where(array('a.uid' => $admin['id'],'a.hid'=>$fundatafirst[$i]['zid']))
                ->select();

            $datacountsccond = count($sebmenu);
            $funStringsecond = '';
            for ($j = 0; $j < $datacountsccond; $j++) {
                $funStringsecond = $funStringsecond . '<dl class="cl permission-list2"><dt><label class=""><input type="checkbox" value="'
                    . $sebmenu[$j]['id'] . '" name="funcheck" ';

                if ($fundatasccond[$j]['zid'] == $sebmenu[$j]['id']) {
                    $funStringsecond = $funStringsecond . ' checked ';
                }
                $funStringsecond = $funStringsecond . '>' . $sebmenu[$j]['title'] . '</label></dt>';

                $funStringsecond = $funStringsecond . '</dl>';
            }
            if ($datacountsccond > 0) {
                $funString = $funString . '<dd>' . $funStringsecond . '</dd>';
            }
            $funString = $funString . '</dl>';
        }
        //dump($funString);
        $uid = $admin['id'];
        $this-> uid = $uid;
        $this->hid = I('id');
        $this->funString = $funString;
        $this->display();
    }

    public function wmenu_do()
    {
        $hid = I('hid');
        $sql = ' delete FROM op_hospital_menu where uid=' . I('uid');
        $Model = new \Think\Model();
        $fundata = $Model->execute($sql);

        $funstr = I('fun');
        $funarr = explode(',', $funstr);
        $hos_menu = array();
        for($i=0;$i<count($funarr);$i++){
            $hos_menu[$i] = M('menu') -> where(array('id'=>$funarr[$i])) ->find();
            $hos_menu[$i]['url'] = $hos_menu[$i]['url'].'/id/'.$hid;
            $hos_menu[$i]['zid'] = $hos_menu[$i]['id'];
            $hos_menu[$i]['uid'] = I('uid');
            $hos_menu[$i]['newtitle'] = $hos_menu[$i]['title'];
            unset($hos_menu[$i]['id']);
        }
        $res = M('hospital_menu') ->addAll($hos_menu);

        if (($res !== false) && ($fundata !== false)) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }


    public function yyhmenu()
    {
        $where['id'] = I('id');
        $admin = M('user') -> where(array('hid'=>I('id'),'type'=>1)) ->find();

        if(!$admin){
            echo "<script>alert('管理员不存在，请完善管理员信息!');var index = parent.layer.getFrameIndex(window.name);parent.$('.btn-refresh').click();parent.location.reload();parent.layer.close(index);</script>";
            exit;
        }

        $menu = M('yyhmenu') -> where("hid = 0 and status = 1 ") ->select();
        $fundatafirst = M('hospital_yyhmenu') -> alias('a')
            ->join(array("LEFT JOIN __USER__ b ON a.uid = b.id"))
            ->field('a.zid,a.id')
            ->where(array('a.uid' => $admin['id'],'a.hid'=>0))
            ->select();

        //生成所有功能选项
        $funString = '';
        $datacount = count($menu);
        for ($i = 0; $i < $datacount; $i++) {

            $funString = $funString . '<dl class="permission-list"><dt>';
            $funString = $funString . '<label><input type="checkbox" value="'
                . $menu[$i]['id'] . '" name="funcheck" ';
            for($ii=0;$ii<count($fundatafirst);$ii++){
                if ($fundatafirst[$ii]['zid'] == $menu[$i]['id']) {
                    $funString = $funString . ' checked ';
                }
            }

            $funString = $funString . ' >' . $menu[$i]['title'] . '</label></dt>';

            //二级菜单

            $sebmenu = M('yyhmenu') -> where(array('hid'=>$menu[$i]['id'])) ->select();

            $fundatasccond = M('hospital_yyhmenu') -> alias('a')
                ->join(array("LEFT JOIN __USER__ b ON a.uid = b.id"))
                ->field('a.zid')
                ->where(array('a.uid' => $admin['id'],'a.hid'=>$fundatafirst[$i]['zid']))
                ->select();

            $datacountsccond = count($sebmenu);
            $funStringsecond = '';
            for ($j = 0; $j < $datacountsccond; $j++) {
                $funStringsecond = $funStringsecond . '<dl class="cl permission-list2"><dt><label class=""><input type="checkbox" value="'
                    . $sebmenu[$j]['id'] . '" name="funcheck" ';

                if ($fundatasccond[$j]['zid'] == $sebmenu[$j]['id']) {
                    $funStringsecond = $funStringsecond . ' checked ';
                }
                $funStringsecond = $funStringsecond . '>' . $sebmenu[$j]['title'] . '</label></dt>';

                $funStringsecond = $funStringsecond . '</dl>';
            }
            if ($datacountsccond > 0) {
                $funString = $funString . '<dd>' . $funStringsecond . '</dd>';
            }
            $funString = $funString . '</dl>';
        }
        $uid = $admin['id'];
        $this-> uid = $uid;
        $this->hid = I('id');
        $this->funString = $funString;
        $this->display();
    }

    public function yyhmenu_do()
    {
        $hid = I('hid');
        $sql = ' delete FROM op_hospital_yyhmenu where uid=' . I('uid');
        $Model = new \Think\Model();
        $fundata = $Model->execute($sql);

        $funstr = I('fun');
        $funarr = explode(',', $funstr);
        $hos_menu = array();
        for($i=0;$i<count($funarr);$i++){
            $hos_menu[$i] = M('yyhmenu') -> where(array('id'=>$funarr[$i])) ->find();
            $hos_menu[$i]['url'] = $hos_menu[$i]['url'] ;
            $hos_menu[$i]['zid'] = $hos_menu[$i]['id'];
            $hos_menu[$i]['newtitle'] = $hos_menu[$i]['title'];
            $hos_menu[$i]['uid'] = I('uid');
            unset($hos_menu[$i]['id']);
        }

        $res = M('hospital_yyhmenu') ->addAll($hos_menu);

        if (($res !== false) && ($fundata !== false)) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }


    public function del()
    {
        $data['id'] = I('id');
        $result = M('hospital')->where($data)->delete();

        if ($result !== false) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }


    //启用
    public function start()
    {
        $data['status'] = 1;
        $data['id'] = I('id');
        $result = M('hospital')->save($data);

        if ($result !== false) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }

    //禁用
    public function stop()
    {
        $data['status'] = 0;
        $data['id'] = I('id');
        $result = M('hospital')->save($data);
        if ($result !== false) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }

    //医院信息
    public function info(){
        $hid = session('admin')['hid'];
        $data = M('hospital') -> where("id = $hid") -> find();
        $this->assign('data',$data);
        $this->display();
    }
    //医院信息
    public function video(){
        $hid = session('admin')['hid'];
        $data = M('hospital') -> where("id = $hid") -> find();
        $this->assign('data',$data);
//        dump($hid);
//        dump($data);
        $this->display();
    }

    //修改医院信息
    public function setinfo(){
        $data = I('post.');

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
//        if(!empty($info)){
//
//        }
//        foreach($info as $k => $v){
//            if($v['key'] == 'logo'){
//                $data['logo'] = substr($upload->rootPath,1) . $info[$k]['savepath'] . $info[$k]['savename'];
//            }else{
//                $path[$k] = substr($upload->rootPath,1) . $info[$k]['savepath'] . $info[$k]['savename'];
//            }
//        }
//        $data['bander'] = implode(',', $path);
        if(!$info) {// 上传错误提示错误信息
//            $this->error($upload->getError());
            unset($data['logo']);
            unset($data['bander']);
        }else{// 上传成功
            foreach($info as $k => $v){
                if($v['key'] == 'logo'){
                    $data['logo'] = substr($upload->rootPath,1) . $info[$k]['savepath'] . $info[$k]['savename'];
                }else{
                    $path[$k] = substr($upload->rootPath,1) . $info[$k]['savepath'] . $info[$k]['savename'];
                }
            }
            $data['bander'] = implode(',', $path);
        }
        $data = M('hospital') -> save($data);
        if($data !== false){
            $this->success('修改成功！',U('Hospital/info'));
        }else{
            $this->error('修改失败！',U('Hospital/info'));
        }
    }

    //医院简介
    public function description(){
        $hid = session('admin')['hid'];
        $data = M(session('mydbname') . '.' . 'info_hospital') -> where(array('id'=>$hid)) ->find();
        $data['content'] = htmlspecialchars_decode($data['content']);
        $this->data = $data;
        $this->id = $data['id'];
        $this->display();
    }

    //添加医院简介
    public function get_des(){
        $data = I('post.');
        if(empty($data['id'])){
            $data['id'] = session('admin')['hid'];
            $res = M(session('mydbname') . '.' . 'info_hospital') -> add($data);
        }else{
            $res = M(session('mydbname') . '.' . 'info_hospital')-> save($data);
        }
        
        if($res !== false){
            $this->success('添加医院简介成功');
        }else{
            $this->error('添加医院简介失败');
        }
    }
}