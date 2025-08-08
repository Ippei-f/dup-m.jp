<?php
$p_type='content';
$p_title='コンセプト';
$kaisou='';
require $kaisou."temp_php/basic.php";
require $kaisou."temp_php/func-concept.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php echo $temp_meta; ?>
<title><?php echo $temp_title; ?></title>
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/concept.css" rel="stylesheet" type="text/css">
<?php echo $temp_java; ?>
<style>
.movie{height:780px;}
@media screen and (max-width: 1300px) {
	.movie{height:60vw;}
}

.local_list{}
.local_list li{
	position:relative;
	margin-bottom:65px;
}
@media screen and (min-width: 800px) {
	.local_list li:last-child{
		margin-bottom:0;
	}
}
@media screen and (max-width: 799px) {
	.local_list li{margin-bottom:17em;}
	.local_list li.size5{margin-bottom:19em;}
	.local_list li.size6{margin-bottom:21em;}
	.local_list li.size7{margin-bottom:23em;}
	.local_list li.size8{margin-bottom:25em;}
}
.local_list li .photo{
	width:678px;
	margin:auto;
}
.local_list li .text{
	/* width:524px; */
	width:32.75em;
	height:13em;
	background-color:#F1F1EF;
	line-height:200%;
	/* text-align:left; */
	text-align:center;
	padding-top:2.5em;
	/* padding-left:3.5em; */
	position:absolute;	
	margin:auto;
}
.local_list li .text > div{
	text-align:left;
	/* max-width:90%; */
}
.local_list li.size5 .text{height:15em;}
.local_list li.size5.addH1em .text{height:16em;}
.local_list li.size6 .text{height:17em;}
.local_list li.size6.addH1em .text{height:18em;}
.local_list li.size7 .text{height:19em;}
.local_list li.size7.addH1em .text{height:20em;}
.local_list li.size8 .text{height:21em;}
.local_list li.size8.addH1em .text{height:22em;}
.local_list li.size9 .text{height:23em;}
.local_list li.size9.addH1em .text{height:24em;}
.local_list li .text a{
	position:absolute;
	bottom:0.25em;
	right:0.75em;
	font-size:90%;
	/* color:rgba(0,0,0,0.5); */
}
@media screen and (min-width: 800px) {
	.local_list li:nth-child(2n+1) .photo{margin-left:0;}
	.local_list li:nth-child(2n+2) .photo{margin-right:0;}
	.local_list li .text{top:0;	bottom:0;}
	.local_list li:nth-child(2n+1) .text{right:4em;}
	.local_list li:nth-child(2n+2) .text{left:4em;}
}
@media screen and (min-width: 800px) and (max-width: 1300px) {
	.local_list li .photo{
		width:55.12195122%;
		min-width:450px;
	}
	.local_list li .text{
		width:auto;
		min-width:42.60162602%;
		padding-left:2em;
		padding-right:2em;
	}
	.local_list li:nth-child(2n+1) .text{
		right:-webkit-calc((100vw - 800px)*64/500);
  	right:calc((100vw - 800px)*64/500);}
	.local_list li:nth-child(2n+2) .text{
		left:-webkit-calc((100vw - 800px)*64/500);
  	left:calc((100vw - 800px)*64/500);}
}
@media screen and (max-width: 799px) {
	.local_list{font-size:24px;}
	.local_list li .photo{width:100%;}
	.local_list li .text{
		left:0;
		right:0;
		/* bottom:-12em; */
		width:100%;
		padding-top:1em;
		padding-bottom:2em;
	}
	.local_list li .text > div{
		width:90%;
	}
	.local_list li.size5 .text,
	.local_list li.size5.addH1em .text,
	.local_list li.size6 .text,
	.local_list li.size6.addH1em .text,
	.local_list li.size7 .text,
	.local_list li.size7.addH1em .text,
	.local_list li.size8 .text,
	.local_list li.size8.addH1em .text,
	.local_list li.size9 .text,
	.local_list li.size9.addH1em .text{height:auto;}
	/*
	.local_list li.size5 .text{bottom:-15em;}
	.local_list li.size5.addH1em .text{bottom:-16em;}
	.local_list li.size6 .text{bottom:-17em;}
	.local_list li.size6.addH1em .text{bottom:-18em;}
	.local_list li.size7 .text{bottom:-19em;}
	.local_list li.size7.addH1em .text{bottom:-20em;}
	.local_list li.size8 .text{bottom:-21em;}
	.local_list li.size8.addH1em .text{bottom:-22em;}
	*/
}
.catch{
	padding-bottom:140px;
}
.catch_logo{
	padding-top:75px;
	padding-bottom:140px;
}
.catch img,
.catch_logo img{
	max-width:508px;
}
@media screen and (max-width: 799px) {
	.catch{padding-bottom:110px;}
	.catch_logo{
		padding-top:55px;
		padding-bottom:110px;
	}
}

