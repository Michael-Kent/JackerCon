var app = app || {};

$(function() {


	var auth= new FormHandler('#form-auth','api/account_auth');

	auth.validate=function(){
		account=new Account();
		auth.loadData('#auth-email','email');
		
		if(!account.validateEmail(auth.postData['email'])){
			auth.json.responce.error_code=-1;
			auth.json.responce.error_message="Please check you have entered your correct email";
			return false;
		}
		
		auth.loadData('#auth-password','password');
		
		if(!account.validatePassword(auth.postData['password'])){
			auth.json.responce.error_code=-1;
			auth.json.responce.error_message="Your passwords must be longer than five characters.";
			return false;
		}
		return true;
	};

	auth.callback=function(){
		if(auth.getJSON().responce['error_code']==0){
			window.location.href = "/JackerCon/";
		}
		auth.writeResponse(auth.getJSON().responce);
		
	};

}());

$(function() {
	var resend= new FormHandler('#form-resend','api/EmailVerifyResend');

	resend.validate=function(){
		resend.loadData('#resend-email','email');
		return true;
	};
	resend.callback=function(){
		resend.writeResponse(resend.getJSON());
	};
}());