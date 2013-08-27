<?php

function switchButton() {
	global $whichSite;
    if($whichSite == "search") {
	    echo '<input type="submit" class="search-form button search-mode row5 col3 map-search-button" value=""></input>';
    }
    else if ($whichSite == "map") {
	    echo '<input type="submit" class="search-form button search-mode row5 col3 list-search-button" value=""></input>';
    }
}

function sortPanel() {
	global $found;
	echo '<div class="search-sort">
        sortuj wg
        <div class="styled-select sort-select">
            <select id="sortujWg" name="sortujWg" on>
                <option selected="selected" value="datawprowadzenia desc">data dodania</option>
                <option value="cena">cena</option>
                <option value="cenaM2">cena za m2</option>
            </select>
        </div>
        <div class="liczba_ofert">Liczba niepowtarzalnych ofert: ' . count($found) . '</div>
    </div>';
}
?>
<div class="container search-form">
		<span class="zakladki"><!--
          --><a class="zakladka_mieszkania <?php if ($offertype == "mieszkania") {echo 'active';}?> " href="<?php echo $whichSite?>.php?tab=mieszkania">mieszkania<div class="arrow-right <?php if ($offertype == "mieszkania") {echo 'active';}?> "> </div></a><!--
          --><a class="zakladka_domy <?php if ($offertype == "domy") {echo 'active';}?>" href="<?php echo $whichSite?>.php?tab=domy">domy<div class="arrow-right <?php if ($offertype == "domy") {echo 'active';}?> "> </div></a><!--
          --><a class="zakladka_dzialki <?php if ($offertype == "dzialki") {echo 'active';}?>" href="<?php echo $whichSite?>.php?tab=dzialki">działki<div class="arrow-right <?php if ($offertype == "dzialki") {echo 'active';}?> "> </div></a><!--
          --><a class="zakladka_komercyjne <?php if ($offertype == "lokale") {echo 'active';}?>" href="<?php echo $whichSite?>.php?tab=lokale">lokale komercyjne<div class="arrow-right <?php if ($offertype == "lokale") {echo 'active';}?> "> </div></a><!--
          --></span>
		<form method="get" class="search-form1" <?php if ($offertype == "mieszkania") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
			<input hidden="true" value="mieszkania" name="tab"/>
			<div class="search-form form-label row1 col1">rodzaj oferty
				<div class="arrow-right lila2"></div>
			</div>
			<div class="styled-select">
				<select name="typOferty_mi" class="search-form row1 col2">
					<option value="">sprzedaż</option>
					<option>wynajem</option>
				</select>
			</div>
			<div class="search-form form-label row2 col1">cena nieruchomości [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaMin_mi" name="cenaMin_mi" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
			<input name="cenaMax_mi" id="cenaMax_mi" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
			<div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaM2Min_mi" name="cenaM2Min_mi" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
			<input id="cenaM2Max_mi" name="cenaM2Max_mi" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
			<div class="search-form form-label row4 col1">metraż [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="powierzchniaMin_mi" name="powierzchniaMin_mi" type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
			<datalist id="metraz">
				<option value="10">
				<option value="20">
				<option value="30">
				<option value="40">
				<option value="50">
				<option value="60">
				<option value="70">
				<option value="80">
				<option value="90">
				<option value="100">
				<option value="150">
				<option value="200">
			</datalist>
			<input id="powierzchniaMax_mi" name="powierzchniaMax_mi" type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
			<div class="search-form form-label row5 col1">liczba pokoi [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="pokojeMin_mi" name="pokojeMin_mi" type="text" class="search-form input row5 col2 half" placeholder="np. 2" autocomplete="off" list="pokoje"/>
			<datalist id="pokoje">
				<option value="1">
				<option value="2">
				<option value="3">
				<option value="4">
				<option value="5">
				<option value="6">
				<option value="7">
			</datalist>
			<input id="pokojeMax_mi" name="pokojeMax_mi" type="text" class="search-form input row5 col2a half" placeholder="np. 4" autocomplete="off" list="pokoje"/>
			<div class="search-form form-label row1 col3">typ budynku
				<div class="arrow-right lila2"></div>
			</div>
			<div class="styled-select">
				<select id="typBudynkuMieszk_mi" name="typBudynkuMieszk_mi" class="search-form row1 col4a">
					<option value="">dowolny</option>
					<option>blok</option>
					<option>kamienica</option>
					<option>dom wielorodzinny</option>
					<option>apartamentowiec</option>
					<option>wieżowiec</option>
				</select>
			</div>
			<div class="search-form form-label row2 col3">rok budowy [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="rokbudowyMin_mi" name="rokbudowyMin_mi" type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
			<datalist id="rok_budowy">
				<option value="2012">
				<option value="2011">
				<option value="2010">
				<option value="2009">
				<option value="2008">
				<option value="2005">
				<option value="2000">
				<option value="1995">
				<option value="1990">
				<option value="1980">
				<option value="1970">
				<option value="1960">
			</datalist>
			<input id="rokbudowyMax_mi" name="rokbudowyMax_mi" type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
			<div class="search-form form-label row3 col3" >lokalizacja
				<div class="arrow-right lila2"></div>
			</div>
			<input id="lokalizacja_mi" name="lokalizacja_mi" type="text" class="search-form input row3 col4a" placeholder="np. Nowe Miasto" autocomplete="off" />
			<div class="search-form error_mi row4 col4a"><span></span></div>
			<input type="submit" value="wyszukaj" class="search-form button row5 col4a list-search-button"/>
            <input type="submit" class="search-form button search-mode row5 col3 map-search-button" value="wyszukaj na mapie"/>
			<?php sortPanel(); ?>
		</form>

		<form method="get" class="search-form2" <?php if ($offertype == "domy") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
			<input hidden="true" value="domy" name="tab"/>
			<div class="search-form form-label row1 col1">rodzaj oferty
				<div class="arrow-right lila2"></div>
			</div>
			<div class="styled-select">
				<select id="typOferty_do" name="typOferty_do" class="search-form row1 col2">
					<option value="">sprzedaż</option>
					<option>wynajem</option>
				</select>
			</div>
			<div class="search-form form-label row2 col1">cena nieruchomości [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaMin_do" name="cenaMin_do" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
			<input id="cenaMax_do" name="cenaMax_do" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
			<div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaM2Min_do" name="cenaM2Min_do" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
			<input id="cenaM2Max_do" name="cenaM2Max_do" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
			<div class="search-form form-label row4 col1">metraż [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="powierzchniaMin_do" name="powierzchniaMin_do" type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
			<datalist id="metraz">
				<option value="10">
				<option value="20">
				<option value="30">
				<option value="40">
				<option value="50">
				<option value="60">
				<option value="70">
				<option value="80">
				<option value="90">
				<option value="100">
				<option value="150">
				<option value="200">
			</datalist>
			<input id="powierzchniaMax_do" name="powierzchniaMax_do" type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
			<div class="search-form form-label row5 col1">liczba pokoi [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="pokojeMin_do" name="pokojeMin_do" type="text" class="search-form input row5 col2 half" placeholder="np. 2" autocomplete="off" list="pokoje"/>
			<datalist id="pokoje">
				<option value="1">
				<option value="2">
				<option value="3">
				<option value="4">
				<option value="5">
				<option value="6">
				<option value="7">
			</datalist>
			<input id="pokojeMax_do" name="pokojeMax_do" type="text" class="search-form input row5 col2a half" placeholder="np. 4" autocomplete="off" list="pokoje"/>
			<div class="search-form form-label row1 col3">pow. działki w m<sup>2</sup> [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="powDzialkiMin_do" name="powDzialkiMin_do" type="text" class="search-form input row1 col4 half" placeholder="np. 2000" autocomplete="off" list="pow_dzialki"/>
			<datalist id="pow_dzialki">
				<option value="1000">
				<option value="2000">
				<option value="3000">
				<option value="5000">
				<option value="7500">
				<option value="10000">
				<option value="15000">
				<option value="30000">
				<option value="50000">
				<option value="100000">
			</datalist>
			<input id="powDzialkiMax_do" name="powDzialkiMax_do" type="text" class="search-form input row1 col4a half" placeholder="np. 5000" autocomplete="off" list="pow_dzialki"/>
			<div class="search-form form-label row2 col3">rok budowy [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="rokbudowyMin_do" name="rokbudowyMin_do" type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
			<datalist id="rok_budowy">
				<option value="2012">
				<option value="2011">
				<option value="2010">
				<option value="2009">
				<option value="2008">
				<option value="2005">
				<option value="2000">
				<option value="1995">
				<option value="1990">
				<option value="1980">
				<option value="1970">
				<option value="1960">
			</datalist>
			<input id="rokbudowyMax_do" name="rokbudowyMax_do" type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
			<div class="search-form form-label row3 col3" >lokalizacja
				<div class="arrow-right lila2"></div>
			</div>
			<input id="lokalizacja_do" name="lokalizacja_do" type="text" class="search-form input row3 col4a" placeholder="np. Nowe Miasto" autocomplete="off" />
			<div class="search-form error_do row4 col4a"><span></span></div>
            <input type="submit" value="wyszukaj" class="search-form button row5 col4a list-search-button"/>
            <input type="submit" class="search-form button search-mode row5 col3 map-search-button" value="wyszukaj na mapie"/>
			<?php sortPanel(); ?>
        </form>
		<form method="get" class="search-form3" <?php if ($offertype == "dzialki") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
			<input hidden="true" value="dzialki" name="tab"/>
			<div class="search-form form-label row1 col1">rodzaj oferty
				<div class="arrow-right lila2"></div>
			</div>
			<div class="styled-select">
				<select id="typOferty_dz" name="typOferty_dz" class="search-form row1 col2">
					<option value="">sprzedaż</option>
					<option>wynajem</option>
				</select>
			</div>
			<div class="search-form form-label row2 col1">cena nieruchomości [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaMin_dz" name="cenaMin_dz" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
			<input id="cenaMax_dz" name="cenaMax_dz" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
			<div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaM2Min_dz" name="cenaM2Min_dz" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
			<input id="cenaM2Max_dz" name="cenaM2Max_dz" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
			<div class="search-form form-label row1 col3">powierzchnia w m<sup>2</sup> [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="powierzchniaMin_dz" name="powierzchniaMin_dz" type="text" class="search-form input row1 col4 half" placeholder="np. 10000" autocomplete="off" list="pow_dzialki"/>
			<datalist id="pow_dzialki">
				<option value="1000">
				<option value="2000">
				<option value="3000">
				<option value="5000">
				<option value="7500">
				<option value="10000">
				<option value="15000">
				<option value="30000">
				<option value="50000">
				<option value="100000">
			</datalist>
			<input id="powierzchniaMax_dz" name="powierzchniaMax_dz" type="text" class="search-form input row1 col4a half" placeholder="np. 50000" autocomplete="off" list="pow_dzialki"/>
			<div class="search-form form-label row2 col3" >lokalizacja
				<div class="arrow-right lila2"></div>
			</div>
			<input id="miasto_dz" name="miasto_dz" type="text" class="search-form input row2 col4a" placeholder="np. Nowe Miasto" autocomplete="off" />
			<div class="search-form error_dz row4 col4a"><span></span></div>
            <input type="submit" value="wyszukaj" class="search-form button row5 col4a list-search-button"/>
            <input type="submit" class="search-form button search-mode row5 col3 map-search-button" value="wyszukaj na mapie"/>
			<?php sortPanel(); ?>
        </form>
		<form method="get" class="search-form4" <?php if ($offertype == "lokale") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?>>
			<input hidden="true" value="lokale" name="tab"/>
			<div class="search-form form-label row1 col1">rodzaj oferty
				<div class="arrow-right lila2"></div>
			</div>
			<div class="styled-select">
				<select id="typOferty_lo" name="typOferty_lo" class="search-form row1 col2">
					<option value="">wynajem</option>
                    <option>sprzedaż</option>
				</select>
			</div>
			<div class="search-form form-label row2 col1">cena nieruchomości [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaMin_lo" name="cenaMin_lo" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
			<input id="cenaMax_lo" name="cenaMax_lo" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
			<div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="cenaM2Min_lo" name="cenaM2Min_lo" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
			<input id="cenaM2Max_lo" name="cenaM2Max_lo" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
			<div class="search-form form-label row4 col1">metraż [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="powierzchniaMin_lo" name="powierzchniaMin_lo" type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
			<datalist id="metraz">
				<option value="10">
				<option value="20">
				<option value="30">
				<option value="40">
				<option value="50">
				<option value="60">
				<option value="70">
				<option value="80">
				<option value="90">
				<option value="100">
				<option value="150">
				<option value="200">
			</datalist>
			<input id="powierzchniaMax_lo" name="powierzchniaMax_lo" type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
			<div class="search-form form-label row1 col3">typ lokalu
				<div class="arrow-right lila2"></div>
			</div>
			<div class="styled-select">
				<select id="typLokalu_lo" name="typLokalu_lo" class="search-form row1 col4a">
					<option value="">dowolny</option>
					<option value="handel i usługi/lokal handlowy">handlowy</option>
					<option value="biura/biuro">biurowy</option>
					<option value="magazyny i hale/magazyn">magazynowy</option>
				</select>
			</div>
			<div class="search-form form-label row2 col3">rok budowy [od / do]
				<div class="arrow-right lila2"></div>
			</div>
			<input id="rokbudowyMin_lo" name="rokbudowyMin_lo" type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
			<datalist id="rok_budowy">
				<option value="2012">
				<option value="2011">
				<option value="2010">
				<option value="2009">
				<option value="2008">
				<option value="2005">
				<option value="2000">
				<option value="1995">
				<option value="1990">
				<option value="1980">
				<option value="1970">
				<option value="1960">
			</datalist>
			<input id="rokbudowyMax_lo" name="rokbudowyMax_lo" type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
			<div class="search-form form-label row3 col3" >lokalizacja
				<div class="arrow-right lila2"></div>
			</div>
			<input id="lokalizacja_lo" name="lokalizacja_lo" type="text" class="search-form input row3 col4a" placeholder="np. Nowe Miasto" autocomplete="off" />
			<div class="search-form error_lo row4 col4a"><span></span></div>
            <input type="submit" value="wyszukaj" class="search-form button row5 col4a list-search-button"/>
            <input type="submit" class="search-form button search-mode row5 col3 map-search-button" value="wyszukaj na mapie"/>
			<?php sortPanel(); ?>
        </form>

</div>
