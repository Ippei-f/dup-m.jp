<?php
//<meta charset="utf-8">
/*
		DUP共通部分PHP 201807ver

*/

//エラー表示なしにする
error_reporting(0);


//◆共通変数・配列

$dup_data = array(
	'本社名'				=> '東新住建株式会社',
	'ブランド名'		=> 'デュープレジデンス',
	'TEL'					=> '0800-170-5104' //[本社TEL?]0587-88-7355
	,
	'TEL-問合窓口'	=> '0587-88-7355',
	'営業時間'			=> '10:00～18:00',
	'定休日'				=> '年末年始'
	//,'定休日'				=>'水曜日'
	//-----
	,
	'copyright' => 'Copyright 2017 TOSHIN JYUKEN. All rights reserved.'
);

//建築許可番号読み込み
$dup_data['建築許可番号'] = array(
	'宅地建物取引業免許：国土交通大臣（4）7873号',
	'特定建設業許可：愛知県知事許可（特-4）第61271号',
	'（公社）愛知県宅地建物取引業協会会員',
	'東海不動産取引協議会加盟'
);
/*
↑DUPからは読み込めないので、普通に配列に文字入力

$dup_data['建築許可番号']=file_get_contents("https://www.toshinjyuken.co.jp/recaptcha/common-kyoka.txt");
$dup_data['建築許可番号']=str_replace(array("\r\n","\n","\r"),'
',$dup_data['建築許可番号']);
$dup_data['建築許可番号']=explode('
',$dup_data['建築許可番号']);
*/


//メールアドレスデータベース
$to_mail_db = array(
	'test' => array('yamakawa@showa-print.co.jp'),
	'default' => array(
		'info@toshinjyuken.co.jp',
		'dup@toshinjyuken.co.jp'
		//,'yuuya-kawakami@toshinjyuken.co.jp'
	)
);
/*
,'uchida28@gmail.com'
,'tsonmaasakato@gmail.com'
,'info@adphant.jp'
*/
$to_mail_db['noreply'] = $to_mail_db['default'][1];


$t_blank = '" target="_blank" rel="noopener noreferrer';

$link_list = array(
	'TOP' => $kaisou . 'index.php'
	//-----
	,
	'NEWS'									=> $kaisou . 'news.php',
	'物件情報'							=> 'https://www.toshinjyuken.co.jp/kodate/search.php?search=%E3%83%96%E3%83%A9%E3%83%B3%E3%83%89,DUP%E3%83%AC%E3%82%B8%E3%83%87%E3%83%B3%E3%82%B9' . $t_blank
	//,'物件情報'							=>$kaisou.'info.php'//2025/06/05
	,
	'物件情報詳細'					=> $kaisou . 'info-detail.php'
	//-----
	,
	'コンセプト'					=> $kaisou . 'concept.php',
	'コンセプト-0x'				=> $kaisou . 'concept/lifestyle.php',
	'コンセプト-01'				=> $kaisou . 'concept/woman.php',
	'コンセプト-02'				=> $kaisou . 'concept/minimal-life.php'
	//-----
	,
	'特長'										=> $kaisou . 'merit.php',
	'3Dモデルハウス'					=> $kaisou . '3Dmodel.php',
	'お客様の声'						 => $kaisou . 'voice.php',
	'オーナー様アンケート'		=> $kaisou . 'voice-graph.php',
	'開発ストーリー'				 => $kaisou . 'story.php',
	'Q&A'										=> $kaisou . 'qa.php',
	'ショールーム'						=> $url = ($kaisou . 'showroom.php'),
	'ギャラリー'						 => $url,
	'中古マンションとの比較' => $kaisou . 'contrast.php',
	'VR見学'									=> $kaisou . 'VRkengaku.php',
	'見学するには'						=> $kaisou . 'qa-kengaku.php',
	'安さの秘密'						=> $kaisou . 'yasusa.php'
	//-----
	,
	'DUP会員登録'				=> $kaisou . 'member.php',
	'お問い合わせ'				=> $url = 'https://www.toshinjyuken.co.jp/kodate/contact.php' . $t_blank //2025/07/24変更
	//,'お問い合わせ'				=>$url=($kaisou.'contact.php')
	,
	'ご来場予約フォーム' => $url,
	'DUP資料請求'				=> $kaisou . 'document.php',
	'ご見学前アンケート' => $kaisou . 'questionnaire.php'

	//-----
	,
	'IoT'								=> $kaisou . 'iot/'
	//-----
	,
	'個人情報保護方針'	=> 'https://www.toshinjyuken.co.jp/co_navi/12b948e70356b6d532f95f68-456.html' . $t_blank
	//-----
	,
	'東新住建本社' => 'http://www.toshinjyuken.co.jp/' . $t_blank,
	'東新住建-家'	=> 'http://www.toshinjyuken.co.jp/kodate/' . $t_blank
	//-----
	//,''=>$kaisou.'#'
);

//日英表記
$notation_list = array(
	'TOP'						=> array('en' => 'HOME', 'jp' => 'ホーム')
	//-----
	,
	'NEWS'						=> array('en' => 'NEWS', 'jp' => 'お知らせ'),
	'物件一覧'				=> array('en' => 'HOUSING INFO', 'jp' => '物件一覧'),
	'物件情報'				=> array('en' => 'HOUSING INFO', 'jp' => '物件情報'),
	'コンセプト'			=> array('en' => 'CONCEPT', 'jp' => 'デュープレジデンスとは', 'jp-top' => 'コンセプト')
	//,'コンセプト'			=>array('en'=>'CONCEPT'							,'jp'=>'コンセプト')//~181009
	,
	'コンセプト-0x'	=> array('en' => 'DUP LIFESTYLE MAGAZINE', 'jp' => 'DUP ライフスタイルマガジン'),
	'コンセプト-01'	=> array('en' => 'DUP LIFESTYLE MAGAZINE', 'jp' => 'DUP ライフスタイルマガジン', 'jp-top' => '女性のマンション購入'),
	'コンセプト-02'	=> array('en' => 'DUP LIFESTYLE MAGAZINE', 'jp' => 'DUP ライフスタイルマガジン', 'jp-top' => 'ミニマルライフ'),
	'特長'						=> array('en' => 'MERIT', 'jp' => '特長'),
	'3Dモデルハウス'	=> array('en' => '3D MODEL HOUSE', 'jp' => '3Dモデルハウス'),
	'お客様の声'			=> array('en' => 'VOICE', 'jp' => 'お客様の声'),
	'開発ストーリー'	=> array('en' => 'DEVELOPMENT STORY', 'jp' => '開発ストーリー'),
	'Q&A'						=> array('en' => 'Q&A', 'jp' => 'よくあるご質問'),
	'ショールーム'		=> $arr = array('en' => 'GALLERY', 'jp' => 'ギャラリー'),
	'ギャラリー'		 => $arr,
	'DUP会員登録'		=> array('en' => 'MEMBER REGISTRATION', 'jp' => 'DUPレジデンス<br>会員登録'),
	'お問い合わせ'		=> array('en' => 'CONTACT', 'jp' => 'DUPレジデンス<br>お問い合わせ・資料請求・ご来場予約')
	//,'DUP資料請求'		=>array('en'=>'DOCUMENT'						,'jp'=>'DUP資料請求')
	,
	'見学するには' => array('en' => '見学するには', 'jp' => 'ウイルス感染予防対策')
	//-----
	//,''=>array('en'=>'','jp'=>'')
);


