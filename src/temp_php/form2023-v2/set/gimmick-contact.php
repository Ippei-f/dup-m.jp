<?php
//<meta charset="utf-8">
/*
		style・javascriptをひとまとめにしたテンプレート
*/
?>
<style>
.bg_FFF_gray .content_box{min-height: 0;}
.contact_box .contact_inputarea.box_raijou .checkbox:nth-child(1){
	font-size: 125%;
	font-size: calc(1em * 5 / 4);
	font-weight: bold;
	margin-right: 0.8em;
	margin-right: calc(1em * 4 / 5);
}
.contact_box .contact_inputarea.box_raijou .checkbox:nth-child(1) input{
	font-size: 80%;
	font-size: calc(1em * 4 / 5);
}
<?php
if($step==3){
	$arr=$form_arr_2023['お問い合わせの項目'];
	if($_REQUEST[$arr[1]]!=''){echo '.acobox.aco_00{display: block;}';}
	if($_REQUEST[$arr[1]]==$arr['select'][0]){echo '.acobox.aco_01{display: block;}';}
	if($_REQUEST[$arr[1]]==$arr['select'][1]){echo '.acobox.aco_02{display: block;}';}
	if($_REQUEST[$arr[1]]==$arr['select'][2]){echo '.acobox.aco_03{display: block;}';}
	if($_REQUEST[$arr[1]]!=$arr['select'][0]){echo '.acobox.aco_01R{display: block;}';}
	if($_REQUEST[$arr[1]]!=$arr['select'][1]){echo '.acobox.aco_02R{display: block;}';}
	if($_REQUEST[$arr[1]]!=$arr['select'][2]){echo '.acobox.aco_03R{display: block;}';}
	$arr=array($form_arr['アンケート'],'アンケートに答える');
	for($i=0;$i<count($arr);$i+=2){
		if(implode('',$_REQUEST[$arr[$i][1]])==$arr[$i+1]){
			echo '.acobox.aco_'.$arr[$i][1].'{display: block;}';
		}
	}
}
?>
</style>
<script>
$(window).load(function(){
<?php $cnt=0; ?>
	var objarr = new Array();
	<?php $a=$form_arr_2023['お問い合わせの項目']; ?>
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_00',Array('<?php echo implode("','",$a['select']); ?>'));//全項目
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_01',Array('<?php echo $a['select'][0]; ?>'));
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_02',Array('<?php echo $a['select'][1]; ?>'));
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_03',Array('<?php echo $a['select'][2]; ?>'));
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_01R',Array('<?php echo $a['select'][1]."','".$a['select'][2]; ?>'));
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_02R',Array('<?php echo $a['select'][0]."','".$a['select'][2]; ?>'));
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_03R',Array('<?php echo $a['select'][0]."','".$a['select'][1]; ?>'));
	<?php $a=$form_arr_2023['ご希望の来場場所']; ?>
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>"]','.acobox.aco_<?php echo $a[1]; ?>',Array('<?php echo $a['select'][0]; ?>'));
	<?php $a=$form_arr['アンケート']; ?>
	objarr[<?php echo $cnt++; ?>]=Array('input[name="<?php echo $a[1]; ?>[]"]','.acobox.aco_<?php echo $a[1]; ?>',Array('<?php echo implode("','",$a['select']); ?>'));
	FORM_ACO(objarr[0],'show');
	$(objarr[0][0]).change(function(){
		FORM_ACO(objarr[0],'slide');
		$('input[name="anke_kotaeru[]"]').removeAttr("checked").prop("checked", false).change();//お問い合わせ項目変更でアンケート項目OFF
	});
	<?php
	for($i=1;$i<$cnt;$i++){
		echo 'FORM_ACO(objarr['.$i.'],\'show\');
		$(objarr['.$i.'][0]).change(function(){
			FORM_ACO(objarr['.$i.'],\'slide\');
		});'.chr(10);
	}
	?>
	<?php
	//物件選択
	$arr=array
	('お問い合わせ物件名 1'
	//,'お問い合わせ物件名 2'
	//,'お問い合わせ物件名 3'
	);
	foreach($arr as $k){
	$v=$form_arr_2023[$k][1];
	?>
	$('select[name="<?php echo $v; ?>1"]').change(function(){
		v=$(this).val();
		FORM_BUKKEN_CHANGE('select[name="<?php echo $v; ?>2"]',v);
	});
	<?php
	}
	?>
});
function FORM_ACO(arr,type){
	var flag=false;
	$(arr[0]+':checked').each(function(i,e){
		if($.inArray($(e).val(),arr[2]) >= 0){
			flag=true;
		}
	});
	//$(".test").text(flag);
	switch(type){
		case 'slide':
		if(flag){
			$(arr[1]).slideDown();
			$(arr[1]).find('input,select,textarea').removeProp('disabled');
		}
		else{
			$(arr[1]).slideUp();
			$(arr[1]).find('input,select,textarea').prop('disabled',true);
		}
		break;
		default:
		if(flag){$(arr[1]).show();}
		else{
			<?php
			if($step<3){
			?>
			$(arr[1]).find('input,select,textarea').prop('disabled',true);
			<?php
			}
			?>
		}
	}
}
function FORM_BUKKEN_CHANGE(obj,v){
	$(obj).empty();
	str='<option value="">── 物件名 ──</option>';
	switch(v){
		<?php
		foreach($local_bukken_arr['エリア'] as $k => $v){
			if(!is_numeric($k)){continue;}
			$str='';
			echo "case '".$v."':".chr(10);
			foreach($local_bukken_arr[$v] as $vk => $vv){
				if(!is_numeric($vk)){continue;}
				$str.='<option>'.$vv.'</option>';
			}
			echo "str+='".$str."';";
			echo "break;".chr(10);
		}
		?>
		default:
	}
	$(obj).prepend(str);
}
</script>