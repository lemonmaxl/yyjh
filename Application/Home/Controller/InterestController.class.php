<?php
namespace Home\Controller;
class InterestController extends BaseController{
    //兴趣内容
    public function index(){

        $hid = session('admin')['hid'];
        $data = M('interest') -> where("hid = $hid") ->order("create_time desc")->select();
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    //添加
    public function add(){
        
        $hid = session('admin')['hid'];
        $type = M(session('mydbname') . '.' . 'interesttype') -> where("hid = $hid")->field('title')->select();
        $this->hid = $hid;
        $this->typelist = $type;
        $this->display();
    }

    public function add_do(){
        $data = $_POST;
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        // if(!$info) {// 上传错误提示错误信息
        //     $this->error($upload->getError());
        // }else{// 上传成功
        //     $path = substr($upload->rootPath,1) . $info['image'] ['savepath'] . $info['image'] ['savename'];
        //     $data['image']=$path;
        // }
        $path = substr($upload->rootPath,1) . $info['image'] ['savepath'] . $info['image'] ['savename'];
        $data['image']=$path;
        $result = M('interest')->add($data);
        if ($result) {
            $this->success('添加成功',U('Interest/index'));
        } else {
            $this->error('添加失败',U('Interest/index'));
        }
    }


    //修改
    public function edit(){
        $hid = session('admin')['hid'];
        $id = I('id');
        $data = M('interest') -> where("id = $id") ->find();
        $type = M(session('mydbname') . '.' . 'interesttype') -> where("hid = $hid")->field('title')->select();
        $this->typelist = $type;
        $this->data = $data;
        $this->display();
    }

    public function edit_do(){
        $data = $_POST;
        $result = M('interest')->save($data);

        if ($result) {
            $this->success('修改成功',U('Interest/index'));
        } else {
            $this->error('修改失败',U('Interest/index'));
        }
    }


    public function del()
    {
        $data['id'] = I('id');
        $result = M('interest')->where($data)->delete();
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
        $data['status'] = 0;
        $data['id'] = I('id');
        $result = M('interest')->save($data);
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
        $data['status'] = 1;
        $data['id'] = I('id');
        $result = M('interest')->save($data);
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

    //兴趣分类
    public function type(){
        $data = M(session('mydbname') . '.' . 'interesttype')->order("create_time desc")->select();
        $this->data = $data;
        $this->display();
    }

    //兴趣类型添加
    public function type_add(){
        $hid = session('admin')['hid'];
        $cid = session('admin')['cid'];
        $this->hid = $hid;
        $this->cid = $cid;
        $this->display();
    }

    public function type_add_do(){
        $data =I('post.');
        $res = M(session('mydbname') . '.' . 'interesttype') -> add($data);
        if ($res !== false) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }

    //兴趣类型修改
    public function type_edit(){
        $id = I('id');
        $data = M(session('mydbname') . '.' . 'interesttype') -> where(array('id'=>$id)) ->find();
        $this->data = $data;
        $this->display();
    }

    public function type_edit_do(){
        $data =I('post.');
        $res = M(session('mydbname') . '.' . 'interesttype') -> save($data);
        if ($res !== false) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }

    //兴趣类型删除
    public function type_del(){
        $id = I('id');
        $res = M(session('mydbname') . '.' . 'interesttype') -> where(array('id'=>$id)) ->delete();
        if ($res !== false) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }
}