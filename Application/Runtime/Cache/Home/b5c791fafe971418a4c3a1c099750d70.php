<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <LINK rel="Bookmark" href="/favicon.ico">
    <LINK rel="Shortcut Icon" href="/favicon.ico"/>
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
    <title>疾病分类列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
        class="c-gray en">&gt;</span> 疾病分类列表 <a class="btn btn-success radius r"
                                                style="line-height:1.6em;margin-top:3px"
                                                href="javascript:location.replace(location.href);" title="刷新"><i
        class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray ">
        <span class="l">
        <a href="javascript:;"
           onclick="admin_add('添加','<?php echo U('Disease/add');?>','800','500')"
           class="btn btn-primary radius"><i
                class="Hui-iconfont">&#xe600;</i> 添加 </a>
            <!--<?php if($funADD): ?>-->
            <!--<?php endif; ?>-->
        </span>
        <span
                class="r">共有数据：<strong><?php echo ($datacount); ?></strong> 条</span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="9">疾病分类列表</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="40">疾病分类</th>
            <th width="40">创建日期</th>
            <th width="50">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="1" name=""></td>
                <td><?php echo ($vo["title"]); ?></td>
                <td><?php echo ($vo["create_time"]); ?></td>
                <td class="td-manage">
                    <!--<?php if($funSTATUS): ?>-->
                    <!--<?php if($vo["status"] == 0): ?>-->
                    <!--<a style="text-decoration:none" onClick="admin_stop(this,<?php echo ($vo["id"]); ?>)" href="javascript:;"-->
                    <!--title="禁用">禁用-->
                    <!--&lt;!&ndash;<i class="Hui-iconfont">&#xe615;</i>&ndash;&gt;-->
                    <!--</a>-->
                    <!--<?php else: ?>-->
                    <!--<a style="text-decoration:none" onClick="admin_start(this,<?php echo ($vo["id"]); ?>)" href="javascript:;"-->
                    <!--title="启用">启用-->
                    <!--&lt;!&ndash;<i class="Hui-iconfont">&#xe631;</i>&ndash;&gt;-->
                    <!--</a>-->
                    <!--<?php endif; ?>-->
                    <!--<?php endif; ?>-->
                        <a title="编辑"
                           href="javascript:;"
                           onclick="admin_edit('编辑','<?php echo U('Disease/edit');?>',<?php echo ($vo["id"]); ?>,'800','500')"
                           class="ml-5"
                           style="text-decoration:none">编辑
                            <!--<i-->
                            <!--class="Hui-iconfont">&#xe6df;</i>-->
                        </a>
                        <a title="删除" href="javascript:;"
                           onclick="admin_del(this,<?php echo ($vo["id"]); ?>)" class="ml-5"
                           style="text-decoration:none">
                            删除
                            <!--<i-->
                            <!--class="Hui-iconfont">-->
                            <!--&#xe6e2;</i>-->
                        </a>
                    <!--<?php if($funEDIT): ?>-->
                    <!--<?php endif; ?>-->
                    <!--<?php if($funDEL): ?>-->
                    <!--<?php endif; ?>-->
                    <!--<?php if($funFUN): ?>-->
                    <!--<a title="功能"-->
                    <!--href="javascript:;"-->
                    <!--onclick="admin_edit('功能','<?php echo U('SysModule/fun');?>',<?php echo ($vo["id"]); ?>,'800','500')"-->
                    <!--class="ml-5" style="text-decoration:none">功能</a>-->
                    <!--<?php endif; ?>-->
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>
    <div id="page" class="Pagination">
        <?php echo ($page); ?>
    </div>
</div>
<!--<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script>-->
<!--<script type="text/javascript" src="/Public/lib/laypage/1.2/laypage.js"></script>-->
<!--<script type="text/javascript" src="/Public/lib/My97DatePicker/WdatePicker.js"></script>-->
<!--<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>-->
<!--<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>-->

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
    /*
     参数解释：
     title	标题
     url		请求的url
     id		需要操作的数据id
     w		弹出层宽度（缺省调默认值）
     h		弹出层高度（缺省调默认值）
     */
    /*管理员-增加*/
    function admin_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*管理员-删除*/
    function admin_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('Disease/del');?>", // 需要提交的 url
                data: {
                    'id': id
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
//            $(obj).parents("tr").remove();
//            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }
    /*管理员-编辑*/
    function admin_edit(title, url, id, w, h) {
        var str = url;
        str = url + '?id=' + id;
        layer_show(title, str, w, h);
    }
    /*管理员-停用*/
    function admin_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('Hedirector/stop');?>", // 需要提交的 url
                data: {
                    'id': id,
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">禁用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', {icon: 5, time: 1000});
                }
            });

        });
    }

    /*管理员-启用*/
    function admin_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('Hedirector/start');?>", // 需要提交的 url
                data: {
                    'id': id
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
//                    alert(data.info);
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">正常</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6, time: 1000});
                }
            });
        });
    }
</script>
</body>
</html>