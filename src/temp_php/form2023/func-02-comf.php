<?php
//<meta charset="utf-8">

function FORM_CONFIRMATION_2023($k,$v){
	$str='';
	$v[0]=str_replace('*','',$v[0]);
	if($v[0]==''){$v[0]=$k;}
	switch($v[1]){
		//==========
		case 'name':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST[$v[2].'1'].'　'.$_REQUEST[$v[2].'2'].'</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2].'1',$v[2].'2')).chr(10);
		break;
		//==========
		case 'tel':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST[$v[2].'1'].'-'.$_REQUEST[$v[2].'2'].'-'.$_REQUEST[$v[2].'3'].'</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2].'1',$v[2].'2',$v[2].'3')).chr(10);
		break;
		//==========
		case 'mail':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST['mail'].'</td>
</tr></table>
'.INPUT_HIDDEN(array('mail')).chr(10);
		break;
		//==========
		case 'pos':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST[$v[2].'1'].'-'.$_REQUEST[$v[2].'2'].'</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2].'1',$v[2].'2')).chr(10);
		break;
		//==========
		case 'text':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST[$v[2]].'</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2])).chr(10);
		break;
		//==========
		case 'ymd':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST[$v[2].'1'].'年 '.$_REQUEST[$v[2].'2'].'月 '.$_REQUEST[$v[2].'3'].'日</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2].'1',$v[2].'2',$v[2].'3')).chr(10);
		break;
		//==========
		case 'ninzuu':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th rowspan="2" class="bg_green">'.$v[0].'</th>
<td>大人　'.$_REQUEST[$v[2].'1'].'名</td>
</tr><tr>
<td>子供　'.$_REQUEST[$v[2].'2'].'名</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2].'1',$v[2].'2')).chr(10);
		break;
		//==========
		case 'bukken':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th rowspan="2" class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST[$v[2].'1'].'</td>
</tr><tr>
<td>'.$_REQUEST[$v[2].'2'].'</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2].'1',$v[2].'2')).chr(10);
		break;
		//==========
		case 'checkbox':
		if (isset($_REQUEST[$v[2]]) && is_array($_REQUEST[$v[2]])){$con=implode("、",$_POST[$v[2]]);}
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$con.'</td>
</tr></table>
'.INPUT_HIDDEN_MULTIPLE($v[2]).chr(10);
		break;
		//==========
		case 'radio':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.$_REQUEST[$v[2]].(($_REQUEST[$v[2]]!='予約しない')?'（ご来場希望日時：'.$_REQUEST['yoyaku_date'].' '.$_REQUEST['yoyaku_time'].'）':'').'</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2],'yoyaku_date','yoyaku_time')).chr(10);
		break;
		//==========
		case 'textarea':
		$str='<table border="0" cellpadding="0" cellspacing="0" class="form_conf"><tr>
<th class="bg_green">'.$v[0].'</th>
<td>'.WORD_BR($_REQUEST[$v[2]]).'</td>
</tr></table>
'.INPUT_HIDDEN(array($v[2])).chr(10);
		break;
		//==========
	}
	return $str;
}
?>