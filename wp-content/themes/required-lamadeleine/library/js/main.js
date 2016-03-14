/***
/* La Madeleine
/* Custom JavaScript
/*
**/

window.lamIE8 = false;

$(function(){

	var $content = $('#content'),
			$main = $content.find('#main'),
			$sidebar = $content.find('#sidebar');

	if($('html').hasClass('ie8')){
		window.lamIE8 = true;
	}

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

	var $nav = $('#nav .nav-wrapper'),
			$navIcon = $('#header .icon-menu'),
			viewportHeight;

	// Check viewport height, set navigation interaction accordingly
	var setNavInteraction = function(){
		var viewportHeight = $(window).height();

		// If viewport height is greater than navigation height, allow for hover reveal
		if(viewportHeight > 830){
			$navIcon.unbind('click');
			$navIcon.find('span').text('More');
			$navIcon.on('mouseover', function(){
				$('body').addClass('nav-active');
			});

			$nav.on('mouseleave', function(){
				$('body').removeClass('nav-active');
			});
		}
		else{

			// Reset mouse events
			$navIcon.unbind('mouseover');
			$nav.unbind('mouseleave');
			$navIcon.unbind('click');

			// Else require click to open/close navigation
			$navIcon.on('click', function(e){
				e.stopPropagation();
				if($('body').hasClass('nav-active')){
					$('body').removeClass('nav-active');
					$navIcon.find('span').text('More');
				}
				else{
					$('body').toggleClass('nav-active');
					$navIcon.find('span').text('Close');
				}

				// Stop nav clicks from propagating to document and closing navigation
				$nav.on('click', function(e){
					e.stopPropagation();
				});

				// Any click propagated to document will close the navigation
				$('html').on('click', function(){
					$('body').removeClass('nav-active');
					$navIcon.find('span').text('More');
				});
				
			});
		}
	}

	if($nav.length){
		// If touch device, use touch to open/close nav
		if(Modernizr.touch){
			$navIcon.on('touchend', function(){
				if($('body').hasClass('nav-active')){
					$('body').removeClass('nav-active');
					$navIcon.find('span').text('More');
				}
				else{
					$('body').toggleClass('nav-active');
					$navIcon.find('span').text('Close');
				}
			});
		}
		// Else, set nav interaction based on viewport height
		else{
			setNavInteraction();
			// Listen for window resize to check viewport height
			if(!lamIE8){
				window.addEventListener('resize', setNavInteraction);
			}
		}
	};

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
			console.log(myLocation);

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
					//console.log($('#category-' + catName));
					$("html, body").animate({ scrollTop: $('#category-' + catName).offset().top }, 1000);
				});

			}
		}, 1000);
		

		// Sticky the sidebar legend
		var setSticky = function(){
			if($sidebar.is(':visible') && !Modernizr.touch){
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
		if(!lamIE8){
			window.addEventListener('resize', resetSticky);
		};

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
		if($sidebar.is(':visible') && $sidebar.find('.fma-promo').length > 0 && !Modernizr.touch){
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
	if(!lamIE8){
		window.addEventListener('resize', resetStickyPromo);
	};

	/********
	MISC
	********/

	/* BONNE REWARDS TRACKING */
	function sizmekTrack(activityID) {
		console.log('Tracking ID = ' + activityID);
		var ebSession = '[SessionID]';
		var ebRand = Math.random()+'';
		ebRand = ebRand * 1000000;

		var script = document.createElement('script');
		script.type='text/javascript';
		script.src='http://bs.serving-sys.com/Serving/ActivityServer.bs?cn=as&amp;ActivityID=' + activityID + '&amp;rnd=' + ebRand + '&amp;Session='+ebSession+'';       

		$(script).appendTo('body');      
	}
	
	//Click tracking for app download
	$('#download-app a').on('click', function(){
		if(jQuery.cookie('LAM-rewards') != 'undefined'){
			
			//Set proper ID for button clicked
			if($(this).is('#google-play')){
				var activityID = 748215;
			} else {
				var activityID = 748206;
			}
			
			//Fire tracking
			sizmekTrack(activityID);

			//Set cookie
			 $.cookie('LAM-rewards');
		}
	});

   	/*********
	IE SUPPORT
	*********/

	var ua = window.navigator.userAgent;

	function msieCheck() {

	  var msie = ua.indexOf("MSIE ");

	  // If Internet Explorer, add class to <html> with version
		if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
			$('html').addClass('ie');
		};
	};

  msieCheck();

  // Is IE8
  if(lamIE8){
  	if($main.find('.menu-title').length > 0){
  		$main.find('.menu-category').last().addClass('last-category');
  	};
  };

  /*********
	ANDROID SUPPORT
	*********/

  // Add class for Android version support
	if( ua.indexOf("Android") >= 0) 
	{

	  var androidVersion = parseFloat(ua.slice(ua.indexOf("Android")+8));

	  androidVersion = androidVersion + ""; // Convert to string

	  androidVersion = androidVersion.replace(/\./g, "");

		$("html").addClass('android android' + androidVersion); // Add Android utility class to HTML class list

	};

});