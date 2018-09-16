<?php
if(isset($_COOKIE["sid"]))							//用cookies传递sessionid
{
	//会话开启
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//获取sessionid
	error_reporting(0);	
	$path = './temp/';						//路径变量
	session_save_path($path);				//session路径
	session_start();						//开启会话
	
	if(isset($_SESSION["username"])){		//设置session变量
		//连接数据库
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";
		$unn="'".$_SESSION["username"]."'"; //用户名
				
		$sql="SELECT UID FROM Login WHERE Username=$unn";	
		try {
		//链接数据库
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
			/*--查询uid--*/
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{            
				$responseText[] = $row;      
			}
			$uid=$responseText[0]['UID'];
			$un=$_SESSION["username"];
			$tt=$_REQUEST['tt'];				//获取约伴标题
			$dest=$_REQUEST['dest'];			//获取约伴地点
			$time_range=explode('>', $_REQUEST['tr']);		//获取约伴时间范围
			$std=$time_range[0];
			$end=$time_range[1];
			
			$nu=explode('-',$_REQUEST['nu']);				//获取约伴人数范围
			$min=$nu[0];
			$man=$nu[1];
			
			$sm=$_REQUEST['sm'];				//获取约伴概述
			$t=date('Y-m-d',time());			//获取生成时间
			$ct=$_REQUEST['content'];			//获取约伴正文内容
			//var_dump($time_range);
			//var_dump($nu);
			
			/*--查询图片路径--*/
			$sql="SELECT img FROM invitation Order By theDate DESC limit 0,1";
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{		            
				$responseText[] = $row;      
			}
			$ic=$responseText[0]['img'];
			$index=strpos($ic,".jpg");
			$str=mb_substr($ic, $index-1, 1,"utf-8");
			$integer=intval($str);
			$integer=($integer+1)%3;						//可以改变数字
			$str=strval($integer);
			$ic=substr_replace($ic,$str.".jpg",$index-1);	//以上，处理图片路径名
			
			$sql="INSERT INTO invitation(UID, Username, Title,Destination,startDate,endDate,min_number,max_number, Content, summary, theDate,img) VALUES ($uid,'$un','$tt','$dest','$std','$end','$min','$man','$ct','$sm','$t','$ic')";
			
			$conn->exec($sql);
		}
		catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
		}
	$conn = null;
	header("Location:square.php#start");
	}
	else{
		//该如何？
		header("Location:index.php");//跳转到未登录页面
	}	
}
else{
	header("Location:index.php");//跳转到未登录页面	
}

?>