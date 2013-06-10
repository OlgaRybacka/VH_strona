<?php
require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );

echo "<ul>";
foreach ( $nie->all() as $n ) {
  echo "<li>";
  echo $n->getId();
  echo "<br/>";
  echo $n->getUlica();
  echo "<br/>";
  echo $n->getDzialTab();
  echo " ";
  echo $n->getDzialTyp();
  echo "<br/>";
  echo $n->getCena();
  echo "<br/>";
  foreach ( $zdj->getForNieruchomosc( $n->getId() ) as $z ) {
    echo "<img style=\"width:200px\" src=\"". getUrl($z->getUrl()) . "\"></img>";
  }
  echo "</li>";
}
echo "</ul>";

