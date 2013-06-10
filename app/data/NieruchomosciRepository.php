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

  public function insert( Nieruchomosc $obj ) {
    $prepared = $this->pdo->prepare("INSERT INTO `nieruchomosc` " .
        "(". implode(",", array_map(function($x) { return "`${x}`"; }, array_keys($obj->getKeyValueMap()))) . ") " .
      "VALUES (". implode(",", array_map(function($x) { return ":${x}"; }, array_keys($obj->getKeyValueMap()))) . ")");

    foreach ( $obj->getKeyValueMap() as $key => $value ) {
      $prepared->bindValue( ":$key", $value);
    }
    $prepared->execute();
  }
}
