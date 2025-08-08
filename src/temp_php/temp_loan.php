<?php
if(false){//requireで読み込む時は除外
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ローン</title>
<link href="../css/common.css" rel="stylesheet" type="text/css">
<link href="../css/form.css" rel="stylesheet" type="text/css">
<link href="../css/info-detail.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="Wmax1200 mgnLR50"><div class="detail_box font_meiryo" style="padding-top:0;">
<?php
}//-----------------------------------
?>
<div style="height:50px;"></div>
<div class="anchor"><a id="loan" name="loan"></a></div>
<?php
if($sysdata['comment'][1]!=''){
	echo BTN_OVAL('','簡単ローンシミュレーション','width:16em;','colorLG loan_btn_toggle');
}
//-----------------------------------
$tax=1.08;//消費税
$price_kinri_name=array('東海ろうきん','フラット35');
$price_kinri_n_add=array
('東海ろうきん'	=>'（変動金利）'
,'フラット35'		=>'（固定金利）'
);
$price_kinri=array
('東海ろうきん'	=>0.5
//'東海ろうきん'	=>0.89
//,'フラット35'		=>1.35
,'フラット35'		=>1.8//2023-05/15~
);
$price_kinri_text=array
('東海ろうきん'	=>'※変動金利'
,'フラット35'		=>'※借入額の1割分は金利2.725％です。（月によって変動します）'
);
//-----------------------------------
?>
<script>
//ローン用javascript
var price_kinri=Array(<?php
for($i=0;$i<count($price_kinri_name);$i++){
	if($i>0){echo ',';}
	echo $price_kinri[$price_kinri_name[$i]];
}
?>);
var price_kinri_text=Array(<?php
for($i=0;$i<count($price_kinri_name);$i++){
	if($i>0){echo ',';}
	echo '"'.$price_kinri_text[$price_kinri_name[$i]].'"';
}
?>);

