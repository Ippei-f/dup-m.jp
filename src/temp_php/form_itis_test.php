<?php
//<meta charset="utf-8">

session_start();//セッションスタート


//◆全フォーム共通文章関連

//注意書き
$form_t_caution='<div class="clear" style="height:1em;"></div>
<div class="fontP075">※ご予約確認やご質問への回答は、メールにて連絡させていただきます。<br class="sp_vanish">
迷惑メール対策等でドメイン指定受信を設定されている場合に、<br class="sp_vanish">
メールが正しく届かないことがございます。以下のドメインを受信できるように設定してください。<br>
「'.$to_mail[0].'」</div>'.chr(10);


//◆メール処理分岐
switch(true){
	case ($_GET['send']=='complete'):
	//送信完了
	$step=4;
	break;
	case ($_REQUEST['sm_send']!=''):
	case ($_REQUEST['sm_direct']!=''):
	//送信・返信処理
	
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");
	
	
	//別のフォームに内容引き継ぎ
	foreach($_SESSION as $k => $v){
		if(isset($_SESSION[$k])){unset($_SESSION[$k]);}//古いセッションを破棄
	}
	if($_REQUEST['yoyaku_check']!=''){
		foreach($_REQUEST as $k => $v){
			$_SESSION[$k]=$v;
		}
	}
	
	$base_naiyou='';
	for($i=0;$i<count($form_arr);$i++){
		$base_naiyou.=SEND_WORD($form_arr[$i]);
	}
	$base_naiyou.='
------------------------------------------';
	
	$from_mail = $_REQUEST['mail'];

	$send_naiyou='━━━━━━━━━━━━━━━━━━━━━
ホームページよりお問い合わせがありました。
━━━━━━━━━━━━━━━━━━━━━

【お問い合わせ日時】
'.date( "Y/m/d H:i:s", time() ).'
'.$base_naiyou;

	if($nai_under_add!=''){$nai_under_add=chr(10).$nai_under_add;}
	
	switch($p_title){
		//----------------------------------------------------------------------------------------------------
		case 'ご見学前アンケート':
		$res_temp1='この度は、'.$mt_henshin_sender.'のご見学前アンケートにご協力いただき誠にありがとうございます。
ご来場日当日に現地でQUOカード1,000円分をプレゼントいたします。

本メールは、お客さまのご見学前アンケートの受付が、以下の内容で完了しましたことをお知らせするものです。';
		break;
		//----------------------------------------------------------------------------------------------------
		case 'DUP会員登録':
		$res_temp1='この度は、'.$mt_henshin_sender.'会員登録をいただき誠にありがとうございます。
本メールは、お客さまの'.$mt_henshin_sender.'会員登録が、下記の内容で完了しましたことをお知らせするものです。

'.$mt_henshin_sender.'会員登録をしていただきますと、
新着物件を優先的にご案内させていただいたり、会員様限定ページをご覧いただくことができます。
会員様限定ページへのアクセスに必要なログインID及びパスワードを下記にてお知らせいたします。
──────────
ログインID：dup2018
パスワード：dup2018
──────────
※IDとパスワードは同じになります';
		break;
		//----------------------------------------------------------------------------------------------------
		default:
		$res_temp1='この度は、'.$mt_henshin_sender.'のお問い合わせをいただき誠にありがとうございます。
本メールは、お客さまのお問い合わせの受付が、以下の内容で完了しましたことをお知らせするものです。';
	}

	$res_naiyou='━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
'.$_REQUEST['name_k1'].' '.$_REQUEST['name_k2'].'様
'.$res_temp1.'
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
'.$base_naiyou.$nai_under_add.'
※このメールは東新住建株式会社より自動的に配信されています。ご返信いただいてもお答えできませんのでご了承ください。';
		
		//文字コード変換
		$send_naiyou = mb_convert_encoding($send_naiyou,"JIS","utf8");
		$res_naiyou = mb_convert_encoding($res_naiyou,"JIS","utf8");
		
//「SATROI」SATORI送信（cURL）2019.02.04 *+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+
if($_SERVER['SERVER_ADDR'] == "192.168.7.178"){
$c_url = 'http://192.168.7.178/json/index.php'; 
}else{
//$c_url = 'https://api.satr.jp/api/v4/public/customer/upsert.json'; 
$c_url = 'https://www.toshinjyuken.co.jp/send_to_ma_tool/sendto_matool_test_dup.php'; 
}
//電話・携帯判定
if(!preg_match('/(\d{3}-\d{4}-\d{4}|\d{11})/',$_REQUEST['tel1']."-".$_REQUEST['tel2']."-".$_REQUEST['tel3'])){
	$phone_number = $_REQUEST['tel1']."-".$_REQUEST['tel2']."-".$_REQUEST['tel3'];
}else{
	$mobile_phone_number = $_REQUEST['tel1']."-".$_REQUEST['tel2']."-".$_REQUEST['tel3'];
}
//性別変換（性を取る）男性→男、女性→女
$_REQUEST['sex'] = str_replace("性","",$_REQUEST['sex']);
//問い合わせ内容
if (isset($_REQUEST['toinai']) && is_array($_REQUEST['toinai'])) {$con = implode("、", $_REQUEST['toinai']);}
//生年月日
if($_REQUEST['birth_date1'].$_REQUEST['birth_date2'].$_REQUEST['birth_date3'] != "--------"){
	$Seinengappi = $_REQUEST['birth_date1']."年 ".$_REQUEST['birth_date2']."月 ".$_REQUEST['birth_date3']."日";
}

//以下メモ欄に記載
$memo = $con.chr(10);
//ご入居予定人数
if($_REQUEST['ninzuu1'].$_REQUEST['ninzuu2'] != ""){
	$memo .= "ご入居予定人数：".chr(10);
	$memo .= "大人…".$_REQUEST['ninzuu1']."名".chr(10);
	$memo .= "子供…".$_REQUEST['ninzuu2']."名".chr(10);
}
//ご希望の最寄駅
if($_REQUEST['moyori1'].$_REQUEST['moyori2'].$_REQUEST['moyori3'] != ""){
	$memo .= "ご希望の最寄駅：".chr(10);
	$memo .= "第一希望…".$_REQUEST['moyori1']."駅".chr(10);
	$memo .= "第二希望…".$_REQUEST['moyori2']."駅".chr(10);
	$memo .= "第三希望…".$_REQUEST['moyori3']."駅".chr(10);
}
$memo .= $_REQUEST['other_txt'];


//その他メモに追加するもの
/*
switch($p_title){
	case 'ご見学前アンケート':
	$memo .=chr(10).chr(10).chr(10).'【'.$p_title.' 追加分】'.chr(10).'↓'.chr(10).chr(10);
	foreach($form_arr_name as $k => $v){
		if(!is_numeric($k)){
			$memo .=SEND_WORD($k);
		}
	}
	break;
}
*/



// 渡したいパラメータ
$params = array(
//    'user_key' => '378fdb03f7456c4be842ff425707f8f9',
//    'user_secret' => 'b336e796079c1ee8ee605c1dd773769b',
    'user_key' => '40566510eaf6d9031a456163e1ea89a8',
    'user_secret' => 'eaaf02c99d52d46c20cb0db9c88e14b2',
//    'company_key' => '1ced76496e25c04c2615262b68e34277',
//    'company_secret' => '036ada153e6e382e8340ad2cc6427d69',
    'company_key' => '1ced76496e25c04c2615262b68e34277',
    'company_secret' => '036ada153e6e382e8340ad2cc6427d69',
    'customer[identity_type]' => 'email',
    'customer[email]' => $_REQUEST['mail'],
    'customer[collection_route]' => '['.$p_title.']'.$mt_henshin_sender,
    'customer[collection_date]' => date("Y-m-d"),
    'customer[last_name]' => $_REQUEST['name_k1'],
    'customer[first_name]' => $_REQUEST['name_k2'],
    'customer[last_name_reading]' => $_REQUEST['name_f1'],
    'customer[first_name_reading]' => $_REQUEST['name_f2'],
    'customer[phone_number]' => $phone_number,
    'customer[mobile_phone_number]' => $mobile_phone_number,
    'customer[address]' => $_REQUEST['addr'],
    'customer[lead_company_name]' => $_REQUEST['job'],
    'customer[memo]' => $memo,
    'customer[delivery_permission]' => 'approval',
    'customer[custom:Seinengappi]' => $Seinengappi,
    'customer[custom:Bukken]' => $_REQUEST['kiboubukken'],
    'customer[custom:Raijou]' => $_REQUEST['yoyaku_date'].$_REQUEST['yoyaku_time'],
    'customer[custom:seibetsu]' => $_REQUEST['sex'],
    'customer[custom:banchi_mansyon]' => $_REQUEST['banchi'],
    'customer[custom:yubin]' => $_REQUEST['pos1']."-".$_REQUEST['pos2']
);

$curl = curl_init($c_url);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_SSLVERSION, 6); 

