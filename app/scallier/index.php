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

</head>

<body>
<div class="main-container">
    <div class="page-header">
        <div class="lang-buttons">
            <a class="lang_but1" href="index.php?lang=pl"></a>
            <a class="lang_but2" href="index.php?lang=en"></a>
            <a class="lang_but3" href="index.php?lang=de"></a>
        </div>
    </div>
    <?php echo $lang['ABOUT'] . '<br/>' . $lang['SERVICES']; ?>
</div>
</body>
</html>