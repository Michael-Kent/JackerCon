var app = app || {};
$(function() {
	var update= new FormHandler('#form-update','api/account_update');

	update.validate=function(){
		update.loadData('#update-name','name');
		update.loadData('#update-surname','surname');
		update.loadData('#update-email','email');
		update.loadData('#update-phone','phone');
		update.loadData('#update-address-line1','address_line1');
		update.loadData('#update-address-line2','address_line2');
		update.loadData('#update-address-line3','address_line3');
		update.loadData('#update-address-city','address_city');
		update.loadData('#update-address-postcode','address_postcode');
		update.loadData('#update-address-country','address_country');
		
		return true;
	};

	update.callback=function(){
		update.writeResponse(update.getJSON());
		//updateWaivers();
	};

}());