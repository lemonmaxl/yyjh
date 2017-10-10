<?php
namespace Home\Controller;
class FwxmController extends BaseController{
    
    public function index(){
        $data = M(session('mydbname') . '.' . 'fwxm')->alias(a)
                ->join('LEFT JOIN '.session('mydbname').'.'.'__FWXM_FL__ b on a.fl=b.id')
                ->field('a.*,b.mc')
                ->where("a.status= 2 ")
                ->order("a.msort")
                ->SELECT();
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    public function del()
    {
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'fwxm')->where($data)->delete();
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
    public function add()
    {
        $selectlist = M(session('mydbname') . '.' . 'fwxm_fl')-> where(array("status" => 2))->select();
        $this->selectlist = $selectlist;
        $this->display();
    }

    function add_do(){        
        $mydata = $_POST;
        $result = M(session('mydbname') . '.' . 'fwxm')->add($mydata);
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

    public function edit()
    {
        $pid = session('officeplatformAdmin')['pid'];
        $selectlist = M(session('mydbname') . '.' . 'fwxm_fl')-> where(array("pid" => $pid,"status" => 2))->select();
        $this->selectlist = $selectlist;
        
        $where['id'] = I('id');
        $data = M(session('mydbname') . '.' . 'fwxm')->where($where)->find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do()
    {
        $mydata = $_POST;
        $result = M(session('mydbname') . '.' . 'fwxm')->save($mydata);
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