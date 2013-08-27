(function($){
	$(window).load(function(){
		$(".offers-list").mCustomScrollbar({scrollButtons:{enable:true}});

        if (getURLParameter("sortujWg") != '')
            document.getElementsByName('sortujWg')[0].value = getURLParameter("sortujWg");
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
						if (getURLParameter("sortujWg") != '')
                        document.getElementsByName('sortujWg')[0].value = getURLParameter("sortujWg");
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
                        if (getURLParameter("sortujWg") != '')
                            document.getElementsByName('sortujWg')[0].value = getURLParameter("sortujWg");
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
                        if (getURLParameter("sortujWg") != '')
                            document.getElementsByName('sortujWg')[0].value = getURLParameter("sortujWg");

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
                        if (getURLParameter("sortujWg") != '')
                            document.getElementsByName('sortujWg')[0].value = getURLParameter("sortujWg");
						}
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

function search(form) {
			form.submit();
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

    $(".miniatura").live("click",function() {
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
            initializeMap();
            $(".text-text").mCustomScrollbar({scrollButtons:{enable:true}});
        }
    });
}
// preload first item
if( $('.offer-zobacz-button').size() > 0 ) {
	var id;
	if (getURLParameter("id") != null) {
		id = getURLParameter("id");
	} else {
		id = $($('.offer-zobacz-button').get(0)).data('id');
	}
    $('.offer:first').addClass('chosenOffer');
	fetch(id);
}
$('.offer-zobacz-button').click(function () {
	var id = $(this).data('id');
    $('.offer').removeClass('chosenOffer');
    $(this).closest('.offer').addClass('chosenOffer');
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
    $('.sort-select').change(
        function(){
            $(this).closest('form').trigger('submit');
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

//google.maps.event.addDomListener(window, 'load', initialize);

$(function() {
    $('.map-search-button').live('click', function() {
        $(this).closest('form').attr('action', 'map.php');
    });
    $('.list-search-button').live('click', function() {
        $(this).closest('form').attr('action', 'search.php');
    });
});
