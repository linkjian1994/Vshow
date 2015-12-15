$(function() {
	//login
	(function() {
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
	})();

	//scroll
	// (function() {
	// 	$(window).scroll(function() {
	// 		if($(window).scrollTop()>=130){
	// 			$("#nav").addClass("fixedNav");
	// 		}else{
	// 			$("#nav").removeClass("fixedNav");
	// 		} 
	// 	});
	// })();

(function() {
		$("#slider-right .most-main").eq(0).css("display", "block");
		$("#slider-right .most-tit li a i").eq(0).addClass("triangle_bottom");
		$("#slider-right .most-tit li a").click(function() {
			index = $(this).parent().index();
			$("#slider-right .most-main").eq(index).slideDown(200).siblings().hide();
			$("#slider-right .most-tit li a i").eq(index).addClass("triangle_bottom").parents("li").siblings().find("i").removeClass("triangle_bottom");
		});
	})();
	//nav
	(function() {
		// alert(active);
		$("#index").attr('class','active');
		if(active != "[active]"){
			$("#nav li.active").attr('class','');
			$("#"+active).attr('class','active');
		}

		$("#nav li.active").addClass("active");
		$("#nav li.active").stop().animate({backgroundColor: "#00aadd"}, 600).find("span").stop().animate({
			"top": -2,
			"opacity": 1
		}, 1800, "easeOutElastic");	
	

		$("#nav li.active").siblings().hover(function(){ 
            $(this).stop().animate({
                backgroundColor : "#00aadd"
            }, 600).find("span").stop().animate({
				"top": -2,
				"opacity": 1
			}, 1200, "easeOutElastic");

            $(this).siblings().stop().animate({
                backgroundColor: "#138BBD"
            }, 600).find("span").stop().animate({
				"top": -34,
				"opacity": 0
			});
		}, function(){ 
			$("#nav li.active").stop().animate({backgroundColor: "#00aadd"}, 600).find("span").stop().animate({
				"top": -2,
				"opacity": 1
			}, 600, "easeOutElastic");

			$(this).stop().animate({backgroundColor: "#138BBD"}, 600).find("span").stop().animate({
				"top": -34,
				"opacity": 0
			}, 600, "easeOutElastic");
		}); 


	})();

	//search
	(function() {
		var defVal = $("#search .text").val(); //输入关键字
		$("#search .text").focus(function() {
			var thisVal = $(this).val();
			if(thisVal == defVal) $(this).val("");
			$("#search").animate({width:'316px'}, "300");
			$(this).animate({width:'265px'}, "300").addClass("search-focus");
		});
		$("#search .text").blur(function() {
			var thisVal = $(this).val();
			if(thisVal == "") $(this).val(defVal);
			$("#search").animate({width:'216'}, "300");
			$(this).animate({width:'165px'}, "300").removeClass("search-focus");				
		});
	})();

	//slider
		(function() {
		var prev = $("#slider .prev");
		var next = $("#slider .next");
		var imgWidth = $("#slider .slider-big-inner img").width();
		var imgNum = $("#slider .slider-big-inner img").length;

		$("#slider span").hover(function() {
			$(this).stop().animate({
				"opacity": 1
			});
		}, function() {
			$(this).stop().animate({
				"opacity": 0.3
			});
		});

		$("#slider .slider-sm img").eq(0).css({
			"opacity": 1,
			"top": -10
		}).addClass("active");

		var num = 0;

		function sliderAuto() {
			num++;							
			if(num == imgNum) {
				num = 0;
			}
			$("#slider .slider-big-inner").stop().animate({
				"left": -imgWidth*num
			}, 400, "easeOutQuad");

			$("#slider .slider-sm img").eq(num).addClass("active").stop().animate({
				"opacity": 1,
				"top": -10
			}).parent("a").siblings().children("img").removeClass("active").stop().animate({
				"opacity": 0.7,
				"top": 0
			});

		}
		next.click(function () {
			sliderAuto();
		});
		prev.click(function() {
			num--;
			if(num < 0) {
				num = imgNum-1;
			}
			$("#slider .slider-big-inner").stop().animate({
				"left": -imgWidth*num
			}, 400, "easeOutQuad");	

			$("#slider .slider-sm img").eq(num).addClass("active").stop().animate({
				"opacity": 1,
				"top": -10
			}).parent("a").siblings().children("img").removeClass("active").stop().animate({
				"opacity": 0.7,
				"top": 0
			});
		});

		$("#slider .slider-sm img").click(function() {
			index = $(this).parent().index();
			$("#slider .slider-big-inner").animate({"left": -imgWidth*index}, 400, 'easeOutQuad');

			$("#slider .slider-sm img").eq(index).addClass("active").stop().animate({
				"opacity": 1,
				"top": -10
			}).parent("a").siblings().children("img").removeClass("active").stop().animate({
				"opacity": 0.7,
				"top": 0
			});
			$(this).unbind('mouseenter').unbind('mouseleave');
		});

		stopSlider = setInterval(sliderAuto, 6000);
		$("#slider").hover(function(){
			clearInterval(stopSlider);
		}, function() {
			stopSlider = setInterval(sliderAuto, 6000);
		});
	})();
		//slider-right
	(function() {
		$("#slider-right .most-main").eq(0).css("display", "block");
		$("#slider-right .most-tit li a i").eq(0).addClass("triangle_bottom");
		$("#slider-right .most-tit li a").click(function() {
			index = $(this).parent().index();
			$("#slider-right .most-main").eq(index).slideDown(200).siblings().hide();
			$("#slider-right .most-tit li a i").eq(index).addClass("triangle_bottom").parents("li").siblings().find("i").removeClass("triangle_bottom");
		});
	})();

	//hvoer
	(function() {
		$("#slider-right dl strong a").hover(function() {
			$(this).css("position", "relative").stop().animate({
				"left": 10,
				"color": "#F87088"
			}, 400 ,"easeOutQuad");
		}, function() {
			$(this).stop().animate({
				"left": 0,
				"color": "#333333"
			}, 400, "easeOutQuad");
		});

		$("#studentRecomm ul strong a").hover(function() {
			$(this).css("position", "relative").stop().animate({
				"left": 5,
				"color": "#F87088"
			}, 400 ,"easeOutQuad");
		}, function() {
			$(this).stop().animate({
				"left": 0,
				"color": "#444444"
			}, 400, "easeOutQuad");
		});

		$("#learnRight .section li").hover(function() {
			$(this).css({"position":"relative"}).stop().animate({
				"left": 8
			}, 200 ,"easeOutQuad");
			$(this).children("a").stop().animate({
				"color": "#F37B1D"
			}, 200 ,"easeOutQuad");
		}, function() {
			$(this).stop().animate({
				"left": 0
			}, 200, "easeOutQuad");
			$(this).children("a").stop().animate({
				"color": "#323232"
			}, 200 ,"easeOutQuad");
		});
	})();

	//imgBox
	(function() {
		imgBox =  $("#worksBox .zoom img");      	 
        var width = imgBox.width();
        var height = imgBox.height();	

		imgBox.parent().append('<div class="zoomOverlay" />'); //a>
        imgBox.parent().find('.zoomOverlay').css({
            opacity: 0,
            backgroundColor: '#64A0DE',
            display: 'block'
        });  

		imgBox.parent().find('.zoomOverlay').hover(function() {
			$(this).stop().animate({
				opacity: 0.7
			});
            $(this).siblings().stop().animate({
         		height: height + 25,
         		width: width + 25,
                marginLeft: -15,
                marginTop: -25
            }, 300);
		}, function() {
			$(this).stop().animate({
				opacity: 0
			});
            $(this).siblings().stop().animate({
         		height: height,
         		width: width,
                marginLeft: 0,
                marginTop: 0
            }, 300);
		});


	})();

	//learning
	(function() {
		imgBox =  $("#learning img");      	 
        var imgWidth = imgBox.width();
        var imgHeight = imgBox.height();	

        imgBox.parent().find('.zoomOverlay2').css({
            width: imgWidth,
            height: imgHeight,
            left: -imgWidth,
            backgroundColor: '#64A0DE',
            display: 'block'
        });  

        $("#learning li a").hover(function() {
	        $(this).find('.zoomOverlay2').stop().animate({
	            left: 0
	        });  
        }, function() {
	        $(this).find('.zoomOverlay2').stop().animate({
	            left: -imgWidth
	        });  
        });

	})();

	//techArticle
	(function() {
		$("#techArticle ul li").eq(0).addClass("active");
		$("#techArticle ul li").mouseover(function() {
		
			$(this).addClass("active");
			$(this).siblings().removeClass("active");
		});
	})();

	//assort 
	(function() {
		// $("#assort a").bind("click", function() {
		// 	$("#assort a").removeClass("active");
		// 	$(this).addClass("active");
		// });
		var sortArr = new Array();
		sortArr['t'] = 'type-all';
		sortArr['s'] = 'sort-new';
		sortArr['p'] = 1;
		$(".type-sort a").bind("click", function() {
			if ($(this).attr('class') == 'active') {
				return false;	
			};
			$(".type-sort a").removeClass("active");
			$(this).addClass("active");
			sortArr['r'] = $(this).attr('id');
			getWorkList(sortArr);
		
			});

		$(".hot-sort a").bind("click", function() {
			if ($(this).attr('class') == 'active') {
				return false;	
			};
			$(".hot-sort a").removeClass("active");
			$(this).addClass("active");
			sortArr['s'] = $(this).attr('id');
			getWorkList(sortArr);
		});

		$("#page li").bind("click", function() {
			sortArr['p'] = parseInt($(this).find('a').html());
			getWorkList(sortArr);
		});

		function getWorkList(sortArr)
		{	
			var $worksBox = $('#worksBox');
			// console.log(sortArr);
			$.post(root+'/Home/Index/getWorkList',
				{
					t:sortArr['t'],
					s:sortArr['s'],
					p:sortArr['p']
				},
				function(data,status)
				{	
					$worksBox.empty();
                    $.each(
						data,
                     	function(i,workList)
                     	{ 
                     	$worksBox.append('<li id="allwWorkList'+(++i)+'"><div class="img-box"><a  href="'+APP+'/Home/Works/s/id/'+workList.id+'" class="zoom"><img src="'+ROOT+'/Uploads/Works/m_'+workList.works_image+'" alt=""></a></div><div class="img-cont"><h4><a href="#" title="'+workList.works_name+'">'+workList.works_name+'</a></h4><div class="head fl"><a href="#" title="'+workList.works_author+'"><img src="'+ROOT+'/Uploads/Avater/'+workList.avater_path+'" alt="'+workList.works_author+'"></a></div><div class="author fl"><a href="#">'+workList.works_author+'</a></div><div class="time fr">'+getLocalTime(workList.works_pubtime)+'</div><div class="other"><dl class="clearfix"><dd class="view">'+workList.click_counts+'</dd><dd class="love">'+workList.praise_counts+'</dd><dd class="star">0</dd><dd class="weixin">'+workList.comment_counts+'</dd></dl></div></div></li>');

					
                     	}); 
                     
				})
		}


		// $(".class-sort a").bind("click", function() {
		// 	$(".class-sort a").removeClass("active");
		// 	$(this).addClass("active");
		// });

		// $(".label-sort a").bind("click", function() {
		// 	$(".label-sort a").removeClass("active");
		// 	$(this).addClass("active");
		// });

	})();

	//page
	(function() {
		$("#page a").on("click", function() {
			$("#page a").removeClass("active");
			$(this).addClass("active");
		});	
	})();

	//learning
	(function() {
		var img = $("#articleList .article").find('img');
		height = img.height();
		width = img.width();
		img.hover(function() {
			$(this).stop().animate({
				opacity: 0.9,
         		height: height + 15,
         		width: width + 15,
                marginLeft: -10,
                marginTop: -10						
			}, 300);
		}, function() {
            $(this).stop().animate({
            	opacity: 1,
         		height: height,
         		width: width,
                marginLeft: 0,
                marginTop: 0
            }, 300);
		});

	})();

	function getLocalTime(nS) {       
   		return new Date(parseInt(nS) * 1000).toLocaleString();       
	}     
});