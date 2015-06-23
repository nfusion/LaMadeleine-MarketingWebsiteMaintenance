jQuery(document).ready(function() {
	// set up the check to fire once the accordion has rendered.
	jQuery("#accordion").on("accordioncreate", function(){
		if (window.location.hash) {
			var id = window.location.hash;
			openAccordionElement(id);
		}
	});

	jQuery("#accordion").accordion({
		autoHeight: false, 
		collapsible: true, 
		active: false, 
		heightStyle: "content"
	}).css("height","auto");
});

function openAccordionElement(id) {
	var header = jQuery('#accordion').find(id);
  	header.click();
}