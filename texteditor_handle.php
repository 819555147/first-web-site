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
		//连接数据库
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";

		$un=$_SESSION['username'];			//获取用户名
		$tt=$_REQUEST['tt'];				//获取游记标题
		$sm=$_REQUEST['sm'];				//获取游记概述

		$t=date('Y-m-d',time());			//获取游记生成时间
		$ct=$_REQUEST['content'];			//获取游记正文内容
		
		$sql="SELECT imgsrc FROM essay Order By startDate DESC limit 0,1";
		//不应该直接insert into essay
		try {
			//链接数据库
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{		            
				$responseText[] = $row;      
			}
			$ic=$responseText[0]['imgsrc'];
			$index=strpos($ic,".jpg");
			$str=mb_substr($ic, $index-1, 1,"utf-8");
			$integer=intval($str);
			$integer=($integer+1)%4;				//可以改变数字
			$str=strval($integer);
			$ic=substr_replace($ic,$str.".jpg",$index-1);	//以上，处理图片路径名
			
			$sql="INSERT INTO essay(Username, Title, Content, summary, startDate,imgsrc) VALUES ('$un','$tt','$ct','$sm',
			'$t','$ic')";							
			//执行
			$conn->exec($sql);
			}	
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
			}
		$conn = null;
		header("Location:travels.php?un=$un&tt=$tt");				//跳转到未登录页面
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