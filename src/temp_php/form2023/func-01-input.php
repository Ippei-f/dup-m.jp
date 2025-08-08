<?php
//<meta charset="utf-8">

//日付セレクト初期化
$d_select_arr=array
('年'=>array('----')
,'月'=>array('--')
,'日'=>array('--')
,'時'=>array('--')
,'分'=>array('--')
);
for($i=date("Y")-1;$i>=(date("Y")-100);$i--){
	$d_select_arr['年'][]=$i;
}
for($i=1;$i<=12;$i++){
	$d_select_arr['月'][]=$i;
}
for($i=1;$i<=31;$i++){
	$d_select_arr['日'][]=$i;
}
for($i=9;$i<=20;$i++){
	$d_select_arr['時'][]=sprintf('%02d',$i);
}
for($i=0;$i<=50;$i+=10){
	$d_select_arr['分'][]=sprintf('%02d',$i);
}

function FORM_MAKE_2023($k,$v){
	$str='';
	$hissu=(strpos($v[0],'*')!==false);//必須フラグ
	if($v[0]==''){$v[0]=$k;}
	else if($v[0]=='*'){$v[0]=$k.'*';}
	
	switch($v[1]){
		//==========
		case 'name':
		$required=$hissu?'required validate[required]':'';
		$str=FORM_TITLE($v[0]).'
<div class="floatL">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_gray cate">'.$v[3][1].'</td>
<td class="pad"></td>
<td>'.FORM_TEXT($v[2].'1',$required).'</td>
</tr></table>
</div>
<div class="floatR">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_gray cate">'.$v[3][2].'</td>
<td class="pad"></td>
<td>'.FORM_TEXT($v[2].'2',$required).'</td>
</tr></table>
</div>'.chr(10);
		break;
		//==========
		case 'tel':
		$required=$hissu?'required validate[required,custom[number],maxSize[4]]':'validate[custom[number],maxSize[4]]';
		$str=FORM_TITLE($v[0]).'
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<td style="width:25%;">'.FORM_TEXT($v[2].'1',$required).'</td>
<td>－</td>
<td style="width:25%;">'.FORM_TEXT($v[2].'2',$required).'</td>
<td>－</td>
<td style="width:38%;">'.FORM_TEXT($v[2].'3',$required).'</td>
</tr></table>'.chr(10);
		break;
		//==========
		case 'mail':
		$str=FORM_TITLE($v[0]).'
'.FORM_TEXT('mail','required validate[required,custom[email]]').chr(10);
		break;
		//==========
		case 'pos':
		$str=FORM_TITLE($v[0]).'
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<td style="width:25%;">'.FORM_TEXT($v[2].'1','required validate[required,custom[number],maxSize[3]]').'</td>
<td>－</td>
<td style="width:25%;">'.FORM_TEXT($v[2].'2','required validate[required,custom[number],maxSize[4]]').'</td>
<td style="min-width:1em;">　</td>
<td style="width:38%; text-align:left;"><input type="button" name="" value="自動住所入力" onclick="AjaxZip3.zip2addr(\'pos1\',\'pos2\',\'addr\',\'addr\');" style="font-size:80%; line-height:120%;"></td>
</tr></table>'.chr(10);
		break;
		//==========
		case 'text':
		$required=$hissu?'required validate[required]':'';
		$str=FORM_TITLE($v[0]).'
'.FORM_TEXT($v[2],$required).chr(10);
		break;
		//==========
		case 'ymd':
		global $d_select_arr;
		$required=$hissu?'required validate[required]':'';
		$str=FORM_TITLE($v[0]).'
<table border="0" cellpadding="0" cellspacing="0" class="form_set" style="width:auto;"><tr>
<td>'.FORM_SELECT($v[2].'1',$required.' W100per','',$d_select_arr['年']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">年</td>
<td>'.FORM_SELECT($v[2].'2',$required.' W100per','',$d_select_arr['月']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">月</td>
<td>'.FORM_SELECT($v[2].'3',$required.' W100per','',$d_select_arr['日']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">日</td>
</tr></table>'.chr(10);
		break;
		//==========
		case 'ninzuu':
		$required=$hissu?'required validate[required,custom[number]]':'';
		$str=FORM_TITLE($v[0]).'
<table border="0" cellpadding="0" cellspacing="0" class="form_set W50"><tr>
<th class="cate" style="text-align:left;">大人</th><td class="pad"></td>
<td>'.FORM_TEXT($v[2].'1',$required.' W100per textR').'</td>
<td style="width:2em;">名</td>
<td style="width:1em;"></td>
<th class="cate" style="text-align:left;">子供</th><td class="pad"></td>
<td>'.FORM_TEXT($v[2].'2',$required.' W100per textR').'</td>
<td style="width:2em;">名</td>
</tr></table>
<div class="clear" style="height:10px;"></div>'.chr(10);
		break;
		//==========
		case 'bukken':
		//エリア＆物件名
		global $sysdata_area1,$sysdata_area2,$sysdata_proto;
		echo FORM_TITLE($v[0]);
?>
<style>
.flex_kiboubukken{
	display: flex;
	margin-right: -1em;
	margin-bottom: -1em;
}
.flex_kiboubukken .err_block{width:auto;}
.flex_kiboubukken > *{
	margin-right: 1em;
	margin-bottom: 1em;
}
</style>
<div class="flex_kiboubukken">
<span class="err_block"><select name="kiboubukken1" class="required validate[required] bg_gray">
<option value="">── エリア名 ──</option>
<?php
$sub_arr=array();
$bukken_id=isset($_GET['id'])?$_GET['id']:'';
$bukken_name='';
foreach($sysdata_proto as $k => $v){
	$add='';
	foreach($v as $vk => $vv){
		$sub_arr[]=$vv[1];
		if($_POST['kiboubukken1']==$sysdata_area2[$k]){
			$add=' selected';
		}
		if(($bukken_id!='')&&($bukken_id==$vv[0])){
			$add=' selected';
			$bukken_name=$vv[1];
		}
	}
	echo '<option value="'.$sysdata_area2[$k].'"'.$add.'>'.$sysdata_area2[$k].'('.count($v).')</option>'.chr(10);
}
?>
</select></span>
<span class="err_block"><select name="kiboubukken2" class="required validate[required] bg_gray">
<option value="">── 物件名 ──</option>
<?php
foreach($sub_arr as $k => $v){
	$add='';
	if($_POST['kiboubukken2']==$v){
		$add=' selected';
	}
	else if($bukken_name==$v){
		$add=' selected';
	}
	echo '<option'.$add.'>'.$v.'</option>'.chr(10);
}
?>
</select></span>
</div>
<script>
$(window).load(function(){
	$('select[name="kiboubukken1"]').change(function(){
		v=$(this).val();
		FORM_BUKKEN_CHANGE('select[name="kiboubukken2"]',v);
	});
});
function FORM_BUKKEN_CHANGE(obj,v){
	$(obj).empty();
	str='<option value="">── 物件名 ──</option>';
	switch(v){
<?php
	foreach($sysdata_proto as $k => $v){
		echo 'case "'.$sysdata_area2[$k].'":'.chr(10);
		foreach($v as $vk => $vv){
			echo 'str+="<option>'.$vv[1].'</option>";'.chr(10);
		}
		echo 'break;';
	}
	echo 'default:';
	/*
	foreach($sub_arr as $k => $v){
		echo 'str+="<option>'.$v.'</option>";'.chr(10);
	}
	*/
?>
	}
	$(obj).prepend(str);
}
</script>
<?php
		break;
		//==========
		case 'checkbox':
		if(isset($_POST[$v[2]]) && is_array($_POST[$v[2]])){$arr=$_POST[$v[2]];}
		else{$arr=array('');}
		$required=$hissu?'required validate[minCheckbox[1]]':'';
		$str=FORM_TITLE($v[0]).'
<style>
.set_'.$v[2].' span:nth-child('.count($v[3]).'){padding-right:0;}
</style>
<span class="err_block list set_'.$v[2].'">'.chr(10);
		foreach($v[3] as $vk => $vv){
			$str.=FORM_CHECK($v[2],$required,$vv,$arr).chr(10);
		}
		switch($k){
			case 'お問い合わせ内容':
			$str.='<div class="dpIB fontP075 LH150 indent_mn">'.WORD_BR('※ご来場時にお渡しします。').'</div>'.chr(10);
		}
		$str.='</span>'.chr(10);
		break;
		//==========
		case 'radio':
		echo FORM_TITLE($v[0]).'
<style>
.set_'.$v[2].' span:nth-child('.count($v[3]).'){padding-right:0;}
</style>
<span class="err_block list set_'.$v[2].'">'.chr(10);		
		foreach($v[3] as $vk => $vv){
			echo FORM_RADIO($v[2],'',$vv,($vv=='予約しない')).chr(10);
		}
		echo '</span>'.chr(10);
		switch($k){
			case 'ご来場予約':
?>
<style>
.caution_yoyaku_check{
	margin-top: 1rem;
	font-size: 75%;
}
.caution_yoyaku_check li{
	padding-left: 1em;
	text-indent: -1em;
}
.caution_yoyaku_check li:nth-child(n+2){margin-top: 0.25em;}
</style>
<ul class="caution_yoyaku_check LH150">
<li class="col_red">※現地物件見学予約をされた方で、さらに来場前アンケートにお答えいただくと、もれなくQUOカード1,000円分を現地でプレゼントします。</li>
<li>※建物完成前のプロジェクトをお選びいただいた場合には、近隣の類似モデルルームをご案内させていただきます。</li>
<li>※リモート見学会ではzoomのビデオ通話機能を使用して、アドバイザーが現地を遠隔でご案内します。</li>
</ul>
<style>
.yoyaku_corona{
	border:solid 1px #444;
	padding:1em;
	margin-top: 1rem;
}
.yoyaku_corona .text{
	font-size: 85%;
}
@media screen and (min-width: 800px) {
}
@media screen and (max-width: 799px) {
	.yoyaku_corona .text br{display: none;}
}
</style>
<div class="yoyaku_corona">
<div class="text LH175">※DUP レジデンスではお客様に安心してご見学いただくために、ウイルスの感染予防対策として<br>事前消毒や換気を徹底し、使い捨て手袋をご用意しております。</div>
</div>
<?php
			//現在の日付取得
			$y = date("Y");//年
			$m = date("m");//月
			//来月
			if($m>=12){
				$ay=$y+1;
				$am=1;
			}
			else{
				$ay=$y;
				$am=$m+1;
			}		
			if(($_REQUEST['yoyaku_check']=='')||($_REQUEST['yoyaku_check']=='予約しない')){$checked='';$add=' display:none;';}
			else{$checked='checked';$add='';}
			if($_REQUEST['yoyaku_date']==''){$_REQUEST['yoyaku_date']='ご希望日を入力してください';}
			
			echo '<div class="yoyaku_set" style="padding-top:1.5em; padding-bottom:30px;'.$add.'">
<div class="LH125">'.WORD_BR('※ご来場希望日時の24時間前までにご予約ください
<span class="fontP075">（例：10月24日の14:00ご来場希望の場合、10月23日の14:00までにご予約完了してください）</span>').'</div>
<div class="LH125" style="margin-top:0.5em;">※水曜定休のため、水曜日にご来場を希望される方は1週間前までにご予約をお願い致します。</div>
<div class="clear" style="height:10px;"></div>
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<td style="width:73%;">'.FORM_TEXT('yoyaku_date','').'</td>
<td style="min-width:1em;">　</td>
<td style="text-align:left;"><input type="button" name="" value="カレンダー表示" onclick="CALENDAR_OPEN();" style="font-size:80%; line-height:120%;"></td>
</tr></table>
<div class="yoyaku_calendar" style="display:none;">
<div class="clear" style="height:30px;"></div>
<script>
function CALENDAR_OPEN(){
	$(".yoyaku_calendar").slideToggle();
}
$(window).load(function(){
	$("input[name=yoyaku_check]").click(function(){
		val=$(this).val();
		$(".test").text(val);
		switch(val){
			case "予約しない":
			case "":
			$(".yoyaku_set").slideUp();
			break;
			default:
			$(".yoyaku_set").slideDown();
		}
	});
	$(".calendar_tbl td.nowmonth").click(function(){
		if($(this).text()!=""){
			$("#yoyaku_date").val($(this).parent().parent().find(".date_ym").text()+$(this).text()+"日");
		}
  });
});
</script>
'.CALENDER_MAKE($y,$m).'
'.CALENDER_MAKE($ay,$am).'
<div class="clear"></div>
</div>
<div class="clear" style="height:30px;"></div>
'.FORM_SELECT('yoyaku_time','W100per','',array
('ご希望時間を選択してください'
,'10:00'
,'11:00'
,'12:00'
,'13:00'
,'14:00'
,'15:00'
,'16:00'
,'17:00'
,'18:00'
//,''
)).'
</div>'.chr(10);
			break;
		}
		break;
		//==========
		case 'textarea':
		$str=FORM_TITLE($v[0]).'
<textarea name="'.$v[2].'" id="'.$v[2].'" rows="5" class="bg_gray W100per" >'.$_REQUEST[$v[2]].'</textarea>'.chr(10);
		break;
		//==========
	}
	return $str;
}
?>