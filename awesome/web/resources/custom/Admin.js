var app = app || {};

$(function() {
	  
	function addListToSelect(id, array){
		$(id).empty();
		$.each(array,function(index, val){
				$(id).append('<option value="'+val.value+'">'+val.option+'</option>');
			});
	}
	
	//timeslot form/table
	(function () {
		var insertTimeslot= new FormHandler('#form-timeslots-insert','api/timeslot_insert');

		insertTimeslot.validate=function(){
			insertTimeslot.loadData('#timeslots-insert-start','start');
			insertTimeslot.loadData('#timeslots-insert-finish','finish');
			if($('#timeslots-insert-peak').prop("checked")){
				insertTimeslot.setData('1','peak');
			}else{
				insertTimeslot.setData('0','peak');
			}
			return true;
		};

		insertTimeslot.callback=function(){
			insertTimeslot.writeResponse(insertTimeslot.getJSON());
			app.setTimeslots(insertTimeslot.getJSON());
		};

		app.onTimeslotUpdate(function( json ) {
					$('#table-timeslots tr').not('tr:first').not('tr:last').remove();
					$.each(json, function(i, val){
						$(timeslotRow(val)).insertBefore('#table-timeslots tr:last');
					});
				});
		
		
		app.disableTimeslot=function (id){
			$.ajax({
				url:'/JackerCon/api/timeslot_disable',
				type:'POST',
				data: {
					'id':id
				},
				dataType: 'json',
				success: function( json ) {
					app.setTimeslots(json);
				}
			});
		}
		function timeslotRow(val){
			disabled="";
			if(val.disabled=='1'){
				disabled='style="display:none;"';
			}
			
			
			string='<tr id="timeslot_'+val.id+'"'+disabled+'><td>'+val.start+'</td>'+
			'<td>'+val.finish+'</td>'+
			'<td>'+val.peak+'</td>'+
			//'<td><button onclick="app.disableTimeslot('+val.id+');">disable</button></td>'+
			'</tr>';
			return string;
			
		}

	}());

	//activities form/table
	(function () {
		var insertActivities= new FormHandler('#form-activities-insert','api/activity_insert');

		insertActivities.validate=function(){
			insertActivities.setData($('#activities-insert-name').val(),'name');
			insertActivities.setData($('#activities-insert-description').val(),'desc');
			
			return true;
		};

		insertActivities.callback=function(){
			insertActivities.writeResponse(insertActivities.getJSON());
			app.setActivities(insertActivities.getJSON());
		};

		app.onActivityUpdate(function( json ) {
			$('#table-activities tr').not('tr:first').not('tr:last').remove();
			$.each(json, function(i, val){
				$(activityRow(val)).insertBefore('#table-activities tr:last');
			});  
		});
		
		function activityRow(val){
			
			string='<tr id="activity_'+val.id+'"><td>'+val.name+'</td>'+
			'<td>'+val.description+'</td>'+
			'</tr>';
			return string;
			
		}

	}());


	//location form/table
	(function () {
		var insertLocation= new FormHandler('#form-location-insert','api/location_insert');

		insertLocation.validate=function(){
			insertLocation.setData($('#location-insert-site').val(),'site');
			insertLocation.setData($('#location-insert-area').val(),'area');
			insertLocation.setData($('#location-insert-capacity').val(),'capacity');
			
			return true;
		};

		insertLocation.callback=function(){
			insertLocation.writeResponse(insertLocation.getJSON());
			app.setLocation(insertLocation.getJSON());
		};


		app.onLocationUpdate(function( json ) {
			$('#table-location tr').not('tr:first').not('tr:last').remove();
			$.each(json, function(i, val){
				$(locationRow(val)).insertBefore('#table-location tr:last');
			}); 
		});
		
		function locationRow(val){
			
			string='<tr id="activity_'+val.id+'"><td>'+val.location+'</td>'+
			'<td>'+val.area+'</td>'+
			'<td>'+val.capacity+'</td>'+
			'</tr>';
			return string;
			
		}

	}());


	//timetable form/table
	(function () {
		var insertTimetable= new FormHandler('#form-timetable-insert','api/timetable_insert');

		insertTimetable.validate=function(){
			insertTimetable.setData($('#timetable-insert-day').val(),'day_of_week');
			insertTimetable.setData($('#timetable-insert-timeslot').val(),'timeslot');
			insertTimetable.setData($('#timetable-insert-activity').val(),'activity');
			insertTimetable.setData($('#timetable-insert-location').val(),'location');
			
			valid_from=$('#timetable-insert-valid_from').val().replace("/", "-");
			valid_from=$.datepicker.formatDate( "yy-mm-dd", new Date(valid_from));
			
			someday = new Date();
			someday.setFullYear(2016, 0, 1);
			if(someday>valid_from)
				return false;
			
			insertTimetable.setData(valid_from,'valid_from');
			
			valid_till=$('#timetable-insert-valid_till').val().replace("/", "-");
			valid_till=$.datepicker.formatDate( "yy-mm-dd", new Date(valid_till));
			if(valid_from>valid_till)
				return false;
			
			insertTimetable.setData(valid_till,'valid_till');
			
			return true;
		};

		insertTimetable.callback=function(){
			insertTimetable.writeResponse(insertTimetable.getJSON());
			app.setTimetables(insertTimetable.getJSON());
		};
	

		app.onTimeslotUpdate(function( json ) {
			var	array={};
			$.each(json, function(i, val){
				peak="";
				if(val.peak=='1'){
					peak=' peak';
				}
				if(val.disabled==false)
					array[val.id]={value:val.id,option:val.start+' - '+val.finish+peak};
			}.bind(this));
			addListToSelect('#timetable-insert-timeslot',array);
		});
		
		app.onActivityUpdate(function( json ) {
			var	array={};
			$.each(json, function(i, val){
				array[val.id]={value:val.id,option:val.name}
			}.bind(this));
			addListToSelect('#timetable-insert-activity',array);
		});
			
		app.onLocationUpdate(function( json ) {
			var	array={};
			$.each(json, function(i, val){
				array[val.id]={value:val.id,option:val.location+" - "+val.area}
			}.bind(this));
			addListToSelect('#timetable-insert-location',array);
		});
			
		
		app.onTimetableUpdate(function( json ) {
			$('#table-timetable tr').not('tr:first').not('tr:last').remove();
			$.each(json, function(i, val){
				$(timetableRow(val)).insertBefore('#table-timetable tr:last');
			});
		});
		
		function timetableRow(val){
			peak='';
			if(val.timeslot.peak=='1')
				peak=', peak';
			
			var weekday = new Array(7);
			weekday[0]=  "Sunday";
			weekday[1] = "Monday";
			weekday[2] = "Tuesday";
			weekday[3] = "Wednesday";
			weekday[4] = "Thursday";
			weekday[5] = "Friday";
			weekday[6] = "Saturday";
			
			string='<tr id="timetable_'+val.id+'">'+
			'<td>'+weekday[val.dayOfWeek]+'</td>'+
			'<td>'+val.timeslot.start+' - '+val.timeslot.finish+peak+'</td>'+
			'<td>'+val.activity.name+'</td>'+
			'<td>'+val.location.location+'-'+val.location.area+'</td>'+
			'<td>'+val.valid_from+'</td>'+
			'<td>'+val.valid_till+'</td>'+
			'</tr>';
			return string;
			
		}

	}());

	
	//price table
	(function () {
		app.onPriceUpdate(function( json ) {
			$('#table-prices tr').not('tr:first').not('tr:last').remove();
			$.each(json, function(i, val){
				$(priceRow(val)).insertBefore('#table-prices tr:last');
			}); 
		});
		
		function priceRow(val){
			var price=val.description[0];
			val.description[0]=null;
			var list='<ul>';
			$.each(val.description, function(i, value){
				if(value)list=list+'<li>'+value+'</li>';
			});
			list=list+'</ul>';
			
			return '<tr id="price_'+val.id+'"><td>'+price+'</td>'+
			'<td>'+list+'</td>'+
			'</tr>';
			
		}
	}());
		
		
		
		app.refreshPrices();
	
		app.refreshTimeslots();
		app.refreshActivities();
		app.refreshLocation();
		app.refreshTimetables();
});
$(function() {
	$( '#timetable-insert-valid_from' ).datepicker();
	$( '#timetable-insert-valid_from' ).datepicker( "option", "dateFormat", 'd-MM-yy' );
	
	$( '#timetable-insert-valid_till' ).datepicker();
	$( '#timetable-insert-valid_till' ).datepicker( "option", "dateFormat", 'd-MM-yy' );
});