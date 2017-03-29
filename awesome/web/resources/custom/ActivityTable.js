



function Activity (json) {
this.jsonParse(json);
}

Activity.prototype = {
    constructor: Activity,
    jsonParse(json){
		if(typeof(json) != "undefined"){
			this.activity=json.activity.name;
			this.timeStart=json.timeslot.start;
			this.timeFinish=json.timeslot.finish;
			this.capacity=json.location.capacity;
			this.attending=json.attending;
			this.id=json.id;
		}
	}
}
function ActivityTable (id,areaId,date) {
	this.id=id;
	this.postData={};
	this.postData.area_id=areaId;
	this.postData.date=date;
}

ActivityTable.prototype = {
    constructor: ActivityTable,
    update:function ()  {
		$.ajax({
			url: '/JackerCon/api/activity_request',
			type: "post",
			dataType: "json",
			data: this.postData,
			success: this.jsonParse.bind(this)
		});
    },jsonParse(json){
		if(typeof(json) != "undefined"){
			this.list=null;
			this.list=[];
			json.forEach(function (activity){
				this.list.push(new Activity(activity));
			}.bind(this));
		   this.resetTable();
		}
	},
	resetTable:function(){
        $('#'+this.id+' tr').not('tr:first').remove();
           $.each(this.list, function(i, val){
              $('#activity_table').append((new ActivityTable()).echoRow(val));
			  
			$( "#progressbar-"+val.id ).progressbar({
			  value: ((activity.attending/activity.capacity)*100)
			});
           });
		   this.setupActivityChecks();
	},
	echoRow:function(activity){
		var string='<tr>'+//<td>'+activity.activity+	'</td>'+
		//'<td>'+activity.timeStart+'-'+activity.timeFinish+'</td>'+
		'<td>'+	'<div id="progressbar-'+activity.id+'"><div class="progress-label">'+activity.activity+'&nbsp;&nbsp;&nbsp;&nbsp;'+activity.timeStart+'-'+activity.timeFinish+'&nbsp;&nbsp;&nbsp;&nbsp;'+	activity.attending+'/'+activity.capacity+	'</div></div></td>'+
		'<td><input type="checkbox" class="check_activity" id="check_activity_'+activity.id+'" name="'+activity.id+'" value="'+activity.id+'">'+
				  '</td>'+
		'<td id="attending_activity_'+activity.id+'" style="display:none;">adults: <select class="attending_activity" id="adult_attending_activity_'+activity.id+'">';
				  
		for (i = 0; i < (activity.capacity-activity.attending+1); i++) { 
			string += '<option value="'+i+'">'+i+'</option>';
		}

		string+='</select>'+
		'children:<select class="attending_activity" id="child_attending_activity_'+activity.id+'" >';
				  
		for (i = 0; i < (activity.capacity-activity.attending+1); i++) { 
			string += '<option value="'+i+'">'+i+'</option>';
		}

		string+='</select></td></tr>';
		
		return string;
	},
	setupActivityChecks:function (){
		$('.check_activity').change( function() {
				id=$(this).val();
				if($(this).is(':checked')){
					$('#attending_activity_'+id).show();	
					app.booking.timetables[id]={'children':0,'adults':0};
					app.refreshPrice();
					console.log('ActivityTable, timetable - add: '+id);
				}else{
					$('#attending_activity_'+id).hide();
					$('#attending_activity_'+id).val(0);
					delete app.booking.timetables[id];
					app.refreshPrice();
					console.log('ActivityTable, timetable - remove: '+id);
				}
			});
		$('.attending_activity').change(function(){
			child=this.id.startsWith('child');
			adult=this.id.startsWith('adult');
			id=this.id.substr(this.id.lastIndexOf('_')+1);
			quantity=this.value;
			
			if(child){
				app.booking.timetables[id].children=quantity;
						app.refreshPrice();
console.log('ActivityTable, child - attending: '+quantity);
			}else if(adult){
				app.booking.timetables[id].adults=quantity;
						app.refreshPrice();
console.log('ActivityTable, adult - attending: '+quantity);
			}
		});
		
		
	}
}
