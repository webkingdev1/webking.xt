$(document).ready(function () {
	var posBasic = 0;
	// Для кнопки "btn_plus"
	if ($(document).width() > 900) {
		$('.btn_plus').click(function(e) {
			e.preventDefault();
			var target = $(this).closest('.blockline').next(),
				  contentCenter = posBasic;

			
			if($(this).hasClass('active')){
				target.slideUp(); //скрывает блок
				$(this).removeClass('active');
			}else{
				if($(this).hasClass('pos-right')){
					posBasic = $(this).css('right');
				}else if($(this).hasClass('pos-right--beta')) {
			posBasic = $(this).css('right');
		  }else{
		  	posBasic = $(this).css('left');
				}
				target.slideDown();
				$(this).addClass('active');
		  		$('html, body').stop().animate({
					'scrollTop': target.offset().top - 
				($('header').outerHeight() + $('.blockline').innerHeight() - 130)
		   // + $(this).find('span').outerHeight())
				}, 900);      
				// $('html, body').stop().animate({
				// 	'scrollTop': target.offset().top - 
				// ($('header').outerHeight() + $(this).find('span').outerHeight())
				// }, 900);
			
			contentCenter = $(".blockline").width()/2
			- $(this).width()/2;
		}
		// центрирует btn_plus по середине blockline
			if($(this).hasClass('pos-right')){
				$(this).css({'right': contentCenter});
			}else if($(this).hasClass('pos-right--beta')){
				$(this).css({'right': contentCenter});
			}else {
				$(this).css({'left': contentCenter});
			}
		});
	}else{
		$('.btn_plus').click(function(e) {
			e.preventDefault();
			var target = $(this).closest('.blockline').next();				
			
			if($(this).hasClass('active')){
				target.slideUp(); //скрывает блок
				$(this).removeClass('active');
			}else{				
				target.slideDown();
				$(this).addClass('active');
		  	
		  	$('html, body').stop().animate({
					'scrollTop': target.offset().top - 
				($('header').outerHeight() + $('.blockline').innerHeight() - 130)
		   // + $(this).find('span').outerHeight())
				}, 900);      
				// $('html, body').stop().animate({
				// 	'scrollTop': target.offset().top - 
				// ($('header').outerHeight() + $(this).find('span').outerHeight())
				// }, 900);
			}
		});
	}


	$('.a_estimateLoad').click(function(event) {
		openObject('estimateLoad');
		removeLoadAnimation('#estimateLoad');
	});

	$('.a_question').click(function(event) {
		openObject('question');
		removeLoadAnimation('#question');
	});

	$('.delivery2').click(function(event) {
		openObject('delivery2');
		removeLoadAnimation('#delivery2');
	});

	$('#page_contacts .greenBtn').click(function(event) {
		openObject('offers');
		removeLoadAnimation('#offers');
	});
	$('#page_contacts .orangeBtn').click(function(event) {
		openObject('lament');
		removeLoadAnimation('#lament');
	});

	// var left = {
	// 	0: '18%',
	// 	1: '48%',
	// 	2: '77%'
	// }
	// var left2 = {
	// 	0: '15%',
	// 	1: '37%',
	// 	2: '58%',
	// 	3: '80%'
	// }
	// $('.info_block').click(function (e) {
	// 	var target = $('.'+$(this).data('target')),
	// 		eq = $(this).index();
	// 	if($(this).hasClass('active')){
	// 		$('.info_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
	// 		$('[id^="info_text_block_"], .blockforline').addClass('hidden');
	// 	}else{
	// 		target.removeClass('hidden');
	// 		$('.blockforline').removeClass('hidden');
	// 		$('[class^="ppp"]').addClass('hidden')
	// 		$('.info_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
	// 		$(this).addClass('active');
	// 		target.removeClass('hidden')
	// 		$(this).find('img').css('-webkit-filter', 'grayscale(0%)');
	// 		$(".block1, .block2").css({"left": left[eq]});
	// 	}
	// });


	// $('.payment_block').click(function (e) {
	// 	var target = $('.'+$(this).data('target')),
	// 		eq = $(this).index();
	// 	if($(this).hasClass('active')){
	// 		$('.payment_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
	// 		$('[id^="info_text_block_"], .blockforline').addClass('hidden');
	// 	}else{
	// 		target.removeClass('hidden');
	// 		$('.blockforline').removeClass('hidden');
	// 		$('[class^="ppp"]').addClass('hidden')
	// 		$('.payment_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
	// 		$(this).addClass('active');
	// 		target.removeClass('hidden')
	// 		$(this).find('img').css('-webkit-filter', 'grayscale(0%)');
	// 		$(".block1, .block2").css({"left": left2[eq]});
	// 	}
	// });
});