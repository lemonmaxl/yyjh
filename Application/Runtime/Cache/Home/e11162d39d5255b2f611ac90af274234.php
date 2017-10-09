<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
<article class="page-container">
    <form class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>名称：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" id="name" value="<?php echo ($data["name"]); ?>"
                       name="name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">链接地址：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" id="linkurl" value="<?php echo ($data["linkurl"]); ?>"
                       name="linkurl">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">父级：</label>
            <div class="formControls col-xs-7 col-sm-8"> <span class="select-box" style="width:350px;">
			<select class="select" id="pid" size="1">
                <option value="0" <?php if($data['pid'] == 0): ?>selected<?php endif; ?> >项级模块</option>
                <?php if(is_array($selectlist)): $i = 0; $__LIST__ = $selectlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"   <?php if($data['pid'] == $vo['id']): ?>selected<?php endif; ?>>├<?php echo ($vo["delimiter"]); echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
			</span></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="<?php echo ($data["msort"]); ?>"
                       id="msort" name="msort">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-7 col-sm-8 skin-minimal">
                <div class="radio-box">
                    <input name="mstaus" type="radio" value="0" class="mstaus" <?php if($data['mstatus'] == 0): ?>checked<?php endif; ?> >
                    <label for="sex-1">启用</label>
                </div>
                <div class="radio-box">
                    <input name="mstaus" type="radio" value="1" class="mstaus" <?php if($data['mstatus'] == 1): ?>checked<?php endif; ?> >
                    <label for="sex-2">禁用</label>
                </div>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">备注：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <textarea name="description" id="description" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true"
                          onKeyUp="textarealength(this,100)"><?php echo ($data["description"]); ?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input type="hidden" class="hidden" value="<?php echo ($data["id"]); ?>" />
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/lib/laypage/1.2/laypage.js"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
    $(function () {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-add").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 16
                },
                msort: {
                    required: true,
                },
                mstaus: {
                    required: true,
                },
            },
            onkeyup: false,
            focusCleanup: true,
//            success: "valid",
            submitHandler: function (form) {
                $('#form-admin-add').ajaxSubmit({
                    type: 'post', // 提交方式 get/post
                    url: "<?php echo U('SysModule/edit_do');?>", // 需要提交的 url
                    data: {
                        'name' : $('#name').val(),
                        'linkurl': $('#linkurl').val(),
                        'pid': $('#pid').val(),
                        'msort' : $('#msort').val(),
                        'mstaus' : $('.mstaus:checked').val(),
                        'description' : $('#description').val(),
                        'id' : $('.hidden').val(),

                    },
                    success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                        // 此处可对 data 作相关处理
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.$('.btn-refresh').click();
                        parent.location.reload();
                        parent.layer.close(index);
                    }

                });
            }
        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>