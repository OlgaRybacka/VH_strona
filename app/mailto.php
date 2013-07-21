<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 20.07.13
 * Time: 19:22
 * To change this template use File | Settings | File Templates.*/


$tab = (isset($_GET['tab'])) ? $_GET['tab'] : $_POST['tab'];
$id = (isset($_GET['id'])) ? $_GET['id'] : $_POST['id'];
$photo = (isset($_GET['photo'])) ? $_GET['photo'] : $_POST['photo'];
$opis = (isset($_GET['opis'])) ? $_GET['opis'] : $_POST['opis'];
$email = (isset($_GET['email'])) ? $_GET['email'] : $_POST['email'];
$cena = (isset($_GET['cena'])) ? $_GET['cena'] : $_POST['cena'];
$typ = (isset($_GET['typ'])) ? $_GET['typ'] : $_POST['typ'];
$agentnazwisko = (isset($_GET['agentnazwisko'])) ? $_GET['agentnazwisko'] : $_POST['agentnazwisko'];
$agenttelefon = (isset($_GET['agenttelefon'])) ? $_GET['agenttelefon'] : $_POST['agenttelefon'];
$agentemail = (isset($_GET['agentemail'])) ? $_GET['agentemail'] : $_POST['agentemail'];

$opis = str_replace("</form>", "", $opis);

$message = '<html>
<body>';
$message = $message . '<img style="width:400px" src="alpha.vanhausen.pl/' . $photo . '" class=""></img>';
$message = $message . "<br/>Link do oferty: vanhausen.pl/search.php?tab=" . $tab . "&id=" . $id;
$message = $message . "<br/><br/>Numer oferty: " . $id;
$message = $message . "<br/><br/>Cena: " . $cena . " zł" . ' (' . $typ . ')';
$message = $message . "<br/><br/>" . stristr($opis, 'kontakt i prezentacja', true);
$message = $message . "<br/><br/>Kontakt i prezentacja:<br/>" . $agentnazwisko . "<br/>tel. " . $agenttelefon . "<br/>email. " . $agentemail;
$message = $message . '</body>
</html>';
// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: VanHausen <vanhausen@home.pl >' . "\r\n";

// Send
mail($email, 'Oferta nr ' . $id , $message, $headers);


?>
