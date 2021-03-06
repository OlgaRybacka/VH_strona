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
  private $logger;

  /**
   * @param $pdo
   */
  public function __construct($pdo) {
    $this->pdo = $pdo;
    $this->logger = Logger::getLogger("NieruchomosciRepository");;
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
        $sets = array();
    unset($map['id']);
    foreach( array_keys($map) as $x ) {
      $sets[] = " `${x}` = :${x} ";
    }

    $prepared = $this->pdo->prepare("UPDATE `nieruchomosc` SET " .
      implode(",", $sets ) .
      " WHERE `id` = :id");
    foreach ( $obj->getKeyValueMap() as $key => $value ) {
      $prepared->bindValue( ":$key", $value);
    }
    $prepared->execute();
    echo "update " . $prepared->rowCount() . "<br/>\n";
  }

  /**
   * @param Nieruchomosc $obj
   */
  public function insert( Nieruchomosc $obj ) {
  $keys = array();
  $values = array();
  foreach( array_keys($obj->getKeyValueMap()) as $x ){
    $keys[] = "`${x}`";
    $values[] = ":${x}";
  }
    $prepared = $this->pdo->prepare("INSERT INTO `nieruchomosc` " .
        "(". implode(",", $keys) . ") " .
      "VALUES (". implode(",", $values) . ")");

    foreach ( $obj->getKeyValueMap() as $key => $value ) {
      $prepared->bindValue( ":$key", $value);
    }
    $prepared->execute();
    echo "insert " . $obj->getId() . " - " . $obj->getLat() . "<br/>\n";
    echo "insert " . $prepared->rowCount() . "<br/>\n";
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
  public function removeDuplicates() {
      $prepared = $this->pdo->prepare("SELECT  n2.id
            FROM `nieruchomosc` n1
                INNER JOIN `nieruchomosc` n2 ON n1.ulica = n2.ulica AND n1.cena = n2.cena AND n1.powierzchnia = n2.powierzchnia AND n1.miasto = n2.miasto AND n1.id < n2.id");

	  $prepared->execute();
	  $cur = null;
	  $toRemove = array();
	  while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
		  $toRemove[] = $cur['id'];
	  }
	  if( sizeof($toRemove) ) {
		  $implodedList = implode(',', $toRemove);
		  $this->logger->info("Remove " . $implodedList);
		  $prepared = $this->pdo->prepare("DELETE FROM `nieruchomosc` WHERE id in (". $implodedList .")");
		  $prepared->execute();
	  }
  }


  public function search( SearchQuery $query ) {
    $toBind = array();
    $queryString = "SELECT * FROM `nieruchomosc`  ";
    $conditions = array();

      if( $query->getTab() != null ) {
          $conditions[] = " dzial_tab = :Tab";
          $toBind[':Tab'] = $query->getTab();
      }

    if( $query->getCenaM2Max() != null ) {
      $conditions[] = " cena/powierzchnia <= :CenaM2Max";
      $toBind[':CenaM2Max'] = $query->getCenaM2Max();
    }
    if( $query->getCenaM2Min() != null ) {
      $conditions[] = " cena/powierzchnia >= :CenaM2Min";
      $toBind[':CenaM2Min'] = $query->getCenaM2Min();
    }

    if( $query->getCenaMax() != null ) {
      $conditions[] = " cena <= :CenaMax";
      $toBind[':CenaMax'] = $query->getCenaMax();
    }
    if( $query->getCenaMin() != null ) {
      $conditions[] = " cena >= :CenaMin";
      $toBind[':CenaMin'] = $query->getCenaMin();
    }

    if( $query->getPowierzchniaMax() != null ) {
      $conditions[] = " powierzchnia <= :PowierzchniaMax";
      $toBind[':PowierzchniaMax'] = $query->getPowierzchniaMax();
    }
    if( $query->getPowierzchniaMin() != null ) {
      $conditions[] = " powierzchnia >= :PowierzchniaMin";
      $toBind[':PowierzchniaMin'] = $query->getPowierzchniaMin();
    }
    if( $query->getRokbudowyMin() != null ) {
      $conditions[] = " rokbudowy >= :RokBudowyMin";
      $toBind[':RokBudowyMin'] = $query->getRokbudowyMin();
    }
    if( $query->getRokbudowyMax() != null ) {
      $conditions[] = " rokbudowy <= :RokBudowyMax";
      $toBind[':RokBudowyMax'] = $query->getRokbudowyMax();
    }
    if( $query->getTypBudynkuMieszk() != null && $query->getTypBudynkuMieszk() != "dowolny") {
      $conditions[] = " typbudynkumieszk = :TypBudynkuMieszk";
      $toBind[':TypBudynkuMieszk'] = $query->getTypBudynkuMieszk();
    }
    if( $query->getTypOferty() != null ) {
      if ($query->getTypOferty() == "sprzedaż" || $query->getTypOferty() == "sprzedaz")
        $conditions[] = " dzial_typ = 'sprzedaz'";
      else
        $conditions[] = " dzial_typ = 'wynajem'";
    }
    if( $query->getPokojeMax() != null ) {
      $conditions[] = " pokoje <= :PokojeMax";
      $toBind[':PokojeMax'] = $query->getPokojeMax();
    }
    if( $query->getPokojeMin() != null ) {
      $conditions[] = " pokoje >= :PokojeMin";
      $toBind[':PokojeMin'] = $query->getPokojeMin();
    }
    if( $query->getPowDzialkiMax() != null ) {
      $conditions[] = " powierzchniadzialki <= :PowDzialkiMax";
      $toBind[':PowDzialkiMax'] = $query->getPowDzialkiMax();
    }
    if( $query->getPowDzialkiMin() != null ) {
      $conditions[] = " powierzchniadzialki >= :PowDzialkiMin";
      $toBind[':PowDzialkiMin'] = $query->getPowDzialkiMin();
    }
    if( $query->getLokalizacja() != null ) {
      $conditions[] = "(upper(ulica) like upper(:Lokalizacja) OR upper(dzielnica) like upper(:Lokalizacja))";
      $toBind[':Lokalizacja'] = $query->getLokalizacja();
    }
    if( $query->getTypLokalu() != null && $query->getTypLokalu() != "dowolny") {
      $conditions[] = "typlokalu = :typLokalu";
      $toBind[':typLokalu'] = $query->getTypLokalu();
    }
    if( $query->getMiasto() != null ) {
      $conditions[] = "upper(miasto) like upper(:Miasto)";
      $toBind[':Miasto'] = $query->getMiasto();
    }

    if( sizeof($conditions) != 0 ) {
      $queryString .= "WHERE " . join(" and ", $conditions );
    }
    $queryString .= " ORDER BY " . $query->getSortujWg();

    $prepared = $this->pdo->prepare($queryString);
    foreach( $toBind as $key => $value ) {
      $prepared->bindValue($key, $value);
    }
    $prepared->execute();
    $cur = null;
    $result = array();
    while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
      $result[] = Nieruchomosc::fromArray( $cur );
    }
    return $result;
  }
}
