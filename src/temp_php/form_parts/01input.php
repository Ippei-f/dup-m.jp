<?php
//<meta charset="utf-8">
function FORM_MAKE($cate){
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
	$str='';
	
	switch($cate){
		//----------------------------------------------------------------------------------------------------
		//　◆名前関連
		//----------------------------------------------------------------------------------------------------
		case '名前SUUMO':
		$str='<div class="floatL">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_white cate">姓</td>
<td class="pad"></td>
<td>'.FORM_TEXT('name_s1','required validate[required]').'</td>
</tr></table>
</div>
<div class="floatR">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_white cate">名</td>
<td class="pad"></td>
<td>'.FORM_TEXT('name_s2','required validate[required]').'</td>
</tr></table>
</div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '名前漢字':
		$str=FORM_TITLE('お名前（漢字）*').'
<div class="floatL">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_gray cate">姓</td>
<td class="pad"></td>
<td>'.FORM_TEXT('name_k1','required validate[required]').'</td>
</tr></table>
</div>
<div class="floatR">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_gray cate">名</td>
<td class="pad"></td>
<td>'.FORM_TEXT('name_k2','required validate[required]').'</td>
</tr></table>
</div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '名前フリガナ':
		$str=FORM_TITLE('お名前（フリガナ）*').'
<div class="floatL">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_gray cate">セイ</td>
<td class="pad"></td>
<td>'.FORM_TEXT('name_f1','required validate[required]').'</td>
</tr></table>
</div>
<div class="floatR">
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="bg_gray cate">メイ</td>
<td class="pad"></td>
<td>'.FORM_TEXT('name_f2','required validate[required]').'</td>
</tr></table>
</div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆年齢性別関連
		//----------------------------------------------------------------------------------------------------
		case '年齢性別':
		$str='<div class="floatL">
'.FORM_TITLE('ご年齢*').'
'.FORM_TEXT('age','required validate[required]').'
</div>
<div class="floatR sp_mgn">
'.FORM_TITLE('性別*').'
<span class="err_block form_sex">
'.FORM_RADIO('sex','required validate[required]','男性').FORM_RADIO('sex','required validate[required]','女性').'
</span>
</div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '性別生年月日':
		$str='<div class="floatL W30">
'.FORM_TITLE('性別').'
<span class="err_block form_sex">
'.FORM_RADIO('sex',/*required validate[required]*/'','男性').FORM_RADIO('sex',/*required validate[required]*/'','女性').'
</span>
</div>
<div class="floatR W70 sp_mgn">
'.FORM_TITLE('生年月日（西暦）').'
<span class="err_block" style="width:auto;">'.FORM_SELECT_IB('birth_date1',/*required validate[required]*/'','',$d_select_arr['年']).' 年</span><span class="err_block" style="width:auto; margin-left:1em;">'.FORM_SELECT_IB('birth_date2',/*required validate[required]*/'','',$d_select_arr['月']).' 月</span><span class="err_block" style="width:auto; margin-left:1em;">'.FORM_SELECT_IB('birth_date3',/*required validate[required]*/'','',$d_select_arr['日']).' 日</span>
</div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆テキスト複数項目関連
		//----------------------------------------------------------------------------------------------------
		case '電話番号':
		case '電話番号*':
		$s_title='お'.$cate;
		$str=FORM_TITLE($s_title).'
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<td style="width:25%;">'.FORM_TEXT('tel1',((strpos($s_title,'*')!==false)?'required validate[required,custom[number],maxSize[4]]':'validate[custom[number],maxSize[4]]')).'</td>
<td>－</td>
<td style="width:25%;">'.FORM_TEXT('tel2',((strpos($s_title,'*')!==false)?'required validate[required,custom[number],maxSize[4]]':'validate[custom[number],maxSize[4]]')).'</td>
<td>－</td>
<td style="width:38%;">'.FORM_TEXT('tel3',((strpos($s_title,'*')!==false)?'required validate[required,custom[number],maxSize[4]]':'validate[custom[number],maxSize[4]]')).'</td>
</tr></table>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '郵便番号':
		$str=FORM_TITLE($cate.'*').'
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<td style="width:25%;">'.FORM_TEXT('pos1','required validate[required,custom[number],maxSize[3]]').'</td>
<td>－</td>
<td style="width:25%;">'.FORM_TEXT('pos2','required validate[required,custom[number],maxSize[4]]').'</td>
<td style="min-width:1em;">　</td>
<td style="width:38%; text-align:left;"><input type="button" name="" value="自動住所入力" onclick="AjaxZip3.zip2addr(\'pos1\',\'pos2\',\'addr\',\'addr\');" style="font-size:80%; line-height:120%;"></td>
</tr></table>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご入居予定人数':
		$str=FORM_TITLE($cate).'
<table border="0" cellpadding="0" cellspacing="0" class="form_set W50"><tr>
<th class="cate" style="text-align:left;">大人</th><td class="pad"></td>
<td>'.FORM_TEXT('ninzuu1',/*required validate[required,custom[number]]*/' W100per textR').'</td>
<td style="width:2em;">名</td>
<td style="width:1em;"></td>
<th class="cate" style="text-align:left;">子供</th><td class="pad"></td>
<td>'.FORM_TEXT('ninzuu2',/*required validate[required,custom[number]]*/' W100per textR').'</td>
<td style="width:2em;">名</td>
</tr></table>
<div class="clear" style="height:10px;"></div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご希望の最寄駅':
		$str=FORM_TITLE($cate.'* <span class="fontP080">※第一希望のみ必須</span>').'
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="cate" style="width:4.25em; text-align:left;">第一希望</th><td class="pad"></td>
<td>'.FORM_TEXT('moyori1','required validate[required] W100per').'</td>
<td style="width:2em;">駅</td>
</tr></table>
<div class="clear" style="height:10px;"></div>
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="cate" style="width:4.25em; text-align:left;">第二希望</th><td class="pad"></td>
<td>'.FORM_TEXT('moyori2','W100per').'</td>
<td style="width:2em;">駅</td>
</tr></table>
<div class="clear" style="height:10px;"></div>
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<th class="cate" style="width:4.25em; text-align:left;">第三希望</th><td class="pad"></td>
<td>'.FORM_TEXT('moyori3','W100per').'</td>
<td style="width:2em;">駅</td>
</tr></table>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆テキスト単数項目関連
		//----------------------------------------------------------------------------------------------------
		case '住所':
		$str=FORM_TITLE('ご住所*').'
'.FORM_TEXT('addr','required validate[required]').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '番地・マンション名':
		$str=FORM_TITLE($cate.'*').'
'.FORM_TEXT('banchi','required validate[required]').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'メール':
		case 'メールアドレス(携帯メール可)':
		switch($cate){
			case 'メール':
			$s_title='メールアドレス';
			break;
			default:
			$s_title=$cate;
		}
		$str=FORM_TITLE($s_title.'*').'
'.FORM_TEXT('mail','required validate[required,custom[email]]').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご職業':
		$str=FORM_TITLE($cate).'
'.FORM_TEXT('job','').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'パスコード':
		$str=FORM_TITLE($cate.'*').'
'.FORM_TEXT('pass','required validate[required]').'
<div class="clear" style="height:10px;"></div>
<div class="fontP075">※担当アドバイザーがお知らせしたパスコードをご記入ください。</div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆チェックボックス関連
		//----------------------------------------------------------------------------------------------------
		case 'お問い合わせ内容':
		$key='toinai';
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}		
		$str=FORM_TITLE($cate.'*').'
<style>
.set_toinai span:nth-child(4){padding-right:0;}
</style>
<span class="err_block list set_toinai">
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','詳しい話が聞きたい',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','資料が欲しい',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','事前審査をする',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','「 売れる・貸せる」簡単査定シミュレーションを希望する',$arr).'
<div class="dpIB fontP075 LH150 indent_mn">'.WORD_BR('※ギャラリー北名古屋へご来場いただいた方にお渡しします。').'</div>
</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆セレクト関連
		//----------------------------------------------------------------------------------------------------
		
		
		//----------------------------------------------------------------------------------------------------
		//　◆テキストエリア関連
		//----------------------------------------------------------------------------------------------------
		case 'その他':
		$str=FORM_TITLE('その他ご要望等').'
