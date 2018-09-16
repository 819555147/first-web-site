<!DOCTYPE html>
<html>

<title>User register：一起旅游吧</title>
<!-- for-mobile-apps -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="register, 乐行青春调研团" />
<meta name="author" content="乐行青春"/>
<meta name="generator" content="Notepad++"/>	
<!--提供网页关键字，方便搜索引擎索查找-->

<link rel="stylesheet" href="css/register.css">
<link href="css/rlstyle.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/register.js"></script>
<script>
	//这里需要验证用户输入的注册信息的算法
	
	
	
</script>

<body>
    <!--被“订”元素,没有被定，除了错误-->
    <div class="pinned">
    <h2 id="code">Tips</h2>
    </div>

<div class="content">
	<h1><strong>用户注册</strong></h1>
		<div class="main">
			<div class="row">
				<form action="register_validate.php" method="post" enctype="multipart/form-data" class="register-form" onsubmit="return test()"><!--这里action未写完-->
					<section class="register-wrapper">
						<div class="wrapper">
							<div class="form-group">
								<div class="controls required">
									<label class="control-label" for="sl">学校</label>
									<input class="form-control" type="text" title="学校" id="sl" name="sl" placeholder="如实填写学校名称" required="required"/>
								</div>
								<div class="controls required">
									<label class="control-label" for="sid">学工号</label>
									<input class="form-control" type="text" title="10-16位数字" id="sid" name="sid" placeholder="例如201600800483" pattern="[0-9]{10,16}" required="required"/>
								</div>
								<div class="controls required">
									<label class="control-label" for="password_login">教务处密码（请使用学工号对应的密码）</label>
									<input class="form-control" type="password" title="6-20位数字、字符组合" id="password_login" name="password_login" placeholder="该密码仅用于验证，我们保证不会保存和泄露" pattern="[0-9|A-z|]{6,20}" required="required"/>
								</div>
								<div class="controls required">
									<label class="control-label" for="username">用户名</label>
									<input class="form-control" type="text" title="" id="username" name="username" placeholder="取个适合你的用户名吧" required="required"/>
								</div>
								<div class="controls required">
									<label class="control-label" for="password_one">登陆密码</label>
									<input class="form-control" type="password" title="12-20位数字、字符组合" id="password_one" name="password_one" placeholder="12-20位数字、字符组合" pattern="[0-9|A-z|]{12,20}" required="required"/>
								</div>
								<div class="controls required">
									<label class="control-label" for="password_two">再次输入登陆密码</label>
									<input class="form-control" type="password" title="12-20位数字、字符组合" id="password_two" name="password_two" placeholder="请保证两次输入相同" pattern="[0-9|A-z]{12,20}" required="required"/>
								</div>
								<div class="controls required">
									<label class="control-label" for="email">电子邮箱</label>
									<input class="form-control" type="email" id="email" name="email" placeholder="example@xx.com" required="required"/>
								</div>
								
								<div class="controls required">
									<label class="control-label" for="identifying_code">验证码<span onmousedown="get_identifying_code();">(点击显示)</span></label>
									<input class="form-control" type="text" id="identifying_code" name="identifying_code" required="required"/>
								</div>
								<div class="controls register_time required"> <!--这个被隐藏的标签！-->
									<label class="control-label" for="registerTime">注册时间</label>
									<input class="form-control" type="text" name="registerTime" id="registerTime" required=""/>
								</div>
								<script>document.getElementById("registerTime").value=getRegisterDate();</script> <!--代码放哪里就在那里运行-->
							</div>
							<button class="submit" id="rgtbtn" ><span>注册</span></button>
						
						</div>
					</section>
					
				</form>
			</div> 
		</div>
	<div class="footer">	
	  <p class="copy_rights">&copy; 2017 乐行青春调研团科研立项 | Design by<a href="http://www.baidu.com/"> <strong>乐行青春调研团</strong></a></p>
	  <!--链接网址改一下-->
	</div>
</div>
	
</body>
</html>