$(window).load(function(){
	
	//ローンシミュレーション表示
	$(".loan_btn").click(function(){
		$(".loan_box").slideDown();
  });
	$(".loan_btn_toggle").click(function(){
		$(".loan_box").slideToggle();
  });
	
	//数字制限
	$('.number_only').on('keydown', function(e) {
		var k = e.keyCode;
		<?php /*// 0～9, テンキ―0～9, スペース, backspace, delete, →, ←, 以外は入力キャンセル*/ ?>
		if(!((k >= 48 && k <= 57) || (k >= 96 && k <= 105) || k == 32 || k == 8 || k == 46 || k == 39 || k == 37)) {
			return false;
		}
	});
	
	//物件価格選択
	$(".loan_box input[name=CB_price]").click(function(){
		$(".loan_box .simu_box").slideUp();
		$(".loan_box input[name=CB_price]").prop('checked','');
		$(this).prop('checked','checked');
		$(".loan_box input[name=HD_price]").val($(this).val());
		$(".loan_box .TX_price").text(comma($(this).val()));
		price=Number($(this).val());
		//
		price1=((price*10000*0.03)+60000)*<?php echo $tax; ?>;
		price2=(((price*10000)+2000000)*0.9*0.008)+54000;
		shohiyou=590200+price1+price2;
		shohiyou=Math.round(shohiyou/10000)*10000;
		$(".loan_box input[name=HD_price_shohiyou]").val(shohiyou);
		$(".loan_box .TX_price_shohiyou").text(comma(shohiyou));	
		//	
		atamakin=Number($(".loan_box input[name=IP_price_atamakin]").val());
		kariire=price+(shohiyou/10000)-atamakin;
		$(".loan_box input[name=HD_price_kariire]").val(kariire);
		kariire=Math.floor(kariire);
		$(".loan_box .TX_price_kariire").text(comma(kariire));
  });
	
	//諸費用表示
	$(".shohiyou_btn").click(function(){
		$(".shohiyou_text").slideToggle();
		return false;
  });
	
	//頭金入力後
	$(".loan_box input[name=IP_price_atamakin]").on("keyup",function(){
		$(".loan_box .simu_box").slideUp();
		price=Number($(".loan_box input[name=HD_price]").val());
		shohiyou=Number($(".loan_box input[name=HD_price_shohiyou]").val());
		atamakin=Number($(".loan_box input[name=IP_price_atamakin]").val());
		//atamakin=convert2SbNum(atamakin);
		kariire=price+(shohiyou/10000)-atamakin;
		$(".loan_box input[name=HD_price_kariire]").val(kariire);
		kariire=Math.floor(kariire);
		$(".loan_box .TX_price_kariire").text(comma(kariire));
	});
	
	//ボーナス入力後
	$(".loan_box input[name=IP_price_bonus]").on("keyup",function(){
		$(".loan_box .simu_box").slideUp();
	});
	
	//金利選択
	$(".loan_box input[name=CB_price_kinri]").click(function(){
		$(".loan_box .simu_box").slideUp();
		$(".loan_box input[name=CB_price_kinri]").prop('checked','');
		$(this).prop('checked','checked');
		$(".loan_box .TX_price_kinri").text(price_kinri[$(this).val()]);
		$(".loan_box .TX_price_kinri_text").text(price_kinri_text[$(this).val()]);
		$(".loan_box input[name=HD_price_kinri]").val($(this).val());
  });
	
	//借入期間選択
	$(".loan_box select[name=IP_price_kikan]").click(function(){
		$(".loan_box .simu_box").slideUp();
	});
	
	//計算ボタン
	$(".loan_box .price_simu").click(function(){
		kariire=Number($(".loan_box input[name=HD_price_kariire]").val())*10000;//借入額
		bonus=Number($(".loan_box input[name=IP_price_bonus]").val())*10000;//ボーナス加算額		
		kikan=Number($(".loan_box select[name=IP_price_kikan]").val());//借入期間（年）
		
		kariire=kariire-(bonus*2*kikan);//借入額からボーナス時の返済額を除外（＝ 借入額 -（ボーナス * 2 * 借入期間））
		
		kinri=price_kinri[$(".loan_box input[name=HD_price_kinri]").val()];//金利（年）
		if($(".loan_box input[name=HD_price_kinri]").val()==0){
			//金利=通常の金利 9 : 別途金額 1
			kinri=(kinri*9+2.725)/10;
		}
		//金利を％表記から計算用の実数にする
		kinri=kinri/100;
		
		//月利＝年利/12
		rate_a = (kinri/12);
		//月利を支払い回数（＝借入期間 * 12）の分累乗
		rate_b = Math.pow((1+rate_a),kikan*12);		
		//月支払い金額＝借入額×月利×月利累乗÷（月利累乗-1）
		month_rapay =(kariire * rate_a * rate_b) /(rate_b - 1);
		//四捨五入
		month_rapay =Math.round(month_rapay);		

		//返済額代入
		$(".loan_box .TX_price_maitsuki").text(comma(month_rapay));// 毎月返済額
		if(bonus>0){
			$(".loan_box .TX_price_maitsuki_bo").text(comma(bonus));// ボーナス月返済額
		}
		else{
			$(".loan_box .TX_price_maitsuki_bo").text('--,---');// ボーナス月返済額
		}
		
		//賃貸
		$(".loan_box .TX_price_chintai div").css("display","none");
		for(i=0;i<$(".loan_box .loan_step1 .floatR span").length;i++){
			if($(".loan_box .loan_step1 .bukken"+(i+1)).prop("checked")){
				$(".loan_box .TX_price_chintai .chintai"+(i+1)).css("display","inline-block");
				break;
			}
		}
		
		//計算結果表示
		$(".loan_box .simu_box").slideDown();

  });
});
// 数値の桁区切り追加
function comma(str) {
	var num = new String(str).replace(/(\d)(?=(\d\d\d)+(?!\d))/g,'$1,');
	return num;
}
<?php
/*
// 数字の半角変換
function convert2SbNum(str) {
	var strPattern = ['０','１','２','３','４','５','６','７','８','９','，','－','．'],
		replacePattern = ['0','1','2','3','4','5','6','7','8','9',',','-','.'];
	var str = str;
	$.each(strPattern, function(i, val) {
		expStr = new RegExp(val, 'ig');
		str = str.replace(expStr, replacePattern[i]);
	});
	return str;
}
*/
?>
</script>
<div style="height:35px;"></div>
</div></div><!-- 一旦main-end -->



