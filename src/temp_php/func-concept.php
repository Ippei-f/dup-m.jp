<?php
//<meta charset="utf-8">

$dir_concept=$kaisou.'images/content/concept/';

/*
$concept_menu=array
(1=>array	('dir'	=>'woman'
					,'catch'=>'女性が一人暮らしする上で「最良の選択」とは？'
					)
,2=>array	('dir'	=>'minimal-life'
					,'catch'=>'自由でミニマルな、“持たない”暮らし。'
					)
);
*/
$concept_menu=array();

//システム読み込み
$dir_sys=$kaisou.'system/life/';
include_once($dir_sys."admin/include/config.php");
$file_path = $dir_sys.'data/data.dat';
$img_updir = $dir_sys.'upload';
$id = h($_GET['id']);
$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config,'','');
foreach($getFormatDataArr as $key => $sysdata){
	//必要なパラメータだけ格納していく
	$num='S'.$sysdata['id'];
	$arr=array();
	$arr['title']=$sysdata['title_text'];
	$arr['photo']=$sysdata['upfile_path'][0];
	$arr['catch']=$sysdata['comment'][1];
	$concept_menu[$num]=$arr;
}
$sysdata = getLines2DspData($file_path,$img_updir,$config,$id);

//静的ページを最後に配置→2020/12/07廃止
/*
$concept_menu[1]=array
					('dir'	=>'woman'
					,'catch'=>'女性が一人暮らしする上で「最良の選択」とは？'
					);
$concept_menu[2]=array
					('dir'	=>'minimal-life'
					,'catch'=>'自由でミニマルな、“持たない”暮らし。'
					);
*/


$concept_R='<div class="concept_R borderbox sp_vanish">
<h3 class="font_meiryo">その他の記事</h3>
'.CONCEPT_SUB_MENU().'
</div>'.chr(10);

$add_btn='';
/*
if(!empty($_GET['test'])){
	if($_GET['test']=='ok'){
		
	}
}
*/
if(strpos($_SERVER['SCRIPT_NAME'],'concept.php')!==false){
	$add_btn='<div style="height:80px;"></div>'.BTN_OVAL('コンセプト-0x','全ての記事を見る','width:13em;','colorW');
}

$concept_B='<div class="concept_B borderbox">
'.(!empty($p_title_sub)?'<h3>その他の記事</h3>':'<h3 class="col_green">DUP LIFESTYLE MAGAZINE</h3><h4>「自分らしく、自由に」をテーマに、<br class="pc_vanish">さまざまなライフスタイルをご紹介</h4>').'
<div class="mgn_mn">'.CONCEPT_SUB_MENU().'<div class="clear"></div></div>
'.$add_btn.'
</div>'.chr(10);
if(!empty($p_title_sub)){
	$concept_B.='<div class="content" style="text-align:center; padding-top:65px; padding-bottom:60px;">
'.BTN_OVAL('物件情報','物件一覧を見る','width:13em;').'
<div style="height:1em;"></div>
'.BTN_OVAL('特長','特長を知る','width:13em;','colorW').'
</div>'.chr(10);
}



