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
	<script type="text/javascript" src="public/static/js/markercluster.js" ></script>
	<script type="text/javascript" src="public/static/js/search_map.js?cb=<?php cacheBuster(); ?>" ></script>

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
        $elements[] = "{" .
            "id:" . $res->getId() . "," .
            "lat:" . ( $res->getLat() ? $res->getLat() : "null" )  . "," .
            "lng:" . ( $res->getLng() ? $res->getLng() : "null" ) . "," .
            "ulica:\"" . addcslashes( $res->getUlica(), '"' ) . "\"," .
            "miasto:\"" . addcslashes( $res->getMiasto(), '"' ) . "\"," .
            "miejscowosc:\"" . addcslashes( $res->getMiejscowosc(), '"' ) . "\"" .
            "}\n";

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
		var map, data, geocoder, markerClusterer, self;
		var mapOptions = {
			zoom: 12,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: new google.maps.LatLng(52.406399, 16.925125)
		}

		function MapView(mapElementId, _data) {
			var self = this;
			map = new google.maps.Map(document.getElementById(mapElementId),mapOptions);
			markerClusterer = new MarkerClusterer(map, [], { zoomOnClick: false });
			data = _data;
			geocoder = new google.maps.Geocoder();
			var markers = [];
			for( var i in data ) {
				var d = data[i];
				if (d.lat && d.lng) {
					markers.push(d);
				} else {
					(function(d) {
						console.log("geocode: " + [d.miasto || d.miejscowosc, d.ulica].join());
						geocoder.geocode({
							address: [d.miasto || d.miejscowosc, d.ulica].join(),
							location: new google.maps.LatLng(52.406189,16.925125),
							region: "Poland"
						}, function(res, status) {
							console.log(status);
							console.log(res);
							if (res && res[0] && res[0].geometry && res[0].geometry.location ) {
								var p = {
									id: d.id,
									lat: res[0].geometry.location.lat(),
									lng: res[0].geometry.location.lng()
								};
								$.post('./update_lat_lng.php', {lat: p.lat, lng:p.lng, id:d.id });
								self.addMarker(p);
							}
						});
					})(d);
				}
			}
			google.maps.event.addListener( markerClusterer, 'clusterclick', function( cluster ) {
				console.log(cluster);
				var markers = cluster.getMarkers();
				self.showInfos( markers );
			});
			self.addMarkers( markers );
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

		MapView.prototype.showInfos = function( markers ) {
			var self = this;
			if(self.infowindow) {
				self.infowindow.close();
				self.infowindow = null;
			}
			var responses = [];
			function show() {
				if(self.infowindow) {
					self.infowindow.close();
					self.infowindow = null;
				}
				var contentString = '';
				for ( var i in responses ) {
					contentString += '<div style="width: 340px; height: 170px; clear: both; position: relative;">' + responses[i] + '</div>';
				}
				contentString = '<div style="width: 360px;">' + contentString + '</div>';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				infowindow.setPosition( markers[0].getPosition() );
				infowindow.open( map );
				self.infowindow = infowindow;
			}
			for( var i in markers ) {
			// pobierz info window
				var marker = markers[i], id = marker.get('point').id;
				$.get("map_item.php?id=" + id, function(contentString) {
					responses.push( $(contentString).html() );
					if( responses.length == markers.length ) {
						show();
					}
				});
			}
		}

		MapView.prototype.addMarker = function(point) {
			var markers = this.addMarkers([point]);
			return markers[0];
		};

		MapView.prototype.addMarkers = function(points) {
			var markers = [];
			var self = this;
			for( var i in points ) {
				var marker = (function(point) {
					var ll;
					console.log(point.lat + " : " + point.lng);
					ll = new google.maps.LatLng(point.lat, point.lng);
					var marker = new google.maps.Marker({
						position: ll,
						map: map,
						draggable: false,
						animation: google.maps.Animation.DROP
					});
					marker.set( 'point', point );
					google.maps.event.addListener(marker, 'click', function() {
						self.showInfo( point.id, marker );
					});
					return marker;
				}) (points[i]);
				markers.push( marker );
			}
			markerClusterer.addMarkers( markers, false );
			return markers;
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
