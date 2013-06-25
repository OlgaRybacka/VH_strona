<?php

require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );
$id = (int) $_GET['id'];
$favourites = isset($_GET['f']) ? (bool) $_GET['f'] : false;
$element = $nie->get($id);
$zdjecia = $zdj->getForNieruchomosc( $id );
if ($element == null) {
    die();
}
?>
<span class="offer-details">
		    <div class="basic-info">
                <?php echo '<img src="' . getUrl($zdjecia[0]->getUrl()) . '" class="miniatura"></img>' ?>
			  <span class="basic-info-text">
			    <span class="dane_center"><span class="big-number"><?php echo $element->getPowierzchnia(); ?></span> m<sup>2</sup> / <span class="big-number"><?php echo $element->getPokoje(); ?></span> pok.<br/></span>
                <span class="dane_center"><span class="big-number"><?php echo $element->getCena(); ?></span> zł</span>
				<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 10px; margin-bottom: 10px"></img>
				<span class="dane_center"><img src="public/static/./img/phone.png"><span class="big-number"> <?php echo $element->getAgentTelKom(); ?></span></span>
			    <div class="status-nr">
				  <span class="status"><?php echo $element->getDzialTyp(); ?></span>
				  <span class="nr"><?php echo $element->getId(); ?></span>
				</div>
			  </span>
			</div>
			<div class="offer-description">
			  <div class="location"><div class="location-text"><b><?php echo $element->getDzielnica(); ?></b>, <?php echo $element->getUlica(); ?></div></div>
			  <div class="row1">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;">typ zabudowy</span><br/>
				    <span style="font-size: 14px; font-weight:bold"><?php echo $element->getTypzabudowy(); ?></span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">piętro / pokoje</span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center"><?php echo $element->getPietro(); ?>/<?php echo $element->getPokoje(); ?></span>
				  </div>
				</span>
			  </div>
			  <div class="row2">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;">forma własności</span><br/>
				    <span style="font-size: 14px; font-weight:bold"><?php echo $element->getFormaWlasnosci(); ?></span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">cena zł/m<sup>2</sup></span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center"><?php echo round($element->getCena()/$element->getPowierzchnia()); ?> zł</span>
				  </div>
				</span>
			  </div>
			  <span class="offer-text">
			    <span class="text-text">
                    <?php echo $element->getOpis(); ?>
				</span>
			  </span>
              <?php if ($favourites==true) {
              echo ' <span class="offer-buttons">
			    <a class="offer-button" title="Przeglądaj zdjęcia oferty"><img src="./img/off_but1.png"></img></a><!--
            --><a class="offer-button" title="Pobierz pdf z ofertą" href="http://pdfmyurl.com?url=www.onet.pl"><img src="./img/off_but3.png"></img></a><!--
            --><a class="offer-button" title="Wyślij ofertę na swoją skrzynkę mailową"><img src="./img/off_but4.png"></img></a><!--
            --><a class="offer-button" title="Pokaż ofertę na mapie"><img src="./img/off_but5.png"></img></a><!--
            --></span>'; }
              else {
              echo ' <span class="offer-buttons">
			    <a class="offer-button" href="javascript:;" id="gallery_button" title="Przeglądaj zdjęcia oferty"><img src="public/static/./img/off_but1.png"></img></a><!--
            --><a class="offer-button" title="Dodaj do swoich ulubionych ofert, możesz je przejrzeć w każdej chwili."><img src="public/static/./img/off_but2.png"></img></a><!--
            --><a class="offer-button" title="Pobierz pdf z ofertą" href="http://pdfmyurl.com?url=alpha.vanhausen.pl/offer.php?id=<?php echo $id; ?>"><img src="public/static/./img/off_but3.png"></img></a><!--
            --><a class="offer-button" title="Wyślij ofertę na swoją skrzynkę mailową"><img src="public/static/./img/off_but4.png"></img></a><!--
            --><a class="offer-button" title="Pokaż ofertę na mapie"><img src="public/static/./img/off_but5.png"></img></a><!--
            --></span>';
              }
              ?>
			  <div class="contact-data">
			    <div class="text">
				  <span style="font-size: 10px">KONTAKT I PREZENTACJA:</span><br/>
				  <b>Strzesak Mateusz</b> Van Hausen Nieruchomości<br/>
				  tel. <b>897 887 887</b><br/>
				  m.strzesak@vanhausen.pl<br/>
				  <span style="font-size: 10px">odpowiedzialność zawodowa - nr licencji: 12987</span><br/>
				</div>
			  </div>
			</div>
		  </span>
<span class="offer-photos">
	<?php echo '<img src="' . getUrl($zdjecia[0]->getUrl()) . '" class=""></img>' ?>
    <?php echo '<img src="' . getUrl($zdjecia[1]->getUrl()) . '" class=""></img>' ?>
    <?php echo '<img src="' . getUrl($zdjecia[2]->getUrl()) . '" class=""></img>' ?>
    <?php echo '<img src="' . getUrl($zdjecia[3]->getUrl()) . '" class=""></img>' ?>
</span>