//◆閲覧制限
session_start();
switch ($p_limit) {
	case 'memberonly': //会員限定（会員登録がOKでないと一覧に戻される）
		if ($_POST['login_check'] == 'on') {
			$flag = true;
			switch ($_POST['login_id']) {
				case 'dup2018':
					if ($_POST['login_pw'] != 'dup2018') {
						$flag = false;
					}
					break;
				default:
					$flag = false;
			}
			if ($flag) {
				$_SESSION['member'] = 'ok';
			}
		}
		if (!isset($_SESSION['member'])) {
			header('Location:' . $link_list['物件情報']);
			exit();
		}
		break;
	default:
		//通常ページ（保存したパスワードを破棄）
		//if(isset($_SESSION['member'])){unset($_SESSION['member']);}
		//if(isset($_SESSION['login_id'])){unset($_SESSION['login_id']);}
		//if(isset($_SESSION['login_pw'])){unset($_SESSION['login_pw']);}
}


//◆メタタグ（グーグルタグマネージャー含む）
$temp_meta = "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore
(j,f);
})(window,document,'script','dataLayer','GTM-KS4HCFR');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore
(j,f);
})(window,document,'script','dataLayer','GTM-NWHSSFS');</script>
<!-- End Google Tag Manager -->";
//IMタグ
$temp_meta .= "<script type=\"text/javascript\">
 (function(w,d,s){
  var f=d.getElementsByTagName(s)[0],j=d.createElement(s);
  j.async=true;j.src='https://dmp.im-apps.net/js/1013764/0001/itm.js';
  f.parentNode.insertBefore(j, f);
 })(window,document,'script');
</script>" . chr(10);
//シナリオ
$temp_meta .= '<script>!function(){!function(t,e,n){(t.NanalyticsObject=n)in t||(t[n]=function(){(t[n].q=t[n].q||[]).push(arguments)},t[n].ep=e);var a=t.document.getElementsByTagName("script")[0],o=t.document.createElement("script"),i=1e17*Math.random();o.type="text/javascript",o.async=!0,o.src="https://sdk."+e+"/v1/web.js?sid="+i,a.parentNode.insertBefore(o,a)}(window,"n-analytics.io","Nanalytics");var t="_rslgvry",e="_rslgvry_conv_cnt",n=/^((?!chrome|android|crios).)*safari/i.test(navigator.userAgent);function a(t){var e=null,n=t+"=",a=document.cookie,o=a.indexOf(n);if(-1!=o){var i=o+n.length,r=a.indexOf(";",i);-1==r&&(r=a.length),e=decodeURIComponent(a.substring(i,r))}return e}var o=function(){var e=n?localStorage.getItem(t):a(t);e||(e="xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,function(t){var e=16*Math.random()|0;return("x"==t?e:3&e|8).toString(16)}),n?localStorage.setItem(t,e):function t(e,n,o,i){var r=n+"="+o+";max-age="+(i||63072e3)+";path=/;";if(t.domain)e.cookie=r+"domain=."+t.domain;else{var c=location.hostname.split(".");c.length>2&&c.shift(),t.domain=c.join("."),e.cookie=r+"domain=."+t.domain,a(n)!=o&&(t.domain=location.hostname,e.cookie=r+"domain=."+t.domain)}}(document,t,e,63072e3));return e}();Nanalytics("setup","NA-201",(new Date).getTime()),Nanalytics("config","itp_recovery",!0),Nanalytics("send","pageview",{customer_id:o,app_unique_id:"b498413f9f784d33a1288fe69433f063",chatbot_talk:((n?localStorage.getItem(e):a(e))||0).toString()})}();</script>' . chr(10);

//キーワード
$temp_meta .= '<meta name="keywords" content="愛知県,名古屋市,メゾネットマンション,新築マンション,中古マンション,分譲マンション,耐震,駅近,角部屋,リーズナブル,一戸建て,分譲住宅,階段, 採光,日当たり,南向き,駅から近い,駅から徒歩, 駅まで徒歩,東新住建,DUP,地下鉄,名鉄,JR,三河線,豊田線,河和線,鶴舞線,桜通線,名城線,名港線,東山線,東海道本線,名鉄瀬戸線,名古屋本線,各務原線,犬山線,物件,おひとり様,おふたり様,DINKs,単身,独身,二人暮らし,ペット,資料請求,土地付き,新築,一軒家">' . chr(10);
/*
switch($p_type){	
	case 'info-detail':
~20210326
$temp_meta.='<meta name="keywords" content="愛知県,名古屋市,メゾネットマンション,新築マンション,中古マンション,分譲マンション,耐震,駅近,角部屋,リーズナブル,熱田区,北区,昭和区,千種区,天白区,中川区,中村区,西区,東区,瑞穂区,緑区,南区,名東区,守山区,岐阜市,江南市,清須市,稲沢市,刈谷市,大府市,豊明市,日進市,半田市,一戸建て,分譲住宅,階段, 採光,日当たり,南向き,駅から近い,駅から徒歩,駅まで徒歩,東新住建, ,DUP,地下鉄,名鉄,JR,三河線,豊田線,河和線,鶴舞線,桜通線,名城線,名港線,東山線,東海道本線,名鉄瀬戸線,名古屋本線,各務原線,犬山線,物件,おひとり様,おふたり様,DINKs,単身,独身,二人暮らし,ペット,資料請求,土地付き ,新築,一軒家,新着物件,桜本町駅,平安通駅,大高駅,六番町駅,小幡駅,名鉄岐阜駅,岐阜駅,江南駅,下小田井駅,稲沢駅,刈谷市駅,大府駅,前後駅,赤池駅,知多半田駅,本山駅,桜山駅,いりなか駅,平針駅,勝川駅,岡崎駅,小牧駅">'.chr(10);
	break;
	default:	
~20210326
$temp_meta.='<meta name="keywords" content="愛知県,名古屋市,メゾネットマンション,新築マンション,中古マンション,分譲マンション,耐震,駅近,角部屋,リーズナブル,熱田区,北区,昭和区,千種区,天白区,中川区,中村区,西区,東区,瑞穂区,緑区,南区,名東区,守山区, ,一戸建て,分譲住宅,階段, 採光,日当たり,南向き,駅から近い,駅から徒歩, 駅まで徒歩,東新住建, ,DUP,地下鉄,名鉄,JR,三河線,豊田線,河和線,鶴舞線,桜通線,名城線,名港線,東山線,東海道本線,名鉄瀬戸線,名古屋本線,各務原線,犬山線,物件,おひとり様,おふたり様,DINKs,単身,独身,二人暮らし,ペット,資料請求,土地付き ,新築,一軒家">'.chr(10);
}
*/
//デスクリプション
switch ($p_type) {
	case 'info-detail':
		$temp_meta .= '<meta name="description" content="' . $sysdata['list_text'][0] . 'の新築分譲マンション、' . $sysdata['title_text'] . '。東新住建の【デュープ−DUPレジデンス−】は、マンションの上をゆくをコンセプトに、駅近にこだわる人気の全戸角住居で提供するメゾネットマンションです。" />' . chr(10);
		break;
	default:
		$temp_meta .= '<meta name="description" content="愛知県・名古屋市の新築分譲マンション、新築一戸建てなら、東新住建が提供する【DUP（デュープ）レジデンス】。2人くらいにちょうどいい新しい住まい。駅近新築なのにリーズナブルな価格で人気の“戸建てマンション”だから、共働き夫婦やシングルママ、お一人様などに選ばれています。" />' . chr(10);
		/*
	~20220819
	$temp_meta.='<meta name="description" content="愛知県・名古屋市の新築分譲マンション、新築一戸建てなら、東新住建が提供する【DUP（デュープ）レジデンス】。駅近新築なのにリーズナブルな価格で人気のメゾネットマンション。駅徒歩圏内の好立地で戸建て並みのゆとりと快適性を実現する新しい住まいです。" />'.chr(10);
	~20201012
	$temp_meta.='<meta name="description" content="愛知県・名古屋市の新築分譲マンション、新築一戸建て、賃貸なら、東新住建が提供する【DUP（デュープ）レジデンス】。駅近新築なのにリーズナブルな価格で人気のメゾネットマンション。駅徒歩圏内の好立地で戸建並みのゆとりと快適性を実現する新しい住まいです。" />'.chr(10);
	*/
}
$temp_meta .= '<meta name="google-site-verification" content="YwEvU53plsjlpz0Dgu0g1l1BTVVU0kVwZMAl-NGDNAQ" />
<link rel="shortcut icon" href="' . $kaisou . 'images/favicon.ico" type="image/vnd.microsoft.icon">' . chr(10);

