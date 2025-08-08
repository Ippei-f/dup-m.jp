<?php
$p_type = 'merit';
$p_title = '特長';
$kaisou = '';
require $kaisou . "temp_php/basic.php";
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
		.merit_subtitle {
			background-image: url(images/common/dark-ami-light.png);
			background-position: left top;
			background-repeat: repeat;
		}

		.merit_subtitle .p_title {
			padding-top: 60px;
			padding-bottom: 40px;
			margin-right: 20px;
			font-size: 300%;
		}

		.merit_subtitle .p_title .mini {
			font-size: 30%;
		}

		.merit_catch {
			text-align: center;
			font-size: 250%;
			line-height: 150%;
			margin-top: 50px;
		}

		.merit_comment {
			text-align: center;
			line-height: 200%;
			margin-top: 40px;
		}

		@media screen and (max-width: 799px) {
			.merit_catch {
				font-size: 200%;
			}

			.merit_comment {
				font-size: 120%;
			}

			.merit_comment.sp_textL {
				text-align: left;
			}
		}

		.meritbox1 li {
			border-top: solid 1px rgba(0, 0, 0, 0.25);
		}

		.meritbox1 li .box {
			width: 100%;
			max-width: 1030px;
			margin: auto;
			padding-top: 80px;
			padding-bottom: 90px;
			text-align: left;
			line-height: 200%;
		}

		.meritbox1 li .box .num {
			float: left;
			color: #004021;
			border-bottom: solid 1px #004021;
			font-size: 200%;
			margin-bottom: 25px;
		}

		.meritbox1 li .box .num td {
			vertical-align: middle;
			text-align: left;
			font-weight: bold;
			line-height: 100%;
		}

		.meritbox1 li .box .num .fontP050 {
			padding-top: 0.33em;
			padding-right: 0.5em;
			font-weight: normal;
		}

		.meritbox1 li .box h4 {
			margin-bottom: 25px;
			font-size: 200%;
			line-height: 150%;
			font-weight: normal;
		}

		.meritbox1 li .box .rtext {
			font-size: 70%;
			line-height: 175%;
			margin-top: 2em;
		}

		@media screen and (min-width: 800px) {
			.meritbox1 li .box .floatL_pc {
				max-width: 480px;
			}

			.meritbox1 li .box .floatR_pc {
				max-width: 500px;
			}
		}

		@media screen and (min-width: 800px) and (max-width: 1300px) {
			.meritbox1 li .box .floatL_pc {
				max-width: 46.6%;
			}

			.meritbox1 li .box .floatR_pc {
				max-width: 48.54%;
			}
		}

		@media screen and (max-width: 799px) {
			.meritbox1 li .box {
				padding-top: 60px;
				padding-bottom: 75px;
			}

			.meritbox1 li .box h4 {
				font-size: 180%;
			}

			.meritbox1 li .box .floatR_pc {
				margin-top: 50px;
			}
		}

		.history_box {
			height: 1046px;
			color: #FFF;
		}

		.history_title {
			position: absolute;
			top: 120px;
			left: 0;
			right: 0;
			margin: auto;
			display: inline-block;
		}

		.history_title h3 {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
			height: 1em;
			font-size: 300%;
			line-height: 100%;
		}

		.history_text {
			position: absolute;
			top: 385px;
			left: 0;
			right: 0;
			margin: auto;
			width: 800px;
			max-width: 95%;
			text-align: left;
		}

		.history_semi {
			background-color: rgba(255, 255, 255, 0.80);
			color: #000;
			position: absolute;
			top: 675px;
			left: 0;
			right: 0;
			margin: auto;
			width: 800px;
			max-width: 95%;
			text-align: left;
			padding: 25px 20px;
		}

		.history_semi .floatL_pc {
			max-width: 290px;
		}

		.history_semi .floatR_pc {
			font-size: 90%;
		}

		.history_semi .floatR_pc h4 {
			font-size: 120%;
		}

		@media screen and (min-width: 800px) {
			.history_semi .floatR_pc {
				max-width: 440px;
			}
		}

		@media screen and (min-width: 800px) and (max-width: 1300px) {
			.history_semi .floatL_pc {
				max-width: 38.66%;
			}

			.history_semi .floatR_pc {
				max-width: 58.66%;
			}
		}

		@media screen and (max-width: 799px) {
			.history_box {
				/* height:1120px; */
				height: 70em;
			}

			.history_title {
				width: 490px;
				max-width: 90%;
				top: 75px;
			}

			.history_title h3 {
				font-size: 200%;
			}

			.history_text {
				top: 260px;
			}

			.history_text h4 {
				margin-bottom: 1em;
			}

			.history_semi {
				/* top:620px; */
				top: 38.75em;
				width: 480px;
			}

			.history_semi .floatR_pc {
				margin-top: 1em;
			}
		}

		.meritbox1 .merit-3>.box {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}

		.meritbox1 .merit-3 .floatL_pc {
			float: none;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}

		.meritbox1 .merit-3 .box .num {
			float: none;
		}

		.meritbox1 .merit-3 .floatL_pc .badge {
			font-size: 20px;
			text-align: center;
			color: #004021;
			border: 1px solid #004021;
			padding: 15px;
			margin: 0 0 20px;
		}

		@media screen and (max-width: 799px) {
			.meritbox1 .merit-3 .floatL_pc .badge {
				font-size: 25px;
				margin: 40px 0 20px;
			}
		}

		.meritbox1 .merit-3 .floatR_pc .img {
			margin-bottom: 8px;
		}
	</style>
