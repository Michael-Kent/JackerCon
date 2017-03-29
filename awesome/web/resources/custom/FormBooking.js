var app = app || {};


  $( function() {
    $( "#datepicker" ).datepicker();
  } );

$(function() {
	
	/*
	var auth= new FormHandler('#form-auth','api/account_auth');

	auth.validate=function(){
	
		return true;
	};

	auth.callback=function(){
	
	};*/

	app.booking={'timetables':{},'dateBooked':'','extras':{},'waivers':{},'price':{},'notes':''};
	
	
	app.refreshPrice=function(){
		if(Object.keys(app.booking.timetables).length==0 || app.booking.dateBooked==''){
			
		}else{
			$.ajax({
				url:'/JackerCon/api/price_request',
				type:'POST',
				data: app.booking,
				dataType: 'json',
				success: function( json ) {
				   app.setPrice(json);
				}
			});
		}
	};
	
	app.setPrice=function(json){
		app.booking.price=json;
		$('#price').html('Total: £'+app.booking.price.finalPrice+'<br><br>'+app.booking.price.description);
	};
	
	$('#done').click(function(){
		app.booking.notes=$('#notes').val();
		app.getWaivers();
		
			$.ajax({
				url:'/JackerCon/api/booking_insert',
				type:'POST',
				data: app.booking,
				dataType: 'json',
				success: function( json ) {
				   app.setPrice(json);
				}
			});
		
		
	});
	
}());