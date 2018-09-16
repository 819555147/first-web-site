<?php 
header('content-type:text/html;charset=utf-8');  

$servername = "localhost";
$username = "root";
$password = "819555147";
$dbname = "web";
if(isset($_GET['un']))$un=$_GET['un'];
if(isset($_GET['tt'])) $tt=$_GET['tt'];

$sql="SELECT Content,img,theDate FROM invitation WHERE Username = $un AND Title = $tt ";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$res=$conn->query($sql);
	 	 
	$responseText = array();  
    foreach($res as $row)   
    {            
      $responseText[] = $row;      
    }      
	echo "<h2 id='tt'>";
	echo substr($tt,1,strlen($tt)-2);	//去掉引号
	echo "</h2>";
	echo "<a id='author' href='personal_center.php?un=".substr($un,1,strlen($un)-2)."'><span id='ar'>";		
	echo substr($un,1,strlen($un)-2);	//去掉引号
	echo "</span></a>";
	echo $responseText[0]['Content'];
	echo "<div id='td'>发布时间：".$responseText[0]['theDate']."</div>";
	echo "@#$%^";						//分隔符@#$%^，用于分割图片地址和文本内容
	echo $responseText[0]['img'];	
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>