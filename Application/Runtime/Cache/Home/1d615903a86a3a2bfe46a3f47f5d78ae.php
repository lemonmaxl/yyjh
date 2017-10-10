<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
    <title>专家列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 基础数据 <span
        class="c-gray en">&gt;</span> 专家列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
        class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <!--<div class="text-c"> 日期范围：-->
    <!--<input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" style="width:120px;">-->
    <!-- - -->
    <!--<input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" style="width:120px;">-->
    <!--<input type="text" class="input-text" style="width:250px" placeholder="输入管" id="" name="">-->
    <!--<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索 </button>-->
    <!--</div>-->
    <div class="cl pd-5 bg-1 bk-gray "><span class="l"><!-- <?php if($funDEL): ?><a href="javascript:;" onclick="datadel()"
                                                               class="btn btn-danger radius"><i class="Hui-iconfont">
        &#xe6e2;</i> 删除</a><?php endif; ?> --> <a href="javascript:;" onclick="admin_add('添加','<?php echo U('Docter/add');?>','800','500')"
                               class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加 </a></span> <span
            class="r">共有数据：<strong><?php echo ($datacount); ?></strong> 条</span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="6">专家列表</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="100">姓名</th>
            <th width="100">科室</th>
            <th width="140">创建时间</th>
            <th width="100">是否置顶</th>
            <th width="50">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="1" name=""></td>
                <td><?php echo ($vo["name"]); ?></td>
                <td><?php echo ($vo["ks"]); ?></td>
                <td><?php echo ($vo["cjrq"]); ?></td>
                <td>
                    <?php if($vo["sfzd"] == 2): ?><span class="label label-success radius">置顶</span>
                    <?php elseif($vo["status"] == 1): ?>
                        <span class="label label-success radius">否</span><?php endif; ?>
                </td>
                <td class="td-manage">
                    
                    
                        <a title="编辑"
                           href="javascript:;"
                           onclick="admin_edit('编辑','<?php echo U('Docter/edit');?>',<?php echo ($vo["id"]); ?>,'800','500')"
                           class="ml-5"
                           style="text-decoration:none">编辑
                            <!--<i-->
                                <!--class="Hui-iconfont">&#xe6df;</i>-->
                        </a>
                    
                        <a title="删除" href="javascript:;"
                           onclick="admin_del(this,<?php echo ($vo["id"]); ?>)" class="ml-5"
                           style="text-decoration:none">删除
                            <!--<i-->
                                <!--class="Hui-iconfont">-->
                            <!--&#xe6e2;</i>-->
                        </a>
                   
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
    function admin_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    /*管理员-删除*/
    function admin_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('Docter/del');?>", // 需要提交的 url
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
        str = url + '?id='+id;
        layer_show(title, str, w, h);
    }

    /*管理员-停用*/
    function admin_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                    url: "<?php echo U('Docter/stop');?>", // 需要提交的 url
                data: {
                    'id': id,
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
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
                url: "<?php echo U('Docter/start');?>", // 需要提交的 url
                data: {
                    'id': id
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
//                    alert(data.info);
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"></a>');
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