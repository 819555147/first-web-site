<?php
/*
 *��ת
 *@param $url Ŀ���ַ
 *@param $info ��ʾ��Ϣ
 *@param $sec �ȴ�ʱ��
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