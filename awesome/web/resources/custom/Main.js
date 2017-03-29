

var app = app || {};
$(function() {
	var my_acc=new Account();
	my_acc.requestReturned=function(){
		loggedIn=my_acc.hasOwnProperty('id');

		if(loggedIn){
			$(".loggedOut").hide();
			$(".loggedIn").show();
		}else{
			$(".loggedOut").show();
			$(".loggedIn").hide();
		}
	};
	my_acc.request();
}());








