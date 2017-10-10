<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
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
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title></title>
   
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>名称：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" id="title" value="<?php echo ($data["title"]); ?>"
                       name="title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">链接地址：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" id="serverurl" value="<?php echo ($data["serverurl"]); ?>"
                       name="serverurl">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">APPID：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" id="appid" value="<?php echo ($data["appid"]); ?>" readonly
                       name="appid">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">应用密钥：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" id="appsecret" value="<?php echo ($data["appsecret"]); ?>" readonly
                       name="appsecret">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">TOKEN：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" id="token" value="<?php echo ($data["token"]); ?>"
                       name="token">
            </div>
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo ($data["id"]); ?>">
        <!--<div class="row cl">-->
        <!--<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>-->
        <!--<div class="formControls col-xs-7 col-sm-8">-->
        <!--<input type="text" class="input-text" value="100"-->
        <!--id="sort" name="sort">-->
        <!--</div>-->
        <!--</div>-->

        <!--<div class="row cl">-->
        <!--<label class="form-label col-xs-4 col-sm-3">备注：</label>-->
        <!--<div class="formControls col-xs-7 col-sm-8">-->
        <!--<textarea name="description" id="description" cols="" rows="" class="textarea"-->
        <!--placeholder="说点什么...100个字符以内" dragonfly="true"-->
        <!--onKeyUp="textarealength(this,100)"></textarea>-->
        <!--<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>-->
        <!--</div>-->
        <!--</div>-->
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>

<script type="text/javascript" src="http://malsup.github.io/jquery.form.js"></script>
<script type="text/javascript" src="/Public/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<!--/_footer /作为公共模版分离出去-->

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
                title: {
                    required: true,
                    minlength: 2,
                    maxlength: 16
                },
                serverurl: {
                    required: true,
                },
                appid:{
                    required: true,
                },
                appsecret:{
                    required: true,
                },
                token: {
                    required: true,
                },
            },
            onkeyup: false,
            focusCleanup: true,
//            success: "valid",
            submitHandler: function (form) {
                $('#form-admin-add').ajaxSubmit({
                    type: 'post', // 提交方式 get/post
                    url: "<?php echo U('Hospital/edit_do');?>", // 需要提交的 url
                    data: {
                    },
                    success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                        // 此处可对 data 作相关处理
//                        alert(JSON.stringify(data));
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.$('.btn-refresh').click();
                        parent.location.reload();
                        parent.layer.close(index);
                    },
                    error: function(data){
                        alert(JSON.stringify(data));
                    }

                });
            }
        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>