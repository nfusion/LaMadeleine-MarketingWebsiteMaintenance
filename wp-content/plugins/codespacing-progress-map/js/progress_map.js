
/* @Version 2.6.0 */

//=======================//
//==== Map functions ====//
//=======================//
	
	var carousel_map_zoom = progress_map_vars.carousel_map_zoom;
	
	/**
	 * Load map options
	 *
	 * @light_map, Declare the light map in order to use the apropriate options for this type of map.
	 * @latLng, The center point of the map.
	 * @zoom, The default zoom of the map.
	 *
	 */
	
	function cspm_load_map_options(light_map, latLng, zoom){
		
		var latlng = (latLng != null) ? latLng.split(',') : progress_map_vars.center.split(',');
		
		var zoom_value = (zoom != null) ? parseInt(zoom) : parseInt(progress_map_vars.zoom)
		
		var default_options = {
			center:[latlng[0], latlng[1]],
			zoom: zoom_value,			
			scrollwheel: eval(progress_map_vars.scrollwheel),
			panControl: eval(progress_map_vars.panControl),	
			panControlOptions: {
				position: google.maps.ControlPosition.RIGHT_TOP  
			},					
			mapTypeControl: eval(progress_map_vars.mapTypeControl),
			mapTypeControlOptions: {
				position: google.maps.ControlPosition.TOP_RIGHT,
				mapTypeIds: [google.maps.MapTypeId.ROADMAP,
							 google.maps.MapTypeId.SATELLITE,
							 google.maps.MapTypeId.TERRAIN,
							 google.maps.MapTypeId.HYBRID]				
			},
			streetViewControl: eval(progress_map_vars.streetViewControl),	
			streetViewControlOptions: {
				position: google.maps.ControlPosition.RIGHT_TOP  
			},	
		};
		
		if(progress_map_vars.zoomControl == 'true' && progress_map_vars.zoomControlType == 'default'){
			
			var zoom_options = {
				zoomControl: true,
				zoomControlOptions:{
					style: google.maps.ZoomControlStyle.SMALL 
				},
			};
		
		}else{
			var zoom_options = {
				zoomControl: false,
			};
		}
		
		var map_options = jQuery.extend({}, default_options, zoom_options);
		
		return map_options;
		
	}					
	
	// Set the initial map style
	// @since 2.4
	function cspm_initial_map_style(map_style, custom_style_status){
			
		if(map_style == 'custom_style' && custom_style_status == false)
			var map_type_id = {mapTypeId: google.maps.MapTypeId.ROADMAP};
		
		else if(map_style == 'custom_style')
			var map_type_id = {mapTypeId: "custom_style"};
			
		else if(map_style == 'ROADMAP')
			var map_type_id = {mapTypeId: google.maps.MapTypeId.ROADMAP};
			
		else if(map_style == 'SATELLITE')
			var map_type_id = {mapTypeId: google.maps.MapTypeId.SATELLITE};
			
		else if(map_style == 'TERRAIN')				
			var map_type_id = {mapTypeId: google.maps.MapTypeId.TERRAIN};
			
		else if(map_style == 'HYBRID')				
			var map_type_id = {mapTypeId: google.maps.MapTypeId.HYBRID};
		
		return map_type_id;
		
	}
	
	var post_ids_and_categories = {};
	var post_lat_lng_coords = {};
	var post_ids_and_child_status = {}

	// Create pins
	// @Since 2.5	
	function cspm_new_pin_object(i, post_id, lat, lng, post_categories, map_id, marker_img, marker_size, is_child){
		
		post_lat_lng_coords[map_id][post_id] = lat+'_'+lng;
	
		// Create an object of that post_id and its categories/status for the faceted search
		post_ids_and_categories[map_id]['post_id_'+post_id+''] = {};
		post_ids_and_child_status[map_id][lat+'_'+lng] = is_child;
		
		// Get the current post categories	
		var post_category_ids = (post_categories != '') ? post_categories.split(',') : '';
		
		// Collect an object of all posts in the map and their categories
		// Useful for the faceted search & the search form
		post_ids_and_categories[map_id]['post_id_'+post_id+''][0] = post_category_ids;
		
		// By default the marker image is the default Google map red marker
		var marker_icon = '';
		
		// If the selected marker is the customized type
		if(progress_map_vars.defaultMarker == 'customize'){
			
			// Get the custom marker image
			// If the marker categories option is set to TRUE, the marker image will be the uploaded marker category image
			// If the marker categories option is set to FALSE, the marker image will be the default custom image provided by the plugin
			var marker_cat_img = marker_img;
			
			// Add retina support
			if(progress_map_vars.retinaSupport == "true"){
			
				var marker_img_width = marker_size.split('x')[0]/2;
				var marker_img_height = marker_size.split('x')[1]/2;
								
				marker_icon = new google.maps.MarkerImage(marker_cat_img, null, null, null, new google.maps.Size(marker_img_width,marker_img_height));					
			
			}else marker_icon = new google.maps.MarkerImage(marker_cat_img);
			
		}		
		
		return pin_object = {latLng: [lat, lng], tag: 'post_id__'+post_id+'', id: post_id+'_'+is_child, options:{ optimized: false, icon: marker_icon, id: post_id, post_id: post_id, is_child: is_child}};										
	
	}
	

	/**
	 * Create pins
	 * @Deprecated since 2.5
	 * Use cspm_new_pin_object() instead
	 */
	function cspm_new_pin($this, i, post_id, lat, lng, post_url, marker_img, items_title, items_details, light_map, static_map, post_categories, map_id, marker_size){

		var plugin_map = $this;
		
		var post_category_ids = '';

		if(progress_map_vars.retinaSupport == "true"){
			
			var marker_img_width = marker_size.split('x')[0]/2;
			var marker_img_height = marker_size.split('x')[1]/2;
			
		}
		
		post_lat_lng_coords[map_id][post_id] = lat+'_'+lng;
	
		// Create an object of post_ids and their categories for the faceted search
		post_ids_and_categories[map_id]['post_id_'+post_id+''] = {};
			
		var post_category_ids = (post_categories != '') ? post_categories.split(',') : '';
		
		post_ids_and_categories[map_id]['post_id_'+post_id+''][0] = post_category_ids;

		if(progress_map_vars.marker_cats_settings == 'true' && progress_map_vars.count_marker_categories > 0){

			var marker_cat_img = progress_map_vars.marker_categories['marker_category_'+post_category_ids[0]+''];
			
			if(marker_cat_img != '' && marker_cat_img != null){
				
				// Add retina support
				if(progress_map_vars.retinaSupport == "true")			
					var marker_icon = new google.maps.MarkerImage(marker_cat_img, null, null, null, new google.maps.Size(marker_img_width,marker_img_height));					
				else var marker_icon = new google.maps.MarkerImage(marker_cat_img);
				
			}else{
				
				// Add retina support
				if(progress_map_vars.retinaSupport == "true")
					var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon, null, null, null, new google.maps.Size(marker_img_width,marker_img_height)) : '';
				else var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon) : '';
				
			}

		}else{
				
			// Add retina support
			if(progress_map_vars.retinaSupport == "true")				
				var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon, null, null, null, new google.maps.Size(marker_img_width,marker_img_height)) : '';
			else var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon) : '';
				
		}
		
		plugin_map.gmap3({ 
		 marker:{
			latLng: [lat, lng],
			tag: 'post_id__'+post_id+'',
			options:{
				optimized: false,
				icon: marker_icon,
				id: post_id,
				item_title: items_title,
				item_img: marker_img,
				item_url: post_url,
			},			
			callback: function(marker){												

				if (progress_map_vars.retinaSupport == "true") {	marker.setOptions({	 optimized: false	});}

				// Create carousel items
				if(!light_map && progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
				
					var output = '';
					
					if(progress_map_vars.items_view == "listview"){ 
					
						item_width = parseInt(progress_map_vars.horizontal_item_width);										
						item_height = parseInt(progress_map_vars.horizontal_item_height);
						item_css = progress_map_vars.horizontal_item_css;
						items_background  = progress_map_vars.items_background;
						
						// Horizontal view
					
						output += '<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+i+'_'+map_id+'" name="'+lat+'_'+lng+'" value="'+i+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; margin:4px 3px; '+item_css+'">';
							output += '<div class="cspm_spinner"></div>';							
						output += '</li>';
					
					}else if(progress_map_vars.items_view == "gridview"){ 
					
						item_width = parseInt(progress_map_vars.vertical_item_width);
						item_height = parseInt(progress_map_vars.vertical_item_height);
						item_css = progress_map_vars.vertical_item_css;
						items_background  = progress_map_vars.items_background;
						
						// Vertical view
						
						output += '<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+i+'_'+map_id+'" name="'+lat+'_'+lng+'" value="'+i+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; margin:4px 3px; '+item_css+'">';
							output += '<div class="cspm_spinner"></div>';
						output += '</li>';
					
					}
					
					// Add item content to the carousel
					jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').append(output);
					
				}						
				
			},
			// marker events
			events:{
				mouseover: function(marker){	
					
					// Call active overlay style			
					jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
					jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');	
					
					// Call carousel item active style
					if(!light_map && progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
						
						cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
						cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
					
					}
				
				},
				mouseout: function(marker){	
				
					// Remove overlay item style
					jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
					jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');	

				},
				// Click event is used only for content infowindow style
				click: function(marker){
					
					// first, hide all infowindows
					jQuery('div.infoWindowOverlay').hide();
						
					// Then show the current infowindow
					jQuery('div#infowindow_'+i+'_'+map_id+'').show();																
					
					// Center the map on that marker
					var latLng = new google.maps.LatLng(lat, lng);							
					var map = plugin_map.gmap3("get");														
					map.panTo(latLng);
					map.setCenter(latLng);	
					
					// Call custom scroll bar for infowindow
					jQuery("div.infoWindowOverlayTopRight p").mCustomScrollbar("destroy");
					jQuery("div.infoWindowOverlayTopRight p").mCustomScrollbar({
						autoHideScrollbar:true,
						theme:"dark-thin"
					});										
																			
				}
			}
		  },
		  overlay: cspm_create_marker_overlay(plugin_map, post_id, i, lat, lng, post_url, marker_img, items_title, items_details, light_map, static_map, map_id),		  

		});
						
	}
	
	/**
	 * Create overlay
	 * @Deprecated since 2.5
	 */
	function cspm_create_marker_overlay(plugin_map, post_id, i, lat, lng, post_url, marker_img, items_title, items_details, light_map, static_map, map_id){
				
		var overlay = { latLng: [lat, lng] };
		
		if( progress_map_vars.show_infowindow == 'true' ){
		  
			var overlay = {
			
				latLng: [lat, lng],
			
				options: cspm_overlay_content_options(post_id, i, lat, lng, post_url, marker_img, items_title, items_details, static_map, map_id),
				
				callback: function(overlay){
					
				},
				
				// Overlay event
				events:{
					mouseover: function(overlay){	
												
						// Call active overlay style																				
						jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
						jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');

						// Call carousel item active style	
						if(!light_map && progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
							
							cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
							cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
							
						}
												
					},
					mouseout: function(overlay){
								
						// Remove overlay active event									
						jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
						jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');		
						
					},
					// Click event used only for content infowindow style
					click: function(overlay){
						
						// Hide current infowindow
						jQuery('div.infoWindowOverlayClose').click(function(){
							jQuery('div.infoWindowOverlay').hide();
						});

					}
				}
			
			}
		  
		}
		
		return overlay;
		
	}
	
	/**
	 * Create overlay options
	 * @Deprecated since 2.5
	 */
	function cspm_overlay_content_options(post_id, i, lat, lng, post_url, marker_img, items_title, items_details, static_map, map_id){

		// Content style overlay
		if( !static_map && progress_map_vars.infowindow_type == 'content_style' ){
			
			var overlay_options = {
				
				// Content infowindow (content style)
				content: '<div id="infowindow_'+i+'_'+map_id+'" name="'+i+'" value="" class="infoWindowOverlay overlay_'+i+'">'+
							'<div class="infoWindowOverlayTop">'+
								'<div class="infoWindowOverlayTopLeft">'+
									'<div class="InfoWindowOverlayImgHolder">'+
										'<div class="infoWindowOverlayImg" style="background:#fff url('+marker_img+') no-repeat;"></div>'+
									'</div>'+
									'<div class="infoWindowOverlayClose"></div>'+
								'</div>'+
								'<div class="infoWindowOverlayTopRight">'+
									'<p><a href="'+post_url+'">'+items_title+'</a><br />'+
									items_details+'</p>'+
								'</div>'+
							'</div>'+
							'<div>'+
								'<div class="infoWindowOverlayArrow"></div>'+
							'</div>'+
						'</div>',
						
				offset:{
					x: parseInt(progress_map_vars.content_overlay_horizontal_pos),
					y: parseInt(progress_map_vars.content_overlay_vertical_pos)
				}
				
			};
				
		// Bubble style overlay
			
		}else if( !static_map && progress_map_vars.infowindow_type == 'bubble_style' ){
			
			var blank = (progress_map_vars.bubble_external_link == 'true') ? 'target="_blank"' : '';
			var link_text = (progress_map_vars.bubble_link_text != '') ? '<div class="pin_overlay_content"><a title="'+items_title+'" href="'+post_url+'" '+blank+'>'+progress_map_vars.bubble_link_text+'</a></div>' : '';
			
			var overlay_options = {
					
				// Rounded infowindow (bubble style)
				content: '<div id="bubble_'+post_id+'_'+map_id+'" class="marker_holder overlay_'+i+'" name="'+i+'">'+
							'<div class="pin_overlay img-'+i+'">'+
								'<div class="pin_overlay_img" style="background-image: url('+marker_img+');">'+
									link_text+									
								'</div>'+
							'</div>'+							
						 '</div>',		
													
				offset:{
					x: parseInt(progress_map_vars.bubble_horizontal_pos),
					y: parseInt(progress_map_vars.bubble_vertical_pos)
				}
			
			};
			
		}else if( static_map ){
			
			var overlay_options = {
					
				// Rounded infowindow (bubble style)
				content: '<div id="bubble_'+post_id+'" class="marker_holder img_map_holder overlay_'+i+'" name="'+i+'">'+
							'<div class="pin_overlay img-'+i+'">'+
								'<div class="pin_overlay_img" style="background-image: url('+marker_img+');">'+
									'<div class="pin_overlay_content">'+
										'<a href="'+post_url+'"><u>More</u></a>'+
									'</div>'+
								'</div>'+
							'</div>'+
						 '</div>',
													
				offset:{
					x:4,
					y:-80
				}
			
			};
			
		}
		
		return overlay_options;
	
	}

	// Clustering markers
	function cspm_clustering(plugin_map, map_id, light_map){

		var markerCluster;
		
		var mapObject = plugin_map.gmap3('get');
	
		small_cluster_size = progress_map_vars.small_cluster_size;
		medium_cluster_size = progress_map_vars.medium_cluster_size
		big_cluster_size = progress_map_vars.big_cluster_size;

		plugin_map.gmap3({
			get: {
				name: 'marker',
				all: true,
				callback: function(objs){
					markerCluster = new MarkerClusterer(mapObject, objs, {
						gridSize: parseInt(progress_map_vars.grid_size),
						styles: [{
									url: progress_map_vars.small_cluster_icon,
									height: small_cluster_size.split('x')[0],
									width: small_cluster_size.split('x')[1],
									textColor: progress_map_vars.cluster_text_color,
									textSize: 11,
									fontWeight: 'normal',
									fontFamily: 'sans-serif'
								}, {
									url: progress_map_vars.medium_cluster_icon,
									height: medium_cluster_size.split('x')[0],
									width: medium_cluster_size.split('x')[1],
									textColor: progress_map_vars.cluster_text_color,
									textSize: 13,	
									fontWeight: 'normal',								
									fontFamily: 'sans-serif'
								}, {
									url: progress_map_vars.big_cluster_icon,
									height: big_cluster_size.split('x')[0],
									width: big_cluster_size.split('x')[1],
									textColor: progress_map_vars.cluster_text_color,
									textSize: 15,		
									fontWeight: 'normal',							
									fontFamily: 'sans-serif'
								}],
						zoomOnClick: true,	
						ignoreHidden: true,	
					});					
						
					/**
					 * On load, Hide and show overlays depending on markers positions
					 * @Deprecated since 2.5		 		
					 ***********************/
					 setTimeout(function() {
						cspm_remove_overlays(markerCluster.getClusters(), map_id);
						cspm_load_overlays(plugin_map, map_id);	
					 }, 1000);				
					 /***********************
					 */
					
					/**
					 * On zoom changed, Hide and show overlays depending on markers positions	
					 * @Deprecated since 2.5		 		
					 ***********************/
					 google.maps.event.addListener(mapObject, 'zoom_changed', function() {				
						setTimeout(function() {
							cspm_remove_overlays(markerCluster.getClusters(), map_id);
							cspm_load_overlays(plugin_map, map_id);							
						}, 1000);
					 });
					 /***********************
					 */
					
					/**
					 * On zoom changed, Hide and show overlays depending on markers positions
					 * @Deprecated since 2.5		 		
					 ***********************/
					 google.maps.event.addListener(mapObject, 'center_changed', function() {				
						setTimeout(function() {
							if(progress_map_vars.infowindow_type != 'content_style'){
								cspm_remove_overlays(markerCluster.getClusters(), map_id);
								cspm_load_overlays(plugin_map, map_id);	
							}
							jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
							jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
						}, 1000);
					 });
					 /***********************
					 */
					
					var cluster_xhr;
					 
					// On cluster click, Hide and show overlays depending on markers positions	
					google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {
						
						// Get cluster position and convert it to XY
						var scale = Math.pow(2, mapObject.getZoom());
						var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
						var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
						var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(cluster.center_);
						var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
						var mapposition = plugin_map.position();

						var count_li = 0;
						
						var current_zoom = mapObject.getZoom();
						
						if(current_zoom >= 19) {
							
							var cluster_markers = cluster.getMarkers();									
							
							// @since 2.5 ====							
							var clustred_post_ids = [];
							// ===============
							
							for (var i = 0; i < cluster_markers.length; i++ ){
								
								if(cluster_markers[i].visible == true){
									
									count_li++;
									
									// @since 2.5 ====
									clustred_post_ids.push(cluster_markers[i].id);										
									// ===============
									
								}
								
							}
							
							jQuery('div.cluster_posts_widget_'+map_id+'').html('<div class="blue_cloud"></div>');
								
							if(count_li > 0){
								
								// @since 2.5 ====
								jQuery('div.cluster_posts_widget_'+map_id+'').removeClass('flipOutX');
								jQuery('div.cluster_posts_widget_'+map_id+'').addClass('cspm_animated flipInX').css('display', 'block');
								jQuery('div.cluster_posts_widget_'+map_id+'').css({left: (pixelOffset.x + mapposition.left + 40 + 'px'), top: (pixelOffset.y + mapposition.top - 32 + 'px')});	
			
								if(cluster_xhr && cluster_xhr.readystate != 4){
									cluster_xhr.abort();
								}
								
								cluster_xhr = jQuery.post(
									progress_map_vars.ajax_url,
									{
										action: 'cspm_load_clustred_markers_list',
										post_ids: clustred_post_ids,
										light_map: light_map
									},
									function(data){	
										
										jQuery('div.cluster_posts_widget_'+map_id+'').html(data);
										
										// Call custom scroll bar for infowindow
										jQuery("div.cluster_posts_widget_"+map_id+"").mCustomScrollbar("destroy");
										jQuery("div.cluster_posts_widget_"+map_id+"").mCustomScrollbar({
											autoHideScrollbar:true,
											theme:"dark-thin"
										});												
										
									}
								);
								
								jQuery("div.cluster_posts_widget_"+map_id+" ul li").livequery('click', function(){
									
									var id = jQuery(this).attr('id');
									var i = jQuery('li#'+map_id+'_list_items_'+id+'').attr('value');
									cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
									cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
									
								});
								
							}else jQuery('div.cluster_posts_widget_'+map_id+'').css({'display':'none'});
		
							mapObject.setZoom(mapObject.getZoom() - 1);
							mapObject.setZoom(mapObject.getZoom() + 1);
		
						}
						
						/**
						 * @Deprecated since 2.5		 		
						 ***********************/
						 cspm_load_overlays(plugin_map, map_id);
						 /***********************
						 */
								
					});
					
				}
			}
			
		});
		
		return markerCluster;
	
	}

	function cspm_simple_clustering(plugin_map, map_id){
		
		var mapObject = plugin_map.gmap3('get');
		var markerCluster = new MarkerClusterer(mapObject);
		
    	mapObject.setZoom(mapObject.getZoom() - 1);
		mapObject.setZoom(mapObject.getZoom() + 1);
		
		/**
		 * @Deprecated since 2.5		 		
		 ***********************/
		 setTimeout(function() {
			 cspm_remove_overlays(markerCluster.getClusters(), map_id);
			 cspm_load_overlays(plugin_map, map_id);							
		 }, 600);
		 /***********************
		 */	
							
	}
	
	// Get items data function via ajax
	function cspm_ajax_item_details(post_id, map_id){

		jQuery.post(
			progress_map_vars.ajax_url,
			{
				action: 'cspm_load_carousel_item',
				post_id: post_id,
				items_view: progress_map_vars.items_view,
			},
			function(data){	
				jQuery("li#"+map_id+"_list_items_"+post_id+"").addClass('cspm_animated fadeIn').html(data);															
			}
		);
	
	}
	
	/**
	 * Load overlays for markers outside clusters
	 * @Deprecated since 2.5
	 */	
	function cspm_load_overlays(plugin_map, map_id){
	
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {
					jQuery.each(objs, function(i, obj) {									
						if(obj.getMap()) {
							if(obj.visible == true){
								var marker_id = obj.id;
								jQuery('div#bubble_'+marker_id+'_'+map_id+'').css({'display':'block'}); 
							}
						};
					});
				}
			}
		});
	
	}										
	
	/**
	 * hide overlays for markers inside clusters
	 * @Deprecated since 2.5
	 */	
	function cspm_remove_overlays(clusters, map_id){

		jQuery('div.infoWindowOverlay').hide();					
		jQuery.each(clusters, function(i, cluster) {
			var markers = cluster.getMarkers();
			if(markers.length > 1) {
				jQuery.each(markers, function(i, marker) {					
					var marker_id = marker.id;
					jQuery('div#bubble_'+marker_id+'_'+map_id+'').css({'display':'none'}); 
				});
			}
		});	
		
	}
	
	// Animate the selected marker
	function cspm_animate_marker(plugin_map, map_id, post_id){
		
		plugin_map.gmap3({
			get: {
				name: 'marker',
				tag: 'post_id__'+post_id+'',
				callback: function(marker){
					if(marker.visible == true){						
						
						var is_child = marker.is_child;	
						var marker_infobox = 'div.cspm_infobox_container.infobox_'+post_id+'[data-is-child='+is_child+']';

						if(progress_map_vars.markerAnimation == 'pulsating_circle'){
								
							var mapObject = plugin_map.gmap3('get');
	
							// Get marker position and convert it to XY
							var scale = Math.pow(2, mapObject.getZoom());
							var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
							var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
							var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(marker.position);
							var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
							var mapposition = plugin_map.position();
		
							jQuery('div#pulsating_holder.'+map_id+'_pulsating').css({'display':'block', 'left':(pixelOffset.x + mapposition.left - 15 + 'px'), 'top':(pixelOffset.y + mapposition.top - 18 + 'px')});
							setTimeout(function(){
								jQuery('div#pulsating_holder.'+map_id+'_pulsating').css('display', 'none');
								jQuery(marker_infobox).addClass('cspm_current_bubble');
							},1500);
							
						}else if(progress_map_vars.markerAnimation == 'bouncing_marker'){
						 								
							marker.setAnimation(google.maps.Animation.BOUNCE);
							setTimeout(function(){
								marker.setAnimation(null);
								jQuery(marker_infobox).addClass('cspm_current_bubble');
							},1500);
							
						}else if(progress_map_vars.markerAnimation == 'flushing_infobox'){						
							
							jQuery('div.cspm_infobox_container').removeClass('cspm_animated flash');
							setTimeout(function(){								
								jQuery(marker_infobox).addClass('cspm_animated flash');
								jQuery(marker_infobox).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){jQuery(marker_infobox).removeClass('flash');});
							}, 600);
							
						}

					}
				}
			}
		});
	
	}

	// Zoom-in function
	function cspm_zoom_in(selector, mapObj){
		
		selector.click(function(){
			
			var map = jQuery(mapObj).gmap3("get");
			
    		map.setZoom(map.getZoom() + 1);
			
			jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
			jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
	
		});
		
	}

	// Zoom-out function
	function cspm_zoom_out(selector, mapObj){
		
		selector.click(function(){
					
			var map = jQuery(mapObj).gmap3("get");
    		
			map.setZoom(map.getZoom() - 1);
			
			jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
			jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
			
		});
		
	}
	
