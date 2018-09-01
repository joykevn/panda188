//全局变量
var G_chepaihao='';
var G_toubaoren='';
var G_beibaoren='';
var G_baodanhao='';
var G_baodanhao4='';
var G_toubaodanhao='';
var G_toubaodanhao4='';
var G_jifenquanyima='';
var G_jisuanzhekou='';
var G_shangyexianbaofei='';
var G_feilv='';
var G_dailigongsi='';

//初始化
$(function () {
    $('#show2').hide();//隐藏信息区
    $('#show3').hide();//隐藏结束区
    $('#btn-fanhuishouye').hide();
    $('#otherbank').hide();//其他银行初始隐藏
    $('#h1-jieshu').text('');
});

//提交车牌号
$(function () {
    $("#btn-chaxun").on('click',function () {
        // $('#pay-span1').append($("<span style='color: #999999'>·</span>"));
        $('#btn-fanhuishouye').hide();
        $('#h1-jieshu').text('');
        var td1=$('#chepaihao-table td');//显示车牌号
        var $chepaihao_input=$('#input-chepaihao');
        var $toubaodanhao4_input=$('#toubaodanhao4');
        if($chepaihao_input.val()==""){
            alert('请输入车牌号！');
            $chepaihao_input.focus();
            return false;

        }else{
            if($toubaodanhao4_input.val()==""){
                alert('请输入保单号后4位！');
                $toubaodanhao4_input.focus();
                return false;
            }
            td1.attr('style','border:#ff0000 solid 2px');
            var str1=$('#select-sheng').val() + $('#select-qu').val();
            var str2=$('#input-chepaihao').val();
            $('#span1').text(str1);
            $('#span2').text('·');
            $('#span3').text(str2);
            //获取json
            var $card_json=str1+'-'+str2;//生成车牌号


            $.getJSON('return_chushidata',{chepaihao:$card_json,toubaodanhao4:$toubaodanhao4_input.val()},function(json){
                //alert("dfs");return false;
                if(json){//json不为空
                    G_chepaihao=$card_json;
                    G_toubaoren=json[0].toubaoren;
                    G_beibaoren=json[0].beibaoren;
                    G_baodanhao=json[0].baodanhao;
                    G_baodanhao4=json[0].baodanhao4;
                    G_toubaodanhao=json[0].toubaodanhao;
                    G_toubaodanhao4=json[0].toubaodanhao4;
                    G_jifenquanyima=json[0].jifenquanyima;
                    G_jisuanzhekou=json[0].jisuanzhekou;
                    G_shangyexianbaofei=json[0].shangxianbaofei;
                    G_feilv=json[0].feilv;
                    G_dailigongsi=json[0].dailibianhao;

                    var con='';
                    $.each(json,function (key,val) {
                        con+='<tr><td>'+val.toubaoren+'</td><td>'
                            +val.beibaoren+'</td><td>'
                            +val.jifenquanyima+'</td><td>'
                            +val.baodanleixing+'</td></tr>';

                    });
                    $('#tab-baodanxinxi tbody').html(con);
                    //$('#show1').hide();
                    $('#show2').show();

                }else{//json为空
                    G_chepaihao='';
                    G_toubaoren='';
                    G_beibaoren='';
                    G_baodanhao='';
                    G_baodanhao4='';
                    G_toubaodanhao='';
                    G_toubaodanhao4='';
                    G_jifenquanyima='';
                    G_jisuanzhekou='';
                    G_shangyexianbaofei='';
                    G_feilv='';
                    G_dailigongsi='';

                    $('#span1').text('');
                    $('#span2').text('');
                    $('#span3').text('无投保信息！');
                    $('#show2').hide();
                }
            });
        }
    });
});



//选中其他银行后，添加输入框
$(function () {
    $('#select-yinhang').bind('change',function () {
        var bankname=$(this).val();
        if(bankname=="其他"){
            $('#otherbank').show();
        }else{
            $('#otherbank').hide();
        }
    });
});

//选择银行卡照片
// function selectImage(file) {
//     if (!file.files || !file.files[0]) {
//         return;
//     }
//     var reader = new FileReader();
//     reader.onload = function (evt) {
//         // 将图片显示在id为imagedisplay的img
//         document.getElementById('imagedisplay').src = evt.target.result;
//         // 将图片的base64数据存在id为imagedata的一个文本框
//         document.getElementById('imagedata').value = evt.target.result.toString();
//     }
//     reader.readAsDataURL(file.files[0]);
// }
//提交图片，然后不跳转，从而处理json，注意引入jquery.form.js文件
function post_img() {
    // jquery 表单提交
    alert("不想让图片跳转");
    $("#img_form").ajaxSubmit(function(message) {
        // 对于表单提交成功后处理，message为返回内容
        console.log(message);
    });
    console.log("dkdkkdk");
    return false; // 必须返回false，否则表单会自己再做一次提交操作，并且页面跳转
}
//预览银行卡
function setImagePreview()
{
    var docObj=document.getElementById("file");
    var imgObjPreview=document.getElementById("preview");
    if(docObj.files &&    docObj.files[0])
    {
        //火狐下，直接设img属性
        imgObjPreview.style.display = 'block';
        imgObjPreview.style.width = '300px';
        imgObjPreview.style.height = '300px';
        //imgObjPreview.src = docObj.files[0].getAsDataURL();
        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
        imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
    }
    else
    {
        //IE下，使用滤镜
        docObj.select();
        var imgSrc = document.selection.createRange().text;
        var localImagId = document.getElementById("localImag");
        //必须设置初始大小
        localImagId.style.width = "300px";
        localImagId.style.height = "300px";
        //图片异常的捕捉，防止用户修改后缀来伪造图片
        try
        {
            localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
        }
        catch(e)
        {
            alert("您上传的图片格式不正确，请重新选择!");
            return false;
        }
        imgObjPreview.style.display = 'none';
        document.selection.empty();
    }
    return true;
}

