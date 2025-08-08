<?php
//<meta charset="utf-8">

session_start();//セッションスタート

//◆関数（膨大になりすぎたのでファイルを分けた）
//◆　　（exitの後だと読み込みしないので、前の方に配置）
require $kaisou."temp_php/form_parts/01input.php";//入力画面関連
require $kaisou."temp_php/form_parts/02comf.php";	//確認画面関連
require $kaisou."temp_php/form_parts/03send.php"; //送信処理関連

//2023ver
require $kaisou."temp_php/form2023/func-01-input.php";
require $kaisou."temp_php/form2023/func-02-comf.php";
require $kaisou."temp_php/form2023/func-03-send.php";

//recaptcha読み込み
$recaptcha_flag=true;
require_once $kaisou.'temp_php/func-recaptcha.php';
$temp_java.='<script src="https://www.google.com/recaptcha/api.js"></script>'.chr(10);//専用のjavascriptも読み込む


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
	foreach($form_arr_2023 as $k => $v){
		$base_naiyou.=SEND_WORD_2023($k,$v);
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
QUOカード1,000円分を1週間以内を目途にご住所へお届けいたします。
※一世帯様あたり初回１回のみとさせていただきます

本メールは、お客さまのご見学前アンケートの受付が、以下の内容で完了しましたことをお知らせするものです。';
		/*
		$res_temp1='この度は、'.$mt_henshin_sender.'のご見学前アンケートにご協力いただき誠にありがとうございます。
ご来場日当日に現地でQUOカード1,000円分をプレゼントいたします。

本メールは、お客さまのご見学前アンケートの受付が、以下の内容で完了しましたことをお知らせするものです。';
		*/
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


		// *+*+*+*+*+*+* SATORI関連の処理実行 *+*+*+*+*+*+*
		require $kaisou."temp_php/form_parts/satori.php";


		//メール送信
		//$mail_title = $mail_title_mb = mb_convert_encoding($mt_soushin,"JIS","utf8");
		//$mail_title = "=?iso-2022-jp?B?".base64_encode($mail_title). "?=";
		$sender_mail='dup@toshinjyuken.co.jp';
		for($i=0;$i<count($to_mail);$i++){
			mb_send_mail($to_mail[$i],$mt_soushin,$send_naiyou,'from: '.$sender_mail,'-f'.$sender_mail);
			//mb_send_mail($to_mail[$i],$mt_soushin,$send_naiyou,'from: '.$from_mail,'-f'.$from_mail);
		}
		
		//メール返信
		//$mail_title = $mail_title_mb = mb_convert_encoding($mt_henshin,"JIS","utf8");
		//$mail_title = "=?iso-2022-jp?B?".base64_encode($mail_title). "?=";		
		$noreply_mail='dup@toshinjyuken.co.jp';
		mb_send_mail($from_mail,$mt_henshin,$res_naiyou,'from: '.$noreply_mail,'-f'.$noreply_mail);
		//mb_send_mail($from_mail,$mt_henshin,$res_naiyou,'from: '.$to_mail[0],'-f'.$to_mail[0]);
		
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
		
		switch(true){
			case ($_REQUEST['yoyaku_check']!=''):
			case ($_REQUEST['IoT_kengaku']=='初めての見学'):
			$curl_res.='&questionnaire=true';
			break;
		}
		
		switch($p_type){
			case 'form-thanks':
			//header("Location: ".$now_page."&send=complete#contact"); //2019.2.5 SATORI対応			
			header("Location: ".THANKS_GETPARAM((!empty($thanks_page_link)?$thanks_page_link:'thanks.php')));
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
	//=== ▼ recaptcha ▼ ===
	if($recaptcha_flag&&$captcha_err){
		$step=1;
		$recaptcha_step=true;
	}
	//=== ▲ recaptcha ▲ ===
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
?>