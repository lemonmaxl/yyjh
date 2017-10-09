<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
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
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
        class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
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
    <div class="cl pd-5 bg-1 bk-gray ">
    <span class="l">
    <a href="javascript:;" onclick="admin_add('添加','<?php echo U('SysUser/add');?>','900','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加 </a></span>
    <span class="r">共有数据：<strong><?php echo ($datacount); ?></strong> 条</span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="80">登录账号</th>
            <th width="80">真实姓名</th>
            <th width="80">固定电话</th>
            <th width="80">手机</th>
            <th width="80">医院名称</th>
            <th width="120">创建时间</th>
            <th width="40">设备</th>
            <th width="60">状态</th>
            <th width="160">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id"></td>
                <td><?php echo ($vo["username"]); ?></td>
                <td><?php echo ($vo["truename"]); ?></td>
                <td><?php echo ($vo["tel"]); ?></td>
                <td><?php echo ($vo["mobile"]); ?></td>
                <td><?php echo ($vo["ptitle"]); ?></td>
                <td><?php echo ($vo["create_time"]); ?></td>
                <td><?php echo ($vo["name"]); ?></td>
                <td class="td-status">
                    <?php if($vo["mstatus"] == 0): ?><span class="label label-success radius" onclick="changeStatus(<?php echo ($vo["id"]); ?>)"
                              id="status_<?php echo ($vo["id"]); ?>" data-status="<?php echo ($vo["mstatus"]); ?>">已启用</span>
                        <?php else: ?>
                        <span class="label radius" onclick="changeStatus(<?php echo ($vo["id"]); ?>)" id="status_<?php echo ($vo["id"]); ?>"
                              data-status="<?php echo ($vo["mstatus"]); ?>">已禁用</span><?php endif; ?>
                </td>
                <td class="td-manage">
                    
                    
                        <a title="编辑" href="javascript:;"
                           onclick="admin_edit('编辑','<?php echo U('SysUser/edit');?>',<?php echo ($vo["id"]); ?>,'','510')"
                           class="ml-5" style="text-decoration:none">编辑</a>
                        <a style="text-decoration:none" class="ml-5" onClick="change_password(this,<?php echo ($vo["id"]); ?>)"
                           href="javascript:;" title="初始化密码">初始化密码</a>
                    
                        <a title="删除" href="javascript:;" onclick="admin_del(this,<?php echo ($vo["id"]); ?>)" class="ml-5"
                           style="text-decoration:none">删除</a>
                    
                        <a title="角色" href="javascript:;"
                           onclick="admin_edit('角色','<?php echo U('SysUser/fun');?>',<?php echo ($vo["id"]); ?>,'800','500')" class="ml-5"
                           style="text-decoration:none">角色</a>
                    <?php if($vo['rid'] == $rid): ?><a title="分配" href="javascript:;"
                           onclick="admin_edit('分配','<?php echo U('SysUser/device');?>',<?php echo ($vo["id"]); ?>,'800','500')" class="ml-5"
                           style="text-decoration:none">分配<?php endif; ?>
                </td>

            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>

    </table>
    <div id="page" class="Pagination">
        <!--<div style="width:30%;float: left;">-->
        <!--<a href="javascript:;" class="selbox">全选</a>-->
        <!--<a href="javascript:;" class="anti">反选</a>-->
        <!--<a href="javascript:;" class="unselbox">全不选</a>-->
        <!--对选中项进行&nbsp;&nbsp;<a href="javascript:;" id="pass">通过</a>&nbsp;&nbsp;<a href="javascript:;"-->
        <!--id="refuse">拒绝</a>-->
        <!--</div>-->
        <?php echo ($page); ?>
    </div>
    <!--</div>-->
</div>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/Public/lib/laypage/1.2/laypage.js"></script>

<script type="text/javascript">
function changeStatus(id) {
    var dataStatus = $("#status_" + id).attr('data-status');
    $.ajax({
        type: 'post', // 提交方式 get/post
        url: "<?php echo U('SysUser/changeStatus');?>", // 需要提交的 url
        data: {
            'id': id,
            'status': dataStatus
        },
        success: function (data) {
            //alert(JSON.stringify(data));
            if (data.status == '0') {
                if (dataStatus == '0') {
                    $("#status_" + id).attr('class', 'label radius');
                    $("#status_" + id).attr('data-status', '1');
                    $("#status_" + id).html('已禁用');
                } else {
                    $("#status_" + id).attr('class', 'label label-success radius');
                    $("#status_" + id).attr('data-status', '0');
                    $("#status_" + id).html('已启用');
                }
            }
        }
    });
}
    /*用户-添加*/
    function admin_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    /*用户-编辑*/
    function admin_edit(title, url, id, w, h) {
        var str = url;
        str = url + '?id=' + id;
        layer_show(title, str, w, h);
    }
    /*密码-修改*/
    function change_password(obj, id) {
        layer.confirm('确认要初始化口令吗？', function (index) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('SysUser/change');?>", // 需要提交的 url
                data: {
                    'id': id
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                    // alert(JSON.stringify(data));
                    layer.msg('口令已初始化!', {icon: 6, time: 1000});
                }
            });
        });
    }
    /*用户-删除*/
    function admin_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('SysUser/del');?>", // 需要提交的 url
                data: {
                    'id': id
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }

    function datadel() {
        var primaryIDs = document.getElementsByName("id");
        var ids = "";
        for (var i = 0; i < primaryIDs.length; i++) {
            if (primaryIDs[i].type == "checkbox" && primaryIDs[i].checked == true) {
                ids += primaryIDs[i].value + ",";
            }
        }
        if (ids == "") {
            alert("请选择要删除的信息!");
            return;
        }
        else {
            layer.confirm('确认要删除吗？', function (index) {
                $.ajax({
                    type: 'post', // 提交方式 get/post
                    url: "<?php echo U('SysUser/delMore');?>", // 需要提交的 url
                    data: {
                        'idstr': ids
                    },
                    success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                        window.location.href = "/index.php/Home/SysUser/index";
                    }
                });
            });
        }

    }
</script>
</body>
</html>