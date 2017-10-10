<?php
namespace Home\Controller;

class QylxsetController extends BaseController
{
    public function index()
    {
        

        $where['pid'] = $_SESSION['officeplatformAdmin']['pid'];
        $data = M(session('mydbname') . '.' . 'qianyueleixing')->where($where)->order(array('msort'))->select();
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    public function del()
    {
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'qianyueleixing')->where($data)->delete();
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

    public function object_del()
    {
        $data['fwid'] = I('id');
        $result = M(session('mydbname') . '.' . 'xieyi_fwxm_num')->where($data)->delete();
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
        $data = M(session('mydbname') . '.' . 'qianyueleixing')->where($where)->find();
        $this->id = I('id');
        $this->data = $data;
        $this->display();
    }

    
    public function object_do(){
        $data = $_POST ;
        $xmsl = array();
        for ($i=0; $i < count($data['xmid']); $i++) { 
            $xmsl[$i] = $data['num_'.$data['xmid'][$i]];
        }
        $data['xmsl']=$xmsl;
        $where['xyid'] = $data['id'];
        //$this->ajaxReturn($data);
        M(session('mydbname') . '.' . 'xieyi_fwxm_num')->where($where)->delete();
        for ($i=0; $i <count($data['xmid']) ; $i++) { 
            $data['xyid'] = $data['id'];
            $data['fwid'] = $data['xmid'][$i];
            $data['buynum'] = $data['xmsl'][$i];
            $data['pid'] = $_SESSION['officeplatformAdmin']['pid'];
            $res = M(session('mydbname') . '.' . 'xieyi_fwxm_num')->add($data);
        }
        if($res){
            $msg['info'] = 'success';
            $msg['status'] = 0;
            $this->ajaxReturn($msg);
        } else {
            $msg['info'] = 'fail';
            $msg['status'] = 1;
            $this->ajaxReturn($msg);
        }


    }

    

    public function edit_do()
    {   
        $result = M(session('mydbname') . '.' . 'qianyueleixing')->save($_POST);
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
        $mydata = $_POST;
        $result = M(session('mydbname') . '.' . 'qianyueleixing')->add($mydata);
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

   

    public function object(){
        // 协议ID，xmid
        $id = I('id');
        $qydatalist = M(session('mydbname') . '.' . 'xieyi_fwxm_num')->alias('a')
            ->join(array("LEFT JOIN ".session('mydbname') . '.'."__FWXM__ b ON a.fwid = b.id",
                "LEFT JOIN ".session('mydbname') . '.'."__FWXM_FL__ c ON b.fl = c.id"))
            ->field("a.*,b.*,c.mc")
            ->where(array('b.status' => 2,'a.xyid'=>$id))
            ->order('b.msort')->select();
        if(!$qydatalist){
              $qydatalist = M(session('mydbname') . '.' . 'xieyi_fwxm_num')->alias('a')
            ->join(array("LEFT JOIN ".session('mydbname') . '.'."__FWXM__ b ON a.fwid = b.id",
                "LEFT JOIN ".session('mydbname') . '.'."__FWXM_FL__ c ON b.fl = c.id"))
            ->field("a.*,b.*,c.mc")
            ->where(array('b.status' => 2,'a.xyid'=>$id))
            ->order('b.msort')->select();  
        }
        //echo M(session('mydbname') . '.' . 'xieyi_fwxm_num')->getLastSql();
        //dump($qydatalist);
        $this->datacount=count($qydatalist);
        $this->id = $id;
        $this->dataList = $qydatalist;
        $this->display();
    }

    public function object_add(){
        $id = I('id');
        // 获取已存在fwid
        $fwidarr = M(session('mydbname') . '.' . 'xieyi_fwxm_num')->where(array('xyid'=>$id))->field('fwid')->select();
        foreach ($fwidarr as $k => $v) {
            $ids[] = $v['fwid'];
        }
        if(!empty($ids)){
           $qydatalist = M(session('mydbname') . '.' . 'fwxm')->alias('a')
            ->join("LEFT JOIN ".session('mydbname') . '.'."__FWXM_FL__ b ON a.fl = b.id")
            ->field("a.*,b.mc")
            ->where(array('a.status' => 2,'a.id'=>array('NOT IN',$ids)))
            ->order('a.msort')->select(); 
        }else{
            $qydatalist = M(session('mydbname') . '.' . 'fwxm')->alias('a')
            ->join("LEFT JOIN ".session('mydbname') . '.'."__FWXM_FL__ b ON a.fl = b.id")
            ->field("a.*,b.mc")
            ->where(array('a.status' => 2))
            ->order('a.msort')->select();
        }
        
        if(!$qydatalist){
              $qydatalist = M(session('mydbname') . '.' . 'fwxm')->alias('a')
            ->join("LEFT JOIN ".session('mydbname') . '.'."__FWXM_FL__ b ON a.fl = b.id")
            ->field("a.*,b.mc")
            ->where(array('a.status' => 2))
            ->order('a.msort')->select();  
        }
        //dump($ids);
        
        $this->dataList = $qydatalist;
        $this->id =$id;
        $this->display();
    }

    public function object_add_do(){
        $data = $_POST ;
        $xmsl = array();
        for ($i=0; $i < count($data['xmid']); $i++) { 
            $xmsl[$i] = $data['num_'.$data['xmid'][$i]];
        }
        $data['xmsl']=$xmsl;
        for ($i=0; $i <count($data['xmid']) ; $i++) { 
            $data['xyid'] = $data['id'];
            $data['fwid'] = $data['xmid'][$i];
            $data['buynum'] = $data['xmsl'][$i];
            $data['pid'] = $_SESSION['officeplatformAdmin']['pid'];
            $res = M(session('mydbname') . '.' . 'xieyi_fwxm_num')->add($data);
        }
        if($res){
            $msg['info'] = 'success';
            $msg['status'] = 0;
            $this->ajaxReturn($msg);
        } else {
            $msg['info'] = 'fail';
            $msg['status'] = 1;
            $this->ajaxReturn($msg);
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
        $result = M(session('mydbname') . '.' . 'qianyueleixing')->where($where)->setField('mstatus',$data['mstatus']);
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
    // public function pay_object(){
    //     $xyxmstr = I('xyxmstr');
    //     $xyxmarr = explode(',', $xyxmstr);
    //     if(!empty($xyxmstr)){
    //        for ($i=0; $i <count($xyxmarr) ; $i++) { 
    //             $data['xyid'] = explode('-', $xyxmarr[$i])[0];
    //             $data['fwid'] = explode('-', $xyxmarr[$i])[1];
    //             $data['buynum'] = explode('-', $xyxmarr[$i])[2];
    //             $res = M(session('mydbname') . '.' . 'xieyi_fwxm_num')->add($data);
    //         }
    //     }
    //     if($res){
    //         $msg['info'] = 'success';
    //         $msg['status'] = 0;
    //         $this->ajaxReturn($msg);
    //     } else {
    //         $msg['info'] = 'fail';
    //         $msg['status'] = 1;
    //         $this->ajaxReturn($msg);
    //     }

    // }


}