<div class="loan_box font_meiryo bg_gray mgnAuto borderbox <?php echo 'dpN'; ?>" style="padding:35px 0;"><div class="Wmax800 textL mgnLR50">
  <?php $cnt=1; ?>
  <div class="font_bold fontP120 LH125 mgnB0_5em"><span class="col_red">Step<?php echo $cnt++; ?>.</span>　物件をお選びください</div>
  <div class="bg_white font_bold loan_step1" style="padding:0.75em 1.25em;">
	<div class="floatL"><?php echo $sysdata['title_text']; ?></div>
  <div class="floatR"><?php
	$str=str_replace(array("："),'@@',$sysdata['comment'][1]);
  $str=str_replace(array("<br>","<br />"),'@@',$str);
	$str=str_replace(array(",","万","円","　"," ","	"),'',$str);
	
	$price_arr=explode('@@',$str);
	
	$price_first=0;
	for($i=0;$i<count($price_arr);$i+=2){
		$price_arr[$i+1]=preg_replace('/[^0-9]/','',$price_arr[$i+1]);
		if (is_numeric($price_arr[$i+1])){
			//数値判定
			echo '<span><input type="checkbox" name="CB_price" class="bukken'.(($i/2)+1).'"'.(($price_first<1)?'checked':'').' value="'.$price_arr[$i+1].'">'.$price_arr[$i].'</span>';
			if($price_first<1){$price_first=$price_arr[$i+1];}
		}
	}
	
	?></div>
  <div class="clear"></div>
  </div>
  <?php
  /*
	<img src="images/content/info/arrow-loan.png" class="dpB mgnAuto" style="width:40px; margin:2em auto;">
  <div class="font_bold fontP120 LH125 mgnB0_5em"><span class="col_red">Step<?php echo $cnt++; ?>.</span>　オプションをお選びください</div>
	*/
	?>
  <img src="images/content/info/arrow-loan.png" class="dpB mgnAuto" style="width:40px; margin:2em auto;">
  <div class="font_bold fontP120 LH125 mgnB0_5em"><span class="col_red">Step<?php echo $cnt++; ?>.</span>　<span class="dpIB">必須項目をご入力のうえ、「計算する」ボタンを押してください</span></div>
  <div class="loan_step3">
  <div class="bg_white floatL_pc" style="padding:0.75em 1.25em;">
  <table border="0" cellpadding="0" cellspacing="0" class="price_form"><tr>
	<th style="width:5em;">物件価格</th>
	<td colspan="2" class="textR"><span class="TX_price"><?php echo number_format($price_first); ?></span>万円<input type="hidden" name="HD_price" value="<?php echo $price_first; ?>"></td>
	</tr><tr>
	<th>＋諸費用</th>
	<td><a href="" class="dpIB fontP050 LH100 shohiyou_btn" style="border:solid 1px rgba(0,0,0,0.5); padding:0.25em 0.5em; background-color:#fff;">諸費用について</a></td>
	<td class="textR"><span class="TX_price_shohiyou"><?php
	/*
			諸費用＝590,200＋仲介手数料＋融資手数料
			
			仲介手数料＝（物件価格×3％＋6万円）×1.08（消費税）
			
			融資手数料＝物件価格×200万円×0.9×0.8%＋54000？
	*/
			$price_chuukai=(($price_first*10000*0.03)+60000)*$tax;
			$price_yuushi=((($price_first*10000)+2000000)*0.9*0.008)+54000;
			
			$price_shohiyou=590200+$price_chuukai+$price_yuushi;
			$price_shohiyou=round($price_shohiyou/10000)*10000;//四捨五入
			
			echo number_format($price_shohiyou);
			
	?></span>円<input type="hidden" name="HD_price_shohiyou" value="<?php echo $price_shohiyou; ?>"></td>
	</tr><tr>
  <td colspan="3" style="padding:0;"><div class="bg_white fontP080 LH175 shohiyou_text <?php echo 'dpN'; ?>" style="padding:0.75em 1.5em; margin:0.5em 0;">諸費用には、下記の費用が含まれます。<br>
