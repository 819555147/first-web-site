<!DOCTYPE html>
<!--/*--游记文本编辑器--*/-->
<?php

if(isset($_COOKIE["sid"]))					//用cookies传递sessionid
{
	//会话开启	
	session_id($_COOKIE["sid"]);	
	$sessid=session_id();					//获取sessionid
	error_reporting(0);	
	$path = './temp/';						//路径变量
	session_save_path($path);				//session路径
	session_start();						//开启会话
	
	if(isset($_SESSION["username"])){		//设置session变量
		$tt=$_POST['subject'];				//标题
		//概述
		if(isset($_POST['summary'])){		//如果是处理游记		
			$bool=true;
			$sm=$_POST['summary'];
		}
		if(isset($_POST['invitation_message'])){//如果是处理约伴信息
			$bool=false;
			$sm=$_POST['invitation_message'];
			$dest=$_POST['destination'];
			$t_range=$_POST['timerange'];
			$num=$_POST['numbers'];
		}
		
	}
	else{
		header("Location:index.php");		//跳转到未登录页面
	}	
}
else{
	header("Location:index.php");			//跳转到未登录页面	
}
?>

<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--导入富文本编辑器-->	
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="dist/summernote.css" rel="stylesheet"/>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="dist/summernote.js"></script>
<script src="dist/lang/summernote-zh-CN.js"></script>    <!-- 中文-->

<link href="css/texteditor.css" rel="stylesheet">
<title>富文本编辑器</title>
</head>
<body>
<?php 
if($bool==true)		//游记编辑器
	echo'
		<div id="tit">
			<h2>游记编辑器</h2>
		</div>
		<form action="texteditor_handle.php?tt='.$tt.'&sm='.$sm.'" enctype="multipart/form-data" method="post" onsubmit="return iframeCallback(this, pageAjaxDone)">
		<div id="editor">
			<textarea class="summernote" name="content"></textarea>
		</div>

		<div id="button-wrapper">
			<button id="bt">
				<p>提交</p>
				<div class="fill"></div>
				<div class="fa fa-check"></div>
			</button>
		</div>
		</form>
		
		';
else				//约伴信息编辑器 
	echo'			
<div id="tit">
	<h2>约伴信息编辑器</h2>
</div>
<form action="send_invitation.php?tt='.$tt.'&sm='.$sm.'&dest='.$dest.'&tr='.$t_range.'&nu='.$num.'" enctype="multipart/form-data" method="post" onsubmit="return iframeCallback(this, pageAjaxDone)">
<div id="editor">
	<textarea class="summernote" name="content"></textarea>
</div>

<div id="button-wrapper">
    <button id="bt">
        <p>提交</p>
        <div class="fill"></div>
        <div class="fa fa-check"></div>
    </button>
</div>
</form>
<div id="warn">
	<span class="close">&times;</span>
	温馨提示：请务必在正文内容中提及约游时间、地点、预计花费、组队人数，以及其他必要的信息。
</div>
';	
?>
<!----summernote配置---->
<script>
$(function(){
	$('.summernote').summernote({
        height: 500,
        tabsize: 2,
        lang: 'zh-CN',
		focus: true
    });
	
	$('span.close').click(function(){
		$('#warn').slideUp(1000);
	});
});
</script>

</body>
</html>	