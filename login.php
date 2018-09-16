<?php
header("Content-Type:text/html;charset=utf-8");
?>

<!DOCTYPE html>
<html>
<title>User login：XXX网站</title>
<!-- for-mobile-apps -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="login, 乐行青春调研团" />
<meta name="description" content="科研立项,乐行青春,网络约伴自助游网站，旅游网站，旅游心得交流，交友"/>
<meta name="author" content="乐行青春"/>
<meta name="generator" content="Notepad++"/>	
<!--提供网页关键字，方便搜索引擎索查找-->

<!-- //for-mobile-apps -->
<link rel="stylesheet" href="css/login.css">
<link href="css/rlstyle.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript"></script>
<script src="js/jquery.min.js"></script>
<script src="js/login.js"></script>


<body>
    <!--被“订”元素,没有被定，除了错误-->
    <div class="pinned" id="pinned">
    <h2 id="code">验证码</h2>
    </div>

<div class="content login_content">
	<h1><strong>用户登录</strong></h1>
		<div class="main">
			<div class="row">
				<form action="login_validate.php" method="post" class="register-form" onsubmit="return test()"><!--这里action未写完-->
					<section class="register-wrapper">
						<div class="wrapper">
							<div class="form-group">
								<div class="controls">
									<label class="control-label">用户名或邮箱</label>
									<input class="form-control" type="text" title="邮箱或用户名！" id="username" name="username" required="required">
								</div>
								<div class="controls">
									<label class="control-label">密码</label><span><a href="#pinned">(找回密码)</a></span>
									<input class="form-control" type="password" title="12-20位数字、字符组合！" id="password" name="password" placeholder="12-20位字母或数字组合" required="required"  pattern="[0-9|A-z]{12,20}"><!--需要写入正则表达式！-->
								</div>
								<div class="controls">
									<label class="control-label">验证码<span onmousedown="get_identifying_code();">(点击显示)</span></label>
									<input class="form-control" type="text" id="identifying_code" name="identifying_code" required="required">
								</div>
							</div>
							<button class="submit"><span>登陆</span></button><!--验证表单-->
							<button class="toRegister"><span><a href="register.php">注册</a></span></button> <!--这个链接需要更改-->
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