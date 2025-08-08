<?php
//<meta charset="utf-8">
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
		case 'ご来場予約':
		$str=chr(10)."●".$cate."：".$_REQUEST['yoyaku_check'].chr(10);
		switch($_REQUEST['yoyaku_check']){
			case 'しない':
			case '':
			break;
			default:
			$str.="ご希望日……".$_REQUEST['yoyaku_date']."
　ご希望時間…".$_REQUEST['yoyaku_time'].chr(10);
		}
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆ご見学前アンケート関連
		//----------------------------------------------------------------------------------------------------
		case 'ご希望見学日':
		$key=FORM_SETNAME_SEND($cate);
		$arr=array($key.'1',$key.'2',$key.'3',$key.'4');
		$cnt=0;
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[$cnt++]].'月 '.$_REQUEST[$arr[$cnt++]].'日 '.$_REQUEST[$arr[$cnt++]].'時 '.$_REQUEST[$arr[$cnt++]].'分'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '物件を知ったキッカケ':
		$key=FORM_SETNAME_SEND($cate);
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
		$key=FORM_SETNAME_SEND($cate);
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$key].chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '生年月日（西暦）':
		$key=FORM_SETNAME_SEND($cate);
		$arr=array($key.'1',$key.'2',$key.'3');
		$cnt=0;
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[$cnt++]].'年 '.$_REQUEST[$arr[$cnt++]].'月 '.$_REQUEST[$arr[$cnt++]].'日'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご本人様実家':
		case '配偶者様実家':
		$key=FORM_SETNAME_SEND($cate);
		$arr=array($key.'1',$key.'2');
		$cnt=0;
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[$cnt++]].$_REQUEST[$arr[$cnt++]].chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '現在のお住まい':
		case '購入予定物件':
		$key=FORM_SETNAME_SEND($cate);
		$str='';
		foreach($_REQUEST[$key] as $k => $v){
			$str.=(($str!='')?'、':'').$v;
		}
		$str=chr(10).'●'.$cate.'：'.chr(10).$str.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case 'ご入居予定の家族構成':
		$key=FORM_SETNAME_SEND($cate);
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
		$key=FORM_SETNAME_SEND($cate);
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
		$key=FORM_SETNAME_SEND($cate);
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$key].'万円位'.chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '返済中のローン':
		$key=FORM_SETNAME_SEND($cate);
		$arr=array($key.'1',$key.'2');
		$str=chr(10).'●'.$cate.'：'.$_REQUEST[$arr[0]].((!empty($_REQUEST[$arr[1]]))?' ＋ お気軽試算計画表をもらう':'').chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		case '2世帯をお考えの方':
		$key=FORM_SETNAME_SEND($cate);
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
		$key=FORM_SETNAME_SEND($cate);
		$str=chr(10).'●'.$cate.'：'.chr(10).$_REQUEST[$key].chr(10);
		break;
		//----------------------------------------------------------------------------------------------------
		//　◆IoT関連
		//----------------------------------------------------------------------------------------------------
		case 'IoT見学回数':
		$str=chr(10)."●IoT見学回数：".$_REQUEST['IoT_kengaku'].chr(10);
		break;
		/*
		case '':
		$str=chr(10)."".chr(10);
		break;
		*/
	}
	return $str;
}
function THANKS_GETPARAM($thanks=''){
	global $now_page,$curl_res;
	if($thanks!=''){
		//指定のサンクスページに飛ぶ
		$arr=explode('/',$now_page);
		/*
		foreach($arr as $k => $v){
			echo '<!--$arr['.$k.']'.$v.' -->'.chr(10);
		}
		*/
		if(end($arr)==''){
			$now_page.=$thanks;
		}
		else{
			$now_page=str_replace(end($arr),$thanks,$now_page);//最後のファイル名置き換え
		}
	}
	else{
		//同一ページにサンクス表記
		$curl_res='send=complete'.$curl_res;
	}
	if(!empty($curl_res)){
		$now_page.=((strpos($now_page,'?')!==false)?'&':'?').$curl_res;//既に変数が含まれているか否かで「?」と「&」を切り替える
	}
	$now_page=str_replace(array("?&","&&"),array("?","&"),$now_page);//「?&」「&&」の表記を修正
	return $now_page;
}
function FORM_SETNAME_SEND($k){
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
?>