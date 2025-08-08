<?php
//<meta charset="utf-8">

function SEND_WORD($k,$v){
	$str='';
	if(is_numeric($k)){$k='other';}//キーが数値の時はその他に属する
	if(is_array($v)&&isset($v['type'])){
		$type=$v['type'];
		unset($v['type']);//タイプはもう使わない
	}
	else{
		$type=$k;
	}
	switch($type){
		//共通フォーム
		case 'name':
		$send=array();
		foreach($v as $k2 => $v2){
			if(isset($_REQUEST[$v2])){
				$send[]=$_REQUEST[$v2];
			}
		}
		$send=implode(" ",$send);
		$str=SEND_WORD_TITLE($v[0]).$send.chr(10);
		break;
		case 'textarea':
		$send=isset($_REQUEST[$v[1]])?$_REQUEST[$v[1]]:'';
		$str=SEND_WORD_TITLE($v[0]).chr(10).$send.chr(10);
		break;
		case 'bukken':
		$send=array(1,2);
		foreach($send as $k2 => $v2){
			if(isset($_REQUEST[$v[1].$v2])){
				$send[$k2]=$_REQUEST[$v[1].$v2];
			}
			else{
				unset($send[$k2]);
			}
		}
		$send=implode(" ",$send);
		$str=SEND_WORD_TITLE($v[0]).$send.chr(10);
		break;
		//固有フォーム
		case '住所':
		$send=array($v[1].'_set',$v[3],$v[4]);
		foreach($send as $k2 => $v2){
			if(isset($_REQUEST[$v2])){
				$send[$k2]=$_REQUEST[$v2];
			}
			else{
				unset($send[$k2]);
			}
		}
		$k2=0;
		$str=SEND_WORD_TITLE($k)."
〒 ".$send[$k2++]."
".$send[$k2++].$send[$k2].chr(10);
		break;
		case 'メール':
		$send=isset($_REQUEST[$v[1]])?$_REQUEST[$v[1]]:'';
		$str=SEND_WORD_TITLE($v[0]).$send.chr(10);
		break;
		//--- 以下 特殊 ---
		case 'お気軽試算計画表':
		case '希望：読本':
		//--- 以下 タイプ ---
		case 'tel':
		case 'jikka':
		case 'radio':
		case 'check':
		case 'select':
		case 'date':
		case 'anke':
		case 'anke_first':
		$send=isset($_REQUEST[$v[1].'_set'])?$_REQUEST[$v[1].'_set']:(is_array($_REQUEST[$v[1]])?implode('、',$_REQUEST[$v[1]]):$_REQUEST[$v[1]]);
		if($send==''){break;}
		$str=SEND_WORD_TITLE($v[0]).$send.chr(10);
		break;
		case 'ご希望エリア':
		$send=isset($_REQUEST[$v[1].'_set'])?$_REQUEST[$v[1].'_set']:'';
		if($send==''){break;}
		$str=SEND_WORD_TITLE($v[0]).chr(10).$send.chr(10);
		break;
		case 'ご入居予定人数':
		$send='';
		for($i=0;$i<=1;$i++){
			if(!isset($_REQUEST[$v[1].'-'.$i])){$_REQUEST[$v[1].'-'.$i]='';}
			else{$send.=$_REQUEST[$v[1].'-'.$i];}
		}
		if($send==''){break;}
		$str=SEND_WORD_TITLE($v[0])
.(($_REQUEST[$v[1].'-0']>0)?chr(10).'大人：'.$_REQUEST[$v[1].'-0'].'人':'')
.(($_REQUEST[$v[1].'-1']>0)?chr(10).'子供：'.$_REQUEST[$v[1].'-1'].'人':'')
.chr(10);
		break;
		case '入居予定の家族構成':
		$send='';
		for($i=0;$i<=6;$i++){
			if(!isset($_REQUEST[$v[1].'-'.$i])){$_REQUEST[$v[1].'-'.$i]='';}
			else{$send.=$_REQUEST[$v[1].'-'.$i];}
		}
		if($send==''){break;}
		$str=SEND_WORD_TITLE($v[0]).chr(10).$_REQUEST[$v[1].'-0'].'名'
.(($_REQUEST[$v[1].'-1']!='')?chr(10).'ご本人様：'.$_REQUEST[$v[1].'-1'].'歳':'')
.(($_REQUEST[$v[1].'-2']!='')?chr(10).'配偶者様：'.$_REQUEST[$v[1].'-2'].'歳':'')
.(($_REQUEST[$v[1].'-3']!='')?chr(10).'　お子様：'.$_REQUEST[$v[1].'-3'].'歳':'')
.(($_REQUEST[$v[1].'-4']!='')?chr(10).'　お子様：'.$_REQUEST[$v[1].'-4'].'歳':'')
.(($_REQUEST[$v[1].'-5']!='')?chr(10).'　お子様：'.$_REQUEST[$v[1].'-5'].'歳':'')
.(($_REQUEST[$v[1].'-6']!='')?chr(10).'ご両親様：'.$_REQUEST[$v[1].'-6'].'歳':'')
.(($_REQUEST[$v[1].'-7']!='')?chr(10).'ご両親様：'.$_REQUEST[$v[1].'-7'].'歳':'')
.chr(10);
		break;
		case '自己資金':
		$send=isset($_REQUEST[$v[1]])?$_REQUEST[$v[1]]:'';
		if($send==''){break;}
		$str=SEND_WORD_TITLE($v[0]).$send.'万円位'.chr(10);
		break;
	}
	return $str;
}
function SEND_WORD_TITLE($t){
	return  chr(10)."●".str_replace(array('*','＊'),'',$t)."：";
}
?>

