<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <LINK rel="Bookmark" href="/favicon.ico" >
    <LINK rel="Shortcut Icon" href="/favicon.ico" />
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

    <link href="/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
    <form class="form form-horizontal" id="form-member-add" enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-2"><span class="c-red">*</span>姓名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" id="name" value=""
                       name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-2"><span class="c-red">*</span>图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="file" class="input-text" name="img">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">科室：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width:350px;">
                <select class="select" name="ks" size="1">
                    <?php if(is_array($kslist)): foreach($kslist as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                </select>
                </span>
            </div>
        </div>      
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否置顶：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="sfzd" type="radio" value="1" checked="checked">
                    <label for="sfzd-1">否</label>
                </div>
                <div class="radio-box">
                    <input name="sfzd" type="radio" value="2">
                    <label for="sfzd-2">是</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">专家介绍：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor" type="text/plain" style="width:100%;height:400px;" name="content"></script>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                <!--<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>-->
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

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
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });
    
    $("#form-member-add").validate({
        rules:{
            name:{
                required:true,
            },
            img:{
                required:true,
            }
        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            $('#form-member-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: "<?php echo U('Docter/add_do');?>", // 需要提交的 url
                data: {
                },
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                    // 此处可对 data 作相关处理
                    //alert(JSON.stringify(data));
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.$('.btn-refresh').click();
                    parent.location.reload();
                    parent.layer.close(index);
                }

            });
        }
    });
    var ue = UE.getEditor('editor');
});
</script>
</body>
</html>