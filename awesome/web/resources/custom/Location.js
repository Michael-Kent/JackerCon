function Location (json) {
this.jsonParse(json);
}

Location.prototype = {
    constructor: Location,
    jsonParse:function (json)  {
		if(typeof(json) != "undefined"){
			this.id=json.id;
			this.location=json.location;
			this.area=json.area;
		}
		return this;
    }
}

function LocationCollection () {
}

LocationCollection.prototype = {
	constructor: LocationCollection,
    updateJSON:function ()  {
		$.ajax({
			url: '/JackerCon/api/location_request',
			type: "post",
			dataType: "json",
			success: this.jsonParse.bind(this)
		});
    },
	jsonParse: function (json){
		this.list={};
		if(typeof(json) != "undefined"){
			json.forEach(function (location){
				this.list[location.id]=new Location(location);
			}.bind(this));
		}
		this.json=json;
		this.callback();
		return this;
	},
	callback:function(){
		
	},
	getLocations:function(){
		var array=[];
			this.json.forEach(function (locations){
				if(!array.hasOwnProperty(locations.location)){
					array[locations.location]=true;
					select={value:locations.location,option:locations.location};
					array.push(select);
				}
			});
		return array;
	},
	getAreas:function(locate){
		var array=[];
		var locate=locate;
			this.json.forEach(function (locations){
				if(locations.location==locate){
					select={value:locations.id,option:locations.area};
					array.push(select);
				}
			});
		return array;
	}
}