<?php
//<meta charset="utf-8">

$url_line='https://lin.ee/v4vz5KD';
$dir_contact_img='../recaptcha/form/img/';
$url=$_SERVER['SCRIPT_NAME'];
$line_iten=false;
switch(true){
case (strpos($url,'/kodate/')!==false)://東新住建の家
case (strpos($url,'/sodatsu/')!==false)://そだつ
$line_iten=true;
break;
/*
case (strpos($url,'/teishaku-portal/')!==false)://テイシャク
case (strpos($url,'/hiraya/')!==false)://平屋
break;
*/
}
if($line_iten){
?>
<style>
.bnr_line{
	display: flex;
	justify-content: center;
	padding: 0 1em;
	margin-bottom: 3.5em;
}
.bnr_line > * a{
	display: block;
	width:328px;
	width:calc(100% * 328 / 380);
}
.bnr_line > * img{width:100%;}
.bnr_line > * img[src*="bnr-line"] + *{
	font-size: 70%;
	margin-top: 0.5em;
	text-align: left;
	width: 100%;
}
@media screen and (max-width: 999px) {
	.bnr_line{
		flex-direction: column;
		margin-bottom: 1.5em;
	}
	.bnr_line > *,
	.bnr_line > * a[href*="http"]{width: 100%;}
}
</style>
<div class="bnr_line">
<div class="sp_vanish"><?php
echo '<img src="'.$dir_contact_img.'bnr-line.svg" class="sp_vanish">';
echo '<div>LINEアプリよりQRコードを読んでください '.$url_line.'</div>';
?></div>
<div class="pc_vanish"><?php
echo '<a href="'.$url_line.'" target="_blank"><img src="'.$dir_contact_img.'bnr-line-sp.svg"></a>';
?></div>
</div>
<?php
}
?>