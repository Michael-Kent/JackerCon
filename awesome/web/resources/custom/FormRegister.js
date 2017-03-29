var app = app || {};
$(function() {

	var insert= new FormHandler('#form-register','api/account_insert');

	insert.validate=function(){
		account=new Account();
		insert.loadData('#register-username','username');
		insert.loadData('#register-name','name');
		insert.loadData('#register-surname','surname');
		insert.loadData('#register-email','email');
		if(!account.validateEmail(insert.postData['email'])){
			insert.json.responce.error_code=-1;
			insert.json.responce.error_message="Please check you have entered your correct email.";
			return false;
		}
		insert.loadData('#register-password','password');
		insert.loadData('#register-password-confirm','passwordConfirm');
		if(!account.validateNewPassword(insert.postData['password'],insert.postData['passwordConfirm'])){
			insert.json.responce.error_code=-1;
			insert.json.responce.error_message="Your passwords must be longer than five character and must match.";
			return false;
		}
		
		return true;
	};

	insert.callback=function(){
		insert.writeResponse(insert.getJSON());
		//updateWaivers();
	};

}());