<?php
//<meta charset="utf-8">
/*
	【2023ver】
		東新住建の家・そだつ・テイシャク・平屋のフォームプログラムを一つにまとめる。
*/

function FORM_STEP($n=1,$prm=array()){
	switch(true){
		case (strpos($_SERVER['SCRIPT_NAME'],'/hiraya/')!==false)://平屋だけサイズが違う
		$prm['sp']='W345H54';
		break;
	}
	$clear=array();
	$clear['pc']=isset($prm['pc'])?$prm['pc']:'W800H50';
	$clear['sp']=isset($prm['sp'])?$prm['sp']:'W380H54';
	return '<img src="images/common/clear-'.$clear['pc'].'.png" class="contact_step step'.$n.' sp_vanish mgnAuto W100per">
<img src="images/common/clear-'.$clear['sp'].'.png" class="contact_step step'.$n.' pc_vanish mgnAuto W100per">';
}
function FORM_CAUTION($n=1){
	$str='';
	switch($n){
		case 1:
		$str='※お問い合わせの際には、個人情報に関する取扱いへの同意が必要です。
文字化けやエラーの原因となりますので、ローマ数字・丸付き数字などの機種依存文字、半角カタカナ（半角文字）は使用しないでください。
住所にローマ数字が含まれる場合、アラビア数字や漢数字に置換えて入力してください。<div><span class="col_F00">＊</span>印は必須項目です。</div>';
	}
	return '<div class="contact_caution sp_br_del LH175">'.WORD_BR($str).'</div>'.chr(10);
}
function FORM_TITLE($a,$dot=true){
	$a[1]=str_replace(array("*"),'<span class="col_F00">＊</span>',$a[1]);
	$dot=($dot)?'<span>・</span>':'';
	if(isset($a[2])){$a[1].=$a[2];}
	return '<div class="contact_title">'.$dot.$a[0].$a[1].'</div>'.chr(10);
}
//----------------------------
function FORM_SET_MAKE(){
	global $form_arr,$hissu,$step;
	global $form_anke_name;
	$str='';
	foreach($form_arr as $k => $v){
		if(!is_numeric($k)){
			//項目関連
			$ttl=str_replace(array("＊","*"),',*',$v[0]);
			$ttl=explode(',',$ttl);
			if(!isset($ttl[1])){$ttl[1]='';}
			$hissu=$ttl[1];
			if(isset($v['type'])){
				$type=$v['type'];
				unset($v['type']);//タイプはもう使わない
			}
			else{
				$type=$k;
			}
			switch($type){
				//共通フォーム
				case 'name':
				case 'tel':
				case 'date':
				case 'textarea':
				case 'radio':
				case 'check':
				case 'select':
				case 'jikka':
				$str.=FORM_TITLE($ttl);
				$str.=FORM_PARTS($v,$type);
				$str.=FORM_INPUT_CAUTION($v);
				break;
				case 'bukken':
				$str.=FORM_TITLE($ttl);
				$str.=FORM_PARTS($v,'select',array('area-cnt'=>true));
				break;
				//固有フォーム
				case '住所':
				//郵便番号、ご住所、番地・マンション名のセット（全て必須）
				$str.=FORM_TITLE(array('郵便番号',$hissu));
				$str.=FORM_PARTS($v,'pos');
				$str.=FORM_TITLE(array('ご住所',$hissu));
				$str.=FORM_PARTS($v[3],'normal-W100');
				$str.=FORM_TITLE(array('番地・マンション名',$hissu));
				$str.=FORM_PARTS($v[4],'normal-W100');
				break;
				case 'メール':
				//ステップによって表示を変える
				$str.=FORM_TITLE(array($ttl[0].'（半角英数字）',$hissu));
				$str.=FORM_PARTS($v[1]);
				if(isset($v[2])&&$step<3){
					$str.=FORM_TITLE(array($ttl[0].'（確認用）（半角英数字）',$hissu));
					$str.=FORM_PARTS($v[2]);
				}
				break;
				case '同意':
				if($step<3){
					$str.=FORM_TITLE($ttl);
					$str.=FORM_PARTS($v,'check');
					$str.=FORM_INPUT_CAUTION($v);
				}	
				break;
				//--- 特殊フォーム ---
				case 'anke':
				if($step<3){
					$str.='<div class="colorbox_anke">
<h3 class="sp_textC pc_br_del">30秒でカンタン！<br>ご来場前アンケート</h3>
<hr>
<div>追加で<b>ご来場前アンケート</b>にご回答いただくと、<br>
よりスムーズなご案内と、より有益なご提案をご提供いたします。<br>
ご協力いただいたお客様に、<br class="pc_vanish"><b class="o">Amazonギフト券1,000円分</b>を<br class="pc_vanish"><b class="o">プレゼント</b>しています。</div>
<div><span class="textL">※ご来場物件数に関わらず、一家族様一回限りとさせていただきます。</span></div>
<div class="anke_check">'.FORM_PARTS($v,'check').'</div>
</div>';
/*
//旧
<div>ご来場予約希望の方は、よろしければ追加の<b>ご来場前アンケート</b>にお進みください。<br>
よりスムーズなご案内と、より有益なご提案をご提供いたします。<br>
ご協力いただいたお客様に、<br class="pc_vanish"><b class="o">QUOカード1,000円分</b>を<br class="pc_vanish">現地で<b class="o">プレゼント</b>しています。</div>
<div><span class="textL">※ご予約状況によっては当日のQUOカードをお渡しできない可能性がございます。その場合は後日郵送にてご対応いたしております。<br>
※ご来場物件数に関わらず、一家族様一回限りとさせていただきます。</span></div>
*/
				}
				else{
					$str.='<hr>'.chr(10);
					$ttl[0]=$form_anke_name;
					$str.=FORM_TITLE($ttl);
					$str.=FORM_PARTS($v,'check');
					$str.='<div style="height:2em;"></div>'.chr(10);
				}				
				break;
				case 'anke_first':
				$str.='<div style="height:2em;"></div>
<h3 class="anke_jizen">'.$k.'</h3>'.chr(10);
				$str.=FORM_TITLE($ttl);
				$str.='<div class="anke_jizen_list">'.FORM_PARTS($v,'check').'</div>';
				break;
				case 'ご入居予定人数':
				$str.=FORM_TITLE($ttl);
				$str.=FORM_PARTS($v,'nyuukyo');
				break;
				case '入居予定の家族構成':
				$str.=FORM_TITLE($ttl);
				$str.=FORM_PARTS($v,'family');
				break;
				case '自己資金':
				$str.=FORM_TITLE($ttl);
				$str.=FORM_PARTS($v[1],'normal',array('class'=>',custom[number] textR','style'=>'width:7em;','placeholder'=>'※ 半角数字','add-after'=>'万円位'));
				break;
				case 'お気軽試算計画表':
				if($step<3){
					$str.='<div style="height:1.5em;"></div>'.chr(10);
					$str.=FORM_PARTS($v,'check');
				}
				else{
					$str.=FORM_TITLE($ttl);
					if(!isset($_REQUEST[$v[1]])){$_REQUEST[$v[1]]='';}
					$p=($_REQUEST[$v[1]]!='')?'お気軽試算計画表をもらう':'もらわない';
					$str.='<div class="contact_inputarea">'.FORM_HIDDEN_ADD($v[1],$p).'</div>'.chr(10);
				}
				break;
				case 'アンケートその他':
				$str.=($step<3)?FORM_TITLE(array('その他、ご質問がありましたらこちらにご記入ください',$hissu),false):FORM_TITLE($ttl);
				$str.=FORM_PARTS($v,'textarea');
				break;
				case 'ご希望エリア':
				if($step<3){
					$ttl[0].='（3か所まで）';
				}
				$str.=FORM_TITLE($ttl);
				$str.='<div class="kibou_area_list">'.FORM_PARTS($v,$v[1]).'</div>';
				break;
				case '希望：読本':
				if($step<3){
					global $dir_contact_img;
					$str.='<style>
.box_kibou_dokuhon{margin-top: 1em;}
.box_kibou_dokuhon > *:nth-child(1){
	font-size: 150%;
	font-weight: bold;
}
</style>
<div class="contact_title">
<img src="'.$dir_contact_img.'bnr-dokuhon-pc.png" class="sp_vanish">
<img src="'.$dir_contact_img.'bnr-dokuhon-sp.png" class="pc_vanish">
</div>';
				}
				else{
					$str.=FORM_TITLE($ttl);
				}
				$str.=FORM_PARTS($v,'radio');
				$str.=FORM_INPUT_CAUTION($v);
				break;
			}
		}
		else{
			//タグ関連
			switch($v){
				case '/div':
					$str.='</div>'.chr(10);
				break;
				case 'hr':
					$str.='<hr>'.chr(10);
				break;
				case 'gray-s':
				$str.='</div></div>
<div class="bg_FFF_gray" style="margin-top:1.5em;"><div class="content_box"><div class="contact_box">'.chr(10);
				break;
				case 'gray-e':
				$str.='</div></div></div>
<div class="content_box"><div class="contact_box">'.chr(10);
				break;
				default:				
				switch(true){
					case (strpos($v,'div=>')!==false):
					$v=str_replace('div=>','',$v);
					$str.='<div class="'.$v.'">'.chr(10);
					break;
					case (strpos($v,'H=>')!==false):
					$v=str_replace('H=>','',$v);
					$str.='<div style="height:'.$v.';"></div>';
					break;
				}
			}
		}
	}
	return $str;
}
//----------------------------
function FORM_PARTS($a,$type='',$prm=array()){
	global $step,$hissu;
	$res='';
	if(!isset($prm['add-after'])){$prm['add-after']='';}
	if($type==''){$type=$a;}
	switch($type){
		case 'name':
		if($step==3){
			$add=array();
			foreach($a as $k => $v){
				if(!is_numeric($k)){
					$add[]=$_REQUEST[$v];
				}
			}
			$add = implode(" ",$add);
			$res.=$add;
		}
		else{
			foreach($a as $k => $v){
				if(!is_numeric($k)){
					$res.='<div class="namebox err_block"><table border="0" cellpadding="0" cellspacing="0"><tr>
					<th>'.$k.'</th><td>'.FORM_TEXT($v).'</td>
					</tr></table></div>';
				}
			}
		}
		break;
		//----------------------------------------
		case 'pos':
		if($step==3){
			$res.=FORM_HIDDEN_ADD($a[1],$_REQUEST[$a[1]].'-'.$_REQUEST[$a[2]]);
		}
		else{
			$res.='<div class="numbox pos err_block"><table border="0" cellpadding="0" cellspacing="0"><tr>
<td>'.FORM_TEXT($a[1]).'</td><td class="pad">－</td><td>'.FORM_TEXT($a[2]).'</td>
</tr></table></div><input type="button" class="pos_addr_btn" value="自動住所入力" onclick="AjaxZip3.zip2addr(\''.$a[1].'\',\''.$a[2].'\',\''.$a[3].'\',\''.$a[3].'\');">';
		}
		break;
		//----------------------------------------
		case 'tel':
		if($step==3){
			$res.=FORM_HIDDEN_ADD($a[1],$_REQUEST[$a[1]].'-'.$_REQUEST[$a[2]].'-'.$_REQUEST[$a[3]]);
		}
		else{
			$res.='<div class="numbox tel err_block"><table border="0" cellpadding="0" cellspacing="0"><tr>
<td>'.FORM_TEXT($a[1],'validate[custom[phone]]').'</td><td class="pad">－</td><td>'.FORM_TEXT($a[2],'validate[custom[phone]]').'</td><td class="pad">－</td><td>'.FORM_TEXT($a[3],'validate[custom[phone]]').'</td>
</tr></table></div>';
		}
		break;
		//----------------------------------------
		case 'jikka':
		if($step==3){
			$res.=FORM_HIDDEN_ADD($a[1],$_REQUEST[$a[1].'-1'].$_REQUEST[$a[1].'-2']);
		}
		else{
			$res.='<div class="normalbox err_block"><span class="dpIB">市：</span>'.FORM_TEXT($a[1].'-1','',array('placeholder'=>'市名')).'<span class="dpIB sp_vanish" style="margin-left:0.25em;">、</span><div class="pc_vanish" style="height:1em;"></div><span class="dpIB">区・町：</span>'.FORM_TEXT($a[1].'-2','',array('placeholder'=>'区町村名')).'</div>'.chr(10);
		}		
		break;
		//----------------------------------------
		case 'nyuukyo':
		$arr=array();
		if($step==3){
			for($i=0;$i<=1;$i++){
				$arr[$i]=$_REQUEST[$a[1].'-'.$i];
			}
		}
		else{
			$arr[0]=FORM_TEXT($a[1].'-0','validate[custom[number]]');
			$arr[1]=FORM_TEXT($a[1].'-1','validate[custom[number]]');
		}
		$res.='<table border="0" cellpadding="0" cellspacing="0" class="sp_tblbreak_limited form_family"><tr>
<td style="width:auto;"><span style="min-width:0;">大人：</span><span class="err_block">'.$arr[0].'</span><span>人<span class="sp_vanish dpIB textC" style="width:3em;">／</span></span></td>
<td style="width:auto;"><span style="min-width:0;">子供：</span><span class="err_block">'.$arr[1].'</span><span>人</span></td>
</tr></table>';
		break;
		//----------------------------------------
		case 'family':
		$arr=array();
		if($step==3){
			for($i=0;$i<=7;$i++){
				$arr[$i]=$_REQUEST[$a[1].'-'.$i];
			}
		}
		else{
			$i=0;
			$arr[]=FORM_TEXT($a[1].'-'.($i++),',custom[number] textR',array('style'=>'width:7em;'));
			$hissu=false;
			$arr[]=FORM_TEXT($a[1].'-'.($i++),',custom[number] textR',array('style'=>'width:7em;'));			
			$arr[]=FORM_TEXT($a[1].'-'.($i++),'validate[custom[number]]');
			$arr[]=FORM_TEXT($a[1].'-'.($i++),'validate[custom[number]]',array('placeholder'=>'1人目'));
			$arr[]=FORM_TEXT($a[1].'-'.($i++),'validate[custom[number]]',array('placeholder'=>'2人目'));
			$arr[]=FORM_TEXT($a[1].'-'.($i++),'validate[custom[number]]',array('placeholder'=>'3人目'));
			$arr[]=FORM_TEXT($a[1].'-'.($i++),'validate[custom[number]]');
			$arr[]=FORM_TEXT($a[1].'-'.($i++),'validate[custom[number]]');
		}
		$i=0;
		$res.='<div class="normalbox"><span class="err_block">'.$arr[$i++].'</span><span class="dpIB" style="margin-left:0.5em;">名</span><span class="dpIB sp_vanish" style="width:4em;"></span><div class="pc_vanish" style="height:0.75em;"></div><span>ご本人様：</span><span class="err_block">'.$arr[$i++].'</span><span class="dpIB" style="margin-left:0.5em;">歳</span></div>'.chr(10);
		$res.='<table border="0" cellpadding="0" cellspacing="0" class="sp_tblbreak_limited W100per form_family"><tr>
<td><span>配偶者様：</span><span class="err_block">'.$arr[$i++].'</span><span>歳<span class="sp_vanish">／</span></span></td>
<td><span>お子様：</span><span class="err_block">'.$arr[$i++].'</span><span>歳<span class="sp_vanish">／</span></span></td>
<td><span>お子様：</span><span class="err_block">'.$arr[$i++].'</span><span>歳<span class="sp_vanish">／</span></span></td>
</tr><tr>
<td><span>お子様：</span><span class="err_block">'.$arr[$i++].'</span><span>歳<span class="sp_vanish">／</span></span></td>
<td><span>ご両親様：</span><span class="err_block">'.$arr[$i++].'</span><span>歳<span class="sp_vanish">／</span></span></td>
<td><span>ご両親様：</span><span class="err_block">'.$arr[$i++].'</span><span>歳</span></td>
</tr></table>';
		break;
		//----------------------------------------
		case 'check':
		$res.=($step==3)?CONF_CHECK($a):FORM_CHECK($a['select'],$a[1]);
		break;
		//----------------------------------------
		case 'radio':
		$res.=($step==3)?CONF_RADIO($a):FORM_RADIO($a['select'],$a[1]);
		break;
		//----------------------------------------
		case 'kibouarea':
		global $area_list;
		if($step==3){
			if(!isset($_REQUEST[$a[1]])){$_REQUEST[$a[1]]='';}
			$check=$_REQUEST[$a[1]];
			$cnt=0;
			foreach($area_list as $k1 => $v1){
				foreach($v1 as $k2 => $v2){
					if(!isset($check[$cnt])){$check[$cnt]='';}
					if($v2==$check[$cnt]){
						$check[$cnt]=$k1.'…'.$v2;
						$cnt++;
					}
				}
			}
			$add = implode(chr(10),$check);
			$res.=FORM_HIDDEN_ADD($a[1],$add);
		}
		else{
			$cnt=1;
			$res.='<div class="kibouarea_box">';
			foreach($area_list as $k1 => $v1){
				$res.='<div class="kibouarea_title">'.$k1.'</div>';
				$a['select'.$cnt]=array();
				foreach($v1 as $k2 => $v2){
					$a['select'.$cnt][]=$v2;
				}
				$res.=FORM_CHECK($a['select'.$cnt],$a[1],',[maxCheckbox[3]]');
				$cnt++;
			}
			$res.='</div>';
		}
		break;
		//----------------------------------------
		case 'kibouarea-B':
		$arr=array();
		if($step==3){
			for($i=0;$i<3;$i++){
				$arr[$i]=$_REQUEST[$a[1].'-'.$i];
			}
		}
		else{
			$arr[0]=FORM_TEXT($a[1].'-0','',array('style'=>'width:auto;text-align:left;'));
			$hissu=false;
			$arr[1]=FORM_TEXT($a[1].'-1','',array('style'=>'width:auto;text-align:left;'));
			$arr[2]=FORM_TEXT($a[1].'-2','',array('style'=>'width:auto;text-align:left;'));
		}
		$res.='<table border="0" cellpadding="0" cellspacing="0" class="sp_tblbreak_limited form_family"><tr>
<td style="width:auto;"><span style="min-width:0;">第一希望：</span><span class="err_block">'.$arr[0].'</span></td>
</tr><tr>
<td style="width:auto;"><span style="min-width:0;">第二希望：</span><span class="err_block">'.$arr[1].'</span></td>
</tr><tr>
<td style="width:auto;"><span style="min-width:0;">第三希望：</span><span class="err_block">'.$arr[2].'</span></td>
</tr></table>';
		break;
		//----------------------------------------
		case 'select':
		$cnt=1;
		if($step==3){
			$add=array();
			foreach($a as $k => $v){
				if(strpos($k,'select')!==false){
					$add[]=$_REQUEST[$a[1].$cnt];
					$cnt++;
				}
			}
			$add = implode(" ",$add);
			$res.=FORM_HIDDEN_ADD($a[1],$add);
		}
		else{
			foreach($a as $k => $v){
				if(strpos($k,'select')!==false){
					$res.=FORM_SELECT($a[$k],$a[1].$cnt);
					$cnt++;
				}
			}
		}
		break;
		//----------------------------------------
		case 'date':
		if($step==3){
			$add=$_REQUEST[$a[1].'_M'].'月 ';
			$add.=$_REQUEST[$a[1].'_D'].'日 ';
			$add.=$_REQUEST[$a[1].'_H'].'時';
			$res.=FORM_HIDDEN_ADD($a[1],$add);
		}
		else{
			$arr=array();
			for($i=0;$i<3;$i++){$arr[$i]=array('-'=>'');}
			for($i=1;$i<=12;$i++){$arr[0][]=$i;}
			for($i=1;$i<=31;$i++){$arr[1][]=$i;}
			for($i=0;$i<=23;$i++){$arr[2][]=$i;}
			$res.=FORM_SELECT($arr[0],$a[1].'_M','',array('end'=>'月'));
			$res.=FORM_SELECT($arr[1],$a[1].'_D','',array('end'=>'日'));
			$res.=FORM_SELECT($arr[2],$a[1].'_H','',array('end'=>'時'));
		}
		break;
		//----------------------------------------
		case 'textarea':
			$res.=($step==3)?WORD_BR($_REQUEST[$a[1]]):'<div class="normalbox err_block">'.FORM_TEXTAREA($a[1]).'</div>';
		break;
		//----------------------------------------
		case 'normal':
			$class=($prm['class']!='')?$prm['class']:'';
			$add_after=(($prm['add-after']!='')?'<span class="dpIB" style="margin-left:0.5em;">'.$prm['add-after'].'</span>':'');
			$res.=($step==3)?$_REQUEST[$a].$add_after:'<div class="normalbox err_block">'.FORM_TEXT($a,$class,$prm).$add_after.'</div>';
		break;
		case 'normal-W100':
			$add_after=(($prm['add-after']!='')?'<span class="dpIB" style="margin-left:0.5em;">'.$prm['add-after'].'</span>':'');
			$res.=($step==3)?$_REQUEST[$a].$add_after:'<div class="normalbox err_block">'.FORM_TEXT($a,' W100per').$add_after.'</div>';
		break;
		case 'mail':
			$res.=($step==3)?$_REQUEST[$a]:'<div class="normalbox err_block">'.FORM_TEXT($a,',custom[email]] W100per').'</div>';
		break;
		case 'mail_c':
			$res.='<div class="normalbox err_block">'.FORM_TEXT($a,',custom[email],equals[mail]] W100per').'</div>';
		break;
	}
	return '<div class="contact_inputarea box_'.$a[1].'">'.$res.'</div>'.chr(10);
}
//----------------------------
function FORM_TEXT($name,$class='',$prm=array()){
	global $hissu;
	if(!isset($_REQUEST[$name])){$_REQUEST[$name]='';}
	if($hissu!=''){
		$class='required validate[required] '.$class;
		$class=str_replace(array("] ,"),',',$class);//特定の表記の時は合体させる
	}
	$add_c='';
	if(strpos($class,'custom[phone]')!==false){$add_c.=' type_ph';}
	$add='';
	if(isset($prm['style'])){$add.=' style="'.$prm['style'].'"';}
	if(isset($prm['placeholder'])){$add.=' placeholder="'.$prm['placeholder'].'"';}
	return '<input type="text" name="'.$name.'" class="'.$class.'" value="'.$_REQUEST[$name].'"'.$add.'>';
}
function FORM_TEXTAREA($name,$class='',$prm=array()){
	global $hissu;
	if(!isset($_REQUEST[$name])){$_REQUEST[$name]='';}
	if($hissu!=''){
		$class='required validate[required] '.$class;
		$class=str_replace(array("] ,"),',',$class);//特定の表記の時は合体させる
	}
	$add='';
	if(isset($prm['placeholder'])){$add.=' placeholder="'.$prm['placeholder'].'"';}
	return '<textarea name="'.$name.'" class="'.$class.'"'.$add.'>'.$_REQUEST[$name].'</textarea>';
}
function FORM_CHECK($arr,$name='',$class='',$prm=array()){
	global $hissu;
	$hissu_bu=$hissu;
	$str=$add='';
	if($hissu!=''){
		$class='required validate[required] '.$class;
		$class=str_replace(array("] ,"),',',$class);//特定の表記の時は合体させる
	}
	if($class!=''){
		$add.=' class="'.$class.'"';
	}
	foreach($arr as $k => $v){
		$check=$textadd='';
		if(!is_array($v)){
			$v=array($v,'x');
		}
		switch(true){
			case (!isset($_REQUEST[$name])):
			break;
			case (array_search($v[0],$_REQUEST[$name])!==false):
			$check=' checked';
			break;
		}
		if($v[1]!='x'){
			$hissu='';
			$textadd=FORM_TEXT($name.'_t'.$k,'',array('placeholder'=>$v[1]));
			$hissu=$hissu_bu;
		}
		else if($v[0]=='その他'){
			$hissu='';
			$textadd=FORM_TEXT($name.'_o');
			$hissu=$hissu_bu;
		}
		$str.='<div class="checkbox err_block"><input type="checkbox" name="'.$name.'[]" value="'.strip_tags($v[0]).'"'.$check.$add.'>'.$v[0].$textadd.'</div>';
	}
	return $str;
}
function FORM_RADIO($arr,$name='',$class='',$prm=array()){
	global $hissu;
	$hissu_bu=$hissu;
	$str=$add='';
	if($hissu!=''){
		$class='required validate[required] '.$class;
		$class=str_replace(array("] ,"),',',$class);//特定の表記の時は合体させる
	}
	if($class!=''){
		$add.=' class="'.$class.'"';
	}
	foreach($arr as $k => $v){
		$check=$textadd='';
		switch(true){
			case (!isset($_REQUEST[$name])):
			break;
			case ($v==$_REQUEST[$name]):
			$check=' checked';
			break;
		}
		if($v=='その他'){
			$hissu='';
			$textadd=FORM_TEXT($name.'_o');
			$hissu=$hissu_bu;
		}
		$str.='<div class="checkbox err_block"><input type="radio" name="'.$name.'" value="'.strip_tags($v).'"'.$check.$add.'>'.$v.$textadd.'</div>';
	}
	return $str;
}
function FORM_SELECT($arr,$name='',$class='',$prm=array()){
	global $hissu;
	$str=$add='';
	if(!isset($_REQUEST[$name])){$_REQUEST[$name]='';}
	if(!isset($prm['end'])){$prm['end']='';}	
	if($hissu!=''){
		$class='required validate[required] '.$class;
		$class=str_replace(array("] ,"),',',$class);//特定の表記の時は合体させる
	}
	if($class!=''){
		$add.=' class="'.$class.'"';
	}
	foreach($arr as $k => $v){
		if(!is_numeric($k)){
			$str='<option value="'.$v.'">'.$k.'</option>';//--- 選択して下さい ---
		}
		else{
			$selected='selected';
			if($_REQUEST[$name]==''){
				$selected='';
			}
			$str.='<option '.(($v==$_REQUEST[$name])?$selected:'').'>'.$v.'</option>'.chr(10);
		}
	}
	return '<div class="selectbox err_block"><select name="'.$name.'"'.$add.'>
'.$str.'
	</select>'.$prm['end'].'</div>';
}
function FORM_INPUT_CAUTION($arr){
	global $step;
	$str='';
	if(($step<3)&&(isset($arr['caution']))){
		$str='<div class="contact_I_caution">'.$arr['caution'].'</div>'.chr(10);
	}
	return $str;
}
function SUBMIT_SET($str){
	return '<div class="submit_btn">'.$str.'</div>'.chr(10);
}
function SUBMIT_BTN($name,$value=''){
	$str='';
	switch($name){
		case 'reset':
		$str='<input type="reset" value="リセット">';
		break;
		case 'back_js':
		$str='<input type="button" name="'.$name.'" value="'.$value.'" onClick="javascript:history.back();">';
		break;
		default:
		$str='<input type="submit" name="'.$name.'" id="'.$name.'" value="'.$value.'">';
	}	
	return $str;
}
function FORM_HIDDEN(){
	$arr=$_REQUEST;
	$str='';
	foreach($arr as $k => $v){
		if(is_array($v)){
			//配列			
			foreach($v as $k2 => $v2){
				$str.='<input type="hidden" name="'.$k.'[]" value="'.$v[$k2].'">'.chr(10);
			}
		}
		else{
			$str.='<input type="hidden" name="'.$k.'" value="'.$v.'">'.chr(10);
		}
	}
	return $str;
}
function FORM_HIDDEN_ADD($k,$v,$add='_set'){
	$str='';
	if($add!=''){$str=WORD_BR($v);}
	return $str.'<input type="hidden" name="'.$k.$add.'" value="'.$v.'">'.chr(10);
}
//----------------------------
function CONF_CHECK($a){
	$check=isset($_REQUEST[$a[1]])?$_REQUEST[$a[1]]:'';
	$cnt=0;
	foreach($a['select'] as $k => $v){
		if(!is_array($v)){
			$v=array($v,'x');
		}
		$text='';
		switch(true){
			case ($v[1]!='x'):
				$text=isset($_REQUEST[$a[1].'_t'.$k])?$_REQUEST[$a[1].'_t'.$k]:'';
			break;
			case ($v[0]=='その他'):
				$text=isset($_REQUEST[$a[1].'_o'])?$_REQUEST[$a[1].'_o']:'';
			break;
		}
		if(isset($check[$cnt])){
			if(!isset($check[$cnt])){$check[$cnt]='-';}//PHP7.0対応
			if($v[0]==$check[$cnt]){
				if($text!=''){
					$check[$cnt].='（'.$text.'）';
				}
				$cnt++;
			}
		}
	}
	$add=is_array($check)?implode("、",$check):$check;
	if($add==''){
		$add=isset($a['non'])?$a['non']:'-';
	}
	return FORM_HIDDEN_ADD($a[1],$add);
}
function CONF_RADIO($a){
	if(!isset($_REQUEST[$a[1]])){$_REQUEST[$a[1]]='';}//PHP7.0対応
	$check=$_REQUEST[$a[1]];
	$text='';
	switch($check){
		case 'その他':
		$check.='（'.$_REQUEST[$a[1].'_o'].'）';
		break;
		default:
	}
	return FORM_HIDDEN_ADD($a[1],$check);
}
/*
function INPUT_PREF($name,$class='',$select=array()){
	$add='';
	$wrap=array('','','');
	if(strpos($class,'validate[required')!==false){
		$wrap[0]='span';
		$wrap[1]='<'.$wrap[0].' class="err_block no_abs type_se">';
		$wrap[2]='</'.$wrap[0].'>';
		$add.=' class="'.$class.'"';
	}
	$str='<option value="">--- 選択して下さい ---</option>';
	if(isset($select)){
		//指定の配列を使用
		$pref=$select;
	}
	else{
		//都道府県入力
		$pref=array('愛知県','三重県','岐阜県','北海道','青森県','岩手県','秋田県','宮城県','山形県','福島県','栃木県','群馬県','茨城県','埼玉県','東京都','千葉県','神奈川県','山梨県','長野県','新潟県','富山県','石川県','福井県','静岡県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','徳島県','香川県','愛媛県','高知県','鳥取県','島根県','岡山県','広島県','山口県','福岡県','佐賀県','長崎県','大分県','熊本県','宮崎県','鹿児島県','沖縄県');
	}
	foreach($pref as $k => $v){
		$str.='<option '.(($v==$_REQUEST[$name])?'selected':'').'>'.$v.'</option>'.chr(10);
	}	
	return $wrap[1].'<select name="'.$name.'"'.$add.'>
'.$str.'
	</select>'.$wrap[2].chr(10);
}
*/
?>