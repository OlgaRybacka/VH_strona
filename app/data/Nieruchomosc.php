<?php
/**
 * User: artur
 * Date: 03.06.13
 * Time: 01:24
 */

function mb_wordwrap_array($string, $width) {
	if (($len = mb_strlen($string, 'UTF-8')) <= $width) {
		return array($string);
	}

	$return = array();
	$last_space = FALSE;
	$i = 0;

	do {
		if (mb_substr($string, $i, 1, 'UTF-8') == ' ') {
			$last_space = $i;
		}
		if ($i > $width) {
			$last_space = ($last_space == 0) ? $width : $last_space;

			$return[] = trim(mb_substr($string, 0, $last_space, 'UTF-8'));
			$string = mb_substr($string, $last_space, $len, 'UTF-8');
			$len = mb_strlen($string, 'UTF-8');
			$i = 0;
		}
		$i++;
	} while ($i < $len);

	$return[] = trim($string);

	return $return;
}

function trim_lines( $string, $width, $lines ) {
	$array = mb_wordwrap_array( $string, $width, $lines);
	$str = '';
	foreach( $array as $i => $line ) {
		$str .= ' ' . $line;
		if ( $i > $lines ) { break; }
	}
	if ( sizeof($array) > $lines ) {
		$str .= ' ...';
	}
	return $str;
}

class Nieruchomosc {
  private $id;               // int(15)     
  private $typzabudowy;      // varchar(255)
  private $powierzchnia;     // float       
  private $pietro;           // int(11)     
  private $pokoje;           // int(11)     
  private $forma_wlasnosci;  // varchar(255)
  private $opis;             // text        
  private $agent_nazwisko;   // varchar(255)
  private $agent_email;      // varchar(255)
  private $agent_tel_biuro;  // varchar(45) 
  private $agent_tel_kom;    // varchar(45) 
  private $agent_skype;      // varchar(45) 
  private $agent_gg;         // varchar(45) 
  private $cena;             // float       
  private $waluta;           // varchar(10)
  private $wojewodztwo;      // varchar(45) 
  private $dzielnica;        // varchar(45) 
  private $ulica;            // varchar(45) 
  private $lat;              // float       
  private $lng;              // float       
  private $dzial_tab;        // varchar(45) 
  private $dzial_typ;        // varchar(45) 
  private $typbudynkumieszk; // varchar(45) 
  private $rokbudowy;        // int(11)     
  private $miasto;           // varchar(45) 
  private $miejscowosc;      // varchar(45) 
  private $kraj;             // varchar(45)

  private $typdzialki;
  private $liczbapomieszczen;
  private $typlokalu;
  private $powierzchniadzialki;
  private $liczbapieter;

