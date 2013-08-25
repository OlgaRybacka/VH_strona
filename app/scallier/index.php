<?php

require "common.php";

/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 29.07.13
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">


    <link rel="stylesheet" href="main.css">

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.js"></script>

    <script>
        $(function(){
            $(".area1").mouseenter(function(){
                $(".menu-uslugi").stop(true, true).animate({top: "205px", left:"115px"}, 500);
            });
            $(".area1").mouseleave(function(){
                $(".menu-uslugi").stop(true, true).animate({top: "135px", left:"45px"}, 500);
            });
            $(".area2").mouseenter(function(){
                $(".menu-zespol").stop(true, true).animate({top: "56px", left:"300px"}, 500);
            });
            $(".area2").mouseleave(function(){
                $(".menu-zespol").stop(true, true).animate({top: "16px", left:"260px"}, 500);
            });
            $(".area3").mouseenter(function(){
                $(".menu-o-firmie").stop(true, true).animate({top: "208px", left:"300px"}, 500);
            });
            $(".area3").mouseleave(function(){
                $(".menu-o-firmie").stop(true, true).animate({top: "148px", left:"240px"}, 500);
            });
            $(".area4").mouseenter(function(){
                $(".menu-galeria").stop(true, true).animate({top: "210px", left:"491px"}, 500);
            });
            $(".area4").mouseleave(function(){
                $(".menu-galeria").stop(true, true).animate({top: "152px", left:"433px"}, 500);
            });
            $(".area5").mouseenter(function(){
                $(".menu-kontakt").stop(true, true).animate({top: "266px", left:"137px"}, 500);
            });
            $(".area5").mouseleave(function(){
                $(".menu-kontakt").stop(true, true).animate({top: "336px", left:"207px"}, 500);
            });
        });
    </script>
</head>

<body>
<div class="main-container">
    <div class="content">
        <div class="logo"> </div>
        <div class="page-header">
            <div class="lang-buttons">
                <a class="lang_but1 <?php if ($lang['LANG'] == 'pl') echo "active"; ?>" href="index.php?lang=pl"></a>
                <a class="lang_but2 <?php if ($lang['LANG'] == 'en') echo "active"; ?>" href="index.php?lang=en"></a>
                <a class="lang_but3 <?php if ($lang['LANG'] == 'de') echo "active"; ?>" href="index.php?lang=de"></a>
            </div>
        </div>
        <div class="kostki">
            <div class="menu-uslugi" style="background-image: url(<?php if ($lang['LANG'] == 'en') echo "img/menu_uslugi_en.png"; else if ($lang['LANG'] == 'de') echo "img/menu_uslugi_de.png"; else echo "img/menu_uslugi_pl.png";?>)"></div>
            <div class="menu-zespol" style="background-image: url(<?php if ($lang['LANG'] == 'en') echo "img/menu_zespol_en.png"; else if ($lang['LANG'] == 'de') echo "img/menu_zespol_de.png"; else echo "img/menu_zespol_pl.png";?>)"></div>
            <div class="menu-o-firmie" style="background-image: url(<?php if ($lang['LANG'] == 'en') echo "img/menu_o_firmie_en.png"; else if ($lang['LANG'] == 'de') echo "img/menu_o_firmie_de.png"; else echo "img/menu_o_firmie_pl.png";?>)"></div>
            <div class="menu-galeria" style="background-image: url(<?php if ($lang['LANG'] == 'en') echo "img/menu_galeria_en.png"; else if ($lang['LANG'] == 'de') echo "img/menu_galeria_de.png"; else echo "img/menu_galeria_pl.png";?>)"></div>
            <div class="menu-kontakt" style="background-image: url(<?php if ($lang['LANG'] == 'en') echo "img/menu_kontakt_en.png"; else if ($lang['LANG'] == 'de') echo "img/menu_kontakt_de.png"; else echo "img/menu_kontakt_pl.png";?>)"></div>
            <div class="menu-map">
                <img id="menu-map-img" src="img/map.png" usemap="#Image-Map" border="0" width="570" height="413" alt="" />
                <map id="Image-Maps" name="Image-Map">
                    <area class="area1" shape="poly" coords="105,116,204,215,104,314,4,214," href="uslugi.php?lang=<?php echo $lang['LANG'];?>" alt="" title=""   />
                    <area class="area2" shape="poly" coords="313,2,376,67,319,125,311,120,300,129,244,71," href="zespol.php?lang=<?php echo $lang['LANG'];?>" alt="" title=""   />
                    <area class="area3" shape="poly" coords="311,128,398,214,311,300,223,217," href="o_firmie.php?lang=<?php echo $lang['LANG'];?>" alt="" title=""   />
                    <area class="area4" shape="poly" coords="405,208,406,219,482,294,564,213,482,131," href="galeria.php?lang=<?php echo $lang['LANG'];?>" alt="" title=""   />
                    <area class="area5" shape="poly" coords="213,218,304,311,214,406,118,312," href="kontakt.php?lang=<?php echo $lang['LANG'];?>" alt="" title=""   />
                </map>
            </div>
        </div>
        <div class="stopka"> </div>
    </div>
</div>
</body>
</html>