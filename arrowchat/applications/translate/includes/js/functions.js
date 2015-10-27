var languageAdded = 0;

function fireEvent(element,event){
    if (document.createEventObject){
    var evt = document.createEventObject();
    return element.fireEvent('on'+event,evt)
    } else {
    var evt = document.createEvent("HTMLEvents");
    evt.initEvent(event, true, true ); 
    return !element.dispatchEvent(evt);
    }
}

function changeLanguage() {
	$('.goog-te-combo').attr('id','cclanguagebutton');
	fireEvent(document.getElementById('cclanguagebutton'),'change');
}

function addLanguageCode() {
	if (!languageAdded) {
		$.getScript('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit',function(data) {
			$("body").append('<div id="google_translate_element"></div><style>#google_translate_element {display:none!important;}</style>');
			languageAdded++;
		});
	}
}

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
	  pageLanguage: 'en',
	  autoDisplay: false
  }, 'google_translate_element');
}