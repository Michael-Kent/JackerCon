
var app = app || {};

$(function() {
	$.ajax({
			url:'/JackerCon/api/items_request',
			type:'POST',
			data: {},
			dataType: 'json',
			success: function( json ) {
				$('#extras_table tr').not('tr:first').remove();
			   $.each(json, function(i, val){
				  $('#extras_table').append(extraRow(val));
			   });
			   extraCheck();
			}
		});
		
		
	function extraRow(val){
		string='<tr><td>'+val.name+	'</td>'+
		'<td>'+val.cost+'</td>'+
		'<td><select class="extra_quantity" id="extra_quanitity_'+val.id+'" >';
				  
		for (i = 0; i < 10; i++) { 
			string += '<option value="'+i+'">'+i+'</option>';
		}

		string+='</select></td></tr>';
		
		return string;
		
	}
	
	function extraCheck(){
		$('.extra_quantity').change(function(){
			id=this.id.substr(this.id.lastIndexOf('_')+1);
			quantity=this.value;
		app.booking.extras[id]=quantity;
		app.refreshPrice();
			console.log('FormExtras, Extras - id: '+id+', quantity:'+quantity);
		});
	}
	
});