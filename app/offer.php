<?php

require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );
$id = (int) $_GET['id'];
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
        <link rel="stylesheet" href="public/static/css/normalize.min.css">
        <link rel="stylesheet" href="public/static/css/main.css">
		<link href="public/static/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
		
		<script src="public/static/js/jquery-1.10.1.min.js"></script>
        <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
		
    </head>
    <body class="offer-page">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">
            <header>
                <div class="logo">
					<h1>Van Hausen</h1>
					<img src="public/static/./img/logo_mini.png" ></img>
				</div>
				<span class="violet-line"><img></img></span>
				
            </header>
        </div>
		
		<div class="container offers-container">
      
		  <span class="offer-details">
		    <div class="basic-info">
              <?php echo '<img src="' . getUrl($zdjecia[0]->getUrl()) . '" class="miniatura"></img>' ?>
			  <span class="basic-info-text">
			    <span class="dane_center"><span class="big-number"><?php echo $element->getPowierzchnia(); ?></span> m<sup>2</sup> / <span class="big-number"><?php echo $element->getPokoje(); ?></span> pok.<br/></span>
                <span class="dane_center"><span class="big-number"><?php echo $element->getCena(); ?></span> zł</span>
				<img src="public/static/./img/hor_line.png" style="display: block; margin: auto; margin-top: 10px; margin-bottom: 10px"></img>
				<span class="dane_center"><img src="public/static/./img/phone.png"><span class="big-number"> 603 398 098</span></span>
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
			</div>
			<div class="offer-text">
			    <div class="text-text">
                    <?php echo $element->getOpis(); ?>
					<div class="contact-data">
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
