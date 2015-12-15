$(function() {
	(function() {
		$("#ucenterNav li").hover(function() {
			$(this).append("<div class='move'></div>");
			$(this).children(".move").stop().animate({
				"width": 238
			}, 300);
			$(this).children("a").stop().animate({
				"color": "#FFFFFF"
			}, 300)
		}, function() {
			$(this).children(".move").stop().animate({
				"width": 0
			}, 300, function() {
				$(this).remove();
			});	
			$(this).children("a").stop().animate({
				"color": "#05b1df"
			}, 300)	
		});
	})();

	(function() {
		$("#ucenterRight .r-content").eq(0).show();
		$("#ucenterNav a").click(function() {
			index = $(this).parent().index();
			$("#ucenterRight .r-content").eq(index).show().siblings().hide();
		});
	})();

	//share
	(function() {
		$("#share span").eq(0).click(function() {
			$("#share em").stop().animate({
				"left": 0
			});
			$(this).animate({"color":"#FFFFFF"});
			$(this).siblings("span").css("color", "#646464");
		});
		$("#share span").eq(1).click(function() {
			$("#share em").stop().animate({
				"left": 40
			});
			$(this).animate({"color":"#FFFFFF"});
			$(this).siblings("span").css("color", "#646464");
		});
	})();

	//course
	(function() {
		$("#course .cont").eq(0).show();
		$("#course .tit").click(function() {
			$(this).addClass("active").siblings().removeClass("active");
			$("#course .cont").eq($(this).index()).show().siblings().hide();
		});		
	})();

	//下拉菜单插件
	$('.default').dropkick();

});