<?php
namespace Home\Controller;

class DocterController extends BaseController{
    
    public function index(){
        //医院分库
        $count = M(session('mydbname') . '.' . 'docter')->where($where)->count();
        $Page = new \Think\Page($count, 15);
        $data = M(session('mydbname') . '.docter')->where($where)->order("cjrq desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $page = $Page->show(); //组装分页字符串
        $this->assign('page', $page);
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    //添加
    public function add(){
        $keshi =  M(session('mydbname') . '.' . 'department')->select();
        $this->kslist=$keshi;
        $this->display();
    }

    public function add_do(){
        $data = $_POST;
        //$this->ajaxReturn($data);
        $ks = I('ks');
        if(empty($ks)){
            echo "<script>alert('科室不存在，请添加科室!');history.back();</script>";
            exit;
        }else{
            $data['cjrq'] = date('Y-m-d H:i:s',time());

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();



            $data['img'] = substr($upload->rootPath,1) . $info[img]['savepath'] . $info[img]['savename'];
            
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data['img'] = substr($upload->rootPath,1) . $info[img]['savepath'] . $info[img]['savename'];
            }

            $result = M(session('mydbname') . '.' . 'docter')->add($data);
            if ($result) {
                $this->success('添加成功',U('Docter/index'));
            } else {
                $this->error('添加失败',U('Docter/index'));
            }
        }

    }


    //修改
    public function edit(){
        $id = I('id');
        $keshi = M(session('mydbname') . '.' . 'department')->select();
        $this->kslist=$keshi;
        $data = M(session('mydbname') . '.' . 'docter')-> where("id = $id") ->find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do(){
        $data = $_POST;
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            // $this->error($upload->getError());
        }else{// 上传成功
            $data['img'] = substr($upload->rootPath,1) . $info[img]['savepath'] . $info[img]['savename'];
        }

        //$data['img'] = substr($upload->rootPath,1) . $info[img]['savepath'] . $info[img]['savename'];
        
        $result = M(session('mydbname') . '.' . 'docter')->save($data);

        if ($result!== false) {
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
        $result = M(session('mydbname') . '.' . 'docter')->where($data)->delete();
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
        $result = M('docter')->save($data);
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
        $result = M('docter')->save($data);
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

    //专家介绍
    public function description(){
        $pid = session('officeplatformAdmin')['pid'];
        $data = M('docter_description') -> where("pid = $pid") -> find();
        $data['content'] = htmlspecialchars_decode($data['content']);
        $this->pid = $pid;
        $this->data = $data;
        $this->display();
    }

    public function get_des(){
        $data = I('post.');
        if(empty($data['id'])){
            $res = M('docter_description') -> add($data);
        }else{
            $res = M('docter_description')-> save($data);
        }
        if($res !== false){
            $this->success('添加专家介绍成功');
        }else{
            $this->error('添加专家介绍失败');
        }
    }
}