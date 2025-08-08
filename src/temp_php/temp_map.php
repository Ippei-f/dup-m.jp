<?php
//<meta charset="utf-8">
$mapset='';
$map_center_lat=0;
$map_center_lng=0;
$cnt=0;
foreach($getFormatDataArr as $key => $sysdata){
	if($sysdata['soldout']>0){continue;/*完売物件は表示しない*/}
	
	$sysdata['gmap_text'][0]=str_replace(array('　',' ','	'),"",$sysdata['gmap_text'][0]);
	$sysdata['gmap_text'][1]=str_replace(array('　',' ','	'),"",$sysdata['gmap_text'][1]);
	if($sysdata['gmap_text'][0]==''){continue;}//座標なしはスルー
	if($sysdata['gmap_text'][1]==''){continue;}
	
	if($mapset!=''){$mapset.=',';}
	
	if(($sysdata['modelroom']>0)||($sysdata['categoryNum2']>0)){
		$link=$link_list['物件情報詳細'].'?id='.$sysdata['id'].'&place=/'.$sysdata['roma'].'/';
	}
	else{
		$link=$link_list['物件情報'].'#info_'.$sysdata['roma'];
	}
	
	$mapset.="{name:'<a href=\"".$link."\">"./*$sysdata['title_text'].*/(($sysdata['gmap_text'][2]!='')?''.$sysdata['gmap_text'][2]:'')."</a>',
		lat:".$sysdata['gmap_text'][0].",
		lng:".$sysdata['gmap_text'][1].",
		icon:'images/common/mapicon.png'
	}";
	$map_center_lat+=$sysdata['gmap_text'][0];
	$map_center_lng+=$sysdata['gmap_text'][1];
	$cnt++;
}
$map_center_lat/=$cnt;
$map_center_lng/=$cnt;
?>