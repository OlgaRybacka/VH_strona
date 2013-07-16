<?php
require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );

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
        <link rel="stylesheet" href="public/static/css/normalize.min.css">
        <link rel="stylesheet" href="public/static/css/main.css">
		<link href="public/static/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="public/static/css/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.js"></script>
		<script src="public/static/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="public/static/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<script type="text/javascript" src="public/static/js/fancybox/jquery.easing-1.3.pack.js"></script>
		<script>
			(function($){
				$(window).load(function(){
					$(".text-text").mCustomScrollbar({scrollButtons:{enable:true}});
					$(".offers-list").mCustomScrollbar({scrollButtons:{enable:true}});
				});
			})(jQuery);

        function getURLParameter(name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
        }
        function search()
        {
            var newURL = "http://alpha.vanhausen.pl/search.php";
            newURL = newURL.concat("?tab=");
            var tab = getURLParameter("tab");
            newURL = newURL.concat(tab);
            if(tab == "mieszkania")
            {
                if (document.getElementsByName('cenaMin_mi')[0].value != '')
                    newURL = newURL.concat("&cenaMin=", document.getElementsByName('cenaMin_mi')[0].value);
                if (document.getElementsByName('cenaMax_mi')[0].value != '')
                    newURL = newURL.concat("&cenaMax=", document.getElementsByName('cenaMax_mi')[0].value);
                if (document.getElementsByName('powierzchniaMin_mi')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMin=", document.getElementsByName('powierzchniaMin_mi')[0].value);
                if (document.getElementsByName('powierzchniaMax_mi')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMax=", document.getElementsByName('powierzchniaMax_mi')[0].value);
            }
            window.location.href = newURL;
        }

		$(function(){
			$(document).ready(function() {
				/*var bmark = getUrlVars()["bookmark"];
				if (bmark == 1) {
					showMieszkania();
				}
				else if (bmark == 2) {
					showDomy();
				}*/
			});

			$("#gallery_button").click(function() {
				$.fancybox([
				'http://farm5.static.flickr.com/4044/4286199901_33844563eb.jpg',
				'http://farm3.static.flickr.com/2687/4220681515_cc4f42d6b9.jpg',
				'http://farm5.static.flickr.com/4005/4213562882_851e92f326.jpg'
				], {
				'padding' : 0,
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'type' : 'image',
				'changeFade' : 0
				});
			}); 
			//$( document ).tooltip();
		});

		$(function() {
			var currentFetchingId = undefined;
			function fetch( id ) {
				currentFetchingId = id;
				$.get("item.php", {
					id: id
				}, function (data) {
					if ( id == currentFetchingId ) {
						$('.details-container').html(data);
						// TODO: enable scroll
					}
				});
			}
			// preload first item
			if( $('.offer-zobacz-button').size() > 0 ) {
				var id = $($('.offer-zobacz-button').get(0)).data('id');
				fetch(id);
			}
			$('.offer-zobacz-button').click(function () {
				var id = $(this).data('id');
				fetch( id );
			});
		});
		</script>
    </head>
    <body class="search-page">
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
				<div class="small-buttons">
					<span class="small-button but1">
						<img src="public/static/./img/but1.png"></img>
					</span><!--
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
        <div class="container search-form">
		<span class="zakladki"><!--
          --><a class="zakladka_mieszkania <?php if ($offertype == "mieszkania") {echo 'active';}?> " href="search.php?tab=mieszkania">mieszkania</a><!--
          --><a class="zakladka_domy <?php if ($offertype == "domy") {echo 'active';}?>" href="search.php?tab=domy">domy</a><!--
          --><a class="zakladka_dzialki <?php if ($offertype == "dzialki") {echo 'active';}?>" href="search.php?tab=dzialki">działki</a><!--
          --><a class="zakladka_komercyjne <?php if ($offertype == "lokale") {echo 'active';}?>" href="search.php?tab=lokale">lokale komercyjne</a><!--
          --></span>
	  <div class="search-form1" <?php if ($offertype == "mieszkania") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
		  <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select class="search-form row1 col2">
			  <option>dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input name="cenaMin_mi" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input name="cenaMax_mi" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input name="cenaM2Min_mi" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input name="cenaM2Max_mi" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row4 col1">metraż [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input name="powierzchniaMin_mi" type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
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
		  <input name="powierzchniaMax_mi" type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
		  <div class="search-form form-label row5 col1">liczba pokoi [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input name="pokojeMin_mi" type="text" class="search-form input row5 col2 half" placeholder="np. 2" autocomplete="off" list="pokoje"/>
		  <datalist id="pokoje">
			<option value="1">
			<option value="2">
			<option value="3">
			<option value="4">
			<option value="5">
			<option value="6">
			<option value="7">
     	          </datalist> 
		  <input  name="pokojeMax_mi" type="text" class="search-form input row5 col2a half" placeholder="np. 4" autocomplete="off" list="pokoje"/>
		  <div class="search-form form-label row1 col3">typ budynku
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select class="search-form row1 col4a">
			  <option>dowolny</option>
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
		  <input type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
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
		  <input type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
		  <div class="search-form form-label row3 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row3 col4a" placeholder="np. Półwiejska" autocomplete="off" />
		  <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
		  <div class="search-form button row5 col4a search-button" onclick="search()"><img src="public/static/./img/search.png"/></div>
	  </div>
	  
	  <div class="search-form2" <?php if ($offertype == "domy") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
		  <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select class="search-form row1 col2">
			  <option>dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row4 col1">metraż [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
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
		  <input type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
		  <div class="search-form form-label row5 col1">liczba pokoi [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row5 col2 half" placeholder="np. 2" autocomplete="off" list="pokoje"/>
		  <datalist id="pokoje">
			<option value="1">
			<option value="2">
			<option value="3">
			<option value="4">
			<option value="5">
			<option value="6">
			<option value="7">
     	          </datalist> 
		  <input type="text" class="search-form input row5 col2a half" placeholder="np. 4" autocomplete="off" list="pokoje"/>
		  <div class="search-form form-label row1 col3">pow. działki w m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row1 col4 half" placeholder="np. 2000" autocomplete="off" list="pow_dzialki"/>
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
		  <input type="text" class="search-form input row1 col4a half" placeholder="np. 5000" autocomplete="off" list="pow_dzialki"/>
		  <div class="search-form form-label row2 col3">rok budowy [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
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
		  <input type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
		  <div class="search-form form-label row3 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row3 col4a" placeholder="np. Półwiejska" autocomplete="off" />
		  <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
		  <div class="search-form button row5 col4a search-button" onclick="search()"><img src="public/static/./img/search.png"/></div>
	  </div>
	  <div class="search-form3" <?php if ($offertype == "dzialki") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
		  <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select class="search-form row1 col2">
			  <option>dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row1 col3">powierzchnia w m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row1 col4 half" placeholder="np. 10000" autocomplete="off" list="pow_dzialki"/>
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
		  <input type="text" class="search-form input row1 col4a half" placeholder="np. 50000" autocomplete="off" list="pow_dzialki"/>
		  <div class="search-form form-label row2 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row2 col4a" placeholder="np. Półwiejska" autocomplete="off" />
		  <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
		  <div class="search-form button row5 col4a search-button" onclick="search()"><img src="public/static/./img/search.png"/></div>
	  </div>
	  <div class="search-form4" <?php if ($offertype == "lokale") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?>>
		  <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select class="search-form row1 col2">
			  <option>dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row4 col1">metraż [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
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
		  <input type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
		  <div class="search-form form-label row1 col3">typ lokalu
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select class="search-form row1 col4a">
			  <option>dowolny</option>
			  <option>handlowy</option>
			  <option>biurowy</option>
			  <option>magazynowy</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col3">rok budowy [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
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
		  <input type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
		  <div class="search-form form-label row3 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input type="text" class="search-form input row3 col4a" placeholder="np. Półwiejska" autocomplete="off" />
		  <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
		  <div class="search-form button row5 col4a search-button" onclick="search()"><img src="public/static/./img/search.png"/></div>
	  </div>
	  
	</div>
	
	
	
	
		
        <div class="container offers-container">
                  <span class="offers-list">
<?php
                  foreach( $found as $res ) {
                      /** @var Nieruchomosc $res*/
                      if($res->getDzialTab() == "mieszkania"){
                    echo '
		    <div class="offer">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2">' . $res->getPokoje() . ' pok.</div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . $res->getDzielnica() . ', ' .  $res->getUlica() . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                      if($res->getDzialTab() == "domy"){
                          echo '
		    <div class="offer">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2">' . $res->getPokoje() . ' pok.</div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . $res->getDzielnica() . ', ' .  $res->getUlica() . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                      if($res->getDzialTab() == "dzialki"){
                          echo '
		    <div class="offer">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2"> </div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . $res->getMiasto() . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                      if($res->getDzialTab() == "lokale"){
                          echo '
		    <div class="offer">
			  <div class="offer-data data1">' . $res->getPowierzchnia(). ' m<sup>2</sup></div>
			  <div class="offer-data data2"> </div>
			  <div class="offer-data data3">' . $res->getCena() . ' zł</div>
			  <div class="offer-skrot">' . $res->getDzielnica() . ', ' .  $res->getUlica() . '</div>
			  <a class="offer-zobacz-button" data-id="' . $res->getId() . '">zobacz</a>
                    </div>';
                      }
                  }
?>
		  </span>
	      <span class="details-container">
          </span>
		</div>



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
