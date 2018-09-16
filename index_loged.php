<?php
/*
 * 登陆页面
 */
header("Content-Type:text/html;charset=utf-8");
//找coolie
if(isset($_COOKIE["sid"]))							//用cookies传递sessionid
{
	//会话开启
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//获取sessionid
	error_reporting(0);	
	$path = './temp/';						//路径变量
	session_save_path($path);				//session路径
	session_start();						//开启会话
	//
	
	if(isset($_SESSION["username"])){		//检测session变量
		//连接数据库
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";
		$unn="'".$_SESSION["username"]."'";
		$sql="SELECT Username FROM Login WHERE Username=$unn OR Email=$unn";	
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
			$un=$responseText[0]['Username'];
		
		
		}
		catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
		}
	$conn = null;		
	}
	else{
		//该如何？
		header("Location:index.php");//跳转到未登录页面
	}	
}
else{
	header("Location:index.php");//跳转到未登录页面	
}
?>

<!DOCTYPE html>
<html class="no-js" xmlns="index.php"  lang="zh-cmn-Hans"> 
	<meta charset="utf-8">  
	
	<title>一起旅游吧&mdash; 大学生网络自助约伴游平台</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/><!--viewport FullScreen，图文比1:1-->
	<meta name="description" content="大学生网络自助约伴游平台" />
	<meta name="keywords" content="旅游, 大学生, 网络平台, 自助约伴" />
    <meta name="author" content="乐行青春"/>
	<meta name="generator" content="Notepad++"/>
	
	
	<!-- Animate.css CSS动画库 -->
	<link rel="stylesheet" href="css/animate.css"/>
	<!-- Icomoon Icon Fonts 图标字体库-->
	<link rel="stylesheet" href="css/icomoon.css"/>
	<!-- Bootstrap  框架-->
	<link rel="stylesheet" href="css/bootstrap.css"/>
	<!-- Superfish 下拉菜单库-->
	<link rel="stylesheet" href="css/superfish.css"/>	
	<link rel="stylesheet" href="css/style.css"/>

	
	<body>
		<div id="wrapper">
		<div id="page">
		<div id="header">
			<header id="header-section">
				<div class="container">
					<div class="nav-header">
						<a href="#" class="js-nav-toggle nav-toggle"><i></i></a>
						<h1 id="logo"><a href="index.php">一起旅游吧	</a></h1>
						<!-- START #menu-wrap -->
						<nav id="menu-wrap" role="navigation">
							<ul class="sf-menu" id="primary-menu">
								<li class="active">
									<a href="index.php"><i class="icon-home3"></i>主页</a>
								</li>
								<li>
									<a href="personal_center.php" class="sub-ddown"><i class="icon-user"></i><?php echo $un;?></a>
									<ul class="sub-menu">
										<li><a href="personal_center.php" target="_blank"><i class="icon-feather"></i>个人中心</a></li>
										<li><a href="square.php#yjyq" target="_blank"><i class="icon-feather"></i>发起约伴游</a></li>
										<li><a href="square.php#yjyq" target="_blank"><i class="icon-feather"></i>写游记</a></li>
										<li><a href="square.php" target="_blank"><i class="icon-feather"></i>广场</a></li>
										<li><a href="logout.php"><i class="icon-feather"></i>注销</a></li>
									</ul>
								</li>
								<li>
									<a href="#" class="sub-ddown"><i class="icon-light-bulb"></i>分享之旅</a>
									 <ul class="sub-menu">
									 	<li><a href="square.php#travels_here" target="_blank"><i class="icon-direction"></i>游记</a></li>
									 	<li><a href="square.php#stratrgy_here" target="_blank"><i class="icon-direction"></i>攻略</a></li>
										<li><a href="square.php#start" class="sub-ddown" target="_blank"><i class="icon-direction"></i>约伴游</a></li>
										<li><a href="image_gallery.php"><i class="icon-direction"></i>影像</a></li>
										<li><a href="#" target="_blank"><i class="icon-direction"></i>主题未定</a></li> 
									</ul>
								</li>
								<li><a href="#" onclick="alert('暂无合作伙伴！');"><i class="icon-link "></i>合作伙伴</a></li><!--暂无合作伙伴-->
							</ul>
						</nav>
					</div>
				</div>
			</header>
			
		</div>
		
		
		<div class="hero">
			<div class="overlay"></div>
			<div class="cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(images/img-9.jpg);">
				<div class="desc animate-box">
					<h2>Travel With Youth.</h2>
					<span id="LXInfo">Lovely Crafted by 乐行青春<br/>2017科研立项</span>
					<script> <!--可以改成鼠标滑入显示-->
					    var x="<span id='LXInfo'>Lovely Crafted by 乐行青春<br/>2017科研立项</span>";
					    document.getElementById("LXInfo").onmouseover=function(){
						    this.innerHTML="<?php echo $un;?>，欢迎来到我们的网站！<br/><br/>";}
						document.getElementById("LXInfo").onmouseout=function (){
						    this.innerHTML=x;
						}	
					</script>
					
					<span><a class="btn btn-primary btn-lg" target="_blank" href="square.php">开始旅程</a></span>
				</div>
			</div>

		</div>


		<div class="listing">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 item-wrap">
						<a class="listing-item" href="square.php#travels_here" target="_blank">
							<img src="images/img-1.jpg" alt="picture can't be found!" class="img-responsive">
							<div class="listing-copy">
								<h2>精彩游记</h2>
								<span class="icon">
									<i class="icon-chevron-right"></i>
								</span>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 item-wrap">
						<a class="listing-item" href="square.php#stratrgy_here" target="_blank">
							<img src="images/img-2.jpg" alt="picture can't be found!" class="img-responsive">
							<div class="listing-copy">
								<h2>每日攻略</h2>
								<span class="icon">
									<i class="icon-chevron-right"></i>
								</span>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 item-wrap">
						<a class="listing-item" href="square.php#yjyq" target="_blank">
							<img src="images/img-3.jpg" alt="picture can't be found!" class="img-responsive">
							<div class="listing-copy">
								<h2>结伴同游</h2>
								<span class="icon">
									<i class="icon-chevron-right"></i>
								</span>
							</div>
						</a>
					</div>
					<!-- END 3 row -->

					<div class="col-md-4 col-sm-4 item-wrap">
						<a class="listing-item" href="image_gallery.php" target="_blank">
							<img src="images/img-4.jpg" alt="picture can't be found!" class="img-responsive">
							<div class="listing-copy">
								<h2>光影视界</h2>
								<span class="icon">
									<i class="icon-chevron-right"></i>
								</span>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 item-wrap">
						<a class="listing-item" href="#" target="_blank">
							<img src="images/img-5.jpg" alt="picture can't be found!" class="img-responsive">
							<div class="listing-copy">
								<h2>模块未定</h2>
								<span class="icon">
									<i class="icon-chevron-right"></i>
								</span>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 item-wrap">
						<a class="listing-item" href="#" target="_blank">
							<img src="images/img-6.jpg" alt="picture can't be found!" class="img-responsive">
							<div class="listing-copy">
								<h2>模块未定</h2>
								<span class="icon">
									<i class="icon-chevron-right"></i>
								</span>
							</div>
						</a>
					</div>
					<!-- END 3 row -->


				</div>
			</div>
		</div>
        
		<!--动态获取游记内容，并显示到主页-->
		<?php
			
			$servername = "localhost";
			$username = "root";
			$password = "819555147";
			$dbname = "web";
			
			$sql="SELECT Username,Title,summary,startDate FROM essay ORDER BY startDate DESC limit 0,3";	
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
			$un1=$responseText[0]['Username'];
			$un2=$responseText[1]['Username'];
			$un3=$responseText[2]['Username'];
			$tt1=$responseText[0]['Title'];
			$tt2=$responseText[1]['Title'];
			$tt3=$responseText[2]['Title'];
			$td1=$responseText[0]['startDate'];
			$td2=$responseText[1]['startDate'];
			$td3=$responseText[2]['startDate'];
			$sm1=$responseText[0]['summary'];
			$sm2=$responseText[1]['summary'];
			$sm3=$responseText[2]['summary'];
			}
			catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
			}
			$conn = null;		
			
		?>
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 news">
						<h3><i class="icon-search"></i>发现精彩</h3>
						<ul>
							<li>
								<a href="travels.php?un=<?php echo$un1;?>&tt=<?php echo$tt1;?>" target="_blank">
									<span class="date"><?php echo $td1;?></span>
									<h3><?php echo $tt1;?></h3>
									<p><?php echo $sm1;?></p>
								</a>
							</li>
							<li>
								<a href="travels.php?un=<?php echo$un2;?>&tt=<?php echo$tt2;?>" target="_blank">
									<span class="date"><?php echo $td2;?></span>
									<h3><?php echo $tt2;?></h3>
									<p><?php echo $sm2;?></p>
								</a>
							</li>
							<li>
								<a href="travels.php?un=<?php echo$un3;?>&tt=<?php echo$tt3;?>"  target="_blank">
									<span class="date"><?php echo $td3;?></span>
									<h3><?php echo $tt3;?></h3>
									<p><?php echo $sm3;?></p>
								</a>
							</li>
							<li>
								<a href="square.php#travels_here"  target="_blank">
								    <br/>
									<h3><i class="icon-eye3"></i> 更多精彩......</h3>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-6 testimonial">
						<img src="images/4.jpg" alt="picture can't be found!" class="img-responsive mb20">
						<!--<img src="images/4.jpg" alt="picture can't be found!" class="img-responsive">-->
					</div>
					
					
				</div>
			</div>
		</div>
		
		<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="social-icons">
								<a href="https://im.qq.com/" target="_blank" title="QQ"><i class="icon-qq"></i></a>
								<a href="http://weibo.com/" target="_blank" title="微博"><i class="icon-sina-weibo"></i></a>
								<a href="http://www.renren.com/" target="_blank" title="人人"><i class="icon-renren"></i></a>
								<a href="https://web.wechat.com/?lang=zh_CN" target="_blank" title="微信"><i class="icon-chat"></i></a>
								<a href="https://github.com/" target="_blank" title="github"><i class="icon-github2"></i></a>
							</p>
							<p>2017 科研立项 <a href="p.php">乐行青春</a>. All Rights Reserved. 
							<br> More Information <a href="#" target="_blank" title="一起旅游吧">一起旅游吧</a> 
						</div>
					</div>
				</div>
			</div>
		</footer>
	

	</div>
	<!-- END page -->

	</div>
	<!-- END wrapper -->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script> 
	</body>
</html>


