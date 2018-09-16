	/*注册单js特效---匿名函数*/
 $(function(){
	//css配置
	$(function(){
		$("input").css("color","#999")
	});
	
	$("input[name='sl']").focus(function(){
		$(this).css("color","#fff");
	});
	
	$("input[name='sid']").focus(function(){
		$(this).css("color","#fff");
	});
	
	$("input[name='password_login']").focus(function(){
		$(this).css("color","#fff");
	});
	
    $("input[name='username']").focus(function(){
		$(this).css("color","#fff");
	});
	
	$("input[name='password_one']").focus(function(){
		$(this).css("color","#fff");
	});
	
	$("input[name='password_two']").focus(function(){
		$(this).css("color","#fff");
	});
	
	$("input[name='email']").focus(function(){
		$(this).css("color","#fff");
	});
	
	$("input[name='identifying_code']").focus(function(){
		$(this).css("color","#fff");
	});
     
	// 
	     
	 
	 
	 
	
 });  
  

	/*获取注册时间用于其他数据（用户名等）一并提交---函数，这里已经写完获取时间的函数但是还要写将数据提交的代码*/
  function getRegisterDate(){
	var register_date = new Date();
    var theDate = register_date.getFullYear() +"."+(register_date.getMonth()+1)+"."+register_date.getDate();
    return theDate;		
  };


  var code;
  function get_identifying_code(){
			code=Math.round(Math.random()*10000);
			document.getElementById('code').innerHTML=code;
	}
	
 /*函数 验证表单*/
  function test(){
	 //获取表单数据
	 //var sl=$("#sl").val();					//学校
	 //var sid=$("#sid").val();				//学工号
	 //var pdl=$("#password_login").val();	//教务处密码
	 //var un=$("#username").val();			//用户名
	 var pd=$("#password_two").val();		//登陆密码
	 var ic=$("#identifying_code").val();	//验证码
	 //var em=$("#email").val();				//邮箱
	


	//验证密码
	 if(pd.match(document.getElementById("password_one").value.toString())){
		//alert('密码一致!');
		if(ic.match(code.toString())){
			alert("注册申请已提交，请等待审核。");
				
			return true;
		}
		else {//验证码不对
			alert('验证码不正确!');
			return false;	
	 
		}
	 }
	 else {//两次密码不一致
		alert('两次密码不一致!');
		return false;
	 }
	 
	 //验证码
	 
	 
	 
 }