<textarea name="other_txt" id="other_txt" rows="5" class="bg_gray W100per" >'.$_REQUEST['other_txt'].'</textarea>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆ご希望物件名関連
		//----------------------------------------------------------------------------------------------------
		case 'ご希望物件名':
		$str=FORM_TITLE($cate).'
'.FORM_TEXT('kiboubukken','').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご希望物件名-選択':
		case 'ご希望物件名-選択*':
		case '物件名-選択':
		global $getFormatDataArr,$form_select_type;

$arr_info=array('*** 選択してください ***');
foreach($getFormatDataArr as $key => $sysdata){
	switch(true){
		case ($sysdata['soldout']>0)://売り切れは除外
		break;
		default:
		//売り切れてなければ選択可
		$flag=true;
		switch($form_select_type){//セレクトタイプ
			case 'iot':
			if($sysdata['iot']<1){$flag=false;}
			break;
		}
		if($flag){
			$arr_info[]=$sysdata['title_text'];
		}
	}	
}//foreach
		$s_title=str_replace(array("-選択"),'',$cate);
		switch($s_title){
			case '物件名':
			$s_title.='*';
			break;
		}
		$str=FORM_TITLE($s_title).'
<span class="err_block">'.FORM_SELECT_IB('kiboubukken',''.((strpos($s_title,'*')!==false)?'required validate[required]':''),'',$arr_info).'</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆現地ご来場予約関連
		//----------------------------------------------------------------------------------------------------
		case '現地ご来場予約':
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
		
		if($_REQUEST['yoyaku_check']==''){$checked='';$add=' display:none;';}
		else{$checked='checked';$add='';}
		if($_REQUEST['yoyaku_date']==''){$_REQUEST['yoyaku_date']='ご希望日を入力してください';}
		
		
		$str=FORM_TITLE('現地ご来場予約').'