・印紙代（不動産売買契約書）<br>
・印紙代（金銭消費賃借契約）<br>
・建物表示登記料<br>
・所有移転保存登録料<br>
・抵当権設定料（ローン）<br>
・火災保険料<br>
・ローン保証料<br>
・団体信用生命保険特約料<br>
・融資手数料<br>
・固定資産負担分<br>
・仲介手数料<br>
<span class="fontP090">※概算費用見積の為、過不足が発生する可能性があります。</span></div></td>
  </tr><tr>
	<th>－頭金</th>
	<td colspan="2" class="textR"><input type="text" class="number_only" name="IP_price_atamakin" value="0" style="width:5em;"> 万円</td>
	</tr></table>
  <hr style="margin:0.5em 0;">
  <table border="0" cellpadding="0" cellspacing="0" class="price_form"><tr>
	<th>＝借入額</th>
	<td class="textR"><span class="TX_price_kariire fontP200 LH100" style="padding-right:0.25em;"><?php $num=$price_first+($price_shohiyou/10000); $num=floor($num); echo number_format($num); ?></span>万円<input type="hidden" name="HD_price_kariire" value="<?php echo $num; ?>"></td>
	</tr></table>
  </div>
  <div class="bg_white floatR_pc" style="padding:0.75em 1.25em;">
  <table border="0" cellpadding="0" cellspacing="0" class="price_form"><tr>
  <td><span class="fontP090"><strong>1回あたりボーナス時加算額</strong></span><br>
	<span class="fontP080">※ボーナスは年2回で計算</span></td>
	<td class="textR"><input type="text" class="number_only" name="IP_price_bonus" value="0" style="width:5em;"> 万円</td>
  </tr></table>
  <style>
  .price_form.kinri tr th:nth-child(1){
		vertical-align:top;
		width:3em;
	}
	.price_form.kinri tr td:nth-child(2){
	}
	.price_form.kinri tr td:nth-child(3){
		vertical-align:bottom;
		width:3.5em;
	}
  </style>
  <table border="0" cellpadding="0" cellspacing="0" class="price_form kinri" style="margin-top:5px;"><tr>
	<th>金利</th>
  <td class="fontP080">
  <?php
	$cnt=0;
	foreach($price_kinri_name as $k =>$v){
		$name=$price_kinri_name[$k];
		echo '<div class="dpIB">'.$name.'<br class="pc_vanish">'.$price_kinri_n_add[$name].' <input type="checkbox"  name="CB_price_kinri"'.(($k<1)?' checked':'').' value="'.$k.'"></div>';
	}
	
	/*
	<div class="dpIB" style="padding-right:1em;">フラット35 <input type="checkbox"  name="CB_price_kinri" checked value="0"></div>
  <div class="dpIB">東海ろうきん <input type="checkbox" name="CB_price_kinri" value="1"></div>
	*/
	?>
  </td>
  <td class="textR"><span class="TX_price_kinri"><?php echo $price_kinri[$price_kinri_name[0]]; ?></span>%<input type="hidden" name="HD_price_kinri" value="0"></td>
  </tr></table>
  <div class="fontP070 TX_price_kinri_text"><?php echo $price_kinri_text[$price_kinri_name[0]]; ?></div>
  <table border="0" cellpadding="0" cellspacing="0" class="price_form" style="margin-top:10px;"><tr>
  <th style="text-align:right;">借入期間</th>
  <td class="textR" style="width:7.1em;">
  <select name="IP_price_kikan" style="font-size:160%;">
  <?php
		for($i=40;$i>0;$i--){
			echo '<option>'.$i.'</option>';
		}
		//<input type="number" name="IP_price_kikan" min="1" max="35" value="1" style="width:3em;">
  ?>  
  </select> 年</td>
  </tr></table>
  </div>
  <div class="clear"></div>
  </div>

