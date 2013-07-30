<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 20.07.13
 * Time: 19:22
 * To change this template use File | Settings | File Templates.*/

require_once 'swift/swift_required.php';

$imie_nazwisko = (isset($_GET['imie_nazwisko'])) ? $_GET['imie_nazwisko'] : $_POST['imie_nazwisko'];
$temat = (isset($_GET['temat'])) ? $_GET['temat'] : $_POST['temat'];
$tresc = (isset($_GET['tresc'])) ? $_GET['tresc'] : $_POST['tresc'];

// Create the message
$message = Swift_Message::newInstance()

    // Give the message a subject
    ->setSubject($temat)

    // Set the From address with an associative array
    ->setFrom(array('vanhausen@home.pl' => $imie_nazwisko))

    // Set the To addresses with an associative array
    ->setTo(array('biuro@vanhausen.pl'))

    // Give it a body
    ->setBody($tresc ,'text/html')
;


$transport = Swift_MailTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);
$result = $mailer->send($message);


// Send
//mail($email, 'Oferta nr ' . $id , $message, $headers);


?>

    <!DOCTYPE html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv='refresh' content='4;URL=index.php'>
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="public/static/fonts/klavika/MyFontsWebfontsKit.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="public/static/css/normalize.min.css">
    <link rel="stylesheet" href="public/static/css/main.css">
    <link href="public/static/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="public/static/css/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.js"></script>


</head>
<body class="search-page">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<?php include('./_header.php'); ?>

<div class="container" style="padding-top: 50px;">Dziękujemy za Twoją wiadomość.</div>

</body>
</html>