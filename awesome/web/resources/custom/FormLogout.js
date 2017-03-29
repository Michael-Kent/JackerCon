var app = app || {};

$(function() {
	var deAuth= new FormHandler('#form-deAuth','api/account_de_auth');

	deAuth.callback=function(){
		if(deAuth.getJSON().responce['error_code']==0){
			window.location.href = "/JackerCon/";
		}
		deAuth.writeResponse(deAuth.getJSON());
	};
	  
}());
