<?php

class ZdjeciaRepository {
  /**
   * @var PDO
   */
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function update( Zdjecie $obj ) {
    $prepared = $this->pdo->prepare("UPDATE `zdjecie` SET
      `typ` = :typ,`kolejnosc` = :kolejnosc, `opis` = :opis, `url` = :url
      WHERE `nieruchomosc` = :nieruchomosc AND `nazwa` = :nazwa");

    $prepared->bindValue( ":typ",          $obj->getTyp() );
    $prepared->bindValue( ":kolejnosc",    $obj->getKolejnosc() );
    $prepared->bindValue( ":nazwa",        $obj->getNazwa() );
    $prepared->bindValue( ":opis",         $obj->getOpis() );
    $prepared->bindValue( ":url",          $obj->getUrl() );
    $prepared->bindValue( ":nieruchomosc", $obj->getNieruchomosc() );
    $prepared->execute();
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

  public function exists( Zdjecie $z ) {
    $prepared = $this->pdo->prepare("SELECT * FROM `zdjecie` WHERE `nieruchomosc` = :nieruchomosc AND `nazwa` = :nazwa");

    $prepared->bindValue( ":nieruchomosc", $z->getNieruchomosc() );
    $prepared->bindValue( ":nazwa",        $z->getNazwa() );
    $prepared->execute();

    return $prepared->rowCount() > 0;
  }

  public function insertOrUpdate( Zdjecie $z ) {
    if ( $this->exists( $z ) ) {
      $this->update( $z );
    } else {
      $this->insert( $z );
    }
  }

  public function getForNieruchomosc( $id ) {
    $prepared = $this->pdo->prepare("SELECT * FROM `zdjecie` WHERE nieruchomosc = :nieruchomosc");

    $prepared->bindValue( ":nieruchomosc", $id );
    $prepared->execute();

    $results = [];
    $cur = null;
    while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
      $results[] = Zdjecie::fromArray( $cur );
    }
    return $results;
  }
}
