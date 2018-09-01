/**
 * Created by Administrator on 2018/3/25.
 */
//初始加载
$(function() {
    $('#baodanxianshi').hide();
});
//输入姓名查询
$(function () {
   $('#button-chaxun').on('click',function () {
       var str1=$('#doc-vld-chepaihao').val();
       var str2=$('#doc-vld-toubaoname').val();
       //alert(str1);

        if(str1=="" && str2==""){
            alert('请输入有效内容！');
        }else{
            // $('#baodanchaxun').fadeOut(500);
            // $('#baodanxianshi').fadeIn(500);
            $('#baodanchaxun').hide();
            $('#baodanxianshi').show();
            $('#p-chepaihao').text(str1);
            $('#p-toubaoren').text(str2);
            $('#p-baofei').text(2018);
        }
       //alert($('#doc-vld-chepaihao').value());
   });
});
//缴费
$(function () {
        $('#button-jiaofei').on('click',function () {
            var jine=$('#doc-vld-baofeijin').val();
            if(jine==""){
                alert('请输入保费金额');
            }else {

                var str3 = '你输入的保费金额为:' + jine + '元。';
                $('#shoufeijine').text(str3);
                $('#shoufei').text("感谢您的派送，祝您生活愉快!");
                //alert(str3);
            }
        });


});
//返回
$(function () {
    $('#button-back').on('click',function () {
        $('#baodanchaxun').show();
        $('#baodanxianshi').hide();
    })
});
//测试
$(function(){
    //按钮单击时执行
    $("#testAjax1").click(function(){

        //Ajax调用处理
        var html = $.ajax({
            type: "POST",
            url: "test.php",
            data: "name=garfield&age=18",
            async: false

        }).responseText;
        $("#myDiv").html('<h2>'+html+'</h2>');
    });
});

$(function(){
    $('#testAjax').click(function(){
        //alert('__PUBLIC__');return false;
        var $title=$('#input-title').val();
        var $message=$('#input-message').val();
        $mess=$('#myDiv');
        $.getJSON('add',{title:$title,message:$message},function(json){
            alert("dfs");return false;
            if(json.status==1){
                $mess.slideDown(3000,function(){
                    $mess.css('display','block');
                }).html('标题为'+json.data.title+'信息为'+json.data.message);
            }else{
                $mess.slideDown(3000,function(){
                    $mess.css('display','block');
                }).html('信息添加失败，请检查');
            }
        });
    });
});
