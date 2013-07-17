<?php
/**
 * User: artur
 * Date: 16.06.13
 * Time: 18:23
 */

class SearchQuery {
	private static $params = array ("tab", "cenaMin", "cenaMax", "cenaM2Min", "cenaM2Max", "powierzchniaMin", "powierzchniaMax", "rokbudowyMin", "rokbudowyMax", "typBudynkuMieszk", "typOferty", "pokojeMin", "pokojeMax", "lokalizacja", "powDzialkiMin", "powDzialkiMax", "typLokalu", "miasto" );
    private $tab;
    private $cenaMin;             // float
	private $cenaMax;             // float
	private $cenaM2Min;           // float
	private $cenaM2Max;           // float
	private $powierzchniaMin;     // float
	private $powierzchniaMax;     // float
	private $rokbudowyMin;        // int(11)
	private $rokbudowyMax;
    private $typBudynkuMieszk;
    private $typOferty;
    private $pokojeMin;
    private $pokojeMax;
    private $lokalizacja;
    private $powDzialkiMin;
    private $powDzialkiMax;
    private $typLokalu;
    private $miasto;

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

    public function setTypBudynkuMieszk($typBudynkuMieszk) {
        $this->typBudynkuMieszk = $typBudynkuMieszk;
    }

    public function getTypBudynkuMieszk() {
        return $this->typBudynkuMieszk;
    }        // int(11)

    public function setTypOferty($typOferty) {
        $this->typOferty = $typOferty;
    }

    public function getTypOferty() {
        return $this->typOferty;
    }

    public function setPokojeMax($pokojeMax) {
        $this->pokojeMax = $pokojeMax;
    }

    public function getPokojeMax() {
        return $this->pokojeMax;
    }

    public function setPokojeMin($pokojeMin) {
        $this->pokojeMin = $pokojeMin;
    }

    public function getPokojeMin() {
        return $this->pokojeMin;
    }

    public function setLokalizacja($lokalizacja) {
        $this->lokalizacja = $lokalizacja;
    }

    public function getLokalizacja() {
        return $this->lokalizacja;
    }

    public function setMiasto($miasto) {
        $this->miasto = $miasto;
    }

    public function getMiasto() {
        return $this->miasto;
    }

    public function setPowDzialkiMax($powDzialkiMax) {
        $this->powDzialkiMax = $powDzialkiMax;
    }

    public function getPowDzialkiMax() {
        return $this->powDzialkiMax;
    }

    public function setPowDzialkiMin($powDzialkiMin) {
        $this->powDzialkiMin = $powDzialkiMin;
    }

    public function getPowDzialkiMin() {
        return $this->powDzialkiMin;
    }

    public function setTypLokalu($typLokalu) {
        $this->typLokalu = $typLokalu;
    }

    public function getTypLokalu() {
        return $this->typLokalu;
    }
}
