$(document).ready(function(){
	$.fn.exists = function(){return this.length>0;}
	if (window.PIE) {
		$('.ie-fix,.btn-01,.misssion,.btn-primary,.charters-mobile ul a,.btn-info,.aircraft-types ul li,.aircraft-type-list ul li, .blog, .info-box, .comment-form,available-aircrafts .info-aircraft, .operators-carousel .slides li .wrap').each(function(){
		PIE.attach(this);
		});
	}
	if ($('#calendar').exists()) {
		$("#calendar").datepicker();
		$('#calendar').children('.ui-datepicker').attr('id', 'ui-datepicker-div');
	}
	if ($('*[data-toggle="lightbox"]').exists()) {
		$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
			event.preventDefault();
			return $(this).ekkoLightbox({
				onShown: function() {
					if (window.console) {
						return console.log('Checking our the events huh?');
					}
				}
			});
		});
	}
	if ($('.navbar-toggle.collapsed').exists()) {
		$('.navbar-toggle.collapsed').click(function() {
			if ($(window).width() <= 1000 && $(window).width() >= 768){
				if(!$('nav').hasClass('active')){
					$('nav').addClass('active');
					$('.mask').fadeTo(800, 0.95);
					$('#header nav').css("position" , "absolute");
					$('.navbar-toggle-holder').css("height","92px");
				}
				else{
					$('nav').removeClass('active');
					$('.mask').fadeOut();
					$('#header nav').css("position" , "static");
					$('.navbar-toggle-holder').css("height","0");
				}
			}
			if ($(window).width() <= 767){
				if(!$('nav').hasClass('active')){
					$('nav').addClass('active');
					$('.mask').fadeTo(800, 0.95);
					$('#header nav').css("position","absolute");
					$('.navbar-toggle-holder').css("height","66px");
				}
				else{
					$('nav').removeClass('active');
					$('.mask').fadeOut();
					$('#header nav').css("position","static");
					$('.navbar-toggle-holder').css("height","0");
				}
			}
		});
	}
	$('.intro').fadeTo(800, 1);
	$('.intro .container').animate({'left': '0'},700 );
	$(".search .form-control" ).focus(function(){
		$('.search .holder').addClass('focus');
	});
	$(".search .form-control" ).focusout(function(){
		$('.search .holder').removeClass('focus');
	});
	$('.intro-01 .ico-plane').animate({
		'left': '0'
	},900 );
	$('.intro-01 h1').animate({
		'right': '0'
	},900 );
	if ($('.sign-in-form, .search-form').exists()) {
		customForm.customForms.replaceAll();
	}
	if ($('.datepicker').exists()) {
		$( "#from" ).datepicker({
			defaultDate: "+1w",
			inline: false,
			showOn: "button",
			showOtherMonths: true,
			selectOtherMonths: true,
			buttonImage: "images/ico-datepicker.png",
			buttonImageOnly: true,
			dayNamesMin: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
			dateFormat: "dd/mm/y",
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
				if($(window).width() < 768){
					$('.mask').fadeOut();
					$('.mask').css("z-index", "20");
				}
			}
		});
		$("#from" ).focus(function(){
			$( "#from" ).datepicker('show');
			if($(window).width() < 768){
				$('.mask').fadeTo(800,0.79);
				$('.mask').css("z-index", "8");
			}
		});
		$( "#to" ).datepicker({
			defaultDate: "+1w",
			inline: true,
			showOn: "button",
			 showOtherMonths: true,
			selectOtherMonths: true,
			buttonImage: "images/ico-datepicker.png",
			buttonImageOnly: true,
			dateFormat: "dd/mm/y",
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
				if($(window).width() < 768){
					$('.mask').fadeOut();
					$('.mask').css("z-index", "20");
				}
			}
		});
		$("#to" ).focus(function(){
			$( "#to" ).datepicker('show');
			if($(window).width() < 768){
				$('.mask').fadeTo(800,0.79);
				$('.mask').css("z-index", "8");
			}
		});
	}
	$('.btn-top').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 1000);
	return false;
	})
	if ($('.aircraft-area .sub-link').exists()) {
		$('.aircraft-area .change-location').hide();
		$('.aircraft-area .sub-link').click(function(){
			if ($(window).width() >= 768){
				if (!$(this).hasClass("active")) {
					$('.aircraft-area .change-location').slideDown();
					$(this).addClass('active');
				}
				else{
					$('.aircraft-area .change-location').slideUp();
					$(this).removeClass('active');
				}
			}
			if ($(window).width() <= 767){
				$('.aircraft-area .change-location').slideDown();
				$('.mask').addClass('active');
				$('.mask.active').fadeTo(800,0.79);
			}
		return false;
		})
		$(document).on('mouseup touchend ',function (e){
			var container = $('.aircraft-area .change-location');
			if (!container.is(e.target) && container.has(e.target).length === 0) {
				container.slideUp().promise().done(function(){
					$('.aircraft-area .sub-link').removeClass('active');
					$('.mask.active').fadeOut();
					$('.mask').removeClass('active');
				});
			}
		});
	}
	function getGridSize() {
		return (window.innerWidth < 480) ? 1 :
			(window.innerWidth < 768) ? 1 : 4;
	  }
	if ($('#carousel').exists()) {
		if ($(window).width() >= 1280){
			$('#carousel').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				touch: true,  
				itemWidth: 293,
				slideshow:false,
				itemMargin: 17,
				move :1,
				minItems: getGridSize(), // use function to pull in initial value
				maxItems: getGridSize()
			});

		}
		if ($(window).width() >= 768 && $(window).width() <= 1280){
			$('#carousel').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				touch: true,  
				itemWidth: 293,
				slideshow:false,
				itemMargin: 4,
				move :1,
				minItems: getGridSize(), // use function to pull in initial value
				maxItems: getGridSize()
			});
		}
		if ($(window).width() <= 767){
			$('#carousel').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				touch: true,  
				itemWidth: 293,
				slideshow:false,
				itemMargin: 0,
				move :1,
				minItems: getGridSize(), // use function to pull in initial value
				maxItems: getGridSize()
			});
		}
		$(window).resize(function() {
			var gridSize = getGridSize();
			$('#carousel').data('flexslider').setOpts({minItems: gridSize, maxItems: gridSize});
		});
	}
	function isTouchDevice() {
		var el = document.createElement('div');
		el.setAttribute('ongesturestart', 'return;');
		if(typeof el.ongesturestart == "function"){
			return true;
		}else {
			return false
		}
	}
	if ($('.setting-bar .add-area').exists()) {
		$('.setting-bar .add-area .open-close').click(function(){
			if(!$(this).hasClass('active')){
				$(this).siblings('.slide-box').slideDown();
				$(this).addClass("active").children('span').html('-');
			} else{
				$(this).siblings('.slide-box').slideUp();
				$(this).removeClass("active").children('span').html('+');
			}
			return false;
		});
		$('.setting-bar .add-area .close').click(function(){
			$(this).closest('.slide-box').slideUp();
			$(this).closest('.add-area').children('.open-close').removeClass("active").children('span').html('+');
			return false;
		});
	}
	if ($('.setting-bar .preference').exists()) {
		$('.setting-bar .option .preferences').click(function(){
			if(!$(this).hasClass('active')){
				$(this).siblings('.preference').slideDown();
				$(this).addClass("active");
			} else{
				$(this).siblings('.preference').slideUp();
				$(this).removeClass("active");
			}
			return false;
		});
		$('.setting-bar .option .close').click(function(){
			$(this).closest('.preference').slideUp();
			$(this).closest('.option li').children('.preferences').removeClass("active");
			return false;
		});
	}
	if ($(window).width() >= 1024) {
		if(!isTouchDevice()){
			if ($('.parallax-bg').exists()) {
				$(window).scroll(function(){
					var win_top = $(window).scrollTop();
					var temp_dif = ( win_top - $('.parallax-bg').offset().top)*0.6;
					$('.parallax-bg').css('background-position', '50% '+temp_dif + 'px' );
					$('.parallax-in-view').css({
						'margin-top' : temp_dif + 'px',
						'margin-bottom' : '-' + temp_dif + 'px'
					});
				});
			}
			if ($('.parallax-bg-01').exists()) {
				$(window).scroll(function(){
					var win_top = $(window).scrollTop();
					var temp_dif = ( win_top - $('.parallax-bg-01').offset().top)*0.6;
					$('.parallax-bg-01').css('background-position', '50% '+temp_dif + 'px' );
					$('.parallax-in-view').css({
						'margin-top' : temp_dif + 'px',
						'margin-bottom' : '-' + temp_dif + 'px'
					});
				});
			}
		}
	}
	if ($(window).width() >= 768) {
		$('.tooltip-link').tooltip();
		if ($('.setting-bar').exists()) {
			$(".setting-bar").sticky();
		}
		var page_h = $(window).height();
		$('.intro').css("height", page_h);
		$(window).scroll( function(){
			$('.search-category .container').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.ico-plane').animate({'left': '-32'},300);
					$('.search-category-form').animate({'right': '0'},300);
				}
			});
			$('.misssion .info').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.misssion .info').animate({'left': '0'},400);
				}
			});
			$('.misssion .charters-fact .descr').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.misssion .charters-fact .descr').animate({'left': '0'},400);
				}
			});
			$('.misssion .charters-mobile .img').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.misssion .charters-mobile .img').animate({'left': '0'},400);
				}
			});
			$('.safety .holder').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.safety .holder .info').animate({'left': '0'},400);
					$('.safety .holder .img').animate({'left': '0'},400);
					$('.safety .about .descr').animate({'right': '0'},400);
				}
			});
			$('.advertise-about .info').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.advertise-about .col-holder div:first-child').animate({'left': '0'},400);
					$('.advertise-about .col-holder div+div').animate({'right': '0'},400);
				}
			});
			$('.advertise-comment h3').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.advertise-comment .blockquote-holder.align-left').animate({'left': '0'},500);
				}
			});
			$('.advertise-comment .blockquote-holder.align-left').each( function(i){
				var bottom_of_object = $(this).position().top + $(this).outerHeight();
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				if( bottom_of_window > bottom_of_object ){
					$('.advertise-comment .blockquote-holder.align-right').animate({'right': '0'},500);
				}
			});
		});
	}
	else{
		$('.safety .holder .info').css({left: 0});
		$('.safety .holder .img').css({left: 0});
		$('.safety .about .descr').css({left: 0});
		$('.misssion .info').css({left: 0});
		$('.misssion .charters-fact .descr').css({left: 0});
	}
	$(".available-flights .list > li:odd").addClass('even');
	function getSize() {
		return (window.innerWidth < 767) ? 2 :
			(window.innerWidth < 768) ? 1 : 5;
	}
	if ($('#carousel-01').exists()) {
		if ($(window).width() >= 1000){
			$('#carousel-01').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				useCSS:false,
				touch: true,  
				itemWidth: 220,
				slideshow:false,
				itemMargin: 28,
				move :1,
				minItems: getSize(), // use function to pull in initial value
	  			maxItems: getSize()
			});
		}
		if ($(window).width() >= 768 && $(window).width() <= 1000){
			$('#carousel-01').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				useCSS:false,
				touch: true,  
				itemWidth: 220,
				slideshow:false,
				itemMargin: 16,
				move :1,
				minItems: getSize(), // use function to pull in initial value
				maxItems: getSize()
			});
		}
		if ($(window).width() <= 767){
			$('#carousel-01').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				itemWidth: 220,
				touch: true,  
				useCSS:false,
				slideshow:false,
				itemMargin: 16,
				move :1,
				minItems: getSize(), // use function to pull in initial value
				maxItems: getSize()
			});
		}
		$(window).resize(function() {
			var gridSize = getSize();
			$('#carousel-01').data('flexslider').setOpts({minItems: gridSize, maxItems: gridSize});
		});
	}
	function getSize1() {
		return (window.innerWidth < 767) ? 1 :
			(window.innerWidth < 768) ? 3 :
			(window.innerWidth < 1280) ? 3 : 5;
	}
	if ($('#carousel-02').exists()) {
		if ($(window).width() >= 1000){
			$('#carousel-02').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				useCSS:false,
				itemWidth: 220,
				slideshow:false,
				touch: true,  
				itemMargin: 28,
				move :1,
				minItems: getSize1(), // use function to pull in initial value
	  			maxItems: getSize1()
			});

		}
		if ($(window).width() >= 768 && $(window).width() <= 1000){
			$('#carousel-02').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				useCSS:false,
				touch: true,  
				itemWidth: 220,
				slideshow:false,
				itemMargin: 16,
				move :1,
				minItems: getSize1(), // use function to pull in initial value
				maxItems: getSize1()
			});
		}
		if ($(window).width() <= 767){
			$('#carousel-02').flexslider({
				animation: "slide",
				animationLoop: true,
				controlNav:false,
				itemWidth: 220,
				useCSS:false,
				touch: true,  
				slideshow:false,
				itemMargin: 0,
				move :1,
				minItems: getSize1(), // use function to pull in initial value
				maxItems: getSize1()
			});
		}
		$(window).resize(function() {
			var gridSize = getSize1();
			$('#carousel-02').data('flexslider').setOpts({minItems: gridSize, maxItems: gridSize});
		});
	}
	if ($('.select-aicraft').exists()) {
		$('.select-aicraft .info-aircraft label, .select-aicraft .info-aircraft .chk-area').click(function(){
			if(!$(this).closest('.info-aircraft').hasClass('selected-block')){
				$(this).closest('.info-aircraft').addClass('selected-block');
				$(this).closest('.info-aircraft').find('.check label').html('selected');
			} else{
				$(this).closest('.info-aircraft').removeClass('selected-block');
				$(this).closest('.info-aircraft').find('.check label').html('select');
			}
			return false;
		});
	}
