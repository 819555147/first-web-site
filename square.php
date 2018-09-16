<?php
/*----超时自动注销----*/
//会话开启							
session_id($_COOKIE["sid"]);	
$sessid=session_id();					//获取sessionid
error_reporting(0);	
$path = './temp/';						//路径变量
session_save_path($path);				//session路径
session_start();						//开启会话
					
if(isset($_COOKIE["sid"])){
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
	<title>广场</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/square_style.css">
	<link rel="stylesheet" href="css/animate.css">
	
</head>
<body>

	<div id="section1">
		<header id="header-area" class="intro-section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<div class="header-content">
							<h1><a href="#start" title="点击跳转到下一页">开始旅途</a></h1>
							<h4>一场说走就走的旅行</h4>
						</div>
					</div>
				</div>
			</div>
		</header>
	</div>
	
	<hr/>
	<a name="start"></a>
	<div id="readmore"><a title="点击查看更多" id="rm" onclick=""><span id="ms">更多</span>约伴游</a></div>
	<div id="section2">
		<!-- Start Feature Area -->
		<section id="feature-area" class="about-section">
			<div class="container">
				<div class="row text-center inner" id="change">
					
					<!---动态显示约伴游信息--->
					<?php
						
							//连接数据库
							$servername = "localhost";
							$username = "root";
							$password = "819555147";
							$dbname = "web";
							
							$sql="SELECT * FROM invitation Order By theDate DESC limit 0,6";	
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
								
								
								for($i=0;$i<=3;$i+=3)
								{
									$un1=$responseText[$i]['Username'];
									$un2=$responseText[$i+1]['Username'];
									$un3=$responseText[$i+2]['Username'];
									$ic1=$responseText[$i]['img'];
									$ic2=$responseText[$i+1]['img'];
									$ic3=$responseText[$i+2]['img'];
									$tt1=$responseText[$i]['Title'];
									$tt2=$responseText[$i+1]['Title'];
									$tt3=$responseText[$i+2]['Title'];
									$sm1=$responseText[$i]['summary'];
									$sm2=$responseText[$i+1]['summary'];
									$sm3=$responseText[$i+2]['summary'];
								
									
									$outputs = array("<div class='col-sm-4'>
											<div class='feature-content'>
												<img src='$ic1' alt='图片不见了'>
												<h2 class='feature-content-title green-text'>$tt1</h2>
												<p class='feature-content-description'>
												<span class='author'>$un1</span><br/>
													$sm1
												</p>
												<a class='feature-content-link green-btn btn'>我也想去</a>
											</div>
										</div>",/**/"<div class='col-sm-4'>
											<div class='feature-content'>
												<img src='$ic2' alt='图片不见了'>
												<h2 class='feature-content-title blue-text'>$tt2</h2>
												<p class='feature-content-description'>
													<span class='author'>$un2</span><br/>
													$sm2
												</p>                    
												<a class='feature-content-link blue-btn btn'>我也想去</a>
											</div>
										  </div>",/**/"<div class='col-sm-4'>
											<div class='feature-content'>
												<img src='$ic3' alt='图片不见了'>
												<h2 class='feature-content-title red-text'>$tt3</h2>
												<p class='feature-content-description'>
													<span class='author'>$un3</span><br/>
													$sm3
												</p>
												<a class='feature-content-link red-btn btn'>我也想去</a>
											</div>
										  </div>");
									
									/*--显示绿色模块--*/
									echo $outputs[0];	
										
									/*--显示蓝色模块--*/	
									echo $outputs[1];	
										
									/*--显示红色模块--*/	
									echo $outputs[2];
								}  
							}	
							catch(PDOException $e) {
							echo "Error: " . $e->getMessage();
							}
							$conn = null;	
						
					?>
					
					
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
			
			</div>
		</section>
		<!-- End Feature Area -->
        
        
		<hr/>
		<div id="mrtj"><a name="stratrgy_here"><span>每日攻略</span></a><div>
		<!-- Start Blog Area -->
		<section id="blog-area">
			<div class="container">
				<div class="row text-center inner">
					<!--显示攻略，暂时每天推荐两篇攻略，往期攻略怎么查看？这个问题先留着-->
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "819555147";
						$dbname = "web";
						
						
						$sql="SELECT * FROM strategy Order By theDate DESC limit 0,2";	
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
							$ic1=$responseText[0]['imgsrc'];
							$ic2=$responseText[1]['imgsrc'];
							$tt1=$responseText[0]['Title'];
							$tt2=$responseText[1]['Title'];
							$sm1=$responseText[0]['Summary'];
							$sm2=$responseText[1]['Summary'];
						}	
						catch(PDOException $e) {
							echo "Error: " . $e->getMessage();
						}
						$conn = null;
						
						#显示攻略模块
						echo "<div class='col-sm-6'>
								<div class='blog-content'>
									<img src='$ic1' alt='图片不见了'>
									<h2>$tt1</h2>
									<p>
										$sm1
									</p>
									<br>
									<span><a href='strategy.php?tt=$tt1&un=$un1' target='_blank'>戳一戳看看</a></span><br>
								</div>
							  </div>";
						echo "<div class='col-sm-6'>
								<div class='blog-content'>
									<img src='$ic2' alt='图片不见了'>
									<h2>$tt2</h2>
									<p>
										$sm2
									</p>
									<span><a href='strategy.php?tt=$tt2&un=$un2' target='_blank'>戳一戳看看</a></span><br>
								</div>
							  </div>";
					?>
				</div>
			</div>
				</section>
				<!-- End Blog Area -->
			</div>
			<div id="section3">
				<!-- Start Services Area -->
				<section id="services-area" class="services-section">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center inner our-service">
								<div class="service">
									<a name="travels_here"><h1>精彩游记</h1></a>
									<p>
										读万里书，行万里路
									</p>
								</div>
							</div>
						</div>
					</div>
				</section>
					<!-- End Services Area -->
					
					
					<!--显示游记-->
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "819555147";
						$dbname = "web";
						
						
						$sql="SELECT * FROM essay Order By startDate DESC limit 0,4";	
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
							$un4=$responseText[3]['Username'];
							$ic1=$responseText[0]['imgsrc'];
							$ic2=$responseText[1]['imgsrc'];
							$ic3=$responseText[2]['imgsrc'];
							$ic4=$responseText[3]['imgsrc'];
							$tt1=$responseText[0]['Title'];
							$tt2=$responseText[1]['Title'];
							$tt3=$responseText[2]['Title'];
							$tt4=$responseText[3]['Title'];
							$sm1=$responseText[0]['summary'];
							$sm2=$responseText[1]['summary'];
							$sm3=$responseText[2]['summary'];
							$sm4=$responseText[3]['summary'];
							$sd1=$responseText[0]['startDate'];
							$sd2=$responseText[1]['startDate'];
							$sd3=$responseText[2]['startDate'];
							$sd4=$responseText[3]['startDate'];
						}	
						catch(PDOException $e) {
							echo "Error: " . $e->getMessage();
						}
						$conn = null;
					?>
					
					<!-- Start Testimornial Area -->
					<section id="testimornial-area">
						<div class="container">
							<div class="row text-center">
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
									<?php
										echo"<div class='testimonial-content'>
												<img src='$ic1' alt='图片不见了'/>
												<h2>$tt1</h2>
												<span class='sd'>$sd1</span>
												<p>
													简介：$sm1
												</p>
												<a href='travels.php?un=$un1&tt=$tt1' class='content-link'>read it</a>
												<br/>
												<p id='redd1'></p>
											</div>";
									?>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
									<?php
										echo"<div class='testimonial-content'>
												<img src='$ic2' alt='图片不见了'/>
												<h2>$tt2</h2>
												<span class='sd'>$sd2</span>
												<p>
													简介：$sm2
												</p>
												<a href='travels.php?un=$un2&tt=$tt2' class='content-link'>read it</a>
												<br/>
												<p id='redd2'></p>
											 </div>";			
									?>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
									<?php
										echo"<div class='testimonial-content'>
										<img src='$ic3' alt='图片不见了'/>
										<h2>$tt3</h2>
										<span class='sd'>$sd3</span>
										<p>
											简介：$sm3
										</p>
										<a href='travels.php?un=$un3&tt=$tt3' class='content-link'>read it</a>
										<br/>
										<p id='redd3'></p>
									</div>";
									?>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
									<?php
										echo"<div class='testimonial-content'>
												<img src='$ic4' alt='图片不见了'/>
												<h2>$tt4</h2>
												<span class='sd'>$sd4</span>
												<p>
													简介：$sm4
												</p>
												<a href='travels.php?un=$un4&tt=$tt4' class='content-link'>read it</a>
												<br/>
												<p id='redd4'></p>
											 </div>";
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="tm-box">
										<img src="images/4-5.jpg" alt="Image" class="img-responsive">
										<div class="tm-box-description">
											<h2>致所有用户的一段话</h2>
											<p class="tm-box-p">											我们的网站致力于为每一个在校大学生营造一个良好的自助约伴游环境，已解决许多同学想要外出旅游却没有伴侣的问题。
											</p>
											<p class="tm-box-p">
											我们的用户都是大学生，为了保护您的信息安全以及人生安全，所以我们对涉及安全的问题都很重视，对你造成的不便，我们深表歉意。
											另外，使用我们的网站您的浏览器必须支持cookie等功能（这里加一个链接自动打开cookie）。点击下面按钮为你引导操作。
											</p>
											<a href="#" class="content-link">点击完成配置</a>    
										</div>                        
									</div>                    
								</div>
							</div>
						</div>
					</section>
					<!-- End Testimornial Area -->
				</div>
				<div id="section4">
					<!-- Start Contact Area -->
					
					<section id="contact-area" class="contact-section">
					<a name="yjyq"></a>
					<!--/////选择按钮/////-->
					<section id="block_chooser">
						<span class="chooser_span" id="invitations">
							伴游邀请	
						</span>
						OR
						<span class="chooser_span" id="travels">
							撰写游记
						</span>
						
					</section>
						<div class="container" id="yq">
							<div class="row">
								<div class="col-sm-12 text-center inner">
									<div class="contact-content">
										<h1>发起伴游邀请</h1>
										<div class="row">                            
											<div class="col-sm-12">
												<p>
													在这里，每个人都可以发起伴游邀请，但是为了保证您和其他所有用户的隐私
													，我们需要采取一些特殊方式。以下获取您的联系方式是必要的，但我们不会
													主动透露你的联系方式，除非得到您的允许。<span style="background-color:#000;color:#ccc;">请务必完全按照文字提示填写！否则可能无法通过验证。</span>
												</p>
											</div>                            
										</div>
									</div>
								</div>
							</div>
								<!--伴游邀请模块-->
								<div class="row">
									<div class="col-lg-12">
										<form action="texteditor.php" method="post" class="contact-form"><!--提交表单-->
											<div class="col-sm-6 contact-form-left">
												<div class="form-group">	
													<input name="subject" type="text" class="form-control" id="subject" placeholder="主题" required="required">
												</div>
												<div class="form-group">	
													<input name="destination" type="text" class="form-control" id="destination" placeholder="地点" required="required">
												</div>
												<div class="form-group">	
													<input name="timerange" type="text" class="form-control" id="timerange" placeholder="时间范围：形如2018-1-1>2018-2-2" required="required">
												</div>
												<div class="form-group">	
													<input name="numbers" type="text" class="form-control" id="numbers" placeholder="人数范围：形如2-5" required="required">
												</div>
											</div>
											<div class="col-sm-6 contact-form-right">
												<div class="form-group">
													<textarea name="invitation_message" rows="6" class="form-control" id="invitation_message" placeholder="先写写您的邀请概述吧，这将显示在网站约伴游模块，一定要言简意赅、引人入胜，这样才会吸引更多的人哦" required="required"></textarea>
													<button type="submit" class="btn btn-default">发出邀请内容</button>
												</div>
											</div>                        
										</form>    
									</div>                
								</div>
							</div>
								
								
								
						<!--这之后隐藏游记模块，多个模块同时只显示一个！通过按钮选择模块-->
						<div class="container" id="yj">
							<div class="row">
								<div class="col-sm-12 text-center inner">
									<div class="contact-content">
										<h1>写篇游记</h1>
										<div class="row">                            
											<div class="col-sm-12">
												<p>	在这里，您可以记录下自己的旅游经历，但是为了保证您和其他所有用户的隐私，我们需要采取一些特殊方式。字数不要超过2000。<span style="background-color:#000;color:#ccc;">请务必完全按照文字提示填写！否则可能无法通过验证。</span>
												</p>
											</div>                            
										</div>
									</div>
								</div>
							</div>
									
							<div class="row">
									<div class="col-lg-12">
										<form action="texteditor.php" method="post" class="contact-form"><!--提交表单-->
											<div class="col-sm-6 contact-form-left">
												<div class="form-group">
													<input name="subject" type="text" class="form-control" id="subject" placeholder="为您的游记取一个简明扼要而又引人注目的标题吧！" required="required">
													
												</div>
											</div>
											<div class="col-sm-6 contact-form-right">
												<div class="form-group">
													<textarea name="summary" id="summary" rows="6" class="form-control" placeholder="先写写您的游记概述吧，这将显示在网站游记模块，一定要言简意赅、引人入胜，这样才会有更多的人看您的游记哦" required="required"></textarea>
													<button type="submit" class="btn btn-default">提交</button>
												</div>
											</div>                     
										</form>
									</div>                
							</div>				
						</div>
							
					</section>
						<!-- End Contact Area -->
				</div>
		
					
					
					<!-- Start Footer Area -->
					<footer id="footer-area">
							<hr>
							<div class="container">
								<div class="row">
									<div class="col-sm-12 text-center">             
										<p class="copy">
                                        <a href="#">乐行青春</a></p>
									</div>
								</div>
							</div>													
						</footer>
						<!-- End Footer Area -->
						<script>
							// 获取弹窗			
							var modal = document.getElementById('myModal');
						
							//弹窗函数
							function open(){
								// 获取图片插入到弹窗
								modal.style.display = "block";
							
								//AJAX+PHP显示弹窗口内容
								var uname=$(this).parent().children("p.feature-content-description").children("span.author").text();
								var title=$(this).parent().children("h2").text();
								
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
						
							
							var btn = document.getElementsByClassName('btn');
							btn[0].onclick = open; 
							btn[1].onclick = open;
							btn[2].onclick = open;
							btn[3].onclick = open;
							btn[4].onclick = open;
							btn[5].onclick = open;
							
							
							// 获取 <span> 元素，设置关闭按钮
							var span = document.getElementsByClassName("close")[0];
 
							// 当点击 (x), 关闭弹窗
							span.onclick = function() {
								modal.style.display = "none";
							}
							
							
							
						</script>
						
						<script src="js/jquery-1.11.2.min.js"></script>
						<script src="js/jquery.scrollUp.min.js"></script> <!-- https://github.com/markgoodyear/scrollup -->
						<script src="js/jquery.singlePageNav.min.js"></script> <!-- https://github.com/ChrisWojcik/single-page-nav -->
						<script src="js/parallax.js-1.3.1/parallax.js"></script> <!-- http://pixelcog.github.io/parallax.js/ -->
						<script>
							$(function() {  		
								//两个模块转换
								$("#invitations").click(function(){
									$("div#yq").show();
									$("div#yj").hide();
								});
								$("#travels").click(function(){
									$("div#yq").hide();
									$("div#yj").show();
								});
								
							// Parallax
							$('.intro-section').parallax({
								imageSrc: 'images/bg-1.jpg',
								speed: 0.2
							});
							$('.services-section').parallax({
								imageSrc: 'images/bg-2.jpg',
								speed: 0.2
							});
							$('.contact-section').parallax({
								imageSrc: 'images/bg-3.jpg',
								speed: 0.2
							});    

							// jQuery Scroll Up / Back To Top Image
							$.scrollUp({
								scrollName: 'scrollUp',      // Element ID
								scrollDistance: 300,         // Distance from top/bottom before showing element (px)
								scrollFrom: 'top',           // 'top' or 'bottom'
								scrollSpeed: 1000,           // Speed back to top (ms)
								easingType: 'linear',        // Scroll to top easing (see http://easings.net/)
								animation: 'fade',           // Fade, slide, none
								animationSpeed: 300,         // Animation speed (ms)		        
								scrollText: '', // Text for element, can contain HTML		        
								scrollImg: true              // Set true to use image		        
							});

							// ScrollUp Placement
							$( window ).on( 'scroll', function() {

							// If the height of the document less the height of the document is the same as the
							// distance the window has scrolled from the top...
							if ( $( document ).height() - $( window ).height() === $( window ).scrollTop() ) {

								// Adjust the scrollUp image so that it's a few pixels above the footer
								$('#scrollUp').css( 'bottom', '80px' );

							} else {      
								// Otherwise, leave set it to its default value.
								$('#scrollUp').css( 'bottom', '30px' );        
							}
							});

							$('.single-page-nav').singlePageNav({
								offset: $('.single-page-nav').outerHeight(),
								speed: 1500,
								filter: ':not(.external)',
								updateHash: true
							});

							$('.navbar-toggle').click(function(){
								$('.single-page-nav').toggleClass('show');
							});

							$('.single-page-nav a').click(function(){
								$('.single-page-nav').removeClass('show');
							});
        
							});
							
							
							
						</script>
</body>
</html>