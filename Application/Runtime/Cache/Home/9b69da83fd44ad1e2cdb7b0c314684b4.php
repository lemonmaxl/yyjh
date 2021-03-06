<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Public/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统功能 <span
        class="c-gray en">&gt;</span> 系统功能列表 <a class="btn btn-success radius r"
                                                style="line-height:1.6em;margin-top:3px"
                                                href="javascript:location.replace(location.href);" title="刷新"><i
        class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l">
        <!--<a href="javascript:;" onclick="datadel()"-->
        <!--class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>-->
        <a href="javascript:;" onclick="add('添加','add.html','800','500')"
           class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> <span
            class="r">共有数据：<strong>54</strong> 条</span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="9">员工列表</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="150">名称</th>
            <th width="150">标识</th>
            <th width="40">排序</th>
            <th>描述</th>
            <th width="100">是否已启用</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="1" name=""></td>
                <td><?php echo ($vo["name"]); ?></td>
                <td><?php echo ($vo["flag"]); ?></td>
                <td><?php echo ($vo["msort"]); ?></td>
                <td><?php echo ($vo["description"]); ?></td>
                <td class="td-status">
                    <?php if($vo["mstatus"] == 0): ?><span class="label label-success radius" onclick="changeStatus(<?php echo ($vo["id"]); ?>)"
                              id="status_<?php echo ($vo["id"]); ?>" data-status="<?php echo ($vo["mstatus"]); ?>">已启用</span>
                        <?php else: ?>
                        <span class="label radius" onclick="changeStatus(<?php echo ($vo["id"]); ?>)" id="status_<?php echo ($vo["id"]); ?>"
                              data-status="<?php echo ($vo["mstatus"]); ?>">已禁用</span><?php endif; ?>
                </td>
                <td class="td-manage">
                    <a title="编辑"
                       href="javascript:;"
                       onclick="edit('编辑','<?php echo U('SysFun/edit');?>',<?php echo ($vo["id"]); ?>,'800','500')"
                       class="ml-5"
                       style="text-decoration:none">编辑</a>
                    <a title="删除" href="javascript:;"
                       onclick="del(this,<?php echo ($vo["id"]); ?>)" class="ml-5"
                       style="text-decoration:none">删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    function changeStatus(id) {
        var dataStatus = $("#status_" + id).attr('data-status');
        $.ajax({
            type: 'post', // 提交方式 get/post
            url: "<?php echo U('SysFun/changeStatus');?>", // 需要提交的 url
            data: {
                'id': id,
                'status': dataStatus
            },
            success: function (data) {
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
    /*
     参数解释：
     title	标题
     url		请求的url
     id		需要操作的数据id
     w		弹出层宽度（缺省调默认值）
     h		弹出层高度（缺省调默认值）
     */
    /*管理员-增加*/
    function add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*管理员-删除*/
    function del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('SysFun/del');?>", // 需要提交的 url
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

    /*管理员-编辑*/
    function edit(title, url, id, w, h) {
        var str = url;
        str = url + '?id=' + id;
        layer_show(title, str, w, h);
    }

</script>
</body>
<body>