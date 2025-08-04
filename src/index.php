<?php
$p_type='index';
$kaisou='';
require $kaisou."temp_php/basic.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php echo $temp_meta; ?>
<title><?php echo $temp_title; ?></title>
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/top.css" rel="stylesheet" type="text/css">
<?php echo $temp_java; ?>
<script src="js/wideslider/wideslider.js" type="text/javascript"></script>
<link href="js/wideslider/wideslider.css" rel="stylesheet" type="text/css">
<script src="//synalio.com/api/chatbox?appid=b498413f9f784d33a1288fe69433f063&mp=l&p=l" type="text/javascript"></script>
</head>

<body>
<?php echo $temp_pagetop; ?>
<div align="center">
<!-- * -->
<?php echo $temp_header; ?>
<!-- ** -->
<script>
$(window).load(function(){
	var h_colorborder=$("#h_colorborder").offset().top-75;
	
	//見えなくなったら非表示にしておく
	$(window).scroll(function(){
  	if ($(this).scrollTop() >= h_colorborder) {
			$(".movie video").addClass("im_vanish");
		}
		else {
			$(".movie video").removeClass("im_vanish");
		}
	});
	
	//ウィンドウサイズ変更時
	if($(".movie").width()*108 > $(".movie").height()*192){
		$(".movie video").addClass("base_w");
	}
	$(window).bind("resize load",function(){
		/*
				動画の比率＝w192：h108
		*/
		if($(".movie").width()*108 > $(".movie").height()*192){
			$(".movie video").addClass("base_w");
		}
		else{
			$(".movie video").removeClass("base_w");
		}
	});
});
</script>
<div class="movie">
<?php
switch(true){
	//case preg_match("/iPhone/",$HUA):
	//case preg_match("/Android/",$HUA):
	//break;
	default:
	echo '<video src="images/top/movie.mp4" webkit-playsinline="" playsinline="" autoplay="" loop="" muted=""></video>';// class="sp_vanish"
}


?>
<div class="dark"><div class="pos_rel">
<?php
echo '<img src="images/top/movie-catch.png" class="catch">
<img src="images/top/movie-scroll.png" class="scroll">
<a href="'.$link_list['コンセプト'].'"><div class="link borderbox"><img src="images/top/movie-link-fuki.svg" class="fuki"><img src="images/top/movie-link.png" class="btn"></div></a>';
?>
<div class="icon_okage1000">
<?php
//safariだけエフェクト封印
$safari_vanish='';
$browser = strtolower($_SERVER['HTTP_USER_AGENT']);
switch(true){
	case (strstr($browser,$t='edge')):
	case (strstr($browser,$t='trident')):
	case (strstr($browser,$t='msie')):
	case (strstr($browser,$t='chrome')):
	case (strstr($browser,$t='firefox')):
	//$browser='';
	break;
	case (strstr($browser,$t='safari'))://サファリだけブラウザ分岐あり
	//$browser=$t;
	$safari_vanish=' class="im_vanish"';
	break;
	case (strstr($browser,$t='opera')):
	//$browser='';
	break;
	default:
	//$browser='';
}
?>
<div<?php echo $safari_vanish; ?>></div>
<div></div>
<div<?php echo $safari_vanish;
unset($safari_vanish);
unset($browser);
?>></div>
</div>
</div></div>
</div>
<div id="h_colorborder"></div>
<!-- *** -->
<div class="bg_white pos_rel"><!-- ▼ 白背景 -->
<?php
$nowdate=date('Ymd');
echo '<!-- NOWDATE:'.$nowdate.' -->'.chr(10);

//スライダー
$arr=array();
//$arr[]=array('campaign-202001.php'			,'bnr20200106.jpg'								,600,array('s'=>20200106,'s-type'=>'Ymd','e'=>20200131,'e-type'=>'Ymd'));
//$arr[]=array('iot/'											,'images/content/info/bnr-iot.jpg',600);
//$arr[]=array($link_list['お問い合わせ']	,'bnr20191007.png'								,600,array('s'=>2019122512,'s-type'=>'YmdH'));

$cnt=1;
$ws=$pn='';
foreach($arr as $k => $v){
	$bnr=TOP_BNR($v[0],$v[1],$v[2],$v[3]);
	if(!empty($bnr)){
		$ws.='<li>'.$bnr.'</li>'.chr(10);
		$pn.='.pagination a.pn'.$cnt.'{background-image:url('.TOP_BNR_DIR($v[1]).');}'.chr(10);
		$cnt++;
	}	
}

