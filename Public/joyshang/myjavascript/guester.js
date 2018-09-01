/**
 * Created by Administrator on 2018/3/27.
 */
//初始加载
$(function() {
    $('#guester-zhanshiqu').hide();
});
//输入车牌号查询
$(function () {
    $('#guester-btn-chaxun').on('click',function () {
        var str1=$('#doc-ipt-chepaihao').val();

        //alert(str1);

        if(str1==""){
            alert('请输入有效车牌信息！');
        }else{
            // $('#baodanchaxun').fadeOut(500);
            // $('#baodanxianshi').fadeIn(500);
            $('#guester-shuruqu').hide();
            $('#guester-zhanshiqu').show();
            $('#guester-lab-chepaihao2').text(str1);
            // $('#p-toubaoren').text(str2);
            // $('#p-baofei').text(2018);
        }
        //alert($('#doc-vld-chepaihao').value());
    });
    $('#guester-btn-queding').on('click',function () {
        $('#guester-shuruqu').show();
        $('#guester-zhanshiqu').hide();
    });
});