$response = curl_exec($curl);
$result = json_decode($response, true);

$res = $result["status"] === 200 ? true : false;
$curl_res = "";
if($res === false){
	$send_naiyou = mb_convert_encoding("下記エラーによりSATORIに登録されていない可能性があります。".chr(10)."<".$curl.":".curl_error($curl).":".$response.":".$result.">"."[".$result["status"]."]".$result["message"].chr(10),"JIS","utf8").$send_naiyou;
}else{
	$curl_res = "&c=".$result["message"]["customer[hashcode]"]."-00";
}
curl_close($curl);
//「SATORI」送信終了　*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+

		//メール送信
		//$mail_title = $mail_title_mb = mb_convert_encoding($mt_soushin,"JIS","utf8");
		//$mail_title = "=?iso-2022-jp?B?".base64_encode($mail_title). "?=";
		for($i=0;$i<count($to_mail);$i++){
			mb_send_mail($to_mail[$i],$mt_soushin,$send_naiyou,'from: '.$from_mail,'-f'.$from_mail);
			//mail($to_mail[$i],$mail_title,$send_naiyou,'from: '.$from_mail,'-f'.$from_mail);
		}
		
		//メール返信
		//$mail_title = $mail_title_mb = mb_convert_encoding($mt_henshin,"JIS","utf8");
		//$mail_title = "=?iso-2022-jp?B?".base64_encode($mail_title). "?=";
		mb_send_mail($from_mail,$mt_henshin,$res_naiyou,'from: '.$to_mail[0],'-f'.$to_mail[0]);
		//mail($from_mail,$mail_title,$res_naiyou,'from: '.$to_mail[0],'-f'.$to_mail[0]);
		
		/*
		$add='page='.$_REQUEST['thanks'];
		if($_REQUEST['sm_direct']!=''){			
				switch($_REQUEST['thanks']){
					case 'residence':
						$add.='&id='.$_GET['id'];
						if($_GET['place']!=''){$add.='&place='.$_GET['place'];}
					break;
				}
				header("Location: thanks.php?".$add);
				exit();		
		}
		else{
		}*/
		
		if($_REQUEST['yoyaku_check']!=''){
			$curl_res.='&questionnaire=true';
		}
		
		switch($p_type){
			case 'form-thanks':
			//header("Location: ".$now_page."&send=complete#contact"); //2019.2.5 SATORI対応
			header("Location: ".$now_page."thanks.php");
			break;
			case 'info-detail':
			//header("Location: ".$now_page."&send=complete#contact"); //2019.2.5 SATORI対応
			header("Location: ".$now_page."&send=complete".$curl_res."#contact");
			break;
			default:
			//header("Location: ".$now_page."?send=complete"); //2019.2.5 SATORI対応
			header("Location: ".$now_page."?send=complete".$curl_res);
		}			
    exit();

	break;
	case ($_REQUEST['sm_conf']!=''):
	//確認
	$step=3;
	break;
	/*
			エラーメッセージはJクエリでリアルタイムで表示
	*/
	default:
	//入力
	$step=1;
}


