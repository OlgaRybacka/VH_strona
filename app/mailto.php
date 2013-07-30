<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 20.07.13
 * Time: 19:22
 * To change this template use File | Settings | File Templates.*/

require_once 'swift/swift_required.php';

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


$message = '<img style="width:400px" src="alpha.vanhausen.pl' . $photo . '" class=""></img>';
$message = '<br/>Link do oferty: <a href="vanhausen.pl/search.php?tab=' . $tab . "&id=" . $id . '">vanhausen.pl/search.php?tab=' . $tab . "&id=" . $id . "</a>";
$message = $message . "<br/><br/>Numer oferty: " . $id;
$message = $message . "<br/><br/>Cena: " . $cena . " zł" . ' (' . $typ . ')';
$message = $message . "<br/><br/>" . stristr($opis, 'kontakt i prezentacja', true);
$message = $message . "<br/><br/>Kontakt i prezentacja:<br/>" . $agentnazwisko . "<br/>tel. " . $agenttelefon . "<br/>email. " . $agentemail;


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: VanHausen <vanhausen@home.pl >' . "\r\n";


// Create the message
$message = Swift_Message::newInstance()

    // Give the message a subject
    ->setSubject('Oferta nr ' . $id)

    // Set the From address with an associative array
    ->setFrom(array('vanhausen@home.pl' => 'VanHausen'))

    // Set the To addresses with an associative array
    ->setTo(array($email))

    // Give it a body
    ->setBody('<img style="width:400px" src="http://alpha.vanhausen.pl' . $photo . '" class=""></img>' . $message, 'text/html')

    // And optionally an alternative body
    ->addPart($message, 'text/plain')

    // Optionally add any attachments
    ->attach(Swift_Attachment::fromPath($photo))
;


$transport = Swift_MailTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);
$result = $mailer->send($message);



// Send
//mail($email, 'Oferta nr ' . $id , $message, $headers);


?>
