<?php
    header('Content-type:text/html;charset=utf-8');
	if(isset($_COOKIE["sid"])){							//用cookies传递sessionid
		//会话开启
		session_id($_COOKIE["sid"]);	
		$sessid=session_id();					//获取sessionid
		error_reporting(0);	
		$path = './temp/';						//路径变量
		session_save_path($path);				//session路径
		session_start();						//开启会话
	
    
		if(isset($_SESSION['username'])){
			session_unset();//free all session variable
            session_destroy();//销毁一个会话中的全部数据
            setcookie(session_name(),'',time()-18000);//销毁与客户端的卡号
            header('location:index.php');
        }else{
            header('location:index.php');
        }
	}
	
?>