/*document onload*/
$(function(){
	$(function(){
		$("input").css("color","#999")
	});
	
    $("input[name='username']").focus(function(){
		$(this).css("color","#fff");
	});
	    
	$("input[name='password']").focus(function(){
		$(this).css("color","#fff");
	});
		
	$("input[name='identifying_code']").focus(function(){
		$(this).css("color","#fff");
	});
	
	$("button[class='toRegister']").click(function(){
		window.location.href="register.php"; 
	});
 });  
 
 function get_identifying_code(){	
			code=Math.round(Math.random()*10000);
			document.getElementById('code').innerHTML=code;
		}
 
 /*函数 验证表单*/
 
 function test(){
	 var e=document.getElementById("identifying_code").value;
	 if(e.match(code.toString())){
		 //验证码正确
		 return true;
	 }
	 else {
		 //验证码不正确
		 alert("验证码错误");
		 return false;
	 }
	 
 }