  public static function fromDomElement( DOMElement $domElement ) {
    $simple_varchar = array('typdzialki', 'typlokalu', 'kraj', 'miejscowosc', 'miasto', 'typbudynkumieszk', 'ulica', 'dzielnica', 'wojewodztwo'
        , 'agent_gg', 'agent_skype', 'agent_tel_kom', 'agent_tel_biuro', 'agent_email', 'agent_nazwisko', 'forma_wlasnosci', 'typzabudowy' );
    $nieruchomosc = new Nieruchomosc();
    $nieruchomosc->setDzialTab( $domElement->parentNode->getAttribute("tab") );
    $nieruchomosc->setDzialTyp( $domElement->parentNode->getAttribute("typ") );
    for( $i = 0; $i < $domElement->childNodes->length; $i++ ) {
      $child = $domElement->childNodes->item( $i );
      if( $child instanceof DOMElement ) {
        if( $child->tagName == 'param' && in_array( $child->getAttribute('nazwa'), $simple_varchar ) ) {
          $paramName = $child->getAttribute('nazwa');
          $nieruchomosc->$paramName = trim( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'geo_lat' ) {
          $nieruchomosc->lat = floatval( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'geo_lng' ) {
          $nieruchomosc->lng = floatval( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'opis' ) {
          $nieruchomosc->opis = '';
          for ( $j = 0; $j<$child->childNodes->length; $j++ ) {
            $lineNode = $child->childNodes->item($j);
            if ( $lineNode instanceof DOMElement and $lineNode->tagName == 'linia') {
              $nieruchomosc->opis .= $lineNode->textContent . '<br/>';
            }
          }
          if( $nieruchomosc->opis == '' ) {
            $nieruchomosc->opis = $child->textContent;
          }
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'powierzchnia' ) {
          $nieruchomosc->powierzchnia = floatval( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'pietro' ) {
          $nieruchomosc->pietro = intval( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'liczbapokoi' ) {
          $nieruchomosc->pokoje = intval( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'ulica' ) {
          $nieruchomosc->ulica = ( $child->textContent );
        } else if ( $child->tagName == 'id' ) {
          $nieruchomosc->id = intval( $child->textContent );
        } else if ( $child->tagName == 'cena' ) {
          $nieruchomosc->setWaluta( trim( $child->getAttribute('kod') ) );
          $nieruchomosc->setCena( floatval( $child->textContent ) );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'liczbapomieszczen' ) {
          $nieruchomosc->liczbapomieszczen = intval( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'powierzchniadzialki' ) {
          $nieruchomosc->powierzchniadzialki = floatval( $child->textContent );
        } else if ( $child->tagName == 'param' && $child->getAttribute('nazwa') == 'liczbapieter' ) {
          $nieruchomosc->liczbapieter = intval( $child->textContent );
        }
      }
    }
    return $nieruchomosc;
  }

  public static function fromArray( array $array ) {
    $n = new Nieruchomosc();
    foreach( $array as $i => $v ) {
      $n->$i = $v;
    }
    return $n;
  }

  public function setAgentEmail($agent_email) {
    $this->agent_email = $agent_email;
  }

  public function getAgentEmail() {
    return $this->agent_email;
  }

  public function setAgentGg($agent_gg) {
    $this->agent_gg = $agent_gg;
  }

  public function getAgentGg() {
    return $this->agent_gg;
  }

  public function setAgentNazwisko($agent_nazwisko) {
    $this->agent_nazwisko = $agent_nazwisko;
  }

  public function getAgentNazwisko() {
    return $this->agent_nazwisko;
  }

  public function setAgentSkype($agent_skype) {
    $this->agent_skype = $agent_skype;
  }

  public function getAgentSkype() {
    return $this->agent_skype;
  }

  public function setAgentTelBiuro($agent_tel_biuro) {
    $this->agent_tel_biuro = $agent_tel_biuro;
  }

  public function getAgentTelBiuro() {
    return $this->agent_tel_biuro;
  }

  public function setAgentTelKom($agent_tel_kom) {
    $this->agent_tel_kom = $agent_tel_kom;
  }

  public function getAgentTelKom() {
    return $this->agent_tel_kom;
  }

  public function setCena($cena) {
    $this->cena = $cena;
  }

  public function getCena() {
    return $this->cena;
  }

  public function setDzialTab($dzial_tab) {
    $this->dzial_tab = $dzial_tab;
  }

  public function getDzialTab() {
    return $this->dzial_tab;
  }

  public function setDzialTyp($dzial_typ) {
    $this->dzial_typ = $dzial_typ;
  }

  public function getDzialTyp() {
    return $this->dzial_typ;
  }

  public function setDzielnica($dzielnica) {
    $this->dzielnica = $dzielnica;
  }

  public function getDzielnica() {
    return $this->dzielnica;
  }

  public function setFormaWlasnosci($forma_wlasnosci) {
    $this->forma_wlasnosci = $forma_wlasnosci;
  }

  public function getFormaWlasnosci() {
    return $this->forma_wlasnosci;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setKraj($kraj) {
    $this->kraj = $kraj;
  }

  public function getKraj() {
    return $this->kraj;
  }

  public function setLat($lat) {
    $this->lat = $lat;
  }

  public function getLat() {
    return $this->lat;
  }

  public function setLng($lng) {
    $this->lng = $lng;
  }

  public function getLng() {
    return $this->lng;
  }

  public function setMiasto($miasto) {
    $this->miasto = $miasto;
  }

  public function getMiasto() {
    return $this->miasto;
  }

  public function setMiejscowosc($miejscowosc) {
    $this->miejscowosc = $miejscowosc;
  }

  public function getMiejscowosc() {
    return $this->miejscowosc;
  }

  public function setOpis($opis) {
    $this->opis = $opis;
  }

  public function getOpisTrimed() {
    return trim_lines( $this->getOpis(), 20, 5 );
  }

  public function getOpis() {
    return $this->opis;
  }

  public function setPietro($pietro) {
    $this->pietro = $pietro;
  }

  public function getPietro() {
    return $this->pietro;
  }

  public function setPokoje($pokoje) {
    $this->pokoje = $pokoje;
  }

  public function getPokoje() {
    return $this->pokoje;
  }

  public function setPowierzchnia($powierzchnia) {
    $this->powierzchnia = $powierzchnia;
  }

  public function getPowierzchnia() {
    return $this->powierzchnia;
  }

  public function setRokbudowy($rokbudowy) {
    $this->rokbudowy = $rokbudowy;
  }

  public function getRokbudowy() {
    return $this->rokbudowy;
  }

  public function setTypbudynkumieszk($typbudynkumieszk) {
    $this->typbudynkumieszk = $typbudynkumieszk;
  }

  public function getTypbudynkumieszk() {
    return $this->typbudynkumieszk;
  }

  public function setTypzabudowy($typzabudowy) {
    $this->typzabudowy = $typzabudowy;
  }

  public function getTypzabudowy() {
    return $this->typzabudowy;
  }

  public function setUlica($ulica) {
    $this->ulica = $ulica;
  }

  public function getUlica() {
    return $this->ulica;
  }

  public function setWaluta($valuta) {
    $this->waluta = $valuta;
  }

  public function getWaluta() {
    return $this->waluta;
  }

  public function setWojewodztwo($wojewodztwo) {
    $this->wojewodztwo = $wojewodztwo;
  }

  public function getWojewodztwo() {
    return $this->wojewodztwo;
  }
  
  public function getKeyValueMap() {
    return get_object_vars($this);
  }

  public function setLiczbapieter($liczbapieter) {
    $this->liczbapieter = $liczbapieter;
  }

  public function getLiczbapieter() {
    return $this->liczbapieter;
  }

  public function setLiczbapomieszczen($liczbapomieszczen) {
    $this->liczbapomieszczen = $liczbapomieszczen;
  }

  public function getLiczbapomieszczen() {
    return $this->liczbapomieszczen;
  }

  public function setPowierzchniadzialki($powierzchniadzialki) {
    $this->powierzchniadzialki = $powierzchniadzialki;
  }

  public function getPowierzchniadzialki() {
    return $this->powierzchniadzialki;
  }

  public function setTypdzialki($typdzialki) {
    $this->typdzialki = $typdzialki;
  }

  public function getTypdzialki() {
    return $this->typdzialki;
  }

  public function setTyplokalu($typlokalu) {
    $this->typlokalu = $typlokalu;
  }

  public function getTyplokalu() {
    return $this->typlokalu;
  }
}