//◆JAVA追加
$temp_java.='<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="'.$kaisou.'js/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8"></script>
<script src="'.$kaisou.'js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
$(window).load(function () {
	
//validationEngine設定
$("#form").validationEngine();

//必須項目初期化
$(".required").each(function(){
	INPUTEND($(this),"form");
});
$(".required").focus(function(){
	$(this).removeClass("err_bg");
	$(this).parent().find(".formError").remove();
});
//必須項目入力後処理
$(".required").blur(function(){
	INPUTEND($(this),"form");
});

//入力後処理関数
function INPUTEND(obj,type){
	if(obj.parent().find(".formError").length){
		obj.addClass("err_bg");
	}
	else if(obj.val()==""){
		obj.addClass("err_bg");
	}
	/*
	else{
		obj.removeClass("err_bg");
	}
	*/
}

});
</script>'.chr(10);



//◆関数
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
<span class="err_block list">
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','詳しい話が聞きたい',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','資料が欲しい',$arr).'
'.FORM_CHECK($key,'required validate[minCheckbox[1]]','事前審査をする',$arr).'
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
		/*
		case '':
		$str=''.chr(10);
		break;
		*/
	}
	return $str;
}

function FORM_CONFIRMATION($cate){
	switch($cate){
		//----------------------------------------------------------------------------------------------------
		case '名前漢字':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">お名前（漢字）</th>
<td>'.$_REQUEST['name_k1'].'　'.$_REQUEST['name_k2'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('name_k1','name_k2')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '名前フリガナ':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">お名前（フリガナ）</th>
<td>'.$_REQUEST['name_f1'].'　'.$_REQUEST['name_f2'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('name_f1','name_f2')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '年齢性別':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">ご年齢</th>
<td>'.$_REQUEST['age'].'</td>
</tr></table>
<div class="clear" style="height:30px;"></div>
<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">性別</th>
<td>'.$_REQUEST['sex'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('age','sex')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '性別生年月日':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">性別</th>
<td>'.$_REQUEST['sex'].'</td>
</tr></table>
<div class="clear" style="height:30px;"></div>
<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">生年月日（西暦）</th>
<td>'.$_REQUEST['birth_date1'].'年 '.$_REQUEST['birth_date2'].'月 '.$_REQUEST['birth_date3'].'日</td>
</tr></table>
'.INPUT_HIDDEN(array('sex','birth_date1','birth_date2','birth_date3')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '電話番号':
		case '電話番号*':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">お電話番号</th>
<td>'.$_REQUEST['tel1'].'-'.$_REQUEST['tel2'].'-'.$_REQUEST['tel3'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('tel1','tel2','tel3')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '郵便番号':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">郵便番号</th>
<td>'.$_REQUEST['pos1'].'-'.$_REQUEST['pos2'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('pos1','pos2')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '住所':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">ご住所</th>
<td>'.$_REQUEST['addr'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('addr')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '番地・マンション名':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">番地・マンション名</th>
<td>'.$_REQUEST['banchi'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('banchi')).chr(10);//確認画面ではまだ住所と統合しない。
		break;
		//----------------------------------------------------------------------------------------------------
		case 'メール':
		case 'メールアドレス(携帯メール可)':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">メールアドレス</th>
<td>'.$_REQUEST['mail'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('mail')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご職業':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">ご職業</th>
<td>'.$_REQUEST['job'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('job')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'パスコード':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">パスコード</th>
<td>'.$_REQUEST['pass'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('pass')).chr(10);
		break;
		
		//----------------------------------------------------------------------------------------------------
		case 'お問い合わせ内容':
		if (isset($_REQUEST['toinai']) && is_array($_REQUEST['toinai'])) {$con = implode("、", $_POST['toinai']);}
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">お問い合わせ内容</th>
<td>'.$con.'</td>
</tr></table>
'.INPUT_HIDDEN_MULTIPLE('toinai').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'その他':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">その他ご要望等</th>
<td>'.WORD_BR($_REQUEST['other_txt']).'</td>
</tr></table>
'.INPUT_HIDDEN(array('other_txt')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご入居予定人数':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th rowspan="2" class="bg_green">ご入居予定人数</th>
<td>大人　'.$_REQUEST['ninzuu1'].'名</td>
</tr><tr>
<td>子供　'.$_REQUEST['ninzuu2'].'名</td>
</tr></table>
'.INPUT_HIDDEN(array('ninzuu1','ninzuu2')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご希望物件名':
		case 'ご希望物件名-選択':
		case '物件名-選択':
		$s_title=str_replace(array("-選択"),'',$cate);
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$s_title.'</th>
<td>'.$_REQUEST['kiboubukken'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('kiboubukken')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご希望の最寄駅':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th rowspan="3" class="bg_green">ご希望の最寄駅</th>
<td>第一希望　'.$_REQUEST['moyori1'].'駅</td>
</tr><tr>
<td>第二希望　'.$_REQUEST['moyori2'].'駅</td>
</tr><tr>
<td>第三希望　'.$_REQUEST['moyori3'].'駅</td>
</tr></table>
'.INPUT_HIDDEN(array('moyori1','moyori2','moyori3')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '現地ご来場予約':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">現地ご来場予約</th>
<td>'.$_REQUEST['yoyaku_check'].(($_REQUEST['yoyaku_check']!='')?'（ご来場希望日時：'.$_REQUEST['yoyaku_date'].' '.$_REQUEST['yoyaku_time'].'）':'しない').'</td>
</tr></table>
'.INPUT_HIDDEN(array('yoyaku_check','yoyaku_date','yoyaku_time')).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆ご見学前アンケート関連
		//----------------------------------------------------------------------------------------------------
		case 'ご希望見学日':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2',$key.'3',$key.'4');
		$cnt=0;
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$_REQUEST[$arr[$cnt++]].'月 '.$_REQUEST[$arr[$cnt++]].'日 '.$_REQUEST[$arr[$cnt++]].'時 '.$_REQUEST[$arr[$cnt++]].'分</td>
</tr></table>
'.INPUT_HIDDEN($arr).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '物件を知ったキッカケ':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'t1',$key.'t2');
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			$str.=(($str!='')?'、':'').$v;
			switch($v){
				case '知人の紹介':
				if(!empty($_REQUEST[$arr[0]])){
					$str.=':'.$_REQUEST[$arr[0]];
				}
				break;
				case 'その他':
				if(!empty($_REQUEST[$arr[1]])){
					$str.=':'.$_REQUEST[$arr[1]];
				}
				break;
				default:
			}
		}
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$str.'</td>
</tr></table>
'.INPUT_HIDDEN_MULTIPLE($key).INPUT_HIDDEN($arr).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '検討開始時期':
		$key=FORM_SETNAME($cate);
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$_REQUEST[$key].'</td>
</tr></table>
'.INPUT_HIDDEN(array($key)).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '生年月日（西暦）':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2',$key.'3');
		$cnt=0;
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$_REQUEST[$arr[$cnt++]].'年 '.$_REQUEST[$arr[$cnt++]].'月 '.$_REQUEST[$arr[$cnt++]].'日</td>
</tr></table>
'.INPUT_HIDDEN($arr).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご本人様実家':
		case '配偶者様実家':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2');
		$cnt=0;
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$_REQUEST[$arr[$cnt++]].$_REQUEST[$arr[$cnt++]].'</td>
</tr></table>
'.INPUT_HIDDEN($arr).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '現在のお住まい':
		case '購入予定物件':
		case '2世帯をお考えの方':
		$key=FORM_SETNAME($cate);
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			$str.=(($str!='')?'、':'').$v;
		}
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$str.'</td>
</tr></table>
'.INPUT_HIDDEN_MULTIPLE($key).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご入居予定の家族構成':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2',$key.'3',$key.'4',$key.'5',$key.'6');
		$str='';
		foreach($arr as $k => $v){
			$str.=(($str!='')?'<div style="height:0.5em;"></div>':'');
			switch($k){
				case 0:
				$str.=$_REQUEST[$v].'名';
				break;
				case 1:
				$str.='配偶者様：'.$_REQUEST[$v].'歳';
				break;
				case 2:
				$str.='お子様：'.$_REQUEST[$v].'歳';
				break;
				case 3:
				$str.='兄弟姉妹：'.$_REQUEST[$v].'歳';
				break;
				case 4:
				case 5:
				$str.='ご両親様：'.$_REQUEST[$v].'歳';
				break;
				default:
			}
		}
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$str.'</td>
</tr></table>
'.INPUT_HIDDEN($arr).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'お勤め先（ご本人様）':
		case 'お勤め先（配偶者様）':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'t');
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			$str.=(($str!='')?'、':'').$v;
			switch($v){
				case 'その他':
				if(!empty($_REQUEST[$arr[0]])){
					$str.=':'.$_REQUEST[$arr[0]];
				}
				break;
				default:
			}
		}
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$str.'</td>
</tr></table>
'.INPUT_HIDDEN_MULTIPLE($key).INPUT_HIDDEN($arr).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '自己資金':
		$key=FORM_SETNAME($cate);
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$_REQUEST[$key].'万円位</td>
</tr></table>
'.INPUT_HIDDEN(array($key)).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '返済中のローン':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2');
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td>'.$_REQUEST[$arr[0]].((!empty($_REQUEST[$arr[1]]))?' ＋ お気軽試算計画表をもらう':'').'</td>
</tr></table>
'.INPUT_HIDDEN($arr).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '来訪時に聞きたいこと':
		$key=FORM_SETNAME($cate);
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
<td class="LH150">'.WORD_BR($_REQUEST[$key]).'</td>
</tr></table>
'.INPUT_HIDDEN(array($key)).chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		/*
		case '':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">***</th>
