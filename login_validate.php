<?php
header("Content-Type:text/html;charset=utf-8");
/*
该用ajax避免跳转！！！！
*/
include 'jump.php';

$servername = "localhost";
$username = "root";
$password = "819555147";
$dbname = "web";
if(isset($_POST['username'])) {
	$un="'".$_POST['username']."'";		//用户名或邮箱
	$un1=$_POST['username'];
}	
	//用户名或邮箱
if(isset($_POST['password'])) {
	$pd="'".$_POST['password']."'";		//密码
	$pd1=$_POST['password'];
}	
$sql="SELECT Username,Email,Password FROM Login WHERE Username=$un OR Email=$un";	

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
	$un2=$responseText[0]['Username'];
	$em=$responseText[0]['Email'];
	$pd2=$responseText[0]['Password'];
	if(($un1==$un2||$un1==$em)&&$pd1==$pd2){//通过登陆验证，开启会话
		error_reporting(0);
		$path = './temp/';
		session_save_path($path);
		session_start();			//开启会话
		$sess_name = session_name();
		$sess_id = session_id();
		setcookie("sid", $sess_id, time()+18000);	//五小时过期
		if($un1==$un2){
			setcookie("username", $_POST['username'], time()+3600);
			$_SESSION["username"]=$_POST['username'];	//设置session变量
			$_SESSION["email"]=$em;
		}
		else {//if($un1==$em){
			$_SESSION["email"]=$_POST['username'];
			$_SESSION["username"]=$un2;
		}
		
		jump("index_loged.php",null,0);
	}
	else if($pd1!=$pd2){
		jump("login.php","密码错误，2s后跳转到登陆界面",2);
	}
	else{
		jump("login.php","用户名或邮箱错误，2s后跳转到登陆界面",2);
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;	
?>
<!doctype html>
<html>
<head>
	<title>中转页面</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		<!--这个页面简单布置一下-->
		
	</style>
</head>
<body>
	<div>
		
	</div>
	<a href="login.php">立即返回</a>
	
</body>
</html>
<?php

?>
