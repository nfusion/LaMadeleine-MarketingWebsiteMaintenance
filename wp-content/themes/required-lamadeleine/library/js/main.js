/***
/* La Madeleine
/* Custom JavaScript
/*
**/

$(function(){

	$content = $('#content');

	/********
	COOKIES
	********/
	// Check location cookie
	var cookieLoc = $.cookie('LAM-location');

	// Parse as JSON
	if(typeof(cookieLoc) != 'undefined'){
		var myLocation = $.parseJSON(cookieLoc),
				hasLocation = true;
	}

	/********
	NAVIGATION
	********/

	var $nav = $('#nav .nav-wrapper');

	if($nav.length){
		var $navIcon = $('#header .icon-menu');

		if(Modernizr.touch){
			$navIcon.on('touchend', function(){
				$('body').toggleClass('nav-active');
			});
		}
		else{
			$navIcon.on('mouseover', function(){
				$('body').addClass('nav-active');
			});

			$nav.on('mouseleave', function(){
				$('body').removeClass('nav-active');
			});
		}
	}

	/********
	MENUS
	********/

	// If on a menu 
	if($content.hasClass('breakfast') || $content.hasClass('lunch') || $content.hasClass('dinner') || $content.hasClass('bakery')){
		// If user has selected a location, show pricing
		if(myLocation){
			$content.find('.menu-details').addClass(myLocation.menu_pricing.toLowerCase());
		}
		// Sticky the sidebar widgets
		$("#sidebar .menu-legend").sticky({topSpacing: 20, className: 'menu', getWidthFrom: '#sidebar .sidebar-wrapper'});
	};

	/********
	LOCATIONS
	********/

	// If location exists, add class to body and set phone number for any phone links
	if(hasLocation){
		$('body').addClass('has-location');
		$('.lam-call a').attr('href', 'tel:' + myLocation.phone);
	}
	// Else add no location class to body
	else{
		$('body').addClass('no-location');
	}

	// If any .btn.get-directions or .btn-light.get-directions element is clicked, fir getDirections() method.
	$content.find('.btn.get-directions').on('click touchend', function(e){
			e.preventDefault();
      LaMadLocations.getDirections();
  });
  $content.find('.btn-light.get-directions').on('click touchend', function(e){
  		e.preventDefault();
      LaMadLocations.getDirections();
  });

	/**
	* Homepage mobile location widget
	*	Displays selected location data at top of homepage
	*
	**/ 

	var $mobileLocation = $('#mobile-location');

	var mobileLocationWidget = function(){
		// Get today's hours
		var todayHours = LaMadLocations.getTodayHours(myLocation);

		// Create html string
		str = '<div class="icon-phone"><a href="tel:' + myLocation.phone + '"></a></div><a class="location-link" href="/locations"></a><div class="location-text"><p class="title">' + myLocation.title + '</p><p class="hours"><strong>Today\'s Hours:</strong> ' + todayHours.open + ' - ' + todayHours.close + '</p>';

		$mobileLocation.append(str);

		// Show mobile location widget
		$mobileLocation.addClass('loaded');
	};

	if($mobileLocation.length && $mobileLocation.is(':visible') && hasLocation){
		mobileLocationWidget();
	};

	// Mobile header locate/call interactions
	// *** This needs to be cleaned up ***

	var $header = $('#header');

	$header.find('.lam-geolocate').on('click touchstart', function(){
		LaMadLocations.getLocation();
		$(this).hide();
		$header.find('.loading').show();
		locateInt = setInterval(function(){
			console.log(LaMadLocations.nearestLocationObj.id);
			if(LaMadLocations.nearestLocationObj.id){
				clearInterval(locateInt);
				$header.find('.loading').hide();
				myLocation = LaMadLocations.nearestLocationObj;
				$header.find('.lam-call a').attr('href', 'tel:' + myLocation.phone);
				mobileLocationWidget();
			}
		}, 100);
	});

	/********
	CAROUSEL
	********/

	var $carousel = $('#carousel');

	if($carousel.length){
		var $controls = $carousel.find('.carousel-controls'),
				$paginate = $carousel.find('.carousel-paginate');

		window.mySwipe = new Swipe(document.getElementById('carousel'), {
			startSlide: 0,
			speed: 500,
			auto: 0,
			callback: function(index, elem) {

		  	// Set navigation-marker active class
		  	$paginate.find('.active').removeClass('active');
		  	$paginate.find('.dot:nth-child(' + (index + 1) + ')').addClass('active');
		  }
		});

		$controls.find('.prev').on('click', function(){
			mySwipe.prev();
		});

		$controls.find('.next').on('click', function(){
			mySwipe.next();
		});

		$paginate.find('.dot').on('click', function(){
			mySwipe.slide($(this).data('order'));
		});
	}
});