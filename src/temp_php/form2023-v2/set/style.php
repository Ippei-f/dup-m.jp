<?php
//<meta charset="utf-8">

//カラーパレット分岐
$line_iten=false;
$svg_color_palette=array();
switch(true){
	case (strpos($url,'/kodate/')!==false)://東新住建の家
	$svg_color_palette['基本']	='#f63402';
	$svg_color_palette['淡色1']	='#fa9980';
	$svg_color_palette['淡色2']	='#fdccc0';	
	$svg_color_palette['見出1']	='#738da0';
	$svg_color_palette['見出2']	='#d5dde2';
	$svg_color_palette['見出角']	='#FFF';
	$line_iten=true;
	break;
	case (strpos($url,'/sodatsu/')!==false)://そだつ
	$svg_color_palette['基本']	='#FF64A5';
	$svg_color_palette['淡色1']	='#ffb1d2';
	$svg_color_palette['淡色2']	='#ffd8e8';
	$svg_color_palette['見出1']	=$svg_color_palette['基本'];
	$svg_color_palette['見出2']	=$svg_color_palette['淡色2'];
	$svg_color_palette['見出角']	='#FFF';
	$line_iten=true;
	break;
	case (strpos($url,'/teishaku/')!==false):
	case (strpos($url,'/teishaku-portal/')!==false)://テイシャク
	$svg_color_palette['基本']	='#04A786';
	$svg_color_palette['淡色1']	='#80d3c2';
	$svg_color_palette['淡色2']	='#c0e9e0';
	$svg_color_palette['見出1']	=$svg_color_palette['基本'];
	$svg_color_palette['見出2']	=$svg_color_palette['淡色2'];
	$svg_color_palette['見出角']	='#FFF';
	break;
	case (strpos($url,'/hiraya/')!==false)://平屋
	$svg_color_palette['基本']	='#525A70';
	$svg_color_palette['淡色1']	='#a8acb7';
	$svg_color_palette['淡色2']	='#d4d6db';
	$svg_color_palette['見出1']	=$svg_color_palette['基本'];
	$svg_color_palette['見出2']	=$svg_color_palette['淡色2'];
	$svg_color_palette['見出角']	='#fdfaf6';
	break;
	case (strpos($url,'dup-m.jp')!==false)://DUPレジデンス
	$svg_color_palette['基本']	='#014021';
	$svg_color_palette['淡色1']	='#6eb190';//中間色補間
	$svg_color_palette['淡色2']	='#D9E2DE';	
	$svg_color_palette['見出1']	=$svg_color_palette['基本'];
	$svg_color_palette['見出2']	=$svg_color_palette['淡色2'];
	$svg_color_palette['見出角']	='#FFF';
	break;
}
?>
<style>
/*
.font_hiragino900{
	font-family: "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", "sans-serif";
	font-weight: 900;
}
*/
.contact_box svg{display: block;}
.contact_box svg[data-name="cut"]{
	position: absolute;
	right:0;
	bottom:0;
	height:100%;
	width:43px;
	z-index: -1;
}
.contact_box svg[data-name="cut"] > *{fill:<?php echo $svg_color_palette['見出角']; ?>;}
.contact_box svg[data-name="icon-tel"]{width:24px;}
.contact_box svg[data-name="icon-form"]{width:29px;}
.contact_box svg[data-name="icon-line"]{width:34px;}
.contact_box svg[data-name="icon-tel"] .col1,
.contact_box svg[data-name="icon-form"] .col1,
.contact_box svg[data-name="icon-line"] .col1,
.contact_box svg[data-name*="customer-"] .col2{
	fill:<?php echo $svg_color_palette['見出1']; ?>;
}
.contact_box svg[data-name="icon-tel"] .col2,
.contact_box svg[data-name="icon-form"] .col2{
	fill:<?php echo $svg_color_palette['見出2']; ?>;
}
.contact_box svg[data-name="icon-line"] .col2{
	fill:none;
	stroke:<?php echo $svg_color_palette['見出2']; ?>;
	stroke-linecap:round;
	stroke-linejoin:round;
	stroke-width:4px;
}
.contact_box svg[data-name*="customer-"] .col1{
	fill:none;
	stroke:<?php echo $svg_color_palette['見出2']; ?>;
	stroke-miterlimit:10;
}
.contact_box svg[data-name="tel-v20230809"] .col1{
	fill:<?php echo $svg_color_palette['基本']; ?>;
}
.contact_box svg[data-name="tel-beta-v20230809"] .col1{fill:<?php echo $svg_color_palette['基本']; ?>;}
.contact_box svg[data-name="tel-beta-v20230809"] .col2,
.contact_box svg[data-name="tel-beta-v20230809"] .col5{fill:#fff;}
.contact_box svg[data-name="tel-beta-v20230809"] .col3{fill:<?php echo $svg_color_palette['淡色2']; ?>;}
.contact_box svg[data-name="tel-beta-v20230809"] .col4{fill:<?php echo $svg_color_palette['淡色1']; ?>;}
.contact_box svg[data-name="tel-beta-v20230809"] .col5{
	stroke:<?php echo $svg_color_palette['基本']; ?>;
	stroke-linecap:round;
	stroke-linejoin:round;
	stroke-width:1.65px;
}
.local_okonomi{
	display: flex;
	flex-direction: column;
	align-items: center;
}
.local_okonomi h3{
	font-size: 125%;
	line-height: normal;
	text-align: center;
}
.local_okonomi ul{
	display: flex;
	flex-direction: column;
	margin-top: 60px;
}
.local_okonomi ul li{
	display: flex;
	align-items: flex-start;
}
.local_okonomi ul li:nth-child(n+2){margin-top: 40px;}
.local_okonomi ul li > *:nth-child(1){
	color: <?php echo $svg_color_palette['見出1']; ?>;
	background-color: <?php echo $svg_color_palette['見出2']; ?>;
	display: flex;
	align-items: center;
	position: relative;
	z-index: 2;
	padding: 20px;
	padding-right: 0;
	font-size: 20px;
	line-height: 100%;
	font-weight: bold;
}
.local_okonomi ul li > *:nth-child(1) span{
	display: inline-flex;
	align-items: center;
	min-width: 40px;
}
.local_okonomi ul li > *:nth-child(1) font{
	display: inline-block;
	font-size: 60%;
	margin-top: 0.4em;
	margin-left: 0.25em;
}
.local_okonomi ul li > *:nth-child(2){flex-grow: 1;}
.local_okonomi ul li > *:nth-child(2) h4{
	font-size: 100%;
	line-height: normal;
}
.local_okonomi ul li > *:nth-child(2) a[href*="tel:"]{
	display: block;
	margin-top: 10px;
}
.local_okonomi ul li > *:nth-child(2) a[href*="tel:"] + *{
	font-size: 90%;
	margin-top: 0.25em;
	text-align: center;
}
.local_okonomi ul li > *:nth-child(2) a[href*="#form"],
.local_okonomi ul li > *:nth-child(2) a[href*="http"]{
	color: #FFF;
	background-color: <?php echo $svg_color_palette['基本']; ?>;
	display:flex;
	justify-content: space-between;
	align-items: center;
	width:240px;
	height:40px;
	font-weight: bold;
	padding: 0 1em;
	margin-top: 0.5em;
	font-size: 12pt;
}
.local_okonomi ul li > *:nth-child(2) img[src*="bnr-line-v"]{margin-top: 0.5em;}
.local_okonomi ul li > *:nth-child(2) img[src*="bnr-line-v20230809"]{width:320px;}
.local_okonomi ul li > *:nth-child(2) img[src*="bnr-line-v20231122"]{width:344px;}
.local_customer{
	margin-top: 110px;
	display: flex;
	flex-direction: column;
	align-items: center;
}
.local_customer h3{
	font-size: 112.5%;
	line-height: normal;
	text-align: center;
	color:<?php echo $svg_color_palette['見出1']; ?>;
	border-bottom:solid 1px <?php echo $svg_color_palette['見出1']; ?>;
	width:100%;
	max-width: 24em;
}
.local_customer h3 + div{
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	width: 100%;
	margin-top: 40px;
}
.local_customer h3 + div > *{width:149px;}
.local_f_title{
	margin-top: 170px;
	margin-bottom: 66px;
}
.local_f_title h2{
	background-color: #231815;
	color:#FFF;
	font-size: 125%;
	line-height: normal;
	padding: 0.5em 0.75em;
	text-align: center;
}
<?php
if(strpos($url,'dup-m.jp')!==false){
	//DUP限定
?>
.local_f_title .anchor{
	position: absolute;
	top:-75px;
}
<?php
}
?>
@media screen and (min-width: 1000px) {
	.local_okonomi ul li > *:nth-child(1){
		width:200px;
		min-width: 200px;
		margin-right: 10px;
	}
	.local_okonomi ul li > *:nth-child(2) a[href*="tel:"],
	.local_okonomi ul li > *:nth-child(2) a[href*="tel:"] + *{max-width: 328px;}
}
@media screen and (max-width: 999px) {
	.contact_box svg[data-name="cut"]{
		right:-1px;
		bottom:-1px;
		width:31px;
		height:calc(100% + 1px);
	}
	.local_okonomi ul li{flex-direction: column;}
	.local_okonomi ul li > *:nth-child(1){
		width:100%;
		padding: 6px 8px;
		margin-bottom: 15px;
	}
	.local_customer{margin-top: 70px;}
	.local_customer h3 + div{
		justify-content: center;
		width:calc(100% + 4px);
		margin: 0 2px;
		margin-top: 20px;
	}
	.local_customer h3 + div > *{
		width:124px;
		margin: 0 2px;
	}
	.local_f_title{
		margin-top: 80px;
		margin-bottom: 6px;
	}
}

.local_flex1{
	display: flex;
	justify-content: space-between;
}
.local_flex1.center{justify-content: center;}
.local_flex1.first{margin-bottom: 3.5em;}
.local_flex1 > *{
	width:380px;
	margin-top: 1em;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}
.local_flex1.first > *{margin-top: 0;}
.local_flex1 > * a{
	display: block;
	width:328px;
	width:calc(100% * 328 / 380);
}
.local_flex1 > * img{width:100%;}
.local_flex1 > * a[href*="tel:"] + *{
	font-size: 80%;
	margin-top: 0.5em;
}
.local_flex1 > * a[href*="tel:"] > svg{width:100%;}
.local_flex1 > * a[href*="tel:"] > svg *{
	fill:<?php echo $svg_color_palette['基本']; ?>;
}
.local_flex1 > * img[src*="bnr-line"] + *{
	font-size: 70%;
	margin-top: 0.5em;
	text-align: left;
	width: 100%;
}
.local_flex1 > a{display: block;}
@media screen and (max-width: 999px) {
	.local_flex1{flex-direction: column;}
	.local_flex1 > *,
	.local_flex1 > * a[href*="http"]{width: 100%;}
	.local_flex1.first{margin-bottom: 0;}
}
</style>