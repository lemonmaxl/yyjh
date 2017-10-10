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
    <script type="text/javascript" src="http://lib.h-ui.net/html5.js"></script>
    <script type="text/javascript" src="http://lib.h-ui.net/respond.min.js"></script>
    <script type="text/javascript" src="http://lib.h-ui.net/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css" />
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
    <script type="text/javascript" src="/Public/lib/My97DatePicker/WdatePicker.js"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title>添加</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>
<form class="form form-horizontal" id="form-admin-add">
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l"></span>
        <span class="r">共有数据：<strong><?php echo ($datacount); ?></strong> 条</span>
    </div>
    <input type="hidden" name="id" id="id" value="<?php echo ($id); ?>">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox"></th>
            <th >分类</th>
            <th >服务项目</th>
            <th >收费标准</th>
            <th >签约收费</th>
            <th width="100">数量</th>
            <th >承接人</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="xmid[]" <?php if($vo['mc'] == '公共卫生'): ?>checked<?php endif; ?> ></td>
                <td><?php echo ($vo["mc"]); ?></td>
                <td><?php echo ($vo["xm"]); ?></td>
                <td><?php echo ($vo["sfbz"]); ?></td>
                <td><?php echo ($vo["qysf"]); ?></td>
                <td><div  class="buy-num-bar buy-num clearfix">
                        <a class="btn-dec" href="javascript:;">[<i class="Hui-iconfont" style="color: #2929D6;">&#xe6a1;</i>]</a>
                        <input  name="num_<?php echo ($vo["id"]); ?>" id="num_<?php echo ($vo["id"]); ?>" value="1" size="4" maxlength='5' style="text-align:center;">
                        <a class="btn-add" href="javascript:;">[<i class="Hui-iconfont" style="color: #2929D6;">&#xe600;</i>]</a>
                    </div>
                </td>
                <td><?php echo ($vo["cjr"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>

    </table>

    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        </div>
    </div>
</div>
</form>

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

<script type="text/javascript">
    $(function () {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-add").validate({
            rules: {
                
            },
            onkeyup: false,
            focusCleanup: true,
//            success: "valid",
            submitHandler: function (form) {
                $('#form-admin-add').ajaxSubmit({
                    type: 'post', // 提交方式 get/post
                    url: "<?php echo U('Qylxset/object_add_do');?>", // 需要提交的 url
                    data: {
                        
                    },
                    success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                        // 此处可对 data 作相关处理
                        //alert(JSON.stringify(data));
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.location.reload();
                        parent.layer.close(index);
                    }

                });
            }
        });

        $(".btn-dec").on("click",function(){
            var parent = $(this).parent().parent();
            var inpNum = parent.find("input");
            var num = parent.find("input").val();
            var tr = parent.parent();
            if(num>1) num--;
            else num=1;
            parent.find("input").val(num);
            

        });
        // 增加
        $(".btn-add").on("click",function(){
            var parent = $(this).parent().parent();
            var inpNum = parent.find("input");
            var num = parent.find("input").val();
            var tr = parent.parent();
            num++;
            parent.find("input").val(num);
            
        });
        //  直接输入
        $(".buy-num-bar input").on("change",function(){
            var num = parseInt($(this).val());
            if(num < 1 ){
                alert("数量最少为1");
                $(this).val(1);
            }
        });
    });

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>