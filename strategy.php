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
<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>攻略</title>
	<meta name="description" content="攻略内容">
	<meta name="author" content="#">
	
    <!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
	================================================== -->
  	<link rel="stylesheet" href="css/zerogrid.css">
	<link rel="stylesheet" href="css/strategy_style.css">
	
	<script src="js/jquery1111.min.js" type="text/javascript"></script>
	<script src="js/script.js"></script>
	
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet">

</head>

<body>
	<div class="wrap-body">
		<header class="">
			<div id="owl-slide" class="owl-carousel">
				<div class="item">
					<img src="images/slider-1.jpg" />
					<div class="carousel-caption">
						<div class="carousel-caption-inner">
							<p class="carousel-caption-title"><a href="#">我们为您提供了一些精品攻略</a></p>
							<p class="carousel-caption-category"><a href="#" rel="category tag"></a> 
							<a href="#" rel="category tag"></a><a href="#" rel="category tag"></a>
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<img src="images/slider-2.jpg" />
					<div class="carousel-caption">
						<div class="carousel-caption-inner">
							<p class="carousel-caption-title"><a href="#">这些攻略可供您参考</a></p>
							<p class="carousel-caption-category"><a href="#" rel="category tag"></a> 
							<a href="#" rel="category tag"></a><a href="#" rel="category tag"></a>
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<img src="images/slider-3.jpg" />
					<div class="carousel-caption">
						<div class="carousel-caption-inner">
							<p class="carousel-caption-title"><a href="#">行千里路</a></p>
							<p class="carousel-caption-category"><a href="#" rel="category tag"></a> 
							<a href="#" rel="category tag"></a><a href="#" rel="category tag"></a>
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<img src="images/slider-4.jpg" />
					<div class="carousel-caption">
						<div class="carousel-caption-inner">
							<p class="carousel-caption-title"><a href="#">乐行千里</a></p>
							<p class="carousel-caption-category"><a href="#" rel="category tag"></a> 
							<a href="#" rel="category tag"></a><a href="#" rel="category tag"></a>
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<img src="images/slider-5.jpg" />
					<div class="carousel-caption">
						<div class="carousel-caption-inner">
							<p class="carousel-caption-title"><a href="#">Why It’s Important To Struggle</a></p>
							<p class="carousel-caption-category"><a href="#" rel="category tag"></a>
							<a href="#" rel="category tag"></a> <a href="#" rel="category tag"></a>
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<img src="images/slider-6.jpg" />
					<div class="carousel-caption">
						<div class="carousel-caption-inner">
							<p class="carousel-caption-title"><a href="#">Why It’s Important To Struggle</a></p>
							<p class="carousel-caption-category"><a href="#" rel="category tag"></a>, 
							<a href="#" rel="category tag"></a>, <a href="#" rel="category tag"></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		
		<!--////////////////////////////////////Container-->
		<section id="container">
			<div class="wrap-container">
				<!-----------------Content-Box-------------------->
				<!--显示详细攻略-->
				<?php
				$servername = "localhost";
				$username = "root";
				$password = "819555147";
				$dbname = "web";
				$tt = "'".$_REQUEST['tt']."'";
				$un = "'".$_REQUEST['un']."'";	//获取url参数
				$sql="SELECT * FROM strategy WHERE Title=$tt AND Username=$un";	
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
					$ic=$responseText[0]['imgsrc'];
					$tt=$responseText[0]['Title'];
					$ct=$responseText[0]['Content'];
					$td=$responseText[0]['theDate'];
				}	
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;
						
						
				#显示攻略
				echo "<article class='post zerogrid'>
					<div class='row wrap-post'><!--Start Box-->
						<div class='entry-header'>
							<span class='time'>$td</span>
							<h2 class='entry-title'><a href='#'>$tt</a></h2>
							<span class='cat-links'><a href='personal_center.php".(($un!=$_SESSION["username"])?("?un=".$un):"")."'>作者：$un</a></span>
						</div>
						<div class='post-thumbnail-wrap'>
							<img src='$ic'>
						</div>
						<div class='entry-content'>
							<h2>简介</h2>
							$ct;
						</div>
					</div>
				</article>";
			
			?>
				
				<div class="zerogrid">
					<div class="comments-are">
						<div id="comment">
							<h3>发表评论</h3>
							<span>来发表你的看法吧</span>
							<form name="form1" id="comment_form" method="post" action="send_comments.php?tt=<?php echo $tt;?>">
								<label>
								<span>评论：</span>
								<textarea name="message" id="message" required="required"></textarea>
								</label>
								<center><input class="sendButton" type="submit" name="Submit" value="提交"></center>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!--评论模块-->
		<div id="side-comments">
			<h3>评论</h3>
			<a name="cmt"></a>
			<!--注意显示单条评论-->
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "819555147";
				$dbname = "web";
				$tt = "'".$_REQUEST['tt']."'";		//获取url参数
				$sql="SELECT COUNT(*) FROM comments WHERE Title=$tt";	
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
					$n=$responseText[0]['COUNT(*)'];					
					
					$sql="SELECT * FROM comments WHERE Title=$tt ORDER BY time DESC limit 0,$n";//.($n>=5?"5":strval($n));
					$res=$conn->query($sql);
					$responseText = array();  
					foreach($res as $row)   
					{		            
						$responseText[] = $row;      
					}
					
					for($i=0; $i<$n; $i++){
					echo '<div class="single-comments">
							<span class="username">'.$responseText[$i]["Username"].'</span><span class="time">'.$responseText[$i]["time"].'</span>
							<p class="comment">'.$responseText[$i]["Content"].'</p>
						  </div>';	
				}
				}	
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				
				$conn = null;
			?>
		</div>
		
		<!--////////////////////////////////////Footer-->
		<footer>
			<div class="zerogrid copyright">
				<div class="wrapper">
					<a href="#">乐行青春</a>
				</div>
			</div>
		</footer>
		<!-- carousel -->
		<script src="owl-carousel/owl.carousel.js"></script>
		<script><!--自动播放图片-->
		$(document).ready(function() {
		  $("#owl-slide").owlCarousel({
			autoPlay: 3000,
			items : 2,
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [979,1],
			itemsTablet : [768, 1],
			itemsMobile : [479, 1],
			navigation: true,
			navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
			pagination: false
		  });		
		
		
		});
		</script>
	</div>
</body>
</html>
