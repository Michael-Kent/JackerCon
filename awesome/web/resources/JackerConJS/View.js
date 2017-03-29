var app = app || {};

$(function() {
	  
	$('.timestamp').each(function(){
		var pad=function (num) {
			num = num + '';
			return num.length < 2 ? '0' + num : num;
		}
		var timestamp=$( this ).html();
		timestamp=new Date (parseInt(timestamp));
		var monthNames = [
			"January", "February", "March",
			"April", "May", "June",
			"July", "August", "September",
			"October", "November", "December"
			];
			
		if($(this).hasClass('start')){
			var string=monthNames[timestamp.getMonth()] + '/' +
			pad(timestamp.getDate()) + '<br>' +
			pad(timestamp.getHours()) + ':' +
			pad(timestamp.getMinutes());
		}else if($(this).hasClass('finish')){
			var string=pad(timestamp.getHours()) + ':' +
			pad(timestamp.getMinutes());
		}else{
			var string=timestamp.getFullYear() + '/' +
			monthNames[timestamp.getMonth()] + '/' +
			pad(timestamp.getDate()) + ' ' +
			pad(timestamp.getHours()) + ':' +
			pad(timestamp.getMinutes());
		}
		$( this ).html(string);
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
navigator.sayswho= (function(){
    var ua= navigator.userAgent, tem, 
    M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if(/trident/i.test(M[1])){
        tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
        return 'IE '+(tem[1] || '');
    }
    if(M[1]=== 'Chrome'){
        tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
        if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
    }
    M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
    return M.join(' ');
})();

$( '#ua' ).html(navigator.sayswho);
});