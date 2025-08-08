<?php
//<meta charset="utf-8">

$toushin_bnr_dup_arr=array
(''//空白
//-------
);

switch($bnrset_type){
//-------------------
case 'TOPキャッチコピー上':
echo TOP_BNR($link_list['中古マンションとの比較'],'bnr20200206.png',394);
break;
//-------------------
case 'TOPキャッチコピー下':
echo TOP_BNR('news.php?id=202','bnr-202503sumaihaku.jpg',600,array('e'=>2025060109,'e-type'=>'YmdH'));
//echo TOP_BNR('news.php?id=189','bnr-202407dream.jpg',600,array('e'=>2024080100,'e-type'=>'YmdH'));
//echo TOP_BNR('showroom.php','bnr-taptogo.jpg',500);
/*
echo TOP_BNR('https://www.toshinjyuken.co.jp/teishaku-portal/taiyoukou-cp202207/'.$t_blank,'bnr-taiyoukou_500-225.jpg',500,array
('s'=>2022070800,'s-type'=>'YmdH','e'=>2022080100,'e-type'=>'YmdH'));
*/
break;
//-------------------
case 'TOPおすすめ物件上':
echo TOP_BNR('news.php?id=191'		,'bnr-202410bunjou.jpg',600,array('e'=>2024113009,'e-type'=>'YmdH'));
/*
echo '<div style="display:none;">'.chr(10);
echo '</div>'.chr(10);
echo TOP_BNR('news.php?id=181','bnr-2024shinsyun-hatsuri_site.jpg',440,array('s'=>2023122517,'s-type'=>'YmdH','e'=>2024020107,'e-type'=>'YmdH'));
echo '<div></div>';
echo TOP_BNR('news.php?id=179','bnr-kanseibukken202312.jpg',440,array('e'=>2023122517,'e-type'=>'YmdH'));
echo '<div></div>';
*/
/*
echo TOP_BNR('news.php?id=184','bnr-202403sumai.jpg',600,array('e'=>2024050107,'e-type'=>'YmdH'));
echo '<div></div>';
echo TOP_BNR($link_list['VR見学']	,'bnr20200428.jpg',540);
echo TOP_BNR('news.php?id=103'		,'bnr-satei.jpg',540);
*/
break;
//-------------------
case 'TOPメニューバナー下':
//echo TOP_BNR($link_list['お問い合わせ'],'bnr20191007.png',540,array('div'=>true));
echo TOP_BNR('https://www.dup-m.jp/lp2/'.$t_blank			,'bnr20190518.jpg',500);
echo TOP_BNR('https://www.dup-m.jp/shataku/'.$t_blank	,'bnr20191226.jpg',500,array('s'=>2019122512,'s-type'=>'YmdH'));
break;
//-------------------
case '物件情報':
/*
echo TOP_BNR('news.php?id=151','bnr-2022sumaihaku-W700.jpg',350,array
('s'=>2022111000,'s-type'=>'YmdH','e'=>2022112517,'e-type'=>'YmdH'));
*/
//echo '<div></div>';
//echo TOP_BNR($link_list['VR見学']	,'bnr20200428.jpg',588);
//echo TOP_BNR($link_list['IoT']		,'bnr20200310.jpg',588);
break;
//-------------------
case '中古マンションタイトル下':
/*
echo TOP_BNR('https://www.dup-m.jp/kodate/cp-sumaihaku/','bnr-2023sumaihaku-0401-30m.jpg',492,array
('e'=>2023060100,'e-type'=>'YmdH'));
echo '<div style="width:100%;height:2em;"></div>';
*/
echo TOP_BNR('news.php?id=165'		,'bnr-2023NRP.jpg',440);
//echo TOP_BNR('news.php?id=158'		,'bnr20230113-D.jpg',882,array('e'=>2023020607,'e-type'=>'YmdH'));
break;
//-------------------
case '中古マンション比較表下':
//echo TOP_BNR_SET2022('taiyoukou-cp202207',441,array('wrap'=>'contrast'));
break;
//-------------------
}

/*
ジャンク置き場

//echo TOP_BNR($link_list['IoT']		,'bnr20200310.jpg',540);
//echo TOP_BNR('campaign-202001.php','bnr20200106.jpg',600,array('s'=>20200106,'s-type'=>'Ymd','e'=>20200202,'e-type'=>'Ymd'));
//echo TOP_BNR('campaign-202002.php','bnr20200203.jpg',640,array('s'=>20200203,'s-type'=>'Ymd','e'=>20200229,'e-type'=>'Ymd'));
//echo TOP_BNR($link_list['コンセプト'],'bnr20190911.png',394);//590
//echo TOP_BNR('https://www.dup-m.jp/shataku/'.$t_blank,'bnr20191226.jpg',640,array('s'=>2019122612,'s-type'=>'YmdH','wrap'=>'div'));
//echo TOP_BNR('campaign-202003owari.php','bnr20200313.jpg',750,array('wrap'=>'div','e'=>2020032309,'e-type'=>'YmdH'));
//echo TOP_BNR('https://www.toshinjyuken.co.jp/shinshun-cp/','bnr-2022SALE.jpg',500,array('e'=>20220204,'e-type'=>'Ymd'));
//echo TOP_BNR('news.php?id=111','bnr-weekday.jpg',500,array('e'=>20220105,'e-type'=>'Ymd'));
//echo TOP_BNR('campaign-20210429.php','bnr20210429.jpg',600,array('s'=>20210428,'s-type'=>'Ymd','e'=>20210510,'e-type'=>'Ymd'));
*/
?>