.charabox{
	/* margin-top:185px; */
	padding:65px 0;
}
.charabox h2{
	font-size:225%;
	line-height:150%;
	margin-bottom:40px;
}
.charabox .chara{width:168px;}
.charabox .chara .name{
	position:absolute;
	top: 19em;
	left:-1.5em;
	text-align:left;
	width: 21em;
}
@media screen and (min-width: 800px) and (max-width: 909px) {.charabox .chara .name{width:13.25em;}}
.charabox .floatR_pc{
	margin-top:1em;
}
.charabox .msg{
	background-color:#FFF;
	color:#000;
	width:760px;
	padding:1.5em 2em;
	text-align:left;
	font-size: 90%;
	line-height:175%;
}
.charabox .msg .msgarrow{
	position:absolute;
	right:100%;
	right:-webkit-calc(100% - 1px);
	right:calc(100% - 1px);
	top:0;
	bottom:0;
	margin:auto;
	width:31px;
}
@media screen and (max-width: 1079px) {
	.charabox h2{
		font-size:190%;
		font-size:-webkit-calc(100vw * 34 / 1080);
		font-size:calc(100vw * 34 / 1080);
	}
	.charabox .msg{
		width:-webkit-calc(760px + 100vw - 1080px);
		width:calc(760px + 100vw - 1080px);
	}
}
@media screen and (max-width: 799px) {
	.charabox h2{font-size:190%;}
	.charabox{
		padding-top:45px;
		padding-bottom:45px;
	}
	.charabox .chara{width:40.57971014%;}
	.charabox .chara .name{
		position:absolute;
		top: 20.5em;
		left: -7.5em;
		width: 21em;
	}
	.charabox .floatR_pc{
		padding:0 18px;
		margin-top:2em;
	}
	.charabox .msg{
		width:100%;
		padding:1em;
	}
	.charabox .msg .msgarrow{
		left:65%;
		right:0;
		top:auto;
		bottom:100%;
		bottom:-webkit-calc(100% - 1px);
		bottom:calc(100% - 1px);
		margin:auto;
		width:7%;
	}
}
</style>
</head>

