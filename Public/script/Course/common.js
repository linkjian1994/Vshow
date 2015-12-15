$(function(){
	
		$("#login a").hover(function() {
			$(this).animate({
				"backgroundColor": '#FFFFFF',
				"color": '#FF0000',
				"borderColor": '#FFFFFF'
			});
		}, function() {
			$(this).animate({
				"backgroundColor": '#353C44',
				"color": '#C8C8C8',
				"borderColor": '#646464'
			});
		});
	
})