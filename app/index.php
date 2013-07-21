<?php
require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );

$mieszkanie = $nie->tab('mieszkania');
$dom        = $nie->tab('domy')[0];
$dzialka    = $nie->tab('dzialki')[0];
$lokal      = $nie->tab('lokale')[0];

$nieruchomosci = array($mieszkanie[0], $dom, $dzialka, $lokal);
$zdjecie = array();
foreach ( $nieruchomosci as $v ) {
  $zdjecie[$v->getId()] = $zdj->getForNieruchomosc( $v->getId() )[0];
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Van Hausen</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="public/static/fonts/klavika/MyFontsWebfontsKit.css">
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="public/static/css/normalize.min.css">
        <link rel="stylesheet" href="public/static/css/main.css">

        <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body class="home-page">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">
            <header>
                <div class="logo">
					<h1>Van Hausen</h1>
					<img src="public/static/./img/logo.png" />
				</div>
                <div class="slide">
                    <img/>
                </div>
				<div class="small-buttons">
                    <a href="ulubione.php" class="small-button but1">
                        <img src="public/static/./img/but1.png"></img>
                    </a><!--
					--><a href="index.php" class="small-button but2">
						<img src="public/static/./img/but2.png"></img>
					</a><!--
					--><span class="small-button but3">
						<img src="public/static/./img/but3.png"></img>
					</span><!--
					--><span class="small-button but4">
						<img src="public/static/./img/but4.png"></img>
					</span>
				</div>
            </header>
        </div>
        <div class="container tile-height" style="padding-bottom: 1px;">
            <span class="tile violet">
			  <img src="public/static/./img/wyszukaj.png" style="margin-top: 40px"></img>
			  <div class="arrow-right violet"></div>
            </span><!--
            --><span class="tile img1">
            </span><!--
            --><a class="tile violet" href="search.php?tab=mieszkania">
				<img src="public/static/./img/oferty.png" style="margin-top: 65px"></img>
            </a>
        </div>
        <div class="container tile-height">
            <span class="tile gray">
			  <img src="public/static/./img/about.png"></img>
			</span><!--
            --><span class="tile"></span><!--
            --><a class="tile violet" href="search.php?tab=mieszkania">
			  <img src="public/static/./img/mieszkania.png"></img>
              <div class="arrow-down violet"></div>
            </a><!--
            --><a class="tile gray" href="search.php?tab=domy">
              <img src="public/static/./img/domy.png"></img>
              <div class="arrow-down gray"></div>
			</a><!--
            --><a class="tile violet" href="search.php?tab=dzialki">
			  <img src="public/static/./img/dzialki.png"></img>
              <div class="arrow-down violet"></div>
            </a><!--
            --><a class="tile gray" href="search.php?tab=lokale">
			  <img src="public/static/./img/komercyjne.png" style="margin-top: 65px"></img>
              <div class="arrow-down gray"></div>
            </a>
        </div>
        <div class="container aside">
            <span class="span2">
                <p></p>
            </span><!--
            --><span class="span4">
                <div class="offers">
			<div class="oferty_tygodnia">
				<img src="public/static/./img/oferty_tygodnia.png" style="display: block; margin: auto; padding-top:80px"></img>
				<div class="arrow-right violet"></div>
			</div>
<?php foreach( $nieruchomosci as $nieruchomosc) {
	echo '<span class="span1">
				<div class="offer-data">';
                /** @var Nieruchomosc $nieruchomosc */
                if ($nieruchomosc->getDzialTab() == "mieszkania" || $nieruchomosc->getDzialTab() == "domy") {
                echo '<span class="dane_center"><span class="big-number">'. $nieruchomosc->getPowierzchnia().'</span> m<sup>2</sup> / <span class="big-number">' . $nieruchomosc->getPokoje() . '</span> pok.<br/></span>
					<span class="dane_center"><span class="big-number">' . $nieruchomosc->getCena() . '</span> zł</span>
					<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 5px; margin-bottom: 5px"></img>
					<span class="miejsce1 dane_center">' . $nieruchomosc->getDzielnica() .'</span>
					<span class="miejsce2 dane_center">' . $nieruchomosc->getUlica() . '&nbsp;</span>';
				}
                else if ($nieruchomosc->getDzialTab() == "dzialki") {
                    echo '<span class="dane_center"><span class="big-number">'. $nieruchomosc->getPowierzchnia().'</span> m<sup>2</sup><br/></span>
					<span class="dane_center"><span class="big-number">' . $nieruchomosc->getCena() . '</span> zł</span>
					<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 5px; margin-bottom: 5px"></img>
					<span class="miejsce1 dane_center">' . $nieruchomosc->getDzielnica() .'</span>
					<span class="miejsce2 dane_center">' . $nieruchomosc->getUlica() . '&nbsp;</span>';
                }
                else if ($nieruchomosc->getDzialTab() == "lokale") {
                    echo '<span class="dane_center"><span class="big-number">'. $nieruchomosc->getPowierzchnia().'</span> m<sup>2</sup><br/></span>
					<span class="dane_center"><span class="big-number">' . $nieruchomosc->getCena() . '</span> zł</span>
					<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 5px; margin-bottom: 5px"></img>
					<span class="miejsce1 dane_center">' . $nieruchomosc->getDzielnica() .'</span>
					<span class="miejsce2 dane_center">' . $nieruchomosc->getUlica() . '&nbsp;</span>';
                }
				echo
                '</div>
				<img src="' . getUrl($zdjecie[$nieruchomosc->getId()]->getUrl()) . '" style="display: block; margin: auto; margin-top: 5px; width: 148px; height: 111px;"></img>
				<div class="offer-data skrot">
					' . $nieruchomosc->getOpis() . '
				</div>';
                if ($nieruchomosc->getDzialTab() == "mieszkania")
                 echo
				'<div class="offer-data wiecej"><a href="search.php?tab=mieszkania&id=' . $nieruchomosc->getId() . '">więcej...</a></div>
                </span>';
                else  if ($nieruchomosc->getDzialTab() == "domy")
                 echo
                 '<div class="offer-data wiecej"><a href="search.php?tab=domy&id=' . $nieruchomosc->getId() . '">więcej...</a></div>
                </span>';
                else  if ($nieruchomosc->getDzialTab() == "dzialki")
                 echo
                 '<div class="offer-data wiecej"><a href="search.php?tab=dzialki&id=' . $nieruchomosc->getId() . '">więcej...</a></div>
                </span>';
                else  if ($nieruchomosc->getDzialTab() == "lokale")
                 echo
                 '<div class="offer-data wiecej"><a href="search.php?tab=lokale&id=' . $nieruchomosc->getId() . '">więcej...</a></div>
                </span>';

} ?>
		</div>
                <div class="sales">
<?php foreach( $nieruchomosci as $nieruchomosc) {
                    echo '<span class="span1">
			<div class="offer-data status">' . $nieruchomosc->getDzialTyp() . '
			  <div class="arrow-down lila"></div>
			</div>
			<div class="offer-data phone_nr">
			  <img src="public/static/./img/phone.png">' . $nieruchomosc->getAgentTelKom() . '
			</div>
                      </span>';
}
?>
                </div>
            </span>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="public/static/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="public/static/js/plugins.js"></script>
        <script src="public/static/js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
