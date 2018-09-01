/**
 * Created by Administrator on 2018/3/30.
 */
//全局变量
var j_chushishijian='';
//var j_querenshijian='';
var baodanhao4='';
var toubaodanhao4='';

//初始化
$(function () {
    $('#pay-zhanshiqu').hide();
    $('#pay-jijinfasongqu').hide();
    //$('#pay-h2-jieshu').text('');
});
//提交车牌号
$(function () {
    $("#pay-btn-chaxun").on('click',function () {
        // $('#pay-span1').append($("<span style='color: #999999'>·</span>"));
        //$('#pay-btn-fanhuishouye').hide();
        var td1=$('#pay-tab1 td');
        var chepaihao=$('#pay-input-chepaihao').val();
        if(chepaihao==""){
            alert('请输入车牌号！');
        }else{
            baodanhao4=$('#guestinfo-baodanhao4').val();
            toubaodanhao4=$('#guestinfo-toubaodanhao4').val();
            if(baodanhao4=="" && toubaodanhao4==""){//既无保单号，又无投保单号
                alert('投保单号或被投保单号至少输入一个！');
            }else{//车牌号、投保单号或被投保单号 输入合法

                td1.attr('style','border:#ff0000 solid 2px');
                var str1=$('#pay-select-sheng').val() + $('#pay-select-qu').val();
                var str2=$('#pay-input-chepaihao').val();
                $('#pay-span1').text(str1);
                $('#pay-span2').text('·');
                $('#pay-span3').text(str2);
                //获取json
                card_json=str1+'-'+str2;

                var $guestinfo={
                    "chepaihao":card_json,
                    "baodanhao4":baodanhao4,
                    "toubaodanhao4":toubaodanhao4
                };
                //alert($guestinfo.baodanhao4); return false;
                $.getJSON('getguestinfojson',$guestinfo,function(json){
                    //alert("dfs");return false;
                    if(json){//json不为空
                        var j_chepaihao=json[0].chepaihao;
                        var j_toubaoren=json[0].toubaoren;
                        var j_beibaoren=json[0].beibaoren;
                        var j_kehujuese=json[0].kehujuese;
                        var j_baodanhao=json[0].baodanhao;
                        var j_toubaodanhao=json[0].toubaodanhao;
                        var j_baodanhao4=json[0].baodanhao4;
                        var j_toubaodanhao4=json[0].toubaodanhao4;
                        var j_yinhangmingcheng=json[0].yinhangmingcheng;
                        var j_yinhangkahao=json[0].yinhangkahao;
                        j_chushishijian=json[0].chushishijian;
                        //j_querenshijian=json[0].querenshijian;

                        //验证投保单号 或 保单号 是否正确
                        if(baodanhao4){
                            if(j_baodanhao4!=baodanhao4){//保单号后四位不相等
                                alert("请输入正确的保单号后4位！");
                                return false;
                            }
                        }else{
                            if(j_toubaodanhao4!=toubaodanhao4){//保单号后四位不相等
                                alert("请输入正确的投保单号后4位！");
                                return false;
                            }
                        }
                        //验证客户角色
                        var $_xingming='';
                        if(j_kehujuese=="投保人"){
                            $_xingming=j_toubaoren;
                            $('#guestinfo-td-name').text('投保人');

                        }else{
                            $_xingming=j_beibaoren;
                            $('#guestinfo-td-name').text('被保人');
                        }

                        //var $_xingming=j_toubaoren.length ? j_toubaoren : j_beibaoren;
                        $('#guestinfo-td1').text($_xingming);//姓名
                        $('#guestinfo-td2').text(j_chepaihao);//车牌号
                        $('#guestinfo-td3').text(j_baodanhao4);//保单号
                        $('#guestinfo-td4').text(j_yinhangmingcheng);//银行名称
                        $('#guestinfo-td5').text(j_yinhangkahao);//银行卡号
                        $('#pay-zhanshiqu').show();
                        $('#pay-shuruqu').hide();


                    }else{//json为空
                        $('#pay-span1').text('');
                        $('#pay-span2').text('');
                        $('#pay-span3').text('无缴费信息！');
                        $('#pay-zhanshiqu').hide();
                    }
                });
            }
        }
    });
});

