<?php
namespace Home\Controller;

class QianyueController extends BaseController{
    //签约查询
    public function index(){
        $name = urldecode(I('name'));
        $ownphone = I('ownphone');
        $begin_time = I('begin_time');
        $over_time = I('over_time');
        $idcard = I('idcard');
        $code = I('code');
        $hid = session('admin')['hid'];
        // $cid = session('admin')['cid'];
        if(!empty($name)){
            $where['_complex'] = array(
                'a.jiafang' => array('LIKE', '%' . $name . '%'),
                'a.yifang' => array('LIKE', '%' . $name . '%'),
                '_logic' => 'or'
            );
            $map['name'] = $name;
        }
        if(!empty($ownphone)){
            $where['a.jiatingdianhua']=array('like','%'.$ownphone.'%');
            $map['ownphone'] = $ownphone;
        }
        if(!empty($idcard)){
            $where['b.idcard']=$idcard;
            $map['idcard'] = $idcard;
        }
        if(!empty($code)){
            $where['b.code']=$code;
            $map['code'] = $code;
        }
        if(!empty($begin_time) && empty($over_time)){
            $where['a.begin_date']=array('gt',$begin_time);
            $map['begin_time'] = $begin_time;

        }else if(empty($begin_time) && !empty($over_time)){
            $where['a.begin_date']=array('lt',$over_time);
            $map['over_time'] = $over_time;
        }else if(!empty($begin_time) && !empty($over_time)){
            $where['a.begin_date'] = array('between', "$begin_time, $over_time");
            $map['begin_time'] = $begin_time;
            $map['over_time'] = $over_time;
        }

        $where['a.hid'] = $hid;
        $where['a.xieyilx'] = array('exp','IS NULL');
        $map['hid'] = $hid;
        $count = M('qianyue') ->alias('a')
            ->join(array("LEFT JOIN __MEMBER__ b ON a.uid = b.id","LEFT JOIN __CLINIC__ c ON b.cid = c.id"))
            ->field("a.*,b.cid,c.title")-> where($where) ->count();
        $Page=new \Think\Page($count,15);
        foreach ($map as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $data = M('qianyue') ->alias('a')
            ->join(array("LEFT JOIN __MEMBER__ b ON a.uid = b.id","LEFT JOIN __CLINIC__ c ON b.cid = c.id"))
            ->field("a.*,b.cid,c.title")
            -> where($where)->order("a.qydate desc")-> limit($Page->firstRow.','.$Page->listRows) ->select();
        //echo M('qianyue')->getLastSql();
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        $this->name = $name;
        $this->ownphone = $ownphone;
        $this->begin_time = $begin_time;
        $this->over_time = $over_time;
        $this->idcard = $idcard;
        $this->code = $code;
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    public function getQybfwxm(){
        $bid=I('bid');

        $data=M('qianyue_fwb_item')->alias('a')
            ->join("INNER JOIN __QIANYUE_FWXM__ b ON a.xmid=b.id")
            ->field("a.*,b.title,b.memo")
            ->where(array('a.bid'=>$bid))->select();

        $this->ajaxReturn(array('status'=>0,'msg'=>'成功','data'=>$data));
    }

    //添加签约
    public function add(){
        $hid = session('admin')['hid'];
        $cid = session('admin')['cid'];
        $yymc=M('hospital')->where(array('id'=>$hid))->getField('title');

        $qydatalist = M(session('mydbname') . '.' . 'qianyue_fwb')->where(array('hid'=>$hid,'status'=>2))->select();
        if(!$qydatalist){
            $qydatalist = M(session('mydbname') . '.' . 'qianyue_fwb')->where(array('hid'=>2,'status'=>2))->select();
        }
        // dump($qydatalist);

        $this->qydatalist = $qydatalist;

        $data=M('qianyue_fwb_item')->alias('a')
            ->join('INNER JOIN __QIANYUE_FWXM__ b ON a.xmid=b.id')
            ->field('a.*,b.title,b.memo')
            ->where(array('a.bid'=>$bid))->select();
        // dump($data);

        $qianyue_set = M("qianyue_set") -> where(array('hid'=>$hid))  ->find();
        if(!$qianyue_set){
            $qianyue_set = M("qianyue_set") -> where(array('hid'=>2))  ->find();
        }
        $this->qianyue_set = $qianyue_set;

        $this->hid = $hid;
        $this->cid = $cid;
        $this->yymc = $yymc;
        $this->display();
    }

    public function fwxm(){
        $hid = session('admin')['hid'];
        $qydatalist = M('fwxm')->alias('a')
            ->join("LEFT JOIN __FWXM_FL__ b ON a.fl = b.id")
            ->field("a.*,b.mc")
            ->where(array('a.hid'=>$hid,'a.status' => 2))
            ->order('a.msort')->select();
        if(!$qydatalist){
              $qydatalist = M('fwxm')->alias('a')
            ->join("LEFT JOIN __FWXM_FL__ b ON a.fl = b.id")
            ->field("a.*,b.mc")
            ->where(array('a.hid'=>2,'a.status' => 2))
            ->order('a.msort')->select();  
        }
        $this->dataList = $qydatalist;
        $this->display();
    }

    public function getfwxm(){
        // $hid = session('admin')['hid'];
        // $where['hid']=
        $xmstr = I('xmstr');
        // $xmarr = explode(',',$xmstr);
        $where['a.id']=array('in',$xmstr);

        
        $qydatalist = M('fwxm')->alias('a')
            ->join("LEFT JOIN __FWXM_FL__ b ON a.fl = b.id")
            ->field("a.*,b.mc")
            ->order("a.fl")
            ->where($where)->select();
        $this->ajaxReturn($qydatalist);

    }

    public function select_member(){
        $where['hid'] = session('admin')['hid'];
        $keyword = I('keyword');
        if (!empty($keyword)){
            $map['name']=array('like','%'.$keyword.'%');
            $map['ownphone']=array('like','%'.$keyword.'%');
            $map['idcard']=array('like','%'.$keyword.'%');
            $map['_logic'] = 'OR';
            $where['_complex'] = $map;
        }
        
        
        $count = M('member')
            ->where($where)->count();
        $Page=new \Think\Page($count,6);
        $data = M('member')
            ->where($where)
            ->order('id desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        // dump(M('member')->getLastSql());
        $Page->parameter['keyword'] = $keyword;
        $page=$Page->show(); //组装分页字符串
        $this->datacount = count($count);
        $this->keyword = $keyword;
        $this->page=$page;
        $this->data=$data;
        $this->display();
    }

    public function get_member(){
        $hid = session('admin')['hid'];
        $id = I('id') ;

        // $data = M('member')->where(array('id'=>$id,'hid'=>$hid))->select();
        $fid = M('member')->where(array('id'=>$id))->getField('fid');        
        $data = M('member')->where(array('fid'=>$fid,'hid'=>$hid))->select();
        $this->ajaxReturn($data);
    }

    public function add_do(){
        $data = I('post.');
        //$this->ajaxReturn($data);
        $arr['yifang'] = $data['name'];
        $arr['jiatingdianhua'] = $data['ownphone'];
        $arr['zhuzhi'] = $data['address'];
        $arr['dananhao'] = $data['code'];
        $arr['shengfzh'] = $data['idcard'];
        $arr['chengyuanrenshu'] = $data['jtcyrs'];
        $arr['chengyuanxingm'] = $data['jtcyxm'];
        $arr['fwdh'] = $data['fwdh'];
        $arr['td'] = $data['tdcy'];
        $arr['qianyuecate'] = $data['qianyuecate'];
        if (!empty($data['begin_date'])){
            $arr['begin_date'] = $data['begin_date'];
        }
        if (!empty($data['end_date'])){
            $arr['end_date'] = $data['end_date'];
        }
        $arr['date'] = $data['begin_date'] .'--'.$data['end_date'];
        $arr['jiafang'] = M('hospital') -> where(array("id" => $data['hid'])) ->getfield('title');
        $arr['hid'] = $data['hid'];
        $arr['age'] = $data['age'];
        if (!empty($data['sex'])){
            $arr['sex'] = $data['sex'];
        }
        $arr['nation'] = $data['nation'];
        $arr['brithday'] = $data['brithday'];
        if (!empty($data['fwbid'])){
            $arr['fwbid'] = $data['fwbid'];
        }
        if (!empty($data['qylx'])){
            $arr['qylx'] = $data['qylx'];
        }
        if (!empty($data['fwxm'])){
            $arr['fwxm'] = $data['fwxm'];
        }
        
        
        

        $uid=I('uid');
        
        if (empty($uid)) {
            $data['sfhz'] = 1;
            $data['relation'] = '本人';
            $data['jdrq'] = date('Y-m-d H:i:s',time());
            
            
            $arr['uid'] = M('member') -> add($data);
            $fid = M('member') -> where(array('id' => $arr['uid'])) -> setfield('fid',$arr['uid']);
            
            $res = M('qianyue') -> add($arr);
            

            

            $xingming = I('xingming');
            $guanxi = I('guanxi');
            $xingbie = I('xingbie');
            $xsny = I('xsny');

            for($i=0;$i<count($xingming);$i++){
                $item['guanxi'] = $guanxi[$i];
                $item['xingbie'] = $xingbie[$i];
                $item['xingming'] = $xingming[$i];
                $item['xsny'] = $xsny[$i];
                if(($guanxi[$i] == '') && ($xingbie[$i] == '') && ($xingming[$i] == '') && ($xsny[$i] == '')){

                }else{
                    $item['qyid'] = $res;
                    M('qianyue_item') -> add($item);
                }                
            }

        }else{
            
            $arr['uid'] = $data['uid'];
            $res = M('qianyue') -> add($arr);
            
            $uidarr = I('uidarr');
            if($uidarr){
                $item = array();
                for($i=0;$i<count($uidarr);$i++){
                    $info = M('member') -> where(array('id'=>$uidarr[$i])) -> field('name,sex,relation,brithday') ->find();
                    $item[$i]['guanxi'] = $info['relation'];
                    $item[$i]['xingbie'] = $info['sex'];
                    $item[$i]['xingming'] = $info['name'];
                    $item[$i]['xsny'] = $info['brithday'];
                    $item[$i]['qyid'] = $res;
                }
                M('qianyue_item') -> addAll($item);
            }
            
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

    public function del(){
        $id = I('id');
        $res = M('qianyue') -> where("id = $id") ->delete();
        $res1 = M('qianyue_item') -> where("qyid = $id") ->delete();
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


    //服务项目
    public function select(){
        $hid = session('admin')['hid'];
        $count = M('fwxm') -> where(array('hid'=>$hid)) -> count();
        // $count = M('fwxm') -> count();
        $Page=new \Think\Page($count,15);
        foreach ($map as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $data = M('fwxm') -> where(array('hid'=>$hid)) -> limit($Page->firstRow.','.$Page->listRows) -> select();
        // $data = M('fwxm') -> limit($Page->firstRow.','.$Page->listRows) -> select();
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        $this->data = $data;
        $this->display();
    }
   

    //详情
    public function info(){
        $id = I('id');
        $data = M('qianyue_item') -> where (array('qyid' => $id)) -> select();
        $this->qyid = $id;
        $this->dataList = $data;
        $this->datacount = count($data);
        $this->display();
    }

    //添加签约项目
    public function add_item(){
        $qyid = I('qyid');
        $this->qyid = $qyid;
        $this->display();
    }

    public function add_item_do(){
        $data = I('post.');
        $res = M('qianyue_item') ->add($data);
        $this->ajaxReturn($res);
    }

    //修改项目
    public function edit_item(){
        $id = I('id');
        $data = M('qianyue_item') ->where(array('id'=>$id)) ->find();
        $this->data =$data;
        $this->display();
    }

    public function edit_item_do(){
        $data = I('post.');
        $res = M('qianyue_item') ->save($data);
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

    // 删除项目
    public function del_item(){
        $id = I('id');
        $result = M('qianyue_item') -> where(array('id'=>$id)) ->delete();
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

    //签约照片
    public function picture(){
        $id = I('id');
        $picture = M("qianyue") -> where("id = $id") ->getField('img');
        if(!empty($picture)){
            $data = explode(",",$picture);
            $this->data = $data;
        }
        $this->display();
    }



    public function print_bsd(){
        $this->assign('id',I("id"));
        $this->display();
    }


    //打印签约单
    public function print_bd()
    {
        $hid = session('admin')['hid'];
        $data['a.id'] = I('id');
        // $info = M('qianyue')->alias('a')
        //     ->join(array("LEFT JOIN __QIANYUE_ITEM__ b ON a.id = b.qyid","LEFT JOIN __HOSPITAL__ c ON a.hid = c.id"))
        //     ->field("a.*,b.guanxi,b.xingbie,b.xsny,b.fwxm,b.qtyd,b.xingming,c.title")
        //     ->where($data)
        //     ->select();
        $info = M('qianyue') ->alias('a')
            ->join("LEFT JOIN __HOSPITAL__ b ON a.hid = b.id")
            ->field("a.*,b.title")
            -> where(array('a.id'=>I('id'))) ->find();
        //图片
        if(!empty($info['img'])){
            // $info['imgitem']['flag'] = 1;
            $info['imgitem'] = explode(",",$info['img']);
        }else{
            $info['imgitem']['flag'] = 0;
        }
        // // 签约协议类型xieyi_cate//xieyi_set，签约类型1健康签约2家庭签约
        // $xieyilx = $info['xieyilx'];
        // $info['xieyicontent'] = M('jbyf_xieyi_set')->alias('d')->join('LEFT JOIN __JBYF_XIEYI_CATE__ f ON d.cateid=f.id')->order(array('msort'))->where(array('cateid'=>$xieyilx,'mstutas'=>0))->select();


        //签约成员
        $info['item'] = M('qianyue_item') -> where(array('qyid'=>I('id'))) ->select(); 
        if(empty($info['item'])){
            $info['item']['flag'] = 0;
        }
        //服务项目
        if(empty($info['fwxm'])){
            $info['fwxmitem']['flag'] = 0;
        }else{
            // $info['fwxmitem']['flag'] = 1;
            $where['a.id']=array('in',$info['fwxm']);
            $info['fwxmitem'] = M('fwxm') -> alias('a')
                        -> join('INNER JOIN __FWXM_FL__ b ON a.fl=b.id')
                        -> field('a.*,b.mc')
                        -> where($where) ->select();
        }
        //服务包
        if ($info['fwbid']>0){
            
            $info['fwbname']=M(session('mydbname') . '.' . 'qianyue_fwb')->where(array('id'=>$info['fwbid']))->getField('title');
            $where1['a.bid']=$info['fwbid'];

            $info['fwbitem']=M('qianyue_fwb_item')->alias('a')
                        -> join('INNER JOIN __QIANYUE_FWXM__ b ON a.xmid=b.id')
                        -> field('b.*')
                        -> where($where1)
                        -> select();
                     
        }


        $qysz = M(session('mydbname') . '.' . 'qianyueset')->where(array('hid'=>$hid))->find();
        if(empty($qysz)){
            $info['qysz']['flag'] = 0;
        }else{
            $info['qysz'] = $qysz ;
        }
        


        $this->ajaxReturn($info);
    }

    public function setqianyue(){
        $hid = session('admin')['hid'];
        $data=M(session('mydbname') . '.' . 'qianyueset')->where("hid=$hid")->find();
        $this->data=$data;
        $this->display();
    }

    public function setqianyue_do(){
        $data=I('post.');
        $hid = session('admin')['hid'];
        $mydata=M(session('mydbname') . '.' . 'qianyueset')->where(array('hid'=>$hid))->find();
        if (empty($mydata)){
            $data['hid']=$hid;
            $result = M(session('mydbname') . '.' . 'qianyueset')->add($data);
        }else{
            $result = M(session('mydbname') . '.' . 'qianyueset')->where("hid=$hid")->save($data);
        }
        
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


    //签约服务项目
    public function qyfwxm(){
        $hid = session('admin')['hid'];
        $where['hid'] = $hid;
        $map['hid'] = $hid;
        $keyword = urldecode(I('keyword'));
        $where['_complex'] = array(
            'title' => array('LIKE', '%' . $keyword . '%'),
            'memo' => array('LIKE', '%' . $keyword . '%'),
            '_logic' => 'or'
        );
        $map['keyword'] = $keyword;
        $count = M(session('mydbname') . '.' . 'qianyue_fwxm') ->where($where) -> count();
        $Page=new \Think\Page($count,15);
        foreach ($map as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $data=M(session('mydbname') . '.' . 'qianyue_fwxm')->where($where)
            -> limit($Page->firstRow.','.$Page->listRows)
            ->order("id desc,status desc")->select();
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        $this->datacount = $count;
        $this->keyword = $keyword;
        $this->dataList=$data;
        $this->display();
    }

    //添加签约服务项目
    public function qyfwxmadd_do(){
        $hid = session('admin')['hid'];
        $data=I('post.');
        $data['hid']=$hid;
        M(session('mydbname') . '.' . 'qianyue_fwxm')->add($data);
        $this->ajaxReturn($data);
    }

    //修改签约服务项目
    public function qyfwxmedit(){
        $id = I('id');
        $data = M(session('mydbname') . '.' . 'qianyue_fwxm')->where(array('id'=>$id))->find();
        $this->data=$data;
        $this->display();
    }


    public function qyfwxmedit_do(){
        $data=I('post.');
        M(session('mydbname') . '.' . 'qianyue_fwxm')->save($data);
        $this->ajaxReturn($data);
    }

    //删除签约服务项目
    public function qyfwxmdel(){
        $id = I('id');
        $res = M(session('mydbname') . '.' . 'qianyue_fwxm')->where(array('id'=>$id))->delete();
        $this->ajaxReturn($res);
    }


    public function qyfwxmstart()
    {
        $data['status'] = 2;
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'qianyue_fwxm')->save($data);

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
    public function qyfwxmstop()
    {
        $data['status'] = 1;
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'qianyue_fwxm')->save($data);

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



    //签约服务包
    public function fwb(){
        $hid = session('admin')['hid'];
        $where['hid'] = $hid;
        $map['hid'] = $hid;
        // $keyword = urldecode(I('keyword'));
        // $where['_complex'] = array(
        //     'title' => array('LIKE', '%' . $keyword . '%'),
        //     'memo' => array('LIKE', '%' . $keyword . '%'),
        //     '_logic' => 'or'
        // );
        // $map['keyword'] = $keyword;
        $count = M(session('mydbname') . '.' . 'qianyue_fwb') ->where($where) -> order("status desc ,create_time desc") -> count();
        $Page=new \Think\Page($count,15);
        foreach ($map as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $data=M(session('mydbname') . '.' . 'qianyue_fwb')->where($where)-> limit($Page->firstRow.','.$Page->listRows) -> order("status desc ,create_time desc")->select();
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        $this->datacount = $count;
        $this->keyword = $keyword;
        $this->dataList=$data;
        $this->display();
    }

    //添加签约服务包
    public function add_fwb(){
        $hid = session('admin')['hid'];
        if($_POST){
            $data=I('post.');
            $data['hid']=$hid;
            M(session('mydbname') . '.' . 'qianyue_fwb')->add($data);
            $this->ajaxReturn($data);
        }else{
            $this->display();
        }
        
        
        // 
    }
    //修改签约服务包
    public function fwb_edit(){
        $id = I('id');
        $data = M(session('mydbname') . '.' . 'qianyue_fwb')->where(array('id'=>$id))->find();
        $this->data=$data;
        $this->display();
    }


    public function fwb_edit_do(){
        $data=I('post.');
        M(session('mydbname') . '.' . 'qianyue_fwb')->save($data);
        $this->ajaxReturn($data);
    }

    //删除签约服务包
    public function fwb_del(){
        $id = I('id');
        $res = M(session('mydbname') . '.' . 'qianyue_fwb')->where(array('id'=>$id))->delete();
        $this->ajaxReturn($res);
    }

    public function fwbstart()
    {
        $data['status'] = 2;
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'qianyue_fwb')->save($data);

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
    public function fwbstop()
    {
        $data['status'] = 1;
        $data['id'] = I('id');
        $result = M(session('mydbname') . '.' . 'qianyue_fwb')->save($data);

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

    //服务包——项目
    public function fwb_xm(){
        $where['a.bid'] = I('id');
        $where['a.hid'] = session('admin')['hid'];
        $data = M('qianyue_fwb_item') ->alias('a')
            ->join(array("LEFT JOIN __QIANYUE_FWXM__ c ON a.xmid = c.id"))
            ->field('a.*,c.title,c.memo')
            ->order('id')
            -> where($where) -> select();
        $this->dataList = $data;
        $this->bid = I('id');
        $this->display();
    }


    //选择服务项目
    public function select_fwxm(){
        $bid = I('bid');
        $hid = session('admin')['hid'];
        $count = M(session('mydbname') . '.' . 'qianyue_fwxm') -> where("hid = $hid") -> count();
        $Page=new \Think\Page($count,10);
        
        
        $data = M(session('mydbname') . '.' . 'qianyue_fwxm') -> where(array("hid" => $hid,'status'=>2)) 
            -> limit($Page->firstRow.','.$Page->listRows)
            ->order('id desc')
            -> select();
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        $this->dataList =$data;
        $this->bid = $bid;
        $this->display();
    }


    ////添加签约服务包——项目
    public function add_fwb_xm(){
        $hid = session('admin')['hid'];
        $data['hid']=$hid;
        $xmidstr = I('xmidstr');
        $xmarr = explode(',',$xmidstr);
        $data['bid'] = I('bid');
        for($i=0;$i<count($xmarr);$i++){
            $data['xmid'] = $xmarr[$i];
            M('qianyue_fwb_item')->add($data);
        }
        $this->ajaxReturn($data);
        
    }
    
    public function fwb_xm_del(){
        $id = I('id');
        $res = M('qianyue_fwb_item')->where(array('id'=>$id))->delete();
        $this->ajaxReturn($res);
    }



}