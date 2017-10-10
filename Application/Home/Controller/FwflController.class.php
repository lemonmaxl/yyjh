<?php
namespace Home\Controller;
class FwflController extends BaseController{
    
    public function index(){
        $data = M(session('mydbname') . '.' . 'fwxm_fl')->order('status desc,create_time desc')->SELECT();
        $this->dataList = $data;
        $this->display();
    }

    public function del()
    {
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'fwxm_fl')->where($data)->delete();
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
    function add(){        
        $this->display();
    }

    function add_do(){        
        $mydata = $_POST;
        $result = M(session('mydbname') . '.' . 'fwxm_fl')->add($mydata);
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
        //取得职位
        $where['id'] = I('id');
        $data = M(session('mydbname') . '.' . 'fwxm_fl')->where($where)->find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do()
    {
        $mydata = $_POST;
        $result = M(session('mydbname') . '.' . 'fwxm_fl')->save($mydata);
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

    // 改变状态
    public function changeStatus()
    {
        $data['status'] = I('status');
        if ($data['status'] == '2') {
            $data['status'] = 1;
        } else {
            $data['status'] = 2;
        }
        $where['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'fwxm_fl')->where($where)->setField('status',$data['status']);
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