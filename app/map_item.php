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
<div class="offer-details" style="width: 500px;">
		    <div class="basic-info">
                <?php if (count($zdjecia) >= 1) echo '<img src="' . getUrl($zdjecia[0]->getUrl()) . '" class="miniatura" style="float: left;"></img>' ?>
			  <span class="basic-info-text">
			    <span class="dane_center"><span class="big-number"><?php echo $element->getPowierzchnia(); ?></span> m<sup>2</sup> <?php if($element->getDzialTab() == "mieszkania" || $element->getDzialTab() == "domy") echo '/ <span class="big-number">' . $element->getPokoje() . '</span> pok.'; ?> <br/></span>
                <span class="dane_center"><span class="big-number"><?php echo $element->getCena(); ?></span> zł</span>
				<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 10px; margin-bottom: 10px"></img>
				<span class="dane_center"><img src="public/static/./img/phone.png"><span class="big-number"> <?php echo $element->getAgentTelKom(); ?></span></span>
			    <!--
				<div class="status-nr">
				  <span class="status"><?php echo $element->getDzialTyp(); ?></span>
				  <span class="nr"><?php echo $element->getId(); ?></span>
				</div>
				  -->
			  </span>
			</div>
			<div class="offer-description" style="clear: both; padding-top: 10px;">
			  <div class="location"><div class="location-text"><b><?php if ($element->getDzialTab() != "dzialki") echo $element->getDzielnica(); else echo $element->getMiasto(); ?></b><?php if ($element->getDzialTab() != "dzialki") echo ', ' . $element->getUlica(); ?></div></div>
			  <div class="row1">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;"><?php if($element->getDzialTab() == "mieszkania") echo 'typ zabudowy'; else if($element->getDzialTab() == "domy") echo 'powierzchnia działki'; else if($element->getDzialTab() == "lokale") echo 'typ lokalu'; else if($element->getDzialTab() == "dzialki")  echo 'typ działki'; ?></span><br/>
				    <span style="font-size: 14px; font-weight:bold"><?php if($element->getDzialTab() == "mieszkania") echo $element->getTypzabudowy(); else if($element->getDzialTab() == "domy") echo $element->getPowierzchniadzialki() . ' m<sup>2</sup>'; else if($element->getDzialTab() == "lokale") echo $element->getTyplokalu(); else if($element->getDzialTab() == "dzialki") echo $element->getTypdzialki(); ?></span>
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
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . round($element->getCena()/$element->getPowierzchnia()) . ' zł</span>
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
			  <div class="contact-data">
			    <div class="text">
				  <span style="font-size: 10px">KONTAKT I PREZENTACJA:</span><br/>
				  <b><?php echo $element->getAgentNazwisko(); ?></b><br/>
				  tel. <b><?php echo $element->getAgentTelKom(); ?></b><br/>
                  <?php echo $element->getAgentEmail(); ?><br/>
				  <span style="font-size: 10px">odpowiedzialność zawodowa - nr licencji: 9479</span><br/>
				</div>
			  </div>
			</div>
<span class="shadow"> </span>
    <form data-tab="<?php echo $element->getDzialTab(); ?>" data-id="<?php echo $element->getId(); ?>" data-photo="<?php echo getUrl($zdjecia[0]->getUrl())?>" data-opis="<?php echo $element->getOpis(); ?>" data-cena="<?php echo $element->getCena(); ?>" data-typ="<?php echo $element->getDzialTyp(); ?>" data-powierzchnia="<?php echo $element->getPowierzchnia(); ?>" data-agentnazwisko="<?php echo $element->getAgentNazwisko(); ?>" data-agenttelefon="<?php echo $element->getAgentTelKom(); ?>" data-agentemail="<?php echo $element->getAgentEmail(); ?>" class="email-form">
        <label>Podaj adres e-mail, na który chcesz otrzymać ofertę.</label>
        <input name="email_address" id="email_address" type="text"/>
        <div class="anuluj-button"> </div>
        <input type="submit" value="" class="sendemail-button"/>
        <div class="error-container"> </div>
    </form>
</div>
