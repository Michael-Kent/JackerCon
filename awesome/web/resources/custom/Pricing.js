var app = app || {};

$(function() {
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
		});