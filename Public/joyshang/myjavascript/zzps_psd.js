$(function () {
    $('#page_denglu2').hide();
    //获取订单按钮点击后
    $("#btn_getdd").on('click',function () {
        var $psinfo={
            "chepaihaox":"1"
        };
        var tabContent;
        $.getJSON('printdd',$psinfo,function(json){
            if(json) {//json不为空
                $.each(json, function(i, item){
                    tabContent=tabContent
                                +"<tr><td>"+item.dingdanhao+"</td><td>"
                                +item.chepaihao+"</td><td>"
                                +item.shoujianren+"</td></tr>";
                });
                $('#tab_dingdan').html(tabContent);
            }
        });
    });
    // 登录按钮点击后，刷新登录界面,列出本人派送任务
    $("#btn_denglu").on('click',function () {
        var $psinfo2={
            "chepaihaox":"1"
        };
        $('#page_denglu1').hide();
        $('#page_denglu2').show();
        var tabContent2;
        $.getJSON('printdd',$psinfo2,function(json){
            if(json) {//json不为空
                $.each(json, function(i, item){
                    tabContent2=tabContent2
                        +"<tr><td>"+item.shoujianren+"</td><td>"
                        +item.chepaihao+"</td><td>"
                        +' <input type="checkbox" value="是否派送" name="docVlCb" minchecked="2" maxchecked="4" required>'
                        +"</td></tr>";
                });
                $('#tab_paisong').html(tabContent2);
            }
        });



    });

})