function pad(n){return n<10 ? '0'+n : n}
var date=new Date(new Date($( "[name=timestampStart]" ).val())+(new Date().getTimezoneOffset() * 60000));
console.log((new Date().getTimezoneOffset() * 60000));
$( "[name=timestampStart]" ).val(date.getFullYear() + "-" + pad(date.getMonth()+1) + "-" + pad(date.getDate()) + "T" + pad(date.getHours()) + ":" + pad(date.getMinutes()) + ":" + pad(date.getSeconds()));
$('[name=timestampStart],[name=game_length]').change(function() {
	var timestampStart = new Date($( "[name=timestampStart]" ).val()).getTime()+(new Date().getTimezoneOffset() * 60000);
	var timestampFinish = timestampStart + parseInt($('[name=game_length]').val());
	
				var postData=$(this).parents('form').data('postData');
					postData['timestampStart']=timestampStart;
					postData['timestampFinish']=timestampFinish;
				$(this).parents('form').data('postData',postData);
			return false;
		});
$('[name=timestampStart]').trigger( "change" );
$('[name=imageUrl]').change(function() {
	checkUrl(this.value,function(response){
		if(response.status==200){
			$('#image-display').attr("src",this.value);
			var postData=$(this).parents('form').data('postData');
			postData['imageUrl']=this.value;
			$(this).parents('form').data('postData',postData);
		}else{
			postData['imageUrl']='';
		}
	}.bind(this));
			return false;
		});
$('[name=imageUrl]').trigger( "change" );
