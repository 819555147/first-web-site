<?php
header("Content-Type:text/html;charset=utf-8");
$servername = "localhost";
$username = "root";
$password = "819555147";
$dbname = "web";
$tt=array();
$tt2=array();
$tt3=array();
//会话开启
if(isset($_COOKIE["sid"])){
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//获取sessionid
	error_reporting(0);	
	$path = './temp/';						//路径变量
	session_save_path($path);				//session路径
	session_start();						//开启会话

	if(isset($_SESSION["username"])){		//设置session变量
		//连接数据库
		
		if(isset($_REQUEST["un"])){  //看别人的
			$un="'".$_REQUEST["un"]."'";
			$self="'".$_SESSION["username"]."'"; 
			$sql="SELECT Username,Realname,Sex,School,Place,Grade,Major,Birthday,Motto,Headsculpture,Matches FROM Users,Matches WHERE ((Username=User1 OR Username=User2)  AND (User1=$self OR User2=$self)) AND Username=$un";
			$isSelf=False;
		}
		else {	   //看自己的
			$un="'".$_SESSION["username"]."'";
			
			//自动推荐功能实现
			$sql="SELECT User1,User2 FROM matches WHERE (User1=$un OR User2=$un) AND Matches>=90 ORDER BY Matches DESC limit 0,2";
			
			try{
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$res=$conn->query($sql);
				$responseText = array();
				foreach($res as $row){
					$responseText[] = $row;
				}
				//
				$num=(count($responseText)>=2)?2:count($responseText);
				//
				$users=array();
				for($i=0;$i<$num;$i++){
					
					$users[$i]=($responseText[$i]['User1']==$_SESSION['username'])?$responseText[$i]['User2']:$responseText[$i]['User1'];
				}
			
				//查询游记、攻略、约伴游信息
				$invitation_tt=array();		//约伴游
				$essay_tt=array();			//游记
				$strategy_tt=array();		//攻略
				//获取最多各两份约伴游、游记和攻略（每个用户一种内容只获取一个）
				for($i=0;$i<$num;$i++){
					try{
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						//获取一篇约伴游
						$sql="SELECT count(*),Title FROM invitation WHERE Username="."'".$users[$i]."'"."ORDER BY theDate DESC limit 0,1";
						$res=$conn->query($sql);
						$responseText = array();
						foreach($res as $row){
							$responseText[] = $row;
						}
						$count=$responseText[0]['count(*)'];
						if($count!=0){
							$invitation_tt[$i]=$responseText[0]['Title'];
							$invitation_tt[$users[$i]]=$responseText[0]['Title'];
						}
						//获取一篇游记
						$sql="SELECT count(*),Title FROM Essay WHERE Username="."'".$users[$i]."'"."ORDER BY startDate DESC limit 0,1";
						$res=$conn->query($sql);
						$responseText = array();
						foreach($res as $row){
							$responseText[] = $row;
						}
						$count=$responseText[0]['count(*)'];
						if($count!=0){
							$essay_tt[$i]=$responseText[0]['Title'];
							$essay_tt[$users[$i]]=$responseText[0]['Title'];
						}
						//获取一篇攻略
						$sql="SELECT count(*),Title FROM Strategy WHERE Username="."'".$users[$i]."'"."ORDER BY theDate DESC limit 0,1";
						$res=$conn->query($sql);
						$responseText = array();
						foreach($res as $row){
							$responseText[] = $row;
						}
						$count=$responseText[0]['count(*)'];
						if($count!=0){
							$strategy_tt[$i]=$responseText[0]['Title'];
							$strategy_tt[$users[$i]]=$responseText[0]['Title'];
						}
					
					}					
					catch(PDOException $e) {
						echo "Error: " . $e->getMessage();
					}
					$conn = null;
				}
				
			}
			catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
			}
			$conn = null;		
			//--end自动推荐功能
			
			$sql="SELECT Username,Realname,Sex,School,Place,Grade,Major,Birthday,Motto,Headsculpture FROM Users WHERE Username=$un";
			$isSelf=True;
		}
		try {
		//链接数据库
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
			//查询
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{            
				$responseText[] = $row;      
			}
			$un=$responseText[0]['Username'];		//用户名
			$rn=$responseText[0]['Realname'];		//真实姓名
			$sex=$responseText[0]['Sex'];			//性别
			$sl=$responseText[0]['School'];			//学校
			$pc=$responseText[0]['Place'];			//所在地
			$gd=$responseText[0]['Grade'];			//年级
			$mj=$responseText[0]['Major'];			//专业
			$bd=$responseText[0]['Birthday'];		//生日
			$mt=$responseText[0]['Motto'];			//座右铭
			$hs=$responseText[0]['Headsculpture'];	//头像地址
			if(isset($responseText[0]['Matches']))
				$ppd=$responseText[0]['Matches'];	//匹配度，以%为单位。
			else
			{				
				if($_REQUEST['un']==$_SESSION["Uersname"])
					$ppd=100;						//自己和自己的匹配度肯定100%了
				else 						
					$ppd=80;						//默认匹配度80%
			}
			
			$sql="SELECT IsQuestionnaire FROM Users WHERE Username="."'".$un."'";
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{            
				$responseText[] = $row;      
			}
			$IsQuestionnaire=$responseText[0]['IsQuestionnaire'];
		}
		catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
		}
	$conn = null;		
	}
	else{
		//该如何？
		echo "<script>alert('未登陆');</script>";
		header("Location:login.php");//跳转到未登录页面
	}	
}
else{
	echo "<script>alert('登陆失效，请重新登陆');</script>";
	header("Location:login.php");//跳转到未登录页面
}

