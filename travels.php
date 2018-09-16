<?php
/*----超时自动注销----*/	
if(isset($_COOKIE["sid"])){
	//会话开启							
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//获取sessionid
	error_reporting(0);	
	$path = './temp/';						//路径变量
	session_save_path($path);				//session路径
	session_start();						//开启会话

	if(isset($_SESSION["username"])){		 
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";
		$tt = "'".$_REQUEST['tt']."'";
		$un = "'".$_REQUEST['un']."'"; //获取url参数
		$sql="SELECT * FROM essay WHERE Username=$un AND Title=$tt";	
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
			$un=$responseText[0]['Username'];//作者名
			$ic=$responseText[0]['imgsrc'];
			$tt=$responseText[0]['Title'];
			$ct=$responseText[0]['Content'];
			$sd=$responseText[0]['startDate'];
			
			$un2 = "'".$_REQUEST['un']."'"; //获取url参数
			$sql="SELECT Headsculpture FROM users WHERE Username=$un2";
			//查询
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{		            
				$responseText[] = $row;      
			}
			$hs=$responseText[0]['Headsculpture'];		//头像路径
		}	
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;	
	}
	else {
		echo "<script>
				if(confirm('账号已注销！请重新登录')==true) 	
					window.location.href='login.php';
			  </script>";					
	}
}else {
	echo "<script>
			if(confirm('账号已登陆超5h，系统自动注销，请重新登录！')==true)
				window.location.href='login.php';
		  </script>";				
}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>游记</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/travels_style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		<div id="fh5co-aside" style="background-image: url(images/image_1.jpg)"><!--背景图片-->
			<div class="overlay"></div>
			<nav role="navigation">
				<ul>
					<li><a href="square.php#travels_here"><i class="icon-back"></i></a></li>
				</ul>
			</nav>
			<div class="featured">
				<span>Bio</span>
				<h2><?php echo $un;?> </a></h2>
			</div>
		</div>
		<div id="fh5co-main-content">
			<div class="fh5co-post"> 
				
				<!--从这开始，逐一显示模块-->
				<div class="fh5co-entry padding">
					<a href="personal_center.php<?php if($un!=$_SESSION["username"]) echo "?un=".$un; else echo"";?>"><img src="<?php echo $hs;?>" alt="图片不见了" id="headsculpture"></a><!--这些图片要修改且特殊处理--><!--第一张做头像-->
					<div>
						<span class="fh5co-post-date"><?php echo $sd;?></span>
						<h2><a><?php echo $tt;?></a></h2>
						
						<p>
							<?php echo $ct;?>      <!--这里暂时这样，游记怎么显示却决于怎么写！！！！！！-->
						</p>
					</div>
				</div>
				
				<footer>
					<div>
						<a href="#">乐行青春</a>
					</div>
				</footer>
			</div>
		</div>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
	<script src="js/travels_main.js"></script>

	</body>
</html>