//============================//
//==== Carousel functions ====//
//============================//

	// Initialize carousel
	function cspm_init_carousel(carousel_size, carousel_id){

		if(progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
			
			var vertical_value = false;	
			var dimension = (progress_map_vars.items_view == 'listview') ? progress_map_vars.horizontal_item_width : progress_map_vars.vertical_item_width;
			
			if(progress_map_vars.main_layout == "mr-cl" || progress_map_vars.main_layout == "ml-cr"  || progress_map_vars.main_layout == "map-tglc-right"  || progress_map_vars.main_layout == "map-tglc-left"){
				var vertical_value = true;
				var dimension = (progress_map_vars.items_view == 'listview') ? progress_map_vars.horizontal_item_height : progress_map_vars.vertical_item_height;
			}
			
			var size = {}; 
			var auto_scroll_option = {}; 
			
			if(progress_map_vars.number_of_items != '')
				var size = { size: parseInt(progress_map_vars.number_of_items) };
			else if(carousel_size != null)
				var size = { size: parseInt(carousel_size) };
				
			var default_options = {
				
				scroll: eval(progress_map_vars.carousel_scroll),
				wrap: progress_map_vars.carousel_wrap,
				auto: eval(progress_map_vars.carousel_auto),		
				initCallback: cspm_carousel_init_callback,
				itemFallbackDimension: parseInt(dimension),
				itemLoadCallback: cspm_carousel_itemLoadCallback,
				rtl: eval(progress_map_vars.carousel_mode),
				animation: progress_map_vars.carousel_animation,
				easing: progress_map_vars.carousel_easing,
				vertical: vertical_value,	
			
			};
			
			if(eval(progress_map_vars.carousel_auto) > 0)
				var auto_scroll_option = { itemFirstInCallback: { onAfterAnimation:  cspm_carousel_item_request } }
			else var auto_scroll_option = { itemFirstInCallback: cspm_carousel_itemFirstInCallback, }
		
			var carousel_options = jQuery.extend({}, default_options, size, auto_scroll_option);
			
			// Init jcarousel
			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id+'').jcarousel(carousel_options);	

		}else return false;		
		
	}
	
	function cspm_carousel_itemFirstInCallback(carousel, item, idx, state) {
		
		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		if(state == "prev" || state == "next"){
			
			var item_value = item.value;

			cspm_carousel_item_hover_style('li.carousel_item_'+item_value+'_'+map_id+'', map_id);
				
		}
		
		return false;
		
	}

	// Load Items in the screenview
	function cspm_carousel_itemLoadCallback(carousel){
				
		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		for(var i = parseInt(carousel.first); i <= parseInt(carousel.last); i++){
			
			var post_id = jQuery('.jcarousel-item-'+ i +'').attr('class').split(' ')[0];
			
			// Check if the requested items already exist
			if ( jQuery('.jcarousel-item-'+ i +'').has('div.cspm_spinner').length ){
				
				// Get items details
				cspm_ajax_item_details(post_id, map_id);	
				
			}
			
		}
		
	}

	// Carousel callback function
	function cspm_carousel_init_callback(carousel){
		
		var carousel_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];

		// Move the carousel with scroll wheel
		if(progress_map_vars.scrollwheel_carousel == 'true'){

			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id+'').mousewheel(function(event, delta) {
					
				if (delta > 0){
					carousel.prev();
					setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
					return false;
				}else if (delta < 0){
					carousel.next();
					setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
					return false;
				}
					
			});
			
		}
		
		// Touch swipe option
		if(progress_map_vars.touchswipe_carousel == 'true'){

			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id+'').swipe({ 
				
				//Generic swipe handler for all directions
				swipe:function(event, direction, distance, duration, fingerCount) {

					if(progress_map_vars.main_layout == 'mu-cd' || progress_map_vars.main_layout == 'md-cu' || progress_map_vars.main_layout == 'm-con' || progress_map_vars.main_layout == 'fullscreen-map-top-carousel' || progress_map_vars.main_layout == 'fit-in-map-top-carousel'){
						
						if(direction == 'left'){
							carousel.next();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}else if(direction == 'right'){
							carousel.prev();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}
						
					}else if(progress_map_vars.main_layout == 'ml-cr' || progress_map_vars.main_layout == 'mr-cl'){
						
						if(direction == 'up'){
							carousel.next();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}else if(direction == 'down'){
							carousel.prev();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}
						
					}															
					
				},
				threshold:0				
			});
			
		}
		
		// Pause autoscrolling if the user moves with the cursor over the carousel
		carousel.clip.hover(function() {
			carousel.stopAuto();
		}, function() {
			carousel.startAuto();
		});
		
		// Next button 
		carousel.buttonNext.bind('click', function() {
			setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
		});
		
		// Previous button
		carousel.buttonPrev.bind('click', function() {		
			setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
		});
		
	}					
	
	function cspm_carousel_item_request(carousel){

		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id+'');
		
		var firstItem = parseInt(carousel.first);
		
		var overlay_id = jQuery('.jcarousel-item-'+ firstItem +'').attr('class').split(' ')[0];

		if(overlay_id){
			
			var item_latlng = jQuery('li#'+map_id+'_list_items_'+overlay_id+'').attr('name');
			
			if(item_latlng){
					
				var split_item_latlng = item_latlng.split('_');
				var this_lat = split_item_latlng[0].replace(/\"/g, '');
				var this_lng = split_item_latlng[1].replace(/\"/g, '');
					
				cspm_carousel_item_hover_style('li#'+map_id+'_list_items_'+overlay_id+'', map_id);
					
				var map = jQuery('div#codespacing_progress_map_div_'+map_id+'').gmap3("get");							
				
				cspm_center_map_at_point(plugin_map, this_lat, this_lng)
					
				// Overlay active style 
				// @Depricated since 2.5 ====
				jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
				jQuery('div#bubble_'+overlay_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');
				// ==========================
				
				setTimeout(function(){cspm_animate_marker(plugin_map, map_id, overlay_id);},200);
			
			}
			
		}
				
	}

	// Call carousel items								
	function cspm_call_carousel_item(carousel, id){
		
		carousel.scroll(jQuery.jcarousel.intval(id));
		return false;
		
	}
	
	// Custom style for the first and selected carousel item
	function cspm_carousel_item_hover_style(item_selector, map_id){								

		jQuery('li[id^='+map_id+'_list_items_]').removeClass('cspm_carousel_first_item').css({'background-color':progress_map_vars.items_background});
		jQuery(item_selector).addClass('cspm_carousel_first_item').css({'background-color':progress_map_vars.items_hover_background});	
		
	}
	
	function cspm_object_size(obj){
			
		var size = 0, key;
		for (key in obj) {
			if (obj.hasOwnProperty(key)) size++;
		}
		return size;
					
	}
	
	function cspm_rewrite_carousel(show_carousel, carousel_id, posts_to_retreive, map_id){

		if(show_carousel == "yes" && progress_map_vars.show_carousel == "true" && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
	
			var carousel = carousel_id.data('jcarousel');
			
			carousel.reset();
			
			var carousel_length = cspm_object_size(posts_to_retreive)
	
			if(progress_map_vars.items_view == "listview"){ 
			
				item_width = parseInt(progress_map_vars.horizontal_item_width);										
				item_height = parseInt(progress_map_vars.horizontal_item_height);
				item_css = progress_map_vars.horizontal_item_css;
				items_background  = progress_map_vars.items_background;
			
			}else if(progress_map_vars.items_view == "gridview"){ 
			
				item_width = parseInt(progress_map_vars.vertical_item_width);
				item_height = parseInt(progress_map_vars.vertical_item_height);
				item_css = progress_map_vars.vertical_item_css;
				items_background  = progress_map_vars.items_background;
				
			}
	
			var count_loop = 0;
						
			for(var c = 0; c < carousel_length; c++){
				
				var post_id = posts_to_retreive[c];
				var is_child = post_ids_and_child_status[map_id][post_lat_lng_coords[map_id][post_id]];
				
				var carousel_item = '';							
			
				carousel_item = '<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+(c+1)+'_'+map_id+'" data-is-child="'+is_child+'" name="'+post_lat_lng_coords[map_id][post_id]+'" value="'+(c+1)+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; margin:4px 3px; '+item_css+'">';
					carousel_item += '<div class="cspm_spinner"></div>';
				carousel_item += '</li>';
			
				carousel.add(c+1, carousel_item);
				
				count_loop++;
				
			}					
								
			cspm_init_carousel(carousel_length, map_id);
			
			return count_loop++;
							
		}

	}
	
	function cspm_fullscreen_map(){
		
		var screenWidth = window.innerWidth;
		var screenHeight = window.innerHeight;

		jQuery('div.codespacing_progress_map_area').css({height : screenHeight, width : screenWidth});
	
	}
		
	function cspm_carousel_width(){
		
		var carouselWidth = jQuery('div.codespacing_progress_map_area').width();
		
		carouselWidth = parseInt(carouselWidth - 40);
		
		var carouselHalf = parseInt((-0) - ( carouselWidth/ 2));

		jQuery('div.codespacing_progress_map_carousel_on_top').css({width : carouselWidth, 'margin-left' : carouselHalf+'px'});
	
	}
		
	function cspm_toggle_carousel_width(){
		
		var carouselWidth = jQuery('div.codespacing_progress_map_area').width();

		jQuery('div.cspm_toggle_carousel_horizontal').css({width : carouselWidth});
	
	}

	function cspm_fitIn_map(){
		
		var parentHeight = jQuery('div.codespacing_progress_map_area').parent().height();
		
		if(parentHeight == 0) parentHeight = progress_map_vars.layout_fixed_height;

		jQuery('div.codespacing_progress_map_area').css({height : parentHeight});
	
	}
	
	function cspm_set_markers_visibility(plugin_map, value, j, post_ids_and_categories, posts_to_retreive, retreive_posts){
		
		if(retreive_posts == true){
			
			// @value: Refers to the category ID
			if(value != null){
				// Show markers comparing with the category ID (faceted search case)
				plugin_map.gmap3({
					get: {
						name: "marker",
						all: true,
						callback: function(objs){
							jQuery.each(objs, function(i, obj){
								
								if(jQuery.inArray(value, post_ids_and_categories['post_id_'+obj.post_id][0]) > -1){
									
									if(typeof obj.setVisible === 'function')
										obj.setVisible(true);
										
									if(jQuery.inArray(obj.post_id, posts_to_retreive) === -1){
										posts_to_retreive[j] = obj.post_id;	
										j++;
									}	
										
								}
								
							});
						}
					}
				});
				
			}else{
				
				// Show markers comparing with the search area radius (Search form case)
				plugin_map.gmap3({
					get: {
						name: "marker",
						all: true,
						callback: function(objs){
							jQuery.each(objs, function(i, obj){
								if(typeof obj.setVisible === 'function' && (jQuery.inArray(obj.post_id, posts_to_retreive) > -1))
									obj.setVisible(true);	
							});
						}
					}
				});
			
			}
		
		// Show all markers	
		}else{
			
			plugin_map.gmap3({
				get: {
					name: "marker",
					all: true,
					callback: function(objs){
						jQuery.each(objs, function(i, obj){
							if(typeof obj.setVisible === 'function') obj.setVisible(true);
							posts_to_retreive[j] = obj.post_id;	
							j++;
						});
					}
				}
			});

		}
		
		return posts_to_retreive;
		
	}

	// Get Two Address's And Return Distance In Between
	// @distance_unit = imperial / metric 
	function cspm_get_distance(origin_lat, origin_lng, destination_lat, destination_lng, distance_unit){
		
		var earth_radius = (distance_unit == "metric") ? 6380 : (6380*0.621371192);
		
		return distance = Math.acos(Math.sin(cspm_deg2rad(destination_lat))*Math.sin(cspm_deg2rad(origin_lat))+Math.cos(cspm_deg2rad(destination_lat))*Math.cos(cspm_deg2rad(origin_lat))*Math.cos(cspm_deg2rad(destination_lng)-cspm_deg2rad(origin_lng)))*earth_radius;
		
	}

	function cspm_center_map_at_point(plugin_map, latitude, longitude){
				
		var mapObject = plugin_map.gmap3("get");
		
		var latLng = new google.maps.LatLng(latitude, longitude);
			
		mapObject.panTo(latLng);
		mapObject.setCenter(latLng);
		mapObject.setZoom(parseInt(carousel_map_zoom));
		
	}

	function cspm_is_bounds_contains_marker(plugin_map, latitude, longitude){
		
		var mapObject = plugin_map.gmap3('get');
		var myLatlng = new google.maps.LatLng(latitude, longitude);
		return mapObject.getBounds().contains(myLatlng);		
							
	}
		
	var cspm_requests = {};
	var cspm_bubbles = {};
	var cspm_child_markers = {};
	
	function cspm_draw_multiple_infoboxes(plugin_map, map_id, infobox_html_content, infobox_type){
	
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {				
										
					for(var i = 0; i < objs.length; i++){	
																				
						var post_id = objs[i].post_id;
						var latLng = objs[i].position;
						var icon_height = (typeof objs[i].icon === 'undefined' || typeof objs[i].icon.size === 'undefined' || typeof objs[i].icon.size.height === 'undefined') ? 38 : objs[i].icon.size.height;
						var is_child = objs[i].is_child;
						
						// Convert the LatLng object to array
						var marker_position = jQuery.map(latLng, function(value, index) {
							return [value];
						});
						var lat = marker_position[0];
						var lng = marker_position[1];	

						// if the marker is within the viewport of the map
						if(cspm_is_bounds_contains_marker(plugin_map, lat, lng) && objs[i].getMap() != null && objs[i].visible == true){
							
							var this_infobox_div = jQuery('div.infobox_'+post_id+'.cspm_infobox_'+map_id+'[data-is-child='+is_child+']');

							// If the infobox was already created ...
							if(jQuery.contains(document.body, this_infobox_div[0])){
								
								// ... Set its position to the top of the marker
								cspm_infobox_set_position(plugin_map, this_infobox_div, latLng, icon_height);
							
							// If the infobox not created ...
							}else{
								
								// 1. Create the marker infobox
								var this_infobox_div = infobox_html_content;
								this_infobox_div = this_infobox_div.split('<div class="cspm_infobox_container cspm_infobox_multiple cspm_infobox_'+map_id+' '+infobox_type+'');
								this_infobox_div = jQuery('<div data-is-child="'+is_child+'" class="cspm_infobox_container cspm_infobox_multiple cspm_infobox_'+map_id+' '+infobox_type+' infobox_'+post_id+''+this_infobox_div[1]);
								
								// 2. Append the infobox to the map
								jQuery(plugin_map.selector).parent().append(this_infobox_div);
								
								// 3. Set the position of the infobox on to of the marker
								cspm_infobox_set_position(plugin_map, this_infobox_div, latLng, icon_height);
								
								// 4. Save the ajax requests in an array
								cspm_bubbles[map_id].push(post_id);
								cspm_child_markers[map_id].push(is_child);
								cspm_requests[map_id].push(jQuery.post(
									progress_map_vars.ajax_url,
									{
										action: 'cspm_infobox_content',
										post_id: post_id,
										infobox_type: infobox_type,
										map_id: map_id,
										status: 'cspm_infobox_multiple'
									}
								));
								
							}															
						
						// Hide the infobox when the marker is outside the viewport of the map	
						}else jQuery('div.infobox_'+post_id+'.cspm_infobox_'+map_id+'[data-is-child='+is_child+']').fadeOut();	

						// Detect the end of the loop
						if(i == (objs.length-1)){
							// If the was any new infoboxes created
							if(cspm_bubbles[map_id].length > 0){
								// Load their content just after ajax requests were finished
								var cspm_defer = jQuery.when.apply(jQuery, cspm_requests[map_id]);
								cspm_defer.done(function(){
									if(cspm_requests[map_id].length == 1){
										if(arguments[1] == 'success')
											jQuery('div.infobox_'+cspm_bubbles[map_id][0]+'.cspm_infobox_'+map_id+'[data-is-child='+cspm_child_markers[map_id][0]+']').html(arguments[0]);		
									}else if(cspm_requests[map_id].length > 1){
										jQuery.each(arguments, function(index, responseData){
											if(responseData.length > 0 && responseData[1] == 'success')
												jQuery('div.infobox_'+cspm_bubbles[map_id][index]+'.cspm_infobox_'+map_id+'[data-is-child='+cspm_child_markers[map_id][index]+']').html(responseData[0]);		
										});
									}
								});
							}	
						}
						
					}
																												
				}
			}
		});
		
	}

	function cspm_draw_single_infobox(plugin_map, map_id, infobox_div, infobox_type, marker_obj, infobox_xhr){

		var post_id = marker_obj.post_id;
		var icon_height = (typeof marker_obj.icon === 'undefined' || typeof marker_obj.icon.size === 'undefined' || typeof marker_obj.icon.size.height === 'undefined') ? 38 : marker_obj.icon.size.height;
		
		// 1. Get the post_id from the infobox
		var infobox_post_id = infobox_div.attr('data-post-id');
		
		// 2. Compare the infobox post_id with the clicked marker post_id ...
		// ... to make sure not loading the content again
		if(infobox_post_id != post_id){
			
			var infobox_html = '<div class="blue_cloud"></div><div class="cspm_arrow_down '+infobox_type+'"></div>';
			infobox_div.html(infobox_html);															
			
			if(infobox_xhr && infobox_xhr.readystate != 4){
				infobox_xhr.abort();
			}
			
			infobox_xhr = jQuery.post(
				progress_map_vars.ajax_url,
				{
					action: 'cspm_infobox_content',
					post_id: post_id,
					infobox_type: infobox_type,
					map_id: map_id,
					status: 'cspm_infobox_single'
				},
				function(data){
					infobox_div.html(data);															
				}
			);
			
		}
		
		// 3. Update the infobox post_id attribute
		infobox_div.attr('data-post-id', post_id);
		
		// 4. Set the position on the infobox on top of the marker
		cspm_infobox_set_position(plugin_map, infobox_div, marker_obj.position, icon_height);
		
		return infobox_xhr;
	
	}
	
	function cspm_set_single_infobox_position(plugin_map, infobox_div){
		
		if(infobox_div.is(':visible')){
			
			var post_id = infobox_div.attr('data-post-id');
			
			plugin_map.gmap3({
			  get: {
				name: 'marker',
				tag: 'post_id__'+post_id+'',
				callback: function(obj){
					var icon_height = (typeof obj.icon === 'undefined' || typeof obj.icon.size === 'undefined' || typeof obj.icon.size.height === 'undefined') ? 38 : obj.icon.size.height;
					cspm_infobox_set_position(plugin_map, infobox_div, obj.position, icon_height);
					// Hide the infobox when the marker was clustred or no more visible
					setTimeout(function(){ 
						if(obj.getMap() == null || obj.visible == false){
							infobox_div.addClass('cspm_animated fadeOutUp');					
							infobox_div.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								infobox_div.hide().removeClass('cspm_animated fadeOutUp');
							});		
						}
					}, 400);
				}
			  }
			});									
		}	
			
	}
	
	function cspm_infobox_set_position(plugin_map, infobox_div, marker_position, marker_icon_height){

		var mapObject = plugin_map.gmap3('get');
						
		// Get marker position and convert it to XY
		var scale = Math.pow(2, mapObject.getZoom());
		var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
		var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
		var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(marker_position);
		var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
		var mapposition = plugin_map.position();
		
		var infobox_half_width = infobox_div.width() / 2;
		var margin_top = marker_icon_height + infobox_div.height();		
		
		infobox_div.css({'left':(pixelOffset.x + mapposition.left + 'px'),
  						 'top':(pixelOffset.y + mapposition.top + 'px'), 
						 'margin-left':('-' + infobox_half_width + 'px'),
						 'margin-top':('-'+margin_top+'px')
					   }).fadeIn('slow');
					   
	}
	
	// Count the number of visible markers in the map
	// @since 2.5
	function cspm_nbr_of_visible_markers(plugin_map){
		
		var count_posts = 0;
		
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {				
					for(var i = 0; i < objs.length; i++){	
						if(objs[i].visible == true){
							count_posts++;
						}
					}
				}
			}
		});		
		
		return count_posts;
		
	}
	
	// Hide all visible markers in the map
	// @since 2.5
	function cspm_hide_all_markers(plugin_map){
		
		var r = jQuery.Deferred();
		
		plugin_map.gmap3({
			get: {
				name: "marker",				
				all: true,	
				callback: function(objs){
					jQuery.each(objs, function(i, obj){
						if(typeof obj.setVisible === 'function')
							obj.setVisible(false);
					});
					r.resolve();
				}
			}
		});
				
		return r;
		
	}
	
	// Remove duplicate emlements from an array
	// @since 2.5
	function cspm_remove_array_duplicates(array){
		var new_array = [];
		var i = 0;
		jQuery.each(array, function(index, element){
			if(jQuery.inArray(element, new_array) === -1){
				new_array[i] = element;	
				i++;
			}
		});
		return new_array;
	}
		
