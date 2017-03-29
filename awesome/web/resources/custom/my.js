

$( "#form-end" ).submit(function( event ) {
  $.ajax({
    url: '/JackerCon/account_de_auth/',
    type: "post",
    dataType: "json",
    data: {
		application_id: '098f6bcd462'
    },
    success: function(data, textStatus, jqXHR) {
        // since we are using jQuery, you don't need to parse response

		writeResponse(data,'form-end');
		updateWaivers();
        drawTable(data);
    }
});
          event.preventDefault();
});

$( "#form-auth" ).submit(function( event ) {
	
          event.preventDefault();
	if(!($("#auth-email").val().indexOf('@') >0&&$("#auth-email").val().lastIndexOf('.') > $("#auth-email").val().indexOf('@'))){
		data=[];
		data['error_message']="please check you have entered your correct email";
		data['error_code']=-1;
		writeResponse(data,'form-auth');
		return;
	}
	if(!($("#auth-pwd").val().length>5)){
		data=[];
		data['error_message']="Your passwords must be longer than five character and must match.";
		data['error_code']=-1;
		writeResponse(data,'form-auth');
		return;
	}
  $.ajax({
    url: '/JackerCon/account_auth/',
    type: "post",
    dataType: "json",
    data: {
		application_id: '098f6bcd462',
        email: $("#auth-email").val(),
        password: $("#auth-pwd").val()
    },
    success: function(data, textStatus, jqXHR) {
        // since we are using jQuery, you don't need to parse response

		writeResponse(data,'form-auth');
		updateWaivers();
        drawTable(data);
    }
});
});

$( "#form-update" ).submit(function( event ) {
	
          event.preventDefault();
		  if($( "#form-update" ).has( "#update-pwd" ).length){
			if(!($("#update-pwd").val().length<1||$("#update-pwd").val()===$("#update-pwdconfirm").val())){
				data=[];
				data['error_message']="Your passwords must be longer than five characters and must match.";
				data['error_code']=-1;
				writeResponse(data,'form-update');
				return;
			}
		  }
		  dataObject={application_id: '098f6bcd462'};
		  
		  if($( "#form-update" ).has( "#update-auth" ).length)dataObject.auth=$("#update-auth").val();
		  if($( "#form-update" ).has( "#update-name" ).length)dataObject.name=$("#update-name").val();
		  if($( "#form-update" ).has( "#update-surname" ).length)dataObject.surname=$("#update-surname").val();
		  if($( "#form-update" ).has( "#update-email" ).length)dataObject.email=$("#update-email").val();
		  if($( "#form-update" ).has( "#update-phone" ).length)dataObject.phone=$("#update-phone").val();
		  if($( "#form-update" ).has( "#update-address-line1" ).length)dataObject.address_line1=$("#update-address-line1").val();
		  if($( "#form-update" ).has( "#update-address-line2" ).length)dataObject.address_line2=$("#update-address-line2").val();
		  if($( "#form-update" ).has( "#update-address-line3" ).length)dataObject.address_line3=$("#update-address-line3").val();
		  if($( "#form-update" ).has( "#update-address-city" ).length)dataObject.address_city=$("#update-address-city").val();
		  if($( "#form-update" ).has( "#update-address-postcode" ).length)dataObject.address_postcode=$("#update-address-postcode").val();
		  if($( "#form-update" ).has( "#update-address-country" ).length)dataObject.address_country=$("#update-address-country").val();
		  if($( "#form-update" ).has( "#update-pwd" ).length)dataObject.password=$("#update-pwd").val();
		  
  $.ajax({
    url: '/JackerCon/account_update/',
    type: "post",
    dataType: "json",
    data: dataObject,
    success: function(data, textStatus, jqXHR) {
		writeResponse(data,'form-update');
        drawTable(data);
    }
});
});


$( "#form-register" ).submit(function( event ) {
          event.preventDefault();
	//validate
	if(!($("#firstname").val().length>0&&$("#firstname").val().length<50)){
		data=[];
		data['error_message']="please check you have entered your first name.";
		data['error_code']=-1;
		writeResponse(data,'form-register');
		return;
	}
	if(!($("#surname").val().length>0&&$("#surname").val().length<50)){
		data=[];
		data['error_message']="please check you have entered your surname.";
		data['error_code']=-1;
		writeResponse(data,'form-register');
		return;
	}
	if(!($("#email").val().indexOf('@') >0&&$("#email").val().lastIndexOf('.') > $("#email").val().indexOf('@'))){
		data=[];
		data['error_message']="please check you have entered your correct email";
		data['error_code']=-1;
		writeResponse(data,'form-register');
		return;
	}
	if(!($("#password").val().length>5&&$("#password").val()===$("#passwordconfirm").val())){
		data=[];
		data['error_message']="Your passwords must be longer than five character and must match.";
		data['error_code']=-1;
		writeResponse(data,'form-register');
		return;
	}
	
	
	//post
  $.ajax({
    url: '/JackerCon/account_insert/',
    type: "post",
    dataType: "json",
    data: {
		application_id: '098f6bcd462',
        name: $("#firstname").val(),
        surname: $("#surname").val(),
        email: $("#email").val(),
        password: $("#password").val()
		
        
    },
    success: function(data, textStatus, jqXHR) {
        // since we are using jQuery, you don't need to parse response
		writeResponse(data,'form-register');
        drawTable(data);
		
		
    }
});
});

