jQuery(document).ready(function() {
	jQuery("#accordion").accordion({autoHeight: false, collapsible: true, active: false, heightStyle: "content"}).css("height","auto");
});

function openAccordionElement(id) {
	var header = jQuery('#accordion').find('.ui-accordion-header[aria-controls=ui-id-' + id + ']');
	//console.log(header);
  	header.click();
}
