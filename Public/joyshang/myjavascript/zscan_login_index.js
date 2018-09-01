/**
 * Created by Administrator on 2018/8/8.
 * 描述郑州派送项目的登录页面
 */
//一般直接写在一个js文件中
layui.use(['jquery','layer', 'form'], function(){
    var layer = layui.layer
        ,form = layui.form
        ,$=layui.$;

    form.on('submit(btn_login)',function (data) {
        layer.msg(JSON.stringify(data.field));
        return false;
    });
});
