function FormHandler (formID, url) {
	this.form=$(formID);
	this.json={};
	this.json.responce={};
	this.url=url;
	this.postData={};
	
	$(this.form).submit(function( event ) {
        event.preventDefault();
		if(this.validate())
		{
			this.updateJSON();
		}
	}.bind(this));
}

FormHandler.prototype = {
    constructor: FormHandler,
    updateJSON:function ()  {
		$.ajax({
			url: '/JackerCon/'+this.url,
			type: "post",
			dataType: "json",
			data: this.postData,
			success: this.jsonSuccess.bind(this)
		});
    },
    jsonSuccess:function (data)  {
		this.json=data;
		this.callback();
    },
    callback:function ()  {},
    validate:function ()  {return true;},
    loadData:function (id, key)  {
		//if($( this.form ).find( id ).length){
			this.postData[key]=$(id).val();
		//}
    },
    setData:function (value, key)  {
		if(typeof value != 'undefined'){
			this.postData[key]=value;
		}
    },
    getJSON:function ()  {
        return this.json;
    },
	writeResponse(response){
		this.form.removeClass('fail');
		this.form.removeClass('success');
		if(response['error_code']==0){
			this.form.addClass('success');
			this.form.find("#response").html('success: '+response['error_message']);
		}else{
			this.form.addClass('fail');
			this.form.find("#response").html(response['error_message']);
		}
	}
}
