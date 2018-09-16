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
		<p>您的注册申请已提交！审核通过后我们会以邮件形式通知您，请耐心等待。</p>
	</div>
	<a href="register.php">返回</a>
	<a href="login.php">登陆</a>
</body>
</html>
<?php
//处理提交的注册数据
$servername = "localhost";
$username = "root";
$password = "819555147";
$dbname = "web";
if(isset($_POST['sl'])) $sl="'".$_POST['sl']."'";		//学校
if(isset($_POST['sid'])) $sid=$_POST['sid'];			//学工号
if(isset($_POST['password_login']))$pdl="'".$_POST['password_login']."'";	//教务处密码
if(isset($_POST['username'])) $un="'".$_POST['username']."'";				//用户名	
if(isset($_POST['password_two'])) $pd="'".$_POST['password_two']."'";		//登陆密码
if(isset($_POST['email'])) $em="'".$_POST['email']."'";						//邮箱
if(isset($_POST['registerTime'])) $rt="'".$_POST['registerTime']."'";		//注册时间

$sql="SELECT MAX(UID) FROM Login";	

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
	$uid=$responseText[0]['MAX(UID)']+1;
	
	//插入数据库
	$sql="INSERT INTO register VALUES($uid,$un,$sid,$sl,$pd,$pdl,$em,$rt)";
	$conn->exec($sql);
	
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>