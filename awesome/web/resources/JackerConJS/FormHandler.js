function applyFormHandler(selector){
	$( selector ).each(function() {
		$(this).data('postData',{});
		$(this).data('verifyData',{});
		$(this).find(':input:not(button), .form-control').each(function () {
			$(this).change(function() {
				var postData=$(this).parents('form').data('postData');
				if(this.type=="checkbox"){
					if(postData[this.name]=='on'){
						postData[this.name]='off';
					}else{
						postData[this.name]='on';
					}
				}else{
					postData[this.name]=this.value;
				}
				$(this).parents('form').data('postData',postData);
				
				validate($(this).parents('form')[0]);
				return false;
			});
			var verifyData=$(this).parents('form').data('verifyData');
			verifyData[this.name]=$(this).attr('data-required')=='true';
			$(this).parents('form').data('verifyData',verifyData);
			
			var postData=$(this).parents('form').data('postData');
			postData[this.name]=this.value;
			$(this).parents('form').data('postData',postData);
		});
		validate(this);
				$('#notification').html('');
				$('#notification-root').hide();
		
		$(this).data('callbackFunction',function(){return true;});
		
		$(this).submit(function(event){
			event.preventDefault();
			if(validateCheck(this)||$(this).attr('data-required')=='false')
				$.ajax({
					url: this.action,
					type: "post",
					dataType: "json",
					data: $(this).data('postData'),
					success: function(json)  {
						if(json.redirectPage!=null){
							
							if('#notification' in json.messages){
								$( '#redirect' ).remove();
								$('body').append('<form id="redirect" action="' + json.redirectPage + '" method="post">' +
								  '<input type="text" name="notification" value="' + json.messages['#notification'] + '" />' +
								  '</form>');
								$('#redirect').submit();
							}else{
								window.location.href = json.redirectPage;
							}
						}
						for (var selector in json.messages){
							if(selector=='#notification')	$('#notification-root').show();
							$(selector).html(json.messages[selector]);
							if(json.success){
								$(selector).addClass('error');
							}else{
								$(selector).addClass('success');
							}
						}
						console.log('success');
					}
				});
			
			return false;
		});
		
		//console.log($(this));
	});
}

function showNotification(notification,success=true){
	if($('#notification').html()==''){
		$('#notification-root').show();
		$('#notification').html(notification);
		if(success){
			$('#notification').addClass('error');
				}else{
			$('#notification').addClass('success');
		}
	}
}
function clearNotification(valid,error_message){
	  if(valid){
		   	if($('#notification').html()==error_message){
				$('#notification').html('');
				$('#notification-root').hide();
			}
	   }else{
		   showNotification(error_message);
	   }
}
	
applyFormHandler("form");

function validateCheck(element){
	valid=true;
	var data=$(element).data('verifyData');
	for (var property in data) {
		if (data.hasOwnProperty(property)) {
			console.log(property+':'+data[property]);
			valid=valid&&data[property];
		}
	}
	console.log(valid);
	return valid;
};

function validate(element){
	var valid=false;
	$(element).find(':input:not(button), .form-control').each(function(){
		switch (this.type)
		{
		   case "text":
				valid=validateText(this);
			   break;
		   case "email":
				valid=validateEmail(this);
			   break;
		   case "password":
				valid=validatePassword(this);
			   break;

		   default: 
			var verifyData=$(this).parents('form').data('verifyData');
			verifyData[this.name]=true;
			$(this).parents('form').data('verifyData',verifyData);
		   
		}
	});
	return valid;
}

function validateText(element){
	var valid=false;
	switch (element.name)
	{
	   case "username":
			if ((element.value.search(/[^A-Za-z0-9-_\.~]/) == -1)&&element.value.length>2&&element.value.length<25) {
				console.log("only correct characters have been found.");
				valid=checkUrl(
				'https://www.JackerCon.com/API/Account/Username_Avaliable/'+element.value,
				function(response)  {
					var json=JSON.parse(response.responseText);
					
					var success=json.success;
					if(success==undefined){
						success=false;
					}else{
						var URI = json.URI.split("/");
						var username = URI[URI.length - 1];
						console.log('username:"'+username+'", '+success);
					}
					
					var verifyData=$(this).parents('form').data('verifyData');
					verifyData['username']=json.success&&response.status==200;
					$(this).parents('form').data('verifyData',verifyData);
					
					error_message="invalid characters have been found in the username";
					clearNotification(json.success&&response.status==200,error_message);
				}.bind(element));
			} else {
				showNotification("invalid characters have been found in the username");
			}
			
			break;
	   case "firstname":
			valid=element.value.length>2;
			error_message='your first name must be more than 2 characters';
	   
			clearNotification(valid,error_message);
			
			var verifyData=$(element).parents('form').data('verifyData');
			verifyData[element.name]=valid;
			$(element).parents('form').data('verifyData',verifyData);
			
			break;
	   case "surname":
			valid=element.value.length>2;
			error_message='your last name must be more than 2 characters';
	   clearNotification(valid,error_message);
			
	   
			var verifyData=$(element).parents('form').data('verifyData');
			verifyData[element.name]=valid;
			$(element).parents('form').data('verifyData',verifyData);
			
			break;

	   default: 
			var verifyData=$(element).parents('form').data('verifyData');
			verifyData[element.name]=true;
			$(element).parents('form').data('verifyData',verifyData);
		break;
	}
	return valid;
}

function validateEmail(element){
	var valid=false;
	switch (element.name)
	{
	   case "email":
			valid=element.value.indexOf('@') >0 && element.value.lastIndexOf('.') > element.value.indexOf('@');
			
			error_message='your email cannot be verified';
	   clearNotification(valid,error_message);
			
			var verifyData=$(element).parents('form').data('verifyData');
			verifyData[element.name]=valid;
			$(element).parents('form').data('verifyData',verifyData);
			
			break;

	   default: 
	}
	return valid;
}

function validatePassword(element){
	var valid=false;
	switch (element.name)
	{
	   case "password":
			valid= element.value.length > 5;
			error_message='your password must be more than 5 characters';
	   clearNotification(valid,error_message);
			
			var verifyData=$(element).parents('form').data('verifyData');
			verifyData[element.name]=valid;
			$(element).parents('form').data('verifyData',verifyData);
		   break;
	   case "passwordconfirm":
			var confirm=$(element).parents('form').data('postData').password;
			valid= element.value.length > 5&&element.value===confirm;
			
			error_message='your confirmed password is either not long enough or not the same as your password';
	   clearNotification(valid,error_message);
			
			var verifyData=$(element).parents('form').data('verifyData');
			verifyData[element.name]=valid;
			$(element).parents('form').data('verifyData',verifyData);
		   break;

	   default: 
	}
	return valid;
}
function checkUrl(url,callback){
    $.ajax({
		url: url,
		complete: callback
	});		
};