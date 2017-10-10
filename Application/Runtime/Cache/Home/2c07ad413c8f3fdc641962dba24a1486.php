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
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <title>服务分类</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
        class="c-gray en">&gt;</span> 服务分类 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
        class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><!-- <?php if($funADD): endif; ?> --><a href="javascript:;" onclick="member_add('添加','<?php echo U('fwfl/add');?>','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span>
        <span class="r">共有数据：<strong><?php echo ($datacount); ?></strong> 条</span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th >名称</th>
            <th >状态</th>
            <th width="160">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id"></td>
                <td><?php echo ($vo["mc"]); ?></td>
                <td class="td-status">
                    <?php if($vo["status"] == 2): ?><span class="label label-success radius" onclick="changeStatus(<?php echo ($vo["id"]); ?>)"
                              id="status_<?php echo ($vo["id"]); ?>" data-status="<?php echo ($vo["status"]); ?>">已启用</span>
                        <?php else: ?>
                        <span class="label radius" onclick="changeStatus(<?php echo ($vo["id"]); ?>)" id="status_<?php echo ($vo["id"]); ?>"
                              data-status="<?php echo ($vo["status"]); ?>">已禁用</span><?php endif; ?>
                </td>
                
                <td class="td-manage">
                    
                    <a title="编辑" href="javascript:;"
                       onclick="member_edit('编辑','<?php echo U('fwfl/edit');?>',<?php echo ($vo["id"]); ?>,'','510')"
                       class="ml-5" style="text-decoration:none">编辑</a>
                
                    <a title="删除" href="javascript:;" onclick="member_del(this,<?php echo ($vo["id"]); ?>)" class="ml-5"
                       style="text-decoration:none">删除</a>
                    
                </td>

            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>

    </table>
    <div id="page" class="Pagination">
        <?php echo ($page); ?>
    </div>
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
        url: "<?php echo U('Fwfl/changeStatus');?>", // 需要提交的 url
        data: {
            'id': id,
            'status': dataStatus
        },
        success: function (data) {
            //alert(JSON.stringify(data));
            if (data.status == '0') {
                if (dataStatus == '2') {
                    $("#status_" + id).attr('class', 'label radius');
                    $("#status_" + id).attr('data-status', '1');
                    $("#status_" + id).html('已禁用');
                } else {
                    $("#status_" + id).attr('class', 'label label-success radius');
                    $("#status_" + id).attr('data-status', '2');
                    $("#status_" + id).html('已启用');
                }
            }
        }
    });
}
    /*用户-添加*/
    /*用户-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    
    /*用户-编辑*/
    function member_edit(title, url, id, w, h) {
        var str = url;
        str = url + '?id=' + id;
        layer_show(title, str, w, h);
    }
    
    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('fwfl/del');?>", // 需要提交的 url
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
    /*管理员-停用*/
    function admin_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                    url: "<?php echo U('Fwfl/stop');?>", // 需要提交的 url
                data: {
                    'id': id,
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                    // <i class="Hui-iconfont">&#xe631;</i>
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"></a>');
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
                url: "<?php echo U('Fwfl/start');?>", // 需要提交的 url
                data: {
                    'id': id
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
//                    alert(data.info);
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6, time: 1000});
                }
            });
        });
    }
</script>
</body>
</html>