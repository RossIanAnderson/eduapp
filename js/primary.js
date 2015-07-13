$('#imageUpload').click(function(){
	$(this).siblings('input[type="file"]').click();
});

(function(){
		var outer = $('.userRating'),
	     	inner = outer.children('.inner'),
	     	rating = inner.data('rating'),
	     	outerWidth = outer.width(),
	     	ratio = outerWidth / 100, 
	     	innerWidth = ((rating*10) * ratio) * 2;
	 	  
	 inner.css('width', innerWidth + "px");

})();

$('button.show').click(function(){
	$(this).hide();
	$(this).parent('.reviews').children('p').hide();
	$('.reviewFields').slideDown('fast');
});

setInterval(function(){
   var mainHeight = $('main').height(); 
	$('aside').css('height', mainHeight + 'px');
	$('body').css('height', mainHeight + 50 + 'px');
}, 1);

$('a.delete').click(function(){
	var message = $(this).data('message'),
			  c = confirm(message);	
	if(c != true){
		return false;
	}
});

$('#globalSearch').submit(function(){
	var fieldValue = $(this).children('input').val();
	if(fieldValue == ""){
		return false;
	}
});

$('.no').click(function(){
	return false;
});