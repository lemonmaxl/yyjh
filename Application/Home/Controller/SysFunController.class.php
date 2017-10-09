<?php
namespace Home\Controller;

class SysFunController extends BaseController
{
    public function index()
    {
        $data = M('sys_fun')->order(array('msort'))->select();
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    public function changeStatus()
    {
        $data['mstatus'] = I('status');
        if ($data['mstatus'] == '1') {
            $data['mstatus'] = 0;
        } else {
            $data['mstatus'] = 1;
        }
        $data['id'] = I('id');
        $result = M('sys_fun')->save($data);
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

    public function del()
    {
        $data['id'] = I('id');
        $result = M('sys_fun')->where($data)->delete();
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
        $where['id'] = I('id');
        $data = M('sys_fun')->where($where)->find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do()
    {
        $result = M('sys_fun')->save($_POST);
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
        $this->display();
    }

    public function add_do()
    {
        $result = M('sys_fun')->add($_POST);
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