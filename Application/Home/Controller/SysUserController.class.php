<?php
namespace Home\Controller;

use Think\Controller;

class SysUserController extends BaseController
{
    public function index()
    {
        $keyword = I('keyword', '', 'htmlspecialchars');
        $keyword = URLDecode($keyword);

        if (!empty($keyword)) {
            $map['keyword'] = $keyword;
            $where = array(
                'a.username' => array('LIKE', '%' . $keyword . '%'),
                'a.truename' => array('LIKE', '%' . $keyword . '%'),
                '_logic' => 'or'
            );
        }

        $hid = session('admin')['hid'];
        //dump($hid);
        $where1 = array(
            'a.hid' => $hid,
            'a.type' => 1,
            '_logic' => 'or'
        );


        $where2 = array(
            'a.hid' => $hid,
        );


        if($hid == 0){
            $count = M('sys_user') ->alias('a')
                ->join(array("LEFT JOIN __SYS_USER_EXT__ c ON c.uid=a.id","LEFT JOIN __HOSPITAL__ b ON a.hid = b.id"))
                ->field('a.*,c.*,b.title')->where($where)->where($where1)->count();
            $Page = new \Think\Page($count, 20);
            $data = M('sys_user') ->alias('a')
                ->join(array("LEFT JOIN __SYS_USER_EXT__ c ON c.uid=a.id","LEFT JOIN __HOSPITAL__ b ON a.hid = b.id"))
                ->field('a.*,c.*,b.title')
                -> where($where)->where($where1)->limit($Page->firstRow,$Page->listRows)
                ->select();
            $count = M('sys_user') ->alias('a')
                ->join(array("LEFT JOIN __SYS_USER_EXT__ c ON c.uid=a.id","LEFT JOIN __HOSPITAL__ b ON a.hid = b.id"))
                ->field('a.*,c.*,b.title')
                -> where($where)->order("a.create_time desc")->where($where1)
                ->count();
        }else{
            $count = M('sys_user')->alias('a')
                ->join("LEFT JOIN __DEVICE_HOS__ b ON a.deviceid = b.id")
                ->field("a.*,b.name")->where($where)->where($where2)->count();
            $Page = new \Think\Page($count, 20);
            $data = M('sys_user')->alias('a')
                ->join("LEFT JOIN __DEVICE_HOS__ b ON a.deviceid = b.id")
                ->field("a.*,b.name")-> where($where)->where($where2)->order("a.create_time desc")->limit($Page->firstRow,$Page->listRows) ->select();
            for($i=0;$i<count($data);$i++){
                $data[$i]['rid'] = M('user_role') -> where(array('uid'=>$data[$i]['id'])) ->getField('rid');
            }
            $rid = M('sys_role') -> where(array('name'=>"医院运营")) ->getField('id');
            $this->rid = $rid;

        }

        

        foreach ($map as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        //dump($data);
        $show = $Page->show();
        $this->page = $show;
        $this->dataList = $data;
        $this->datacount = $count;
        $this->keyword = $keyword;
        $this->hid = $hid;
        $this->display();
    }

    public function change()
    {
        $data['id'] = I('id');
        $tmpdata = M('user')->where($data)->find();
        $tmpdata['password'] = sha1(md5('123456'));
        $result = M('user')->where($data)->save($tmpdata);

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

    public function fun()
    {
        $hid = session('admin')['hid'];
        $where['id'] = I('id');

        $fundata = M('sys_role') ->alias('a')
            ->join('LEFT JOIN __USER_ROLE__ b ON a.id=b.rid and b.uid ='.I('id'))
            ->field('a.*,b.uid')
            ->where(array('a.hid' => $hid,'a.mstatus' => 0 ))
            ->select();

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
            if (!empty($fundata[$i]['uid'])) {
                $funString = $funString . 'checked';
            }
            $funString = $funString . '   >' . $fundata[$i]['name'] . '</label>&nbsp;&nbsp;';
        }
        if ($datacount > 0) {
            $funString = $funString . '</dt></dl></dd>';
        }

        $data = M('user')->where($where)->find();
        $this->funString = $funString;
        $this->data = $data;
        $this->display();
    }

    public function fun_do()
    {
        $data['uid'] = I('id');
        $funstr = I('fun');
        $funarr = explode(',', $funstr);
        $fundataarr = array();
        foreach ($funarr as $funvlue) {
            if (!empty($funvlue)) {
                $data['rid'] = $funvlue;
                $fundataarr[] = $data;
            }
        }
        $sql = ' delete FROM op_user_role where uid=' . I('id');
        $Model = new \Think\Model();
        $fundata = $Model->execute($sql);
        if (!empty($fundataarr)) {
            $dataresult = M('user_role')->addAll($fundataarr);
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
        $result = M('user')->where($data)->delete();
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

    public function delMore()
    {
        $idstr = I('idstr');
        $idstr = trim($idstr, ',');
        $arr = explode(',', $idstr);
        foreach ($arr as $v) {
            $data['id'] = $v;
            M('user')->where($data)->delete();
        }
        $this->ajaxReturn(1);
    }

    public function edit()
    {
        $where['id'] = I('id');
        $data = M('sys_user')->alias('a')
        ->join("LEFT JOIN __SYS_USER_EXT__ b ON a.id=b.uid")
        ->where($where)->find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do()
    {
        $map['username'] = array('EQ', I('username'));
        $map['id'] = array('NEQ', I('id'));
        $selectdata = M('user')->where($map)->select();
        if (!empty($selectdata)) {
            $data['info'] = '用户名重复，不能编辑数据';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
        $mydata = $_POST;
        $result = M('user')->save($mydata);
//        if ($result !== false) {
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
//        } else {
//            $data['info'] = 'fail';
//            $data['status'] = 1;
//            $this->ajaxReturn($data);
//        }
    }

    public function add()
    {
        $hid = session('admin')['hid'];
        $this->hid =$hid;
        $this->display();
    }

    public function add_do()
    {
        $map['username'] = array('EQ', I('username'));
        $selectdata = M('sys_user')->where($map)->find();
        if (!empty($selectdata)) {
            $data['info'] = '用户名重复，不能添加数据';
            $data['status'] = 2;
            $this->ajaxReturn($data);
        }
        $mydata = $_POST;
        $mydata['password'] = sha1(md5($mydata['password']));

        $result = M('sys_user')->add($mydata);
        if ($result !== false) {
            $mydata['uid'] = $result;
            M('sys_user_ext')->add($mydata);
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }


    //分配设备
    public function device(){
        $id = I('id');
        $hid = session('admin')['hid'];
        $device = M('device_hos') -> where(array('hid'=>$hid)) ->select();
        $this->id = $id;
        $this->datacount = count($device);
        $this->device = $device;
        $this->display();
    }

    //用户添加设备
    public function get_device(){
        $id = I('id');
        $deviceid = I('device');
        $result = M('user') -> where(array('id'=>$id)) ->setField('deviceid',$deviceid);
        $res = M('device_hos') -> where(array('id'=>$deviceid)) ->setField('status',3);
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
        $where['id'] = I('id');
        $result = M('sys_user')->where($where)->setField('mstatus',$data['mstatus']);
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