//viewport
$HUA = $_SERVER['HTTP_USER_AGENT'];
switch (true) {
	case preg_match("/iPad/", $HUA):
		$temp_meta .= '<!-- viewport=iPad -->
	<meta name="viewport" content="width=1300px">' . chr(10);
		//
		break;
	/*
case preg_match("/iPhone/",$HUA):$HUA='iPhone';break;
case preg_match("/Android/",$HUA):$HUA='Android';break;
*/
	default:
		$temp_meta .= '<!-- viewport=nomal -->
	<meta name="viewport" content="width=640px,user-scalable=0" />' . chr(10); //initial-scale=0.5, maximum-scale=0.6//width=divice-width
		//<meta name="viewport" content="width=divice-width,initial-scale=1.0">
		//target-densitydpi=device-dpi
}

//◆タイトル
$temp_title1 = '';
$temp_title2 = 'デュープレジデンス｜愛知県の駅近新築住宅‐東新住建';
/*
~20220819
$temp_title1='愛知・名古屋の新築駅近メゾネットマンション';
$temp_title2='｜デュープレジデンス【東新住建】';
*/
//$temp_h1=$temp_title1.'、一軒家、賃貸'.$temp_title2;//h1は全共通//~20201104
//$temp_h1=$temp_title1.'、一軒家';//h1は全共通
switch ($p_type) {
	case 'news':
		$temp_title1 = '最新NEWS';
		break;
	case 'info-detail':
		$temp_title1 = str_replace('デュープレジデンス', '', $sysdata['title_text']);
		break;
	case 'merit':
	case 'voice':
	case 'voice-detail':
	case 'qa':
		$temp_title1 = $p_title;
		break;
		break;
	case 'content': //その他コンテンツ
		switch ($p_title) {
			case '物件情報':
				$temp_title1 = '物件情報一覧';
				break;
			case '3Dモデルハウス':
				$temp_title1 = '3D体験';
				break;
			case 'コンセプト':
				$temp_title1 = ($p_title_sub != '') ? $notation_list[$p_title_sub]['jp-top'] : $p_title;
				//$temp_title1=$p_title.'｜'.$temp_title1;
				break;
			case 'コンセプト-0x':
				$temp_title1 = '@@'; //後から変換を加える
				break;
			default:
				$temp_title1 = $p_title;
		}
		break;
	default: //その他
		switch ($p_title) {
			case '無人IoTモデルルーム':
				$temp_title1 = $p_title;
				break;
			default:
				//$temp_title1='愛知県名古屋市の駅近新築分譲マンション、一戸建て';
				//$temp_title1='愛知県の駅近新築住宅';
		}
}
if ($temp_title1 != '') {
	$temp_title1 .= '｜';
}
$temp_title = '【公式】' . $temp_title1 . $temp_title2;

/*
~20191105
$temp_title='デュープレジデンス【東新住建】愛知県名古屋駅近の分譲マンション';
$temp_h1=$temp_title.'、一軒家、賃貸';
$temp_title=$temp_title.'、一戸建て';
*/

$temp_java = '<script src="/js/jquery.v1.11.1.min.js" type="text/javascript"></script>
<script>
$(window).load(function(){
	
	//ヘッダ色変化
	var h_colorborder=$("#h_colorborder").offset().top-75;
	$("#header").addClass("transition");
	if ($(this).scrollTop() >= h_colorborder) {
		$("#header").removeClass("flag1");
	}
	$(window).scroll(function(){
  	if ($(this).scrollTop() >= h_colorborder) {
			$("#header").removeClass("flag1");
		}
		else {
			$("#header").addClass("flag1");
		}
	});
	$("#header").hover(
	function(){
		if($(this).offset().top+75 > $("#header .formbtn").offset().top){
			$(this).removeClass("flag2");
		}
	},
	function(){
		$(this).addClass("flag2");
	});
	
	//スマホメニュー
	var menubtn=false;
	if($(this).width()<800){menubtn=true;}
	$(window).bind("resize load",function(){
		if($(this).width()<800){
			menubtn=true;
			$("#header .h_menu").hide();
			$("#header .menubtn .bg_cover").removeClass("close");
		}
		else{
			menubtn=false;
			$("#header .h_menu").show();
		}
	});
	$(".menubtn").click(function(){
		if(menubtn){
			if($("#header .h_menu").css("display")=="none"){
				$("#header .menubtn .bg_cover").addClass("close");
			}
			else{
				$("#header .menubtn .bg_cover").removeClass("close");
			}
			$("#header .h_menu").slideToggle();
		}
  });
	$("#header .h_menu a").click(function(){
		if(menubtn){
			$("#header .menubtn .bg_cover").removeClass("close");
			$("#header .h_menu").slideToggle();
		}
	});
	$("#header .h_menu .closebtn").click(function(){
		if(menubtn){
			$("#header .menubtn .bg_cover").removeClass("close");
			$("#header .h_menu").slideToggle();
		}
	});
	
	//滑らかページ内リンク
	$("a[href^=#]").click(function() {    
    var target = $(this.hash);//移動先となる要素を取得
		var speed = 500;
    if (!target.length){
			$("html,body").animate({scrollTop: 0},speed,"swing");
		}
		else{
			$("html,body").animate({scrollTop:target.offset().top},speed,"swing");
		}
    window.history.pushState(null,null,this.hash);//ハッシュ書き換え
    return false;
  });
	
	//スマホhover
	$("a").on("touchstart", function(){
    $(this).addClass("hover");
	}).on("touchend", function(){
    $(this).removeClass("hover");
	});
	
});
</script>' . chr(10);
/*
	//ヘッダメニュー追従
	if($("#header_pc_menu").length){
		var box    = $("#header_pc_menu");
		var boxpad = $("#header_pc_menu_pad");
		var boxTop = box.offset().top;
		
		if($(window).scrollTop()>= boxTop){
			box.addClass("fixed");
			boxpad.addClass("fixed");
		}

		$(window).scroll(function(){
			if($(window).scrollTop()>= boxTop){
				box.addClass("fixed");
				boxpad.addClass("fixed");
				} else {
				box.removeClass("fixed");
				boxpad.removeClass("fixed");
			}
		});
	}

	//ページトップなめらかスクロール
  $(window).scroll(function(){
  	if ($(this).scrollTop() > 120) {
    	$("#pagetop_btn").fadeIn();
		}
    else {
    	$("#pagetop_btn").fadeOut();
		}
  });
  $("#pagetop_btn").click(function(){
    $("html,body").animate({
    	scrollTop: 0
    }, 300);
    return false;
  });
*/
//Promolayer
$temp_java .= '<!-- start Promolayer JS code-->
<script type="module" src="https://modules.promolayer.io/index.js" data-pluid="z8hsh4Gf3jZDTv5WX9uyqn1JdvO2" data-workspace="aDuOQM5TfZJUmgcFeYKR" crossorigin async></script>
<!-- end Promolayer JS code-->' . chr(10);

