function displaySubList(element){
	element=$(element).parent();
	if($(element).find('ul').css('display') == 'none'){
		$(element).parent('ul').find('ul').each(function(){$(this).hide();});
		$(element).find('ul').show();
	}else{
		$(element).find('ul').hide();
	}
}