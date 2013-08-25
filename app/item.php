<?php

require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );
$id = (int) $_GET['id'];
$favourites = isset($_GET['f']) ? (bool) $_GET['f'] : false;
$ifAddFavourite = false;
if (isset($_GET['u'])) $ifAddFavourite = true;
$element = $nie->get($id);
$zdjecia = $zdj->getForNieruchomosc( $id );
if ($element == null) {
    die();
}
?>
<span class="offer-details">
		    <div class="basic-info">
                <?php if (count($zdjecia) >= 1) {echo '<a style="background-image:url(' . getUrl($zdjecia[0]->getUrl()) . ')" class="miniatura"> <ul class="gallery-items" style="display: none">';
                    foreach($zdjecia as $z) {
                        echo '<li><img src="' . $z->getUrl() . '"></img></li>';
                    }
                    echo '</ul> </a>';} ?>
                <span class="basic-info-text">
			    <span class="dane_center"><span class="big-number"><?php echo $element->getPowierzchnia(); ?></span> m<sup>2</sup> <?php if($element->getDzialTab() == "mieszkania" || $element->getDzialTab() == "domy") echo '/ <span class="big-number">' . $element->getPokoje() . '</span> pok.'; ?> <br/></span>
                <span class="dane_center"><span class="big-number"><?php echo $element->getCena(); ?></span> zł</span>
				<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 10px; margin-bottom: 10px"></img>
				<span class="dane_center"><img src="public/static/./img/phone.png"><span class="big-number"> <?php if ($element->getAgentTelKom() != null) echo $element->getAgentTelKom(); else echo $element->getAgentTelBiuro() ?></span></span>
			    <div class="status-nr">
				  <span class="status"><?php echo $element->getDzialTyp(); ?></span>
				  <span class="nr"><?php echo $element->getId(); ?></span>
				</div>
			  </span>
			</div>
			<div class="offer-description">
			  <div class="location"><div class="location-text"><b><?php if ($element->getDzialTab() != "dzialki") echo $element->getDzielnica(); else echo $element->getMiasto(); ?></b><?php if ($element->getDzialTab() != "dzialki") echo ', ' . $element->getUlica(); ?></div></div>
			  <div class="row1">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;"><?php if($element->getDzialTab() == "mieszkania") echo 'rok budowy'; else if($element->getDzialTab() == "domy") echo 'powierzchnia działki'; else if($element->getDzialTab() == "lokale") echo 'typ lokalu'; else if($element->getDzialTab() == "dzialki")  echo 'typ działki'; ?></span><br/>
				    <span style="font-size: 14px; font-weight:bold"><?php if($element->getDzialTab() == "mieszkania") echo $element->getRokbudowy(); else if($element->getDzialTab() == "domy") echo $element->getPowierzchniadzialki() . ' m<sup>2</sup>'; else if($element->getDzialTab() == "lokale") echo $element->getTyplokalu(); else if($element->getDzialTab() == "dzialki") echo $element->getTypdzialki(); ?></span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;"><?php if($element->getDzialTab() == "mieszkania") echo 'piętro/pokoje'; else if($element->getDzialTab() == "domy") echo 'kondygnacje/pokoje'; else if($element->getDzialTab() == "lokale") echo 'piętro'; else if($element->getDzialTab() == "dzialki")  echo 'cena zł/m<sup>2</sup>'; ?></span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center"><?php if($element->getDzialTab() == "mieszkania") echo $element->getPietro() . '/' . $element->getPokoje(); else if($element->getDzialTab() == "domy") echo $element->getLiczbapieter() . '/' . $element->getPokoje(); else if($element->getDzialTab() == "lokale") echo $element->getPietro(); else if($element->getDzialTab() == "dzialki") echo round($element->getCena()/$element->getPowierzchnia()) . ' zł'; ?></span>
				  </div>
				</span>
			  </div>
              <?php if ($element->getDzialTab() != "dzialki") {echo '
			  <div class="row2">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;">'; if($element->getDzialTab() == "mieszkania") echo 'forma własności'; else if($element->getDzialTab() == "domy") echo 'powierzchnia domu'; else if($element->getDzialTab() == "lokale") echo 'liczba pomieszczeń'; echo'</span><br/>
				    <span style="font-size: 14px; font-weight:bold">'; if($element->getDzialTab() == "mieszkania") echo $element->getFormaWlasnosci(); else if($element->getDzialTab() == "domy") echo $element->getPowierzchnia() . ' m<sup>2</sup>'; else if($element->getDzialTab() == "lokale") echo $element->getLiczbapomieszczen(); echo'</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">cena zł/m<sup>2</sup></span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">'; if ($element->getPowierzchnia() != 0) echo round($element->getCena()/$element->getPowierzchnia()); else echo '0'; echo ' zł</span>
				  </div>
				</span>
			  </div>';} ?>
			  <span class="offer-text">
			    <span class="text-text">
                    <?php
                    $opis = $element->getOpis();
                    echo stristr($opis, 'kontakt i prezentacja', true);
                    ?>
				</span>
			  </span>
              <?php
              if ($ifAddFavourite) {
			    echo ' <span class="offer-buttons">
			    <a class="offer-button gallery_button" title="Przeglądaj zdjęcia oferty">';

                  echo '<ul class="gallery-items" style="display: none">';
                  foreach($zdjecia as $z) {
                      echo '<li><img src="' . $z->getUrl() . '"></img></li>';
                  }
                  echo '</ul>';
                  echo '<img src="public/static/./img/off_but1.png"></img></a><!--
            --><a class="offer-button" title="Pobierz pdf z ofertą" href="http://pdfmyurl.com?url=' . urlencode( 'http://alpha.vanhausen.pl/offer.php?id='. $id . '&print=1' ) . '"><img src="public/static/./img/off_but3.png"></img></a><!--
            --><a class="offer-button mailto-button" title="Wyślij ofertę na swoją skrzynkę mailową"><img src="public/static/./img/off_but4.png"></img></a><!--
            --><a class="offer-button showmap-button" title="Pokaż ofertę na mapie"><img src="public/static/./img/off_but5.png"></img></a><!--
            --></span>'; }
              else {
              echo ' <span class="offer-buttons">
			    <a class="offer-button gallery_button" title="Przeglądaj zdjęcia oferty">';

                  echo '<ul class="gallery-items" style="display: none">';
                  foreach($zdjecia as $z) {
                      echo '<li><img src="' . $z->getUrl() . '"></img></li>';
                  }
                  echo '</ul>';

                  echo '<img src="public/static/./img/off_but1.png"></img></a><!--
            --><a class="offer-button favourite-button" data-id="' . $element->getId() . '" title="Dodaj do swoich ulubionych ofert, możesz je przejrzeć w każdej chwili."><img src="public/static/./img/off_but2.png"></img></a><!--
            --><a class="offer-button remove-favourite-button" data-id="' . $element->getId() . '" title="Usuń z ulubionych."><img src="public/static/./img/usun.png"></img></a><!--
            --><a class="offer-button" title="Pobierz pdf z ofertą" href="http://pdfmyurl.com?url=' . urlencode( 'http://alpha.vanhausen.pl/offer.php?id='. $id . '&print=1' ) . '"><img src="public/static/./img/off_but3.png"></img></a><!--
            --><a class="offer-button mailto-button" title="Wyślij ofertę na swoją skrzynkę mailową"><img src="public/static/./img/off_but4.png"></img></a><!--
            --><a class="offer-button showmap-button" title="Pokaż ofertę na mapie"><img src="public/static/./img/off_but5.png"></img></a><!--
            --></span>';
              }
              ?>
			  <div class="contact-data">
			    <div class="text">
				  <span style="font-size: 10px">KONTAKT I PREZENTACJA:</span><br/>
				  <b><?php echo $element->getAgentNazwisko(); ?></b><br/>
				  tel. <b><?php if ($element->getAgentTelKom() != null) echo $element->getAgentTelKom(); else echo $element->getAgentTelBiuro() ?></b><br/>
                  <?php echo $element->getAgentEmail(); ?><br/>
				  <span style="font-size: 10px">odpowiedzialność zawodowa - nr licencji: 9479</span><br/>
				</div>
			  </div>
			</div>
		  </span>
<span class="offer-photos">
	<?php if (count($zdjecia) >= 2) {echo '<a style="background-image:url(' . getUrl($zdjecia[1]->getUrl()) . ')" class="gallery_button"> <ul class="gallery-items" style="display: none">';
    foreach($zdjecia as $z) {
        echo '<li><img src="' . $z->getUrl() . '"></img></li>';
    }
    echo '</ul> </a>';} ?>
    <?php if (count($zdjecia) >= 3) {echo '<a style="background-image:url(' . getUrl($zdjecia[2]->getUrl()) . ')" class="gallery_button"> <ul class="gallery-items" style="display: none">';
    foreach($zdjecia as $z) {
        echo '<li><img src="' . $z->getUrl() . '"></img></li>';
    }
    echo '</ul></a>';} ?>
    <?php if (count($zdjecia) >= 4) {echo '<a style="background-image:url(' . getUrl($zdjecia[3]->getUrl()) . ')" class="gallery_button"> <ul class="gallery-items" style="display: none">';
    foreach($zdjecia as $z) {
        echo '<li><img src="' . $z->getUrl() . '"></img></li>';
    }
    echo '</ul></a>';} ?>
    <?php if (count($zdjecia) >= 5) {echo '<a style="background-image:url(' . getUrl($zdjecia[4]->getUrl()) . ')" class="gallery_button"> <ul class="gallery-items" style="display: none">';
    foreach($zdjecia as $z) {
        echo '<li><img src="' . $z->getUrl() . '"></img></li>';
    }
    echo '</ul></a>';} ?>
</span>

<span class="map-span">
    <div class="zamknij-button"> </div>
    <div id="map-canvas" data-lng="<?php echo $element->getLng()?>" data-lat="<?php echo $element->getLat()?>"></div>
</span>
<span>
    <form data-tab="<?php echo $element->getDzialTab(); ?>" data-id="<?php echo $element->getId(); ?>" data-photo="<?php echo getUrl($zdjecia[0]->getUrl())?>" data-opis="<?php echo $element->getOpis(); ?>" data-cena="<?php echo $element->getCena(); ?>" data-typ="<?php echo $element->getDzialTyp(); ?>" data-powierzchnia="<?php echo $element->getPowierzchnia(); ?>" data-agentnazwisko="<?php echo $element->getAgentNazwisko(); ?>" data-agenttelefon="<?php if ($element->getAgentTelKom() != null) echo $element->getAgentTelKom(); else echo $element->getAgentTelBiuro() ?>" data-agentemail="<?php echo $element->getAgentEmail(); ?>" class="email-form">
        <label>Podaj adres e-mail, na który chcesz otrzymać ofertę.</label>
        <input name="email_address" id="email_address" type="text"/>
        <div class="anuluj-button"> </div>
        <input type="submit" value="" class="sendemail-button"/>
        <div class="error-container"> </div>
    </form>
</span>
