<?php
//<meta charset="utf-8">
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
		case 'ご来場予約':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$cate.'</th>
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
		if(!empty($_REQUEST[$key])){
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
		if(!empty($_REQUEST[$key])){
			foreach($_REQUEST[$key] as $k => $v){
				$str.=(($str!='')?'、':'').$v;
			}
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
		if(!empty($_REQUEST[$key])){
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
		//　◆IoT関連
		//----------------------------------------------------------------------------------------------------
		case 'IoT見学回数':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">IoT見学回数</th>
<td>'.$_REQUEST['IoT_kengaku'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('IoT_kengaku')).chr(10);
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
?>