<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"/usr/local/var/www/yg/application/admin/view/template/verinfo.html";i:1562124096;s:61:"/usr/local/var/www/yg/application/admin/view/public/head.html";i:1522628860;s:61:"/usr/local/var/www/yg/application/admin/view/public/foot.html";i:1526021730;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?> - 苹果CMS</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/admin_style.css">
    <script type="text/javascript" src="/static/js/jquery.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION='v10';
    </script>
</head>
<body>
<div class="page-container">
    <form class="layui-form layui-form-pane" method="post" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">版本号：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $ver; ?>" placeholder="标题" id="ver" name="ver" <?php if($ver != ''): ?>readonly="readonly"<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">类型：</label>
            <div class="layui-input-block">
              <select name="type">
                  <option value="0">选择推荐</option>
                  <option value="1" <?php if($param['type'] == '1'): ?>selected <?php endif; ?>>苹果</option>
                  <option value="2" <?php if($param['type'] == '2'): ?>selected <?php endif; ?>>安卓</option>
              </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">下载URL：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $down_url; ?>" placeholder="URL" id="down_url" name="down_url" <?php if($down_url != ''): ?>readonly="readonly"<?php endif; ?>>
            </div>
        </div>

        <!-- <div class="layui-form-item">
            <label class="layui-form-label">广告图片：</label>
            <div class="layui-input-inline w500 upload">
                <input type="text" class="layui-input upload-input" style="max-width:100%;" value="<?php echo $info['ad_img']; ?>" placeholder="" id="ad_img" name="ad_img">
            </div>
            <div class="layui-input-inline ">
                <button type="button" class="layui-btn layui-upload" lay-data="{data:{thumb:1,thumb_class:'upload-thumb'}}" id="upload1">上传图片</button>
            </div>
        </div> -->

        <div class="layui-form-item">
                <label class="layui-form-label">升级内容：</label>
            <div class="layui-input-block">
                <textarea name="content" cols="" rows="3" class="layui-textarea"  placeholder="字" style="height:40px;"><?php echo $content; ?></textarea>
            </div>
        </div>

        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit" data-child="true">保 存</button>
                <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">

    layui.use(['form','upload', 'layer'], function () {
        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery
                , upload = layui.upload;;

        // 验证
        form.verify({
            art_name: function (value) {
                if (value == "") {
                    return "请输入专题名称";
                }
            }
        });

        $(document).on("click", ".extend", function(){
            $id = $(this).attr('data-id');
            if($id == 'art_class'||$id == 'art_keywords'){
                $val = $("input[id='"+$id+"']").val();
                if($val!=''){
                    $val = $val+',';
                }
                if($val.indexOf($(this).text())>-1){
                    return;
                }
                $("input[id='"+$id+"']").val($val+$(this).text());
            }else{
                $("input[id='"+$id+"']").val($(this).text());
            }
        });


        form.on('select(type_id)', function(data){
            getExtend(data.value);
        });

        upload.render({
            elem: '.layui-upload'
            ,url: "<?php echo url('upload/upload'); ?>?flag=art"
            ,method: 'post'
            ,before: function(input) {
                layer.msg('文件上传中...', {time:3000000});
            },done: function(res, index, upload) {
                var obj = this.item;
                if (res.code == 0) {
                    layer.msg(res.msg);
                    return false;
                }
                layer.closeAll();
                var input = $(obj).parent().parent().find('.upload-input');
                if ($(obj).attr('lay-type') == 'image') {
                    input.siblings('img').attr('src', res.data.file).show();
                }
                input.val(res.data.file);

                if(res.data.thumb_class !=''){
                    $('.'+ res.data.thumb_class).val(res.data.thumb[0].file);
                }
            }
        });

        $('.upload-input').hover(function (e){
            var e = window.event || e;
            var imgsrc = $(this).val();
            if(imgsrc.trim()==""){ return; }
            var left = e.clientX+document.body.scrollLeft+20;
            var top = e.clientY+document.body.scrollTop+20;
            $(".showpic").css({left:left,top:top,display:""});
            if(imgsrc.indexOf('://')<0){ imgsrc = ROOT_PATH + '/' + imgsrc;	} else{ imgsrc = imgsrc.replace('mac:','http:'); }
            $(".showpic_img").attr("src", imgsrc);
        },function (e){
            $(".showpic").css("display","none");
        });


        $("#btn_rnd").click(function(){
            $("#art_hits").val( rndNum(5000,9999) );
            $("#art_hits_month").val( rndNum(1000,4999) );
            $("#art_hits_week").val( rndNum(300,999) );
            $("#art_hits_day").val( rndNum(1,299) );
            $("#art_up").val( rndNum(1,999) );
            $("#art_down").val( rndNum(1,999) );
            $("#art_score").val( rndNum(10) );
            $("#art_score_all").val( rndNum(1000) );
            $("#art_score_num").val( rndNum(100) );
        });



        $('.contents').on('click','.j-editor-clear',function(){
            var datai = $(this).parent().parent().attr('data-i');
            editor_setContent(ueArray[datai],'');
        });
        $('.contents').on('click','.j-editor-remove',function(){
            var datai = $(this).parent().parent().attr('data-i');
            $(this).parent().parent().remove();
            delete ueArray[datai];
        });
        $('.contents').on('click','.j-editor-up',function(){
            var current = $(this).parent().parent();
            var current_index = current.index();
            var current_i = current.attr('data-i');
            var prev = current.prev();
            var prev_i = prev.attr('data-i');
            if(current_index>0){
                var current_txt = editor_getContent(ueArray[current_i]);
                var prev_txt = editor_getContent(ueArray[prev_i]);
                editor_setContent(ueArray[current_i],prev_txt);
                editor_setContent(ueArray[prev_i],current_txt);
            }
        });
        $('.contents').on('click','.j-editor-down',function(){
            var current = $(this).parent().parent();
            var current_index = current.index();
            var current_i = current.attr('data-i');
            var next = current.next();
            var next_i = next.attr('data-i');

            if(next.length>0){
                var current_txt = editor_getContent(ueArray[current_i]);
                var prev_txt = editor_getContent(ueArray[next_i]);

                editor_setContent(ueArray[current_i],prev_txt);
                editor_setContent(ueArray[next_i],current_txt);
            }
        });

        $('.j-editor-add').on('click',function(){
            content_arr_len++;
            var tpl='<div class="layui-form-item" data-i="'+content_arr_len+'"><label class="layui-form-label">分页内容'+(content_arr_len)+'：</label><div class="layui-input-inline w200"><input type="text" name="art_title[]" class="layui-input" placeholder="页标题"></div><div class="layui-input-inline w200"><input type="text" name="art_note[]" class="layui-input" placeholder="页备注"></div><div class="layui-input-inline w200 p10"><a href="javascript:void(0)" class="j-editor-clear">清空</a>&nbsp;<a href="javascript:void(0)" class="j-editor-remove">删除</a>&nbsp;<a href="javascript:void(0)" class="j-editor-up">上移</a>&nbsp;<a href="javascript:void(0)" class="j-editor-down">下移</a>&nbsp;<br></div><div class="p10 m20"></div><div class="layui-input-block"><textarea id="art_content'+(content_arr_len)+'" name="art_content[]" type="text/plain" style="width:99%;height:250px"></textarea></div></div>';
            $(".contents").append(tpl);
            ueArray[content_arr_len] = editor_getEditor( 'art_content'+content_arr_len );

        });

        if(content_arr_len==0){
            $('.j-editor-add').click();
        }
    });

    function getExtend(id){
        $.post("<?php echo url('type/extend'); ?>", {id:id}, function(res) {

            if (res.code == 1) {
                $.each(res.data, function(key, value){
                    $('.art_'+key+"_label").html('');
                    if(value != ''){
                        $.each(value, function(key2, value2){
                            $(".art_"+key+"_label").append('<a class="layui-btn layui-btn-xs extend" href="javascript:;" data-id="art_'+key+'">'+value2+'</a>');
                        });
                    }
                });
            }
        });
    }

    <?php if($info['art_id'] > 0): ?>
    setTimeout(function () {
        getExtend('<?php echo $info['type_id']; ?>')
    },1000);
    <?php endif; ?>

</script>


</body>
</html>
