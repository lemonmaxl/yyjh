<?php
namespace Home\Controller;
class ClinicController extends BaseController{
    //健康评估
    public function index(){
        $count = M(session('mydbname') . '.' . 'clinic')->alias('a')
        ->join("LEFT JOIN __SYS_USER__ b ON a.id = b.cid")
        ->field('a.*,b.id as uerid')
        ->count();
        $Page=new \Think\Page($count,15);
        $data = M(session('mydbname') . '.' . 'clinic')->alias('a')
        ->join("LEFT JOIN __SYS_USER__ b ON a.id = b.cid")
        ->field('a.*,b.id as uerid')
        -> limit($Page->firstRow.','.$Page->listRows)->select();
        // dump(M('clinic') ->getLastSql());
        // dump($data);
        $this->dataList = $data;
        $page=$Page->show(); //组装分页字符串
        $this->assign('page',$page);
        $this->datacount = count($data);
        $this->display();
    }

    //添加
    public function add(){
        
        $this->display();
    }

    public function add_do(){
        $data = $_POST;
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $result = M(session('mydbname') . '.' . 'clinic')->add($data);

        $arr['cid'] = $result;
        $arr['hid'] = session('admin')['hid'];
        $arr['username'] = $data['phone'];
        $arr['truename'] = $data['name'];
        $arr['password'] = sha1(md5('123456'));
        $user = M('sys_user') -> add($arr);
        if ($result && $user) {
            unset($data);
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }


    //修改
    public function edit(){
        $id = I('id');
        $data = M(session('mydbname') . '.' . 'clinic')-> where (array('id' => $id)) -> find();
        $this->data = $data;
        $this->display();
    }

    public function edit_do(){
        $data = $_POST;
        $result = M(session('mydbname') . '.' . 'clinic')->save($data);
        if ($result) {
            $arr['info'] = 'success';
            $arr['status'] = 0;
            $this->ajaxReturn($arr);
        } else {
            $arr['info'] = 'fail';
            $arr['status'] = 1;
            $this->ajaxReturn($arr);
        }
    }


    public function del()
    {
        $data['id'] = I('id');
        $hid = session('admin')['hid'];
        $result = M(session('mydbname') . '.' . 'clinic')->where($data)->delete();

        if ($result !== false) {
            M('sys_user') ->where(array('cid'=>$data['id'],'hid'=>$hid))->delete();
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }

    //添加管理员
    public function admin(){
        $hid = session('admin')['hid'];
        $id = I('id');
        $where['hid'] = $hid;
        $where['cid'] = $id;
        $data = M('sys_user') -> where($where) -> find();
        $this->data = $data;
        $this->hid = $hid;
        $this->cid = $id;
        $this->type = 1;
        $this->display();
    }

    public function admin_do(){
        $data = $_POST;
        $password = $data['password'];
        $data['password'] = sha1(md5($password));
        if($data['id']){
            $res = M('sys_user') -> where(array('id'=>$data['id'])) -> save($data);
        }else{
            $user = M('sys_user') -> where(array('username'=>$data['username'])) -> find();
            if($user){
                $this->ajaxReturn('用户名已存在！');
            }else{
                $res = M('sys_user') -> add($data);
            }
        }
        if ($res) {
            unset($data);
            $data['info'] = 'success';
            $data['status'] = 0;
            $this->ajaxReturn($data);
        } else {
            $data['info'] = 'fail';
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }


    public function setqr(){
        $id = I('id');
        $hid = session('admin')['hid'];
        $appinfo = M('hospital_ext') -> where(array('hid'=>$hid)) -> field('appid,appsecret') ->find();
        $ew_img = 'public/qrimg/'.$id.'/'.$id.'.jpg';
        // if(!is_file($ew_img)){
            if(!empty($appinfo)){
                $this->appid=$appinfo['appid'];
                $this->appsecret=$appinfo['appsecret'];

                //缓存access_token，两个小时过期
                $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
                $res=$this->http_request($url);
                $result = json_decode($res, true);
                $access_token=$result['access_token'];

                $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
                $data='{ 
                    "action_name": "QR_LIMIT_SCENE", 
                    "action_info": {
                        "scene": {
                            "scene_id": '.$id.'
                        }
                    }
                }';
                $res=$this->http_request($url,$data);
                $result = json_decode($res, true);

                $ticket=$result['ticket'];

                $surl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$ticket;

                $ress=$this->http_request($surl);
                if(!is_dir('Public/qrimg/'.$id)){
                    mkdir('Public/qrimg/'.$id);
                }
                $file_name = 'Public/qrimg/'.$id.'/'.$id.'.jpg';
                file_put_contents('Public/qrimg/'.$id.'/'.$id.'.jpg',$ress);
                $this->url = $file_name;
                $this->display();
            }else{
                $this->error("请完善你的公众号信息");
            }
        // }else{
        //     $this->url = $ew_img;
        //     $this->display();
        // }
    }




    //https请求(支持GET和POST)
    function http_request($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        //var_dump(curl_error($curl));
        curl_close($curl);
        return $output;
    }
}