<?php
//<meta charset="utf-8">
/*
	【2023ver・DUP用】
		東新住建の家・そだつ・テイシャク・平屋のフォームプログラムを一つにまとめたものを
		DUP用にカスタマイズしたもの。
*/

session_start();

//差分PHP読み込み
include $dir_form_parts."set/sendtext-contact.php";//2024追加
require $dir_form_parts."parts.php";//2023ver

//recaptcha読み込み
$recaptcha_flag=true;//本番環境しかない
require_once $kaisou.'temp_php/func-recaptcha.php';//既存のrecapchaを使用
$temp_java.='<script src="https://www.google.com/recaptcha/api.js"></script>'.chr(10);//専用のjavascriptも読み込む

//[0]が空白の時はkeyと同じ
foreach($form_arr as $key => $val){
	switch($val[0]){
		case '':
		case '*':
		$form_arr[$key][0]=$key.$form_arr[$key][0];
		break;
	}
}

//◆追加JAVAスクリプト
$temp_java.='<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="'.$kaisou.'js/jquery.validationEngine.js" charset="UTF-8"></script>
<script src="'.$kaisou.'js/jquery.validationEngine-ja.js" charset="UTF-8"></script>
<script src="'.$kaisou.'js/form.js" charset="UTF-8"></script>'.chr(10);

//◆リファラチェック
/*
$referer_check=false;
if(isset($_SERVER['HTTP_REFERER'])){
//もしリファラがある場合
	$parse_referer = parse_url($_SERVER['HTTP_REFERER']);
	if(strcmp ($parse_referer['host'],$_SERVER['HTTP_HOST'])!==0){
	//リファラとHTTP_HOSTを比較して異なった場合はアウト
		$referer_check=true;
	}
}
*/
//else{$referer_check=false;}//リファラの無い直リンク

//◆BANチェック
/*
if(!$referer_check){
	$ban_check=SEND_BAN(array
	('emp_name'=>array()
	,'ban_name'=>array()
	,'ban_word'=>array()
	));
}
*/

//◆メール処理分岐