//=========================//
//==== Other functions ====//
//=========================//
	
	function cspm_strpos(haystack, needle, offset) {
		
	  // From: http://phpjs.org/functions
	  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  // +   improved by: Onno Marsman
	  // +   bugfixed by: Daniel Esteban
	  // +   improved by: Brett Zamir (http://brett-zamir.me)
	  // *     example 1: strpos('Kevin van Zonneveld', 'e', 5);
	  // *     returns 1: 14
	  var i = (haystack + '').indexOf(needle, (offset || 0));
	  return i === -1 ? false : i;
	  
	}

	function cspm_deg2rad(angle) {
		
	  // From: http://phpjs.org/functions
	  // +   original by: Enrique Gonzalez
	  // +     improved by: Thomas Grainger (http://graingert.co.uk)
	  // *     example 1: deg2rad(45);
	  // *     returns 1: 0.7853981633974483
	  return angle * .017453292519943295; // (angle / 180) * Math.PI;
	
	}	
	
	function alerte(obj) {
		
		if (typeof obj == 'object') {
			var foo = '';
			for (var i in obj) {
				if (obj.hasOwnProperty(i)) {
					foo += '[' + i + '] => ' + obj[i] + '\n';
				}
			}
			alert(foo);
		}else {
			alert(obj);
		}
		
	}
	
	jQuery(document).ready(function($) {				

		if(progress_map_vars.faceted_search_option == 'true'){
	
			// Customize Checkboxes and Radios button
		
			if(progress_map_vars.faceted_search_input_skin == 'line'){
				
				var skin_color = '-'+progress_map_vars.faceted_search_input_color;
				
				$('form.faceted_search_form input').each(function(){
					
					var self = $(this),
					  label = self.next(),
					  label_text = label.text();
				
					label.remove();
					self.iCheck({
						checkboxClass: 'icheckbox_line'+skin_color+'',
						radioClass: 'iradio_line'+skin_color+'',
						insert: '<div class="icheck_line-icon"></div>' + label_text,
						inheritClass: true
					});		
				
				});
				
			}else{
				
				if(progress_map_vars.faceted_search_input_skin == 'polaris' || progress_map_vars.faceted_search_input_skin == 'futurico') var skin_color = '';
				else var skin_color = '-'+progress_map_vars.faceted_search_input_color;
				
				$('form.faceted_search_form input').iCheck({
					checkboxClass: 'icheckbox_'+progress_map_vars.faceted_search_input_skin+skin_color+'',
					radioClass: 'iradio_'+progress_map_vars.faceted_search_input_skin+skin_color+'',
					increaseArea: '20%',
					inheritClass: true
				});
			
			}
		
		
			// Faceted search =====		
		
			$('div.faceted_search_btn').livequery('click', function(){

				var map_id = $(this).attr('id');
				var status = $(this).attr('data-status');
				
				if($('div.faceted_search_container_'+map_id+'').is(':visible')){
					$('div.faceted_search_container_'+map_id+'').removeClass('slideInLeft').addClass('cspm_animated slideOutLeft');
					setTimeout(function(){$('div.faceted_search_container_'+map_id+'').css({'display':'none'});},200);
				}else{					
					$('div.faceted_search_container_'+map_id+'').removeClass('slideOutLeft').addClass('cspm_animated fadeInRight').css({'display':'block'});
				}
				
				// Call custom scroll bar for faceted search list
				$("div[class^=faceted_search_container] form.faceted_search_form ul").mCustomScrollbar("destroy");
				$("div[class^=faceted_search_container] form.faceted_search_form ul").mCustomScrollbar({
					autoHideScrollbar:false,
					theme:"dark-thin"
				});
				
			});

			$('div[class^=reset_map_list]').livequery('click', function(){
				
				var map_id = $(this).attr('id');
				
				$('form#faceted_search_form_'+map_id+' input').iCheck('uncheck');
				
				$(this).hide();
			
			});
		
			var posts_to_retreive = {};
			
			$('form.faceted_search_form input').livequery('ifChanged', function(){
				
				var map_id = $(this).attr('class').split(' ')[1];
				var carousel = $(this).attr('class').split(' ')[2];
	
				var plugin_map = $('div#codespacing_progress_map_div_'+map_id+'');
				
				// Hide all markers
				cspm_hide_all_markers(plugin_map).done(function(){
					
					// Hide all bubbles
					// @Depricated since 2.5 ====
					for (var post in post_ids_and_categories[map_id]) {
						if (post_ids_and_categories[map_id].hasOwnProperty(post)) {
							var post_id = post.split('_')[2]; 		
							$('div#bubble_'+post_id+'_'+map_id+'').css({'display':'none'}); 
						}
					}					
					// ==========================
					
					if(progress_map_vars.faceted_search_multi_taxonomy_option == "false")
						$('div.reset_map_list_'+map_id+'').show();
					
					posts_to_retreive[map_id] = [];
					var retreived_posts = [];
					var i = 0;
					var j = 0;
					var num_checked = 0;
					var count_posts = 0;					
							
					$('div.faceted_search_container_'+map_id+' form.faceted_search_form input').each(function(){
		
						if($(this).prop('checked') == true){ 
							
							num_checked++;
							
							var input_checked = $(this).attr("name").split('___')[0];
							
							var value = $(this).val();
	
							// Loop throught post_ids and check its relation with the current category
							// Then show markers within the selected category
							retreived_posts = cspm_remove_array_duplicates(retreived_posts.concat(cspm_set_markers_visibility(plugin_map, value, j, post_ids_and_categories[map_id], posts_to_retreive[map_id], true)));
							cspm_simple_clustering(plugin_map, map_id);
							count_posts = cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), retreived_posts, map_id);
							
							i++;
		
						}								
						
					});
					
					// Show all markers when there is no checked category
					if(num_checked == 0){
						
						var j = 0;
		
						cspm_set_markers_visibility(plugin_map, null, j, post_ids_and_categories[map_id], posts_to_retreive[map_id], false);
						cspm_simple_clustering(plugin_map, map_id);
						count_posts = cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), posts_to_retreive[map_id], map_id);
							
					}	
					
					if(progress_map_vars.show_posts_count == "yes")
						$('span.the_count_'+map_id+'').empty().html(count_posts);
					
				});
					
			});
		
			// @Facetd search ====
			
		}
		
			
		// The event handler of the carousel items
		
		if(progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
			
			jQuery('ul[id^=codespacing_progress_map_carousel_] li').livequery('click', function(){
				
				var map_id = $(this).attr('id').split('_list_items_')[0];				
				var item_value = jQuery(this).attr('value');				
				var post_id = jQuery(this).attr('class').split(' ')[0];	// @Deprecated since 2.5				
						
				
				// Move the clicked carousel item to the first position
				cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), item_value);
				
				setTimeout(function(){
					var carousel = jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel');
					cspm_carousel_item_request(carousel);
				}, 600);
				
				/**
				 * Add overlay active style (used only for bubble infowindow style) 
				 * @Deprecated since 2.5		 		
				 ***********************/
				if(progress_map_vars.infowindow_type != 'content_style'){		
					jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
					jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');	
				}
				/***********************
				*/
				
			}).css('cursor','pointer');

		}
		
		// @Event handler
		
		
		// Search form request

		if(progress_map_vars.search_form_option == 'true'){
	
			// Customize the slider text box
			$("input.cspm_sf_slider_range").ionRangeSlider({
				type: 'single',		
			});
			
			// Reset the search form & the map
			$('div[class^=cspm_reset_search_form]').livequery('click', function(){
				
				var map_id = $(this).attr('data-map-id');
				var carousel = $(this).attr('data-show-carousel');
				var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id+'');
				
				posts_to_retreive[map_id] = [];
				
				cspm_set_markers_visibility(plugin_map, null, 0, post_ids_and_categories[map_id], posts_to_retreive[map_id], false);
				cspm_simple_clustering(plugin_map, map_id);
				cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), posts_to_retreive[map_id], map_id);
				
				if(progress_map_vars.show_posts_count == "yes")
					$('span.the_count_'+map_id+'').empty().html(posts_to_retreive[map_id].length);
									
				plugin_map.gmap3({
					clear: {
						name:"circle",
						all: true
					},
				});
				
				$('form#search_form_'+map_id+' input#cspm_address').attr('value', '');
				
				$(this).removeClass('fadeIn').hide();
						
			});
			
			// Load the search form to the screen
			$('div.search_form_btn').livequery('click', function(){
				
				var map_id = $(this).attr('id');
				var status = $(this).attr('data-status');
				
				if($('div.search_form_container_'+map_id+'').is(':visible')){
					$('div.search_form_container_'+map_id+'').removeClass('fadeInUp').addClass('cspm_animated slideOutLeft');
					setTimeout(function(){
						$('div.search_form_container_'+map_id+'').css({'display':'none'});							
					},200);
				}else{										
					$('div.search_form_container_'+map_id+'').removeClass('slideOutLeft').addClass('cspm_animated fadeInUp').css({'display':'block'});
					setTimeout(function(){
						$('form#search_form_'+map_id+' input[name=cspm_address]').focus();
					},400);
				}
				
			});
			
			// Submit the search form data
			jQuery('div[class^=cspm_submit_search_form_]').livequery('click', function(){
				
				var map_id = jQuery(this).attr('data-map-id');
				var carousel = jQuery(this).attr('data-show-carousel');
				var address = jQuery('form#search_form_'+map_id+' input[name=cspm_address]').val();
				var distance = jQuery('form#search_form_'+map_id+' input[name=cspm_distance]').val();
				var distance_unit = jQuery('form#search_form_'+map_id+' input[name=cspm_distance_unit]').val();
								
				var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id+'');
				
				jQuery('div.cspm_submit_search_form_'+map_id+'').hide();
				jQuery('div.cspm_loader_search_form_'+map_id+'').show();
				
				var posts_in_search = {};				
				posts_in_search[map_id] = [];

				var geocoder = new google.maps.Geocoder();
				
				// Convert our address to Lat & Long
				geocoder.geocode({ 'address': address }, function (results, status) {
					
					// If the address is found
					if (status == google.maps.GeocoderStatus.OK) {
						
						var latitude = results[0].geometry.location.lat();
						var longitude = results[0].geometry.location.lng();
										
						plugin_map.gmap3({
							get: {
								name: 'marker',
								all:  true,
								callback: function(objs) {
									
									var j = 0;
									
									// Get all markers inside the radius of our address
									jQuery.each(objs, function(i, obj) {									
										
										var marker_id = obj.id;
										
										// Convert the LatLng object to array
										var post_latlng = jQuery.map(obj.position, function(value, index) {
											return [value];
										});
										
										// Calculate the distance and save the post_id							
										if(cspm_get_distance(latitude, longitude, post_latlng[0], post_latlng[1], distance_unit) < parseInt(distance)){
											posts_in_search[map_id][j] = marker_id;													
											j++;
										}
										
									});
									
									// If one or more posts are found within the radius area
									if(cspm_object_size(posts_in_search[map_id]) > 0){
										
										// Hide all markers	
										cspm_hide_all_markers(plugin_map).done(function(){
										
											// Hide all bubbles
											// @Depricated since 2.5 ====
											for (var post in post_ids_and_categories[map_id]) {
												if (post_ids_and_categories[map_id].hasOwnProperty(post)) {
													var post_id = post.split('_')[2]; 		
													$('div#bubble_'+post_id+'_'+map_id+'').css({'display':'none'}); 
												}
											}
											// ==========================
					
											// Center the map in our address position
											cspm_center_map_at_point(plugin_map, latitude, longitude);
	
											// Loop throught post_ids and check the post relation with the current category
											// Then show markers within the selected category
											cspm_set_markers_visibility(plugin_map, null, 0, post_ids_and_categories[map_id], posts_in_search[map_id], true);
											cspm_simple_clustering(plugin_map, map_id);
											cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), posts_in_search[map_id], map_id);
	
											plugin_map.gmap3({
												clear: {
													name:"circle",
													all: true
												},
												circle:{
													options:{
														center: [latitude, longitude],
														radius : (parseInt(distance)*1000),
														fillColor : progress_map_vars.fillColor,
														fillOpacity: progress_map_vars.fillOpacity,
														strokeColor : progress_map_vars.strokeColor,
														strokeOpacity: progress_map_vars.strokeOpacity,
														strokeWeight: parseInt(progress_map_vars.strokeWeight),
														editable: false,
													},
													callback: function(circle){
														plugin_map.gmap3('get').fitBounds(circle.getBounds());
													}
												}											
											});
											
											// Show the reset button
											$('div.cspm_reset_search_form_'+map_id+'').show();
					
											// Reload post count value
											if(progress_map_vars.show_posts_count == "yes")
												$('span.the_count_'+map_id+'').empty().html(posts_in_search[map_id].length);
											
											jQuery('div.cspm_submit_search_form_'+map_id+'').show();
											jQuery('div.cspm_loader_search_form_'+map_id+'').hide();
											
										});
										
									}else{
														
										jQuery('div.cspm_submit_search_form_'+map_id+'').show();
										jQuery('div.cspm_loader_search_form_'+map_id+'').hide();
										
										jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_notice').removeClass('fadeOut').addClass('cspm_animated fadeInLeft').css({'display':'block'});	
										setTimeout(function(){
											jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_notice').removeClass('fadeInLeft').addClass('cspm_animated fadeOut');
											setTimeout(function(){
												jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_notice').css({'display':'none'});
											},700);
										},5000);									
			
									}

								}
							}
						});
					
					// The address is not found		
					}else{
										
						jQuery('div.cspm_submit_search_form_'+map_id+'').show();
						jQuery('div.cspm_loader_search_form_'+map_id+'').hide();

						jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_error').removeClass('fadeOut').addClass('cspm_animated fadeInLeft').css({'display':'block'});	
						setTimeout(function(){
							jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_error').removeClass('fadeInLeft').addClass('cspm_animated fadeOut');
							setTimeout(function(){
								jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_error').css({'display':'none'});
							},700);
						},5000);									
			
					}
					
				});
				
			});
			
		}		  
		
		// @Search form request
		
		
		// Toogle the carousel
				
		$("div.toggle-carousel-bottom, div.toggle-carousel-top").livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
			
			$("div#codespacing_progress_map_carousel_container").slideToggle("slow", function(){
			
				cspm_init_carousel(null, map_id);
				
			});
			
		});
		
				
		// Fit in layout
		
		if(progress_map_vars.main_layout == 'fit-in-map' || progress_map_vars.main_layout == 'fit-in-map-top-carousel'){
			
			cspm_fitIn_map();
			$(window).resize(cspm_fitIn_map);
		
		}
		
		
		// Fullscreen layout
		
		if(progress_map_vars.main_layout == 'fullscreen-map' || progress_map_vars.main_layout == 'fullscreen-map-top-carousel'){
		
			cspm_fullscreen_map();
			$(window).resize(cspm_fullscreen_map);
			
		}
		

		// Map with carousel on top
		
		if(progress_map_vars.main_layout == 'm-con' || progress_map_vars.main_layout == 'fullscreen-map-top-carousel' || progress_map_vars.main_layout == 'fit-in-map-top-carousel'){
		
			cspm_carousel_width();
			$(window).resize(cspm_carousel_width);
			
		}	
				
		
		// Show & Hide the search dsitance radius in the search form
		
		$('span.cspm_distance').livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
							
			if($('form#search_form_'+map_id+' div.cspm_search_distances ul').is(':visible')){
				$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeInDown').addClass('cspm_animated fadeOutUp');
				setTimeout(function(){$('form#search_form_'+map_id+' div.cspm_search_distances ul').css({'display':'none'});},200);
			}else{					
				$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeOutUp').addClass('cspm_animated fadeInDown').css({'display':'block'});
			}
						
		});
		
		$('div.cspm_search_distances ul li').livequery('click', function(){
			
			var map_id = $(this).parent().prev().attr('data-map-id');
			
			$('form#search_form_'+map_id+' div.cspm_search_distances span.cspm_distance').text($(this).text());
			
			$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeInDown').addClass('cspm_animated fadeOutUp');
			
			setTimeout(function(){$('form#search_form_'+map_id+' div.cspm_search_distances ul').css({'display':'none'});},200);
			
		});
		
		// @Search distance

	});