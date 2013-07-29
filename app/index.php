<?php
require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );

$fp = fopen("public/wyroznione.txt", "r");
$dane = fread($fp, filesize("public/wyroznione.txt"));
fclose($fp);
$plik = explode(" ", $dane);

$mieszkanie = $nie->get($plik[0]);
$dom        = $nie->get($plik[1]);
$dzialka    = $nie->get($plik[2]);
$lokal      = $nie->get($plik[3]);

$nieruchomosci = array($mieszkanie, $dom, $dzialka, $lokal);
$zdjecie = array();
foreach ( $nieruchomosci as $v ) {
    if ($v != null)
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
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="public/static/css/normalize.min.css">
        <link rel="stylesheet" href="public/static/css/main.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.js"></script>
        <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="public/static/js/vendor/cookies.js"></script>

        <script>

            $(document).ready(function(){
                if ( Cookies.get('allowCookies') ) return;
                var div = $('<div style="z-index: 100; font-size: 12px; bottom: 0; position:fixed; padding-top: 5px; background: #F5F5F5; border-top: 1px solid rgba(0, 0, 0, 0.15); width: 100%">' +
                    '<span style="margin: 8px 10px 8px 40px;">Ta strona wykorzystuje pliki cookies</span>' +
                    '<a href="#" class="accept-cookie" style="display: inline-block; padding: 2px 10px; margin: 10px 10px; background: none repeat scroll 0 0 #D1ECBE; border: 1px solid #A2BF8E;border-radius: 3px 3px 3px 3px; color: #384C2A;">Akceptuj</a>' +
                    '<a href="http://google.pl" class="reject-cookie" style="display: inline-block; margin: 10px 10px; padding: 2px 10px;background: none repeat scroll 0 0 #ECC1C1; border: 1px solid #CC9C9C;border-radius: 3px 3px 3px 3px; color: #7E5353;">Odrzuć</a>' +
                    '</div>');
                div.find(".accept-cookie").click(function() {
                    div.fadeOut("slow");
                    Cookies.set('allowCookies', true, { expires: 60 * 60 * 24 * 360 * 10 });
                });
                div.appendTo("body");
            });

            $(function() {
                window.setTimeout(slider, 7000);
            });

            function slider() {
                $(".img_slide1").fadeOut(2000);
                $(".img_slide2").fadeIn(2000);
                window.setTimeout(slider2, 7000);
            }

            function slider2() {
                $(".img_slide2").fadeOut(2000);
                $(".img_slide3").fadeIn(2000);
                window.setTimeout(slider3, 7000);
            }

            function slider3() {
                $(".img_slide3").fadeOut(2000);
                $(".img_slide1").fadeIn(2000);
                window.setTimeout(slider, 7000);
            }

        </script>
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
                    <img style="position:absolute; top:0; left:0" class="img_slide1" src="public/static/./img/main_foto.jpg"/>
                    <img style="position:absolute; top:0; left:0; display: none" class="img_slide2" src="public/static/./img/main_foto2.jpg"/>
                    <img style="position:absolute; top:0; left:0; display: none" class="img_slide3" src="public/static/./img/main_foto3.jpg"/>
                </div>
				<div class="small-buttons">
                    <a href="ulubione.php?u=1" title="Przeglądaj ulubione oferty" class="small-button but1">
                        <img src="public/static/./img/but1.png"></img>
                    </a><!--
					--><a href="index.php" title="Powrót do strony głównej" class="small-button but2">
						<img src="public/static/./img/but2.png"></img>
					</a><!--
					--><a href="search.php?tab=mieszkania" title="Wyszukiwarka ofert" class="small-button but3">
						<img src="public/static/./img/but3.png"></img>
					</a><!--
					--><a href="kontakt.php" title="Skontaktuj się z nami" class="small-button but4">
						<img src="public/static/./img/but4.png"></img>
					</a>
				</div>
            </header>
        </div>
        <div class="container tile-height" style="padding-bottom: 1px;">
            <a href="map.php?tab=mieszkania" class="tile violet">
			  <img src="public/static/./img/wyszukaj.png" style="margin-top: 40px"></img>
			  <div class="arrow-right violet"></div>
            </a><!--
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
    if ($nieruchomosc != null)
    {
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
    }

} ?>
		</div>
                <div class="sales">
<?php foreach( $nieruchomosci as $nieruchomosc) {
    if ($nieruchomosc != null)
    {
                        echo '<span class="span1">
                <div class="offer-data status">' . $nieruchomosc->getDzialTyp() . '
                  <div class="arrow-down lila"></div>
                </div>
                <div class="offer-data phone_nr">
                  <img src="public/static/./img/phone.png">' . $nieruchomosc->getAgentTelKom() . '
                </div>
                          </span>';
    }
}
?>
                </div>
            </span>
        </div>
        <div class="container footer"><b>VAN HAUSEN Nieruchomości</b> ul. Mielżyńskiego 16/4, 61-725 Poznań, tel. 61 222 47 60, fax. 61 222 47 61</div>

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
