<?php
if(isset($_COOKIE["sid"]))							//��cookies����sessionid
{
	//�Ự����
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//��ȡsessionid
	error_reporting(0);	
	$path = './temp/';						//·������
	session_save_path($path);				//session·��
	session_start();						//�����Ự
	
	if(isset($_SESSION["username"])){		//����session����
		//�������ݿ�
		$servername = "localhost";
		$username = "root";
		$password = "819555147";
		$dbname = "web";
		$unn="'".$_SESSION["username"]."'"; //�û���
				
		$sql="SELECT UID FROM Login WHERE Username=$unn";	
		try {
		//�������ݿ�
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
			/*--��ѯuid--*/
			$res=$conn->query($sql);
			$responseText = array();  
			foreach($res as $row)   
			{            
				$responseText[] = $row;      
			}
			$uid=$responseText[0]['UID'];
			$un=$_SESSION["username"];
			$tt=$_REQUEST['tt'];				//��ȡԼ�����
			$dest=$_REQUEST['dest'];			//��ȡԼ��ص�
			$time_range=explode('>', $_REQUEST['tr']);		//��ȡԼ��ʱ�䷶Χ
			$std=$time_range[0];
			$end=$time_range[1];
			
			$nu=explode('-',$_REQUEST['nu']);				//��ȡԼ��������Χ
			$min=$nu[0];
			$man=$nu[1];
			
			$sm=$_REQUEST['sm'];				//��ȡԼ�����
			$t=date('Y-m-d',time());			//��ȡ����ʱ��
			$ct=$_REQUEST['content'];			//��ȡԼ����������
			//var_dump($time_range);
			//var_dump($nu);
			
			/*--��ѯͼƬ·��--*/
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
			$integer=($integer+1)%3;						//���Ըı�����
			$str=strval($integer);
			$ic=substr_replace($ic,$str.".jpg",$index-1);	//���ϣ�����ͼƬ·����
			
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
		//����Σ�
		header("Location:index.php");//��ת��δ��¼ҳ��
	}	
}
else{
	header("Location:index.php");//��ת��δ��¼ҳ��	
}

?>