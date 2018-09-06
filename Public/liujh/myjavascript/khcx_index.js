/**郑州保单派送，客户查询订单
  * 2018/9/6.
 */
//JavaScript代码区域
layui.use(['jquery','element','table','laytpl','form','laydate'], function(){
    var element = layui.element
        ,table=layui.table
        ,laytpl=layui.laytpl
        ,form=layui.form
        ,laydate = layui.laydate
        ,$=layui.$;
    
    //监听POST提交-客户查询(通过车牌号、手机号、订单号查询订单转态)
    form.on('submit(khcx_inquire)', function(up_data){
        $.ajax({
            type: 'POST',
            url: "",
            data: ,
            dataType: 'json',
            success: function (get_data) {
               //查询成功数据展示在Home/Cz/khcx_detail
        });
        return false;
    });

  
});