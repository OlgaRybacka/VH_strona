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
                    if (getURLParameter("tab") == "mieszkania")
                    {
                        if (getURLParameter("cenaMin_mi") != '')
                            document.getElementsByName('cenaMin_mi')[0].value = getURLParameter("cenaMin_mi");
                        if (getURLParameter("cenaMax_mi") != '')
                            document.getElementsByName('cenaMax_mi')[0].value = getURLParameter("cenaMax_mi");
                        if (getURLParameter("cenaM2Min_mi") != '')
                            document.getElementsByName('cenaM2Min_mi')[0].value = getURLParameter("cenaM2Min_mi");
                        if (getURLParameter("cenaM2Max_mi") != '')
                            document.getElementsByName('cenaM2Max_mi')[0].value = getURLParameter("cenaM2Max_mi");
                        if (getURLParameter("powierzchniaMin_mi") != '')
                            document.getElementsByName('powierzchniaMin_mi')[0].value = getURLParameter("powierzchniaMin_mi");
                        if (getURLParameter("powierzchniaMax_mi") != '')
                            document.getElementsByName('powierzchniaMax_mi')[0].value = getURLParameter("powierzchniaMax_mi");
                        if (getURLParameter("rokbudowyMin_mi") != '')
                            document.getElementsByName('rokbudowyMin_mi')[0].value = getURLParameter("rokbudowyMin_mi");
                        if (getURLParameter("rokbudowyMax_mi") != '')
                            document.getElementsByName('rokbudowyMax_mi')[0].value = getURLParameter("rokbudowyMax_mi");
                        if (getURLParameter("typBudynkuMieszk_mi") != '')
                            document.getElementsByName('typBudynkuMieszk_mi')[0].value = getURLParameter("typBudynkuMieszk_mi");
                        if (getURLParameter("typOferty_mi") != '')
                            document.getElementsByName('typOferty_mi')[0].value = getURLParameter("typOferty_mi");
                        if (getURLParameter("pokojeMin_mi") != '')
                            document.getElementsByName('pokojeMin_mi')[0].value = getURLParameter("pokojeMin_mi");
                        if (getURLParameter("pokojeMax_mi") != '')
                            document.getElementsByName('pokojeMax_mi')[0].value = getURLParameter("pokojeMax_mi");
                        if (getURLParameter("lokalizacja_mi") != '')
                            document.getElementsByName('lokalizacja_mi')[0].value = getURLParameter("lokalizacja_mi");
                    }
                    else if (getURLParameter("tab") == "domy")
                    {
                        if (getURLParameter("typOferty_do") != '')
                            document.getElementsByName('typOferty_do')[0].value = getURLParameter("typOferty_do");
                        if (getURLParameter("cenaMin_do") != '')
                            document.getElementsByName('cenaMin_do')[0].value = getURLParameter("cenaMin_do");
                        if (getURLParameter("cenaMax_do") != '')
                            document.getElementsByName('cenaMax_do')[0].value = getURLParameter("cenaMax_do");
                        if (getURLParameter("cenaM2Min_do") != '')
                            document.getElementsByName('cenaM2Min_do')[0].value = getURLParameter("cenaM2Min_do");
                        if (getURLParameter("cenaM2Max_do") != '')
                            document.getElementsByName('cenaM2Max_do')[0].value = getURLParameter("cenaM2Max_do");
                        if (getURLParameter("powierzchniaMin_do") != '')
                            document.getElementsByName('powierzchniaMin_do')[0].value = getURLParameter("powierzchniaMin_do");
                        if (getURLParameter("powierzchniaMax_do") != '')
                            document.getElementsByName('powierzchniaMax_do')[0].value = getURLParameter("powierzchniaMax_do");
                        if (getURLParameter("pokojeMin_do") != '')
                            document.getElementsByName('pokojeMin_do')[0].value = getURLParameter("pokojeMin_do");
                        if (getURLParameter("pokojeMax_do") != '')
                            document.getElementsByName('pokojeMax_do')[0].value = getURLParameter("pokojeMax_do");
                        if (getURLParameter("powDzialkiMin_do") != '')
                            document.getElementsByName('powDzialkiMin_do')[0].value = getURLParameter("powDzialkiMin_do");
                        if (getURLParameter("powDzialkiMax_do") != '')
                            document.getElementsByName('powDzialkiMax_do')[0].value = getURLParameter("powDzialkiMax_do");
                        if (getURLParameter("rokbudowyMin_do") != '')
                            document.getElementsByName('rokbudowyMin_do')[0].value = getURLParameter("rokbudowyMin_do");
                        if (getURLParameter("rokbudowyMax_do") != '')
                            document.getElementsByName('rokbudowyMax_do')[0].value = getURLParameter("rokbudowyMax_do");
                        if (getURLParameter("lokalizacja_do") != '')
                            document.getElementsByName('lokalizacja_do')[0].value = getURLParameter("lokalizacja_do");
                    }
                    else if (getURLParameter("tab") == "dzialki")
                    {
                        if (getURLParameter("typOferty_dz") != '')
                            document.getElementsByName('typOferty_dz')[0].value = getURLParameter("typOferty_dz");
                        if (getURLParameter("cenaMin_dz") != '')
                            document.getElementsByName('cenaMin_dz')[0].value = getURLParameter("cenaMin_dz");
                        if (getURLParameter("cenaMax_dz") != '')
                            document.getElementsByName('cenaMax_dz')[0].value = getURLParameter("cenaMax_dz");
                        if (getURLParameter("cenaM2Min_dz") != '')
                            document.getElementsByName('cenaM2Min_dz')[0].value = getURLParameter("cenaM2Min_dz");
                        if (getURLParameter("cenaM2Max_dz") != '')
                            document.getElementsByName('cenaM2Max_dz')[0].value = getURLParameter("cenaM2Max_dz");
                        if (getURLParameter("powierzchniaMin_dz") != '')
                            document.getElementsByName('powierzchniaMin_dz')[0].value = getURLParameter("powierzchniaMin_dz");
                        if (getURLParameter("powierzchniaMax_dz") != '')
                            document.getElementsByName('powierzchniaMax_dz')[0].value = getURLParameter("powierzchniaMax_dz");
                        if (getURLParameter("miasto_dz") != '')
                            document.getElementsByName('miasto_dz')[0].value = getURLParameter("miasto_dz");

                    }
                    else if (getURLParameter("tab") == "lokale")
                    {
                        if (getURLParameter("typOferty_lo") != '')
                            document.getElementsByName('typOferty_lo')[0].value = getURLParameter("typOferty_lo");
                        if (getURLParameter("cenaMin_lo") != '')
                            document.getElementsByName('cenaMin_lo')[0].value = getURLParameter("cenaMin_lo");
                        if (getURLParameter("cenaMax_lo") != '')
                            document.getElementsByName('cenaMax_lo')[0].value = getURLParameter("cenaMax_lo");
                        if (getURLParameter("cenaM2Min_lo") != '')
                            document.getElementsByName('cenaM2Min_lo')[0].value = getURLParameter("cenaM2Min_lo");
                        if (getURLParameter("cenaM2Max_lo") != '')
                            document.getElementsByName('cenaM2Max_lo')[0].value = getURLParameter("cenaM2Max_lo");
                        if (getURLParameter("powierzchniaMin_lo") != '')
                            document.getElementsByName('powierzchniaMin_lo')[0].value = getURLParameter("powierzchniaMin_lo");
                        if (getURLParameter("powierzchniaMax_lo") != '')
                            document.getElementsByName('powierzchniaMax_lo')[0].value = getURLParameter("powierzchniaMax_lo");
                        if (getURLParameter("typLokalu_lo") != '')
                            document.getElementsByName('typLokalu_lo')[0].value = getURLParameter("typLokalu_lo");
                        if (getURLParameter("rokbudowyMin_lo") != '')
                            document.getElementsByName('rokbudowyMin_lo')[0].value = getURLParameter("rokbudowyMin_lo");
                        if (getURLParameter("rokbudowyMax_lo") != '')
                            document.getElementsByName('rokbudowyMax_lo')[0].value = getURLParameter("rokbudowyMax_lo");
                        if (getURLParameter("lokalizacja_lo") != '')
                            document.getElementsByName('lokalizacja_lo')[0].value = getURLParameter("lokalizacja_lo");

                    }
                });
			})(jQuery);

        function getURLParameter(name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
        }

        function validateSearchForm()
        {
            if (getURLParameter("tab") == "mieszkania")
                $(".search-form1").validate({
                    highlight: function(element, errorClass) {
                        $(element).css('backgroundColor', '#EDBBBB');
                    },
                    rules: {
                        cenaMin_mi: {
                            digits: true,
                            lessThanEqual: "#cenaMax_mi"
                        },
                        cenaMax_mi: {
                            digits: true,
                            greaterThanEqual: "#cenaMin_mi"
                        },
                        cenaM2Min_mi: {
                            digits: true,
                            lessThanEqual: "#cenaM2Max_mi"
                        },
                        cenaM2Max_mi: {
                            digits: true,
                            greaterThanEqual: "#cenaM2Min_mi"
                        },
                        powierzchniaMin_mi: {
                            digits: true,
                            lessThanEqual: "#powierzchniaMax_mi"
                        },
                        powierzchniaMax_mi: {
                            digits: true,
                            greaterThanEqual: "#powierzchniaMin_mi"
                        },
                        pokojeMin_mi: {
                            digits: true,
                            lessThanEqual: "#pokojeMax_mi"
                        },
                        pokojeMax_mi: {
                            digits: true,
                            greaterThanEqual: "#pokojeMin_mi"
                        },
                        rokbudowyMin_mi: {
                            minlength: 4,
                            maxlength: 4,
                            digits: true,
                            lessThanEqual: "#rokbudowyMax_mi"
                        },
                        rokbudowyMax_mi: {
                            minlength: 4,
                            maxlength: 4,
                            digits: true,
                            greaterThanEqual: "#rokbudowyMin_mi"
                        }
                    },
                    messages: {
                        cenaMin_mi: "",
                        cenaMax_mi: "",
                        cenaM2Min_mi: "",
                        cenaM2Max_mi: "",
                        powierzchniaMin_mi: "",
                        powierzchniaMax_mi: "",
                        pokojeMin_mi: "",
                        pokojeMax_mi: "",
                        rokbudowyMin_mi: "",
                        rokbudowyMax_mi: ""
                    },
                    invalidHandler: function(event, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            var message = 'Formularz zawiera niepoprawne dane.';
                            $("div.error_mi span").html(message);
                            $("div.error_mi").show();
                        } else {
                            $("div.error_mi").hide();
                        }
                    },
                    submitHandler: search
                });
            else if (getURLParameter("tab") == "domy")
                $(".search-form2").validate({
                    highlight: function(element, errorClass) {
                        $(element).css('backgroundColor', '#EDBBBB');
                    },
                    rules: {
                        cenaMin_do: {
                            digits: true,
                            lessThanEqual: "#cenaMax_do"
                        },
                        cenaMax_do: {
                            digits: true,
                            greaterThanEqual: "#cenaMin_do"
                        },
                        cenaM2Min_do: {
                            digits: true,
                            lessThanEqual: "#cenaM2Max_do"
                        },
                        cenaM2Max_do: {
                            digits: true,
                            greaterThanEqual: "#cenaM2Min_do"
                        },
                        powierzchniaMin_do: {
                            digits: true,
                            lessThanEqual: "#powierzchniaMax_do"
                        },
                        powierzchniaMax_do: {
                            digits: true,
                            greaterThanEqual: "#powierzchniaMin_do"
                        },
                        pokojeMin_do: {
                            digits: true,
                            lessThanEqual: "#pokojeMax_do"
                        },
                        pokojeMax_do: {
                            digits: true,
                            greaterThanEqual: "#pokojeMin_do"
                        },
                        powDzialkiMin_do: {
                            digits: true,
                            lessThanEqual: "#powDzialkiMax_do"
                        },
                        powDzialkiMax_do: {
                            digits: true,
                            greaterThanEqual: "#powDzialkiMin_do"
                        },
                        rokbudowyMin_do: {
                            minlength: 4,
                            maxlength: 4,
                            digits: true,
                            lessThanEqual: "#rokbudowyMax_do"
                        },
                        rokbudowyMax_do: {
                            minlength: 4,
                            maxlength: 4,
                            digits: true,
                            greaterThanEqual: "#rokbudowyMin_do"
                        }
                    },
                    messages: {
                        cenaMin_do: "",
                        cenaMax_do: "",
                        cenaM2Min_do: "",
                        cenaM2Max_do: "",
                        powierzchniaMin_do: "",
                        powierzchniaMax_do: "",
                        pokojeMin_do: "",
                        pokojeMax_do: "",
                        powDzialkiMin_do: "",
                        powDzialkiMax_do: "",
                        rokbudowyMin_do: "",
                        rokbudowyMax_do: ""
                    },
                    invalidHandler: function(event, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            var message = 'Formularz zawiera niepoprawne dane.';
                            $("div.error_do span").html(message);
                            $("div.error_do").show();
                        } else {
                            $("div.error_do").hide();
                        }
                    },
                    submitHandler: search
                });
            else if (getURLParameter("tab") == "dzialki")
                $(".search-form3").validate({
                    highlight: function(element, errorClass) {
                        $(element).css('backgroundColor', '#EDBBBB');
                    },
                    rules: {
                        cenaMin_dz: {
                            digits: true,
                            lessThanEqual: "#cenaMax_dz"
                        },
                        cenaMax_dz: {
                            digits: true,
                            greaterThanEqual: "#cenaMin_dz"
                        },
                        cenaM2Min_dz: {
                            digits: true,
                            lessThanEqual: "#cenaM2Max_dz"
                        },
                        cenaM2Max_dz: {
                            digits: true,
                            greaterThanEqual: "#cenaM2Min_dz"
                        },
                        powierzchniaMin_dz: {
                            digits: true,
                            lessThanEqual: "#powierzchniaMax_dz"
                        },
                        powierzchniaMax_dz: {
                            digits: true,
                            greaterThanEqual: "#powierzchniaMin_dz"
                        }
                    },
                    messages: {
                        cenaMin_dz: "",
                        cenaMax_dz: "",
                        cenaM2Min_dz: "",
                        cenaM2Max_dz: "",
                        powierzchniaMin_dz: "",
                        powierzchniaMax_dz: ""
                    },
                    invalidHandler: function(event, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            var message = 'Formularz zawiera niepoprawne dane.';
                            $("div.error_dz span").html(message);
                            $("div.error_dz").show();
                        } else {
                            $("div.error_dz").hide();
                        }
                    },
                    submitHandler: search
                });
            else if (getURLParameter("tab") == "lokale")
                $(".search-form4").validate({
                    highlight: function(element, errorClass) {
                        $(element).css('backgroundColor', '#EDBBBB');
                    },
                    rules: {
                        cenaMin_lo: {
                            digits: true,
                            lessThanEqual: "#cenaMax_lo"
                        },
                        cenaMax_lo: {
                            digits: true,
                            greaterThanEqual: "#cenaMin_lo"
                        },
                        cenaM2Min_lo: {
                            digits: true,
                            lessThanEqual: "#cenaM2Max_lo"
                        },
                        cenaM2Max_lo: {
                            digits: true,
                            greaterThanEqual: "#cenaM2Min_lo"
                        },
                        powierzchniaMin_lo: {
                            digits: true,
                            lessThanEqual: "#powierzchniaMax_lo"
                        },
                        powierzchniaMax_lo: {
                            digits: true,
                            greaterThanEqual: "#powierzchniaMin_lo"
                        },
                        rokbudowyMin_lo: {
                            minlength: 4,
                            maxlength: 4,
                            digits: true,
                            lessThanEqual: "#rokbudowyMax_lo"
                        },
                        rokbudowyMax_lo: {
                            minlength: 4,
                            maxlength: 4,
                            digits: true,
                            greaterThanEqual: "#rokbudowyMin_lo"
                        }
                    },
                    messages: {
                        cenaMin_lo: "",
                        cenaMax_lo: "",
                        cenaM2Min_lo: "",
                        cenaM2Max_lo: "",
                        powierzchniaMin_lo: "",
                        powierzchniaMax_lo: "",
                        rokbudowyMin_lo: "",
                        rokbudowyMax_lo: ""
                    },
                    invalidHandler: function(event, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            var message = 'Formularz zawiera niepoprawne dane.';
                            $("div.error_lo span").html(message);
                            $("div.error_lo").show();
                        } else {
                            $("div.error_lo").hide();
                        }
                    },
                    submitHandler: search
                });
        }

        $(validateSearchForm);

        function search(form)
        {
            form.submit();
           /* var newURL = "http://alpha.vanhausen.pl/search.php";
            newURL = newURL.concat("?tab=");
            var tab = getURLParameter("tab");
            newURL = newURL.concat(tab);
            if(tab == "mieszkania")
            {
                if (document.getElementsByName('cenaMin_mi')[0].value != '')
                    newURL = newURL.concat("&cenaMin=", document.getElementsByName('cenaMin_mi')[0].value);
                if (document.getElementsByName('cenaMax_mi')[0].value != '')
                    newURL = newURL.concat("&cenaMax=", document.getElementsByName('cenaMax_mi')[0].value);
                if (document.getElementsByName('cenaM2Min_mi')[0].value != '')
                    newURL = newURL.concat("&cenaM2Min=", document.getElementsByName('cenaM2Min_mi')[0].value);
                if (document.getElementsByName('cenaM2Max_mi')[0].value != '')
                    newURL = newURL.concat("&cenaM2Max=", document.getElementsByName('cenaM2Max_mi')[0].value);
                if (document.getElementsByName('powierzchniaMin_mi')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMin=", document.getElementsByName('powierzchniaMin_mi')[0].value);
                if (document.getElementsByName('powierzchniaMax_mi')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMax=", document.getElementsByName('powierzchniaMax_mi')[0].value);
                if (document.getElementsByName('rokbudowyMin_mi')[0].value != '')
                    newURL = newURL.concat("&rokbudowyMin=", document.getElementsByName('rokbudowyMin_mi')[0].value);
                if (document.getElementsByName('rokbudowyMax_mi')[0].value != '')
                    newURL = newURL.concat("&rokbudowyMax=", document.getElementsByName('rokbudowyMax_mi')[0].value);
                if (document.getElementsByName('typBudynkuMieszk_mi')[0].value != 'dowolny')
                    newURL = newURL.concat("&typBudynkuMieszk=", document.getElementsByName('typBudynkuMieszk_mi')[0].value);
                if (document.getElementsByName('typOferty_mi')[0].value != 'dowolna')
                    newURL = newURL.concat("&typOferty=", document.getElementsByName('typOferty_mi')[0].value);
                if (document.getElementsByName('pokojeMin_mi')[0].value != '')
                    newURL = newURL.concat("&pokojeMin=", document.getElementsByName('pokojeMin_mi')[0].value);
                if (document.getElementsByName('pokojeMax_mi')[0].value != '')
                    newURL = newURL.concat("&pokojeMax=", document.getElementsByName('pokojeMax_mi')[0].value);
                if (document.getElementsByName('lokalizacja_mi')[0].value != '')
                    newURL = newURL.concat("&lokalizacja=", document.getElementsByName('lokalizacja_mi')[0].value);

            }
            else if (tab == "domy")
            {
                if (document.getElementsByName('typOferty_do')[0].value != 'dowolna')
                    newURL = newURL.concat("&typOferty=", document.getElementsByName('typOferty_do')[0].value);
                if (document.getElementsByName('cenaMin_do')[0].value != '')
                    newURL = newURL.concat("&cenaMin=", document.getElementsByName('cenaMin_do')[0].value);
                if (document.getElementsByName('cenaMax_do')[0].value != '')
                    newURL = newURL.concat("&cenaMax=", document.getElementsByName('cenaMax_do')[0].value);
                if (document.getElementsByName('cenaM2Min_do')[0].value != '')
                    newURL = newURL.concat("&cenaM2Min=", document.getElementsByName('cenaM2Min_do')[0].value);
                if (document.getElementsByName('cenaM2Max_do')[0].value != '')
                    newURL = newURL.concat("&cenaM2Max=", document.getElementsByName('cenaM2Max_do')[0].value);
                if (document.getElementsByName('powierzchniaMin_do')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMin=", document.getElementsByName('powierzchniaMin_do')[0].value);
                if (document.getElementsByName('powierzchniaMax_do')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMax=", document.getElementsByName('powierzchniaMax_do')[0].value);
                if (document.getElementsByName('pokojeMin_do')[0].value != '')
                    newURL = newURL.concat("&pokojeMin=", document.getElementsByName('pokojeMin_do')[0].value);
                if (document.getElementsByName('pokojeMax_do')[0].value != '')
                    newURL = newURL.concat("&pokojeMax=", document.getElementsByName('pokojeMax_do')[0].value);
                if (document.getElementsByName('powDzialkiMin_do')[0].value != '')
                    newURL = newURL.concat("&powDzialkiMin=", document.getElementsByName('powDzialkiMin_do')[0].value);
                if (document.getElementsByName('powDzialkiMax_do')[0].value != '')
                    newURL = newURL.concat("&powDzialkiMax=", document.getElementsByName('powDzialkiMax_do')[0].value);
                if (document.getElementsByName('rokbudowyMin_do')[0].value != '')
                    newURL = newURL.concat("&rokbudowyMin=", document.getElementsByName('rokbudowyMin_do')[0].value);
                if (document.getElementsByName('rokbudowyMax_do')[0].value != '')
                    newURL = newURL.concat("&rokbudowyMax=", document.getElementsByName('rokbudowyMax_do')[0].value);
                if (document.getElementsByName('lokalizacja_do')[0].value != '')
                    newURL = newURL.concat("&lokalizacja=", document.getElementsByName('lokalizacja_do')[0].value);
            }
            else if (tab == "dzialki")
            {
                if (document.getElementsByName('typOferty_dz')[0].value != 'dowolna')
                    newURL = newURL.concat("&typOferty=", document.getElementsByName('typOferty_dz')[0].value);
                if (document.getElementsByName('cenaMin_dz')[0].value != '')
                    newURL = newURL.concat("&cenaMin=", document.getElementsByName('cenaMin_dz')[0].value);
                if (document.getElementsByName('cenaMax_dz')[0].value != '')
                    newURL = newURL.concat("&cenaMax=", document.getElementsByName('cenaMax_dz')[0].value);
                if (document.getElementsByName('cenaM2Min_dz')[0].value != '')
                    newURL = newURL.concat("&cenaM2Min=", document.getElementsByName('cenaM2Min_dz')[0].value);
                if (document.getElementsByName('cenaM2Max_dz')[0].value != '')
                    newURL = newURL.concat("&cenaM2Max=", document.getElementsByName('cenaM2Max_dz')[0].value);
                if (document.getElementsByName('powDzialkiMin_dz')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMin=", document.getElementsByName('powDzialkiMin_dz')[0].value);
                if (document.getElementsByName('powDzialkiMax_dz')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMax=", document.getElementsByName('powDzialkiMax_dz')[0].value);
                if (document.getElementsByName('lokalizacja_dz')[0].value != '')
                    newURL = newURL.concat("&miasto=", document.getElementsByName('lokalizacja_dz')[0].value);
            }
            else if (tab == "lokale")
            {
                if (document.getElementsByName('typOferty_lo')[0].value != 'dowolna')
                    newURL = newURL.concat("&typOferty=", document.getElementsByName('typOferty_lo')[0].value);
                if (document.getElementsByName('cenaMin_lo')[0].value != '')
                    newURL = newURL.concat("&cenaMin=", document.getElementsByName('cenaMin_lo')[0].value);
                if (document.getElementsByName('cenaMax_lo')[0].value != '')
                    newURL = newURL.concat("&cenaMax=", document.getElementsByName('cenaMax_lo')[0].value);
                if (document.getElementsByName('cenaM2Min_lo')[0].value != '')
                    newURL = newURL.concat("&cenaM2Min=", document.getElementsByName('cenaM2Min_lo')[0].value);
                if (document.getElementsByName('cenaM2Max_lo')[0].value != '')
                    newURL = newURL.concat("&cenaM2Max=", document.getElementsByName('cenaM2Max_lo')[0].value);
                if (document.getElementsByName('powierzchniaMin_lo')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMin=", document.getElementsByName('powierzchniaMin_lo')[0].value);
                if (document.getElementsByName('powierzchniaMax_lo')[0].value != '')
                    newURL = newURL.concat("&powierzchniaMax=", document.getElementsByName('powierzchniaMax_lo')[0].value);
                if (document.getElementsByName('typLokalu_lo')[0].value != 'dowolny')
                    newURL = newURL.concat("&typLokalu=", document.getElementsByName('typLokalu_lo')[0].value);
                if (document.getElementsByName('rokbudowyMin_lo')[0].value != '')
                    newURL = newURL.concat("&rokbudowyMin=", document.getElementsByName('rokbudowyMin_lo')[0].value);
                if (document.getElementsByName('rokbudowyMax_lo')[0].value != '')
                    newURL = newURL.concat("&rokbudowyMax=", document.getElementsByName('rokbudowyMax_lo')[0].value);
                if (document.getElementsByName('lokalizacja_lo')[0].value != '')
                    newURL = newURL.concat("&lokalizacja=", document.getElementsByName('lokalizacja_lo')[0].value);

            }
            window.location.href = newURL;*/
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

			/*$("#gallery_button").click(function() {
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
			});*/
			//$( document ).tooltip();
		});

		$(function() {
			var currentFetchingId = undefined;
			function fetch( id ) {
				currentFetchingId = id;
				$.get("item.php", {
					id: id,
                    u: 1
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
        <div class="container search-form">
		<span class="zakladki"><!--
          --><a class="zakladka_mieszkania <?php if ($offertype == "mieszkania") {echo 'active';}?> " href="search.php?tab=mieszkania">mieszkania</a><!--
          --><a class="zakladka_domy <?php if ($offertype == "domy") {echo 'active';}?>" href="search.php?tab=domy">domy</a><!--
          --><a class="zakladka_dzialki <?php if ($offertype == "dzialki") {echo 'active';}?>" href="search.php?tab=dzialki">działki</a><!--
          --><a class="zakladka_komercyjne <?php if ($offertype == "lokale") {echo 'active';}?>" href="search.php?tab=lokale">lokale komercyjne</a><!--
          --></span>
	  <form method="get" class="search-form1" <?php if ($offertype == "mieszkania") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
		  <input hidden="true" value="mieszkania" name="tab"/>
          <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select name="typOferty_mi" class="search-form row1 col2">
			  <option value="">dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaMin_mi" name="cenaMin_mi" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input name="cenaMax_mi" id="cenaMax_mi" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaM2Min_mi" name="cenaM2Min_mi" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input id="cenaM2Max_mi" name="cenaM2Max_mi" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row4 col1">metraż [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="powierzchniaMin_mi" name="powierzchniaMin_mi" type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
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
		  <input id="powierzchniaMax_mi" name="powierzchniaMax_mi" type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
		  <div class="search-form form-label row5 col1">liczba pokoi [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="pokojeMin_mi" name="pokojeMin_mi" type="text" class="search-form input row5 col2 half" placeholder="np. 2" autocomplete="off" list="pokoje"/>
		  <datalist id="pokoje">
			<option value="1">
			<option value="2">
			<option value="3">
			<option value="4">
			<option value="5">
			<option value="6">
			<option value="7">
     	          </datalist> 
		  <input id="pokojeMax_mi" name="pokojeMax_mi" type="text" class="search-form input row5 col2a half" placeholder="np. 4" autocomplete="off" list="pokoje"/>
		  <div class="search-form form-label row1 col3">typ budynku
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select id="typBudynkuMieszk_mi" name="typBudynkuMieszk_mi" class="search-form row1 col4a">
			  <option value="">dowolny</option>
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
		  <input id="rokbudowyMin_mi" name="rokbudowyMin_mi" type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
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
		  <input id="rokbudowyMax_mi" name="rokbudowyMax_mi" type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
		  <div class="search-form form-label row3 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="lokalizacja_mi" name="lokalizacja_mi" type="text" class="search-form input row3 col4a" placeholder="np. Półwiejska" autocomplete="off" />
          <div class="search-form error_mi row4 col4a"><span></span></div>
          <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
		  <input type="submit" value="" class="search-form button row5 col4a search-button"/>
	  </form>
	  
	  <form method="get" class="search-form2" <?php if ($offertype == "domy") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
          <input hidden="true" value="domy" name="tab"/>
          <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select id="typOferty_do" name="typOferty_do" class="search-form row1 col2">
			  <option value="">dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaMin_do" name="cenaMin_do" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input id="cenaMax_do" name="cenaMax_do" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaM2Min_do" name="cenaM2Min_do" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input id="cenaM2Max_do" name="cenaM2Max_do" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row4 col1">metraż [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="powierzchniaMin_do" name="powierzchniaMin_do" type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
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
		  <input id="powierzchniaMax_do" name="powierzchniaMax_do" type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
		  <div class="search-form form-label row5 col1">liczba pokoi [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="pokojeMin_do" name="pokojeMin_do" type="text" class="search-form input row5 col2 half" placeholder="np. 2" autocomplete="off" list="pokoje"/>
		  <datalist id="pokoje">
			<option value="1">
			<option value="2">
			<option value="3">
			<option value="4">
			<option value="5">
			<option value="6">
			<option value="7">
     	          </datalist> 
		  <input id="pokojeMax_do" name="pokojeMax_do" type="text" class="search-form input row5 col2a half" placeholder="np. 4" autocomplete="off" list="pokoje"/>
		  <div class="search-form form-label row1 col3">pow. działki w m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="powDzialkiMin_do" name="powDzialkiMin_do" type="text" class="search-form input row1 col4 half" placeholder="np. 2000" autocomplete="off" list="pow_dzialki"/>
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
		  <input id="powDzialkiMax_do" name="powDzialkiMax_do" type="text" class="search-form input row1 col4a half" placeholder="np. 5000" autocomplete="off" list="pow_dzialki"/>
		  <div class="search-form form-label row2 col3">rok budowy [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="rokbudowyMin_do" name="rokbudowyMin_do" type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
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
		  <input id="rokbudowyMax_do" name="rokbudowyMax_do" type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
		  <div class="search-form form-label row3 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="lokalizacja_do" name="lokalizacja_do" type="text" class="search-form input row3 col4a" placeholder="np. Półwiejska" autocomplete="off" />
          <div class="search-form error_do row4 col4a"><span></span></div>
          <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
          <input type="submit" value="" class="search-form button row5 col4a search-button"/>
      </form>
	  <form method="get" class="search-form3" <?php if ($offertype == "dzialki") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?> >
          <input hidden="true" value="dzialki" name="tab"/>
          <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select id="typOferty_dz" name="typOferty_dz" class="search-form row1 col2">
			  <option value="">dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaMin_dz" name="cenaMin_dz" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input id="cenaMax_dz" name="cenaMax_dz" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaM2Min_dz" name="cenaM2Min_dz" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input id="cenaM2Max_dz" name="cenaM2Max_dz" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row1 col3">powierzchnia w m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="powierzchniaMin_dz" name="powierzchniaMin_dz" type="text" class="search-form input row1 col4 half" placeholder="np. 10000" autocomplete="off" list="pow_dzialki"/>
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
		  <input id="powierzchniaMax_dz" name="powierzchniaMax_dz" type="text" class="search-form input row1 col4a half" placeholder="np. 50000" autocomplete="off" list="pow_dzialki"/>
		  <div class="search-form form-label row2 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="miasto_dz" name="miasto_dz" type="text" class="search-form input row2 col4a" placeholder="np. Półwiejska" autocomplete="off" />
          <div class="search-form error_dz row4 col4a"><span></span></div>
          <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
          <input type="submit" value="" class="search-form button row5 col4a search-button"/>
      </form>
	  <form method="get" class="search-form4" <?php if ($offertype == "lokale") {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden"';}?>>
          <input hidden="true" value="lokale" name="tab"/>
		   <div class="search-form form-label row1 col1">rodzaj oferty
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select id="typOferty_lo" name="typOferty_lo" class="search-form row1 col2">
			  <option value="">dowolna</option>
			  <option>sprzedaż</option>
			  <option>wynajem</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col1">cena całościowa [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaMin_lo" name="cenaMin_lo" type="text" class="search-form input row2 col2 half" placeholder="np. 100000" autocomplete="off"/>
		  <input id="cenaMax_lo" name="cenaMax_lo" type="text" class="search-form input row2 col2a half" placeholder="np. 250000" autocomplete="off"/>
		  <div class="search-form form-label row3 col1">cena za m<sup>2</sup> [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="cenaM2Min_lo" name="cenaM2Min_lo" type="text" class="search-form input row3 col2 half" placeholder="np. 3000" autocomplete="off"/>
		  <input id="cenaM2Max_lo" name="cenaM2Max_lo" type="text" class="search-form input row3 col2a half" placeholder="np. 8900" autocomplete="off"/>
		  <div class="search-form form-label row4 col1">metraż [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="powierzchniaMin_lo" name="powierzchniaMin_lo" type="text" class="search-form input row4 col2 half" placeholder="np. 25" autocomplete="off" list="metraz"/>
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
		  <input id="powierzchniaMax_lo" name="powierzchniaMax_lo" type="text" class="search-form input row4 col2a half" placeholder="np. 115" autocomplete="off" list="metraz"/>
		  <div class="search-form form-label row1 col3">typ lokalu
		    <div class="arrow-right lila2"></div>
		  </div>
		  <div class="styled-select">
		    <select id="typLokalu_lo" name="typLokalu_lo" class="search-form row1 col4a">
			  <option value="">dowolny</option>
			  <option>handlowy</option>
			  <option>biurowy</option>
			  <option>magazynowy</option>
		    </select>
		  </div>
		  <div class="search-form form-label row2 col3">rok budowy [od / do]
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="rokbudowyMin_lo" name="rokbudowyMin_lo" type="text" class="search-form input row2 col4 half" placeholder="np. 1995" autocomplete="off" list="rok_budowy"/>
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
		  <input id="rokbudowyMax_lo" name="rokbudowyMax_lo" type="text" class="search-form input row2 col4a half" placeholder="np. 2010" autocomplete="off" list="rok_budowy"/>
		  <div class="search-form form-label row3 col3" >lokalizacja
		    <div class="arrow-right lila2"></div>
		  </div>
		  <input id="lokalizacja_lo" name="lokalizacja_lo" type="text" class="search-form input row3 col4a" placeholder="np. Półwiejska" autocomplete="off" />
          <div class="search-form error_lo row4 col4a"><span></span></div>
          <div class="search-form button search-mode row5 col3"><img src="public/static/./img/z_mapy.png"/></div>
          <input type="submit" value="" class="search-form button row5 col4a search-button"/>
      </form>
	  
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
