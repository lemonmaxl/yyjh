<?php
namespace Home\Controller;
class RemindtypeController extends BaseController{
    //提醒模板
    public function index(){
        
        $hid = session('admin')['hid'];
        $cid = session('admin')['cid'];
        
        $where['hid'] = $hid;
        $map['hid'] = $hid;
        if($cid > 0){
            $where['cid'] = $cid;
            $map['cid'] = $cid;
        }
        $count = M(session('mydbname') . '.' . 'remindtype')-> where($where) ->count();
        $Page=new \Think\Page($count,15);
        foreach ($map as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $data = M(session('mydbname') . '.' . 'remindtype') -> where($where) ->order("status desc,create_time desc")-> limit($Page->firstRow.','.$Page->listRows) ->select();
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        // $this->name = $name;
        // $this->ownphone = $ownphone;
        // $this->wss = $wss;
        // $this->begin_time = $begin_time;
        // $this->over_time = $over_time;
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    //添加
    public function add(){
        $hid = session('admin')['hid'];
        $cid = session('admin')['cid'];
        $this->hid = $hid;
        $this->cid = $cid;
        $this->display();
    }

    public function add_do(){
        $data = $_POST;
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $result = M(session('mydbname') . '.' . 'remindtype')->add($data);
        if ($result) {
            $this->success('添加成功',U('Remindtype/index'));
        } else {
            $this->error('添加失败',U('Remindtype/index'));
        }
    }


    //修改
    public function edit(){
        $id = I('id');
        $data = M(session('mydbname') . '.' . 'remindtype')-> where (array('id' => $id)) -> find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do(){
        $data = $_POST;
        $result = M(session('mydbname') . '.' . 'remindtype')->save($data);

        if ($result) {
            $this->success('修改成功',U('Remindtype/index'));
        } else {
            $this->error('修改失败',U('Remindtype/index'));
        }
    }


    public function del()
    {
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'remindtype')->where($data)->delete();

        if ($result) {
            $this->success('修改成功',U('Remindtype/index'));
        } else {
            $this->error('修改失败',U('Remindtype/index'));
        }
    }


    //启用
    public function start()
    {
        $data['status'] = 2;
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'remindtype')->save($data);

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
        $result = M(session('mydbname') . '.' . 'remindtype')->save($data);

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