//サンクスページ判定(DUP資料請求のページは除外)
switch (true) {
	case ($_GET['send'] == 'complete'):
		if ($p_title != 'DUP資料請求') {
			$temp_java .= '<script src="https://synalio.com/analytics/js/b498413f9f784d33a1288fe69433f063/" type="text/javascript"></script>';
		}
		break;
}
/*
$temp_satoritag_thanks='<script type="text/javascript" id="_-s-js-_" src="//satori.segs.jp/s.js?c=3a5a998e"></script>'.chr(10);
*/
$temp_satoritag_thanks = '';


//◆スライダーJAVA
$temp_java_slidemenu = "<script>
$(window).load(function(){
	//スライドメニュー処理
	
	var touch=false;
	var time_cnt=0;
	
	//初期化
	$('.slide_box ul').each(function(i,val){
		$(this).css('width',$(this).find('li:first-child').width()*$(this).find('li').length);
		$(this).attr('move',0);
	});
	
	//ループ対応
	$('.slide_box ul.loop').each(function(i,val){
		var slidelen=($(this).find('li').length)/3;
		$(this).css('left',-(slidelen*$(this).find('li:first-child').width()));
		$(this).attr('move',-(slidelen));
	});	
	
	//ボタン操作
	$('.slide_box .btn_prev').click(function(){
		SLIDE_PREV($('.slide_box .btn_prev'));
  });
	$('.slide_box .btn_next').click(function(){
		SLIDE_NEXT($('.slide_box .btn_next'));
	});
	
	//フリック操作
	$('.slide_box ul.loop').on({
		'touchstart': function(e) {
			this.touchX = event.changedTouches[0].pageX;
			this.slideX = $(this).position().left;
			startX = this.touchX;
			touch=true;
		},
		'touchmove': function(e) {
			e.preventDefault();
			this.slideX = this.slideX - (this.touchX - event.changedTouches[0].pageX );
			$(this).css({left:this.slideX});
			this.accel = (event.changedTouches[0].pageX - this.touchX) * 5;
			this.touchX = event.changedTouches[0].pageX;
			moveX = this.touchX;
		},
		'touchend': function(e) {
			width=$(this).find('li:first-child').width();
			if(startX>moveX){
				this.slideX=Math.floor(this.slideX/width)*width;
			}
			else{
				this.slideX=Math.ceil(this.slideX/width)*width;
			}
			$(this).animate({left:this.slideX},500,'swing',function(){
				$(this).queue([]);
				$(this).stop();
				$(this).attr('move',Math.floor(this.slideX/width));
				slidelen=($(this).find('li').length)/3;
				if ($(this).attr('move')>(-slidelen)){
					$(this).css('left','-='+(width*slidelen));
					$(this).attr('move','-='+slidelen);
				}
				else if ($(this).attr('move')<(-slidelen*2)){
					$(this).css('left','+='+(width*slidelen));
					$(this).attr('move','+='+slidelen);
				}
			});
			touch=false;
		}
	});
	
	//ドラッグ操作
	$('.slide_box ul.loop').mousedown(function(e){
		this.touchX = event.pageX;
		this.slideX = $(this).position().left;
		startX = this.touchX;
		touch=true;
		$('.slide_box ul.loop').mousemove(function(e){
			e.preventDefault();
			this.slideX = this.slideX - (this.touchX - event.pageX );
			$(this).css({left:this.slideX});
			this.touchX = event.pageX;
			moveX = this.touchX;
		});
	}).mouseup(function(e){
		width=$(this).find('li:first-child').width();
		if(startX>moveX){
			this.slideX=Math.floor(this.slideX/width)*width;
		}
		else{
			this.slideX=Math.ceil(this.slideX/width)*width;
		}
		$(this).animate({left:this.slideX},500,'swing',function(){
			$(this).queue([]);
			$(this).stop();
			$(this).attr('move',Math.floor(this.slideX/width));
			slidelen=($(this).find('li').length)/3;
			if ($(this).attr('move')>(-slidelen)){
				$(this).css('left','-='+(width*slidelen));
				$(this).attr('move','-='+slidelen);
			}
			else if ($(this).attr('move')<(-slidelen*2)){
				$(this).css('left','+='+(width*slidelen));
				$(this).attr('move','+='+slidelen);
			}
		});
		$(this).off('mousemove');
		touch=false;
	});
	
	//自動ループ
	setInterval(function(){
		if((time_cnt>=50)&&(!touch)){
			SLIDE_NEXT($('.slide_box .btn_next'));
			time_cnt=0;
		}
		else if(!touch){time_cnt++;}
		else{	time_cnt=0;}
	},100);
	
});