<script>
function YOYAKU_OPEN(){
	if($("#yoyaku_check").prop("checked")){$(".yoyaku_set").slideDown();}
	else{$(".yoyaku_set").slideUp();}
}
function CALENDAR_OPEN(){
	$(".yoyaku_calendar").slideToggle();
}
</script>
<span class="pad"><input name="yoyaku_check" id="yoyaku_check" type="checkbox" '.$checked.' class="form_check" value="予約する" onclick="YOYAKU_OPEN();">
予約する</span>
<div class="fontP080 LH150 col_red" style="margin-top:1em;">'.WORD_BR('ご来場予約された方で、さらにご来場前アンケートにお答えいただくと、
もれなくQUOカード1,000円分を現地でプレゼントします').'</div>
<div class="yoyaku_set" style="padding-top:1.5em; padding-bottom:30px;'.$add.'">
<div class="LH125">'.WORD_BR('※ご来場希望日時の24時間前までにご予約ください
<span class="fontP070">（例：10月24日の14:00ご来場希望の場合、10月23日の14:00までにご予約完了してください）</span>').'</div>
<div class="clear" style="height:10px;"></div>
<table border="0" cellpadding="0" cellspacing="0" class="form_set"><tr>
<td style="width:73%;">'.FORM_TEXT('yoyaku_date','').'</td>
<td style="min-width:1em;">　</td>
<td style="text-align:left;"><input type="button" name="" value="カレンダー表示" onclick="CALENDAR_OPEN();" style="font-size:80%; line-height:120%;"></td>
</tr></table>
<div class="yoyaku_calendar" style="display:none;">
<div class="clear" style="height:30px;"></div>
<script>
$(window).load(function(){
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
</div>
'.chr(10);
		break;
		case 'ご来場予約'://20200427ver
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
		
		if($_REQUEST['yoyaku_check']==''){$checked='';$add=' display:none;';}
		else{$checked='checked';$add='';}
		if($_REQUEST['yoyaku_date']==''){$_REQUEST['yoyaku_date']='ご希望日を入力してください';}
		
		
		$str=FORM_TITLE('ご来場予約').'
<style>
.radio_green > span{
	background-color:#004021;
	color:#FFF;
	padding: 0.125em;
	padding-right: 0.5em;
}
@media screen and (max-width: 799px) {
	.radio_green > span{
		display:block;
	}
}
</style>
'./*<div class="LH200">＜現地ご来場＞</div>*/'
<div class="radio_green">
'.FORM_RADIO('yoyaku_check','','現地物件見学').'<div class="sp_vanish dpIB" style="width:1.25em;"></div><div class="pc_vanish" style="height:0.5em;"></div>'.FORM_RADIO('yoyaku_check','','ギャラリー北名古屋').'
</div>
<div class="LH150 indent_mn col_red" style="margin-top:1em;">'.WORD_BR('◎ギャラリー北名古屋では、物件の無人見学もご案内しています。').'</div>
<div class="LH200" style="padding-top:0.75em;">＜もしくは＞</div>
<div class="radio_green">
'.FORM_RADIO('yoyaku_check','','自宅でリモート見学会').'
</div>
<div class="fontP075 LH150 indent_mn col_red" style="margin-top:1.5em;">'.WORD_BR('※現地物件見学予約をされた方で、さらに来場前アンケートにお答えいただくと、
もれなくQUOカード1,000円分を現地でプレゼントします。').'</div>
<div class="fontP075 LH150 indent_mn" style="margin-top:0.5em;">'.WORD_BR('※建物完成前のプロジェクトをお選びいただいた場合には、
近隣の無人モデルルームをご案内させていただきます。').'</div>
'./*<div class="fontP075 LH150 indent_mn" style="margin-top:0.5em;">'.WORD_BR('※ギャラリー北名古屋では、物件の無人見学をご案内しています。').'</div>*/'
<div class="fontP075 LH150 indent_mn" style="margin-top:0.5em;">'.WORD_BR('※リモート見学会ではzoom のビデオ通話機能を使用して、アドバイザーが現地を遠隔でご案内します。').'</div>
<div style="padding:2em 0;">'.FORM_RADIO('yoyaku_check','','しない',true).'</div>
<style>
.yoyaku_corona{
	border:solid 1px #444;
	padding:1em;
}
.yoyaku_corona .text{
	font-size: 85%;
}
@media screen and (min-width: 800px) {
	.yoyaku_corona .pic{
		float:right;
		width:25%;
	}
	.yoyaku_corona .text{
		float:left;
		width:75%;
		padding-right:1em;
	}
}
@media screen and (max-width: 799px) {
	.yoyaku_corona .pic{
		width:75%;
		margin:auto;
	}
	.yoyaku_corona .text{
		margin-top:1em;
	}
}
</style>
<div class="yoyaku_corona">
<!--<img class="pic" src="images/common/other/20200427corona.svg">-->
<div class="text LH175" style="width:100%;margin-top:0;">'.WORD_BR('※DUP レジデンスではお客様に安心してご見学いただくために、ウイルスの感染予防対策として<br class="sp_vanish">事前消毒や換気を徹底し、使い捨て手袋をご用意しております。').'</div>
'./*使い捨てスリッパと使い捨て手袋をセットにした『with コロナ 見学キット』を事前にご自宅までお届けしています。またご案内の際には、消毒や換気などウイルス対策を徹底いたしております。*/'
<div class="clear"></div>
</div>


<div class="yoyaku_set" style="padding-top:1.5em; padding-bottom:30px;'.$add.'">
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
			case "しない":
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
</div>
'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆ご見学前アンケート関連
		//----------------------------------------------------------------------------------------------------
		case 'ご希望見学日':
		$key=FORM_SETNAME($cate);
		$str=FORM_TITLE($cate.'*').'
<table border="0" cellpadding="0" cellspacing="0" class="form_set" style="width:auto;"><tr>
<td>'.FORM_SELECT($key.'1','required validate[required] W100per','',$d_select_arr['月']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">月</td>
<td>'.FORM_SELECT($key.'2','required validate[required] W100per','',$d_select_arr['日']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">日</td>
<td>'.FORM_SELECT($key.'3','required validate[required] W100per','',$d_select_arr['時']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">時</td>
<td>'.FORM_SELECT($key.'4','required validate[required] W100per','',$d_select_arr['分']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">分</td>
</tr></table>
		<div class="indent_mn fontP080 LH150 sp_br_del" style="margin-top:1em;">'.WORD_BR('※前日までにご予約ください。ご予約状況によっては当日QUOカードやお気軽資産計画表をお渡しできない可能性がございます。
その場合は後日郵送にてご対応いたしております。').'</div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '物件を知ったキッカケ':
		$s_title=$cate.'*';
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}		
		$str=FORM_TITLE($s_title).'
<span class="err_block list">
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'東新住建HP',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'スーモ',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'ポスト投函チラシ',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'新聞折込チラシ',$arr).'
<div class="sp_vanish" style="height:0.5em;"></div>
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'雑誌広告',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'案内・現地看板',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'ダイレクトメール',$arr).'
<div style="height:0.5em;"></div>
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'知人の紹介',$arr).'<div class="pc_vanish"></div>
<span class="dpIB" style="max-width:13em; margin-right:2em;">'.FORM_TEXT($key.'t1','','紹介者名').'</span>
<div class="pc_vanish" style="height:0.5em;"></div>
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'その他',$arr).'<div class="pc_vanish"></div>
<span class="dpIB" style="max-width:13em;">'.FORM_TEXT($key.'t2','').'</span>
</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '検討開始時期':
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}	
		$str=FORM_TITLE($cate.'*').'
