/**
 * Created by Administrator on 2018/6/1.
 */
var app = new Vue({
    el:'#app',
    data:{
        message:'Hello Vue!'
    }
});
var app3=new Vue({
    el:'#app-3',
    data:{
        seen:true
    }
});
var app4=new Vue({
    el:'#app-4',
    data:{
        todoss:[
            {text:'第一行列表'},
            {text:'第二行列表'},
            {text:'第三行列表'},
            {text:'第四行列表'}
        ]
    }
});
var app5=new Vue({
    el:'#app-5',
    data:{
        message:'Hello Vue.js!'
    },
    methods:{
        reverseMessage:function () {
            //this.message=this.message.split('').reverse().join('');
            app4.todoss.push({text:'增加一类数据'});
        }
    }
});
var app6=new Vue({
    el:'#app-6',
    data:{
        message:'hello Vue!'
    }
});
