<?php
namespace Home\Controller;

class DepartmentController extends BaseController{
    //人群分类
    public function index(){
        //医院分库
        $count = M(session('mydbname').'.department')-> where($where) ->count();
        $Page=new \Think\Page($count,15);
        $data = M(session('mydbname').'.department')-> where($where)->order("create_time desc")-> limit($Page->firstRow.','.$Page->listRows) ->select();
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    //添加
    public function add(){
        $pid = session('officeplatformAdmin')['pid'];
        $cid = session('officeplatformAdmin')['cid'];
        $this->pid = $pid;
        $this->cid = $cid;
        $this->display();
    }

    public function add_do(){
        $data = $_POST;
        $result = M(session('mydbname').'.department')->add($data);
        if ($result) {
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


    //修改
    public function edit(){
        $id = I('id');
        $data = M(session('mydbname').'.department') -> where (array('id' => $id)) -> find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do(){
        $data = $_POST;
        $result = M(session('mydbname').'.department')->save($data);

        if ($result) {
            $arr['info'] = 'success';
            $arr['status'] = 0;
            $this->ajaxReturn($arr);
        } else {
            $arr['info'] = 'fail';
            $arr['status'] = 1;
            $this->ajaxReturn($arr);
        }
    }


    public function del()
    {
        $data['id'] = I('id');
        $result = M(session('mydbname').'.disease')->where($data)->delete();

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