
var app = app || {};

(function() {
	  
		$( "#datepicker" ).datepicker();
		$( "#datepicker" ).datepicker( "option", "dateFormat", 'd-MM-yy' );
		$( "#datepicker" ).datepicker("setDate", new Date());
	  })();
	  
(function() {

	
	function addListToSelect(id, array){
		$(id).empty();
		$.each(array,function(index, val){
				$(id).append('<option value="'+val.value+'">'+val.option+'</option>');
			});
	}
	
	app.onLocationUpdate(function( json ) {
		var array=[];
		json.forEach(function (locations){
				if(!array.hasOwnProperty(locations.location)){
					array[locations.location]=true;
					select={value:locations.location,option:locations.location};
					array.push(select);
				}
			});
		addListToSelect("#locations",array);
		
		array=[];
			var locate=$("#locations").find(":selected").text();
			json.forEach(function (locations){
				if(locations.location==locate){
					select={value:locations.id,option:locations.area};
					array.push(select);
				}
			});
		addListToSelect("#area",array);
		
		$('#form-activity :input').trigger('change');
	});

	$('#locations').on('change', function() {
		var array=[];
			var locate=$("#locations").find(":selected").text();
			app.locations.forEach(function (locations){
				if(locations.location==locate){
					select={value:locations.id,option:locations.area};
					array.push(select);
				}
			});
		addListToSelect("#area",array);
	});
		app.refreshLocation();

  
	$("#form-activity :input").change(function() {
		
		date=$('#datepicker').val().replace("/", "-");
		date=$.datepicker.formatDate( "yy-mm-dd", new Date(date));;
		area_id=$('#area').val();
		app.booking.dateBooked=date;
		app.refreshPrice();
		
		var table=new ActivityTable("activity_table",area_id,date);
		table.update();
	});

})();