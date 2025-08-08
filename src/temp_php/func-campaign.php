<?php
//<meta charset="utf-8">

function CAMPAIGN_MAINPIC($prm=array()){
	global $dir;
	$f=($prm['mainpic']!='')?$prm['mainpic']:'mainpic';
	$extension=($prm['extension']!='')?$prm['extension']:'png';
	$url_pc=$dir.$f.'.'.$extension;
	$url_sp=$dir.$f.'-sp.'.$extension;
	$add1=$add2='';
	if(file_exists($url_sp)){
		$add1=' sp_vanish';
		$add2='<img src="'.$url_sp.'" class="W100per pc_vanish">'.chr(10);
	}
	return '<div class="campaign_mainpic">
<img src="'.$url_pc.'" class="W100per'.$add1.'">
'.$add2.'</div>'.chr(10);
}
function CAMPAIGN_IMG($f='',$prm=array()){
	global $dir;
	$class=(!empty($prm['class']))?' class="'.$prm['class'].'"':'';
	$style=(!empty($prm['style']))?' style="'.$prm['style'].'"':'';
	$url_pc=$dir.$f.'.png';
	$url_sp=$dir.$f.'-sp.png';
	$add1=$add2='';
	if(file_exists($url_sp)){
		list($w,$h)=getimagesize($url_sp);
		$sp_size=' style="width:'.($w/2).'px;"';
		$add1=' sp_vanish';
		$add2='<img src="'.$url_sp.'" class="mgnAuto pc_vanish"'.$sp_size.'>'.chr(10);
	}
	return '<div'.$class.$style.'>
<img src="'.$url_pc.'" class="mgnAuto'.$add1.'">
'.$add2.'</div>'.chr(10);
}

function CAMPAIGN_LIST($data,$cleardir='images/campaign/'){
	global $dir;
	global $arr;
	$cnt=1;
	foreach($data as $k => $v){
		$base='';
		if(is_array($v)){
			//ver2
			$class=($v['c']!='')?' class="'.$v['c'].'"':'';
			$num=($v['n']!='')?$v['n']:$cnt;
			switch($v['c']){
				case 'box_H294':
				case 'box_H374':
				$base=str_replace('box_','-',$v['c']);
				break;
			}
		}
		else{
			//ver1
			if($v!='削除'){
				$class=($v!='')?' class="'.$v.'"':'';
				$num=$cnt;
			}
		}
		echo '<li'.$class.'><a href="'.$arr[$k]['link'].'"><div style="background-image:url('.$dir.'btn'.sprintf('%02d',$num).'.png);"><img src="'.$cleardir.'clear-btn'.$base.'.png"></div></a></li>';
		$cnt++;
	}
}

?>