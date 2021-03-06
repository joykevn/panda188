/**郑州保单派送，通过扫码枪分配web页面
  * 2018/7/26.
 */
//JavaScript代码区域
layui.use(['jquery','element','table','laytpl','form'], function(){
    var element = layui.element
        ,table=layui.table
        ,laytpl=layui.laytpl
        ,form=layui.form
        ,$=layui.$;

    //表格实例
    table.render({
       elem: '#demo'
        ,height: 615
        ,url:'/panda188/index.php/Home/Zzps/printdd/'
        ,page:true
        ,even: true //开启隔行背景
        ,size: 'sm' //小尺寸的表格
        ,cols:[[
            {field:'id',title:'ID',width:80,sort:true}
            ,{field:'dingdanhao',title:'订单号',width:240}
            ,{field:'chepaihao',title:'车牌号',width:100}
            ,{field:'shoujianren',title:'收件人',width:100}
        ]]
    });


    //发送请求，监听派送员
    form.on('submit(psy_formDemo)', function(data){
 
        $.ajax({
            type: 'POST',
            url: "",
            data: data,
            dataType: 'json',
            success: function (data) {
            	if(1){
            		//layer.msg(JSON.stringify(data[0].chepaihao));
                table.render({
                    elem: '#table_ps'
                    ,height: 615
                    ,url:'/panda188/index.php/Home/Zscan/rend_table_ps/'
                    ,page:true
                    ,even: true //开启隔行背景
                    ,size: 'sm' //小尺寸的表格
                    ,initSort: {
                        field: 'id' //排序字段，对应 cols 设定的各字段名
                        ,type: 'desc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
                    }
                    ,cols:[[
                        {field:'id',title:'ID',width:50,sort:true}
                        ,{field:'dingdanhao',title:'订单号',width:180}
                        ,{field:'chepaihao',title:'车牌号',width:80}
                        ,{field:'shoujianren',title:'收件人',width:80}
                        ,{field:'sddizhi',title:'地址',width:220}
                        ,{field:'paisongyuan',title:'派送员',width:80}
                        ,{field:'paisongtime',title:'扫描时间',width:150}
                        ,{field:'paisongstatus',title:'派送状态',width:120}
                    ]]
                });
            	}else if(2){
            		alert("今天还没有派单，开始今天的派单！");
            	}else{
            		alert("请输入正确的派送员编号！");
            	}
            }
        });
        return false;
    });
		//监听POST提交
    form.on('submit(formDemo)', function(data1){
        //layer.msg(JSON.stringify(data1.field));
        $.ajax({
            type: 'POST',
            url: "/panda188/index.php/Home/Zscan/dd_check/",
            data: data1.field,
            dataType: 'json',
            success: function (data) {
                //layer.msg(JSON.stringify(data[0].chepaihao));
                $("#dingdanhao").value="";
                table.render({
                    elem: '#table_ps'
                    ,height: 615
                    ,url:'/panda188/index.php/Home/Zscan/rend_table_ps/'
                    ,page:true
                    ,even: true //开启隔行背景
                    ,size: 'sm' //小尺寸的表格
                    ,initSort: {
                        field: 'id' //排序字段，对应 cols 设定的各字段名
                        ,type: 'desc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
                    }
                    ,cols:[[
                        {field:'id',title:'ID',width:50,sort:true}
                        ,{field:'dingdanhao',title:'订单号',width:180}
                        ,{field:'chepaihao',title:'车牌号',width:80}
                        ,{field:'shoujianren',title:'收件人',width:80}
                        ,{field:'sddizhi',title:'地址',width:220}
                        ,{field:'paisongyuan',title:'派送员',width:80}
                        ,{field:'paisongtime',title:'扫描时间',width:150}
                        ,{field:'paisongstatus',title:'派送状态',width:120}
                    ]]
                });
            }
        });
        return false;
    });





    //监听单元格编辑
    table.on('edit(main_table)', function(obj){
        var value = obj.value //得到修改后的值
            ,data = obj.data //得到所在行所有键值
            ,field = obj.field; //得到字段
        layer.msg('[ID: '+ data.id +'] ' + field + ' 字段更改为：'+ value);
    });
});

//测试订单POST指令
$(function () {
    $("")
});



$(function () {
    $("#btn_test").click(function(){
        layui.use('layer', function(){
            var layer = layui.layer;

            layer.prompt({title: '扫描派送员二维码，并确认', formType: 1}, function(pass, index){
                layer.close(index,alert(pass));
                // layer.prompt({title: '随便写点啥，并确认', formType: 2}, function(text, index){
                //     layer.close(index);
                //     layer.msg('演示完毕！您的口令：'+ pass +'<br>您最后写下了：'+text);
                // });

            });
        });
    });
});