//客户验证信息后提交
$(function () {
    $('#guestinfo-btn-querentijiao').on('click',function () {
    //$('#pay-btn-test').on('click',function () {
        $('#pay-shuruqu').hide();
        $('#pay-zhanshiqu').hide();
        //alert("helo");

        var myDate1=new Date(Date.parse(j_chushishijian.replace(/-/g,"/")));
        var myDate2=new Date;


        var myDate=myDate1.getFullYear()+"-"+(myDate1.getMonth()+1)+"-"+myDate1.getDate();
        var myTime=myDate1.getHours()+":"+myDate1.getMinutes()+":"+myDate1.getSeconds();
        $('#guestinfo-tab1').html("<tr><td>"+myDate+"</td></tr><tr><td>"+myTime+"</td></tr>");
        var myDate2=new Date;
        myDate=myDate2.getFullYear()+"-"+(myDate2.getMonth()+1)+"-"+myDate2.getDate();
        myTime=myDate2.getHours()+":"+myDate2.getMinutes()+":"+myDate2.getSeconds();
        $('#guestinfo-tab2').html("<tr><td>"+myDate+"</td></tr><tr><td>"+myTime+"</td></tr>");
        myDate2 = myDate2.valueOf();
        myDate2=myDate2+6*60*60*1000;
        myDate2=new Date(myDate2);
        myDate=myDate2.getFullYear()+"年"+(myDate2.getMonth()+1)+"月"+(myDate2.getDate()+1);
        myTime="日10:"+myDate2.getMinutes()+":"+myDate2.getSeconds();
        $('#guestinfo-tab3').html("<tr><td>"+myDate+"</td></tr><tr><td>"+myTime+"</td></tr>");
        //$('#guestinfo-tab1').html("<tr><td>ff"+"</td></tr>");

        $('#pay-jijinfasongqu').show();
        //alert(j_chushishijian);
        //alert("hello");

        setTimeStr_1();
   });
});

