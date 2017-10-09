<?php
namespace Home\Controller;

use Think\Controller;

class SysModuleController extends BaseController
{
    public function index()
    {
        $data = M('sys_module')->order(array('msort'))->select();

        $data = nodeShow($data, 0);
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    public function fun()
    {
        $where['id'] = I('id');

        //生成所有功能选项
        $sql = ' SELECT a.*,b.mid FROM sl_sys_fun a '
            . ' LEFT JOIN sl_sys_module_fun b on a.id=b.fid and mid=' . I('id') . ' order by msort';
        $Model = new \Think\Model();
        $fundata = $Model->query($sql);

        $funString = '';
        $datacount = count($fundata);
        for ($i = 0; $i < $datacount; $i++) {
            if ($i % 6 == 0) {
                if ($i != 0) {
                    $funString = $funString . '</dt></dl></dd>';
                }
                $funString = $funString . '<dd><dl class="cl permission-list2"><dt>';
            }
            $funString = $funString . '<label class=""><input type="checkbox" value="' . $fundata[$i]['id'] . '" name="funcheck" ';
            if (!empty($fundata[$i]['mid'])) {
                $funString = $funString . 'checked';
            }
            $funString = $funString . '   >' . $fundata[$i]['name'] . '</label>&nbsp;&nbsp;';
        }
        if ($datacount > 0) {
            $funString = $funString . '</dt></dl></dd>';
        }

        $data = M('sys_module')->where($where)->find();
        $this->funString = $funString;
        $this->data = $data;
        $this->display();
    }

    public function fun_do()
    {
        $data['mid'] = I('id');
        $funstr = I('fun');
        $funarr = explode(',', $funstr);
        $fundataarr = array();
        foreach ($funarr as $funvlue) {
            if (!empty($funvlue)) {
                $data['fid'] = $funvlue;
                $fundataarr[] = $data;
            }
        }
        $sql = ' delete FROM op_sys_module_fun where mid=' . I('id');
        $Model = new \Think\Model();
        $fundata = $Model->execute($sql);
        if (!empty($fundataarr)) {
            $dataresult = M('sys_module_fun')->addAll($fundataarr);
        }

        if ($dataresult !== false) {
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
        $result = M('sys_module')->where($data)->delete();
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
        $data = M('sys_module')->where($where)->find();

        $selectlist = M('sys_module')->order(array('msort'))->where(array('mstutas' => '0'))->select();
        $selectlist = nodeShow($selectlist, 0, 0, '─');
        $this->selectlist = $selectlist;

        $this->data = $data;
        $this->display();
    }

    public function edit_do()
    {
        $result = M('sys_module')->save($_POST);
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
        $selectlist = M('sys_module')->order(array('msort'))->where(array('mstutas' => '0'))->select();
        $selectlist = nodeShow($selectlist, 0, 0, '─');
        $this->selectlist = $selectlist;
        $this->display();
    }

    public function add_do()
    {
        $result = M('sys_module')->add($_POST);
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

    public function changeStatus()
    {
        $data['mstatus'] = I('status');
        if ($data['mstatus'] == '1') {
            $data['mstatus'] = 0;
        } else {
            $data['mstatus'] = 1;
        }
        $data['id'] = I('id');
        $result = M('sys_module')->save($data);
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