if ($('.advertise-info .get-started .img').exists()) {
        $('.advertise-info .get-started .img img').actionInView({
            action: function(el) {
                var el_width = el.width(),
                    el_height = el.height();
                el.parent().css({width: el_width+'px', height: el_height+'px'});
                var animateIntervalID = setInterval(function(){
                    el.animate({width: '+=20px', marginLeft: '-=10px', marginTop: '-=10px'},800).animate({width: '-=20px',marginLeft: '+=10px',marginTop: '+=10px'},800);
                },1600);
                setTimeout(function(){
                    clearInterval(animateIntervalID);
                    setTimeout(function(){
                        el.removeAttr('style');
                        el.parent().removeAttr('style');
                    },1800);

                },1600);

            }
        });
    }
    if ($('.aircraft-slider').exists()) {
        $('.aircraft-slider').actionInView({
            before: function(){
                $('.aircraft-slider li img').css({opacity: 0});
            },
            action: function(el){

                el.find('li img').each(function(index){
                    var $this = $(this);
                    var timeOut_counter = 300*index;
                    setTimeout(function(){
                        $this.animate({opacity:1},100)
                    },timeOut_counter);

                });
            }
        });
    }
    if ($('.available-aircrafts').exists()) {
        setTimeout(function(){
            $('.available-aircrafts').actionInView({
                before: function(){
                    $('.info-aircraft').css({opacity: 0});
                },
                action: function(el){

                    el.find('.info-aircraft').each(function(index){
                        var $this = $(this);
                        var timeOut_counter = 500*index;
                        setTimeout(function(){
                            $this.animate({opacity:1},500)
                        },timeOut_counter);
                    });
                }
            });
        },500)
    }
    if ($('.aircraft-types').exists()) {
        setTimeout(function(){
            $('.aircraft-types').actionInView({
                before: function(){
                    $('.aircraft-types li img').css({opacity: 0});
                },
                action: function(el){

                    el.find('li img').each(function(index){
                        var $this = $(this);
                        var timeOut_counter = 400*index;
                        setTimeout(function(){
                            $this.animate({opacity:1},400)
                        },timeOut_counter);

                    });
                }
            });
        },500);
    }
    if ($('.available-flights').exists()) {
        $('.available-flights .list').actionInView({
            before: function(){
                $('.available-flights .list > li').css({opacity: 0});
            },
            action: function(el){

                el.find('li').each(function(index){
                    var $this = $(this);
                    var timeOut_counter = 100*index;
                    setTimeout(function(){
                        $this.animate({opacity:1},500)
                    },timeOut_counter);

                });
            }
        });
    }
    if ($('.aircraft-type-list').exists()) {
        $('.aircraft-type-list').actionInView({
            before: function(){
                $('.aircraft-type-list li').css({opacity: 0});
            },
            action: function(el){

                el.find('li').each(function(index){
                    var $this = $(this);
                    var timeOut_counter = 50*index;
                    setTimeout(function(){
                        $this.animate({opacity:1},500)
                    },timeOut_counter);

                });
            }
        });
    }
    if ($('#content .blog').exists()) {
        setTimeout(function(){
            $('#content .blog').actionInView({
                before: function(el){
                    $(el).css({opacity: 0});
                },
                action: function(el){
                    el.animate({opacity:1},500);
                }
            });
            $('#sidebar > div').actionInView({
                before: function(el){
                    $(el).css({opacity: 0});
                },
                action: function(el){
                    el.animate({opacity:1},500);
                }
            });
        },500);
    }
    if ($('.safety-ratings .list').exists()) {
        $('.safety-ratings .list').actionInView({
            before: function(){
                $('.safety-ratings .list li').css({opacity: 0});
            },
            action: function(el){
                el.find('li').each(function(index){
                    var $this = $(this);
                    var timeOut_counter = 300*index;
                    setTimeout(function(){
                        $this.animate({opacity:1},400)
                    },timeOut_counter);

                });
            }
        });
    }
    if ($('.operators-carousel').exists()) {
//        setTimeout(function(){
            $('.operators-carousel').actionInView({
                before: function(){
                    $('.operators-carousel li .wrap').css({opacity: 0});
                },
                action: function(el){
                    el.find('li .wrap').each(function(index){
                        var $this = $(this);
                        var timeOut_counter = 500*index;
                        setTimeout(function(){
                            $this.animate({opacity:1},500)
                        },timeOut_counter);

                    });
                }
            });
//        },500);

    }
    if ($('.select-aicraft .info-aircraft').exists()) {
//        setTimeout(function(){
            $('.select-aicraft .info-aircraft').actionInView({
                before: function(){
                    $('.info-aircraft').css({opacity: 0});
                },
                action: function(el){

                    el.each(function(index){
                        var $this = $(this);
                        var timeOut_counter = 500*index;
                        setTimeout(function(){
                            $this.animate({opacity:1},500)
                        },timeOut_counter);
                    });
                }
            });
//        },500)
    }
    if ($('#map').exists()) {
        var city_list = $('#city-list').hide();
        $('#map').vectorMap({
            map: 'usa_en',
            backgroundColor: null,
            color: '#bebebe',
            hoverColor: '#1f5268',
            selectedColor: '#1f5268',
            borderColor: '#e0e0e0',
            borderOpacity: 0.25,
            borderWidth: 1,
            enableZoom: false,
            showTooltip: false,
//            selectedRegion: 'WY',
            onRegionClick: function(element, code, region) {
                city_list.attr(
                    'class',
                    city_list.attr('class').replace(/\scitylist-[a-z]+/g, '')
                );
                city_list.addClass('citylist-' + code);
                city_list.fadeIn();
            }
        });
    }
});

function ConvertAirportDMS(position) {
    console.log(position);
    var direction = position.substr(-1);
    var pieces = position.split(position.substr(-1))[0].split('-');
    return ConvertDMSToDD(pieces[0], pieces[1], pieces[2], direction);
}

function dms2deg(s) {

    // Determine if south latitude or west longitude
    var sw = /[sw]/i.test(s);

    // Determine sign based on sw (south or west is -ve)
    var f = sw? -1 : 1;

    // Get into numeric parts
    var bits = s.match(/[\d.]+/g);

    var result = 0;

    // Convert to decimal degrees
    for (var i=0, iLen=bits.length; i<iLen; i++) {

        // String conversion to number is done by division
        // To be explicit (not necessary), use
        //   result += Number(bits[i])/f
        result += bits[i]/f;

        // Divide degrees by +/- 1, min by +/- 60, sec by +/-3600
        f *= 60;
    }

    return result;
}