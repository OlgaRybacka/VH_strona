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


</head>

<body>
<div class="main-container">
    <div class="content">
        <a href="index.php?lang=<?php echo $lang['LANG'];?>"><div class="logo"> </div></a>
        <div class="page-header">
            <div class="lang-buttons">
                <a class="lang_but1 <?php if ($lang['LANG'] == 'pl') echo "active"; ?>" href="uslugi.php?lang=pl"></a>
                <a class="lang_but2 <?php if ($lang['LANG'] == 'en') echo "active"; ?>" href="uslugi.php?lang=en"></a>
                <a class="lang_but3 <?php if ($lang['LANG'] == 'de') echo "active"; ?>" href="uslugi.php?lang=de"></a>
            </div>
        </div>
        <div class="text-area">
            <div class="kostka uslugi"> </div>
            <div class="tlo">
            </div>
            <div class="mini-menu">
                <a class="mini-menu-uslugi active"></a>
                <a class="mini-menu-o-firmie"></a>
                <a class="mini-menu-zespol"></a>
                <a class="mini-menu-kontakt"></a>
                <a class="mini-menu-galeria"></a>
            </div>
            <div class="text-field">
                <div class="menu-title"> <?php echo $lang['MENU_USLUGI'];?></div>
                <div class="content-text"> <?php echo $lang['SERVICES'];?> </div>
            </div>
        </div>
        <div class="stopka"> </div>
    </div>
</div>
</body>
</html>