'.FORM_SELECT($key,'required validate[required]','始めたばかり',array
('始めたばかり'
,'1ヶ月前から'
,'3ヶ月前から'
,'6ヶ月前から'
,'1年以上前から'
//,''
)).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '生年月日（西暦）':
		$key=FORM_SETNAME($cate);
		$str=FORM_TITLE($cate.'*').'
<table border="0" cellpadding="0" cellspacing="0" class="form_set" style="width:auto;"><tr>
<td>'.FORM_SELECT($key.'1','required validate[required] W100per','',$d_select_arr['年']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">年</td>
<td>'.FORM_SELECT($key.'2','required validate[required] W100per','',$d_select_arr['月']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">月</td>
<td>'.FORM_SELECT($key.'3','required validate[required] W100per','',$d_select_arr['日']).'</td>
<td style="width:2.5em; padding-right: 0.5em;">日</td>
</tr></table>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご本人様実家':
		case '配偶者様実家':
		if($cate=='ご本人様実家'){
			$s_title=$cate.'*';
		}
		else{
			$s_title=$cate;
		}
		$key=FORM_SETNAME($cate);
		$str=FORM_TITLE($s_title).'
<table border="0" cellpadding="0" cellspacing="0" class="sp_notable_IB"><tr>
<td><span class="pc_vanish dpIB" style="width:1.45em"></span>市：</td>
<td>'.FORM_TEXT($key.'1',((strpos($s_title,'*')!==false)?'required validate[required]':'').' W100per','市名').'</td>
<td class="sp_dpB" style="height:1em; width:0.5em;"></td>
<td><span class="sp_vanish dpIB">、</span>区・町</td>
<td style="width:0.25em;"></td>
<td>'.FORM_TEXT($key.'2',((strpos($s_title,'*')!==false)?'required validate[required]':'').' W100per','区町村名').'</td>
</tr></table>
<div class="clear" style="height:10px;"></div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '現在のお住まい':
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}		
		$str=FORM_TITLE($cate.'*').'
