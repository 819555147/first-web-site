<?php
if(isset($_COOKIE["sid"])){
	//开启会话
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//获取sessionid
	error_reporting(0);	
	$path = './temp/';						//session存储路径
	session_save_path($path);				//自定义session存储路径
	session_start();						//开启会话
	
	if(isset($_SESSION["username"])){
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";
		$un='"'.$_SESSION['username'].'"';
		$un_ = $_SESSION['username'];
		
		$sql="SELECT Username,Email,QQ,Wechat FROM login WHERE Username=$un";	
		try {
			//连接数据库
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	
			$res=$conn->query($sql);					//执行查询
			$responseText = array();  
			foreach($res as $row)   
			{		            
				$responseText[] = $row;      
			}
			$un1=$responseText[0]['Username'];
			$em1=$responseText[0]['Email'];
			if(isset($responseText[0]['QQ']))$qq1=$responseText[0]['QQ'];
			if(isset($responseText[0]['Wechat']))$wc1=$responseText[0]['Wechat'];			//获取用户2（参与者）所有联系方式
			
			
			$tt=$_COOKIE['title'];
			$ar=$_COOKIE['author'];						//获取作者
			$sql="SELECT Email,QQ,Wechat FROM login WHERE Username="."'".$ar."'";
			$res=$conn->query($sql);					//执行查询
			$responseText = array();  
			foreach($res as $row)   
			{		            
				$responseText[] = $row;      
			}
			$em2=$responseText[0]['Email'];
			if(isset($responseText[0]['QQ']))$qq2=$responseText[0]['QQ'];
			if(isset($responseText[0]['Wechat']))$wc2=$responseText[0]['Wechat'];			//获取用户1（发起者）所有联系方式
			
			
			if($ar!=$un_)
			{
				$time=date("Y-m-d h:i:s");
				$sql="INSERT INTO connection VALUES('$ar','$un_','$tt','$time')";	
				$conn->exec($sql);										//插入数据
				
				if(isset($_POST['contact'][0])&&isset($qq1)&&isset($qq2)){//QQ
					$q=true;
				}
				if(isset($_POST['contact'][1])&&isset($wc1)&&isset($wc2)){//wechat
					$w=true;
					
				}
				if(isset($_POST['otherContact'])){//otherContact
					$o=true;
				}
				
				/*----发送两份信件，内容组织一下语言----*/
				$to = $em2;			
				$subject = "交换联系方式";	
				$message = "您好，这位用户对您的约伴游感兴趣，这是他/她的联系方式：".($q==true?" QQ：".$qq1:"").($w==true?" 微信：".$wc1:"").(" 邮箱：".$em1).($o==true?" 其他联系方式：".$_POST['otherContact']:"");
				$from = "LeeYunhow@qq.com";
				$headers = "From: $from";
				if(mail($to,$subject,$message,$headers))			//这里的业务逻辑其实不完善，如果发送邮件失败？需要如何？？
					echo "Mail Sent successfully 1.<br/>";
				else
					echo "fail to Mail send 1.<br/>";
				$to = $em1;
				$message = "您好，这是伴游发起者的联系方式：".($q==true?" QQ：".$qq2:"").($w==true?" 微信：".$wc2:"").(" 邮箱：".$em2);
				if(mail($to,$subject,$message,$headers))
					echo "Mail Sent successfully 2.<br/>";
				else
					echo "fail to Mail send 2.<br/>";
				include "jump.php";
				jump("square.php#start","5s后跳转",5);
			}
			else {
				echo "<script>
						alert('这是您自己发起的伴游，您不必申请加入！');			
						window.location.href='square.php';
					  </script>";
			}
		}	
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;		
			
			
	}else {
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
