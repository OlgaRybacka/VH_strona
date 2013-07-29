<?php
require "includes.php";

$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );
$whichSite = "map";

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
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
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

	<script type="text/javascript" src="public/static/js/search_map.js?cb=1" ></script>

</head>
<body class="search-page">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<?php include('./_header.php'); ?>

<?php include('./_form.php'); ?>

<script type="text/javascript">
	window.offers = [
<?php
    $elements = array();
    foreach( $found as $res ) {
        /** @var Nieruchomosc $res */
        if ( $res->getLat() && $res->getLng() ) {
            $elements[] = "{" .
                "id:" . $res->getId() . "," .
                "lat:" . $res->getLat() . "," .
                "lng:" . $res->getLng() . "," .
                "}";
        }
    }
    echo implode(", ", $elements);
 ?>
	];
</script>


<div class="map-wrapper" style=" padding: 50px;">
	<div id="vh-map" style="margin: auto; width: 900px; height: 600px;">
	</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
	console = console || { log: function() {} };
	var MapView;

	MapView = (function() {
		var map, data, geocoder, self;
		var mapOptions = {
			zoom: 12,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: new google.maps.LatLng(52.406399, 16.925125)
		}

		function MapView(mapElementId, _data) {
			var self = this;
			map = new google.maps.Map(document.getElementById(mapElementId),mapOptions);
			data = _data;
			geocoder = new google.maps.Geocoder();
			for( var i in data ) {
				var d = data[i];
				if (d.lat && d.lng) {
					self.addMarker(d);
				} else {
					geocoder.geocode({
						address: [d.miasto || d.miejscowosc, d.ulica].join(),
						location: new google.maps.LatLng(52.406189,16.925125),
						region: "Poland"
					}, function(res, status) {
						console.log(status);
						console.log(res);
						if (res && res.results && res.results[0]) {
							var p = {
								lat: res.results[0].geometry.location.getLat(),
								lng: res.results[0].geometry.location.getLng()
							};
							self.addMarker(p);
						}
					});
				}
			}
		}

		MapView.prototype.showInfo = function( id, marker ) {
			var self = this;
			// pobierz info window
			$.get("map_item.php?id=" + id, function(contentString) {
					if(self.infowindow) {
						self.infowindow.close();
					}
					contentString = $(contentString).html();
					contentString = '<div style="width: 340px;">' + contentString + '</div>'
					var infowindow = new google.maps.InfoWindow({
                        maxWidth: 360,
                        minHeight: 200,
						content: contentString
					});
					infowindow.open(map,marker);
					self.infowindow = infowindow;
				});
		}

		MapView.prototype.addMarker = function(point) {
			var ll;
			var self = this;
			console.log(point.lat + " : " + point.lng);
			ll = new google.maps.LatLng(point.lat, point.lng);
			var marker = new google.maps.Marker({
				position: ll,
				map: map,
				draggable: false,
				animation: google.maps.Animation.DROP
			});
			google.maps.event.addListener(marker, 'click', function() {
				self.showInfo( point.id, marker );
			});
			return marker;
		};

		return MapView;

	})();

	function getData() {
		var llList = [];
		$('.offers-container .offers-list .offer').each(function() {
			var ll = {
				lat: $(this).data('lat'),
				lng: $(this).data('lng'),
				miasto: $(this).data('miasto'),
				ulica: $(this).data('ulica'),
				miejscowosc: $(this).data('miejscowosc')
			};
			if( ll.lat && ll.lng ) {
				llList.push(ll);
			}
		});
		return llList;
	}
	function initialize() {
		var mv = new MapView('vh-map', window.offers);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="container footer" style="top:-40px"><b>VAN HAUSEN Nieruchomości</b> ul. Mielżyńskiego 16/4, 61-725 Poznań, tel. 61 222 47 60, fax. 61 222 47 61</div>


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