<span class="err_block list">
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','賃貸住宅',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','分譲マンション',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','社宅 持家（本人）',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','持家（家族）',$arr).'
</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご入居予定の家族構成':
		$key=FORM_SETNAME($cate);
		$s_title=$cate.'*';
		$str=FORM_TITLE($s_title).'
<div class="dpIB"><span class="dpIB" style="max-width:11em;">'.FORM_TEXT($key.'1',((strpos($s_title,'*')!==false)?'required validate[required]':'').' W100per').'</span> 名</div>
<div style="height:0.5em;"></div>
<div class="dpIB">配偶者様：<span class="dpIB" style="max-width:6em;">'.FORM_TEXT($key.'2','W100per').'</span> 歳<span class="sp_vanish">／　</span></div>
<div class="pc_vanish" style="height:0.5em;"></div>
<div class="dpIB"><span class="dpIB" style="width:1em"></span>お子様：</td><span class="dpIB" style="max-width:6em;">'.FORM_TEXT($key.'3','W100per').'</span> 歳</div>
<div style="height:0.5em;"></div>
<div class="dpIB">兄弟姉妹：<span class="dpIB" style="max-width:6em;">'.FORM_TEXT($key.'4','W100per').'</span> 歳<span class="sp_vanish">／　</span></div>
<div class="pc_vanish" style="height:0.5em;"></div>
<div class="dpIB">ご両親様：<span class="dpIB" style="max-width:6em;">'.FORM_TEXT($key.'5','W100per').'</span> 歳<span class="sp_vanish">／　</span></div>
<div class="pc_vanish" style="height:0.5em;"></div>
<div class="dpIB">ご両親様：<span class="dpIB" style="max-width:6em;">'.FORM_TEXT($key.'6','W100per').'</span> 歳</div>
<div class="clear" style="height:10px;"></div>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'お勤め先（ご本人様）':
		case 'お勤め先（配偶者様）':
		if($cate=='お勤め先（ご本人様）'){
			$s_title=$cate.'*';
		}
		else{
			$s_title=$cate;
		}
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}		
		$str=FORM_TITLE($s_title).'
