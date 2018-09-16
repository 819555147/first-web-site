<?php
/*
 *跳转
 *@param $url 目标地址
 *@param $info 提示信息
 *@param $sec 等待时间
 *return void
*/
function jump($url,$info=null,$sec=3)
{
 if(is_null($info)){
  header("Location:$url");
 }else{
  //header("Refersh:$sec;URL=$url");
  echo"<meta http-equiv=\"refresh\" content=".$sec.";URL=".$url.">";
  echo $info;
 }
 die;
}
?>