function SLIDE_PREV(obj){
	slidemenu=obj.parent().parent().find('.menu');
	mov=slidemenu.find('li:first-child').width();
	frame_side=slidemenu.offset().left;
	slide_side=slidemenu.find('ul').offset().left;
	anime=false;//アニメ実行フラグ
	for(i=obj.attr('move');i>0;i--){
		if(frame_side>=slide_side+(mov*i)){
			anime=true;
			break;
		}
	}
	if(anime){
		touch=true;
		time_cnt=0;
		slidefix=Math.floor(slidemenu.find('ul').offset().left/mov);
		slidefix=slidefix*mov;
		slidefix=parseInt(slidemenu.find('ul').css('left'))-slidefix;
		slidemenu.find('ul').animate({'left':'+='+((mov*i)-slidefix)+'px'},500,'swing',function(){
			$(this).queue([]);
			$(this).stop();
			slidemov=parseInt(slidemenu.find('ul').css('left'))/mov;
			if(slidemenu.find('ul').hasClass('loop')){
				var slidelen=(slidemenu.find('ul').find('li').length)/3;
				if(slidemov>(-slidelen)){
					slidemenu.find('ul').css('left','-='+(mov*slidelen));
				}
			}
			slidemenu.find('ul').attr('move',slidemov);
		});
		touch=false;
	}
}
function SLIDE_NEXT(obj){
	slidemenu=obj.parent().parent().find('.menu');
	mov=slidemenu.find('li:first-child').width();
	frame_side=slidemenu.offset().left+slidemenu.width();
	slide_side=slidemenu.find('ul').offset().left+slidemenu.find('ul').width();
	anime=false;//アニメ実行フラグ
	for(i=obj.attr('move');i>0;i--){
		if(frame_side<=slide_side-(mov*i)){
			anime=true;
			break;
		}
	}
	if(anime){
		touch=true;
		time_cnt=0;
		slidefix=Math.floor(slidemenu.find('ul').offset().left/mov);
		slidefix=slidefix*mov;
		slidefix=parseInt(slidemenu.find('ul').css('left'))-slidefix;
		slidemenu.find('ul').animate({'left':'-='+((mov*i)+slidefix)+'px'},500,'swing',function(){
			$(this).queue([]);
			$(this).stop();
			slidemov=parseInt(slidemenu.find('ul').css('left'))/mov;
			if(slidemenu.find('ul').hasClass('loop')){
				var slidelen=(slidemenu.find('ul').find('li').length)/3;
				if(slidemov<(-slidelen)){
					slidemenu.find('ul').css('left','+='+(mov*slidelen));
				}
			}
			slidemenu.find('ul').attr('move',slidemov);
		});
		touch=false;
	}
}
</script>" . chr(10);
/*
<script>
$(window).load(function(){
	//スライドメニュー処理
	
	//初期化
	$('.slide_box ul').each(function(i,val){
		$(this).css('width',$(this).find('li:first-child').width()*$(this).find('li').length);
		$(this).attr('move',0);
	});
	
	//ループ対応
	$('.slide_box ul.loop').each(function(i,val){
		var slidelen=($(this).find('li').length)/3;
		$(this).css('left',-(slidelen*$(this).find('li:first-child').width()));
		$(this).attr('move',-(slidelen));
	});	
	
	$('.slide_box .btn_prev').click(function(){
		SLIDE_PREV($('.slide_box .btn_prev'));
  });
	$('.slide_box .btn_next').click(function(){
		SLIDE_NEXT($('.slide_box .btn_next'));
	});	
	setInterval(function(){
		SLIDE_NEXT($('.slide_box .btn_next'));
	},5000);
	
});

function SLIDE_PREV(obj){
	slidemenu=obj.parent().parent().find('.menu');
	mov=slidemenu.find('li:first-child').width();
	frame_side=slidemenu.offset().left;
	slide_side=slidemenu.find('ul').offset().left;
	anime=false;//アニメ実行フラグ
	for(i=obj.attr('move');i>0;i--){
		if(frame_side>=slide_side+(mov*i)){
			anime=true;
			break;
		}
	}
	if(anime){
		slidemenu.find('ul').animate({'left':'+='+(mov*i)+'px'},500,'swing',function(){
			$(this).queue([]);
			$(this).stop();
			slidemov=parseInt(slidemenu.find('ul').css('left'))/mov;
			if(slidemenu.find('ul').hasClass('loop')){
				var slidelen=(slidemenu.find('ul').find('li').length)/3;
				if(slidemov>(-slidelen)){
					slidemenu.find('ul').css('left','-='+(mov*slidelen));
				}
			}
			slidemenu.find('ul').attr('move',slidemov);
		});
	}
}
function SLIDE_NEXT(obj){
	slidemenu=obj.parent().parent().find('.menu');
	mov=slidemenu.find('li:first-child').width();
	frame_side=slidemenu.offset().left+slidemenu.width();
	slide_side=slidemenu.find('ul').offset().left+slidemenu.find('ul').width();
	anime=false;//アニメ実行フラグ
	for(i=obj.attr('move');i>0;i--){
		if(frame_side<=slide_side-(mov*i)){
			anime=true;
			break;
		}
	}
	if(anime){
		slidemenu.find('ul').animate({'left':'-='+(mov*i)+'px'},500,'swing',function(){
			$(this).queue([]);
			$(this).stop();
			slidemov=parseInt(slidemenu.find('ul').css('left'))/mov;
			if(slidemenu.find('ul').hasClass('loop')){
				var slidelen=(slidemenu.find('ul').find('li').length)/3;
				if(slidemov<(-slidelen)){
					slidemenu.find('ul').css('left','+='+(mov*slidelen));
				}
			}
			slidemenu.find('ul').attr('move',slidemov);
		});
	}
}
</script>
*/


//◆ページトップ
$temp_pagetop = '<!-- Google Tag Manager (noscript) -->
<noscript><iframe
src="https://www.googletagmanager.com/ns.html?id=GTM-KS4HCFR"
height="0" width="0"
style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
src="https://www.googletagmanager.com/ns.html?id=GTM-NWHSSFS"
height="0" width="0"
style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<a name="pt" id="pt"></a>' . chr(10);

//◆ヘッダ
switch ($p_type) {
	case 'index':
	case 'news':
	case 'merit':
	case 'voice':
	case 'qa':
		$add = ' class="flag1 flag2"'; //ヘッダの初期状態を透明に
		break;
	default:
		$add = '';
}
$flag_header = false;
if (!empty($_GET['test'])) {
	if ($_GET['test'] == 'ok') {
		$flag_header = true;
	}
}
$temp_header = '<div id="header"' . $add . '>
<div class="Wmax1300 H_head pos_rel">
<a href="' . $link_list['TOP'] . '" class="dpIB logo bg_cover"><h1><img src="' . $kaisou . 'images/common/logo-head.png" alt="' . $temp_h1 . '"></h1></a>
<div class="menubtn"><div class="bg_cover"><img src="' . $kaisou . 'images/common/clear-menubtn.png"></div></div>
<ul class="h_menu font_meiryo LS0_1em">
<li class="pc_vanish"><a href="' . $link_list['TOP'] . '">ホーム</a>' ./*<div class="closebtn bg_cover"><img src="'.$kaisou.'images/common/closebtn.png"></div>*/ '</li>
<li><a href="' . $link_list['物件情報'] . '">物件情報</a></li>
<li><a href="' . $link_list['コンセプト'] . '">コンセプト</a></li>
<li><a href="' . $link_list['特長'] . '">特長</a></li>
<li><a href="' . $link_list['安さの秘密'] . '">安さのヒミツ</a></li>
<li><a href="' . $link_list['お客様の声'] . '">お客様の声</a></li>
<li class="pc_vanish"><a href="' . $link_list['開発ストーリー'] . '">開発ストーリー</a></li>
<li><a href="' . $link_list['Q&A'] . '">Q&A</a></li>
<li><a href="' . $link_list['コンセプト-0x'] . '">コラム</a></li>
<li class="pc_vanish"><a href="' . $link_list['ギャラリー'] . '">ギャラリー</a></li>
<li class="pc_vanish"><a href="' . $link_list['DUP会員登録'] . '">DUP会員登録</a></li>
<li class="pc_vanish"><a href="' . $link_list['お問い合わせ'] . '">お問い合わせ</a></li>
<div class="clear"></div>
</ul>
<div class="clear"></div>
<div class="formbtn font_meiryo pc_vanish borderbox"><a href="' . $link_list['物件情報'] . '" class="btninfo"><div class="btntext">物件情報</div>' ./*<img src="'.$kaisou.'images/common/btn-form3-sp.png">*/ '</a><a href="' . $link_list['お問い合わせ'] . '" style="background-color:#004024;"><div class="btntext H2em">ご来場予約・<br>お問い合わせ</div>' ./*<img src="'.$kaisou.'images/common/btn-form1-sp.png">*/ '</a><a href="' . $link_list['DUP会員登録'] . '" style="background-color:#CA9E68;"><div class="btntext">DUP会員登録</div>' ./*<img src="'.$kaisou.'images/common/btn-form2-sp.png">*/ '</a></div>
</div>
</div>
<div class="formbtn sp_vanish"><a href="' . $link_list['物件情報'] . '"><img src="' . $kaisou . 'images/common/btn-form3.png"></a><a href="' . $link_list['お問い合わせ'] . '"><img src="' . $kaisou . 'images/common/btn-form1.png"></a><a href="' . $link_list['DUP会員登録'] . '"><img src="' . $kaisou . 'images/common/btn-form2.png"></a><a href="#pt"><img src="' . $kaisou . 'images/common/btn-form-pt.png"></a></div>' . chr(10);
/*
'./($flag_header?'':'<li><a href="'.$link_list['NEWS'].'">NEWS</a></li>')./'
'./<li><a href="'.$link_list['3Dモデルハウス'].'">3Dモデルハウス</a></li>/'
<li><a href="'.$link_list['見学するには'].'">見学するには</a></li>
*/