<span class="err_block list">
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'公務員',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'会社員',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'自営',$arr).'
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'専業主婦',$arr).'
<div class="pc_vanish" style="height:1em;"></div>
'.FORM_CHECK($key,((strpos($s_title,'*')!==false)?'required validate[minCheckbox[1]]':''),'その他',$arr).'
<span class="dpIB" style="max-width:18em;">'.FORM_TEXT($key.'t','').'</span>
</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '購入予定物件':
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}		
		$str=FORM_TITLE($cate.'*').'
<span class="err_block list">
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','中古マンション',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','中古戸建',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','新築戸建',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','新築マンション',$arr).'
</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '自己資金':
		$key=FORM_SETNAME($cate);
		$str=FORM_TITLE($cate.'*').'
<table border="0" cellpadding="0" cellspacing="0" class="form_set" style="width:auto;"><tr>
<td>'.FORM_TEXT($key,'required validate[required]').'</td>
<td style="padding-left: 0.5em;">万円位</td>
</tr></table>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '返済中のローン':
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}	
		$str=FORM_TITLE($cate.'*').'
<table border="0" cellpadding="0" cellspacing="0" class="form_set" style="width:auto;"><tr>
<td>'.FORM_SELECT($key.'1','required validate[required] W100per','なし',array
('なし'
,'マイカーローン、カードローン有'
,'マイカーローン有'
,'カードローン有'
//,''
)).'</td>
<td style="padding-left: 0.5em; text-align:left;">'.FORM_CHECK($key.'2','','お気軽試算計画表をもらう<div class="fontP080">※アンケート内容より当日書面にてお渡しします</div>',$arr).'</td>
</tr></table>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '2世帯をお考えの方':
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}		
		$str=FORM_TITLE($cate).'
