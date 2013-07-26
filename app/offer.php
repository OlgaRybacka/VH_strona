<?php

require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );
$id = (int) $_GET['id'];
$print = (int) $_GET['print'];
$element = $nie->get($id);
$zdjecia = $zdj->getForNieruchomosc( $id );

if ($element == null) {
    die();
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
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="public/static/fonts/klavika/MyFontsWebfontsKit.css">
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="public/static/css/normalize.min.css">
        <link rel="stylesheet" href="public/static/css/main.css">
        <link href="public/static/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="public/static/css/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.js"></script>
        <script src="public/static/js/jquery.validate.js"></script>
        <script src="public/static/js/additional-methods.js"></script>
        <script src="public/static/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
        <script type="text/javascript" src="public/static/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="public/static/js/fancybox/jquery.easing-1.3.pack.js"></script>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

        <script>

            $(function() {
                initializeMap();
            });

            $(function() {
                $('.favourite-button').live('click', function() {
                    var id = $(this).data('id');
                    $.post('favourites.php', {id: id});
                });
            });

            $(function() {
                $('.mailto-button').live('click', function() {
                    $('.email-form').fadeIn();
                    $('.shadow').fadeIn();
                    validateEmailForm();
                });
            });

            $(function() {
                $('.shadow').live('click', function() {
                    $('.email-form').fadeOut();
                    $('.shadow').fadeOut();
                });
            });

            $(function() {
                $('.anuluj-button').live('click', function() {
                    $('.email-form').fadeOut();
                    $('.shadow').fadeOut();
                });
            });

            $(function() {
                $('.showmap-button').live('click', function() {
                    $('.map-span').fadeIn();
                    $('.shadow2').fadeIn();
                    google.maps.event.trigger( smallmap, 'resize' );
                    smallmap.setCenter(new google.maps.LatLng(smallmap.getCenter().lat() + 0.004, smallmap.getCenter().lng() - 0.01));
                });
            });

            $(function() {
                $('.shadow2').live('click', function() {
                    $('.map-span').fadeOut();
                    $('.shadow2').fadeOut();
                });
            });

            $(function() {
                $('.zamknij-button').live('click', function() {
                    $('.map-span').fadeOut();
                    $('.shadow2').fadeOut();
                });
            });

            $(function() {
                $(".gallery_button").live("click",function() {
                    var pictures = [];
                    $(this).find('ul.gallery-items > li > img').each(function() {
                        pictures.push($(this).attr('src'));
                    });
                    $.fancybox(pictures, {
                        'padding' : 0,
                        'transitionIn' : 'none',
                        'transitionOut' : 'none',
                        'type' : 'image',
                        'changeFade' : 0
                    });
                });
            });

            var smallmap;

            function initializeMap() {
                var lat = $("#map-canvas").data('lat');
                var lng = $("#map-canvas").data('lng');
                var myLatlng = new google.maps.LatLng(lat, lng)
                var mapOptions = {
                    center: myLatlng,
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                smallmap = new google.maps.Map(document.getElementById("map-canvas"),
                    mapOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: smallmap
                });
            }
        </script>
		
    </head>
    <body class="offer-page">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">
            <header>
                <div class="logo">
					<h1>Van Hausen</h1>
                    <a href="index.php"><img src="public/static/./img/logo_mini.png" ></img></a>
				</div>
                <?php if (!($print)) echo '
                <span class="violet-line"><img></img></span>
                <div class="small-buttons">
                    <a href="ulubione.php?u=1" class="small-button but1">
                        <img src="public/static/./img/but1.png"></img>
                    </a><!--
                            --><a href="index.php" class="small-button but2">
                        <img src="public/static/./img/but2.png"></img>
                    </a><!--
                    --><a href="search.php?tab=mieszkania" class="small-button but3">
                        <img src="public/static/./img/but3.png"></img>
                    </a><!--
                    --><a href="kontakt.php" class="small-button but4">
                        <img src="public/static/./img/but4.png"></img>
                    </a>
                </div>';
                else echo '<span class="violet-line2"><img></img></span>'; ?>
				
            </header>
        </div>
		
		<div class="container offers-container">
      
		  <span class="offer-details">
		    <div class="basic-info">
              <?php echo '<img src="' . getUrl($zdjecia[0]->getUrl()) . '" class="miniatura"></img>' ?>
			  <span class="basic-info-text">
			    <span class="dane_center"><span class="big-number"><?php echo $element->getPowierzchnia(); ?></span> m<sup>2</sup> <?php if($element->getDzialTab() == "mieszkania" || $element->getDzialTab() == "domy") echo '/ <span class="big-number">' . $element->getPokoje() . '</span> pok.'; ?> <br/></span>
                <span class="dane_center"><span class="big-number"><?php echo $element->getCena(); ?></span> zł</span>
				<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 10px; margin-bottom: 10px"></img>
				<span class="dane_center"><img src="public/static/./img/phone.png"><span class="big-number"><?php echo $element->getAgentTelKom() ?></span></span>
			    <div class="status-nr">
				  <span class="status"><?php echo $element->getDzialTyp(); ?></span>
				  <span class="nr"><?php echo $element->getId(); ?></span>
				</div>
			  </span>
			</div>
			<div class="offer-description">
                <div class="location"><div class="location-text"><b><?php if ($element->getDzialTab() != "dzialki") echo $element->getDzielnica(); else echo $element->getMiasto(); ?></b><?php if ($element->getDzialTab() != "dzialki") echo ', ' . $element->getUlica(); ?></div></div>
                <?php
              if ($element->getDzialTab() == "mieszkania") {
                  echo
                      '<div class="row1">
                        <span class="col1">
                          <div class="text">
                            <span style="font-size:12px;">rok budowy</span><br/>
                            <span style="font-size: 14px; font-weight:bold">' . $element->getRokbudowy() . '</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">piętro / pokoje</span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . $element->getPietro() .' / ' . $element->getPokoje() .'</span>
				  </div>
				</span>
			  </div>
			  <div class="row2">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;">forma własności</span><br/>
				    <span style="font-size: 14px; font-weight:bold">' .$element->getFormaWlasnosci() . '</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">cena zł/m<sup>2</sup></span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . round($element->getCena()/$element->getPowierzchnia()) .' zł</span>
				  </div>
				</span>
			  </div>
			</div>';
              }
              else if ($element->getDzialTab() == "domy"){
              echo
              '<div class="row1">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;">powierzchnia działki</span><br/>
				    <span style="font-size: 14px; font-weight:bold">' . $element->getPowierzchniadzialki() . '</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">kondygnacje / pokoje</span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . $element->getLiczbapieter() .' / ' . $element->getPokoje() .'</span>
				  </div>
				</span>
			  </div>
			  <div class="row2">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;">powierzchnia domu</span><br/>
				    <span style="font-size: 14px; font-weight:bold">' .$element->getPowierzchnia() . '</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">cena zł/m<sup>2</sup></span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . round($element->getCena()/$element->getPowierzchnia()) .' zł</span>
				  </div>
				</span>
			  </div>
			</div>'; }
            else if ($element->getDzialTab() == "dzialki") {
                  echo
                      '<div class="row1">
                        <span class="col1">
                          <div class="text">
                            <span style="font-size:12px;">typ działki</span><br/>
                            <span style="font-size: 14px; font-weight:bold">' . $element->getTypdzialki() . '</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">cena za m<sup>2</sup></span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . round($element->getCena()/$element->getPowierzchnia()) .'</span>
				  </div>
				</span>
			  </div>
			</div>';
              }
              else if ($element->getDzialTab() == "lokale") {
                  echo
                      '<div class="row1">
                        <span class="col1">
                          <div class="text">
                            <span style="font-size:12px;">typ lokalu</span><br/>
                            <span style="font-size: 14px; font-weight:bold">' . $element->getTyplokalu() . '</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">piętro</span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . $element->getPietro()  .'</span>
				  </div>
				</span>
			  </div>
			  <div class="row2">
			    <span class="col1">
				  <div class="text">
				    <span style="font-size:12px;">liczba pomieszczeń</span><br/>
				    <span style="font-size: 14px; font-weight:bold">' . $element->getLiczbapomieszczen() . '</span>
				  </div>
				</span>
				<span class="col2">
				  <div class="text">
				    <span style="font-size:12px;">cena zł/m<sup>2</sup></span><br/>
				    <span style="font-size: 14px; font-weight:bold; text-align: center">' . round($element->getCena()/$element->getPowierzchnia()) .' zł</span>
				  </div>
				</span>
			  </div>
			</div>';
              }
              ?>
              <span class="offer-text">
			    <span class="text-text">
                    <?php
                    $opis = $element->getOpis();
                    echo stristr($opis, 'kontakt i prezentacja', true);
                    ?>
                    <div class="contact-data">
                        <div class="text">
                            <span style="font-size: 10px">KONTAKT I PREZENTACJA:</span><br/>
                            <b><?php echo $element->getAgentNazwisko(); ?></b><br/>
                            tel. <b><?php echo $element->getAgentTelKom(); ?></b><br/>
                            <?php echo $element->getAgentEmail(); ?><br/>
                            <span style="font-size: 10px">odpowiedzialność zawodowa - nr licencji: 9479</span><br/>
                        </div>
                    </div>
                    <?php  if(!($print))
                    {
                        echo ' <span class="offer-buttons-container" style="width:100%; position: absolute; background-color:#D1D2D4; display:block; height: 28px; padding-top:3px;"><span class="offer-buttons">
			    <a class="offer-button gallery_button" title="Przeglądaj zdjęcia oferty">';

                    echo '<ul class="gallery-items" style="display: none">';
                    foreach($zdjecia as $z) {
                        echo '<li><img src="' . $z->getUrl() . '"></img></li>';
                    }
                    echo '</ul>';

                    echo '<img src="public/static/./img/off_but1.png"></img></a><!--
            --><a class="offer-button favourite-button" data-id="' . $element->getId() . '" title="Dodaj do swoich ulubionych ofert, możesz je przejrzeć w każdej chwili."><img src="public/static/./img/off_but2.png"></img></a><!--
            --><a class="offer-button" title="Pobierz pdf z ofertą" href="http://pdfmyurl.com?url=' . urlencode( 'http://alpha.vanhausen.pl/offer.php?id='. $id . '&print=1' ) . '"><img src="public/static/./img/off_but3.png"></img></a><!--
            --><a class="offer-button mailto-button" title="Wyślij ofertę na swoją skrzynkę mailową"><img src="public/static/./img/off_but4.png"></img></a><!--
            --><a class="offer-button showmap-button" title="Pokaż ofertę na mapie"><img src="public/static/./img/off_but5.png"></img></a><!--
            --></span></span>';
                    }?>
                    <div class="container footer"><b>VAN HAUSEN Nieruchomości</b> ul. Mielżyńskiego 16/4, 61-725 Poznań, tel. 61 222 47 60, fax. 61 222 47 61</div>

				</span>
			  </span>
		  </span>
		  <span class="offer-photos">
			<?php if (count($zdjecia) >= 1) {echo '<a style="background-image:url(' . getUrl($zdjecia[0]->getUrl()) . ')" class="gallery_button"> <ul class="gallery-items" style="display: none">';
                foreach($zdjecia as $z) {
                    echo '<li><img src="' . $z->getUrl() . '"></img></li>';
                }
                echo '</ul> </a>';} ?>
            <?php if (count($zdjecia) >= 2) {echo '<a style="background-image:url(' . getUrl($zdjecia[1]->getUrl()) . ')" class="gallery_button"> <ul class="gallery-items" style="display: none">';
                foreach($zdjecia as $z) {
                    echo '<li><img src="' . $z->getUrl() . '"></img></li>';
                }
                echo '</ul></a>';} ?>
            <?php if (count($zdjecia) >= 3) {echo '<a style="background-image:url(' . getUrl($zdjecia[2]->getUrl()) . ')" class="gallery_button"> <ul class="gallery-items" style="display: none">';
                foreach($zdjecia as $z) {
                    echo '<li><img src="' . $z->getUrl() . '"></img></li>';
                }
                echo '</ul></a>';} ?>
          </span>
		</div>

        <script src="public/static/js/plugins.js"></script>
        <script src="public/static/js/main.js"></script>

        <span class="shadow2"> </span>
<span class="map-span">
    <div class="zamknij-button"> </div>
    <div id="map-canvas" data-lng="<?php echo $element->getLng()?>" data-lat="<?php echo $element->getLat()?>"></div>
</span>
        <span class="shadow"> </span>
<span>
    <form data-tab="<?php echo $element->getDzialTab(); ?>" data-id="<?php echo $element->getId(); ?>" data-photo="<?php echo getUrl($zdjecia[0]->getUrl())?>" data-opis="<?php echo $element->getOpis(); ?>" data-cena="<?php echo $element->getCena(); ?>" data-typ="<?php echo $element->getDzialTyp(); ?>" data-powierzchnia="<?php echo $element->getPowierzchnia(); ?>" data-agentnazwisko="<?php echo $element->getAgentNazwisko(); ?>" data-agenttelefon="<?php echo $element->getAgentTelKom(); ?>" data-agentemail="<?php echo $element->getAgentEmail(); ?>" class="email-form">
        <label>Podaj adres e-mail, na który chcesz otrzymać ofertę.</label>
        <input name="email_address" id="email_address" type="text"/>
        <div class="anuluj-button"> </div>
        <input type="submit" value="" class="sendemail-button"/>
        <div class="error-container"> </div>
    </form>
</span>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
