<?
error_reporting(0);
$username=$_COOKIE['culaiwan_username'];
if(empty($username)){ 
header("location: index.php"); exit;
}
if($_GET['remember']=='on'){
setcookie('username',$username,time()+3600*440);
}else if($_GET['remember']=='off'){
setcookie("username");
}
if($_GET['autolog']=='yes'){
setcookie('autolog',"yes",time()+3600*440);
}else if($_GET['autolog']=='no'){
setcookie("autolog");
}

mysql_connect('localhost','culaiwan_dlq','culaiwan_dlq') or die("fail to conn");
mysql_select_db('culaiwanlog');
mysql_query("SET NAMES utf8");
$sql="select * from dede_gameserver where gname='zlcq' and delay<=".time()." order by id desc";
$query=mysql_query($sql);
while($rs=mysql_fetch_array($query)){
$games[]=$rs;
}
$count=count($games);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>斩龙传奇</title>
<link rel="stylesheet" href="css/index.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</head>

<body>
	<div class="wrap bg2">
    	<div class="server-title">
        	<?=$username?> 欢迎您登陆，请选择服务器！<a href="javascript:loginout();">【注销】</a>
        </div>
        <div class="last-server">
        	<div class="last-list" id="txtMyServers">
            	<ul><? 
            	if($count>=1){$count2=1;}else{$count2=$count;}
            	for($i=0;$i<$count2;$i++){
						$servername=explode(" ",$games[$i]['servername']);
						echo "<li><a  href=\"javascript:toGame('".$games[$i]['server']."','".$games[$i]['state']."');\"  class='hot'>【".substr($games[$i]['server'],1)."服】".$servername[1]."</a><input type='hidden' id='fastin' value='".$games[$i]['server']."'></li>";
						}?><!--li><a href="" class="hot">【2服】天崩地裂</a></li-->
                </ul>
            </div>
            <div class="loginbtn">
            	<a href="javascript:fastin();"></a>
            </div>
        </div>
        <div class="serverbox">
        	<div class="tab">
            	<a href="javascript:void(0);" class="recommend hover">推荐服务器</a>
                <a href="javascript:void(0);" class="all">全部服务器</a>
            </div>
            <div class="server-list">
            	<ul id="#recommend" style="display:block">
            	      	<? 
            	      	if($count>=12){$count1=12;}else{$count1=$count;}
            	      	for($i=0;$i<$count1;$i++){
						$servername=explode(" ",$games[$i]['servername']);
						echo "<li><a  href=\"javascript:toGame('".$games[$i]['server']."','".$games[$i]['state']."');\"  class='hot'>【".substr($games[$i]['server'],1)."服】".$servername[1]."</a></li>";
						}?>
                	<!--li><a href="" class="new">【2服】天崩地裂</a></li-->
            </ul>
                <ul id="#all" style="display:none">
                     	      	<? for($i=0;$i<$count;$i++){
						$servername=explode(" ",$games[$i]['servername']);
						echo "<li><a  href=\"javascript:toGame('".$games[$i]['server']."','".$games[$i]['state']."');\"  class='new'>【".substr($games[$i]['server'],1)."服】".$servername[1]."</a></li>";
						}?>
                    <!--li><a href="" class="hot">【2服】天崩地裂</a></li>
                    <li><a href="" class="new">【2服】天崩地裂</a></li>
                    <li><a href="" class="stop">【2服】天崩地裂</a></li-->
                </ul>
            </div>
        </div>
    </div>
    	<script>

	
function toGame(sid,state){
<?if($username=='wcyculaiwan'||$username=='qfqculaiwan'){?>
$.ajax({
dataType: "jsonp",
url: "http://member.culaiwan.com/game/game.php?game=zlcq&force=1&client=1&server="+sid+"&callback=?",
 cache: false,
timeout : 7000,
beforeSend:function(){
},
error:function(){
},
success: function(data){
window.location.href="client://loadgame|"+data;
}
});

<?}else{?>
if(state!=""){
alert('该区暂未开启');
}else{
$.ajax({
url: "http://member.culaiwan.com/game/game.php?game=zlcq&client=1&server="+sid+"&callback=?",
dataType: "jsonp",
jsonp:"callback",
success: function(data){
window.location.href="client://loadgame|"+data;
}
});
}
<?}?>
}


function loginout(){
$.ajax({
dataType:"json",
url: "http://member.culaiwan.com/api/loginout.php?callback=?",
cache: false,
timeout : 7000,
success: function(data){
if(data.msg=='1'){
window.location.reload();
}}

});
}
function islogin(){
var url = "http://member.culaiwan.com/api/pc_lastgame.php?callback=?";
$.getJSON(url,function(data){
if(data.msg==1){
if(data.game=='zlcq'){
var servername=data.lx.split(" ")[1];
var server=data.server.split("s")[1];

var html="<ul><li><a href=\"javascript:toGame('"+data.server+"','');\" class='new'>【"+server+"】"+servername+"</a><input type='hidden' id='fastin' value='"+data.server+"'></li></ul>";
$('#txtMyServers').html(html);
}
}else{}
});
}

function fastin(){
var server=$('#fastin').val();
toGame(server,'');
}

function fastin2(){
var server=$('#sid').val();
toGame('s'+server,'');

}


$(document).ready(function(){ 
islogin();
});


	</script>
</body>
</html>
