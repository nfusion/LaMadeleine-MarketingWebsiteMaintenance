jQuery(document).ready(function() {

	if (window.location.href.indexOf('faq') || window.location.href.indexOf('frequently-asked-questions')) {
		// set up the check to fire once the accordion has rendered.
		jQuery("#accordion").on("accordioncreate", function(){
			if (window.location.hash) {
				var id = window.location.hash.substr(1);
				openAccordionElement(id);
			}
		})
		
	}

	jQuery("#accordion").accordion({
		autoHeight: false, 
		collapsible: true, 
		active: false, 
		heightStyle: "content"
	}).css("height","auto");
});

function openAccordionElement(id) {
	var header = jQuery('#accordion').find('.ui-accordion-header[aria-controls=ui-id-' + id + ']');
  	header.click();
}