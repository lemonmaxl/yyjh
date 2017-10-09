<?php
namespace Home\Controller;

use Think\Controller;

class SysRoleController extends BaseController
{
    public function index()
    {
        $data = M('sys_role')->order(array('msort'))->select();
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    public function fun()
    {
        $hid = session('admin')['hid'];
        $where['id'] = I('id');
        $firstsql = ' SELECT a.*,b.rid,b.mid,b.fid FROM ( SELECT * from sl_sys_module where hid=0 ) a '
            . ' LEFT JOIN sl_sys_role_fun b on a.id=b.mid and (fid  is null) and rid=' . I('id') . ' order by msort';
        $firstModel = new \Think\Model();
        $fundatafirst = $firstModel->query($firstsql);

        //生成所有功能选项
        $funString = '';
        $datacount = count($fundatafirst);
        for ($i = 0; $i < $datacount; $i++) {
            $funString = $funString . '<dl class="permission-list"><dt>';
            $funString = $funString . '<label><input type="checkbox" value="'
                . $fundatafirst[$i]['id'] . '" name="funcheck" ';
            if (!empty($fundatafirst[$i]['rid'])) {
                $funString = $funString . ' checked ';
            }
            $funString = $funString . ' >' . $fundatafirst[$i]['name'] . '</label></dt>';

            //二级菜单
            $sccondsql = ' SELECT a.*,b.rid,b.mid,b.fid FROM ( SELECT * from sl_sys_module where hid=' . $fundatafirst[$i]['id'] . '  ) a '
                . ' LEFT JOIN sl_sys_role_fun b on a.id=b.mid and (fid is null) and rid=' . I('id') . ' order by msort';
            $sccondModel = new \Think\Model();
            $fundatasccond = $sccondModel->query($sccondsql);
            $datacountsccond = count($fundatasccond);
            $funStringsecond = '';
            for ($j = 0; $j < $datacountsccond; $j++) {
                $funStringsecond = $funStringsecond . '<dl class="cl permission-list2"><dt><label class=""><input type="checkbox" value="'
                    . $fundatasccond[$j]['id'] . '" name="funcheck" ';
                if (!empty($fundatasccond[$j]['rid'])) {
                    $funStringsecond = $funStringsecond . ' checked ';
                }
                $funStringsecond = $funStringsecond . '>' . $fundatasccond[$j]['name'] . '</label></dt>';

                //第三级 页面内功能选项
                $threesql = ' select aa.*,bb.rid from  (SELECT a.*,b.mid,b.fid FROM op_sys_fun a '
                    . ' , sl_sys_module_fun b where a.id=b.fid and mid=' . $fundatasccond[$j]['id'] .' ORDER by msort ) aa'
                    . ' left join sl_sys_role_fun bb on bb.rid=' . I('id') . ' and aa.mid=bb.mid and aa.fid=bb.fid ' ;

                $threeModel = new \Think\Model();
                $fundatathree = $threeModel->query($threesql);
                $datacountthree = count($fundatathree);
                $funStringthree = '';
                $id = 0;
                for ($k = 0; $k < $datacountthree; $k++) {
                    if ($k != 1) {
                        if ((($k - 1) % 5) == 0) {
                            $funStringthree = $funStringthree . '<br>';
                        }
                    }
                    if ($id == $fundatathree[$k]['id']) {
                        continue;
                    }
                    $id = $fundatathree[$k]['id'];

                    $funStringthree = $funStringthree . '<label class=""><input type="checkbox" value="'
                        . $fundatasccond[$j]['id'] . '_' . $fundatathree[$k]['id'] . '" name="funcheck" ';
                    if (!empty($fundatathree[$k]['rid'])) {
                        $funStringthree = $funStringthree . ' checked ';
                    }
                    $funStringthree = $funStringthree . '>' . $fundatathree[$k]['name'] . '</label>';
                }
                if ($datacountthree > 0) {
                    $funStringsecond = $funStringsecond . '<dd>' . $funStringthree . '</dd>';
                }

                $funStringsecond = $funStringsecond . '</dl>';
            }
            if ($datacountsccond > 0) {
                $funString = $funString . '<dd>' . $funStringsecond . '</dd>';
            }
            $funString = $funString . '</dl>';
        }

        $data = M('sys_role')->where($where)->find();
        $this->funString = $funString;
        $this->data = $data;
        $this->display();
    }

    public function fun_do()
    {
        $data['rid'] = I('id');
        $funstr = I('fun');
        $funarr = explode(',', $funstr);
        $sql = ' delete FROM op_sys_role_fun where rid=' . I('id');
        $Model = new \Think\Model();
        $fundata = $Model->execute($sql);
        foreach ($funarr as $funvlue) {
            if (!empty($funvlue)) {
                $funvluearr = array();
                $funvluearr = explode('_', $funvlue);
                $data['mid'] = $funvluearr[0];
                if (count($funvluearr) > 0) {
                    $data['fid'] = $funvluearr[1];
                }
                M('sys_role_fun')->add($data);
            }
        }
        $data['info'] = 'success';
        $data['status'] = 0;
//
//        if ($dataresult !== false) {
//            $data['info'] = 'success';
//            $data['status'] = 0;
//            $this->ajaxReturn($data);
//        } else {
//            $data['info'] = 'fail';
//            $data['status'] = 1;
//            $this->ajaxReturn($data);
//        }
    }

    public function del()
    {
        $data['id'] = I('id');
        $result = M('sys_role')->where($data)->delete();
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
        $data = M('sys_role')->where($where)->find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do()
    {
        $data = I('post.');
        $result = M('sys_role')->save($data);
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
        $hid = session('admin')['hid'];
        $this->hid = $hid;
        $this->display();
    }

    public function add_do()
    {
        $data = I('post.');
        $result = M('sys_role')->add($data);
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
        $data['mstatus'] = I('status');
        if ($data['mstatus'] == '1') {
            $data['mstatus'] = 0;
        } else {
            $data['mstatus'] = 1;
        }
        $data['id'] = I('id');
        $result = M('sys_role')->save($data);
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