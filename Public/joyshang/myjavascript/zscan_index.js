/**郑州保单派送，通过扫码枪分配web页面
  * 2018/7/26.
 */
//JavaScript代码区域
layui.use(['jquery','element','table','laytpl','form','laydate'], function(){
    var element = layui.element
        ,table=layui.table
        ,laytpl=layui.laytpl
        ,form=layui.form
        ,laydate = layui.laydate
        ,$=layui.$;
	  //日期
	  laydate.render({
	    elem: '#date'
	  });
	  laydate.render({
	    elem: '#date1'
	  });
	  //当前日期	  
	  var now = new Date(); 
    date.value=new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getDate(); 
    //表格实例
    table.render({
       elem: '#demo'
        ,height: 615
        ,url:'printdd'
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


    //监听POST提交-分配订单
    form.on('submit(btn_dingdanhao)', function(up_data){
        //alert($("#dingdanhao").name);
        //layer.msg($("#dingdanhao1").value);
        //$('#dingdanhao1').reset();
        //form.render(null, 'dingdanhao1'); //更新 lay-filter="test1" 所在容器内的全部表单状态
        //layer.msg($("#dingdanhao1").value);
        //$("#dingdanhao1").val("");
        //$("#dingdanhao1").focus();
        //return false;
        $.ajax({
            type: 'POST',
            url: "dd_check",
            data: up_data.field,
            dataType: 'json',
            success: function (get_data) {
<<<<<<< HEAD
=======
                $("#dingdanhao1").val("");
                $("#dingdanhao1").focus();
>>>>>>> bc6db465d084028dbc0bbfa9de64265d1f88c9e1
                if(get_data=="psy_code_less")//无此派送员编码
                {
                    layer.msg(JSON.stringify('请输入正确的派送员编码!'));
                    return false;
                }
                if(get_data=="dingdan_less")//无此订单号
                {
<<<<<<< HEAD
                    layer.msg(JSON.stringify('请核实订单编号是否正确！'));
=======
                    layer.msg(JSON.stringify('订单号：'+up_data.field.dingdanhao+' 请核实订单编号是否正确！'));
>>>>>>> bc6db465d084028dbc0bbfa9de64265d1f88c9e1
                    return false;
                }
                if(get_data=="dingdan_chongfu")//订单号重复
                {
                    layer.msg(JSON.stringify('订单号：'+up_data.field.dingdanhao+' 该订单已经扫描过！'));
                    return false;
                }
                
                //layer.msg(JSON.stringify(data[0].chepaihao));
                
                table.render({
                    elem: '#table_ps'
                    ,height: 615
                    ,url:'rend_table_ps'+'?psy_code='+up_data.field.psy_code+'&flag=flag11'
                    ,page:false
                    ,even: true //开启隔行背景
                    ,size: 'sm' //小尺寸的表格
                    ,initSort: {
                        field: 'id' //排序字段，对应 cols 设定的各字段名
                        ,type: 'desc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
                    }
                    ,text: {
                        none: '当前暂无扫描数据' //默认：无数据。注：该属性为 layui 2.2.5 开始新增
                      }
                    ,cols:[[
                        {field:'id',title:'ID',width:70,sort:true,align:'center'}
                        ,{field:'dingdanhao',title:'订单号',event: 'detail',width:200,align:'center'}
                        ,{field:'chepaihao',title:'车牌号',width:100,align:'center'}
                        ,{field:'shoujianren',title:'收件人',width:100,align:'center'}
                        ,{field:'sddizhi',title:'地址',width:550,align:'left'}
                        ,{field:'psyname',title:'派送员',width:100,align:'center'}
                        ,{field:'paisongtime',title:'扫描时间',width:150,align:'center'}
                        ,{field:'paisongstatus',title:'派送状态',width:120,align:'center'}
                    ]]
                }); 
                
                //$("table tr:nth-child(2)").css('background-color','red');
                //设置登录
                var psyCode = $("#psy_code").val();
								$(".ps_name").text(psyCode);
            }
        });
        return false;
    });
//
//table.on('tool(test)', function(obj){ //test为你table的lay-filter对应的值
//if(obj.event === 'classStatus'){
//}

    //监听POST提交-查询订单
    form.on('submit(btn_inquire)', function(up_data){
        table.render({
            elem: '#table_chaxun'
            ,height: 615
            ,url:'rend_table_ps'+'?psy_code='+up_data.field.psy_code+'&date='+up_data.field.date+'&flag=flag00'
            ,page:false
            ,even: true //开启隔行背景
            ,size: 'sm' //小尺寸的表格
            ,initSort: {
                field: 'id' //排序字段，对应 cols 设定的各字段名
                ,type: 'desc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
            }
            ,text: {
                none: '当前暂无扫描数据' //默认：无数据。注：该属性为 layui 2.2.5 开始新增
              }
            ,cols:[[
                {field:'id',title:'ID',width:70,sort:true,align:'center'}
                ,{field:'dingdanhao',title:'订单号',width:200,align:'center'}
                ,{field:'chepaihao',title:'车牌号',width:100,align:'center'}
                ,{field:'shoujianren',title:'收件人',width:100,align:'center'}
                ,{field:'sddizhi',title:'地址',width:550,align:'left'}
                ,{field:'psyname',title:'派送员',width:100,align:'center'}
                ,{field:'paisongtime',title:'扫描时间',width:150,align:'center'}
                ,{field:'paisongstatus',title:'派送状态',width:120,align:'center'}
            ]]
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
    
    
  $('.site-demo-active').on('click', function(){
    var othis = $(this), type = $(this).data('type');
    active[type] ? active[type].call(this, othis) : '';
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