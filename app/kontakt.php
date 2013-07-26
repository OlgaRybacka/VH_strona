<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 25.07.13
 * Time: 18:39
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
    <title>Van Hausen</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="public/static/fonts/klavika/MyFontsWebfontsKit.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="public/static/css/normalize.min.css">
    <link rel="stylesheet" href="public/static/css/main.css">

    <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body class="contact-page">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<?php include('./_header.php'); ?>

<div class="container contact-container">
    <div class="address-data">
        <b>VAN HAUSEN Nieruchomości</b>
        <br/>ul. Mielżyńskiego 16/4
        <br/>61-725 Poznań
        <br/>tel. 61 222 47 60, fax. 61 222 47 61
    </div>
    <form class="contact-form">
        <div class="col1 row1 form-label">imię i nazwisko<div class="arrow-right"> </div></div>
        <div class="col2 row1"><input name="imie_nazwisko" type="text"/></div>
        <div class="col1 row2 form-label">temat wiadomości<div class="arrow-right"> </div></div>
        <div class="col2 row2"><input name="temat" type="text"/></div>
        <div class="col1 row3 form-label">treść wiadomości<div class="arrow-right"> </div></div>
        <div class="col2 row3"><textarea name="tresc"></textarea></div>
        <input type="submit" value="" class="send-button"/>
    </form>
    <div class="stamp"> </div>
</div>

<div class="container footer"><b>VAN HAUSEN Nieruchomości</b> ul. Mielżyńskiego 16/4, 61-725 Poznań, tel. 61 222 47 60, fax. 61 222 47 61</div>


</body>


<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>