//空の$_REQUEST初期化（PHP7.0対応）
if(!isset($_REQUEST['sm_send'])){$_REQUEST['sm_send']='';}
if(!isset($_REQUEST['sm_direct'])){$_REQUEST['sm_direct']='';}
if(!isset($_REQUEST['sm_back'])){$_REQUEST['sm_back']='';}
if(!isset($_REQUEST['sm_conf'])){$_REQUEST['sm_conf']='';}
switch(true){
	/*
	case ($referer_check):
	//リファラチェックに引っかかる
	$step=5;
	break;
	case (FUNC_TOKEN('check')&&$_REQUEST['submit_click']):
	//トークンチェックに引っかかる
	$step=7;
	break;
	case ($ban_check&&$_REQUEST['submit_click']):
	//禁止チェックに引っかかる
	$step=6;
	break;
	*/
	case ($get_arr['send']=='complete'):
	//送信完了
	$_SESSION['correction']='';
	$step=4;
	break;
	case ($_REQUEST['sm_send']!=''):
	case ($_REQUEST['sm_direct']!=''):
	//送信・返信処理
	
	$_SESSION=$_REQUEST;
	
	//差分PHP読み込み
	require $dir_form_parts."send.php";//2023ver
	
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");
	
	//▼基本内容セット	
	$sendtext_arr['基本内容']='';
	foreach($form_arr as $key => $val){
		$sendtext_arr['基本内容'].=SEND_WORD($key,$val);
	}
	$sendtext_arr['基本内容'].=chr(10).'------------------------------------------';
	
	//▼送信内容セット
if(!isset($sendtext_arr['送信ヘッダ文'])){$sendtext_arr['送信ヘッダ文']='';}
if($sendtext_arr['送信ヘッダ文']==''){
		$sendtext_arr['送信ヘッダ文']='ホームページよりお問い合わせがありました。';
}
$sendtext_arr['送信内容']='━━━━━━━━━━━━━━━━━━━━━
'.$sendtext_arr['送信ヘッダ文'].'
━━━━━━━━━━━━━━━━━━━━━

【お問い合わせ日時】
'.date( "Y/m/d H:i:s", time() ).'
'.$sendtext_arr['基本内容'];

	//▼返信内容セット
	if(!isset($sendtext_arr['返信ヘッダ文'])){$sendtext_arr['返信ヘッダ文']='';}
	if($sendtext_arr['返信ヘッダ文']==''){
		$sendtext_arr['返信ヘッダ文']='この度は、'.$comp_data['HP名'].'のお問い合わせをいただき誠にありがとうございます。
本メールは、お客さまのお問い合わせの受付が、以下の内容で完了しましたことをお知らせするものです。';
	}

	$sendtext_arr['返信内容']='━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
'.$_REQUEST[$form_arr['名前漢字']['姓']].' '.$_REQUEST[$form_arr['名前漢字']['名']].'様
'.$sendtext_arr['返信ヘッダ文'].'
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
'.$sendtext_arr['基本内容'].chr(10)
.(($str=$sendtext_arr['返信下追加文'])!=''?chr(10).$str.chr(10):'')
.'※このメールは東新住建株式会社より自動的に配信されています。ご返信いただいてもお答えできませんのでご了承ください。';
//.'※このメールは'.$comp_data['HP名'].'より自動的に配信されています。ご返信いただいてもお答えできませんのでご了承ください。';

		//文字コード変換
		$sendtext_arr['送信内容'] = mb_convert_encoding($sendtext_arr['送信内容'],"JIS","utf8");
		$sendtext_arr['返信内容'] = mb_convert_encoding($sendtext_arr['返信内容'],"JIS","utf8");
		
		//添付ファイルがあれば添付ファイルをセット
		$add_h='';
		/*		
		if(isset($_REQUEST['fileupload'])){
			$add_h = "Content-Type: multipart/mixed;boundary=\"__BOUNDARY__\"\n";
			$add_b=$add="--__BOUNDARY__\n";
			$add_b.="Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$data=array();
			$data['dir']=$kaisou.'images/temporary/';
			foreach($_REQUEST['fileupload'] as $k => $v){
				$data['url']=$data['dir'].$v;
				$add.= "Content-Type: application/octet-stream; name=\"{$_REQUEST['filename'][$k]}\"\n";
				$add.= "Content-Disposition: attachment; filename=\"{$_REQUEST['filename'][$k]}\"\n";
				$add.= "Content-Transfer-Encoding: base64\n\n";				
				$add.= chunk_split(base64_encode(file_get_contents($data['url'])))."\n";
				$add.= "--__BOUNDARY__\n";
			}
			$send_naiyou=$add_b.$send_naiyou.chr(10).$add;
			$res_naiyou=$add_b.$res_naiyou.chr(10).$add;
		}
		*/
		
		//送信先
		$sendtext_arr['送信mail']=$_REQUEST['mail'];
		$from_mail = $_REQUEST['mail'];
		$sendtext_arr['受信mail']=$comp_data['MAIL'];
		$to_mail=$comp_data['MAIL'];
		if($comp_data['MAIL']=='mirror'){
			$sendtext_arr['受信mail']=array($sendtext_arr['送信mail']);
		}

		// *+*+*+*+*+*+* SATORI関連の処理実行 *+*+*+*+*+*+* 2020.7.31追加
		require $kaisou."temp_php/form_parts/satori.php";//SATORIに関しては個々のHPのsatori.phpを引き続き使用

		//メール送信
		$sender=(isset($comp_data['MAIL-sender']))?$comp_data['MAIL-sender']:$sendtext_arr['送信mail'];
		foreach($sendtext_arr['受信mail'] as $v){			
			mb_send_mail($v,$sendtext_arr['送信タイトル'],$sendtext_arr['送信内容'],$add_h.'from: '.$sender,'-f'.$sender);
		}
				
		//メール返信
		switch(true){
			case (isset($sendtext_arr['返信mail']))://別途返信者が設定されているならそちらを最優先
			break;
			case (isset($comp_data['MAIL-noreply'])):
			$sendtext_arr['返信mail']=$comp_data['MAIL-noreply'];//デフォルトのnoreplyが設定されているならそれを適用
			break;
			default:
			$sendtext_arr['返信mail']=$sendtext_arr['受信mail'][0];//返信者の指定がなければ受信者側の代表のmailになる
		}
		mb_send_mail($sendtext_arr['送信mail'],$sendtext_arr['返信タイトル'],$sendtext_arr['返信内容'],$add_h.'from: '.$sendtext_arr['返信mail'],'-f'.$sendtext_arr['返信mail']);

		//ログに書き込む
		/*
		if(isset($form_arr['xxx'])){
			require $kaisou."temp_php/form-logwrite.php";
		}
		*/
		
		//サンクスページに飛ぶ
		$thanks_page=isset($sendtext_arr['サンクスURL'])?$sendtext_arr['サンクスURL']:'';
		if($thanks_page==''){$thanks_page=$_SERVER["SCRIPT_NAME"].'?send=complete';}
		
		$thanks_page.=$curl_res;
		$thanks_page=str_replace('php&','php?',$thanks_page);
		
		header("Location: ".$thanks_page);
    exit();
		
	break;
	case ($_REQUEST['sm_back']!=''):
	//戻るボタン
	$_SESSION=$_REQUEST;
	$mark=(strpos($_REQUEST['page_back'],'?')===false)?'?':'&';
	header("Location: ".$_REQUEST['page_back'].$mark.'input=correction');
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
	case ($get_arr['input']!=''):
	//訂正
	$_REQUEST=$_SESSION;
	$step=2;
	break;
	default:
	//入力
	$step=1;
}
?>