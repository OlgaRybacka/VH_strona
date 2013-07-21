<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 21.07.13
 * Time: 20:17
 * To change this template use File | Settings | File Templates.
 */

$mi = isset($_GET['mieszkanie']) ? $_GET['mieszkanie'] : null;
$do = isset($_GET['dom']) ? $_GET['dom'] : null;
$dz = isset($_GET['dzialka']) ? $_GET['dzialka'] : null;
$lo = isset($_GET['lokal']) ? $_GET['lokal'] : null;
$pass = isset($_GET['pass']) ? $_GET['pass'] : '';

if($mi != null && $do != null && $dz != null && $lo != null && $pass == "bthVH2013")
{
    $fp = fopen("public/wyroznione.txt", "w");
    $noweDane = $mi . " " . $do . " " . $dz . " " . $lo;
    fputs($fp, $noweDane);
    fclose($fp);
}

$fp = fopen("public/wyroznione.txt", "r");
$dane = fread($fp, filesize("public/wyroznione.txt"));
fclose($fp);
$plik = explode(" ", $dane);

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

    <link rel="stylesheet" href="public/static/css/main.css">

    <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
Zmień numery wyróżnionych ofert
<form>
    <label for="mieszkanie">mieszkanie</label><br/>
    <input id="mieszkanie" name="mieszkanie" type="text" value="<?php echo $plik[0];?>"/><br/>
    <label for="dom">dom</label><br/>
    <input id="dom" name="dom" type="text" value="<?php echo $plik[1];?>"/><br/>
    <label for="dzialka">działka</label><br/>
    <input id="dzialka" name="dzialka" type="text" value="<?php echo $plik[2];?>"/><br/>
    <label for="lokal">lokal</label><br/>
    <input id="lokal" name="lokal" type="text" value="<?php echo $plik[3];?>"/><br/><br/>
    <label for="pass">hasło</label><br/>
    <input id="pass" name="pass" type="text"/><br/><br/>
    <input type="submit" value="Zmień wyróżnione oferty" class="change-offers"/>
</form>

</body>
</html>