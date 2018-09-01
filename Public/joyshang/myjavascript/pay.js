/**
 * Created by Administrator on 2018/3/27.
 */
//全局变量
var G_chepaihao='';
var G_toubaoren='';
var G_beibaoren='';
var G_kehujuese='';
var G_baodanhao='';
var G_toubaodanhao='';
var G_baodanhao4='';
var G_yinghangmingcheng='';
var G_yinhangkahao='';

var G_shangyexianbaofei='';
var G_feilv='';
var G_jisuanjine='';
var G_dailigongsi='';
//初始化
$(function () {
    $('#pay-zhanshiqu').hide();
    $('#pay-btn-fanhuishouye').hide();
    $('#pay-otherbank').hide();
    $('#pay-h2-jieshu').text('');
});
//提交车牌号
$(function () {
    $("#pay-btn-chaxun").on('click',function () {
        // $('#pay-span1').append($("<span style='color: #999999'>·</span>"));
        $('#pay-btn-fanhuishouye').hide();
        $('#pay-h2-jieshu').text('');
        var td1=$('#pay-tab1 td');
        var chepaihao=$('#pay-input-chepaihao').val();
        var $baodanhao4=$('#pay-baodanhao4').val();
        if(chepaihao==""){
            alert('请输入车牌号！');

        }else{
            if($baodanhao4==""){
                alert('请输入保单号后4位！');
                return false;
            }
            td1.attr('style','border:#ff0000 solid 2px');
            var str1=$('#pay-select-sheng').val() + $('#pay-select-qu').val();
            var str2=$('#pay-input-chepaihao').val();
            $('#pay-span1').text(str1);
            $('#pay-span2').text('·');
            $('#pay-span3').text(str2);
            //获取json
            var $card_json=str1+'-'+str2;


            $.getJSON('getmyjson',{chepaihao:$card_json,baodanhao4:$baodanhao4},function(json){
                //alert("dfs");return false;
                if(json){//json不为空
                    G_chepaihao=$card_json;
                    G_toubaoren=json[0].toubaoren;
                    G_beibaoren=json[0].beibaoren;
                    G_baodanhao=json[0].baodanhao;
                    G_baodanhao4=json[0].baodanhao4;
                    G_toubaodanhao=json[0].toubaodanhao;
                    
                    G_shangyexianbaofei=json[0].shijibaofei;
                    G_feilv=json[0].chechuanshui;
                    G_jisuanjine=json[0].biaozhunbaofei;
                    G_dailigongsi=json[0].dailibianhao;
                    
                    var con='';
                    $.each(json,function (key,val) {
                        con+='<tr><td>'+val.toubaoren+'</td><td>'+val.beibaoren+'</td><td>'+val.baodanleixing+'</td></tr>';

                    });
                    $('#pay-tab-baodanxinxi tbody').html(con);
                    $('#pay-zhanshiqu').show();
                    //$('#pay-shuruqu').hide();

                }else{//json为空
                    G_chepaihao='';
                    G_toubaoren='';
                    G_beibaoren='';
                    G_baodanhao='';
                    G_toubaodanhao='';
                    G_baodanhao4='';
                    
                    G_shangyexianbaofei='';
                    G_feilv='';
                    G_jisuanjine='';
                    G_dailigongsi='';
                    
                    $('#pay-span1').text('');
                    $('#pay-span2').text('');
                    $('#pay-span3').text('无投保信息！');
                    $('#pay-zhanshiqu').hide();
                }
            });
        }
    });
});
//选中其他银行后，添加输入框
$(function () {
    $('#pay-select-yinhang').bind('change',function () {
        var bankname=$(this).val();
        if(bankname=="其他"){
            $('#pay-otherbank').show();
        }else{
            $('#pay-otherbank').hide();
        }
    });
});

