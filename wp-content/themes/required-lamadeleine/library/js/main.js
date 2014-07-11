/***
/* La Madeleine
/* Custom JavaScript
/*
**/

$(function(){

	var $content = $('#content'),
			$main = $content.find('#main'),
			$sidebar = $content.find('#sidebar');

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

	// Check daypart cookie
	var cookieDaypart = $.cookie('LAM-daypart');

	// Parse as JSON
	if(typeof(cookieDaypart) != 'undefined'){
		var myDaypart = $.parseJSON(cookieDaypart),
				hasDaypart = true;
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
		
		// Back to top click event
		$content.find('.back-top').on('click touchend', function(e){
			e.preventDefault();
			$("html, body").animate({ scrollTop: 0 }, 1000);
		});

		// If user has selected a location
		if(myLocation){

			// Show pricing
			$content.find('.menu-details').addClass(myLocation.menu_pricing.toLowerCase());

			// Update "Choose a location" text
			$content.find('.set-location').html('<div class="location-name">' + myLocation.title + '<div class="change-location">(<a href="/locations">Change</a>)</div></div>');
		}

		// Wait for dayparts API to populate widget
		var daypartInt = setInterval(function(){
			if($sidebar.find('.widget-daypart').length > 0){

				clearInterval(daypartInt);

				// Click events for menu category links
				$sidebar.find('ul.categories li').on('click', function(e){
					e.preventDefault();
					var catName = $(this).data('cat-name');
					console.log($('#category-' + catName));
					$("html, body").animate({ scrollTop: $('#category-' + catName).offset().top }, 1000);
				});

			}
		}, 1000);
		

		// Sticky the sidebar legend
		var setSticky = function(){
			if($sidebar.is(':visible')){
				$sidebar.find("#sticky-widgets").sticky({topSpacing: 20, className: 'menu', getWidthFrom: '#sidebar .sidebar-wrapper'});
			}
		};

		setSticky();

		// Debounce reset sticky 
		var resetSticky = debounce(function() {
			$sidebar.find("#sticky-widgets").unstick();
			setSticky();
		}, 250);

		// Listen for window resize to reset sticky
		window.addEventListener('resize', resetSticky);

	};

	/********
	DAYPARTS
	********/

	if(hasDaypart){
	  // Find any .daypart-menu links and set href to current daypart menu
		$content.find('a.daypart-menu').attr('href', myDaypart.link.guid);
	}

	/********
	LOCATIONS
	********/

	// If location exists, add class to body and set phone number for any phone links
	if(hasLocation){
		$('body').addClass('has-location');
		$('.lam-call a').attr('href', 'tel:' + myLocation.phone);

		// If any .get-directions links and fire getDirections() method when clicked.
		// $content.find('a.get-directions').on('click touchend', function(e){
		// 		e.preventDefault();
	 //      LaMadLocations.getDirections();
	  // });
	}
	// Else add .no-location class to body
	else{
		$('body').addClass('no-location');
	}

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

	var $header = $('#header');

	// Interaction event for any geolocation links in header
	$header.find('.lam-geolocate').on('click touchstart', function(){

		// Get geolocation
		LaMadLocations.getLocation();

		// Hide this link
		$(this).hide();

		// Show loading
		$header.find('.loading').show();

		// Start interval to wait for response
		locateInt = setInterval(function(){

			// If global location object is created
			if(LaMadLocations.nearestLocationObj.id){
				// Clear interval
				clearInterval(locateInt);
				// Hide loading
				$header.find('.loading').hide();
				// This location
				myLocation = LaMadLocations.nearestLocationObj;
				// Set phone attribute
				$header.find('.lam-call a').attr('href', 'tel:' + myLocation.phone);
				// Show mobile location widget
				mobileLocationWidget();
			}
		}, 100);
	});

	/********
	CAROUSEL
	********/

	var $carousel = $('#carousel');

	if($carousel.length > 0){
		var $controls = $carousel.find('.carousel-controls'),
				$paginate = $carousel.find('.carousel-paginate');

		// Instantiate swipe.js on #carousel
		window.mySwipe = new Swipe(document.getElementById('carousel'), {
			startSlide: 0,
			speed: 500,
			auto: 8000,
			callback: function(index, elem) {

		  	// Set navigation-marker active class
		  	$paginate.find('.active').removeClass('active');
		  	$paginate.find('.dot:nth-child(' + (index + 1) + ')').addClass('active');

		  }
		});

		// Check if swipe.js has loaded
		var swipeOnload = function(){
			if(window.mySwipe.getNumSlides() > 0){
				$carousel.find('.carousel-item.has-gradient-1').prepend('<div class="carousel-gradient"></div>');
				clearInterval(swipeInt);
			}
		}

		// Check every 100ms until loaded
		var swipeInt = setInterval(swipeOnload, 100);

		// Run immediately rather than waiting for first interval
		swipeOnload();

		// Previous arrow click event
		$controls.find('.prev').on('click', function(){
			mySwipe.prev();
		});

		// Next arrow click event
		$controls.find('.next').on('click', function(){
			mySwipe.next();
		});

		// Pagination dot click event
		$paginate.find('.dot').on('click', function(){
			mySwipe.slide($(this).data('order'));
		});
	}

	/********
	PROMO
	********/

	// Sticky the sidebar promo
	var setStickyPromo = function(){
		if($sidebar.is(':visible') && $sidebar.find('.fma-promo').length > 0){
			$sidebar.find(".fma-promo").sticky({topSpacing: 20, className: 'promo', getWidthFrom: '#sidebar .sidebar-wrapper'});
		}
	};

	setStickyPromo();

	// Debounce reset sticky 
	var resetStickyPromo = debounce(function() {
			$sidebar.find(".fma-promo").unstick();
			setStickyPromo();
	}, 250);

	// Listen for window resize to reset sticky
	window.addEventListener('resize', resetStickyPromo);

	/*********
	IE SUPPORT
	*********/

	function msieCheck() {

		var ua = window.navigator.userAgent;
	  var msie = ua.indexOf("MSIE ");

	  // If Internet Explorer, add class to <html> with version
		if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
			$('html').addClass('ie');
		};
	};

  msieCheck();

});