if(count($arr)>0){
?>
<style>
<?php echo $pn; ?>
</style>
<div style="height:34vw; max-height:200px; padding-top:1.25em; overflow:hidden;"><div class="wideslider borderbox"><ul>
<?php echo $ws; ?>
</ul></div></div>
<?php } ?>

<div class="mgnAuto top_bnrbox">
<?php
$bnrset_type='TOPキャッチコピー上';
require $kaisou."temp_php/temp_bnrset.php";

$pad='<div></div><div class="pc_vanish" style="height:1em;"></div>';
?>
<div class="LH200 sp_textL mgnLR50 mgnLR0_sp" style="padding-top:1em; padding-bottom:2em;"><?php echo WORD_BR('デュープレジデンスは、たった2家族だけのプライベート感溢れる、1棟2戸のメゾネットマンション。'.$pad.'駅近エリアに限定したコンパクトな住まいは、リーズナブルな価格とランニングコストの負担を抑えることで、<br class="sp_vanish">ゆとりある快適かつ上質な都市生活を実現します。'.$pad.'お2人様ぐらいにちょうどいいサイズで、世代を問わず幅広いニーズに応える、新しいカタチの住まいです。
（お客様のご要望に合わせて戸建てタイプもご用意しております）'); ?></div>
<?php
$bnrset_type='TOPキャッチコピー下';
require $kaisou."temp_php/temp_bnrset.php";
?>
</div>
<div class="top_news"><div class="box">
<div class="title LH100"><span class="LS0_1em">NEWS</span><div class="mini font_meiryo">お知らせ</div></div>
<ul class="text LH150 font_meiryo">
<?php
$dir='system/news/';
include_once("system/info/admin/include/config.php");//TOPのNEWSには影響がないため、コンフィグはinfoの方を使用
$file_path = $dir.'data/data.dat';
$img_updir = $dir.'upload';
$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config,'','',false,true);

$cnt=0;
$max=5;

$news_set=array();		//通常記事
$news_set_pu=array();	//ピックアップ記事（お知らせ上部に優先的に表示する）

foreach($getFormatDataArr as $key => $sysdata){
/*
echo '日付:'.$sysdata['up_ymd'].'<br>';
echo 'タイトル:'.$sysdata['title'].'<br>';//リンクあり
echo 'タイトル:'.$sysdata['title_text'].'<br>';
echo 'カテゴリ:'.$sysdata['category'].'<br>';
*/

	$arr=explode("-",$sysdata['up_ymd_data']);
	if($key>=10){
		$add_param='?p='.(floor($key/10)+1);//最新記事から10件以上古い時は変数追加
	}
	else{$add_param='';}
	$str='<li><table border="0" cellpadding="0" cellspacing="0"><tr>
<td>'.$arr[0].'.'.$arr[1].'.'.$arr[2].'</td>
<td>'.((($sysdata['url']!='')||($sysdata['link_file']!=''))?$sysdata['title']:'<a href="'.$link_list['NEWS'].$add_param.'?id='.$sysdata['id'].'">'.$sysdata['title_text'].'</a>').'</td>
</tr></table></li>'.chr(10);

	if($sysdata['news_pickup']>0){				
		$news_set_pu[]=$str;
	}
	else{
		$news_set[]=$str;
	}
}
for($i=0;$i<count($news_set_pu);$i++){
	if($cnt>=$max){break;}
	echo $news_set_pu[$i];
	$cnt++;
}
for($i=0;$i<count($news_set);$i++){
	if($cnt>=$max){break;}
	echo $news_set[$i];
	$cnt++;
}


/*
<li><table border="0" cellpadding="0" cellspacing="0"><tr>
<td>2018.11.11</td>
<td><a href="#">dddd</a></td>
</tr></table></li>
*/
?>
</ul>
<div class="clear"></div>
</div></div>
<!-- *** -->
<?php
if(false){
?>

<?php
$dir='system/info/';
$file_path = $dir.'data/data.dat';
$img_updir = $dir.'upload';
$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config,'','');
?>
<div class="Wmax1200 mgnLR50 mgnLR20_sp">
<div class="top_bnrbox" style="margin: 0 -0.75em;margin-top:1.75em; padding:1.25em 0;">
<?php
$bnrset_type='TOPおすすめ物件上';
require $kaisou."temp_php/temp_bnrset.php";
?>
</div>
<?php echo PAGE_TITLE('','PICK UP','おすすめ物件','h3','LH100',' style="margin:auto; padding-top:50px; padding-bottom:45px;"'); ?>

