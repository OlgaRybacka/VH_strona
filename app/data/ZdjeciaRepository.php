<?php

class ZdjeciaRepository {
  /**
   * @var PDO
   */
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function insert( Zdjecie $obj ) {
    $prepared = $this->pdo->prepare("INSERT INTO `zdjecie` 
      (`typ`,`kolejnosc`, `nazwa`, `opis`, `url`, `nieruchomosc`)
    VALUES (:typ, :kolejnosc, :nazwa, :opis, :url, :nieruchomosc)");

    $prepared->bindValue( ":typ",          $obj->getTyp() );
    $prepared->bindValue( ":kolejnosc",    $obj->getKolejnosc() );
    $prepared->bindValue( ":nazwa",        $obj->getNazwa() );
    $prepared->bindValue( ":opis",         $obj->getOpis() );
    $prepared->bindValue( ":url",          $obj->getUrl() );
    $prepared->bindValue( ":nieruchomosc", $obj->getNieruchomosc() );
    $prepared->execute();
  }
}
