<?php
require "includes.php";

$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );
$whichSite = "search";

$query = SearchQuery::fromParams($_GET);


$offertype = isset($_GET['tab']) ? $_GET['tab'] : "mieszkania";
$found = $nie->search($query);

?><!DOCTYPE html>
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
        <link rel="stylesheet" href="public/static/css/main.css?cb=<?php cacheBuster(); ?>">
		<link href="public/static/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="public/static/css/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.js"></script>
        <script src="public/static/js/jquery.validate.js"></script>
        <script src="public/static/js/additional-methods.js"></script>
		<script src="public/static/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="public/static/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<script type="text/javascript" src="public/static/js/fancybox/jquery.easing-1.3.pack.js"></script>

	    <script type="text/javascript" src="public/static/js/search_map.js?cb=<?php cacheBuster(); ?>" ></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>


    </head>
    <body class="search-page">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php include('./_header.php'); ?>

        <?php include('./_form.php'); ?>
	
	
	
	
		
        <div class="container offers-container">
                  <span class="offers-list">
<?php
                  foreach( $found as $res ) {
                      /** @var Nieruchomosc $res*/
                      if($res->getDzialTab() == "mieszkania"){
                    echo '
		    <div class="offer" data-date="' . $res->getDatawprowadzenia() . '">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2">' . $res->getPokoje() . ' pok.</div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . substr($res->getDzielnica() . ', ' .  $res->getUlica(), 0, 35) . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                      if($res->getDzialTab() == "domy"){
                          echo '
		    <div class="offer" data-date="' . $res->getDatawprowadzenia() . '">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2">' . $res->getPokoje() . ' pok.</div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . substr($res->getDzielnica() . ', ' .  $res->getUlica(), 0, 35) . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                      if($res->getDzialTab() == "dzialki"){
                          echo '
		    <div class="offer" data-date="' . $res->getDatawprowadzenia() . '">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2"> </div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . substr($res->getMiasto(), 0, 35) . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                      if($res->getDzialTab() == "lokale"){
                          echo '
		    <div class="offer" data-date="' . $res->getDatawprowadzenia() . '">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2"> </div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . substr($res->getDzielnica() . ', ' .  $res->getUlica(), 0, 35) . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                  }
?>
		  </span>
	      <span class="details-container">
          </span>
		</div>

        <span class="shadow2"> </span>
        <span class="shadow"> </span>
        <?php if (count($found) != 0) echo '<div class="container footer"><b>VAN HAUSEN Nieruchomości</b> ul. Mielżyńskiego 16/4, 61-725 Poznań, tel. 61 222 47 60, fax. 61 222 47 61<br/><br/><br/></div>';?>

        <script src="public/static/js/plugins.js"></script>
        <script src="public/static/js/main.js"></script>

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-42732274-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </body>
</html>
