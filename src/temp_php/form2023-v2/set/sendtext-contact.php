<?php
//<meta charset="utf-8">
/*
		「見学予約をする」を選択した時のみメッセージを追加する。
*/
//print_r($_REQUEST);
$k=$form_arr['お問い合わせの項目'][1];
$v='';
switch(true){
	case isset($_REQUEST[$k]):
	$v=$_REQUEST[$k];
	break;
	case isset($_REQUEST[$k.'_set']):
	$v=$_REQUEST[$k.'_set'];
	break;	
}
if(($v!='')&&(strpos($v,'見学予約')!==false)){
	$sendtext_arr['返信下追加文']='※ご予約状況によっては当日にノベルティをお渡しできない可能性がございます。
その場合は後日郵送にてご対応いたしております。';
}
//print_r($sendtext_arr);
?>