<?php echo $temp_java_slidemenu; ?>
<?php
$slide_str='';
$cnt=0;
foreach($getFormatDataArr as $key => $sysdata){
	/*
			ピックアップ表示
	*/
	
	//ピックアップ以外はスルー
	if($sysdata['pickup']<1){continue;}
	
	$step=$sysdata['categoryNum2']+1;
	$newmark='';
	switch(true){
		case ($sysdata['soldout']>0):
		$step=0;
		break;
		case ($sysdata['modelroom']>0):
		//$step='_mr';
		$step='_ev'.sprintf('%02d',$sysdata['modelroom']);
		if($sysdata['modelroom']==2){$newmark='販売開始';}
		break;
		case ($sysdata['categoryNum2']==0):
		$newmark='新着物件';
		break;
	}
	
	$link=$link_list['物件情報詳細'].'?id='.$sysdata['id'].'&place=/'.$sysdata['roma'].'/';
	
	//会員限定でかつログインがまだの時
	if(($step==1)&&(!isset($_SESSION['member']))){
		$login_window=' class="login_window" onclick="return false;"';
	}
	else{
		$login_window='';
	}
	
	$slide_str.='<li>
<table border="0" cellpadding="0" cellspacing="0"><tr>
<td class="photo step'.$step.'"><a href="'.$link.'"'.$login_window.'><img src="images/common/clear-slide.png" style="background-image:url('.$sysdata['appearance_upfile_path_thumb'][0].');"><div></div></a></td>
</tr><tr>
<td class="text">
<h4>'.$sysdata['title_text'].'</h4>
<div class="access font_meiryo">'.TextToKanma($sysdata['slide_text'][0]).'</div>
<div class="newmark font_meiryo">'.(($newmark!=''/*$sysdata['newmark']>0*/)?'<span class="radius05">'.$newmark.'</span>':'').'</div>
</td>
</tr></table>
</li>'.chr(10);

	$cnt++;
	
}

/*
<li>
<table border="0" cellpadding="0" cellspacing="0"><tr>
<td class="photo"><a href="#"><img src="images/common/clear-slide.png"><div></div></a></td>
</tr><tr>
<td class="text">
<h4>デュープレジデンス○○駅</h4>
<div class="access font_meiryo">JR○○線「○○駅」まで<br>徒歩約**分<br>A1タイプ：1,000万円　A2タイプ：1,100万円</div>
<div class="newmark font_meiryo"><span class="radius05">新着物件</span></div>
</td>
</tr></table>
</li>
*/
?>
<script>
$(window).load(function(){
	PICKUP_HEIGHT();
	$(window).bind("resize load",function(){
		PICKUP_HEIGHT();
	});
});
function PICKUP_HEIGHT(){
	var maxH=0;
	$('.slide_box li table').each(function(){
		if($(this).height() > maxH){
			maxH = $(this).height();
		}
	});
	$('.slide_box li,.slide_box .menu').height(maxH+50);
	$('.slide_box .arrow .btn_prev,.slide_box .arrow .btn_next').height(maxH);
}
</script>
<table border="0" cellpadding="0" cellspacing="0" class="slide_box borderbox"><tr>
<td align="center" valign="top" class="arrow"><div class="btn_prev" move="1"></div></td>
<td align="left" valign="top" class="menu"><div class="pos_rel"><ul<?php echo (($cnt>=2)?' class="loop"':''); ?>>
<?php
if($cnt>=2){echo $slide_str.$slide_str.$slide_str;}
else{echo $slide_str;}
?>
<div class="clear"></div>

