<?php
require "includes.php";

$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );

$found = array();

session_start();

    if (isset($_SESSION['favourites']))
    {
        $toBind = array();
        $queryString = "SELECT * FROM `nieruchomosc`  ";
        $conditions = array();

        foreach($_SESSION['favourites'] as $i => $nr)
        {
                $conditions[] = "id = :Id".$i;
                $toBind[':Id'.$i] = $nr;
        }

        if( sizeof($conditions) != 0 ) {
            $queryString .= "WHERE " . join(" OR ", $conditions );
        }

        $prepared = $pdo->prepare($queryString);
        foreach( $toBind as $key => $value ) {
            $prepared->bindValue($key, $value);
        }
        $prepared->execute();
        $cur = null;
        while( ($cur = $prepared->fetch(PDO::FETCH_ASSOC)) != null ) {
            $found[] = Nieruchomosc::fromArray( $cur );
        }
    }

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
<script src="public/static/js/jquery.validate.js"></script>
<script src="public/static/js/additional-methods.js"></script>
<script src="public/static/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="public/static/js/vendor/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="public/static/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="public/static/js/fancybox/jquery.easing-1.3.pack.js"></script>
<script>

(function($){
    $(window).load(function(){
        $(".offers-list").mCustomScrollbar({scrollButtons:{enable:true}});
    });
})(jQuery);

function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}

function validateEmailForm()
{
    $(".email-form").validate({
        highlight: function(element, errorClass) {
            $(element).css('backgroundColor', '#EDBBBB');
        },
        rules: {
            email_address: {
                required: true,
                email: true
            }
        },
        messages: {
            email_address: {
                required: "Podaj adres email",
                email: "Podaj poprawny adres email"
            }
        },
        errorLabelContainer: $('div.error-container'),
        submitHandler: function(form){
            var id = $(form).data('id');
            var photo = $(form).data('photo');
            var opis = $(form).data('opis');
            var tab = $(form).data('tab');
            var email = $(form).find('#email_address').val();
            var cena = $(form).data('cena');
            var typ = $(form).data('typ');
            var agentnazwisko = $(form).data('agentnazwisko');
            var agenttelefon = $(form).data('agenttelefon');
            var agentemail = $(form).data('agentemail');
            $.post('mailto.php', {id: id, photo: photo, email: email, opis: opis, tab: tab, cena: cena, typ: typ, agentnazwisko: agentnazwisko, agenttelefon: agenttelefon, agentemail: agentemail});
            $('.email-form').fadeOut();
            $('.shadow').fadeOut();
        }
    });
}


$(function() {
    var currentFetchingId = undefined;
    function fetch( id ) {
        currentFetchingId = id;
        $.get("item.php", {
            id: id
        }, function (data) {
            if ( id == currentFetchingId ) {
                $('.details-container').html(data);
                $(".text-text").mCustomScrollbar({scrollButtons:{enable:true}});
            }
        });
    }
    // preload first item
    if( $('.offer-zobacz-button').size() > 0 ) {
        var id;
        if (getURLParameter("id") != null)
            id = getURLParameter("id");
        else
            id = $($('.offer-zobacz-button').get(0)).data('id');
        fetch(id);
    }
    $('.offer-zobacz-button').click(function () {
        var id = $(this).data('id');
        fetch( id );
    });
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

</script>
</head>
<body class="favourites-page">
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
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryba
 * Date: 20.07.13
 * Time: 13:24
 * To change this template use File | Settings | File Templates.
 */