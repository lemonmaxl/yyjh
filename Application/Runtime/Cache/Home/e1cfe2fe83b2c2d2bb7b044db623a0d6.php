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

<title>编辑用户</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>登录账号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($data["username"]); ?>" placeholder="" id="username" name="username">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">真实姓名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($data["truename"]); ?>" placeholder="" id="truename" name="truename">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
			<div class="formControls col-xs-7 col-sm-8 skin-minimal">
				<div class="radio-box">
					<input name="sex" type="radio" value="0" class="mstaus" <?php if($data['sex'] == 0): ?>checked<?php endif; ?> >
					<label for="sex-1">男</label>
				</div>
				<div class="radio-box">
					<input name="sex" type="radio" value="1" class="mstaus" <?php if($data['sex'] == 1): ?>checked<?php endif; ?> >
					<label for="sex-2">女</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">固定电话：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($data["tel"]); ?>" placeholder="" id="tel" name="tel">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">手机：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($data["mobile"]); ?>" placeholder="" id="mobile" name="mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">QQ：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($data["qq"]); ?>" placeholder="" id="qq" name="qq">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">微信：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($data["weixin"]); ?>" placeholder="" id="weixin" name="weixin">
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
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			username:{
				required:true,
				minlength:6,
				maxlength:16
			},

		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$('#form-member-add').ajaxSubmit({
				type: 'post', // 提交方式 get/post
				url: "<?php echo U('SysUser/edit_do');?>", // 需要提交的 url
				data: {
					'username' : $('#username').val(),
					'truename' : $('#truename').val(),
					'mstaus' : $('.mstaus:checked').val(),
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