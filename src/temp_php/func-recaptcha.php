<?php
//<meta charset="utf-8">

//リキャプチャエラー判定
$captcha_err=$recaptcha_step=false;
if($recaptcha_flag){
	$captcha;
	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
	}
	if(!$captcha){
		$captcha_err=true;
	}
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfBjIwfAAAAABChm0VfxxyxRnmV6vh2-f61D7gL&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
}

function RECAPTCHA_CHECK(){
	global $recaptcha_flag,$recaptcha_step;//エラーメッセージフラグ
	if($recaptcha_flag){
?>
<style>
.g-recaptcha{margin-top: 50px;}
.g-recaptcha > *{margin: auto;}
.recaptcha_err{
	margin-bottom: 50px;
	text-align: center;
}
.recaptcha_err > *{
	display: inline-block;
	margin: auto;
	margin-top: 25px;
	background-color: #F00;
	color: #FFF;
	padding: 0.5em 0.75em;
	border-radius: 2em;
	-webkit-border-radius: 2em;
	-moz-border-radius: 2em;
	box-shadow: 1px 1px 0px 0px rgba(0,0,0,0.2);
	-webkit-box-shadow: 1px 1px 0px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 1px 1px 0px 0px rgba(0,0,0,0.2);
}
</style>
<div class="g-recaptcha" data-sitekey="6LfBjIwfAAAAADuczvE0y987zd3R7E5n68Fd_lJt"></div>
<div class="recaptcha_err"><?php
if($recaptcha_step){echo '<div>reCAPTCHA にチェックを入れて下さい。</div>';}
?></div><?php
/*
<div style="display: none;">
<?php
print_r($_POST['g-recaptcha-response']);
global $response;
print_r($response);
print_r($_SERVER['REMOTE_ADDR']);
?>
</div>
*/
	}
}

/*

▼form.phpの上部に埋め込む

//recaptcha読み込み
$recaptcha_flag=($democheck=='')?true:false;//本番環境か否か
$recaptcha_url=$recaptcha_flag?'../recaptcha/':'../toushin-recaptcha/';
require_once $kaisou.$recaptcha_url.'func-recaptcha.php';
$temp_java.='<script src="https://www.google.com/recaptcha/api.js"></script>'.chr(10);//専用のjavascriptも読み込む


▼step分岐の確認ページ部分の下側に追記

	//=== ▼ recaptcha ▼ ===
	if($recaptcha_flag&&$captcha_err){
		$step=1;
		$recaptcha_step=true;
	}
	//=== ▲ recaptcha ▲ ===


▼各お問い合わせページの送信確認ボタンの直前に追記

RECAPTCHA_CHECK();//recaptchaチェック表示

*/
?>