</head>

<body>
	<?php echo $temp_pagetop; ?>
	<div align="center">
		<!-- * -->
		<?php echo $temp_header; ?>
		<!-- ** -->
		<?php
		PAGE_PHOTOTITLE($p_type, 575);
		?>
		<!-- *** -->
		<div class="merit_subtitle"><?php
									echo PAGE_TITLE('', 'ARCHITECT', '[ 建物の特長 ]', 'h3');
									?></div>
		<div class="Wmax1200 mgnLR50 mgnLR20_sp">
			<img src="images/content/merit/photo-1-0.png" class="dpB mgnLRAuto mgnT50">
			<div class="merit_catch">
				ひとつの建物を2分割。<br>
				上下階のメゾネットタイプ
			</div>
			<div class="merit_comment sp_textL">
				<?php
				echo SPAN_IB(
					'上下階で空間を専有するメゾネット構造は、
住人同士の振動や騒音トラブル等から解放します。<br>
1・2階を広々使える贅沢空間で、
快適な暮らしを実現する効率的な設計です。'
					/*'上下階で空間を専有するメゾネット構造は、
住人同士の振動や騒音トラブル等から解放します。<br>
また1階は来客時に対応できるオープンな空間に、<br>
2階は家族だけのプライベートな空間に限定するなどの使い分けが可能。<br>
快適な暮らしを実現する効率的な設計です。'*/
				);
				?></div>
			<ul class="meritbox1 mgnT90">
				<?php
				function MERIT1_BOX($num = '', $title = '', $text = '', $img = '', $maxw = 'auto', $rtext = '', $pcpad = '')
				{

					if ($num != '') {
						$num = '<table border="0" cellpadding="0" cellspacing="0" class="num LH100"><tr>
<td class="fontP050">MERIT</td>
<td>' . $num . '</td>
</tr></table>
<div class="clear"></div>' . chr(10);
					}

					if ($img != '') {
						$add = ' class="floatL_pc"';
					} else {
						$add = '';
					}

					$title = str_replace(array("<br>"), '<div class="pc_vanish"></div>', $title); //PC改行適応

					$imgurl = 'images/content/merit/' . $img;
					$imgurl_sp = str_replace(array("."), '-sp.', $imgurl);
					/*
	if(file_exists($imgurl_sp)){
		$arr=getimagesize($imgurl_sp);
		$maxw_sp=floor($arr[0]/2);
	}
	else{
		$maxw_sp='';
	}
	*/
					$maxw_sp = '';

					echo '<li><div class="box">
<div class="floatL_pc">
' . $num . '
<h4 class="sp_br_del">' . str_replace(array("\r\n", "\n", "\r"), '<br>', $title) . '</h4>
<div class="sp_fontP120">' . str_replace(array("\r\n", "\n", "\r"), '<br>', $text) . '</div>
</div>
' . (($img != '') ? '<div class="floatR_pc">' . (($pcpad != '') ? '<div class="sp_vanish" style="height:' . $pcpad . '"></div>' : '') . '<img src="' . $imgurl . '" class="dpB mgnAuto' . ((file_exists($imgurl_sp)) ? ' sp_vanish' : '') . '" style="width:' . $maxw . '">' . ((file_exists($imgurl_sp)) ? '<img src="' . $imgurl_sp . '" class="dpB mgnAuto pc_vanish" style="' . (($maxw_sp != '') ? 'width:' . $maxw_sp . 'px' : '') . '">' : '') . (($rtext != '') ? '<div class="rtext mgnAuto font_meiryo" style="max-width:' . $maxw . '">' . $rtext . '</div>' : '') . '</div>' : '') . '
<div class="clear"></div>
</div></li>' . chr(10);
				}

				$cnt = 1;

				MERIT1_BOX(
					$cnt++,
					'全戸角住戸の新発想',
					'一般的なマンションでは上下左右を囲まれた「中住戸」が多く、開放感のある角部屋は、価値の高い人気プランとして扱われます。しかし1棟2戸のデュープレジデンスではすべてが角住戸。どの住まいも十分な通風や採光を得ることができます。また住人数が限られるため、プライバシー性が高い点も特色です。',
					'photo-1-1.png',
					'489px',
					'',
					'3em'
				);

				MERIT1_BOX(
					$cnt++,
					'音の問題をクリア',
					'遮音性の高い四層からなる二重壁構造を採用している点も、デュープレジデンスの特色です。各境界壁には吸音性に優れた高性能グラスウールを入れ、さらに壁間に空気層を設けることで、気になる音の侵入をカットしています。さらに、1・2階専有のメゾネット構造ですので、上下階に他人が住まうことはなく、騒音のトラブルから解放してくれます。',
					'photo-1-2.png',
					'492px',
					'',
					'4em'
				);

				/*
MERIT1_BOX($cnt++
,'木造への強いこだわり'
,'木の家に入ると、リラックスする、温かみを感じるなど、人は心地よさを感じます。無機質なコンクリートにはない良さがある木の家は、湿度調整、吸音遮音性、断熱性など、様々な効用を住む人に与えます。'
,'photo-1-3.png','467px'
,'重量あたりで比較すると、調湿性に優れた木材は、湿気がたまりやすいコンクリートよりも強度が高いことがわかります。たとえばスギで測定したところ、引っ張り強度は鉄の約4倍いう驚きの結果が。また燃えるスピードもきわめて遅く、鉄が5分で強度が半分に落ちるのに対し、木は10分後も約80％の強度を保っています。');
*/
				/*
				$url = 'images/content/merit/photo-1-4u.png';
				MERIT1_BOX(
					$cnt++,
					'4.3倍2×4工法の高耐震性能',
					'東新住建は、地震に強い2×4パネルをさらに進化させた従来より耐力を約140％に高めた「壁量4.3倍」パネルを開発。高品質ステンレス釘の採用や、釘ピッチをより密にした仕様など、様々な工夫により耐振性能を向上させました。この新工法では、従来の「壁量3.0倍」から、「壁量4.3倍」にすることで1.4倍以上の耐力アップを実現しました。' . IMG_TAG($url, 'W100per dpB sp_vanish', 'margin-top:1em;'),
					'photo-1-4p.jpg',
					'100%',
					IMG_TAG($url, 'W100per dpB pc_vanish', 'margin-top:1em;')
				);
				*/

				?>


				<li class="merit-3">
					<div class="box">
						<div class="floatL_pc">
							<div>
								<table border="0" cellpadding="0" cellspacing="0" class="num LH100">
									<tr>
										<td class="fontP050">MERIT</td>
										<td>3</td>
									</tr>
								</table>
								<h4 class="sp_br_del">4.3倍2×4工法の高耐震性能</h4>
								<div class="sp_fontP120">東新住建は、地震に強い2×4パネルをさらに進化させた従来より耐力を約140％に高めた「壁量4.3倍」パネルを開発。高品質ステンレス釘の採用や、釘ピッチをより密にした仕様など、様々な工夫により耐振性能を向上させました。この新工法では、従来の「壁量3.0倍」から、「壁量4.3倍」にすることで1.4倍以上の耐力アップを実現しました。</div>
							</div>
							<div>
								<div class="badge">2008年、国土交通省大臣認定を取得</div>
								<div class="svg"><img src="images/content/merit/photo-1-4u-2.svg" alt="" /></div>
							</div>
						</div>
						<div class="floatR_pc">
							<div class="img">
								<img src="images/content/merit/photo-1-4p-1.jpg" class="dpB mgnAuto" style="width: 100%" />
							</div>
							<div class="img">
								<img src="images/content/merit/photo-1-4p-2.jpg" class="dpB mgnAuto" style="width: 100%" />
							</div>
							<div class="img">
								<img src="images/content/merit/photo-1-4p-3.jpg" class="dpB mgnAuto" style="width: 100%" />
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>

		<!-- *** -->
		<div class="textC">
			<?php echo BTN_OVAL('お問い合わせ', '資料請求をする', 'width:13em;', 'colorW'); ?></div>
		<div class="textC" style="margin-top:20px; margin-bottom:70px;">
			<?php echo BTN_OVAL('物件情報', '物件一覧を見る', 'width:13em;'); ?></div>

		<!-- *** -->
		<div class="merit_subtitle"><?php
									echo PAGE_TITLE('', 'FINANCE', '[ 経済的メリット ]', 'h3');
									?></div>
		<div class="bg_cover" style="height:650px; background-image:url(images/content/merit/photo-3-0.jpg); background-position:center top;"></div>
		<div class=" mgnLR50 mgnLR20_sp">
			<div class="merit_catch">
				よりリーズナブルに。<br>
				マンションでかかってくる<br>
				管理費・修繕積立金０円
			</div>
			<div class="merit_comment sp_textL">
				<?php
				echo SPAN_IB('一般的な分譲マンションでは、
住宅購入費以外にも管理費や修繕積立費などの支出が毎月発生します。<br>
しかしデュープレジデンスは、
過剰な共有部分をカットしたシンプルな構造を採用しているため、<br class="sp_vanish">
購入費や税金以外の固定費は不要です。<br>
マンションと比べて毎月の出費を格段に抑えられるため、<br class="sp_vanish">
無駄のない充実したライフプランが立てられます。');
				?></div>
			<img src="images/content/merit/photo-3-0L.png" class="dpB mgnLRAuto mgnT50 Wmax100per" style="width:660px;">
			<div style="height:90px;"></div>
			<?php echo LINK_TAG($link_list['中古マンションとの比較'], array('class' => 'dpIB', 'text' => IMG_TAG($kaisou . 'images/top/bnr/bnr20200206.png', 'W100per', 'max-width:394px;'))); ?>
			<ul class="meritbox1 mgnT90">
				<?php
				MERIT1_BOX(
					'',
					'資産価値の高い駅近物件は
売却時にも有利。
賃貸としても活用可能',
					'デュープレジデンスは、不動産としての資産価値が高い駅近エリアに限定して建築されます。駅近物件は利便性が高いため、たとえば事情により、お住まいできなくなった場合でも、資産価値を保ちやすく売却も有利に進めることができます。また、不動産管理会社のBLUE BOXとの連携により、賃貸として貸し出して家賃収入を得ることも可能です。',
					'photo-3-1.jpg',
					'473px'
				);
				?>
			</ul>
		</div>
		<!-- *** -->
		<div class="textC">
			<?php echo BTN_OVAL('お問い合わせ', '資料請求をする', 'width:13em;', 'colorW'); ?></div>
		<div class="textC" style="margin-top:20px; margin-bottom:70px;">
			<?php echo BTN_OVAL('物件情報', '物件一覧を見る', 'width:13em;'); ?></div>


		<!-- *** -->
		<div class="merit_subtitle"><?php
									echo PAGE_TITLE('', 'LOCATION', '[ 立地 ]', 'h3');
									?></div>
		<div class="bg_cover" style="height:650px; background-image:url(images/content/merit/photo-2-0.jpg); background-position:center top;"></div>
		<div class=" mgnLR50 mgnLR20_sp">
			<div class="merit_catch">
				『名駅まで30分プロジェクト』<br>
				都心部への快適アクセス
				<?php
				/*
//~190205
『駅近10分プロジェクト』<br>
都心部への快適アクセス
//~181015
駅近エリアに限定。<br>
都心部への快適アクセス
*/
				?>
			</div>
			<div class="merit_comment sp_textL">
				<?php
				echo SPAN_IB('2027年リニア開通によって国際レベルのターミナルと変貌を遂げる「名古屋駅」。<br class="sp_vanish">
いま名古屋は、世界へ発信する国際都市として、大きな変革の時を迎えています。<br>
<br>
そこでデュープレジデンスは、『名駅まで30分プロジェクト』を掲げ、<br class="sp_vanish">
名古屋駅までのアクセスを重視した利便性が高く、資産価値も維持しやすい<br class="sp_vanish">
厳選された立地にのみ建築をおこなっています。<br>
<br>
こうした利便性の高いエリアは、地価が高く供給量も限られるため間取りが画一化されたマンションがほとんどですが、<br class="sp_vanish">
デュープレジデンスは、一戸建て水準のゆとりを実現しています。<br>
またマンションとは異なり、土地もオーナー様の大切な資産となってくれるのもポイントです。');
				/*
//~190205
利便性の高いエリアは、地価が高く供給量も限られます。<br>
そのため駅前にはマンションが多く、一戸建て建設は難しいのが現状でした。<br>
しかしデュープレジデンスは、利便性が高く、資産価値も維持しやすい<br>
厳選された立地にのみ建築する『駅近10分プロジェクト』を掲げ、<br>
駅前立地でありながら一戸建て水準のゆとりを実現しています。<br>
マンションとは異なり、土地もオーナー様の大切な資産となってくれるのもポイントです。
//~181015
echo SPAN_IB('利便性の高いエリアは、
地価が高く供給量も限られます。<br>
そのため駅前にはマンションが多く、
一戸建て建設は難しいのが現状でした。<br>
しかしデュープレジデンスは、
駅前立地でありながら一戸建て水準のゆとりを実現。<br>
マンションとは異なり、
土地もオーナー様の大切な資産となってくれます。');
*/
				?></div>
			<img src="images/content/merit/photo-2-1.png" class="dpB mgnLRAuto mgnT50 Wmax100per sp_vanish" style="width:996px;">
			<img src="images/content/merit/photo-2-1-sp.png" class="dpB mgnLRAuto mgnT50 Wmax100per pc_vanish" style="width:384px;">
			<div style="height:100px;"></div>
		</div>



		<!-- *** -->
		<div class="textC">
			<?php echo BTN_OVAL('お問い合わせ', '資料請求をする', 'width:13em;', 'colorW'); ?></div>
		<div class="textC" style="margin-top:20px; margin-bottom:70px;">
			<?php echo BTN_OVAL('物件情報', '物件一覧を見る', 'width:13em;'); ?></div>
		<!-- *** -->
		<div class="bg_cover pos_rel history_box borderbox" style="background-image:url(images/content/merit/bg-history.jpg);">
			<div class="bg_cover history_title"><img src="images/content/merit/clear-history.png" style="background-image:url(images/content/merit/logo-history.png); mix-blend-mode:overlay;">
				<h3>デュープレジデンスの起源</h3>
			</div>
			<div class="history_text">
				<h4 class="textC fontP180 LH150 font_normal pc_br_del">合理的思想が生んだアイデア。<br>ロンドン発祥の2戸連棟住宅<span class="pc_vanish dpIB" style="width:1em;"></span></h4>
				<div class="LH200">ロンドンの高級住宅地・チェルシー地区には、2戸連棟型の住まいが数多く見られます。一つの建物をちょうど中央から左右対称に区分したこの建築様式は、イギリスでは「セミ・デタッチドハウス※」と名付けられ、地価の高い都心部を中心に普及。便利で快適な都市の生活環境を、通常の一戸建てよりもリーズナブルに享受できます。この建築様式はアメリカにも伝わり、 DUPLEX（デュープレックス）と名付けられ今なお人気を博しており、海外では一般的に広く建てられています。</div>
			</div>
			<div class="history_semi">
				<img src="images/content/merit/photo-history.png" class="dpB mgnAuto floatL_pc">
				<div class="floatR_pc LH200">
					<h4 class="col_green">セミ・デタッチドハウスとは？</h4>
					ひとつの建物を2戸に活用するセミ・デタッチドハウスは、日本では「二軒長屋」と呼ばれ、江戸時代に広く普及しました。一棟の建物を中央で割った形となるため、それぞれの家に専用玄関と庭がつく点も特色です。イギリスでは子供を持つ家族が暮らすだけでなく、大学生が友人とシェアして住むケースも多く見られます。
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!-- ** -->
		<?php echo $temp_footer; ?>
		<!-- * -->
	</div>
</body>

</html>