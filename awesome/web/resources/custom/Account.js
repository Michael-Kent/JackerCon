function Account (json) {
	this.jsonParse(json);
}

Account.prototype = {
    constructor: Account,
    request:function ()  {
		$.ajax({
			url: '/JackerCon/api/account_request',
			type: "post",
			dataType: "json",
			success: this.jsonParse.bind(this)
		});
    },
    jsonParse:function (json)  {
		if(typeof(json) != "undefined"){
			if(json.hasOwnProperty('id'))this.id=json.id;
			if(json.hasOwnProperty('username'))this.username=json.username;
			if(json.hasOwnProperty('firstName'))this.firstName=json.firstName;
			if(json.hasOwnProperty('lastName'))this.lastName=json.lastName;
			if(json.hasOwnProperty('phone'))this.phone=json.phone;
			if(json.hasOwnProperty('address'))this.address=new Address(json.address);
			if(json.hasOwnProperty('email'))this.email=json.email;
			if(json.hasOwnProperty('verify'))this.verify=json.verify;
			if(json.hasOwnProperty('emailSub'))this.emailSub=json.emailSub;
			if(json.hasOwnProperty('date_created'))this.date_created=json.date_created;
			if(json.hasOwnProperty('date_logged_in'))this.date_logged_in=json.date_logged_in;
			if(json.hasOwnProperty('waiver'))this.waiver=new WaiverCollection(json.waiver);
		}
		this.requestReturned();
		return this;
    },
    requestReturned:function ()  
	{
	},
    validateEmail:function (email)  
	{
		return email.indexOf('@') >0 && email.lastIndexOf('.') > email.indexOf('@');
	},
    validatePassword:function (password)  
	{
		return password.length > 5;
	},
    validateNewPassword:function (password,passwordConfirm)  
	{
		return password.length > 5&&password===passwordConfirm;
	}
}