Progress Map Changelog
===================

01.04.2014 - version 2.6.0

	* New feature: Added support for displaying the post taxonomy terms in the items description.
	- Fixed an error where the faceted search wasn't working when selecting the layout "Fit in the box (Map only)" or "Full screen Map (Map only)"
	
===================

27.03.2014 - version 2.6

	- Fixed an issue where the plugin was not capable of regenerating a big amout of markers.
	- Fixed an error where the clustering method return an error when it's set to "No".
	- Fixed an issue with UTF-8 encoding with foreign characters.
	- Fixed an issue where the marker animation is repeated multiple times.
	- Fixed an issue in the administration that causes an endless loading.

===================

18.03.2014 - version 2.5.0

	- Fixed an error in the code that lead the map to stop showing
	
===================
	
17.03.2014 - version 2.5
	
	* New feature: Possibility to overide the Faceted search settings from the shortcode attributes.
	* New feature: Possibility to configure the map to work on an SSL environement (HTTPS).
	* New feature: Possibility to load the plugin's JS & CSS files only on the pages and/or posts that uses the map.
	* New feature: Possibility to combine all the plugin's JS & CSS files into one file.
	* New feature: Possibility to use the markers and the carousel items as a link to other pages in outer websites.
	* New feature: Possibility to connect the plugin with your already built custom fields (Latitude & longitude fields).
	
	* Enhanced the map with 5 new marker infoboxes.
	* Enhanced the loading speed of the map to handle a large amount of markers.
	* Enhanced the search form with a slider to easly select a radius of search.
	* Enhanced the map to fit the selected radius of search.
	* Enhanced the map styles with 15 cool styles.
	* Enhanced the marker animations with 2 new animations.
	* Added the possibility to make the title in the carousel items as a link to the post page.
	
	- Fixed an error where the reset button in the search form wasn't working.
	- Fixed an error where the post count wasn't displaying the correct number after a filter search.
	- Fixed an issue of double markers.
	- Fixed some CSS conflict.
	
	

==================

21.01.2014 - version 2.4.2

	- Replaced the SVG icon of the search form button by a PNG icon.
	- Added possibility to upload a custom icon for the search form button.
	- Added possibility to change the background color of the search form.
	
==================
	
19.01.2014 - version 2.4.1

	- Fixed and error where filtering posts return an error when the autoscroll mode of the carousel is activated.
	
==================
	
16.01.2014 - version 2.4.0

	- Fixed and error where the map is not displayed when a secondary location is added to a post.
	
==================
	
11.01.2014 - version 2.4

	* New feature: A powerfull search form with possibility to select a distance of search & an option
				   to draw a circle around the distance of search. 
	* New feature: Possiblity to add unlimited distances, select a distance unit (Km & Miles),
	               enable/disable the circle option & customize the circle style.
	* New feature: Possibility to hide/show the search form from the shortcode attributes.
	* New feature: Possibility to change the map style. Includes 56 wonderfull style that will give your map
				   an amazing view.
	* New feature: Possibility to add a unique style by providing the Javascript style array.
	* New feature: Possibility to choose the initial style of the map. (Map, Satellite, Terrain, Hybrid & Custom style)
    * New feature: Possibility to choose a custom style from the shortcode attributes.
	* New feature: Geo targetting. Possibility to add the geolocation of the website visitor.
	* New feature: Add support of retina display for map markers & clusters.
	* New feature: 2 new layout. ("Map, toggle carousel from top", "Map, toggle carousel from bottom") to toggle the 
				   carousel from the top & the bottom.
	* New feature: A new layout type to disable & hide the carousel on mobile browsers.
	* New feature: Increase the loading speed of the map to handle a large amount of markers with ease.
				   (A map with 528 markers takes about 5 seconds to load everything on OS X & Windows 7) 
	* New feature: Added a loading bar & spinner indicating the loading process of the map.	
	- Updated the whole functions name to prevent confliction with other plugins.
	- Increase the loading speed of the plugin administration page.
	- Fixed an issue where the plugin administration page is to heavy when loading a large number of categories & tags.
	- Fixed an issue where HTML tags are not executed correctly in the carousel items description.
	
	
	
