function Address (json) {
	this.jsonParse(json);
}

Address.prototype = {
    constructor: Address,
    jsonParse:function (json)  {
		if(typeof(json) != "undefined"){
			this.line1=json.line1;
			this.line2=json.line2;
			this.line3=json.line3;
			this.city=json.city;
			this.postcode=json.postcode;
			this.country=json.country;
		}
		return this;
    }
}