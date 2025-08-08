<?php
//<meta charset="utf-8">

//フォームのセット（東新住建の家に合わせる）
$form_arr=array
('hr'//----------
,'名前漢字'			=>array('お名前（漢字）*','姓'=>'name_k1','名'=>'name_k2','type'=>'name')
,'hr'//----------
,'メール'			 =>array('メールアドレス*','mail','mail_c')
,'hr'//----------
,'ご予算'			 =>array('*','budget','select'=>array('～2,500万円'
																										,'～3,000万円'
																										,'～3,500万円'
																										,'～4,000万円'
																										,'4,000万円～'
																								 		),'type'=>'radio')
,'hr'//----------
,'ご希望エリア'	=>array('*','kibouarea')//チェック項目は↓で設定
,'hr'//----------
,'同意'					=>array('「個人情報保護方針」への同意*'	,'doui','select'=>array('同意する')
								//,'caution'=>'※下記をお読みいただき、個人情報の取扱いについてご確認ください。'//DUPは無し
								)
//----------
//,''							=>array('---*'	,'')
);

//エリアデータ読み込み（東新住建の家のエリアデータを読み込む）
$url=$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
switch(true){
	case (strpos($url,'/kodate/')!==false)://東新住建の家
	/*
			「data-area.php」の「$area_list_num」、「$area_list」を
			そのまま使用する
	*/
	break;
	case (strpos($url,'/sodatsu/')!==false)://そだつ
	case (strpos($url,'/teishaku/')!==false):
	case (strpos($url,'/teishaku-portal/')!==false)://テイシャク
	case (strpos($url,'/hiraya/')!==false)://平屋
	/*
			東新住建の家の「data-area.php」を読み込む
			→元々のサイトで読み込まれていた変数は上書きされる
	*/
	include '../kodate/temp_php/data-area.php';
	break;
	case (strpos($url,'dup-m.jp')!==false)://DUPレジデンス
	/*
			DUP用に入れた「data-area.php」を使用
	*/
	include $dir_form_parts.'set/data-area.php';
	break;
}

//ご希望エリア・チェック項目設定
$cnt=1;
foreach($area_list as $k1 => $v1){
	$form_arr['ご希望エリア']['select'.$cnt]=array();
	foreach($v1 as $k2 => $v2){
		$form_arr['ご希望エリア']['select'.$cnt][]=$v2;
	}
	$cnt++;
}
?>