<?php
namespace Home\Controller;

class KsinfoController extends BaseController{
    //健康评估
    public function index(){
        

        $where['hid'] = session('admin')['hid'];
        $data = M(session('mydbname') . '.' . 'info_keshi')-> where($where) ->find();
        $this->hid = session('admin')['hid'];
        $this->data = $data;
        $this->display();
    }

    public function add(){
        $data = $_POST;
        
        if(empty($data['id'])){
            $result = M(session('mydbname') . '.' . 'info_keshi')->add($data);
        }else{
            $result = M(session('mydbname') . '.' . 'info_keshi')->save($data);
        }


        if ($result !== false) {
            $this->success('添加成功',U('Ksinfo/index'));
        } else {
            $this->error('添加失败',U('Ksinfo/index'));
        }
    }

    //特色科室
    public function special(){
        $sql = ' SELECT d.flag from op_user_role a,op_sys_role_fun b,op_sys_module c,op_sys_fun d '
            . 'where a.uid=' . $_SESSION['admin']['id'] . ' and a.rid=b.rid and b.fid is not NULL and b.mid=c.id and c.linkurl LIKE \'%' . CONTROLLER_NAME . '%\' and b.fid=d.id ';
        $Model = new \Think\Model();
        $fundata = $Model->query($sql);

        $username = session('admin')['username'];
        if ($username == C('ADMINUSER')) {
            $funADD=true;
            $funEDIT=true;
            $funDEL=true;
            $funSTATUS=true;
            $funFUN=true;
        } else {
            foreach ($fundata as $fundatavalue) {
                if ($fundatavalue['flag']=='ADD') {
                    $funADD=true;
                }
                if ($fundatavalue['flag']=='EDIT') {
                    $funEDIT=true;
                }
                if ($fundatavalue['flag']=='DEL') {
                    $funDEL=true;
                }
                if ($fundatavalue['flag']=='STATUS') {
                    $funSTATUS=true;
                }
                if ($fundatavalue['flag']=='FUN') {
                    $funFUN=true;
                }
            }
        }
        $this->funADD = $funADD;
        $this->funEDIT = $funEDIT;
        $this->funDEL = $funDEL;
        $this->funSTATUS = $funSTATUS;
        $this->funFUN = $funFUN;

        $where['hid'] = session('admin')['hid'];
        $data = M('spedepart')-> where($where) ->find();
        $this->hid = session('admin')['hid'];
        $this->data = $data;
        $this->display();
    }

    public function get_spedepart(){
        $data = $_POST;
        if(empty($data['id'])){
            $result = M('spedepart')->add($data);
        }else{
            $result = M('spedepart')->save($data);
        }


        if ($result !== false) {
            $this->success('添加成功',U('Ksinfo/special'));
        } else {
            $this->error('添加失败',U('Ksinfo/special'));
        }
    }

}