<span class="err_block list">
'.FORM_CHECK($key,'','考え中',$arr).'
</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '来訪時に聞きたいこと':
		$key=FORM_SETNAME($cate);
		$str=FORM_TITLE($cate).'
<textarea name="'.$key.'" id="'.$key.'" rows="5" class="bg_gray W100per" >'.$_REQUEST[$key].'</textarea>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '「個人情報保護方針」への同意':
		$key=FORM_SETNAME($cate);
		if (isset($_POST[$key]) && is_array($_POST[$key])) {$arr = $_POST[$key];}
		else{$arr=array('');}		
		$str=FORM_TITLE($cate.'*').'
<span class="err_block list">
'.FORM_CHECK($key,'required validate[required]','同意する　<div class="fontP080 dpIB">※下記をお読みいただき、個人情報の取扱いについてご確認ください。</div>',$arr).'
</span>'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆IoT関連
		//----------------------------------------------------------------------------------------------------
		case 'IoT見学回数':
		$str='<style>
.IoT_kengaku{text-align:center;}
.IoT_kengaku .err_block{margin-right: -1em;}
		@media screen and (min-width: 800px) {
.IoT_kengaku .err_block{text-align:center;}
.IoT_kengaku .form_check,
.IoT_kengaku .radio_text{font-size:150%;}
.IoT_kengaku .form_check{vertical-align: -0.25em!important;}
		}
		@media screen and (max-width: 799px) {
.IoT_kengaku .form_check{font-size:100%;vertical-align: -0.75em!important;}
.IoT_kengaku .radio_text{font-size:125%;}
		}
</style>
<div class="IoT_kengaku"><span class="err_block">'
.FORM_RADIO('IoT_kengaku','required validate[required]','初めての見学')
.FORM_RADIO('IoT_kengaku','required validate[required]','2回目以上の見学')
.'</span><div style="padding-top:1em;">どちらかにチェックをお願いします。</div></div>'.chr(10);
//
		break;
		//----------------------------------------------------------------------------------------------------
		/*
		case '':
		$str=''.chr(10);
		break;
		*/
	}
	return $str;
}

function FORM_SETNAME($k){
	//$form_arr_nameがある場合はそれをセットする
	global $form_arr_name;
	if(!empty($form_arr_name[$k])){
		$res=$form_arr_name[$k];
	}
	else{
		$res=$k;
	}
	return $res;
}

