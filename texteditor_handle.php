<?php
/*----��ʱ�Զ�ע��----*/
//�Ự����							
session_id($_COOKIE["sid"]);	
$sessid=session_id();					//��ȡsessionid
error_reporting(0);	
$path = './temp/';						//·������
session_save_path($path);				//session·��
session_start();						//�����Ự
					
if(isset($_COOKIE["sid"])){
	if(isset($_SESSION["username"])){		 
		//�������ݿ�
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";

		$un=$_SESSION['username'];			//��ȡ�û���
		$tt=$_REQUEST['tt'];				//��ȡ�μǱ���
		$sm=$_REQUEST['sm'];				//��ȡ�μǸ���

		$t=date('Y-m-d',time());			//��ȡ�μ�����ʱ��
		$ct=$_REQUEST['content'];			//��ȡ�μ���������
		
		$sql="SELECT imgsrc FROM essay Order By startDate DESC limit 0,1";
		//��Ӧ��ֱ��insert into essay
		try {
			//�������ݿ�
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
			$integer=($integer+1)%4;				//���Ըı�����
			$str=strval($integer);
			$ic=substr_replace($ic,$str.".jpg",$index-1);	//���ϣ�����ͼƬ·����
			
			$sql="INSERT INTO essay(Username, Title, Content, summary, startDate,imgsrc) VALUES ('$un','$tt','$ct','$sm',
			'$t','$ic')";							
			//ִ��
			$conn->exec($sql);
			}	
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
			}
		$conn = null;
		header("Location:travels.php?un=$un&tt=$tt");				//��ת��δ��¼ҳ��
	}
	else {
		echo "<script>
				if(confirm('�˺���ע���������µ�¼')==true) 	
					window.location.href='login.php';
			  </script>";					
	}
	}else {
		echo "<script>
				if(confirm('�˺��ѵ�½��5h��ϵͳ�Զ�ע���������µ�¼��')==true)
					window.location.href='login.php';
			  </script>";				
	}	
?>