//确认缴费成功
$(function () {
   $('#pay-btn-querentijiao').on('click',function () {
       //var $baodanhao4=$('#pay-input-baodanhao').val();
       //var $baodanhao4=$('#pay-input-baodanhao').val();
       var $kehujuese=$('input:radio:checked').val();
       var $yinhangmingcheng=$('#pay-select-yinhang').val();
       var $yinhangkahao=$('#pay-input-kahao').val();
       var $xiongmaodaima=$('#pay-input-xiongmao').val();
       //alert($xiongmaodaima);return false;
       // if($kehujuese==""){
       //     alert("kong");
       // }else{
       //     alert($kehujuese);
       // }
       // return false;

       if(typeof($kehujuese) == "undefined" || $yinhangmingcheng=="" || $yinhangkahao=="" || $xiongmaodaima==""){
           alert('请输入有效信息！');
       }else{//将收缴保费信息填入保费数据表
           if($yinhangmingcheng=="其他"){
               var $otherbankname=$('#pay-input-otherbank').val();
               if($otherbankname==""){
                   alert('请输入你的银行名称');
                   return false;
               }
               $yinhangmingcheng=$otherbankname;
           }
           var $myJson={
               "chepaihao":G_chepaihao,
               "toubaoren":G_toubaoren,
               "beibaoren":G_beibaoren,
               "kehujuese":$kehujuese,
               "baodanhao":G_baodanhao,
               "toubaodanhao":G_toubaodanhao,
               //"baodanhao4":$baodanhao4,
               "baodanhao4":G_baodanhao4,
               "yinhangmingcheng":$yinhangmingcheng,
               "yinhangkahao":$yinhangkahao,
               "peisongyuanbianma":$xiongmaodaima,
               
               "shangyexianbaofei":G_shangyexianbaofei,
	           "feilv":G_feilv,
	           "jisuanjine":G_jisuanjine,
	           "dailigongsi":G_dailigongsi
           };
           $.getJSON('putbaofei',$myJson,function(json){
               if(json) {
                   $('#pay-h2-jieshu').text("感谢您的派送，祝您生活愉快!");
                   $('#pay-btn-fanhuishouye').show();
                   $('#pay-zhanshiqu').hide();
                   $('#pay-shuruqu').hide();
               }else{
                   $('#pay-btn-fanhuishouye').hide();
                   $('#pay-h2-jieshu').text('');
               }
           });
       }
   });
});
//只能输入数据，精确到小数点后两位
//用法：<input type="text" onkeyup="clearNoNum(this)">
function clearNoNum(obj){
    obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符
    obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
    obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入两个小数
    if(obj.value.indexOf(".")< 0 && obj.value !=""){//以上已经过滤，此处控制的是如果没有小数点，首位不能为类似于 01、02的金额
        obj.value= parseFloat(obj.value);
    }
}

//验证车牌号匹配
// $(function() {
//     $('#pay-input-chepaihao').validator({
//         onValid: function(validity) {
//             $(validity.field).closest('.am-form-group').find('.am-alert').hide();
//         },
//
//         onInValid: function(validity) {
//             var $field = $(validity.field);
//             var $group = $field.closest('.am-form-group');
//             var $alert = $group.find('.am-alert');
//             // 使用自定义的提示信息 或 插件内置的提示信息
//             var msg = $field.data('validationMessage') || this.getValidationMessage(validity);
//
//             if (!$alert.length) {
//                 $alert = $('<div class="am-alert am-alert-danger">hehh</div>').hide().
//                 appendTo($group);
//             }
//
//             $alert.html(msg).show();
//         }
//     });
// });

// $(function () {
//     var res = '[\dA-Z]{5}';
//     $('#pay-input-chepaihao').onlyNumAlpha();
//     $('#pay-input-chepaihao').blur(function(){
//         if($('#pay-input-chepaihao').val().length!=5){
//             alert('请输入正确车牌号！');
//             $('#pay-input-chepaihao').focusin();
//         }
//     });
// });


