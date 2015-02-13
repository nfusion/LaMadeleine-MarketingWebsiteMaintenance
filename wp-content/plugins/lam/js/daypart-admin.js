
$(document).ready(function(){

    //console.log($('.pods-pick-values pods-pick-checkbox > ul > li'));

  // $.each($('.pods-field .pods-boolean'),  function(idx, val){
  //    console.log(val);
  // });

     $('.pods-pick-values.pods-pick-checkbox >ul').sortable({

        //stop: checkCatList(e, ui),

            update: function(event, ui) {
                checkCatList(event, ui)
            }
     });


     

     initialize();

});

checkCatList = function(event, ui){
       
        $('#pods-form-ui-pods-meta-menu-categories').val('');
        $.each($('.pods-field.pods-boolean'),  function(idx, val){
            if( $(this).find('input').is(':checked')  ){
                if( $('#pods-form-ui-pods-meta-menu-categories').val().length > 0){comma = ', ';} else { comma ='';};
                $('#pods-form-ui-pods-meta-menu-categories').val( $('#pods-form-ui-pods-meta-menu-categories').val() +comma+ $(this).find('label').html().trim() );

            }
        });
      
}

initialize = function(){

    var checkedLI = [];
    var uncheckedLI = ''
    $.each($('.pods-field.pods-boolean'),  function(idx, val){
       currentCatArray = $('#pods-form-ui-pods-meta-menu-categories').val().split(', ');
       possibleCat = $(this).find('label').html().trim();
       ulIdx = currentCatArray.indexOf(possibleCat) ;
       if(ulIdx >= 0){
            
            checkedLI[ulIdx] = "<li><div class='pods-field pods-boolean' > "+$(this).html()+"</class></li>";
            //$(this).find('input').click();//toggle(this.checked);
       } else {
            uncheckedLI += "<li><div class='pods-field pods-boolean' > "+$(this).html()+"</class></li>";
       }
   
    });
    
    
    $('.pods-pick-values.pods-pick-checkbox >ul').html('');

    $.each(checkedLI, function(idx, li){
        $('.pods-pick-values.pods-pick-checkbox >ul').append(li);
    });
    $('.pods-pick-values.pods-pick-checkbox >ul').append(uncheckedLI);

    $('.pods-field.pods-boolean').on('click',function(event,ui){
        checkCatList(event, ui);
     })

}

// $( "#list" )
//   .sortable({ handle: ".handle" })
//   .selectable()
//     .find( "div" )
//       .addClass( "ui-corner-all" )
//       .prepend( "<span class='handle'><span class='ui-icon ui-icon-arrow-4-diag'></span></span>" );