===================

06.12.2013 - version 2.3.0

	- Fixed an error where the "More" text in the carousel item can't be modified.
	- Changed the context value of the "Add locations" to "Advance" and added an explanation on how to use the form.
	
===================

27.11.2013 - version 2.3

	* New feature: 3 new layout type. Map with carousel on top, Fit in the box with carousel on top & Full screen Map with carousel on top.

===================
	
25.11.2013 - version 2.2.0

	- Display the title of the post when hovering over the "More" link in the bubble overlay.
	- Show an error message when the center point of the map is not entered correctly.
	- Fixed an error where the map show a wrong location when hovering over a marker.
	- Fixed an error where a undefined property is not tested when no options are saved.
	- Fixed an error where the map is not showing when an item description is not escaped.
	
===================	

22.11.2013 - version 2.2

	* New feature: Add support for multiple locations per post.
	
===================	

19.11.2013 - version 2.1.0

	- Fixed an issue where the faceted search stops calling the items in the carousel.
	- Fixed a CSS conflict.

===================

18.11.2013 - version 2.1
	
	* New feature: Add support for multiple instances of the map, with different posts
				   and settings for each instance.
	* New feature: Possibility to show/hide the carousel and faceted search in each
	 			   instance of the map.
	* New feature: Possibility to overide the default query settings for each instance
				   of the map.
	* New feature: Add support for multiple marker categories in the map.
	* New feature: Possibility to add custom marker for each category in the map.
	* New feature: Possibility to filter locations by catgories, tags or custom taxonomies.
	* New feature: Possibility to filter locations by selecting one taxonomy or multiple
				   taxonomies. 
	* New feature: 6 skins where each skin comes with 10 set of colors to customize the 
				   faceted search form.
	* New feature: Show the number of your locations on top of the map with possibility 
				   to change the default clause text & style.
	* New feature: Possibility to set a new zoom level to the map when the an item is 
				   fired in the carousel.
	- Fixed an issue where the plugin return error when the carousel item size in not 
	  defined in the plugin's settings.
	- Remove support for the serialized array passed in the @post_ids parameter in the
	  [codespacing_progress_map] shortcode. 
	  Replace serialize(POST_IDS_ARRAY) function by implode(',', POST_IDS_ARRAY).

===================

02.11.2013 - version 2.0

	* New feature: Increase the speed of the Map loading. (The execution time of 18 posts decreased from 20 second to 5 seconds)
	* New feature: Possibility to choose posts by categories, tags, custom fields, status and more...
	* New feature: 2 new layout type. "Full Screen Map" & "Fit in the box".
	* New feature: 2 new shortcodes allowing to add a "light" map & a "static" map in order to show a single post. (useful for the single post page).    
	* New feature: Move the carousel using Touch Swipe.
	* New feature: Move the carousel using the scroll wheel.
	* New feature: Possibility to change the position of the marker overlay & customize the overlay's link (style, text & external link).    
	* New feature: Possibility to enable/disable the clustering option & control the cluster size.
	* New feature: Possibility to choose the default marker offered by Google map.
	* New feature: Possibility to change the background color of the carousel arrows.

===================

26.10.2013 - version 1.4

	- Fixed an issue where in some websites, the map jumps over the page content.
	- Fixed an issue where the map is not showing when an item description contain an empty line.

===================

15.10.2013 - version 1.3

	- Fixed a CSS conflict where the background in some websites become white.

===================

13.10.2013 - version 1.2
	
	- Fixed an issue where the plugin causes an error when updating the post status.
	- Fixed an issue where the plugin uses a deprecated function (escape).

===================

09.10.2013 - version 1.1

	- Fixed an issue where the 'Location' form return a bad location when searching for an address.
