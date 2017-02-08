$(document).ready(function() {
    'use strict';
    /*-----------------------------------------------------------------------------------*/
    /*	STICKY HEADER
	/*-----------------------------------------------------------------------------------*/
        var options = {
            offset: 300,
            offsetSide: 'top',
            classes: {
                clone:   'banner--clone fixed',
                stick:   'banner--stick',
                unstick: 'banner--unstick'
            },
            onStick: function() {
	            $($.SmartMenus.Bootstrap.init);
            }
        };
        var banner = new Headhesive('.navbar', options);
    /*-----------------------------------------------------------------------------------*/
    /*	HAMBURGER MENU ICON
	/*-----------------------------------------------------------------------------------*/
    var toggles = document.querySelectorAll(".nav-bars");
    for (var i = toggles.length - 1; i >= 0; i--) {
        var toggle = toggles[i];
        toggleHandler(toggle);
    };
    function toggleHandler(toggle) {
        toggle.addEventListener("click", function(e) {
            e.preventDefault();
            (this.classList.contains("is-active") === true) ? this.classList.remove("is-active"): this.classList.add("is-active");
        });
    };


    
    /*-----------------------------------------------------------------------------------*/
    /*	PARALLAX
	/*-----------------------------------------------------------------------------------*/
    parallaxInit('.parallax')


    /*-----------------------------------------------------------------------------------*/
    /*	DATA REL
	/*-----------------------------------------------------------------------------------*/
    $('a[data-rel]').each(function() {
        $(this).attr('rel', $(this).data('rel'));
    });
    /*-----------------------------------------------------------------------------------*/
    /*	TOOLTIP
    /*-----------------------------------------------------------------------------------*/
    if ($("[rel=tooltip]").length) {
        $("[rel=tooltip]").tooltip();
    }
    /*-----------------------------------------------------------------------------------*/
    /*	PRETTIFY
	/*-----------------------------------------------------------------------------------*/
    window.prettyPrint && prettyPrint()

    /*-----------------------------------------------------------------------------------*/
    /*	VANILLA
    /*-----------------------------------------------------------------------------------*/
    var myForm;
    myForm = new VanillaForm($("form.vanilla-form"));
    /*-----------------------------------------------------------------------------------*/
    /*	GO TO TOP
    /*-----------------------------------------------------------------------------------*/
    $.scrollUp({
        scrollName: 'scrollUp',
        // Element ID
        scrollDistance: 300,
        // Distance from top/bottom before showing element (px)
        scrollFrom: 'top',
        // 'top' or 'bottom'
        scrollSpeed: 300,
        // Speed back to top (ms)
        easingType: 'linear',
        // Scroll to top easing (see http://easings.net/)
        animation: 'fade',
        // Fade, slide, none
        animationInSpeed: 200,
        // Animation in speed (ms)
        animationOutSpeed: 200,
        // Animation out speed (ms)
        scrollText: '<span class="btn btn-square"><i class="ion-chevron-up"></i></span>',
        // Text for element, can contain HTML
        scrollTitle: false,
        // Set a custom <a> title if required. Defaults to scrollText
        scrollImg: false,
        // Set true to use image
        activeOverlay: false,
        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 1001 // Z-Index for the overlay
    });
   
    /*-----------------------------------------------------------------------------------*/
	/*	WOW ANIMATION
	/*-----------------------------------------------------------------------------------*/
	new WOW().init();
	
	/*-----------------------------------------------------------------------------------*/
	/*	LOADING
	/*-----------------------------------------------------------------------------------*/
	$(window).load(function() {
	    $(".circle-progress-wrapper h4").css("visibility", "visible");
	    $('#status').fadeOut();
	    $('#preloader').delay(350).fadeOut('slow');
	    $('#preloader .textload').delay(0).fadeOut('slow');
	    $('body').delay(350).css({
	        'overflow': 'visible'
	    });
	});
});