//◆関数
function CONCEPT_SUB_MENU(){
	global $kaisou,$link_list,$notation_list,$p_title_sub,$dir_concept,$concept_menu;
	$str='';
	foreach($concept_menu as $k => $v){
		//$kが数値か否かで分岐させる
		if(is_numeric($k)){
			//固定ページ2種
			$link_k='コンセプト-'.sprintf('%02d',$k);
			if($link_k==$p_title_sub){continue;}
			$str.='<a href="'.$link_list[$link_k].'" class="concept_mbtn">
<img src="'.$dir_concept.$v['dir'].'/menupic.jpg">
<div>
<div>'.$v['catch'].'</div>
<div class="font_meiryo">'.$notation_list[$link_k]['jp-top'].'</div>
</div>
</a>';
		}
		else{
			//システム（本UP）
			$k2=str_replace('S','',$k);
			if($k2==$_GET['id']){continue;}
			$str.='<a href="'.$link_list['コンセプト-0x'].'?id='.$k2.'" class="concept_mbtn">
<img src="'.$kaisou.'images/common/clear-W1056H472.png" class="bg_cover" style="background-image:url('.$v['photo'].');">
<div>
<div>'.$v['catch'].'</div>
<div class="font_meiryo">'.$v['title'].'</div>
</div>
</a>';
		}//if(is_numeric($k))
	}//foreach($concept_menu as $k => $v)
	return $str;
}
function CONCEPT_SUB_CATCH($c,$t='',$t_tag='h2'){
	global $notation_list,$p_title_sub;
	if($t==''){
		$t=$notation_list[$p_title_sub]['jp-top'];
	}
	return '<div class="concept_catch LH150 textC">
<'.$t_tag.'>【'.$t.'】</'.$t_tag.'>
<div>'.WORD_BR($c).'</div>
</div>'.chr(10);
}
function CONCEPT_SUB_BLOCK($data){
	/*
	[0]:タイトル
	[1]:記事内容（写真含む）
	[2]:もっとPR（配列）
	[2][0]タイトル
	[2][1]内容
	[2][2]名前
	[3]追加要素
	*/
	global $dir_concept;
	$str='<h3 class="sp_br_del font_meiryo">'.WORD_BR($data[0]).'</h3>
<div class="textbox font_meiryo">'.WORD_BR($data[1]).'</div>'.chr(10);
	if(!empty($data[2])){
		$str.='<div class="chottoPR">
<img src="'.$dir_concept.'icon-chottoPR.svg">
<h4 class="font_meiryo">'.WORD_BR($data[2][0]).'</h4>
<div class="ch_text">'.WORD_BR($data[2][1]).'</div>
'.(!empty($data[2][2])?'<div class="font_meiryo">'.WORD_BR($data[2][2]).'</div>':'').'
</div>'.chr(10);
	}
	if(!empty($data[3])){
		$str.=$data[3].chr(10);
	}
	return $str;
}

function CONCEPT_SUB_IMG($img){
	global $dir_concept_sub;
	return '<img src="'.$dir_concept_sub.$img.'" class="W100per">';
}
function CONCEPT_SUB_WRITER($t1,$t2,$p=''){
	global $dir_concept_sub;
	$str='';
	if($t2!=''){
		if($p==''){
		$p=$dir_concept_sub.'writer.jpg';
		}
		$t1=str_replace(array(" ","　"),'<span class="dp_PCpad_SPblock p1em"></span>',$t1);
		$str='<hr>
<table border="0" cellpadding="0" cellspacing="0" class="W100per bg_cover font_meiryo concept_writer"><tr>
<td style="background-image:url('.$p.');"><div></div></td>
<td>●この記事を書いたのは…
<div>'.$t1.'</div>
'.$t2.'</td>
</tr></table>'.chr(10);
	}
	return $str;
}
function CONCEPT_VOICELINK($key='',$text=''){
	global $kaisou,$link_list,$voice_data;
	$str='';
	if(is_numeric($key)){
		$key=sprintf('%02d',$key);
		$url=$kaisou.'voice/'.$key.'.php';
		if($text!=''){
			$title=$text;
		}
		else{
			if(!empty($voice_data[$key]['サムネ用'])){
			$title=$voice_data[$key]['サムネ用'];
		}
		else{
			$title=$voice_data[$key]['タイトル'];
		}
			$title.=chr(10).$voice_data[$key]['住所名前'];
			$title=str_replace(array("\r\n","\n","\r"),'<br>',$title);
			/*
			$title=str_replace(array("\r\n","\n","\r"),'',$title);
			$title.='<br>'.$voice_data[$key]['住所名前'];
			*/
		}		
		$str='<a href="'.$url.'">'.$title.'</a>';
	}
	else if($key!=''){
		$str='<a href="'.$key.'">'.$text.'</a>';
	}
	else{
		$str='<a href="'.$link_list['お客様の声'].'">「お客様の声」へ</a>';
	}
	return $str;
}
?>