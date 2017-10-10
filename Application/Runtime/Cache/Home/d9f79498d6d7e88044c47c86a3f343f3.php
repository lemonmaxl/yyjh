<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/lib/html5.js"></script>
    <script type="text/javascript" src="/Public/lib/respond.min.js"></script>
    <script type="text/javascript" src="/Public/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <title>医院设备</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理<span
        class="c-gray en">&gt;</span> 医院设备 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
        class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <!--<form action="<?php echo U('SysUser/index');?>" method="get">-->
            <!--&lt;!&ndash;<select class="input-text" id="selpid" size="1" name="selpid" style="width:250px">&ndash;&gt;-->
                <!--&lt;!&ndash;<option value="0">选择部门</option>&ndash;&gt;-->
                <!--&lt;!&ndash;<?php if(is_array($depList)): $i = 0; $__LIST__ = $depList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>&ndash;&gt;-->
                    <!--&lt;!&ndash;<option value="<?php echo ($vo["id"]); ?>">├<?php echo ($vo["delimiter"]); echo ($vo["name"]); ?></option>&ndash;&gt;-->
                <!--&lt;!&ndash;<?php endforeach; endif; else: echo "" ;endif; ?>&ndash;&gt;-->
            <!--&lt;!&ndash;</select>&ndash;&gt;-->
            <!--&lt;!&ndash;<select class="input-text" id="selpost" size="1" name="selpost" style="width:250px">&ndash;&gt;-->
                <!--&lt;!&ndash;<option value="0">选择岗位</option>&ndash;&gt;-->
                <!--&lt;!&ndash;<?php if(is_array($postList)): $i = 0; $__LIST__ = $postList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>&ndash;&gt;-->
                    <!--&lt;!&ndash;<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option>&ndash;&gt;-->
                <!--&lt;!&ndash;<?php endforeach; endif; else: echo "" ;endif; ?>&ndash;&gt;-->
            <!--&lt;!&ndash;</select>&ndash;&gt;-->
            <!--<input type="text" class="input-text" style="width:250px;margin-top: -5px" placeholder="输入用户、真实姓名"-->
                   <!--id="keyword"-->
                   <!--name="keyword"-->
                   <!--value="<?php echo ($keyword); ?>">-->
            <!--<button type="sumit" class="btn btn-success radius" style="margin-top: -5px"><i class="Hui-iconfont">-->
                <!--&#xe665;</i> 搜用户-->
            <!--</button>-->
        <!--</form>-->
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"></span>
        <span class="r">共有数据：<strong><?php echo ($datacount); ?></strong> 条</span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th width="80">设备号</th>
            <th width="80">血压编码</th>
            <th width="80">血糖编码</th>
            <th width="80">状态</th>
        </tr>
        </thead>
        <tbody>

        <?php if(is_array($device)): $i = 0; $__LIST__ = $device;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><a style="color: #0000cc" href="javascript:;"
                       onclick="device(<?php echo ($vo["id"]); ?>,<?php echo ($id); ?>)"><?php echo ($vo["name"]); ?></a></td>
                <td><?php echo ($vo["xynumber"]); ?></td>
                <td><?php echo ($vo["xtnumber"]); ?></td>
                <td class="td-status">
                    <?php if($vo["status"] == 2): ?><span class="label label-success radius">未分配</span>
                        <?php else: ?>
                        <span class="label label-danger radius">已分配</span><?php endif; ?>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div id="page" class="Pagination">
        <?php echo ($page); ?>
    </div>
</div>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Public/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
   
   function device(id,uid){
       $.ajax({
            type: "POST",
            url: "<?php echo U('SysUser/get_device');?>",//+tab,
            data: {
                id: uid,
                device : id
            },// 你的formid
            success: function (data) {
                alert('分配成功！');
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            }
        });
   }
</script>
</body>
</html>