<td>***</td>
</tr></table>
'.INPUT_HIDDEN(array('***','***','***')).chr(10);
		break;
		*/
	}
	return $str;
}
function INPUT_HIDDEN($name){
	$str='';
	for($i=0;$i<count($name);$i++){
		$str.='<input type="hidden" name="'.$name[$i].'" id="'.$name[$i].'" value="'.$_REQUEST[$name[$i]].'">'.chr(10);
	}
	return $str;
}
function INPUT_HIDDEN_MULTIPLE($name){
	$str='';
	for($i=0;$i<count($_REQUEST[$name]);$i++){
		$str.='<input type="hidden" name="'.$name.'[]" id="'.$name.$i.'" value="'.$_REQUEST[$name][$i].'">'.chr(10);
	}
	return $str;
}

function SEND_WORD($cate){
	switch($cate){
		case '名前漢字':
		$str=chr(10)."●お名前（漢字）：".$_REQUEST['name_k1']."　".$_REQUEST['name_k2'].chr(10);
		break;
		case '名前フリガナ':
		$str=chr(10)."●お名前（フリガナ）：".$_REQUEST['name_f1']."　".$_REQUEST['name_f2'].chr(10);
		break;
		case '年齢性別':
		$str=chr(10)."●ご年齢：".$_REQUEST['age']."

●性別：".$_REQUEST['sex'].chr(10);
		break;
		case '性別生年月日':
		$str=chr(10)."●性別：".$_REQUEST['sex']."
		
●生年月日（西暦）：".$_REQUEST['birth_date1']."年 ".$_REQUEST['birth_date2']."月 ".$_REQUEST['birth_date3']."日".chr(10);
		break;
		case '電話番号':
		case '電話番号*':
		$str=chr(10)."●お電話番号：".$_REQUEST['tel1']."-".$_REQUEST['tel2']."-".$_REQUEST['tel3'].chr(10);
		break;
		case '郵便番号':
		$str=chr(10)."●郵便番号：".$_REQUEST['pos1']."-".$_REQUEST['pos2'].chr(10);
		break;
		case '住所':
		$str=chr(10)."●ご住所：".$_REQUEST['addr'].$_REQUEST['banchi'].chr(10);//メールでは番地と統合する。
		break;
		/*
		case '番地・マンション名':
		$str=chr(10)."●番地・マンション名：".$_REQUEST['banchi'].chr(10);
		break;
		*/
		case 'メール':
		case 'メールアドレス(携帯メール可)':
		$str=chr(10)."●メールアドレス：".$_REQUEST['mail'].chr(10);
		break;
		case 'ご職業':
		$str=chr(10)."●ご職業：".$_REQUEST['job'].chr(10);
		break;
		case 'パスコード':
		$str=chr(10)."●パスコード：".$_REQUEST['pass'].chr(10);
		break;
		case 'お問い合わせ内容':
		if (isset($_POST['toinai']) && is_array($_POST['toinai'])) {$con = implode("、", $_POST['toinai']);}
		$str=chr(10)."●お問い合わせ内容：".$con.chr(10);
		break;
		case 'その他':
		$str=chr(10)."●その他ご要望等：".$_REQUEST['other_txt'].chr(10);
		break;
		case 'ご入居予定人数':
		$str=chr(10)."●ご入居予定人数：
　大人…".$_REQUEST['ninzuu1']."名
　子供…".$_REQUEST['ninzuu2']."名".chr(10);
		break;
		case 'ご希望物件名':
		case 'ご希望物件名-選択':
		case '物件名-選択':
		$s_title=str_replace(array("-選択"),'',$cate);
		$str=chr(10)."●".$s_title."：".$_REQUEST['kiboubukken'].chr(10);
		break;
		case 'ご希望の最寄駅':
		$str=chr(10)."●ご希望の最寄駅：
　第一希望…".$_REQUEST['moyori1']."駅
　第二希望…".$_REQUEST['moyori2']."駅
　第三希望…".$_REQUEST['moyori3']."駅".chr(10);
		break;
		case '現地ご来場予約':
		$str=chr(10)."●現地ご来場予約：";
		if($_REQUEST['yoyaku_check']!=''){
			$str.="する
　ご希望日……".$_REQUEST['yoyaku_date']."
　ご希望時間…".$_REQUEST['yoyaku_time'].chr(10);
		}
		else{$str.="しない".chr(10);}
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆ご見学前アンケート関連
		//----------------------------------------------------------------------------------------------------
		case 'ご希望見学日':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2',$key.'3',$key.'4');
		$cnt=0;
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[$cnt++]].'月 '.$_REQUEST[$arr[$cnt++]].'日 '.$_REQUEST[$arr[$cnt++]].'時 '.$_REQUEST[$arr[$cnt++]].'分'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '物件を知ったキッカケ':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'t1',$key.'t2');
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			$str.=(($str!='')?'、':'').$v;
			switch($v){
				case '知人の紹介':
				if(!empty($_REQUEST[$arr[0]])){
					$str.=':'.$_REQUEST[$arr[0]];
				}
				break;
				case 'その他':
				if(!empty($_REQUEST[$arr[1]])){
					$str.=':'.$_REQUEST[$arr[1]];
				}
				break;
				default:
			}
		}
		$str=chr(10).'●'.$cate.'：'.chr(10).$str.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '検討開始時期':
		$key=FORM_SETNAME($cate);
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$key].chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '生年月日（西暦）':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2',$key.'3');
		$cnt=0;
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[$cnt++]].'年 '.$_REQUEST[$arr[$cnt++]].'月 '.$_REQUEST[$arr[$cnt++]].'日'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご本人様実家':
		case '配偶者様実家':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2');
		$cnt=0;
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[$cnt++]].$_REQUEST[$arr[$cnt++]].chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '現在のお住まい':
		case '購入予定物件':
		$key=FORM_SETNAME($cate);
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			$str.=(($str!='')?'、':'').$v;
		}
		$str=chr(10).'●'.$cate.'：'.chr(10).$str.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご入居予定の家族構成':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2',$key.'3',$key.'4',$key.'5',$key.'6');
		$str=chr(10).'●'.$cate.'：'.chr(10);
		foreach($arr as $k => $v){
			switch($k){
				case 0:
				$str.=$_REQUEST[$v].'名';
				break;
				case 1:
				$str.=chr(10).'配偶者様：'.$_REQUEST[$v].'歳';
				break;
				case 2:
				$str.=chr(10).'お子様：'.$_REQUEST[$v].'歳';
				break;
				case 3:
				$str.=chr(10).'兄弟姉妹：'.$_REQUEST[$v].'歳';
				break;
				case 4:
				case 5:
				$str.=chr(10).'ご両親様：'.$_REQUEST[$v].'歳';
				break;
				default:
			}
		}
		$str.=chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'お勤め先（ご本人様）':
		case 'お勤め先（配偶者様）':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'t');
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			$str.=(($str!='')?'、':'').$v;
			switch($v){
				case 'その他':
				if(!empty($_REQUEST[$arr[0]])){
					$str.=':'.$_REQUEST[$arr[0]];
				}
				break;
				default:
			}
		}
		$str=chr(10).'●'.$cate.'：'.chr(10).$str.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '自己資金':
		$key=FORM_SETNAME($cate);
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$key].'万円位'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '返済中のローン':
		$key=FORM_SETNAME($cate);
		$arr=array($key.'1',$key.'2');
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[0]].((!empty($_REQUEST[$arr[1]]))?' ＋ お気軽試算計画表をもらう':'').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '2世帯をお考えの方':
		$key=FORM_SETNAME($cate);
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			if(!empty($v)){
				$str.=$v;
			}
			else{
				$str.='-';
			}
		}
		$str=chr(10).'●'.$cate.'：'.$str.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '来訪時に聞きたいこと':
		$key=FORM_SETNAME($cate);
		$str=chr(10).'●'.$cate.'：'.chr(10).$_REQUEST[$key].chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		/*
		case '':
		$str=chr(10)."".chr(10);
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
function FORM_RADIO($name,$class,$val){
	if($_REQUEST[$name]==$val){$add='checked';}
	else{$add='';}
	return '<span class="pad"><input name="'.$name.'" id="'.$name.'" type="radio" class="form_check '.$class.'" value="'.$val.'" '.$add.'>
'.$val.'</span>';
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