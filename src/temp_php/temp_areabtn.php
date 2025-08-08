<?php
//<meta charset="utf-8">
?>
<style>
.area_jump a{
	display:inline-block;
	border:solid 2px #004021;
	color:#004021;
	font-size:120%;
	line-height:100%;
	text-align:center;
	width:12em;
	padding:0.75em 0;
	border-radius: 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	margin-bottom:10px;
}
.area_jump a:nth-child(n+2){
	margin-left:0.5em;
}
.area_jump a span{display:inline-block;}
/*
.area_jump a:nth-child(3) span{
	transform: scale(0.75,1);
	margin: 0 -12.5%;
}
*/
@media screen and (max-width: 799px) {
	.area_jump a{
		font-size:90%;
	}
	/*
	.area_jump a:nth-child(3){
		margin-left:0;
		width:16em;
	}
	.area_jump a:nth-child(3) span{
		transform: scale(1,1);
		margin: 0 0;
	}
	*/
}
</style>
<div class="textC area_jump font_meiryo" style="margin-bottom:35px;">
<?php
$area_arr=array
(1=>'名古屋エリア'
,3=>'西三河・知多郡エリア'
,2=>'尾張・岐阜エリア'
);

$link=($p_title!='物件情報')?$link_list['物件情報']:'';
foreach($area_arr as $k => $v){
	echo '<a href="'.$link.'#sec'.$k.'"><span>'.$area_arr[$k].'</span></a>';
}
/*
for($i=0;$i<count($area_arr);$i++){
	echo '<a href="'.$link.'#sec'.($i+1).'"><span>'.$area_arr[$i].'</span></a>';
}
*/
?>
</div>