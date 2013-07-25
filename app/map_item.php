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
                <span class="dane_center"><a href="offer.php?id=<?php echo $element->getId(); ?>&print=0">więcej...</a></span>

				<div class="status-nr">
				  <span class="status"><?php echo $element->getDzialTyp(); ?></span>
				  <span class="nr"><?php echo $element->getId(); ?></span>
				</div>

			  </span>
			</div>
</div>