</ul></div></td>
<td align="center" valign="top" class="arrow"><div class="btn_next" move="1"></div></td>
</tr></table>
</div>
<?php
/*
<!-- *** -->
<div class="textC" style="margin-top:20px; margin-bottom:70px;"></div>
*/
//echo BTN_OVAL('物件情報','全ての物件を見る','width:600px;','colorW_R'); ?>
<!-- *** -->
<?php
/*
//MAP一時封印
<?php require $kaisou."temp_php/temp_map.php"; ?>
<div class="fontP130 LH175" style="margin-bottom:0.25em;">DUPレジデンス 物件MAP</div>
<div id="map" class="textL Wmax1200 mgnLR50 mgnLR20_sp" style="height:600px; margin-bottom:75px;"></div>
*/
?>
<!-- *** -->
<?php require $kaisou."temp_php/temp_areabtn.php"; ?>
<div class="textC" style="margin-top:20px; margin-bottom:70px; padding: 0 20px;">
<img src="images/common/text/text-maitsuki.svg" class="mgnAuto" style="width:408px; margin-bottom: 12px;">
<?php echo BTN_OVAL('物件情報','全ての物件はこちら','width:600px;','colorR font_min'); ?></div>
<!-- *** -->
<?php
}//if(false)
?>
<div style="height:2em;"></div>
<?php
/*
<div class="top_bnrbox" style="margin-bottom: 50px;">
<a href="yasusa.php" class="dpIB"><img src="images/top/bnr/bnr-yasusa.png"></a>
</div>
<!-- *** -->
*/
?>
<div class="padB75 Wmax1200 mgnLR50 mgnLR0_sp bnrmenu">
<?php
//※TOP_BNRとは異なる関数です
function TOP_MENUBNR($link,$img,$title1,$title2){
	echo '<a href="'.$link.'"><li class="WH"><div class="WH bg" style="background-image:url(images/top/'.$img.');"></div><div class="WH dark"><div class="text LH100"><span class="LS0_1em">'.$title1.'</span><div class="mini font_meiryo">'.$title2.'</div></div></div></li></a>'.chr(10);
}
?>
<ul class="bnrmenu1">
<?php
TOP_MENUBNR($link_list['コンセプト']			,'bnr-bg1.jpg','CONCEPT'				,$notation_list['コンセプト']['jp-top']);
TOP_MENUBNR($link_list['特長']						,'bnr-bg2.jpg','MERIT'					,$dup_data['ブランド名'].'の特長');
//TOP_MENUBNR($link_list['3Dモデルハウス']	,'bnr-bg3.jpg','3D MODEL HOUSE'	,'3Dモデルハウス');
//TOP_MENUBNR($link_list['見学するには']	,'bnr-bg3.jpg','見学するには'	,'');
TOP_MENUBNR($link_list['開発ストーリー'] ,'bnr-bg6.jpg','DEVELOPMENT STORY','開発ストーリー');
TOP_MENUBNR($link_list['お客様の声']			,'bnr-bg4.jpg','VOICE'					,'お客様の声');
?>
<div class="clear"></div>
</ul>
<ul class="bnrmenu2_v2024">
<?php
TOP_MENUBNR($link_list['Q&A']						,'bnr-bg7.jpg','Q&A','');
TOP_MENUBNR($link_list['NEWS']						,'bnr-bg5.jpg','NEWS','お知らせ');
//TOP_MENUBNR($link_list['ギャラリー']		 ,'bnr-bg8.jpg','GALLERY','ギャラリー');
/*<div class="clear"></div>*/
?>
</ul>
<!-- *** -->
<div class="top_bnrbox under">
<?php
$bnrset_type='TOPメニューバナー下';
require $kaisou."temp_php/temp_bnrset.php";
?>
</div>
</div>
<!-- ** -->
<?php echo $temp_footer; ?>
<!-- * -->
</div><!-- ▲ 白背景 -->

</div>

<?php echo $temp_loginbox; ?>
<?php
/*
//MAP一時封印
<script>
var markerData = [<?php echo $mapset; ?>];
var zoom=10;
var center_lat=<?php echo $map_center_lat; ?>;
var center_lng=<?php echo $map_center_lng; ?>;
</script>
<?php echo $temp_googlemap_js; ?>
*/
?>
<?php
/*
<!-- CHATBOX -->
<script>(function(){
var w=window,d=document;
var s="https://app.chatplus.jp/cp.js";
d["__cp_d"]="https://app.chatplus.jp";
d["__cp_c"]="0c1f9137_1";
var a=d.createElement("script"), m=d.getElementsByTagName("script")[0];
a.async=true,a.src=s,m.parentNode.insertBefore(a,m);})();</script>
*/
?>
</body>
</html>