<div class="textC" style="margin-top:2em;"><a class="dpIB fontP150 LH100 price_simu" style="background-color:#E50012; color:#fff; padding:0.5em 2em; cursor: pointer;">計算する</a></div>

<div class="simu_box <?php echo 'dpN'; ?>">
<img src="images/content/info/arrow-loan.png" class="dpB mgnAuto" style="width:40px; margin:3em auto;">
<div class="col_red textC font_bold fontP150 LH100 mgnB0_5em">シミュレーション結果</div>
<div class="bg_white" style="border:solid 2px #E50012; padding:1em;">
<table border="0" cellpadding="0" cellspacing="0" class="W100per Vmiddle simu_res"><tr>
<td class="font_bold" style="text-align:right;">毎月返済額</td>
<td class="font_bold" style="text-align:right; padding-right:1em;"><div class="TX_price_maitsuki col_red fontP200 LH100">--,---</div></td>
<td>円</td>
</tr></table>
<hr style="margin:1em 0;">
<table border="0" cellpadding="0" cellspacing="0" class="W100per Vmiddle simu_res"><tr>
<td class="font_bold" style="text-align:right;">ボーナス時加算額</td>
<td class="font_bold" style="text-align:right; padding-right:1em;"><div class="TX_price_maitsuki_bo col_red fontP200 LH100">--,---</div></td>
<td>円</td>
</tr></table>
</div>
<div class="fontP070 LH150" style="margin-top:1em;">※このシミュレーションは借入れを保証するものではありません。<br>
※シミュレーション結果の金額は概算です。詳細なお見積もりは現地アドバイザーにご相談いただくか、フォームよりお問い合わせください。</div>

<div class="textC font_bold fontP120 LH100 mgnB0_5em mgnT50">この物件を賃貸で貸し出した場合の家賃想定</div>
<div class="bg_white" style="border:solid 2px #004021; padding:1em;">
<table border="0" cellpadding="0" cellspacing="0" class="W100per Vmiddle simu_res_ch"><tr>
<td class="font_bold" style="text-align:right;">賃貸査定（月額）</td>
<td class="font_bold TX_price_chintai" style="text-align:center;"><?php
	
  $str=str_replace(array("<br>","<br />"),'@@',TextToKanma($sysdata['chintai']));
	$str=str_replace(array(",","万","円"),'',$str);
	$price_arr=explode('@@',$str);
	//print_r($price_arr);
	
	for($i=0;$i<count($price_arr);$i++){
		$arr2=explode("：",$price_arr[$i]);
		//print_r($arr2);
		if(count($arr2)>1){
			//物件タイプあり
			$arr=explode("～",$arr2[1]);
		}
		else{
			//物件タイプなし
			$arr=explode("～",$arr2[0]);
		}
		//print_r($arr);
		$str='<span class="col_green fontP200 LH100 dpIB">';
		for($j=0;$j<count($arr);$j++){
			if($j>0){
				$str.='</span><span class="dpIB font_normal padL">円</span><span class="dpIB font_normal padLR">～</span><span class="col_green fontP200 LH100 dpIB">';
			}
			//print_r($arr[$j]);
			$arr[$j]=(($arr[$j]>0)?number_format($arr[$j]):'--,---');
			$str.=$arr[$j];
		}
		$str.='</span><span class="dpIB font_normal padL">円</span>';
		echo '<div class="dpIB chintai'.($i+1).'"'.(($i>0)?' style="display:none;"':'').'>'.$str.'</div>';
	}
 /*<div class="col_green fontP200 LH100">--,---<?php echo number_format($sysdata['chintai']); ?></div>*/
 
 ?></td>
</tr></table>
</div>
<div class="fontP070 LH150" style="margin-top:1em;">※予定賃料収入が確実に得られることを保証するものではありません。<br>
※想定賃料は「㈱ブルーボックス」による査定額です。<br>
※想定賃料は物件により異なります。</div>
</div>

</div></div><!-- loan-end -->



<div class="Wmax1200 mgnLR50"><div class="detail_box font_meiryo" style="padding-top:0;">
<?php
//-----------------------------------
if(false){//requireで読み込む時は除外
?>
</div></div>
</body>
</html>
<?php
}
?>