function FORM_TEXT($name,$class,$ph=''){
	if($ph!=''){
		$ph=' placeholder="'.$ph.'"';
	}
	return '<span class="err_block"><input name="'.$name.'" id="'.$name.'" type="text" class="bg_gray '.$class.'" value="'.$_REQUEST[$name].'"'.$ph.'></span>';
}
function FORM_RADIO($name,$class,$val,$checked=false){
	if($_REQUEST[$name]==$val){$add='checked';}
	else if(($_REQUEST[$name]=='')&&$checked){$add='checked';}
	else{$add='';}
	return '<span class="pad"><input name="'.$name.'" id="'.$name.'" type="radio" class="form_check '.$class.'" value="'.$val.'" '.$add.'>
<span class="radio_text">'.$val.'</span></span>';
}
function FORM_CHECK($name,$class,$val,$arr){
	/*
	if (isset($_POST[$name]) && is_array($_POST[$name])) {
		$arr = $_POST[$name];
	}
	else{$arr=array('');}
	*/
	if(array_search($val,$arr)!==false){$add='checked';}
	else{$add='';}
	
	$text=$val;
	$val=strip_tags($val);
	$val=str_replace(array("\r\n","\n","\r"),'',$val);
	
	return '<span class="pad"><input name="'.$name.'[]" id="'.$name.'" type="checkbox" class="form_check '.$class.'" value="'.$val.'" '.$add.'>
'.$text.'</span>';
}
function FORM_SELECT($name,$class,$first,$arr){
	$str='<span class="err_block"><select name="'.$name.'" id="'.$name.'" class="bg_gray '.$class.'">
<option value="'.$first.'">'.$arr[0].'</option>'.chr(10);
	for($i=1;$i<count($arr);$i++){
		if($_REQUEST[$name]==$arr[$i]){$add=' selected';}
		else{$add='';}
		$str.='<option'.$add.'>'.$arr[$i].'</option>'.chr(10);
	}
	$str.='</select></span>'.chr(10);
	return $str;
}
function FORM_SELECT_IB($name,$class,$first,$arr,$default=''){
	$str='<select name="'.$name.'" id="'.$name.'" class="bg_gray '.$class.'">
	'.(($default!='')?'<option selected>'.$default.'</option>':'').'
<option value="'.$first.'">'.$arr[0].'</option>'.chr(10);
	for($i=1;$i<count($arr);$i++){
		if(($_REQUEST[$name]==$arr[$i])&&($default=='')){$add=' selected';}
		else{$add='';}
		$str.='<option'.$add.'>'.$arr[$i].'</option>'.chr(10);
	}
	$str.='</select>'.chr(10);
	return $str;
}
function FORM_TITLE($title){
	$title=str_replace(array('*','＊'),'<font color="#e30012"><b>＊</b></font>',$title);
	return '<div class="fontP087 mgnB0_5em form_cate">'.$title.'</div>';
}

function CALENDER_MAKE($y,$m){
	
//先月
if($m<=1){
	$by=$y-1;
	$bm=12;
}
else{
	$by=$y;
	$bm=$m-1;
}
//来月
if($m>=12){
	$ay=$y+1;
	$am=1;
}
else{
	$ay=$y;
	$am=$m+1;
}

$stt=$y.'/'.$m.'/1';
$fw=date('w',strtotime($stt));//月初の曜日取得
$stt=$y.'-'.$m;
$ld=date('t',strtotime($stt));//月末日取得
$bmld=date('t',strtotime($by.'-'.$bm));

$d_list=array();
$d_list[0]=array();//日付
$d_list[1]=array();//monthtype

	//今月分の日付を埋める
	for($i=0;$i<$ld;$i++){
		$d_list[$i+$fw][0]=($i+1);
		$d_list[$i+$fw][1]='nowmonth';
	}
	if($fw>0){
		//最初の曜日が日曜日でなければ先月の日を埋める。
		for($i=-1;($i+$fw)>-1;$i--){
			$d_list[$i+$fw][0]=$bmld+($i+1);
			$d_list[$i+$fw][1]='befmonth';
		}
	}
	if(($ld-1+$fw)%7<6){
		//月末の曜日が土曜日でなければ次月の日を埋める。
		for($i=0;($i+$ld+$fw)%7>0;$i++){
			$d_list[$i+$ld+$fw][0]=($i+1);
			$d_list[$i+$ld+$fw][1]='aftmonth';
		}
	}
	
	//来月のカレンダーの配置
	if($m!=date("m")){$add=' next_month';}
	else{$add='';}
	
	//テーブル作成
	$str='<table class="calendar_tbl'.$add.'">
<tr><th class="date_ym" colspan="7">'.$y.'年'.$m.'月</th></tr>
<tr>
  <th>日</th>
  <th>月</th>
  <th>火</th>
  <th>水</th>
  <th>木</th>
  <th>金</th>
  <th>土</th>
</tr>'.chr(10);
for($i=0;$i<count($d_list);$i++){
	//日曜日判定
	if(($i%7)==0){$str.='<tr>'.chr(10);	}	
	$str.='<td class="'.$d_list[$i][1].'">'.$d_list[$i][0].'</td>'.chr(10);
	if(($i%7)==6){$str.='</tr>'.chr(10);}
}
$str.='</table>'.chr(10);
	
	return $str;
}
?>