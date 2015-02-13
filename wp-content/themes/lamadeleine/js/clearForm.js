if(typeof observe == 'function'){
document.observe( 'dom:loaded', function() {
    $$( 'form' ).each( function( form ) {
        form.observe( 'submit', function() {
            $$( 'input[type="submit"]' ).invoke( 'disable' );
            $$( 'form' ).observe( 'submit', function( evt ) { // once any form is submitted
                evt.stop(); // prevent any other form submission
            } );
        } );
    } );
} );
}

function validateEClub(frm) {
	var firstNameErr = 0;
	var lastNameErr = 0;
	var emailErr = 0;
	var ziperr = 0;
	var firstName = frm.first_name.value;
	var lastName = frm.last_name.value;
	var email = frm.email_address.value;
	var bdayday = frm.birthdayday.value;
	var bdaydmonth = frm.birthdaymonth.value;
	var zip = frm.postalcode.value;
	var errorString = "An error was found in your submission." + "\n" + "Please ensure all required fields are appropriately completed and try again.";
	
	if(firstName.length <= 1) { firstNameErr = 1; }
	if(lastName.length <= 1) { lastNameErr = 1; }
	if(email.length <= 1) {
		emailErr = 1;
	} else {
		if(email.indexOf(".") < 0) { emailErr = 1; }
		if(email.indexOf("@") < 0) { emailErr = 1; }
	}
	if(zip.length < 5) { ziperr = 1; }
	if(firstNameErr == 1 || lastNameErr == 1 || emailErr == 1 || ziperr == 1) {
		alert(errorString);
		return false;
	} else {
		return true;
	}
}

function ClearForm() {
  document.searchForm.search.value = "";
}
function ResetForm() {
	if (document.searchForm.search.value == "") {
		document.searchForm.search.value = "City or Zip";
	}
}
function checkValue() {
	if (document.searchForm.search.value == "City or Zip") {
		document.searchForm.search.value = "";
	}
}

//var theImages = new Array();
//theImages[0] = 'url(/images/home_image.jpg)';
//theImages[1] = 'url(/images/strawberries.jpg)';
///theImages[2] = 'url(/images/chkn_lamad.jpg)';

var theImages = new Array();
theImages[0] = 'url(/images/home_image.jpg)';           //breakfast
theImages[1] = 'url(/images/strawberries.jpg)';         //snack
theImages[2] = 'url(/images/chkn_lamad.jpg)';           //dinner
theImages[3] = 'url(/images/img_bg_lunch.jpg)';         //lunch

var menu = new Array();
menu[0] = 'breakfast';
menu[1] = 'lunch';
menu[2] = 'dinner';

function changeImage(changer) {
  newImage = theImages[changer];
  if (document.getElementById('home') != null) {
    document.getElementById('home').style.backgroundImage = newImage;
  }
  if (document.getElementById('menu_link') != null) {
    document.getElementById('menu_link').href = document.getElementById('menu_link').href + "/" + menu[changer];
  }
}

function setImage() {
  var now = new Date();
  var hours = now.getHours();
  //lunch
  if (hours >= 10 && hours < 14){
    changeImage(1);
  //snack
  } else if (hours >= 14 && hours < 16) {
    changeImage(1);
  //dinner
  } else if (hours >= 16 || hours < 4){
    changeImage(2);
  } else {
    changeImage(0);
  }
}

window.onload = setImage;


function gup( name )
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return null;
  else
    return results[1];
}

function setMenuCookie() {
  price_tier = gup('price_tier');
  if (price_tier) {
    document.cookie = 'price_tier=' + price_tier + '; path=/'
  }
}
