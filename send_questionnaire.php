<?php
session_id($_COOKIE["sid"]);	
$sessid=session_id();					//获取sessionid
error_reporting(0);	
$path='./temp/';						//路径变量
session_save_path($path);				//session路径
session_start();						//开启会话
$un=$_SESSION["username"];				//用户名
try {
	$servername = "localhost";
	$username = "root";
	$password = "819555147";
	$dbname = "web";
	//链接数据库
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//录入数据库！！！
	function convert($num){
		if($num==1)
			return 'A';
		else if($num==2)
			return 'B';
		else if($num==3)
			return 'C';
		else if($num==4)
			return 'D';
		else if($num==5)
			return 'E';
		else if($num==6)
			return 'F';
		else if($num==7)
			return 'G';
		else if($num==8)
			return 'H';
		else if($num==9)
			return 'I';
		else if($num==10)
			return 'J';
		else 
			return 'K';
	}
	$q1=$_REQUEST['q1'];
	$q1=convert($q1);
	
	$q2=$_REQUEST['q2'];
	$q2=convert($q2);
	
	$q3=$_REQUEST['q3'];
	$q3=convert($q3);
	
	$q4=$_REQUEST['q4'];
	$q4=convert($q4);
	
	$q5=$_REQUEST['q5'];
	$q5=convert($q5);
	
	$q6=$_REQUEST['q6'];
	$q6=convert($q6);
	
	$q7=$_REQUEST['q7'];
	$q7=convert($q7);
	
	$q8=$_REQUEST['q8'];
	$q8=convert($q8);
	
	$q9=convert($_REQUEST['q9'][0]);
	for($i=1;$i<count($_REQUEST['q9']);$i++){
		$q9=$q9.convert($_REQUEST['q9'][$i]);
	}
	
	$q10=$_REQUEST['q10'];
	$q10=convert($q10);
	
	$q11=$_REQUEST['q11'];
	$q11=convert($q11);
		
	$q12=$_REQUEST['q12'];
	$q12=convert($q12);
	
	$q13=$_REQUEST['q13'];
	$q13=convert($q13);
	
	$q14=$_REQUEST['q14'];
	$q14=convert($q14);
	
	$q15=$_REQUEST['q15'];
	$q15=convert($q15);
	
	$q16=$_REQUEST['q16'];
	$q16=convert($q16);
	
	//选项插入Matchmaking表
	$sql="INSERT INTO Matchmaking VALUES('$un','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10'
	,'$q11','$q12','$q13','$q14','$q15','$q16')";
	$conn->exec($sql);
	
	//更新Users表
	$sql="UPDATE Users SET IsQuestionnaire=1 WHERE Username='$un'";
	$conn->exec($sql);
	
	//自动匹配的实现：每个新填写问卷的用户与之前用户匹配！！！
	//注意效率问题，过多的用户导致匹配时间增加
	//bug:一次最多只能查到5个元组，应该使用游标
	$sql="SELECT *FROM Matchmaking WHERE Username!='$un'";
	$res=$conn->query($sql);
	$responseText = array();  
	foreach($res as $row)   
	{            
		$responseText[] = $row;      
	}
	$ppd=72;					//默认起始匹配度
	for($i=0;$i<count($responseText);$i++){
		$oq1=$responseText[$i]['Item1'];
		$oq2=$responseText[$i]['Item2'];
		$oq3=$responseText[$i]['Item3'];
		$oq6=$responseText[$i]['Item6'];
		$oq8=$responseText[$i]['Item8'];
		$oq12=$responseText[$i]['Item12'];
		$oq13=$responseText[$i]['Item13'];
		$oq15=$responseText[$i]['Item15'];
		$oun=$responseText[$i]['Username'];
		//第一题
		if($q1=='A'||$q1=='B'||$q1=='C'){
			if($oq1=='A'||$oql=='B'||$oql=='C'){
				$ppd += 0.5;
			}
			else{
				$ppd -= 1;
			}
		}
		else {
			if($oq1=='A'||$oql=='B'||$oql=='C'){
				$ppd -= 1;
			}
			else{
				$ppd += 0.5;
			}
		}
		//-- end 第一题
		//第二题
		if($q2=='A'||$q2=='B'){
			if($oq2=='A'||$oq2=='B'){
				$ppd += 1.5;
			}
			else if($oq2=='C'||$oq2=='D'){
				$ppd += 1;
			}
			else {
				$ppd -= 2.5;
			}
		}
		else if($q2=='C'||$q2=='D'){
			if($oq2=='C'||$oq2=='D'){
				$ppd += 1;
			}
			else if($oq2=='A'||$oq2=='B'){
				$ppd += 0.5;
			}
			else {
				$ppd += 0.5;
			}
		}
		else{
			if($oq2=='A'||$oq2=='B'){
				$ppd -= 2;
			}
			else if($oq2=='C'||$oq2=='D'){
				$ppd -= 1.5;
			}
			else {
				$ppd += 1;
			}
		}
		//第三题
		if($q3=='A'||$q3=='B'){
			if($oq3=='A'||$oq3=='B'){
				$ppd += 1;
			}
			else if($oq3=='C'){
				$ppd += 0.5;
			}
			else {
				$ppd -= 1.5;
			}			
		}
		else if($q3=='C'){
			if($oq3=='A'||$oq3=='B'){
				$ppd -= 1;
			}
			else if($oq3=='C'){
				$ppd += 1;
			}
			else {
				$ppd += 0.5;
			}
		}
		else{
			if($oq3=='A'||$oq3=='B'){
				$ppd -= 1;
			}
			else if($oq3=='C'){
				$ppd += 1;
			}
			else {
				$ppd -= 1.5;
			}
		}
		//第六题，性格相冲的减分，性格相容的加分
		if($q6=='A'){
			if($oq6=='D'){
				$ppd += 1;
			}
			else if($oq6=='B'){
				$ppd += 0.5;
			}
			else if($oq6=='C'){
				$ppd -= 1.5;
			}
			else {
				$ppd -= 1.5;
			}
		}
		else if($q6=='B'){
			if($oq6=='D'){
				$ppd += 1;
			}
			else if($oq6=='B'){
				$ppd += 0.5;
			}
			else if($oq6=='C'){
				$ppd += 0.5;
			}
			else {
				$ppd += 0.5;
			}
		}
		else if($q6=='C'){
			if($oq6=='D'){
				$ppd -= 1.5;
			}
			else if($oq6=='B'){
				$ppd += 0.5;
			}
			else if($oq6=='C'){
				$ppd += 1;
			}
			else {
				$ppd += 0.5;
			}
		}
		else {
			if($oq6=='D'){
				$ppd -= 2;
			}
			else if($oq6=='B'){
				$ppd += 0.5;
			}
			else if($oq6=='C'){
				$ppd += 1;
			}
			else {
				$ppd += 1;
			}
		}
		
		//第八题
		if($q8=='A'||$q8=='G'){
			if($oq8=='A'||$oq8=='G'){//小城
				$ppd += 1;
			}
			else if($oq8=='B'||$oq8=='C'){	//都市
				$ppd += 0.5;
			}
			else{//民俗，自然风光
				$ppd += 0.5;
			}
			
		}
		else if($q8=='D'||$q8=='F'||$q8=='H'){
			if($oq8=='A'||$oq8=='G'||$oq8=='E'){//小城，自然风光
				$ppd += 1;
			}
			else if($oq8=='D'||$oq8=='F'||$oq8=='H'){//民俗
				$ppd += 1.5;
			}
			else{	//都市
				$ppd += 0.5;
			}
		}
		else if($q8=='B'||$q8=='C'){
			if($oq8=='B'||$oq8=='C'){//都市
				$ppd += 1.5;
			}
			else{
				$ppd += 1;
			}			
		}
		
		//十二题
		if($q12=='A'){
			if($oq12=='A')
				$ppd += 1;
		}
		else {
			$ppd +=	0.5;
		}
		
		//十三题
		if($q13=='A'){
			if($oq13=='A'){
				$ppd += 1.5;
			}
			else if($oq13=='B'){
				$ppd += 1;
			}
			else if($oq13=='C'){
				$ppd += 1;
			}
			else{
				$ppd += 0.5;
			}
		}
		else if($q13=='B'){
			if($oq13=='A'){
				$ppd += 1.1;
			}
			else if($oq13=='B'){
				$ppd += 1.5;
			}
			else if($oq13=='C'){
				$ppd += 1.5;
			}
			else{
				$ppd += 0.5;
			}
		}
		else if($q13=='C'){
			if($oq13=='A'){
				$ppd += 0.5;
			}
			else if($oq13=='B'){
				$ppd += 1.2;
			}
			else if($oq13=='C'){
				$ppd += 1.5;
			}
			else{
				$ppd += 1.2;
			}
		}
		else {
			if($oq13=='A'){
				$ppd += 0.5;
			}
			else if($oq13=='B'){
				$ppd += 1;
			}
			else if($oq13=='C'){
				$ppd += 1.5;
			}
			else{
				$ppd += 1;
			}
		}
		//十五题
		if($q15=='A'){
			if($oq15=='A')
			{
				$ppd += 1.5;
			}
			else if($oq15=='B'||$oq15=='C'||$oq15=='D'){
				$ppd += 1;
			}
			else if($oq15=='E'||$oq15=='F'){
				$ppd += 1;
			}
			else {
				$ppd += 0.5;
			}
		}
		else if($q15=='B'){
			if($oq15=='A')
			{
				$ppd += 1;
			}
			else if($oq15=='B'){
				$ppd += 1.5;
			}
			else if($oq15=='C'||$oq15=='D'){
				$ppd += 1.2;
			}
			else if($oq15=='E'||$oq15=='F'){
				$ppd += 1.2;
			}
			else {
				$ppd += 0.5;
			}
		}
		else if($q15=='C'){
			if($oq15=='A')
			{
				$ppd += 0.5;
			}
			else if($oq15=='B'||$oq15=='D'){
				$ppd += 1;
			}
			else if($oq15=='C'){
				$ppd += 1.5;
			}
			else if($oq15=='E'||$oq15=='F'){
				$ppd += 1;
			}
			else {
				$ppd += 0.5;
			}
		}
		else if($q15=='D'||$q15=='E'){
			if($oq15=='A')
			{
				$ppd += 0.5;
			}
			else if($oq15=='B'||$oq15=='C'){
				$ppd += 1;
			}
			else if($oq15=='D'||$oq15=='E'){
				$ppd += 1.5;
			}
			else if($oq15=='F'){
				$ppd += 1.8;
			}
			else {
				$ppd += 1;
			}
		}
		else if($q15=='F'){
			if($oq15=='A')
			{
				$ppd += 0.5;
			}
			else if($oq15=='B'||$oq15=='C'){
				$ppd += 1;
			}
			else if($oq15=='D'||$oq15=='E'){
				$ppd += 1;
			}
			else if($oq15=='F'){
				$ppd += 1.5;
			}
			else {
				$ppd += 1;
			}
		}
		else {
			if($oq15=='A')
			{
				$ppd += 0.5;
			}
			else if($oq15=='B'||$oq15=='C'){
				$ppd += 1;
			}
			else if($oq15=='D'||$oq15=='E'){
				$ppd += 1.5;
			}
			else if($oq15=='F'){
				$ppd += 1.6;
			}
			else {
				$ppd += 3.5;
			}
		}
		if($ppd>97)		//匹配度上限
			$ppd = 97;
		if($ppd <65)	//下限
			$ppd = 65;
		
		$sql="INSERT INTO Matches VALUES('$un','$oun','$ppd')";
		$conn->exec($sql);		
	}
	
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
$conn = null;
 //最后返回个人中心
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="匹配问卷" />
<?php
	echo "<meta http-equiv=\"Refresh\" content=\"5; url=personal_center.php\"/> "; 
?>
<title>问卷发送</title>
<style>
	div {
		padding-top:10px;
		padding-left:10px;
		font-size:1.5em;
		font-weight:500;
	}
	a:link,a:visited {
		color:black;
		font-weight:800;
	}
	a:hover,a:active{
		color:white;
		background-color:black;
		font-weight:800;
	}
</style>
</head>
<body>
	<div>问卷填写成功，5s后返回<a href="Personal_center.php" title="点击立即返回">个人中心</a></div>
</body>
</html>