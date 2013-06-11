<?php
/**
 * User: artur
 * Date: 03.06.13
 * Time: 02:02
 */

class NieruchomosciRepository {
  /**
   * @var PDO
   */
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function exists( $id ) {
    $prepared = $this->pdo->prepare("SELECT id FROM `nieruchomosc` WHERE id = :id");
    $prepared->bindValue( ":id", $id );
    $prepared->execute();
    return $prepared->rowCount() > 0;
  }

  public function update( Nieruchomosc $obj ) {
    $map = $obj->getKeyValueMap();
    unset($map['id']);
    $prepared = $this->pdo->prepare("UPDATE `nieruchomosc` SET " .
      implode(",", array_map(function($x) { return " `${x}` = :${x} "; }, array_keys($map))) .
      " WHERE `id` = :id");
    foreach ( $obj->getKeyValueMap() as $key => $value ) {
      $prepared->bindValue( ":$key", $value);
    }
    $prepared->execute();
  }

  public function insert( Nieruchomosc $obj ) {
    $prepared = $this->pdo->prepare("INSERT INTO `nieruchomosc` " .
        "(". implode(",", array_map(function($x) { return "`${x}`"; }, array_keys($obj->getKeyValueMap()))) . ") " .
      "VALUES (". implode(",", array_map(function($x) { return ":${x}"; }, array_keys($obj->getKeyValueMap()))) . ")");

    foreach ( $obj->getKeyValueMap() as $key => $value ) {
      $prepared->bindValue( ":$key", $value);
    }
    $prepared->execute();
  }

  public function insertOrUpdate( Nieruchomosc $obj ) {
    if ( $this->exists($obj->getId()) ) {
      $this->update( $obj );
    } else {
      $this->insert( $obj );
    }
  }

  public function all( ) {
    $prepared = $this->pdo->prepare("SELECT * FROM `nieruchomosc`");
    $prepared->execute();
    $cur = null;
    $result = [];
    while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
      $result[] = Nieruchomosc::fromArray( $cur );
    }
    return $result;
  }

  public function delete( $id ) {
    $prepared = $this->pdo->prepare("DELETE FROM `nieruchomosc` WHERE `id` = :id");
    $prepared->bindValue( ":id", $id );
    $prepared->execute();
  }
}