function setTimeStr_1() {
    var Date1=new Date(j_chushishijian.replace(/-/g,"/"));
    var Date2=new Date(j_querenshijian.replace(/-/g,"/"));

    var curDate=new Date;
    var strYear=curDate.getFullYear();
    var strMonth=curDate.getMonth();
    var strDate=curDate.getDate();
    var strHour=curDate.getHours();
    var strMinute=curDate.getMinutes();
    var strSecond=curDate.getSeconds();

    var curH0=new Date(strYear,strMonth,strDate,0,0,0);
    var curH14=new Date(strYear,strMonth,strDate,14,0,0);
    var curH20=new Date(strYear,strMonth,strDate,20,0,0);
    var curD1H13=new Date(strYear,strMonth,strDate+1,13,0,0);
	var curDf1H20=new Date(strYear,strMonth,strDate-1,20,0,0);
    
    if(curDate>curH0){//当日
        if(getDate<curH14) {//14:00 之前的，当日20:00支付
            if(curDate<curH20){//已审核，支付中
                $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                $('#guestinfo-btn1').text("审核完毕");

                $('#guestinfo-tab2').html("<tr><td>预计"+timeStr(curH20)+"</td></tr><tr><td>完成支付。</td></tr>");
                $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                $('#guestinfo-btn2').text("支付中…");
                $('#guestinfo-btn2').addClass("am-btn-success");


            }else {//支付成功
                $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                $('#guestinfo-btn1').text("审核完毕");

                $('#guestinfo-tab2').html("<tr><td>已于"+timeStr(curH20)+"</td></tr><tr><td>完成支付。</td></tr>");
                $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                $('#guestinfo-btn2').text("已支付");
                $('#guestinfo-btn2').addClass("am-btn-success");

                $('#guestinfo-tab3').html("<tr><td>已于"+timeStr(curDate)+"</td></tr><tr><td>确认支付成功。</td></tr>");
                $('#guestinfo-i3').attr("class","am-icon-check-square-o am-icon-btn am-success");
                $('#guestinfo-btn3').text("支付完毕");
                $('#guestinfo-btn3').addClass("am-btn-success");
            }
        }else{//14:00 之后派送的，次日13:00支付
            if(curDate<curD1H13){//已审核，支付中
                $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                $('#guestinfo-btn1').text("审核完毕");

                $('#guestinfo-tab2').html("<tr><td>预计"+timeStr(curD1H13)+"</td></tr><tr><td>完成支付。</td></tr>");
                $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                $('#guestinfo-btn2').text("支付中");
                $('#guestinfo-btn2').addClass("am-btn-success");

            }else{//支付成功
                $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                $('#guestinfo-btn1').text("审核完毕");

                $('#guestinfo-tab2').html("<tr><td>已于"+timeStr(curD1H13)+"</td></tr><tr><td>完成支付。</td></tr>");
                $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                $('#guestinfo-btn2').text("已支付");
                $('#guestinfo-btn2').addClass("am-btn-success");

                $('#guestinfo-tab3').html("<tr><td>已于"+timeStr(curDate)+"</td></tr><tr><td>确认支付成功。</td></tr>");
                $('#guestinfo-i3').attr("class","am-icon-check-square-o am-icon-btn am-success");
                $('#guestinfo-btn3').text("支付完毕");
                $('#guestinfo-btn3').addClass("am-btn-success");
            }
        }
    }else{
		$('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
        $('#guestinfo-btn1').text("审核完毕");

        $('#guestinfo-tab2').html("<tr><td>已于"+timeStr(curDf1H20)+"</td></tr><tr><td>完成支付。</td></tr>");
        $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
        $('#guestinfo-btn2').text("已支付");
        $('#guestinfo-btn2').addClass("am-btn-success");

        $('#guestinfo-tab3').html("<tr><td>已于"+timeStr(curDate)+"</td></tr><tr><td>确认支付成功。</td></tr>");
        $('#guestinfo-i3').attr("class","am-icon-check-square-o am-icon-btn am-success");
        $('#guestinfo-btn3').text("支付完毕");
        $('#guestinfo-btn3').addClass("am-btn-success");
    }

}

function setTimeStr() {
       var getDate=new Date(j_chushishijian.replace(/-/g,"/"));
       var curDate=new Date;
       var strYear=curDate.getFullYear();
       var strMonth=curDate.getMonth();
       var strDate=curDate.getDate();
       var strHour=curDate.getHours();
       var strMinute=curDate.getMinutes();
       var strSecond=curDate.getSeconds();

       var curH0=new Date(strYear,strMonth,strDate,0,0,0);
       var curH14=new Date(strYear,strMonth,strDate,14,0,0);
       var curH17=new Date(strYear,strMonth,strDate,17,0,0);
       var curH20=new Date(strYear,strMonth,strDate,20,0,0);
       var curD1H10=new Date(strYear,strMonth,strDate+1,10,0,0);

       //var tempStr=

       if(getDate>curH0){//当日
           if(getDate<curH14){//14:00 之前的，当日17:00支付
                if(curDate<curH17){//已审核，支付中
                    $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                    $('#guestinfo-btn1').text("审核完毕");

                    $('#guestinfo-tab2').html("<tr><td>预计"+timeStr(curH17)+"</td></tr><tr><td>完成支付。</td></tr>");
                    $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                    $('#guestinfo-btn2').text("等待支付");
                    $('#guestinfo-btn2').addClass("am-btn-success");

                }else{//支付成功
                    $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                    $('#guestinfo-btn1').text("审核完毕");

                    $('#guestinfo-tab2').html("<tr><td>已于"+timeStr(curH17)+"</td></tr><tr><td>完成支付。</td></tr>");
                    $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                    $('#guestinfo-btn2').text("已支付");
                    $('#guestinfo-btn2').addClass("am-btn-success");

                    $('#guestinfo-tab3').html("<tr><td>已于"+timeStr(curDate)+"</td></tr><tr><td>完成支付。</td></tr>");
                    $('#guestinfo-i3').attr("class","am-icon-check-square-o am-icon-btn am-success");
                    $('#guestinfo-btn3').text("支付完毕");
                    $('#guestinfo-btn3').addClass("am-btn-success");
                }
           }else if(getDate<curH17){//14:00 ~17:00的，当日20:00支付
               if(curDate<curH20){//已审核，支付中
                   $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                   $('#guestinfo-btn1').text("审核完毕");

                   $('#guestinfo-tab2').html("<tr><td>预计"+timeStr(curH20)+"</td></tr><tr><td>完成支付。</td></tr>");
                   $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                   $('#guestinfo-btn2').text("支付中");
                   $('#guestinfo-btn2').addClass("am-btn-success");

               }else{//支付成功
                   $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                   $('#guestinfo-btn1').text("审核完毕");

                   $('#guestinfo-tab2').html("<tr><td>已于"+timeStr(curH20)+"</td></tr><tr><td>完成支付。</td></tr>");
                   $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                   $('#guestinfo-btn2').text("已支付");
                   $('#guestinfo-btn2').addClass("am-btn-success");

                   $('#guestinfo-tab3').html("<tr><td>已于"+timeStr(curDate)+"</td></tr><tr><td>完成支付。</td></tr>");
                   $('#guestinfo-i3').attr("class","am-icon-check-square-o am-icon-btn am-success");
                   $('#guestinfo-btn3').text("支付完毕");
                   $('#guestinfo-btn3').addClass("am-btn-success");
               }
           }else{//17:00之后的，第二日10:00支付成功
               if(curDate<curH20){//已审核，支付中
                   $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
                   $('#guestinfo-btn1').text("审核完毕");

                   $('#guestinfo-tab2').html("<tr><td>预计"+timeStr(curD1H10)+"</td></tr><tr><td>完成支付。</td></tr>");
                   $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
                   $('#guestinfo-btn2').text("支付中");
                   $('#guestinfo-btn2').addClass("am-btn-success");

               }
           }
       }else{//当日以前
           $('#guestinfo-tab1').html("<tr><td>已于"+timeStr(getDate)+"</td></tr><tr><td>审核完毕。</td></tr>");
           $('#guestinfo-btn1').text("审核完毕");

           $('#guestinfo-tab2').html("<tr><td>已于"+timeStr(curH20)+"</td></tr><tr><td>完成支付。</td></tr>");
           $('#guestinfo-i2').attr("class","am-icon-check-square-o am-icon-btn am-success");
           $('#guestinfo-btn2').text("已支付");
           $('#guestinfo-btn2').addClass("am-btn-success");

           $('#guestinfo-tab3').html("<tr><td>已于"+timeStr(curD1H10)+"</td></tr><tr><td>完成支付。</td></tr>");
           $('#guestinfo-i3').attr("class","am-icon-check-square-o am-icon-btn am-success");
           $('#guestinfo-btn3').text("支付完毕");
           $('#guestinfo-btn3').addClass("am-btn-success");
       }
}
function timeStr(getDate) {
    var tMinutes='';
    switch (getDate.getMinutes()){
        case 0: tMinutes="00";break;
        case 1: tMinutes="01";break;
        case 2: tMinutes="02";break;
        case 3: tMinutes="03";break;
        case 4: tMinutes="04";break;
        case 5: tMinutes="05";break;
        case 6: tMinutes="06";break;
        case 7: tMinutes="07";break;
        case 8: tMinutes="08";break;
        case 9: tMinutes="09";break;
        default:tMinutes=getDate.getMinutes();
    }

    return (getDate.getMonth()+1)+"月"+getDate.getDate()+"日&nbsp"+getDate.getHours()+":"+tMinutes;
}
//获取年月日 时分秒 具体函数
// var myDate = new Date();
//
// myDate.getYear(); //获取当前年份(2位)
// myDate.getFullYear(); //获取完整的年份(4位,1970)
// myDate.getMonth(); //获取当前月份(0-11,0代表1月)
// myDate.getDate(); //获取当前日(1-31)
// myDate.getDay(); //获取当前星期X(0-6,0代表星期天)
// myDate.getTime(); //获取当前时间(从1970.1.1开始的毫秒数)
// myDate.getHours(); //获取当前小时数(0-23)
// myDate.getMinutes(); //获取当前分钟数(0-59)
// myDate.getSeconds(); //获取当前秒数(0-59)
// myDate.getMilliseconds(); //获取当前毫秒数(0-999)
// myDate.toLocaleDateString(); //获取当前日期
// var mytime=myDate.toLocaleTimeString(); //获取当前时间
// myDate.toLocaleString( ); //获取日期与时间


//字符串转时间格式
// function getDate(strDate) {
//     var date = eval('new Date(' + strDate.replace(/\d+(?=-[^-]+$)/,
//             function (a) { return parseInt(a, 10) - 1; }).match(/\d+/g) + ')');
//     return date;
// }