//◆フッタ
function FOOTER_MENU()
{
	global $link_list/*,$flag_header*/;

	$link_arr = array(
		'TOP',
		'NEWS',
		'物件情報',
		'コンセプト',
		'特長',
		'見学するには',
		'お客様の声',
		'開発ストーリー',
		'Q&A',
		''/* ,'ギャラリー' */,
		'コンセプト-0x',
		'DUP会員登録',
		'お問い合わせ'
	);
	/*
	if($flag_header){
	}
	else{
	$link_arr=array
	('TOP','NEWS','物件情報','コンセプト'
	,'特長','見学するには','お客様の声','開発ストーリー'
	,'Q&A','ショールーム','DUP会員登録','お問い合わせ');
	}
	*/
	$text_arr = $link_arr; //配列コピー
	$text_arr[0] = 'ホーム'; //TOPだけホームに表記変更
	$text_arr[10] = 'コラム';
	/*
	if($flag_header){		
	}
	*/

	$max = count($link_arr);

	$divmax = ceil($max / 3); //PC
	$str = '<table border="0" cellpadding="0" cellspacing="0" class="sp_vanish"><tr>';
	for ($i = 0; $i < $max; $i += $divmax) {
		$str .= '<td>';
		for ($j = 0; $j < $divmax; $j++) {
			if (!empty($link_list[$link_arr[($i + $j)]])) {

				$str .= '<div><a href="' . $link_list[$link_arr[($i + $j)]] . '">・' . $text_arr[($i + $j)] . '</a></div>' . chr(10);
			}
		}
		$str .= '</td>' . chr(10);
	}
	$str .= '</tr></table>' . chr(10);

	$divmax = ceil($max / 2); //スマホ
	$str .= '<table border="0" cellpadding="0" cellspacing="0" class="pc_vanish"><tr>';
	for ($i = 0; $i < $max; $i += $divmax) {
		$str .= '<td>';
		for ($j = 0; $j < $divmax; $j++) {
			if (!empty($link_list[$link_arr[($i + $j)]])) {
				$str .= '<div><a href="' . $link_list[$link_arr[($i + $j)]] . '">・' . $text_arr[($i + $j)] . '</a></div>' . chr(10);
			}
		}
		$str .= '</td>' . chr(10);
	}
	$str .= '</tr></table>';

	return $str;
}
$temp_footer = '<div id="footer"><div class="Wmax1000 borderbox mgnLR25">
<div class="set1">
<a href="' . $link_list['TOP'] . '"><img src="' . $kaisou . 'images/common/logo-foot.png" class="logo"></a>
<a href="tel:' . $dup_data['TEL'] . '"><img src="' . $kaisou . 'images/common/tel-foot.png" class="tel"></a>
<div class="clear"></div>
</div>
<div class="set2 font_meiryo" style="font-size:90%;">
' . FOOTER_MENU() . '
</div>
<div class="clear" style="height:50px; border-bottom:solid 1px rgba(255,255,255,0.5); margin-bottom:30px;"></div>
<table border="0" cellpadding="0" cellspacing="0" class="set3"><tr>
<td align="left"><a href="' . $link_list['東新住建本社'] . '"><img src="' . $kaisou . 'images/common/toushin-foot.png" class="toushin"></a></td>
<td align="right"><div class="dpIB textL fontP060 sp_fontP050">〒492-8628<br>
愛知県稲沢市高御堂1-3-18<br>
' . $dup_data['建築許可番号'][0] . '<br>
' . $dup_data['建築許可番号'][1] . '<br>
' . $dup_data['建築許可番号'][2] . '</div></td>
</tr></table>
</div></div>
<div class="copy">' . $dup_data['copyright'] . '</div>' . chr(10);
/*
宅地建物取引業免許：国土交通大臣（3）第7873号<br>
建設業許可：愛知県知事許可（特-29）第61271号<br>
（社）愛知県宅地建物取引業協会会員
*/
switch ($p_title) {
	case 'お問い合わせ':
	case 'DUP会員登録':
		break;
	default:
		$arr = array(
			'hatsuden.jpg'	=> 'https://www.toshinjyuken.co.jp/hatsuden-shelter-house/',
			'hiraya.jpg'		=> 'https://www.toshinjyuken.co.jp/hiraya/',
			'teishaku.jpg'	=> 'https://www.toshinjyuken.co.jp/teishaku-portal/',
			'sodatsu.jpg'	=> 'https://www.toshinjyuken.co.jp/sodatsu/',
			'ie.jpg'				=> 'https://www.toshinjyuken.co.jp/kodate/',
			'alc.jpg'			=> 'https://www.toshinjyuken.co.jp/new-concrete-log-house/'
		);
		$bnr = '';
		foreach ($arr as $k => $v) {
			$bnr .= '<a href="' . $v . $t_blank . '" rel="noopener noreferrer"><img src="' . $kaisou . 'images/common/bottom/bnr-' . $k . '"></a>';
		}
		$temp_footer = '<div class="Wmax1200 borderbox mgnLR25 bottom_bnr">
' . $bnr . '
</div>' . chr(10) . $temp_footer;
}


//◆グーグルマップJSファイル読み込み
$key = 'AIzaSyCgpx6SwbLW26U2VmiC8jfmObdqvy8UE-Y';
$temp_googlemap_js = '<script src="' . $kaisou . 'js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=' . $key . '&callback=initMap"></script>' . chr(10);


//◆body末尾
//チャットボットタグ（グーグルマップJSファイルの後＝</body>の直前）
/*
$temp_bodyend=''.chr(10);
//とりあえずグーグルマップの後ろに設置
$temp_googlemap_js.=$temp_bodyend;
*/


