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

	/**
	 * @param $pdo
	 */
	public function __construct($pdo) {
    $this->pdo = $pdo;
  }

	/**
	 * @param $id
	 * @return bool
	 */
	public function exists( $id ) {
    $prepared = $this->pdo->prepare("SELECT id FROM `nieruchomosc` WHERE id = :id");
    $prepared->bindValue( ":id", $id );
    $prepared->execute();
    return $prepared->rowCount() > 0;
  }

	/**
	 * @param Nieruchomosc $obj
	 */
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

	/**
	 * @param Nieruchomosc $obj
	 */
	public function insert( Nieruchomosc $obj ) {
    $prepared = $this->pdo->prepare("INSERT INTO `nieruchomosc` " .
        "(". implode(",", array_map(function($x) { return "`${x}`"; }, array_keys($obj->getKeyValueMap()))) . ") " .
      "VALUES (". implode(",", array_map(function($x) { return ":${x}"; }, array_keys($obj->getKeyValueMap()))) . ")");

    foreach ( $obj->getKeyValueMap() as $key => $value ) {
      $prepared->bindValue( ":$key", $value);
    }
    $prepared->execute();
  }

	/**
	 * @param Nieruchomosc $obj
	 */
	public function insertOrUpdate( Nieruchomosc $obj ) {
    if ( $this->exists($obj->getId()) ) {
      $this->update( $obj );
    } else {
      $this->insert( $obj );
    }
  }

	/**
	 * @return Nieruchomosc[]
	 */
	public function all( ) {
    $prepared = $this->pdo->prepare("SELECT * FROM `nieruchomosc`");
    $prepared->execute();
    $cur = null;
    $result = array();
    while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
      $result[] = Nieruchomosc::fromArray( $cur );
    }
    return $result;
  }

	/**
	 * @param $tab
	 * @return array
	 */
	public function tab( $tab ) {
    $prepared = $this->pdo->prepare("SELECT * FROM `nieruchomosc`
      WHERE dzial_tab = :dzial_tab");
    $prepared->bindValue( ":dzial_tab", $tab );
    $prepared->execute();

    $result = array();
    while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
      $result[] = Nieruchomosc::fromArray( $cur );
    }
    return $result;
  }

	/**
	 * @param $id
	 */
	public function delete( $id ) {
    $prepared = $this->pdo->prepare("DELETE FROM `nieruchomosc` WHERE `id` = :id");
    $prepared->bindValue( ":id", $id );
    $prepared->execute();
  }

	/**
	 *
	 */
	public function deleteAll() {
    $prepared = $this->pdo->prepare("DELETE FROM `nieruchomosc`");
    $prepared->execute();
  }

	/**
	 * @param $id
	 * @return Nieruchomosc|null
	 */
	public function get( $id ) {
    $prepared = $this->pdo->prepare("SELECT * FROM `nieruchomosc` WHERE id = :id");
    $prepared->bindValue( ":id", (int) $id );
    $prepared->execute();
    $cur = null;
    while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
      return Nieruchomosc::fromArray( $cur );
    }
    return null;
    }
}
