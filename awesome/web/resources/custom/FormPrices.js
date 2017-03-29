var app = app || {};
$(function() {
	function addListToSelect(id, array){
		$(id).empty();
		$.each(array,function(index, val){
				$(id).append('<option value="'+val.value+'">'+val.option+'</option>');
			});
	}
	
	
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
	
	var conditions={};
	conditions['activity']=[];
	
	var pricing= new FormHandler('#form-prices-insert','api/price_insert');

	pricing.validate=function(){
		pricing.setData(JSON.stringify(conditions, null, 4),'conditions');
		pricing.loadData('#prices-insert-adult','adult');
		pricing.loadData('#prices-insert-child','child');
		pricing.loadData('#prices-insert-static','static');
		pricing.loadData('#prices-insert-priority','priority');
		pricing.loadData('#prices-insert-valid_from','from');
		pricing.loadData('#prices-insert-valid_till','till');
		
		valid_from=$('#prices-insert-valid_from').val().replace("/", "-");
			valid_from=$.datepicker.formatDate( "yy-mm-dd", new Date(valid_from));
			
			someday = new Date();
			someday.setFullYear(2016, 0, 1);
			if(someday>valid_from)
				return false;
			
			pricing.setData(valid_from,'from');
			
			valid_till=$('#prices-insert-valid_till').val().replace("/", "-");
			valid_till=$.datepicker.formatDate( "yy-mm-dd", new Date(valid_till));
			if(valid_from>valid_till)
				return false;
			
			pricing.setData(valid_till,'till');
		
		
		return true;
	};

	pricing.callback=function(){
		pricing.writeResponse(pricing.getJSON());
		app.setPrice(pricing.getJSON());
	};
	
	app.onActivityUpdate(function( json ) {
		var	array={};
		$.each(json, function(i, val){
			array[val.id]={value:val.id,option:val.name}
		}.bind(this));
		addListToSelect('#prices-insert-activity',array);
	});
	
	
	


	$('#prices-insert-add-condition').click(function( event ) {
        event.preventDefault();
		
		switch($('#prices-insert-condition').val()){
			case'activity':
			conditions['activity'].push($('#prices-insert-activity').val());
			break;
			case'coupon_code':
				conditions['coupon_code']=$('#prices-insert-condition-value').val();
			break;
			default:
				conditions[$('#prices-insert-condition').val()]=$('#prices-insert-number').val();
			break;
			
		}
		
		$('#condition-result').children().value=null;
		
		
		
		
		$('#current-conditions').html(JSON.stringify(conditions, null, 4));
	});
	
	$('#prices-insert-condition').change(function (){
		
		$('#condition-result').children().value=null;
		$('#condition-result').children().hide();
		
		switch($(this).val()){
			case'activity':
				$('#prices-insert-activity').show();
			break;
			case'coupon_code':
				$('#prices-insert-condition-value').show();
			break;
			default:
				$('#prices-insert-number').show();
			break;
			
		}
	});
	
$( "#prices-insert-condition" ).trigger( "change" );		
		app.refreshPrices();
	
		app.refreshActivities();
}());
$(function() {
	$( '#prices-insert-valid_from' ).datepicker();
	$( '#prices-insert-valid_from' ).datepicker( "option", "dateFormat", 'd-MM-yy' );
	
	$( '#prices-insert-valid_till' ).datepicker();
	$( '#prices-insert-valid_till' ).datepicker( "option", "dateFormat", 'd-MM-yy' );
});