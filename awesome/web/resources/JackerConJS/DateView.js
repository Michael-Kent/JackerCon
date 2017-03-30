$(function() {
	  
	$('.timestamp').each(function(){
		var timestamp=$( this ).html();
		timestamp=new Date (timestamp);
		
		if(timestamp==undefined)return;
		
		if($(this).hasClass('start')){
			console.log(timestamp.toLocaleTimeString());
			$( this ).html(timestamp.toLocaleDateString()+'<br>'+timestamp.toLocaleTimeString());
		}else if($(this).hasClass('finish')){
			$( this ).html(timestamp.toLocaleTimeString());
			console.log(timestamp.toLocaleTimeString());
			
		}
	});
	
	$('.count').each(function(){//<span class="count">day,timestamp</span>
		var show = $( this ).html().split(',')[0];
		var deadline = $( this ).html().split(',')[1];
		
		  var t =Date.parse( new Date(deadline)) - Date.parse(new Date());
		  var seconds = Math.floor( (t/1000) % 60 );
		  var minutes = Math.floor( (t/1000/60) % 60 );
		  var hours = Math.floor( (t/(1000*60*60)) % 24 );
		  var days = Math.floor( t/(1000*60*60*24) );
		  var results= {
			'total': t,
			'day': days,
			'hour': hours,
			'minute': minutes,
			'second': seconds
		  };
		  console.log(results);
		  $( this ).html(results[show]);
			  
	});
	
});