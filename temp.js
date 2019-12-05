function getTime()
{     	//获取时间
    var date=new Date();

    var year=date.getFullYear();
    var month=date.getMonth()+1;
    var day=date.getDate();

    var hour=date.getHours();
    var minute=date.getMinutes();
    var second=date.getSeconds();
    if (hour<10) {
        hour='0'+hour;
    }
    if (minute<10) {
        minute='0'+minute;
    }
    if (second<10) {
        second='0'+second;
    }


    return time=year+'/'+month+'/'+day+'/'+hour+':'+minute+':'+second
}
function clock(t='time',me=true){
    var txt;
    if(t=='time'){
        txt="我也变成了没有感情的报时器，每10s测试一次"+getTime();
    }else if(t=='hitokoto'){
        $.ajax({
            url:'https://v1.hitokoto.cn/',
            dataType:'json',
            async:false, 
            success:function(data){
                txt=data.hitokoto+'---《'+data.from+'》'
            }
        });
    }
    if(me){txt='/me'+txt}
    $('#message').find('textarea').val(txt);
    $('#message').submit();
}

//开启定时器  ，时间单位为  1000=1s
//var myVar=setInterval('clock("hitokoto")',10000);
//关闭定时器
//clearInterval(myVar);
