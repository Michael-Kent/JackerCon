
function Waiver (json) {
this.jsonParse(json);
}

Waiver.prototype = {
    constructor: Waiver,
    jsonParse:function (json)  {
		if(typeof(json) != "undefined"){
			this.id=json.id;
			this.email=json.email;
			this.dateOfBirth=json.dateOfBirth;
			this.firstName=json.firstName;
			this.lastName=json.lastName;
		}
		return this;
    }
}

function WaiverCollection (json) {
	this.jsonParse(json);
}

WaiverCollection.prototype = {
	constructor: WaiverCollection,
    updateJSON:function ()  {
		$.ajax({
			url: '/JackerCon/api/waivers_request',
			type: "post",
			dataType: "json",
			data: this.postData,
			success: this.jsonParse.bind(this)
		});
    },
	jsonParse: function (json){
		this.waivers=[];
		if(typeof(json) != "undefined"){
			json.forEach(function (waiver){
				this.waivers[waiver.id]=new Waiver(waiver);
			}.bind(this));
		}
		this.toTable('#waiver_table');
		
		return this;
	},
	toTable: function (id){
        $(id+' tr').not('tr:first').not('tr:last').remove();
		this.waivers.forEach(function (waiver){
			row='<tr id="waiver_'+waiver.id+'"><td>'+waiver.firstName+'</td>'+
			'<td>'+waiver.lastName+'</td>'+
			'<td>'+waiver.email+'</td>'+
			'<td><input type="submit" class="red-submit" id="submit" value="remove" onclick="app.waiverRemove('+waiver.id+');"></input></td></tr>';
			$(row).insertBefore(id+' tr:last');;
		}.bind(this));
	}
}
	
	
var app = app || {};

(function() {
	  

	waiver=new WaiverCollection();
	waiver.updateJSON();
	
	app.waiverRemove=function(id){
		$('#waiver_'+id).remove();
		app.getWaivers();
	};
	
	var waiverForm= new FormHandler('#form-waiver','api/waiver_insert');
	waiverForm.validate=function(){
		  
		waiverForm.loadData('#waiver-firstname','first_name');
		waiverForm.loadData('#waiver-lastname','last_name');
		waiverForm.loadData('#waiver-email','email');
		return true;
	};
	
	waiverForm.callback=function(){
		waiverForm.writeResponse(waiverForm.getJSON());
		waiver.jsonParse(waiverForm.getJSON());
	};
	

}());
	
	
	
	
	
	
	
	
	
	