?>

<!DOCTYPE html>
<html>
<head>
<title>个人中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="个人信息" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--Custom Theme files-->
<link href="css/personal_center_style.css" rel="stylesheet" type="text/css" media="all" />
<!--circle-chart-->
<script src="js/jquery-1.11.1.min.js"></script> 

<?php  
	if($IsQuestionnaire==0&&$isSelf==True){
		echo "<script>if(confirm('请先填写问卷')==true){window.location.href='./questionnaire.php'}else{window.location.href='./index_loged.php'}</script>";
	}
			
?>
<!--ResponsiveTabs-->
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
		});
	});
</script>
<!--//ResponsiveTabs-->

<script type="text/javascript" src="js/scrollForever.js"></script>
<script type="text/javascript">		
$(function(){
	$("#a1").scrollForever();	//滚动字
	
	$("div#get_info").click(function(){ //单击获取联系方式
		$("div#show_info").toggle(2000);
	});
})
</script>
<!--//滚动字-->
</head>
<body>
	<!-- main -->
	<div class="main">
		<h1>个人中心</h1>
		<div class="main-info w3l">
			<div class="main-row"><!-- main-row-one -->
				<div class="profile-grid logo wthree">
					<img src="<?php echo $hs;?>" alt="图片不见了" class="tx"/>
					<h2 class="infoh" contenteditable="true"><?php echo $un.($sex=='男'?'<span style="color:#87cefa;">♂</span>':'<span style="color:pink;">♀</span>');?></h2>
					<p contenteditable="true"><?php echo $mt;?></p>
					<script>
					   document.write(Date());
					</script>
					
					
				</div>
				<h3 class="title">资料</h3>					
				<div class="aa" id="a1">
					<ul>
						<li contenteditable="true"><?php echo $rn;?></li>
						<li contenteditable="true"><?php echo $sl;?></li>
						<li contenteditable="true">所在地 <?php echo $pc;?></li>
						<li contenteditable="true"><?php echo $gd."级";echo $mj;?></li>
						<li contenteditable="true">生日<?php echo $bd;?></li>
					</ul>
				</div>
				
				<div class="col-md-6 skills-right bar_group">	
					<div class='bar_group__bar thin' label='<?php echo '匹配度 &nbsp;&nbsp;';echo $ppd."%";?>' value='200'></div>
				</div>																<!--这边需要输出匹配度-->
				<div id="get_info">
					<span >获取联系方式</span>
				</div>
				
				
				<!--bar-js-->
				<script src="js/bars.js"></script>
								
				<div class="clear"> </div>
			</div>
			
			<!--显示联系方式-->
			<?php 
				$un="'".$un."'";
				$sql="SELECT Username,Email,QQ,Wechat FROM Login WHERE Username=$un";	
				try {
				//链接数据库
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//查询
				$res=$conn->query($sql);
				$responseText = array();  
				foreach($res as $row)   
				{            
					$responseText[] = $row;      
				}
				$em=$responseText[0]['Email'];			//邮箱
				$qq=$responseText[0]['QQ'];				//QQ
				$wc=$responseText[0]['Wechat'];			//微信
							
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;		
				
				
				if($ppd>=85){		//如果匹配度大于等于85%
					echo "<div id='show_info' style='display:none;'>
							<table>";
					echo   "<tr>";
					if(isset($em)) {echo "<th>邮箱</th>";}
					if(isset($qq)) {echo "<th>QQ</th>";}
					if(isset($wc)) {echo "<th>微信</th>";}
					
					echo   "</tr>";
					echo   "<tr>";
					if(isset($em)) {echo "<td  contenteditable='true'>$em</td>";}
					if(isset($qq)) {echo "<td  contenteditable='true'>$qq</td>";}
					if(isset($wc)) {echo "<td  contenteditable='true'>$wc</td>";}
					
					echo   "</tr>
							</table>
						  </div>";							
				}else{
					echo "<div id='show_info' style='display:none;'>您没有权限查看！</div>";
				}	
			?>
		</div>
					
		<!-- copyright -->
		<div class="copyright">
			<p><a href="" target="_blank">乐行青春</a></p>
		</div>
		<!-- //copyright -->
		<div class="recommend" id="recommend_left" onmouseenter="$('#toright').hide()" onmouseleave="$('#toright').show()">
			<span class="close other_close" id="close_left">&times;</span>
			<h2>推荐</h2>
			<p>经过筛选，这些是您可能感兴趣的内容：</p>
			<div class="content">
				<ul>
					<?php
						//输出约伴游
						if(count($invitation_tt)/2!=0){
							if(isset($invitation_tt[$users[0]]))
								echo "<li class='invi_li'><br/>约伴游：<span class='theTitle'>".$invitation_tt[$users[0]]."</span>
							by <span class='theAuthor'>".$users[0]."</span></li>";
							if(isset($invitation_tt[$users[1]]))
								echo "<li class='invi_li'><br/>约伴游：<span class='theTitle'>".$invitation_tt[$users[1]]."</span>
							by <span class='theAuthor'>".$users[1]."</span></li>";
						
						}
						else{
							echo "<li><br/>暂无推荐约伴游</li>";
						}
						//输出游记
						if(count($essay_tt)/2!=0){
							if(isset($essay_tt[$users[0]]))	
								echo "<a href='"."travels.php?un=".$users[0]."&tt=".$essay_tt[$users[0]]."' target='_blank'><li class='essay_li'><br/>游记：<span class='theTitle'>".$essay_tt[$users[0]]."</span>
							by <span class='theAuthor'>".$users[0]."</span></li></a>";
							if(isset($essay_tt[$users[1]]))	
								echo "<a href='"."travels.php?un=".$users[1]."&tt=".$essay_tt[$users[1]]."' target='_blank'><li class='essay_li'><br/>游记：<span class='theTitle'>".$essay_tt[$users[1]]."</span>
							by <span class='theAuthor'>".$users[1]."</span></li></a>";
						}
						else{
							echo "<li><br/>暂无推荐游记</li>";
						}
						//输出攻略
						if(count($strategy_tt)/2!=0){
							if(isset($strategy_tt[$users[0]]))
								echo "<a href='"."strategy.php?tt=".$strategy_tt[$users[0]]."&un=".$users[0]."' target='_blank'><li class='strategy_li'><br/>攻略：<span class='theTitle'>".$strategy_tt[0]."</span>
							by <span class='theAuthor'>".$users[0]."</span></li></a>";
							if(isset($strategy_tt[$users[1]]))
								echo "<a href='"."strategy.php?tt=".$strategy_tt[$users[1]]."&un=".$users[1]."' target='_blank'><li class='strategy_li'><br/>攻略：<span class='theTitle'>".$strategy_tt[1]."</span>
							by <span class='theAuthor'>".$users[1]."</span></li></a>";
						}
						else{
							echo "<li><br/>暂无推荐攻略</li>";
						}
					?>
					<li id="search">
						<!--首先请将form表单action属性改写为如下所示-->
						<form target="_blank" action="http://zhannei.baidu.com/cse/site">
							<!--请保证您的输入框input标签name值为"q"-->
							<span>没有喜欢的内容？没关系，试试搜索自己喜欢的内容吧！</span>
							<input type="text" name="q" size="30" required='required'/>
							<!--请为您的form表单添加如下一行代码，并将value值改写为您网站的主域-->
							<input type="hidden" name="cc" value="localhost/square.php"/>
							<input type="submit" value="搜索"/>
						</form>
					</li>
					<li id="last1"></li>
				</ul>
			</div>
			<img class="toRight" id="toright" src="images/right.png"/>
		</div><!-- end recommendS -->
	
	<!--other recommend-->
	<div class="recommend_right" id="recommend_right" onmouseenter="$('#toleft').hide()" onmouseleave="$('#toleft').show()">
			<span class="close other_close" id="close_right">&times;</span>
			<h2>定制</h2>
			<p>				如果您不想花时间浏览网站众多有趣的内容，也对我们的推荐不感冒，甚至懒得发起约伴邀请，那么试试我们为您提供的专属个性化定制吧！
			</p>
			<div class="content">
				<ul>
					<form>
					<li>
					    <span>时间：</span><input type='date' class='date' name="start_date" required="required"/>—<input type='date' class='date' name="end_date" required="required"/>
					</li>
						<li>
						<span>地点：</span><input type='text' class='destination' name="destination"/>
					</li>
					<li>
						<span>人数要求：</span><input type="number" min="2" name="min_number"/>—<input type="number" min="3" name="max_number"/>
					</li>
					<li>
						<span>备注：</span><input type='textarea' class='otherThings' name="other"/>
					</li>	
					<li id="last2"></li>
					<input type='submit' value="获取定制"/>
					</form>
				</ul>
			</div>
			<img class="toLeft" id="toleft" src="images/left.png"/>
		</div><!-- end other recommend -->
	
	</div><!-- main -->
	
	<div class="getTop">
		<a href="http://localhost">	
			<img src="images/2.png"/>
			<p>回到主页</p>
		</a>
	</div>	
	
	<!--弹窗在这里-->
	<div class="showmore" id="smgreen">
		<!-- 弹窗 -->
		<div id="myModal" class="modal">
		<!-- 关闭按钮 -->
		<span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
		<!-- 弹窗内容 -->
		<!-- 文本描述 -->
		<div id="caption"></div>
		<div id="bt" onclick="document.getElementById('contactChooser').style.display='block';
		document.cookie='title='+document.getElementById('tt').innerText; document.cookie='author='+document.getElementById('ar').innerText;"><span>我要参加</span></div> 	
		<div id="joinin">	点击按钮我们会将您的联系方式发送给伴游发起者，你可以决定发送何种联系方式，而你也会获得伴游发起者的相应联系方式，以实现进一步交流。
		</div>
		</div>
	</div>
	
	<!--另一个弹窗，选择提交的联系方式-->
	<div id="contactChooser">
		<fieldset>
		<legend>请选择</legend>
			<form action="join_travels.php" method="post">	
				<div class="ccInput">
					<input type="checkbox" name="contact[]" value="QQ"/> QQ
				</div>
				<div class="ccInput">
					<input type="checkbox" name="contact[]" value="wechat"/> 微信
				</div>
				<div class="ccInput">
					<input type="checkbox" name="contact[]" value="email" checked/> Email（必选）
				</div>
				<div class="ccInput">
				其他联系方式 <input type="text" name="otherContact"/>
				</div>
				<div id="yes-no">
					<input type="submit" value="确定"/>
					<span onclick="document.getElementById('contactChooser').style.display='none';
					">再想想</span>
				</div>
			</form>
		</fieldset>
	</div>
	<script>
		// 获取弹窗			
		var modal = document.getElementById('myModal');
		
		//弹窗函数
		function open_model(){
			modal.style.display = "block";
			$("#bt").show();
			$("#joinin").show();
			
			//AJAX+PHP显示弹窗口内容
			var title=$(this).children("span.theTitle").text();
			var uname=$(this).children("span.theAuthor").text();
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.onreadystatechange=function(){
				
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					
					var temp=xmlhttp.responseText+"";
					var temp2=temp;
					var index=temp.indexOf("@#$%^")+5;						//分隔符@#$%^
												
					$("#caption").html(temp.substr(0,index-5));				//文本显示
				}
			}

			xmlhttp.open("GET","square_get_invitation.php?un='" + uname + "'" + "&tt='" + title + "'",true);
			xmlhttp.send();
		
		}
		
		
		//点击显示约伴游
		var invi_lis = document.getElementsByClassName('invi_li');
		invi_lis[0].onclick = open_model;
		invi_lis[1].onclick = open_model;
		
		// 获取 <span> 元素，设置关闭按钮
		var span = document.getElementsByClassName("close")[0];

		// 当点击 (x), 关闭弹窗
		span.onclick = function() {
			modal.style.display = "none";
		}
		
		//关闭按钮，关闭左浮窗
		$('#close_left').click(function(){
			$("#recommend_left").fadeOut(500);
		});	
		//关闭按钮，关闭右浮窗
		$('#close_right').click(function(){
			$("#recommend_right").fadeOut(500);
		});	
		
		//单击获取定制，验证表单，使用ajax，避免页面跳转
		$("input[value='获取定制']").click(function(){
			if($("input[name='end_date']").val()==""||$("input[name='start_date']").val()=="")
			{
				alert('请至少填写日期范围');
				return false;
			}
			
			var sd=$("input[name='start_date']").val();		//起始时间
			var ed=$("input[name='end_date']").val();		//终止时间
			var s_date = new Date(sd);
			var e_date = new Date(ed)
			if(s_date>e_date){
				alert('起始日期大于终止日期！请正确填写');
				return false;
			}
			
			
			var dest=$("input[name='destination']").val();	//获取地点，若不填则为""
			
			
			var min=$("input[name='min_number']").val();
			var max=$("input[name='max_number']").val();
			if(min==""&&max==""){
				alert('请填写人数范围！');
				return false;
			}
			if(min!=""&&max==""){
				max=100;
			}
			if(max!=""&&min==""){
				min=2;
			}
			/*if(min>max){
				alert('最小人数大于最大人数！请正确填写');
				return false;
			}*/
			
			
			//AJAX+PHP显示弹窗口内容
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.onreadystatechange=function(){
				
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					//处理一下响应的文本
				
					$("#caption").html(xmlhttp.responseText);				//文本显示
				
				}
			}

			xmlhttp.open("GET","get_personal_plan.php?"+"sd=" + sd  +"&ed="+ ed +((dest=="")?"":("&dest=" + dest ))+"&minn="+min+"&maxn="+max,true);
			xmlhttp.send();
			
			modal.style.display = "block";
			$("#bt").hide();
			$("#joinin").hide();
			
			return false;
		});
		
	</script>

	
</body>
</html>