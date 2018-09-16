<?php
header("Content-Type:text/html;charset=utf-8");
//检测coolie
if(isset($_COOKIE["sid"]))					//cookies+sessionid
{
	//session配置
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//获取sessionid
	error_reporting(0);	
	$path = './temp/';						
	session_save_path($path);				//session路径
	session_start();						//开启会话
	
	if(isset($_SESSION["username"])){		//检测session
		//mysql配置信息
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";
		$un=$_SESSION['username'];
		$tt=$_REQUEST['tt'];
		$ms=$_POST['message'];
		$time=date("Y-m-d h:i:s");
		$sql="INSERT INTO comments VALUES('$un','$tt','$ms','$time')";	
		try {
			//连接数据库
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
			$conn->exec($sql);//执行sql
		}
		catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
		}
	$conn = null;		
	echo "<script>history.go(-1)</script>"; 
	}
	else{
		header("Location:index.php");//跳转到未登陆界面
	}	
}
else{
	header("Location:index.php");	 //自动注销	
}

?>