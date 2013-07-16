<?php
/**
 * User: artur
 * Date: 16.06.13
 * Time: 18:23
 */

class SearchQuery {
	private static $params = array ("tab", "cenaMin", "cenaMax", "cenaM2Min", "cenaM2Max", "powierzchniaMin", "powierzchniaMax", "rokbudowyMin", "rokbudowyMax" );
    private $tab;
    private $cenaMin;             // float
	private $cenaMax;             // float
	private $cenaM2Min;           // float
	private $cenaM2Max;           // float
	private $powierzchniaMin;     // float
	private $powierzchniaMax;     // float
	private $rokbudowyMin;        // int(11)
	private $rokbudowyMax;

	public static function fromParams( $params ) {
		$query = new SearchQuery();
		foreach ( self::$params as $key ) {
			if( isset( $params[$key] ) ) {
				$query->$key = $params[$key];
			}
		}
		return $query;
	}

    public function setTab($tab) {
        $this->tab = $tab;
    }

    public function getTab() {
        return $this->tab;
    }

	public function setCenaM2Max($cenaM2Max) {
		$this->cenaM2Max = $cenaM2Max;
	}

	public function getCenaM2Max() {
		return $this->cenaM2Max;
	}

	public function setCenaM2Min($cenaM2Min) {
		$this->cenaM2Min = $cenaM2Min;
	}

	public function getCenaM2Min() {
		return $this->cenaM2Min;
	}

	public function setCenaMax($cenaMax) {
		$this->cenaMax = $cenaMax;
	}

	public function getCenaMax() {
		return $this->cenaMax;
	}

	public function setCenaMin($cenaMin) {
		$this->cenaMin = $cenaMin;
	}

	public function getCenaMin() {
		return $this->cenaMin;
	}

	public function setPowierzchniaMax($powierzchniaMax) {
		$this->powierzchniaMax = $powierzchniaMax;
	}

	public function getPowierzchniaMax() {
		return $this->powierzchniaMax;
	}

	public function setPowierzchniaMin($powierzchniaMin) {
		$this->powierzchniaMin = $powierzchniaMin;
	}

	public function getPowierzchniaMin() {
		return $this->powierzchniaMin;
	}

	public function setRokbudowyMax($rokbudowyMax) {
		$this->rokbudowyMax = $rokbudowyMax;
	}

	public function getRokbudowyMax() {
		return $this->rokbudowyMax;
	}

	public function setRokbudowyMin($rokbudowyMin) {
		$this->rokbudowyMin = $rokbudowyMin;
	}

	public function getRokbudowyMin() {
		return $this->rokbudowyMin;
	}        // int(11)
}
