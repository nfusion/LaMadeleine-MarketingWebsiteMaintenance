var isiPad = navigator.userAgent.match(/iPad/i) != null;

jQuery( document ).ready(function() {
	var banner_wrap = jQuery( '#banner_image_wrapper' );
	var banner_imgs = jQuery( '#banner_image_wrapper img' );
	var banner_navs = jQuery( '.banner_nav_button' );
	var current_banner = 0;
	var allow_banner = true;

	banner_navs.each(function(index,nav){
		jQuery( nav ).click(function(){
			if( allow_banner ) {
				clearTimeout(auto_banner);

				allow_banner = false;
				banner_navs.removeClass('active');
				jQuery( nav ).addClass('active');

				jQuery( banner_imgs[index] ).fadeOut(0);
				jQuery( banner_imgs[index] ).addClass('fading');
				jQuery( banner_imgs[index] ).fadeIn(1000, function(){
					jQuery( banner_imgs[current_banner] ).removeClass('active');
					jQuery( banner_imgs[current_banner] ).fadeOut(0);
					jQuery( banner_imgs[index] ).addClass('active');
					jQuery( banner_imgs[index] ).removeClass('fading');
					current_banner = index;
					allow_banner = true;
				});
			}
		});
	});

	function rotate_banner() {
		var index = current_banner + 1;
		if(index >= banner_navs.length) index = 0;

		allow_banner = false;
		banner_navs.removeClass('active');
		jQuery( banner_navs[index] ).addClass('active');

		jQuery( banner_imgs[index] ).fadeOut(0);
		jQuery( banner_imgs[index] ).addClass('fading');
		jQuery( banner_imgs[index] ).fadeIn(1000, function(){
			jQuery( banner_imgs[current_banner] ).removeClass('active');
			jQuery( banner_imgs[current_banner] ).fadeOut(0);
			jQuery( banner_imgs[index] ).removeClass('fading').addClass('active');
			current_banner = index;
			allow_banner = true;
			auto_banner = setTimeout(rotate_banner, 5000)
		});
	}

	var auto_banner = setTimeout(rotate_banner, 5000);

	
	var all_faqs = jQuery('.faqs_list');
	if(all_faqs.length > 0){
		all_faqs.each(function() {
			var faqs_list = jQuery(this);

			faqs_list.find('dt').click(function() {
				if(faqs_list.hasClass('faqs_active')) faqs_list.removeClass('faqs_active');
				else faqs_list.addClass('faqs_active');
			});

			faqs_list.find('.faqs_close').click(function() {
				if(faqs_list.hasClass('faqs_active')) faqs_list.removeClass('faqs_active');
				else faqs_list.addClass('faqs_active');
			});
		});

		if( window.location.hash ) {
			jQuery(all_faqs[window.location.hash.replace('#','')]).addClass('faqs_active');
		}
	}

	/* Menu Navigation START */
	var menu_sections = jQuery('#menu_nav a');
	if(menu_sections.length > 0) {
		var menu_groups = jQuery('.menu_group');
		var menu_positions = {};
		var curr_menu_pos = -1;
		var autoScroll = false;
		var menuScrollSpeed = isiPad ? 0 : 1000;
		$('#menu_wrapper').css('padding-bottom', jQuery(window).height() - jQuery(menu_groups[menu_groups.length - 1]).height() - jQuery('#footer').height() - 300);

		menu_sections.each(function(index,menunav){
			if( jQuery( jQuery(this).attr('href') ).length > 0 ) menu_positions[ index ] = jQuery( jQuery(this).attr('href') ).offset().top;
			
			jQuery(menunav).click(function(){
				autoScroll = true;
				if(curr_menu_pos >= 0) jQuery(menu_sections[curr_menu_pos]).removeClass('menu_active');
				curr_menu_pos = index;
				if(curr_menu_pos >= 0) jQuery(menu_sections[curr_menu_pos]).addClass('menu_active');
				var navpos = jQuery( jQuery(this).attr('href') ).offset();
				jQuery('html, body').stop().animate({
					scrollTop: jQuery( jQuery(this).attr('href') ).offset().top
				}, menuScrollSpeed, function(){
					autoScroll = false;
				});
				return false;
			});
		});

		jQuery(window).scroll(function(){
			if(!autoScroll) {
				var docpos = jQuery(this).scrollTop() + 70;
				var temp_menu_pos = -1;
				$.each(menu_positions, function(index,menupos){
					if(menupos <= docpos) temp_menu_pos = index;
				});

				if(temp_menu_pos != curr_menu_pos) {
					if(curr_menu_pos >= 0) jQuery(menu_sections[curr_menu_pos]).removeClass('menu_active');
					curr_menu_pos = temp_menu_pos;
					if(curr_menu_pos >= 0) jQuery(menu_sections[curr_menu_pos]).addClass('menu_active');
				}
			}
		});

	}
	/* Menu Navigation END */

	jQuery( '#mobile_nav' ).click(function(){
		if(jQuery( '#header' ).hasClass('nav_open')) jQuery( '#header' ).removeClass('nav_open');
		else jQuery( '#header' ).addClass('nav_open');
	});

	jQuery( '.submenu' ).each(function(index,sub){
		jQuery( sub ).prev('a').click(function(){
			if(jQuery(window).width() < 768) {
				if(jQuery( sub ).closest('li').hasClass('show_sub')) jQuery( sub ).closest('li').removeClass('show_sub');
				else jQuery( sub ).closest('li').addClass('show_sub');
				return false;
			}
		});
	});
});