//◆ログインボックス　※ログインしていない時に出現
if (!isset($_SESSION['member'])) {
	$temp_loginbox = '<!-- login -->
<script>
$(window).load(function(){
	$(".login_box .bg_white").hover(
    function(){login_box_out=false;},
    function(){login_box_out=true;}
  );
	$(".login_window").click(function(){
		$(".login_box").fadeIn();
		$(".login_box form").prop("action",$(this).attr("href"));
	});
	$(".login_box").click(function(){
		if(login_box_out){$(".login_box").fadeOut();}
  });
	$(".login_box .closebtn").click(function(){
		$(".login_box").fadeOut();
	});
});
</script>
<div class="login_box">
<div class="bg_white radius10 font_meiryo">
<img src="' . $kaisou . 'images/common/closebtn-k.png" class="dpB closebtn">
<div class="part_top">
<img src="' . $kaisou . 'images/common/icon-members_only.png" class="dpB icon_members_only">
<div class="LH175 fontP120 col_green login_text">こちらは<strong>DUP会員限定ページ</strong>となります。<br>ログインID、パスワードをご入力ください。</div>
<form action="" method="post" class="mgnAuto borderbox">
<table border="0" cellpadding="0" cellspacing="0" class="W100per fontP120"><tr>
<td style="width:6em;">ログインID</td>
<td><input type="text" name="login_id" class="W100per LH150"></td>
</tr><tr>
<td>パスワード</td>
<td><input type="text" name="login_pw" class="W100per LH150"></td>
</tr></table>
<input type="hidden" name="login_check" value="on">
<div class="textC mgnT0_5em"><input class="login_btn" type="submit" name="login" value="ログイン"></div>
</form>
</div>

<div class="bg_greenD mem_comment borderbox mgnAuto radius10">
<div class="LH175 lb_text" style="font-size:105%;">
ログインID、パスワードをお持ちでない方は、DUPレジデンス会員登録をしていただきますと、<strong>新着物件</strong>を<strong>優先的</strong>にご案内させていただいたり、<strong>会員様限定ページ</strong>をご覧いただくことができます。完全無料でご利用いただけますので、ぜひご登録ください。</div>
<a href="' . $link_list['DUP会員登録'] . '" class="font_meiryo font_bold textC">DUP会員登録はこちらから</a></div>

<div class="clear"></div>
</div>
</div>
<!-- login -->' . chr(10);
} else {
	$temp_loginbox = '';
}

//◆関数
function PAN($data)
{
	global $link_list;
	global $notation_list;

	$arrow = '<span>&gt;</span>';

	$link = '<a href="' . $link_list['TOP'] . '">HOME</a>';
	for ($i = 0; $i < count($data) - 1; $i++) {
		//一部のキーワードに専用の記述
		switch ($data[$i]) {
			/*
			case '***':
			$link.=$arrow.$notation_list[$data[$i]]['en'];
			break;
			*/
			case '物件情報':
				$link .= $arrow . '<a href="' . $link_list[$data[$i]] . '">' . $notation_list[$data[$i]]['en'] . '<div class="dpIB fontP090">（物件一覧）</div></a>';
				break;
			case 'DUP資料請求':
				$link .= $arrow . '<a href="' . $link_list[$data[$i]] . '">' . $data[$i] . '</a>';
				break;
			default:
				$link .= $arrow . '<a href="' . $link_list[$data[$i]] . '">' . $notation_list[$data[$i]]['en'] . '</a>';
		}
	}
	$link .= $arrow . (($notation_list[$data[$i]]['en'] != '') ? $notation_list[$data[$i]]['en'] : $data[$i]) . (($data[$i] == '物件情報') ? '<div class="dpIB fontP090">（物件一覧）</div>' : ''); //最後はリンクなし
	$str = '<div class="pan Wmax1300 fontP075 font_meiryo"><div class="box">' . $link . '</div></div>' . chr(10);
	return $str;
}

function PAGE_TITLE($key, $jp1 = '', $jp2 = '', $tag = 'h2', $lh = 'LH100', $style = '')
{
	global $notation_list;
	$str = '<' . $tag . ' class="p_title ' . $lh . '" ' . $style . '>';
	if ($key != '') {
		$str .= '<span class="LS0_1em">' . $notation_list[$key]['en'] . '</span><div class="mini font_meiryo">' . (($jp1 != '') ? $jp1 : $notation_list[$key]['jp']) . '</div>';
	} else {
		$str .= '<span class="LS0_1em">' . $jp1 . '</span>' . (($jp2 != '') ? '<div class="mini font_meiryo">' . $jp2 . '</div>' : '');
	}
	$str .= '</' . $tag . '>' . chr(10);
	return $str;
}

function PAGE_PHOTOTITLE($img, $h)
{
	global $p_type;
	global $p_title;
	global $kaisou;
	/*
	switch($p_type){
		case 'news':
		$adjust=112;
		break;
		default:$adjust=0;
	}
	$adjust=0;
	*/
	/*
	<script>
$(window).load(function(){
	$(".h_photo").css("background-position","center "+($(this).scrollTop())+"px");
	$(window).scroll(function(){
		$(".h_photo").css("background-position","center "+($(this).scrollTop())+"px");
  });
});
</script>
	*/
	echo '<div class="h_photo" style="background-image:url(' . $kaisou . 'images/content/' . $img . '/photo-head.jpg);" ><div class="dark"><div class="pos_rel" style="height:' . ($h - 75) . 'px;">' . chr(10);
	echo PAN(array($p_title));
	echo PAGE_TITLE($p_title);
	echo '</div></div></div>
<div id="h_colorborder"></div>' . chr(10);
}

function SPAN_IB($str)
{
	/*
			必ず「span_dpIB」クラス要素内に関数を入れること。
			
			例：<div class="span_dpIB"><?php echo SPAN_IB('＊＊＊＊＊'); ?></div>
	*/
	$str = str_replace(array("<br>\r\n", "<br>\n", "<br>\r"), '</span><br><span>', $str);
	$str = str_replace(array("\r\n", "\n", "\r"), '</span><span>', $str);
	return '<span>' . $str . '</span>';
}

function BTN_OVAL($link = '', $text = '', $style = '', $class = '', $prm = array())
{
	global $link_list;
	if ($link != '') {
		$href = ' href="' . (isset($link_list[$link]) ? $link_list[$link] : $link) . (isset($prm['link_add']) ? $prm['link_add'] : '') . '"';
	} else {
		$href = '';
	}

	$def_class = 'radius50 fontP130 font_meiryo LH100 padTB0_5em Wmax100per borderbox btn_oval ';
	if (strpos($class, 'font_min') !== false) {
		$def_class = str_replace(array("font_meiryo "), '', $def_class);
	}

	return '<a' . $href . ' class="' . $def_class . $class . '" style="' . $style . '">' . (($text != '') ? $text : $link) . '</a>';
}

