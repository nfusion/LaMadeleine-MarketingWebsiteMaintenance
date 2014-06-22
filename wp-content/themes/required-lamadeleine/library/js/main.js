/***
/* La Madeleine
/* Custom JavaScript
/*
**/

$(function(){

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
	LOCATIONS
	********/

	// Homepage mobile location widget
	var $mobileLocation = $('#mobile-location');

	if($mobileLocation.length && $mobileLocation.is(':visible') && LaMadLocations.nearestLocationObj){
		mobileLocationInt = setInterval(function(){
			if(LaMadLocations.nearestLocationObj.id){

				clearInterval(mobileLocationInt);

				// Get today's hours
				var todayHours = LaMadLocations.getTodayHours(LaMadLocations.nearestLocationObj);

				// Show mobile location widget
				$mobileLocation.addClass('loaded');

				// Create html string
				str = '<div class="icon-phone"></div><a class="location-link" href="/locations"></a><div class="location-text"><p class="title">' + LaMadLocations.nearestLocationObj.title + '</p><p class="hours"><strong>Today\'s Hours:</strong> ' + todayHours.open + ' - ' + todayHours.close + '</p>';

				$mobileLocation.append(str);
			}
		}, 1000);
	};

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