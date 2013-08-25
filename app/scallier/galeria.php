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
    <link href="jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script>
        (function($){
            $(window).load(function(){
                $(".text-field").mCustomScrollbar();
            });
        })(jQuery);
    </script>



</head>

<body>
<div class="main-container">
    <div class="content">
        <a href="index.php?lang=<?php echo $lang['LANG'];?>"><div class="logo"> </div></a>
        <div class="page-header">
            <div class="lang-buttons">
                <a class="lang_but1 <?php if ($lang['LANG'] == 'pl') echo "active"; ?>" href="galeria.php?lang=pl"></a>
                <a class="lang_but2 <?php if ($lang['LANG'] == 'en') echo "active"; ?>" href="galeria.php?lang=en"></a>
                <a class="lang_but3 <?php if ($lang['LANG'] == 'de') echo "active"; ?>" href="galeria.php?lang=de"></a>
            </div>
        </div>
        <div class="text-area">
            <div class="kostka galeria"> </div>
            <div class="tlo">
            </div>
            <div class="mini-menu">
                <a class="mini-menu-uslugi" href="uslugi.php?lang=<?php echo $lang['LANG'];?>"></a>
                <a class="mini-menu-o-firmie" href="o_firmie.php?lang=<?php echo $lang['LANG'];?>"></a>
                <a class="mini-menu-zespol" href="zespol.php?lang=<?php echo $lang['LANG'];?>"></a>
                <a class="mini-menu-kontakt" href="galeria.php?lang=<?php echo $lang['LANG'];?>"></a>
                <a class="mini-menu-galeria active"></a>
            </div>
            <div class="text-field">
                <div class="menu-title"> <?php echo $lang['MENU_GALERIA'];?></div>
            </div>
        </div>
        <div class="stopka"> </div>
    </div>
</div>
</body>
</html>