<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<a id='aa'>asd</a>
</body>
<script type="text/javascript" src="/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
window.onload=json;

function loop(){
loop=setInterval(a,1000); //延时循环
}
function json(){
var a=new Date();
var c=JSON.parse('{"name":"huangxiaojian","age":"23"}'); //解释为json 对象
var b=JSON.stringify(c);  //从对象中解释出字符串
alert(b);
// document.write(a);
$('#aa').html(c);
// clearInterval(loop); //取消延时
}
function b(){
var a=true;
alert(a);
var b=typeof c;  //数据类型检测
alert(b);

}
function writeObj(obj){ 
    var description = ""; 
    for(var i in obj){   
        var property=obj[i];   
        description+=i+" = "+property+"\n";  
    }   
    alert(description);  //打印对象
}
function cut(){
var url="http://jlb.culaiwan.com";
alert(url);
	var patt1=new RegExp("[^/\.]*");
var arr=url.match(patt1);
alert(arr[1]);}   //截取url 首段字符
</script>
</html>