<?php
$p_type = 'content';
$p_title = '中古マンションとの比較';
$kaisou = '';
require $kaisou . "temp_php/basic.php";

//オープンフラグ・デモフラグ
$page_open = true;
/*
if($_GET['demo']!='ok'){
	$page_open=false;
}
*/

$dir = $kaisou . 'images/content/contrast/';
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<?php echo $temp_meta; ?>
	<title><?php echo $temp_title; ?></title>
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<?php echo $temp_java; ?>
	<style>
		hr.local_mgn {
			margin: 3.25em auto;
		}

		.pan {
			margin-bottom: 50px;
		}

		.maintitle3 {
			margin-bottom: 3em;
		}

		.maintitle1 img {
			max-width: 806px;
			margin: auto;
		}

		.maintitle3 img {
			max-width: 796px;
			margin: auto;
		}

		.maintitle4 {
			width: 12em;
			margin: auto;
			border-bottom: dashed 1px #000;
			padding-bottom: 0.33em;
			text-align: center;
			font-weight: bold;
		}

		@media screen and (min-width: 800px) {
			.maintitle1 {
				margin-bottom: 2.75em;
				padding-bottom: 2.75em;
			}

			.maintitle3 {
				margin-top: 2.5em;
			}
		}

		@media screen and (max-width: 799px) {
			.maintitle1 {
				margin-bottom: 2em;
				padding-bottom: 2em;
			}

			.maintitle3 {
				margin-top: 1em;
			}

			.maintitle1 img {
				max-width: 80%;
			}

			.maintitle3 img {
				max-width: 100%;
			}
		}

		.bg_kokogachigau {
			background-image: url(images/content/contrast/bg-kokogachigau.png);
			background-repeat: repeat;
			background-position: center top;
			padding: 2em 25px;
			margin-top: 3.75em;
			margin-bottom: 3.75em;
		}

		.bg_kokogachigau table {}

		.bg_kokogachigau table tr>* {
			vertical-align: middle;
			text-align: left;
		}

		.bg_kokogachigau table tr>*:nth-child(1) {
			width: 7.5em;
		}

		.bg_kokogachigau table tr>*:nth-child(1) img {
			width: 100%;
		}

		.bg_kokogachigau table tr>*:nth-child(2) {
			padding-left: 1.33em;
			font-size: 187.5%;
			line-height: 150%;
		}

		.box_iitokoro {}

		.box_iitokoro li:nth-child(2n+2) img {
			margin: auto;
		}

		.box_iitokoro .iitoko_num {}

		.box_iitokoro .iitoko_num tr>* {
			text-align: center;
			vertical-align: middle;
		}

		.box_iitokoro .iitoko_num tr>*:nth-child(2) {
			padding-left: 1em;
		}

		.box_iitokoro .iitoko_num tr>* div {
			border-top: solid 1px #004021;
			border-bottom: solid 1px #004021;
			padding: 0.66em 0;
			font-size: 90%;
			font-weight: bold;
			line-height: 100%;
		}

		.box_iitokoro .iitoko_num tr>* img {
			height: 4.5em;
		}

		.box_iitokoro .kouhou {}

		.box_iitokoro .kouhou tr>* {
			text-align: left;
			vertical-align: middle;
		}

		@media screen and (min-width: 800px) {
			.box_iitokoro li {
				width: 48%;
			}

			.box_iitokoro li:nth-child(2n+1) {
				float: left;
				clear: both;
			}

			.box_iitokoro li:nth-child(2n+2) {
				float: right;
			}

			.box_iitokoro li:nth-child(n+3) {
				margin-top: 4em;
			}

			.box_iitokoro .kouhou tr>*:nth-child(1) {
				padding-bottom: 1em;
			}
		}

		@media screen and (max-width: 799px) {
			.box_iitokoro li:nth-child(2n+2) {
				margin-top: 2em;
			}

			.box_iitokoro li:nth-child(2n+3) {
				margin-top: 4em;
			}

			.box_iitokoro li:nth-child(2n+2) img {
				width: 80% !important;
			}

			.box_iitokoro .iitoko_num {
				margin: auto;
			}

			.box_iitokoro .kouhou tr>*:nth-child(1) {
				padding-right: 1em;
			}
		}

		.box_mameden {
			margin-top: 3em;
		}

		.box_mameden tr>* {
			text-align: left;
			vertical-align: top;
		}

		.box_mameden tr>*:nth-child(1) {
			width: 1.5em;
		}

		.box_mameden tr>*:nth-child(2) {
			padding-left: 0.75em;
			font-size: 125%;
		}

		.box_mameden tr>*:nth-child(2) span {
			border-bottom: solid 1px #004021;
			padding-bottom: 0.25em;
			font-weight: bold;
			line-height: 200%;
		}

		@media screen and (max-width: 799px) {
			.box_mameden {
				width: 80vw;
				margin-left: auto;
				margin-right: auto;
			}

			.box_mameden tr>*:nth-child(2) {
				padding-left: 0.5em;
				padding-top: 0.125em;
			}

			.box_mameden tr>*:nth-child(2) span {
				font-size: 90%;
			}
		}

		.box_voice {}

		.box_voice li {}

		.box_voice li table {
			margin: auto;
		}

		.box_voice li .kao {
			width: 120px;
		}

		.box_voice li .pad {
			width: 10px;
		}

		.box_voice li .fuki {
			width: 290px;
			text-align: left;
			vertical-align: middle;
			background-image: url(images/content/contrast/voice-fuki.svg);
			background-position: left center;
			background-repeat: no-repeat;
			background-size: contain;
		}

		.box_voice li .fuki div {
			width: 85%;
			margin-left: 10%;
			line-height: 150%;
			font-size: 80%;
			font-weight: bold;
		}

		.box_voice li .name {
			text-align: center;
			vertical-align: top;
			padding-top: 0.5em;
		}

		@media screen and (min-width: 1000px) {
			.box_voice {
				width: 980px;
			}

			.box_voice li:nth-child(1) {
				float: left;
			}

			.box_voice li:nth-child(2) {
				float: right;
			}
		}

		@media screen and (max-width: 999px) {
			.box_voice li:nth-child(n+2) {
				margin-top: 1.5em;
			}
		}

		@media screen and (max-width: 799px) {
			.box_voice li .kao {
				width: 21.875vw;
			}

			.box_voice li .fuki {
				width: 53.125vw;
			}
		}

		.local_color_bg {
			padding: 0 25px;
		}

		.box_vs .text {
			font-size: 187.5%;
		}

		@media screen and (min-width: 800px) {

			.bg_kokogachigau,
			.local_color_bg {
				margin-right: 50px;
			}

			.btn_vs {
				width: 740px;
			}
		}

		@media screen and (max-width: 799px) {
			.bg_kokogachigau table tr>*:nth-child(1) {
				width: 18%;
			}

			.bg_kokogachigau table tr>*:nth-child(2) {
				padding-left: 1em;
				font-size: 5vw;
			}

			.box_vs .text {
				font-size: 5vw;
			}

			.box_vs .text {
				width: 80%;
			}

			.btn_vs {
				width: 100%;
			}
		}

		.bg_stripeY {
			background-image: url(images/content/contrast/bg-stripeY.png);
			background-position: center top;
			background-repeat: repeat;
		}

		.maintitle1_fuki {
			padding: 40px 0 30px;
		}

		.maintitle1_fuki img {
			width: 260px;
		}

		.btn_bukken2022 {
			margin: 70px auto;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		.btn_bukken2022.mgn0 {
			margin: 0 auto;
		}

		.btn_bukken2022 a {
			display: block;
			width: 414px;
			max-width: 100%;
		}

		.btn_bukken2022.bnrbox a {
			width: auto;
		}

		.btn_bukken2022 a img {
			width: 100%;
		}

		.btn_yoyaku {
			margin-top: 115px;
			margin-bottom: 80px;
		}

		.btn_yoyaku img:nth-child(1) {
			width: 496px;
			margin: auto;
			margin-bottom: 20px;
		}

		.btn_yoyaku2 {
			margin-top: 40px;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.btn_yoyaku2 a {
			width: 419px;
			max-width: 100%;
		}

		.btn_yoyaku2 a img {
			width: 100%;
		}

		@media screen and (max-width: 799px) {
			.btn_yoyaku img:nth-child(1) {
				width: 600px;
			}

			.btn_bukken2022 a,
			.btn_yoyaku2 a {
				width: 522px;
				max-width: 100%;
			}
		}

		.hikaku2022 {
			margin: auto;
			margin-top: 90px;
			width: 834px;
			max-width: 100%;
			text-align: right;
			font-size: 90%;
			line-height: 150%;
		}

		.hikaku2022 img {
			margin-bottom: 0.75em;
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
		//echo PAGE_TITLE('',$p_title,'中古マンションの意外な落とし穴');
		?>
		<div class="bg_stripeY">
			<div class="content">
				<div class="maintitle1_fuki"><img src="images/content/contrast/main-title-fukidasi.svg" class="mgnAuto"></div>
				<div class="maintitle1"><?php echo MAINPIC($dir, array('mainpic' => 'main-title.svg')); ?></div>
			</div>
		</div>
		<!-- *** -->
		<div class="content">
			<!-- *** -->

			<?php
			//関数
			function LOCAL_KOKOGACHIGAU($t)
			{
				echo '</div>
<div class="bg_kokogachigau sp_br_del"><table border="0" cellpadding="0" cellspacing="0"><tr>
<td><img src="images/content/contrast/icon-kokogachigau.svg"></td>
<td>' . WORD_BR($t) . '</td>
</tr></table></div>
<div class="content">' . chr(10);
			}
			function LOCAL_NUM($n)
			{
				return '<table border="0" cellpadding="0" cellspacing="0" class="col_green iitoko_num"><tr>
<td><div>DUPのいいところ</div></td>
<td><img src="images/content/contrast/num' . $n . '.svg"></td>
</tr></table>';
			}
			function LOCAL_PHOTO($p)
			{
				global $dir;
				$p = $dir . $p;
				list($w, $h) = getimagesize($p);
				$style = ' style="width:' . ($w / 2) . 'px;"';
				return '<img src="' . $p . '"' . $style . '>';
			}
			function LOCAL_IITOKORO($data)
			{
				$str = '<ul class="box_iitokoro">' . chr(10);
				foreach ($data as $v) {
					$str .= '<li>';
					switch (true) {
						case (is_numeric($v[0])):
							//いいところ
							$str .= LOCAL_NUM($v[0]) . '
<div style="height:2.5em;"></div>
<div class="fontP175 LH150">' . WORD_BR($v[1]) . '</div>
<div style="height:2.5em;"></div>
<div class="fontP090 LH200 sp_br_del">' . WORD_BR($v[2]) . '</div>' . chr(10);
							break;
						case (count($v) == 3):
							//工法
							$str .= '<table border="0" cellpadding="0" cellspacing="0" class="kouhou pc_notable"><tr>
<td class="font_bold fontP125">' . $v[0] . '</td>
<td class="font_meiryo fontP175">' . $v[1] . '</td>
</tr></table>
<div style="height:1.5em;"></div>
<div class="fontP080 LH200 sp_br_del">' . WORD_BR($v[2]) . '</div>' . chr(10);
							break;
						default:
							//画像
							$pic = (is_array($v)) ? $v[0] : $v;
							$str .= LOCAL_PHOTO($pic);
					}
					$str .= '</li>' . chr(10);
				}
				$str .= '<div class="clear"></div></ul>' . chr(10);
				echo $str;
			}
			function LOCAL_MAMEDEN($t)
			{
				echo '<table border="0" cellpadding="0" cellspacing="0" class="box_mameden col_green font_meiryo"><tr>
<td><img src="images/content/contrast/icon-mameden.svg"></td>
<td><span>' . WORD_BR($t) . '</span></td>
</tr></table>' . chr(10);
			}
			function LOCAL_VOICE($data)
			{
				echo '<li><table border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="kao"><img src="images/content/contrast/' . $data[0] . '" class="W100per"></td>
<td class="pad"></td>
<td class="fuki"><div>' . WORD_BR($data[2]) . '</div></td>
</tr>
<tr>
<td class="name">' . $data[1] . '</td>
<td></td>
<td></td>
</tr>
</table></li>' . chr(10);
			}
			function LOCAL_BUKKENBTN2022($class = '')
			{
				global $link_list;
				$class = ($class != '') ? ' ' . $class : '';
				echo '<div class="textC btn_bukken2022' . $class . '">
<img src="images/common/text/text-maitsuki.svg" class="mgnAuto" style="width:408px; margin-bottom: 12px;">
<a href="' . $link_list['物件情報'] . '" title="物件一覧を見る"><img src="images/content/contrast/btn-bukken2022.svg"></a>
</div>' . chr(10);
			}

			?>
			<div class="maintitle2 textC sp_textL LH200"><?php echo WORD_BR('中古マンションやリノベーションマンションは相場より割安感があります。
しかし、見た目はきれいでも様々な問題点が潜んでいる場合も。
新築DUPレジデンスとの違いを認識しておくことをオススメします。'); ?></div>
			<div class="maintitle3"><?php echo MAINPIC($dir, array('mainpic' => 'main-pic.svg')); ?></div>
			<a href="<?php echo $link_list['コンセプト']; ?>" class="maintitle4 dpB col_green">DUPレジデンスとは？</a>
			<div class="hikaku2022"><img src="images/content/contrast/hikaku-202210.svg" class="W100per">
				<?php echo WORD_BR('※1 プロジェクトによって異なります。
※2 中古物件は担保価値が低く、住宅ローン審査が通りにくい場合があります。また借入期間が短くなる可能性があります。'); ?></div>
			<?php
			$bnrset_type = '中古マンション比較表下';
			require $kaisou . "temp_php/temp_bnrset.php";
			?>
			<?php LOCAL_BUKKENBTN2022(); ?>
			<!-- **** -->
			<?php LOCAL_KOKOGACHIGAU('どちらも価格は魅力的。<div></div>でも、中古と新築では購入メリットに大きな差が…。') ?>
			<!-- **** -->
			<div class="Wmax1000 mgnAuto">
				<?php
				LOCAL_IITOKORO(array(
					array(
						1,
						'ローン審査が通りやすく
借入可能額も高い',
						'住宅ローン審査では「物件の担保価値」も重要な要素です。中古物件は担保評価額が下がるため審査が厳しく、借入可能額にも影響する場合がありますが、新築かつ駅近のDUPならそんな心配はありません。'
					),
					'p01.png'
				));
				LOCAL_MAMEDEN('他社でローンが通らなかった場合でも、新築のDUPなら大丈夫！'); ?>
			</div>
			<!-- **** -->
			<hr class="local_mgn">
			<div class="Wmax1000 mgnAuto">
				<?php
				LOCAL_IITOKORO(array(
					array(
						2,
						'住宅ローン控除で13年間は減税に',
						'DUPの場合、住宅ローン控除により13年間の減税が適用されます（一般に最大273万円）。ただし中古物件が控除対象になるには、築年数や耐震基準クリア等の厳しい条件がありますからご注意ください。'
					),
					'p02.png'
				));
				LOCAL_MAMEDEN('中古だと最大10年、140万円まで。それと比べて断然おトク！'); ?>
				<?php LOCAL_BUKKENBTN2022(); ?>
			</div>
			<!-- **** -->
			<?php LOCAL_KOKOGACHIGAU('中古マンションだと住宅ローンとは別に
管理費２〜3万円の負担。もったいないと思いませんか？') ?>
			<!-- **** -->
			<div class="Wmax1000 mgnAuto">
				<?php
				LOCAL_IITOKORO(array(
					array(
						3,
						'管理費・修繕費0円。
メンテナンスは自分のペースで',
						'マンションでは毎月の管理費や修繕積立金が必須なうえ、築年数につれ値上がりしがち。管理費2〜3万円の多大な出費も累計で見ると1,000万円にものぼります。前住人の滞納分が上乗せされる場合もあります。しかし戸建てマンションのDUPでは、強制負担金はゼロ。メンテナンスも住まう人の判断で合理的に行えます。'
					),
					'p03-202210.png'
				));
				LOCAL_MAMEDEN('DUPなら住宅費を抑えて、無駄な出費負担がありません'); ?>
			</div>
			<!-- **** -->
			<hr class="local_mgn">
			<div class="Wmax1000 mgnAuto">
				<?php
				LOCAL_IITOKORO(array(
					array(
						4,
						'管理組合の
煩わしさがない',
						'マンション住人は自動的に管理組合の一員となり、ときには補修計画の検討やトラブル仲裁などに参加を求められることも。1棟2戸という独立型のDUPには、そんな煩わしさがありません。'
					),
					'p04.jpg'
				));
				LOCAL_MAMEDEN('他人に干渉されることなく、プライバシー性の高い自分らしい生活ができます'); ?>
			</div>
			<!-- **** -->
			<?php LOCAL_KOKOGACHIGAU('綺麗にリノベーションされた中古マンション。
構造や保証に落とし穴が…。') ?>
			<!-- **** -->
			<?php LOCAL_BUKKENBTN2022(); ?>
			<div class="Wmax1000 mgnAuto">
				<?php
				LOCAL_IITOKORO(array(
					array(
						5,
						'最新の耐震構造と地盤対策。
保証期間もしっかり10年',
						'DUPでは最新技術により建物・地盤に万全の対策を施していますが、築40年を超えるマンションは、現在の耐震基準に適合していない場合があります。また中古物件の場合、雨漏り等に対する保証は基本的に2年間。DUPでは10年分の安心が得られます。'
					),
					'p05-1.png',
					array(
						'地盤を強化',
						'砕石パイル工法',
						'DUPではあらかじめ必要に応じて地盤強化を施しています。砕いた天然石を杭として打ち込む砕石パイル工法を採用し、液状化防止だけでなく、環境保全に貢献している点も特色です。'
					),
					'p05-2.jpg',
					array(
						'揺れに強い',
						'2×4工法',
						'耐震性に定評のある2×4工法。阪神淡路大震災でも「96.8％が生活に支障なし、全・半壊ゼロ」という検証結果が出ています。さらにDUPでは、自社開発パネルにより信頼性を向上させました。'
					),
					'p05-3.jpg'
				));
				LOCAL_MAMEDEN('DUPならリスクを回避し、永く安心して暮らせます'); ?>
			</div>
			<!-- **** -->
			<?php LOCAL_KOKOGACHIGAU('入居者の入れ替わりが激しい中古マンションは、
常にトラブルのリスクがあります') ?>
			<!-- **** -->
			<div class="Wmax1000 mgnAuto">
				<?php
				LOCAL_IITOKORO(array(
					array(
						6,
						'2戸限定の顔の見える
ほどよい距離感',
						'多数の住人が暮らすマンションでは、騒音やペット問題、ゴミ捨てマナー等のトラブルも起こりがち。DUPは2戸限定なうえプライバシーを守る設計で、穏やかな近所付き合いをサポートしています。'
					),
					'p06.png'
				));
				LOCAL_MAMEDEN('DUPなら大勢の人間関係に悩む必要がありません'); ?>
			</div>
			<!-- **** -->
			<hr class="local_mgn">
			<div class="Wmax1000 mgnAuto">
				<?php
				LOCAL_IITOKORO(array(
					array(
						7,
						'上下階の音のトラブルを
避けるメゾネット構造',
						'集合住宅でのトラブル原因1位は、上下階で起こる音や振動問題です。DUPは1戸が1・2階を専有するメゾネット構造（ロフト付もあり）だから、そんな心配はありません。ご家族みなさまが、部屋数・収納も充分に持てます。'
					),
					'p07.jpg'
				));
				LOCAL_MAMEDEN('DUPなら憧れの庭付きの戸建て暮らしができます'); ?>
			</div>
			<div class="btn_yoyaku textC">
				<img src="images/content/contrast/btn-yoyaku2022-f.svg">
				<?php echo BTN_OVAL('ご来場予約フォーム', '1分で完了 見学予約をする', 'width:23em;', ''); ?>
			</div>
			<?php //LOCAL_BUKKENBTN2022(); 
			?>
			<!-- **** -->
			<hr class="local_mgn">
			<div class="textC col_green fontP160 pc_br_del font_meiryo font_bold" style="line-height:133%;">実際にマンション購入後に<br>DUPに住み替えした声</div>
			<div style="height:45px;"></div>
			<ul class="box_voice col_green font_meiryo mgnAuto Wmax100per">
				<?php
				LOCAL_VOICE(array('voice-kao1.png', '名古屋市M様', 'すぐ売却相談をして、
DUPに住み替えました。'));
				LOCAL_VOICE(array('voice-kao2.png', '春日井市K様', '数十人との共同生活がうまくいかず、毎日ストレスに…。思い切ってDUPに住み替えてよかったです。'));
				?>
				<div class="clear"></div>
			</ul>
			<div style="height:75px;"></div>
			<!-- **** -->
		</div>

		<div class="local_color" style="background-color:#004021; color:#FFF;">
			<div class="bg box_vs">
				<div style="height:50px;"></div>
				<div class="sp_br_del LH150 sp_textL text"><?php echo WORD_BR('中古マンションを購入する前に、
もう一度比較検討されることをおすすめします。'); ?></div>
				<div style="height:40px;"></div>
				<?php echo BTN_OVAL('物件情報', '物件一覧を見る→', 'width:15em;border: solid 2px #FFF;', 'font_bold'); ?>
				<div style="height:1em;"></div>
				<?php echo BTN_OVAL('ご来場予約フォーム', '来場予約・お問い合わせ', 'width:15em;border: solid 2px #FFF;', 'font_bold colorW'); ?>
				<div style="height:40px;"></div>
			</div>
		</div>

		<div class="local_color_bg" style="background-color:#D3E2DA;">
			<div class="Wmax1100 mgnAuto">
				<div style="height:70px;"></div>
				<a class="dpB mgnAuto btn_vs"><img src="images/content/contrast/btn-vs.svg" class="W100per"></a>
				<div style="height:65px;"></div>
				<?php echo MAINPIC($dir, array('mainpic' => 'cont-p1.png', 'class' => 'no100per')); ?>
				<hr class="local_mgn" style="border-top-color:#004021;">
				<a href="<?php echo $link_list['コンセプト']; ?>" class="dpB"><?php echo MAINPIC($dir, array('mainpic' => 'cont-p2.png', 'class' => 'no100per')); ?></a>
				<div style="height:4em;"></div>
			</div>
		</div>

		<div class="content">
			<div class="textC" style="padding-top:80px; padding-bottom:75px;">
				<?php //echo BTN_OVAL('特長','特長を知る','width:13em;','colorW'); 
				?>
				<?php LOCAL_BUKKENBTN2022('mgn0'); ?>
				<div class="btn_yoyaku2"><a href="<?php echo $link_list['ご来場予約フォーム']; ?>"><img src="images/content/contrast/btn-yoyaku2022.svg"></a></div>
			</div>
			<!-- *** -->
		</div>
		<!-- ** -->
		<?php echo $temp_footer; ?>
		<!-- * -->
	</div>
</body>

</html>