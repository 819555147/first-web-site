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
		
			
			$sql="SELECT Username,Picture,description FROM gallery ORDER BY time DESC limit 0,32";
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{            
				$responseText[] = $row;      
			}
			
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
<head>
	<title>光影视界</title>
	<meta name="keywords" content="乐行青春" />
	<meta name="description" content="用户分享旅游图片" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/magnific-popup.css" rel="stylesheet"> 
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body>
	<div class="main-container">
		<nav class="main-nav">
			<div id="logo" class="left"><a href="#">乐行青春</a></div>
			<ul class="nav right center-text">
				<a href="index_loged.php"><li class="btn active">主页</li></a>
			</ul>
		</nav>
    	<div class="content-container">
			<header>
			<h1 class="center-text">光影视界</h1>
			<h2 class="center-text">热衷记录你的生活，热衷记录你的旅游经历，分享会让这一切更加有趣！</h2>
		</header>
		<div id="portfolio-content" class="center-text">
			<div class="portfolio-page" id="page-1">
				<?php
				    for($i=0;$i<8;$i++){
						$ar = $responseText[$i]['Username'];
						$pic_l = $responseText[$i]['Picture'];
						$dsc = $responseText[$i]['description'];
						$pic_s = str_replace("large","small",$pic_l); //是不是可以不用x-small.jpg这个图片呢？
						echo "<div class='portfolio-group'>
								<a class='portfolio-item' href='images/gallery/$pic_l'>
									<img src='images/gallery/$pic_l' alt='图片不见了'/>
									<div class='detail'>
										<h3>$ar</h3>
										<p>$dsc</p>
										<span class='btn'>查看大图</span>
									</div>
								</a>				
							  </div>";
					}
				?>
			</div>
			
			<!--第二页-->
			<div class="portfolio-page" id="page-2" style="display:none;">
				<?php
				    for($i=8;$i<16;$i++){
						$ar = $responseText[$i]['Username'];
						$pic_l = $responseText[$i]['Picture'];
						$dsc = $responseText[$i]['description'];
						$pic_s = str_replace("large","small",$pic_l);
						echo "<div class='portfolio-group'>
								<a class='portfolio-item' href='images/gallery/$pic_l'>
									<img src='images/gallery/$pic_l' alt='图片不见了'/>
									<div class='detail'>
										<h3>$ar</h3>
										<p>$dsc</p>
										<span class='btn'>查看大图</span>
									</div>
								</a>				
							  </div>";
					}
				?>
			</div>
			
			<!--第三页-->
			<div class="portfolio-page" id="page-3" style="display:none;">
				<?php
				    for($i=16;$i<24;$i++){
						$ar = $responseText[$i]['Username'];
						$pic_l = $responseText[$i]['Picture'];
						$dsc = $responseText[$i]['description'];
						$pic_s = str_replace("large","small",$pic_l);
						echo "<div class='portfolio-group'>
								<a class='portfolio-item' href='images/gallery/$pic_l'>
									<img src='images/gallery/$pic_l' alt='图片不见了'/>
									<div class='detail'>
										<h3>$ar</h3>
										<p>$dsc</p>
										<span class='btn'>查看大图</span>
									</div>
								</a>				
							  </div>";
					}
				?>
			</div> <!-- page 3 -->

			<!--第四页-->
			<div class="portfolio-page" id="page-4" style="display:none;">
				<?php
				    for($i=24;$i<32;$i++){
						$ar = $responseText[$i]['Username'];
						$pic_l = $responseText[$i]['Picture'];
						$dsc = $responseText[$i]['description'];
						$pic_s = str_replace("large","small",$pic_l);
						echo "<div class='portfolio-group'>
								<a class='portfolio-item' href='images/gallery/$pic_l'>
									<img src='images/gallery/$pic_l' alt='图片不见了'/>
									<div class='detail'>
										<h3>$ar</h3>
										<p>$dsc</p>
										<span class='btn'>查看大图</span>
									</div>
								</a>				
							  </div>";
					}
				?>
			</div> <!-- page 4 -->

			
			<div class="pagination">
				<ul class="nav">
					<li class="active">1</li>
					<li>2</li>
					<li>3</li>
					<li>4</li>
				</ul>
			</div>
		</div>
	</div>	<!-- /.content-container -->	
    
		<footer>
			<div class="social right">
				<a href="#"><i class="fa fa-github"></i></a>
				<a href="#"><i class="fa fa-weibo"></i></a>
				<a href="#"><i class="fa fa-qq"></i></a>
				<a href="#"><i class="fa fa-qrcode"></i></a>
			</div>
		</footer>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/modernizr.2.6.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script> 
	<script type="text/javascript" src="js/templatemo_script.js"></script>
	<script type="text/javascript">
		$(function () {
			$('.pagination li').click(changePage);
			$('.portfolio-item').magnificPopup({ 
				type: 'image',
				gallery:{
					enabled:true
				}
			});
		});
	</script>	
</body>
</html>