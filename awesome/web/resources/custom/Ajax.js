var app = app || {};

(function() {
	
	app.timeslots=null;
	app.timeslotUpdate={length:0};
	
	app.onTimeslotUpdate=function(funct){
		app.timeslotUpdate[app.timeslotUpdate.length]=funct;
		app.timeslotUpdate.length++;
	};
	
	app.refreshTimeslots=function(refresh){
		if(!app.timeslots||refresh){
			$.ajax({
				url:'/JackerCon/api/timeslot_request',
				type:'POST',
				data: {},
				dataType: 'json',
				success: function( json ) {
				   app.setTimeslots(json);
				}
			});
		}else{
			$.each(app.timeslotUpdate, function(i, funct){
				funct(app.timeslots);
			});
		}
	};
	
	app.setTimeslots=function(json){
		app.timeslots=json;
		
		$.each(app.timeslotUpdate, function(i, funct){
			funct(app.timeslots);
		});
	}
	
	
	app.activities=null;
	app.activityUpdate={length:0};
	
	app.onActivityUpdate=function(funct){
		app.activityUpdate[app.activityUpdate.length]=funct;
		app.activityUpdate.length++;
	};
	
	app.refreshActivities=function(refresh){
		
		if(!app.activities||refresh){
			$.ajax({
				url:'/JackerCon/api/activity_request',
				type:'POST',
				data: {},
				dataType: 'json',
				success: function( json ) {
					app.setActivities(json);
				}
			});
		}else{
			$.each(app.activityUpdate, function(i, funct){
				funct(app.activities);
			});
		}
	};
	app.setActivities=function(json){
		app.activities=json;
		
		$.each(app.activityUpdate, function(i, funct){
			funct(app.activities);
		});
	}
	
	
	app.locations=null;
	app.locationUpdate={length:0};
	
	app.onLocationUpdate=function(funct){
		app.locationUpdate[app.locationUpdate.length]=funct;
		app.locationUpdate.length++;
	};
	
	app.refreshLocation=function(refresh){
		
		if(!app.locations||refresh){
			$.ajax({
				url:'/JackerCon/api/location_request',
				type:'POST',
				data: {},
				dataType: 'json',
				success: function( json ) {
					app.setLocation(json);
				}
			});
		}else{
			$.each(app.locationUpdate, function(i, funct){
				funct(app.locations);
			});
		}
	};
	app.setLocation=function(json){
		app.locations=json;
		
		$.each(app.locationUpdate, function(i, funct){
			funct(app.locations);
		});
	}
	
	
	app.timetables=null;
	app.timetableUpdate={length:0};
	
	app.onTimetableUpdate=function(funct){
		app.timetableUpdate[app.timetableUpdate.length]=funct;
		app.timetableUpdate.length++;
	};
	
	app.refreshTimetables=function(refresh){
		
		if(!app.timetables||refresh){
			$.ajax({
				url:'/JackerCon/api/timetable_request',
				type:'POST',
				data: {},
				dataType: 'json',
				success: function( json ) {
					app.setTimetables(json);
				}
			});
		}else{
			$.each(app.timetableUpdate, function(i, funct){
				funct(app.timetables);
			});
		}
	};
	app.setTimetables=function(json){
		app.timetables=json;
		
		$.each(app.timetableUpdate, function(i, funct){
			funct(app.timetables);
		});
	}
	
	
	app.prices=null;
	app.priceUpdate={length:0};
	
	app.onPriceUpdate=function(funct){
		app.priceUpdate[app.priceUpdate.length]=funct;
		app.priceUpdate.length++;
	};
	
	app.refreshPrices=function(refresh){
		
		if(!app.prices||refresh){
			$.ajax({
				url:'/JackerCon/api/price_request',
				type:'POST',
				data: {},
				dataType: 'json',
				success: function( json ) {
					app.setPrice(json);
				}
			});
		}else{
			$.each(app.priceUpdate, function(i, funct){
				funct(app.prices);
			});
		}
	};
	app.setPrice=function(json){
		app.prices=json;
		
		$.each(app.priceUpdate, function(i, funct){
			funct(app.prices);
		});
	}
	
	app.getWaivers=function(){
		$("[id^=waiver_]").each(function(i, obj) {
			id=this.id.substr(this.id.lastIndexOf('_')+1);
			if(/^\d+$/.test(id)){
				app.booking.waivers[id]=true;
				console.log('Waivers, waiver - id: '+id);
			}
		});
	};
	
  })();