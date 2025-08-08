<?php
//<meta charset="utf-8">

$url=$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
//echo '<!-- URL:'.$url.' -->';
switch(true){
	case (strpos($url,'dup-m.jp')!==false)://DUPレジデンス
	break;
	default://その他
	$dir_form_parts=$kaisou.$recaptcha_url.'form/';
	//DUPのプログラムと共通化
	break;
}
$dir_contact_img=$dir_form_parts.'img/';
//スタイル読み込み
include_once $dir_form_parts.'set/style.php';

$tel_url='tel:0800-170-5104';
$tel_svg='v20230809';
if(isset($comp_data['TEL-fd'])){
	//フリーダイヤルがあればそれに変更
	$tel_url='tel:'.$comp_data['TEL-fd'];
	$tel_svg='fd'.$comp_data['TEL-fd'];
}
$url_line='https://lin.ee/v4vz5KD';
?>
<div class="local_okonomi">
<h3>お好みの方法でご連絡ください</h3>
<ul>
<li>
<div><span><?php echo file_get_contents($dir_contact_img.'icon-tel.svg'); ?></span>お電話<font>で</font><?php echo file_get_contents($dir_contact_img.'cut.svg'); ?></div>
<div><h4>すぐにご相談をされたい方はこちらまでお電話ください</h4>
<?php
echo '<a href="'.$tel_url.'" class="pc_vanish">'.file_get_contents($dir_contact_img.'tel-beta-'.$tel_svg.'.svg').'</a>
<div class="sp_vanish"><a href="'.$tel_url.'">'.file_get_contents($dir_contact_img.'tel-'.$tel_svg.'.svg').'</a><div>営業時間／10:00～18:00　定休日／水曜日</div></div>';
?>
</div>
</li>
<li>
<div><span><?php echo file_get_contents($dir_contact_img.'icon-form.svg'); ?></span>フォーム<font>で</font><?php echo file_get_contents($dir_contact_img.'cut.svg'); ?></div>
<div><h4>事前入力でやりとりスムーズ</h4>
<a href="#form_input">フォーム入力へすすむ<span class="font_gothic">&gt;</span></a>
</div>
</li>
<li>
<div><span><?php echo file_get_contents($dir_contact_img.'icon-line.svg'); ?></span>LINE<font>で</font><?php echo file_get_contents($dir_contact_img.'cut.svg'); ?></div>
<div><h4>30秒でカンタン予約！</h4>
<a href="<?php echo $url_line; ?>" target="_blank" class="pc_vanish">お友だち登録へすすむ<span class="font_gothic">&gt;</span></a>
<img src="<?php echo $dir_contact_img; ?>bnr-line-v20231122.svg" class="sp_vanish">
</div>
</li>
</ul>
</div>
<div class="local_customer">
<h3>東新住建カスタマーサポートの心得5か条</h3>
<div>
<?php
for($i=1;$i<=5;$i++){
	echo file_get_contents($dir_contact_img.'customer-'.$i.'.svg');
}
?>
</div>
</div>
</div></div>
<!-- -->
<div class="local_f_title">
<div class="pos_rel"><a class="anchor" id="form_input" name="form_input"></a></div>
<h2>ご来場予約・お問い合わせ<br class="pc_vanish">・資料請求フォーム</h2>
</div>
<!-- -->
<div class="content_box"><div class="contact_box">
<?php
/*
<div class="local_flex1 center first">
<?php
echo '<a href="'.$tel_url.'" class="pc_vanish">'.file_get_contents($dir_contact_img.'tel-beta.svg').'</a>
<div class="sp_vanish"><a href="'.$tel_url.'">'.file_get_contents($dir_contact_img.'tel-v20230602.svg').'</a><div>営業時間／10:00～18:00　定休日／水曜日</div></div>';
?>
</div>
*/
?>
<div class="contact_title sp_LH150"><span>・</span>お問い合わせの項目をお選びください<span class="col_F00">＊</span></div>
<div class="contact_inputarea_ver2023 colorbox">
<?php
$a=$form_arr_2023['お問い合わせの項目'];
$hissu='*';
echo FORM_RADIO($a['select'],$a[1]);
$hissu='';
?>
</div>
<div class="sp_vanish" style="height:110px;"></div>
<div class="pc_vanish" style="height:35px;"></div>
<?php
echo FORM_STEP();
echo FORM_CAUTION();
?>
<hr>
<?php
/*
<div class="acobox aco_01">
<div class="contact_title"><span>・</span>ご希望の来場場所をお選びください<span class="col_F00">＊</span></div>
<?php
$a=$form_arr_2023['ご希望の来場場所'];
$hissu='*';
echo FORM_PARTS($a,'radio');
$hissu='';
echo FORM_INPUT_CAUTION($a);
?>
<hr>
</div>
*/
?>
<?php
$arr=array
('お問い合わせ物件名 1'
//,'お問い合わせ物件名 2'
//,'お問い合わせ物件名 3'
);
$a_set=array();
foreach($arr as $k => $v){
	$a=$form_arr_2023[$v];
	$a['select1']=$local_bukken_arr['エリア'];
	$a['select2']+=$local_bukken_def;
	if(isset($_REQUEST[$a[1].'1'])&&($_REQUEST[$a[1].'1']!='')){
		if(isset($_REQUEST[$a[1].'2'])&&($_REQUEST[$a[1].'2']!='')){
			$a['select2']+=$local_bukken_arr[$_REQUEST[$a[1].'1']];
		}
	}
	else if(($k<1)&&(count($local_bukken_id)>=2)){
		$a['select2']+=$local_bukken_arr[$local_bukken_id[0]];
		$_REQUEST[$a[1].'1']=$local_bukken_id[0];
		$_REQUEST[$a[1].'2']=$local_bukken_id[1];
	}
	$a_set[]=$a;
}
?>
<div class="acobox aco_00">
<div class="contact_title"><span>・</span>お問い合わせ物件名<span class="col_F00">＊</span></div>
<?php
$hissu='*';
echo FORM_PARTS($a_set[0],'select',array('area-cnt'=>true));
$hissu='';
/*
<div class="contact_I_caution acobox aco_raijou"><font class="col_F00">1日で複数物件巡ることもOKです。</font></div>
<div class="contact_title"><span>・</span>お問い合わせ物件名 2</div>
<?php
echo FORM_PARTS($a_set[1],'select',array('area-cnt'=>true));
?>
<div class="contact_title"><span>・</span>お問い合わせ物件名 3</div>
<?php
echo FORM_PARTS($a_set[2],'select',array('area-cnt'=>true));
?>
*/
?>
<hr>
</div>
<div class="acobox aco_03R">
<div class="contact_title"><span>・</span>ご質問内容</div>
<?php
$a=$form_arr_2023['ご質問内容'];
echo FORM_PARTS($a,'textarea');
echo FORM_INPUT_CAUTION($a);
?>
<hr>
</div>
<div class="acobox aco_00">
<?php
if(!$line_iten){
?>
<div class="local_flex1 center">
<div class="sp_vanish"><?php
echo '<img src="'.$dir_contact_img.'bnr-line.svg" class="sp_vanish">';
echo '<div>LINEアプリよりQRコードを読んでください '.$url_line.'</div>';
?></div>
<div class="pc_vanish"><?php
echo '<a href="'.$url_line.'" target="_blank"><img src="'.$dir_contact_img.'bnr-line-sp.svg"></a>';
?></div>
</div>
<hr>
<?php
}
?>
</div>
<style>
.local_flex2{
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
}
.local_flex2 > *{
	width:380px;
	margin-top: 1em;
}
.local_flex2 > * img{width:100%;}
</style>
<div class="acobox aco_01">
<?php
/*
<div class="contact_title sp_LH150"><span>・</span>現地物件見学、ギャラリー見学のコースをお選びください<span class="col_F00">＊</span></div>
<div class="local_flex2">
<?php
$text_arr=array
('<span class="fontP090">さくっと</span><b class="fontP110">30分コース</b>'
,'<span class="fontP090">しっかり</span><b class="fontP110">60分コース</b>'
,'<span class="fontP090">納得するまでとことん！</span><b class="fontP110">じっくり90分コース</b>'
,''
);

$a=$form_arr_2023['見学コース'];
$str=$add=$class='';
if(strpos($a[0],'*')!==false){
	$class='required validate[required] '.$class;
	$class=str_replace(array("] ,"),',',$class);//特定の表記の時は合体させる
}
if($class!=''){
	$add.=' class="'.$class.'"';
}
foreach($a['select'] as $k => $v){
	$check=$textadd='';
	switch(true){
		case (!isset($_REQUEST[$a[1]])):
		break;
		//case (array_search($v,$_REQUEST[$a[1]])!==false):
		case ($v==$_REQUEST[$a[1]]):
		$check=' checked';
		break;
	}
	if(file_exists(($img=$dir_contact_img.'course-'.($k+1).'.svg'))){
		$textadd=chr(10).'<img src="'.$img.'">';
	}
	if($text_arr[$k]==''){$text_arr[$k]=$v;}
	$str.='<div class="checkbox err_block"><input type="radio" name="'.$a[1].'" value="'.strip_tags($v).'"'.$check.$add.'>'.$text_arr[$k].$textadd.'</div>'.chr(10);
}
echo $str;
?>
</div>
<hr>
*/
?>
<div class="contact_title"><span>・</span>ご希望の来場日時<?php /* または オンライン相談日時*/ ?><span class="col_F00">＊</span></div>
<?php
$a=$form_arr_2023['希望見学日'];
$hissu='*';
echo FORM_PARTS($a,'date');
$hissu='';
echo FORM_INPUT_CAUTION($a);
?>
<hr>
</div>