$(function() {
    $( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker( "option", "dateFormat", 'd-MM-yy' );
  });
var locations=null;

  $.ajax({
        url:'/JackerCon/location_request',
        type:'POST',
        data: {},
        dataType: 'json',
        success: function( json ) {
			$('#locations').empty();
			$('#areas').empty();
            $.each(json, function(i, val){
				$('#locations').append('<option value="'+val.location+'">'+val.location+'</option>');
					$('#areas').append('<option value="'+val.id+'">'+val.area+'</option>');
			
//				locations[val.location].area=val.area;
//				locations[val.location].id=val.id;
		    });
			locations=json;
        }
    });
	
$('#locations').on('change', function() {
   	$('#areas').empty();
    $.each(locations, function(i, val){
        $('#areas').append('<option value="'+val.id+'">'+val.area+'</option>');
    });
	update_activities();
});

$('#areas').on('change', function() {
	update_activities();
});
$('#datepicker').on('change', function() {
	update_activities();
});
  $.ajax({
        url:'/JackerCon/items_request',
        type:'POST',
        data: {},
        dataType: 'json',
        success: function( json ) {
			$('#extras_table tr').not('tr:first').remove();
           $.each(json, function(i, val){
              $('#extras_table').append(extraRow(val));
           });
        }
    });
	
	
function extraRow(val){
	string='<tr><td>'+val.name+	'</td>'+
	'<td>'+val.cost+'</td>'+
	'<td><select class="extra_quanitity" id="extra_quanitity_'+val.id+'" >';
			  
	for (i = 0; i < 10; i++) { 
		string += '<option value="'+i+'">'+i+'</option>';
	}

	string+='</select></td></tr>';
	
	return string;
	
}
function update_activities(){
	
	date=$('#datepicker').val().replace("/", "-");
	date=$.datepicker.formatDate( "yy-mm-dd", new Date(date));;
	location_name=$('#locations').val();
	area_id=$('#areas').val();
	
	   $.ajax({
        url:'/JackerCon/activity_request/',
        type:'POST',
        data: {
        date: date,
        area_id: area_id
		},
        dataType: 'json',
        success: function( json ) {
			//$.each($('#activity_table tr').not('tr:first').remove());
        	$('#activity_table tr').not('tr:first').remove();
           $.each(json, function(i, val){
              $('#activity_table').append(activityRow(val));
           });
		   setupActivityChecks();
		   
        }
    });
	
}

function activityRow(val){
	string='<tr><td>'+val.name+	'</td>'+
	'<td>'+val.time_start+'-'+val.time_finish+'</td>'+
	'<td>'+	val.attending+'/'+val.capacity+	'</td>'+
	'<td><input type="checkbox" class="check_activity" id="check_activity_'+val.timetable_id+'" name="'+val.timetable_id+'" value="'+val.timetable_id+'">'+
			  '</td>'+
	'<td><select class="attending_activity" id="attending_activity_'+val.timetable_id+'" style="display:none;">';
			  
	for (i = 0; i < (val.capacity-val.attending+1); i++) { 
		string += '<option value="'+i+'">'+i+'</option>';
	}

	string+='</select></td></tr>';
	
	return string;
}
function setupActivityChecks(){
	$('.check_activity').on('change', function() {
				id=$(this).val();
				if($(this).is(':checked')){
					$('#attending_activity_'+id).show();
				}else{
					$('#attending_activity_'+id).hide()
					$('#attending_activity_'+id).val(0);	
					
				}
			});
	
}


$(function() {
updateWaivers();
});

function updateWaivers(){
	$.ajax({
        url:'/JackerCon/waivers_request/',
        type:'POST',
        data: {},
        dataType: 'json',
        success: function( json ) {
        	$('#waiver_table tr').not('tr:first').not('tr:last').remove();
           $.each(json, function(i, val){
              $('#waiver_table').append(waiverRow(val));
           });
		   
        }
    });
}

function waiverRow(val){
	string='<tr><td>'+val.firstName+	'</td>'+
	'<td>'+val.lastName+'</td>'+
	'<td>'+val.email+'</td>'+
	'<td><button>remove</button></td></tr>';
	return string;
	
}
$( "#form-waiver" ).submit(function( event ) {
	
          event.preventDefault();
		  
		  dataObject={application_id: '098f6bcd462'};
		  
		  if($( "#form-waiver" ).has( "#waiver-firstname" ).length)dataObject.first_name=$("#waiver-firstname").val();
		  if($( "#form-waiver" ).has( "#waiver-lastname" ).length)dataObject.last_name=$("#waiver-lastname").val();
		  if($( "#form-waiver" ).has( "#waiver-email" ).length)dataObject.email=$("#waiver-email").val();
		  
  $.ajax({
    url: '/JackerCon/waiver_insert/',
    type: "post",
    dataType: "json",
    data: dataObject,
    success: function(data, textStatus, jqXHR) {
		updateWaivers();
		writeResponse(data,'form-waivers');
    }
});
});



function writeResponse(data,formName) {
	$("#"+formName).removeClass('fail');
	$("#"+formName).removeClass('success');
	if(data['error_code']==0){
		$("#"+formName).addClass('success');
	$("#"+formName+" #response").html('success: '+data['error_message']);
	return;
	}
	$("#"+formName).addClass('fail');
	$("#"+formName+" #response").html(data['error_message']);
}
/*
$( "#form-request" ).submit(function( event ) {
  console.log($("#auth-email").val());
  $.ajax({
    url: '/JackerCon/account_request/',
    type: "post",
    dataType: "json",
    data: {
		application_id: '098f6bcd462',
        auth_key: $("#request-auth").val()
    },
    success: function(data, textStatus, jqXHR) {
        // since we are using jQuery, you don't need to parse response

        drawTable(data);
    }
});
          event.preventDefault();
});*/

function drawTable(data) {
	var table="<tr><th>POST</th><th>data</th></tr>";


	for(var index in data) {
			table+="<tr><td>"+index+"</td><td>"+data[index]+"</td></tr>";
	}
	
	$("#table-results tbody").html(table);
}