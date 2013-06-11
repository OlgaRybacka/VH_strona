<?php

class Zdjecie {
  private $id;
  private $typ;
  private $kolejnosc;
  private $nazwa;
  private $opis;
  private $url;
  private $nieruchomosc;

  public static function fromDomElement( DOMElement $element ) {
    $zdjecie = new Zdjecie();
    for ( $i = 0; $i < $element->childNodes->length; $i++ ) {
      $child = $element->childNodes->item( $i );
      if ( $child instanceof DOMElement ) {
        if ( $child->tagName == 'id' ) {
          $zdjecie->setNieruchomosc( intval( $child->textContent ) );
        }
        if ( $child->tagName == 'typ' ) {
          $zdjecie->setTyp( trim( $child->textContent ) );
        }
        if ( $child->tagName == 'kolejnosc' ) {
          $zdjecie->setKolejnosc( intval( $child->textContent ) );
        }
        if ( $child->tagName == 'nazwa' ) {
          $zdjecie->setNazwa( trim( $child->textContent ) );
        }
        if ( $child->tagName == 'opis' ) {
          $zdjecie->setOpis( trim( $child->textContent ) );
        }
      }
    }
    return $zdjecie;
  }

  public static function fromArray( array $array ) {
    $n = new Zdjecie();
    foreach( $array as $i => $v ) {
      $n->$i = $v;
    }
    return $n;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setKolejnosc($kolejnosc) {
    $this->kolejnosc = $kolejnosc;
  }

  public function getKolejnosc() {
    return $this->kolejnosc;
  }

  public function setNazwa($nazwa) {
    $this->nazwa = $nazwa;
  }

  public function getNazwa() {
    return $this->nazwa;
  }

  public function setNieruchomosc($nieruchomosc) {
    $this->nieruchomosc = $nieruchomosc;
  }

  public function getNieruchomosc() {
    return $this->nieruchomosc;
  }

  public function setOpis($opis) {
    $this->opis = $opis;
  }

  public function getOpis() {
    return $this->opis;
  }

  public function setTyp($typ) {
    $this->typ = $typ;
  }

  public function getTyp() {
    return $this->typ;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function getUrl() {
    return $this->url;
  }
}
