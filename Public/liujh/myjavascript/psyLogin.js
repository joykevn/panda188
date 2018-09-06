/**郑州保单派送，派送员登录、查询订单
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
    //派送员登录页面    
	//监听POST提交-派送员登录
	form.on('submit(psy_login)', function(up_data){
        
   });
  
  //派送员查询页面
  var active = {
    ,tabChange: function(){
      //切换到指定Tab项
      element.tabChange('demo', '22'); //切换到：用户管理
    }
  };
 
  $('.site-demo-active').on('click', function(){
    var othis = $(this), type = othis.data('type');
    active[type] ? active[type].call(this, othis) : '';
  });

  
});