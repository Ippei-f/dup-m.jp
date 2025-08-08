<?php
//<meta charset="utf-8">
function SEND_WORD_2023($k,$v){
	$str='';
	$v[0]=str_replace('*','',$v[0]);
	if($v[0]==''){$v[0]=$k;}
	switch($v[1]){
		//==========
		case 'name':
		$str=chr(10)."●".$v[0]."：".$_REQUEST[$v[2].'1']."　".$_REQUEST[$v[2].'2'].chr(10);
		break;
		//==========
		case 'tel':
		$str=chr(10)."●".$v[0]."：".$_REQUEST[$v[2].'1']."-".$_REQUEST[$v[2].'2']."-".$_REQUEST[$v[2].'3'].chr(10);
		break;
		//==========
		case 'mail':
		$str=chr(10)."●".$v[0]."：".$_REQUEST['mail'].chr(10);
		break;
		//==========
		case 'pos':
		$str=chr(10)."●".$v[0]."：".$_REQUEST[$v[2].'1']."-".$_REQUEST[$v[2].'2'].chr(10);
		break;
		//==========
		case 'text':
		switch($k){
			case '住所':
			$str=chr(10)."●".$v[0]."：".$_REQUEST['addr'].$_REQUEST['banchi'].chr(10);//メールでは番地と統合する。
			break;
			case '番地'://住所と統合するため、表示しない
			break;
			default:
			$str=chr(10)."●".$v[0]."：".$_REQUEST[$v[2]].chr(10);
		}
		break;
		//==========
		case 'ymd':
		$str=chr(10).'●'.$v[0].'：'.$_REQUEST[$v[2].'1'].'年 '.$_REQUEST[$v[2].'2'].'月 '.$_REQUEST[$v[2].'3'].'日'.chr(10);
		break;
		//==========
		case 'ninzuu':
		$str=chr(10)."●".$v[0]."：
　大人…".$_REQUEST[$v[2].'1']."名
　子供…".$_REQUEST[$v[2].'2']."名".chr(10);
		break;
		//==========
		case 'bukken':
		$str=chr(10)."●".$v[0]."：".$_REQUEST[$v[2].'1']."…".$_REQUEST[$v[2].'2'].chr(10);
		break;
		//==========
		case 'checkbox':
		if (isset($_REQUEST[$v[2]]) && is_array($_REQUEST[$v[2]])){$con=implode("、",$_POST[$v[2]]);}
		$str=chr(10)."●".$v[0]."：".$con.chr(10);
		break;
		//==========
		case 'radio':
		$str=chr(10)."●".$v[0]."：".$_REQUEST[$v[2]].chr(10);
		switch($_REQUEST[$v[2]]){
			case '予約しない':
			case '':
			break;
			default:
			$str.="　ご希望日……".$_REQUEST['yoyaku_date']."
　ご希望時間…".$_REQUEST['yoyaku_time'].chr(10);
		}
		break;
		//==========
		case 'textarea':
		$str=chr(10)."●".$v[0]."：".$_REQUEST[$v[2]].chr(10);
		break;
		//==========
	}
	return $str;
}
?>