<body>
<?php echo $temp_pagetop; ?>
<div align="center">
<!-- * -->
<?php echo $temp_header; ?>
<!-- ** -->
<div id="h_colorborder" class="H_head"></div>
<?php
echo PAN(array($p_title));
echo PAGE_TITLE($p_title);
?>
<div class="content">
<div class="LH200 textC" style="padding-bottom:30px; font-size:150%;"><?php echo WORD_BR('はじめての方はまずここから。
90秒でわかるデュープレジデンス'); ?></div>
<!-- *** -->
<?php
/*<video src="images/top/movie.mp4" controls loop poster="images/content/concept/poster.jpg" controlslist="nodownload" preload="none" class="dpB W100per"></video>*/
?>
<iframe src="https://www.youtube.com/embed/dWa9jtSeWF8" class="dpB W100per movie" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

<div class="mgnT0_5em">
<div class="fontP080">DUP RESIDENCE  CONCEPT MOVIE</div>
<div class="fontP120 mgnT0_5em">コンセプトムービー</div>
</div>
<hr style="margin-top:100px; margin-bottom:110px;">
<div class="textC catch"><img src="images/content/concept/catch.png" class="dpB W100per mgnAuto"></div>
<ul class="local_list borderbox">
<?php
function CONCEPT_BOX($img,$text,$link=false){
	global $link_list;
	global $boxnum;
	$text=str_replace(array("\r\n","\n","\r"),'<br>',$text);
	$cnt=substr_count($text,'<br>');
	if($link){
		$add_link='<a href="'.$link_list['特長'].'" class="col_green font_meiryo">＞さらに詳しく</a>';
		$add_class=' addH1em';
	}
	else{
		$add_link='';
		$add_class='';
	}
	//<br>の数によってテキスト枠の大きさを変える
	echo '<li class="size'.($cnt+1).$add_class.' num'.($boxnum++).'"><img src="images/content/concept/'.$img.'" class="photo">
<div class="text"><div class="dpIB sp_br_del">'.$text.$add_link.'</div></div></li>';
}

$boxnum=1;

CONCEPT_BOX('photo1.jpg'
,'“所有からシェアへ”
いま、マイホームに対しての価値観が大きく変化しています。
デュープレジデンスは、都心生活に必要なものを
見つめなおすことで誕生した住まいです。
必要以上の部屋数、豪華なマンションの共有部分、
あるいは駐車場などの多くの無駄を削ぎ落とし、
誰もが手にしやすい価格を実現しています。');

CONCEPT_BOX('photo2.jpg'
,'都心部の大型マンションは風格ある佇まいが魅力ですが、
多くの部屋数を確保するためのスペース効率を
重視するあまり、画一的な間取り・動線となっています。
デュープレジデンスは、たった2家族だけの
プライベート感溢れる戸建てマンションで、
1・2階を贅沢に使えるメゾネットタイプを採用しています。',true);

CONCEPT_BOX('photo3.jpg'
,'また1棟2戸の構造で、すべてが角住戸のため、
どの住まいも十分な通風や採光を得ることができます。
さらに専用玄関や専用庭がプライベート性を確保し、
ひとつ上の豊かさを演出します。',true);

CONCEPT_BOX('photo4.jpg'
,'デュープレジデンスは、『名駅まで30分プロジェクト』を掲げ、
中部エリアの商業・文化の中心地である「名古屋駅」までの
スピーディかつスマートなアクセスを実現した立地に厳選して
います。
主要駅徒歩圏内の優れた利便性と同時に、戸建並みのゆとりと
快適性を実現する新しい住まいの提案を行っています。
当たり前にほしいものを、当たり前に。
日本の都市型マンションの新基準です。
（お客様のご要望に合わせて戸建てタイプもご用意しております）');

?>
</ul>
<div class="textC" style="padding-top:80px; padding-bottom:75px;">
<?php echo BTN_OVAL('特長','特長を知る','width:13em;','colorW'); ?>
<div style="height:1em;"></div>
<?php echo BTN_OVAL('物件情報','物件一覧を見る','width:13em;'); ?>
<div style="height:5em;"></div>
<?php echo LINK_TAG($link_list['中古マンションとの比較'],array('class'=>'dpIB','text'=>IMG_TAG($kaisou.'images/top/bnr/bnr20200206.png','W100per','max-width:394px;'))); ?>
</div>

</div>
<?php echo $concept_B; ?>
<?php
/*
<!-- ↓キャラクター紹介 -->
<div class="bg_green charabox borderbox">
<h2 class="pc_br_del mgnLR50 mgnLR0_sp"><span class="dpIB textL">DUPレジデンスのご案内は、<br>このPowlにお任せください。</span></h2>
<div class="Wmax980 mgnLR50 mgnLR0_sp">
<div class="floatL_pc"><div class="dpIB pos_rel chara"><img src="images/content/concept/chara-powl.png" class="W100per"><div class="name font_meiryo LH150"><?php echo WORD_BR('Powl<div class="fontP080">※DUPのPとOWL（フクロウ）から名付けられました。</div>'); ?></div></div></div>
<div class="floatR_pc"><div class="dpIB pos_rel msg radius10 font_meiryo">
<img src="images/content/concept/chara-msg-pc.svg" class="msgarrow sp_vanish">
<img src="images/content/concept/chara-msg-sp.svg" class="msgarrow pc_vanish">
<?php echo WORD_BR('みなさまのご案内役を務める、フクロウの「Powl（ポール）」です。
「令和」という新時代を迎え、私がこの役目を担うこととなりました。
フクロウならではの鋭敏な感覚を活かして、小さな変化の流れもいち早くキャッチ。お客様に寄り添いながら、時代に合ったミライの住まいをご提案できるよう努めます。
ハットと蝶ネクタイを身につけたジェントルマンらしく、みなさまのご質問やお悩み事にお応えするのが私の役割。行き届いたサポートをご提供するよう心がけ、メールでのご案内をベースに、さまざまな形で最新の情報をお届けします。
ご質問ご相談なども「'.LINK_TAG('dup@toshinjyuken.co.jp',array('type'=>'mail','class'=>'col_blue')).'」まで、お気軽にお尋ねください。
どうぞ私Powlをよろしくお願いいたします！'); ?>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<!-- ↑キャラクター紹介 -->
*/
?>
<div class="content">
<script>
$(window).load(function(){
	
	//ふわ
	fuwa=Array();
	scrtop=$(this).scrollTop()+$(window).height()/2;
	for(i=1;i<<?php echo $boxnum; ?>;i++){
		fuwa[(i-1)]=false;
		if (scrtop <= $(".local_list li.num"+i).offset().top) {
			if(i%2<1){
				$(".local_list li.num"+i).animate({opacity:0,marginLeft:-50},0,function(){
					$(this).queue([]);	// queueを空にする
    			$(this).stop();		// アニメーション停止
				});
			}
			else{
				$(".local_list li.num"+i).animate({opacity:0,marginRight:-50},0,function(){
					$(this).queue([]);	// queueを空にする
    			$(this).stop();		// アニメーション停止
				});
			}
			fuwa[(i-1)]=true;
		}
	}
  $(window).scroll(function(){
		scrtop=$(this).scrollTop()+$(window).height()/2;
		for(i=1;i<<?php echo $boxnum; ?>;i++){
			if(fuwa[(i-1)]){
				if (scrtop > $(".local_list li.num"+i).offset().top) {
					if(i%2<1){
						$(".local_list li.num"+i).animate({opacity:1,marginLeft:0},500,function(){
							$(this).queue([]);	// queueを空にする
    					$(this).stop();		// アニメーション停止
						});
					}
					else{
						$(".local_list li.num"+i).animate({opacity:1,marginRight:0},500,function(){
							$(this).queue([]);	// queueを空にする
   			 			$(this).stop();		// アニメーション停止
						});
					}
					fuwa[(i-1)]=false;
				}
			}
		}
  });
		
});
</script>
<?php
/*
<div class="textC" style="margin-top:70px;">
<?php echo BTN_OVAL('特長','特長を知る','width:13em;','colorW'); ?></div>
<div class="textC catch_logo"><?php
//<img src="images/content/concept/catch-logo.png" class="dpB W100per mgnAuto">
?></div>
*/
?>
<!-- *** -->
</div>
<!-- ** -->
<?php echo $temp_footer; ?>
<!-- * -->
</div>
</body>
</html>