function WORD_BR($str)
{
	return str_replace(array("\r\n", "\n", "\r"), '<br>', $str);
}
function IMG_TAG($url, $class = '', $style = '')
{
	return '<img src="' . $url . '" class="' . $class . '" style="' . $style . '">' . chr(10);
}
function LINK_TAG($url, $prm = array())
{
	global $link_list;
	$str = ($prm['text'] != '') ? $prm['text'] : $url;
	$class = ($prm['class'] != '') ? ' class="' . $prm['class'] . '"' : '';
	switch ($prm['type']) {
		case 'mail':
			$type = 'mailto:';
			break;
		case 'tel':
			$type = 'tel:';
			break;
		default:
			$type = '';
			if (!empty($link_list[$url])) {
				//キー指定が有効ならそれが優先される
				$url = $link_list[$url];
			}
	}
	return '<a href="' . $type . $url . '"' . $class . '>' . $str . '</a>';
}
function ANCHOR($name, $prm = array())
{
	$anc = $class = '';
	if ($prm['anc'] != '') {
		$anc = $prm['anc'];
	}
	if ($prm['class'] != '') {
		$class = ' ' . $prm['class'];
	}
	if (is_numeric($name)) {
		$name = 'sec' . sprintf('%02d', $name);
	} //数値のみなら2ケタにする
	return '<div class="pos_rel"><a class="anchor' . $class . '" id="' . $anc . $name . '" name="' . $anc . $name . '"></a></div>' . chr(10);
}
function MAINPIC($dir, $prm = array())
{
	global $kaisou;
	$res = '';
	$imgarr = array();
	if (!empty($prm['mainpic'])) {
		$imgarr = explode('.', $prm['mainpic']);
	} else {
		$imgarr[0] = 'mainpic';
		$imgarr[1] = 'jpg';
	}
	if (!empty($prm['class'])) {
		$class = $prm['class'];
	} else {
		$class = 'W100per';
	}
	$mainpic	= $dir . $imgarr[0] . '.' . $imgarr[1];
	$clearpic	= $kaisou . 'images/common/clear';
	$alt = ($prm['alt'] != '') ? ' alt="' . $prm['alt'] . '"' : '';

	if (!empty($prm['clear'])) { //透明画像によるトリミング
		$img = 'url(' . $mainpic . ')';
		if (file_exists($url = ($dir . $imgarr[0] . '-t.png'))) {
			$img = 'url(' . $url . '),' . $img;
		}
		if (file_exists($url = ($clearpic . '-' . $prm['clear'] . '.png'))) {
			$clearpic = $url;
		} else {
			$clearpic .= '.png';
		}
		$res = '<img src="' . $clearpic . '" class="' . $class . '" style="background-image:' . $img . '"' . $alt . '>';
	} else { //静止画（２倍サイズの画像を半分に縮小可能
		$style = array();
		list($w, $h) = getimagesize($mainpic);
		switch (true) {
			case ($prm['w_half']):
			case ($prm['w_half_pc']):
				$style['pc'] = ' style="width:' . ($w / 2) . 'px;"';
				break;
			case ($prm['h_half']):
			case ($prm['h_half_pc']):
				$style['pc'] = ' style="height:' . ($h / 2) . 'px;"';
				break;
			case ($prm['wh_half']):
			case ($prm['wh_half_pc']):
				$style['pc'] = ' style="width:' . ($w / 2) . 'px;height:' . ($h / 2) . 'px;"';
				break;
		}
		if (file_exists($url = ($dir . $imgarr[0] . '-sp.' . $imgarr[1]))) {
			list($w, $h) = getimagesize($url);
			switch (true) {
				case ($prm['w_half']):
				case ($prm['w_half_sp']):
					$style['sp'] = ' style="width:' . ($w / 2) . 'px;"';
					break;
				case ($prm['h_half']):
				case ($prm['h_half_sp']):
					$style['sp'] = ' style="height:' . ($h / 2) . 'px;"';
					break;
				case ($prm['wh_half']):
				case ($prm['wh_half_sp']):
					$style['sp'] = ' style="width:' . ($w / 2) . 'px;height:' . ($h / 2) . 'px;"';
					break;
			}
			$res = '<img src="' . $mainpic . '" class="' . $class . ' sp_vanish"' . $style['pc'] . $alt . '>
<img src="' . $url . '" class="' . $class . ' pc_vanish"' . $style['sp'] . $alt . '>';
		} else {
			$res = '<img src="' . $mainpic . '" class="' . $class . '"' . $style['pc'] . $alt . '>';
		}
	}
	return $res . chr(10);
}

function THANKS_ADD_YOYAKU()
{
	global $kaisou;
	$res = '<div class="sp_textL sp_br_del LH150" style="margin-top:1.5em;">' . WORD_BR('※DUP レジデンスではお客様に安心してご見学いただくために、ウイルスの感染予防対策として
	事前消毒や換気を徹底し、使い捨て手袋をご用意しております。'/*'ご来場予約をいただいたお客様には、ご見学の案内状と、
<b style="font-size:125%;">withコロナ 見学キット</b>(使い捨てスリッパ、使い捨て手袋)を、
ご来場予定日の前日までにポストへお届けいたします。'*/) . '</div>
<!--<img class="mgnAuto" src="' . $kaisou . 'images/common/other/20200427corona.svg" style="width: 24em; margin-top:1em;">-->
<!--<div style="padding-top:1em;">※ご来場の方人数分をご用意しております。</div>-->
<div style="padding-top:100px;">
<h3 class="col_green fontP200 LH150 font_meiryo" style="margin-bottom:1.5em;">事前アンケートにご協力ください。</h3>
<div class="fontP150 LH150 padLR20 textC dpIB">
' . WORD_BR('よろしければ、追加の事前アンケートにお進みください。
よりスムーズなご案内と、より有益なご提案をご提供いたします。
ご協力いただいたお客様に、QUOカード1,000円分を
現地でプレゼントしています。') . '
<div class="textC" style="margin-top:2em;">
' . BTN_OVAL('ご見学前アンケート', 'ご見学前アンケートページへ', 'width:auto; font-size:100%; padding:0.25em 1em;', 'colorW font_bold') . '</div>
</div></div>' . chr(10);
	return $res;
}

function TOP_BNR($link, $bnr, $w, $prm = array())
{
	$nowdate = date('Ymd');
	$nowdateH = date('YmdH');
	$nowdateHi = date('YmdHi'); //時分まで指定

	$str = '';
	$flag = true;
	//終わりが設定されている？（現在日時>=終了日時で終了）
	if (!empty($prm['e'])) {
		if (date($prm['e-type']) >= $prm['e']) {
			$flag = false;
		}
	}
	//始まりが設定されている？
	if (($flag) && (!empty($prm['s']))) {
		if (date($prm['s-type']) < $prm['s']) {
			$flag = false;
		}
	}
	if ($flag) {
		if ($prm['wrap'] == 'contrast') {
			$str = '<div class="btn_bukken2022 bnrbox"><a href="' . $link . '"><img src="' . TOP_BNR_DIR($bnr) . '"></a></div>';
		} else {
			$str = '<a href="' . $link . '" class="dpIB"><img src="' . TOP_BNR_DIR($bnr) . '" class="W100per" style="max-width:' . $w . 'px;"></a>';
			if (!empty($prm['wrap'])) {
				$str = '<' . $prm['wrap'] . '>' . $str . '</' . $prm['wrap'] . '>';
			}
		}
		if (!empty($prm['div'])) {
			$str .= '<div></div>';
		}
	}
	return $str;
}
function TOP_BNR_DIR($dir)
{
	$res = 'images/top/bnr/';
	if (strpos($dir, 'images/') !== false) {
		$res = '';
	}
	return $res . $dir;
}
function TOP_BNR_SET2022($k, $w, $add = array())
{
	global $toushin_bnr_dup_arr, $t_blank;
	$a = array();
	if (isset($toushin_bnr_dup_arr[$k]['s'])) {
		$a['s'] = $toushin_bnr_dup_arr[$k]['s'];
		$a['s-type'] = $toushin_bnr_dup_arr[$k]['date'];
	}
	if (isset($toushin_bnr_dup_arr[$k]['e'])) {
		$a['e'] = $toushin_bnr_dup_arr[$k]['e'];
		$a['e-type'] = $toushin_bnr_dup_arr[$k]['date'];
	}
	if (count($add) > 0) {
		$a += $add;
	}
	return TOP_BNR($toushin_bnr_dup_arr[$k]['url'] . $t_blank, $toushin_bnr_dup_arr[$k]['bnr' . $w], 500, $a);
}
