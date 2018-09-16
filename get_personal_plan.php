<?php
/*
	定制的个性化约伴游
	根据用户所填选项提供符合的游记，方便用户
*/
header("Content-Type:text/html;charset=utf-8");
$servername = "localhost";
$username = "root";
$password = "819555147";
$dbname = "web";
session_id($_COOKIE["sid"]);	
$sessid=session_id();					//获取sessionid
error_reporting(0);	
$path = './temp/';						//路径变量
session_save_path($path);				//session路径
session_start();						//开启会话

$start_date=$_REQUEST['sd'];			//开始日期
$end_date=$_REQUEST['ed'];				//终止日期
$min_num=$_REQUEST['minn'];				//最小人数
$max_num=$_REQUEST['maxn'];				//最大人数
if(isset($_REQUEST['dest'])) $dest=$_REQUEST['dest'];	//目的地
$un=$_SESSION['username'];

$sql="SELECT Username,Title,Destination,min_number,max_number,Content,startDate,endDate FROM invitation,Matches WHERE Username=(User1 OR Username =User2) AND Matches>90 AND Username!='$un' AND min_number>=$min_num AND max_number<=$max_num AND startDate>='$start_date' AND endDate<='$end_date'".(isset($dest)?(" AND Destination LIKE '%$dest%' "):"")."limit 0,4";
//查询日期和人数范围都在指定区间的约伴游，切不是自己发的
//还有关键的匹配度别忘了，低匹配度的也不予推荐
//最多只提供最新的五个约伴游,ORDER BY theDate DESC需要么？还是By别的
//另外地点怎么办？？？Destination LIKE '%$dest%	
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$res=$conn->query($sql);
	$responseText = array();  
	foreach($res as $row)   
	{            
		$responseText[] = $row;      
	}
	
	for($i=0;$i<count($responseText);$i++){
		echo '<div class="blocks">
				<h2>'.$responseText[$i]['Title'].'</h2>
				<p>
					'.$responseText[$i]['Content'].'
				</p>
				<span class="date_range">日期：'.$responseText[$i]['startDate'].'至'.$responseText[$i]['endDate'].'</span>
				<span class="destination"> 地点：'.$responseText[$i]['Destination'].'</span>
				<span class="numbers"> 人数：'.$responseText[$i]['min_number'].'至'.$responseText[$i]['max_number'].'人</span>
				<span class="ar">发起者：'.$responseText[$i]['Username'].'</span>';
		echo '<div class="bt" onclick="document.getElementById(\'contactChooser\').style.display=\'block\';
				document.cookie=\'title=\'+document.getElementById(\'tt\').innerText;document.cookie=\'author=\'+document.getElementById(\'ar\').innerText;"><span>我要参加</span></div> 	
				<div class="joinin">	点击按钮我们会将您的联系方式发送给伴游发起者，你可以决定发送何种联系方式，而你也会获得伴游发起者的相应联系方式，以实现进一步交流。
				</div>
			  </div>';
	}
	if(count($responseText)==0){
		echo "<h2>也许是您的条件太严苛了，我们找不到匹配的约伴游信息╥﹏╥...，试试降低要求吧，你这样会没朋友的
		┑(￣Д ￣)┍</h2>";
	}
	
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
$conn = null;





?>