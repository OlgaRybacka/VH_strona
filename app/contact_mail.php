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
    ->setTo(array('oglu.er@gmail.com'))

    // Give it a body
    ->setBody($tresc ,'text/html')
;


$transport = Swift_MailTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);
$result = $mailer->send($message);



// Send
//mail($email, 'Oferta nr ' . $id , $message, $headers);


?>
