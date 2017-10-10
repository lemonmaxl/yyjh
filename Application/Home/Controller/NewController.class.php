<?php
namespace Home\Controller;
class NewController extends BaseController{
    //健康教育
    public function index(){
        $data = M(session('mydbname') . '.' . 'news')->order("sfzd desc,create_time desc")->select();
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    //添加
    public function add(){
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
        if(!$info) {// 上传错误提示错误信息
            // $this->error($upload->getError());
            unset($data['image']);
        }else{// 上传成功
            $path = substr($upload->rootPath,1) . $info['image'] ['savepath'] . $info['image'] ['savename'];
            $data['image']=$path;
        }
        $result = M(session('mydbname') . '.' . 'news')->add($data);
        if ($result) {
            $this->success('添加成功',U('New/index'));
        } else {
            $this->error('添加失败',U('New/index'));
        }
    }


    //修改
    public function edit(){
        $id = I('id');
        $data = M(session('mydbname') . '.' . 'news') -> where("id = $id") ->find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do(){
        $data = $_POST;
        $result = M(session('mydbname') . '.' . 'news')->save($data);

        if ($result) {
            $this->success('修改成功',U('New/index'));
        } else {
            $this->error('修改失败',U('New/index'));
        }
    }


    public function del()
    {
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'news')->where($data)->delete();
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
        $result = M('new')->save($data);
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
        $result = M('new')->save($data);
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
}