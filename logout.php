<?php
    header('Content-type:text/html;charset=utf-8');
	if(isset($_COOKIE["sid"])){							//��cookies����sessionid
		//�Ự����
		session_id($_COOKIE["sid"]);	
		$sessid=session_id();					//��ȡsessionid
		error_reporting(0);	
		$path = './temp/';						//·������
		session_save_path($path);				//session·��
		session_start();						//�����Ự
	
    
		if(isset($_SESSION['username'])){
			session_unset();//free all session variable
            session_destroy();//����һ���Ự�е�ȫ������
            setcookie(session_name(),'',time()-18000);//������ͻ��˵Ŀ���
            header('location:index.php');
        }else{
            header('location:index.php');
        }
	}
	
?>