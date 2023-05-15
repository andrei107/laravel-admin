import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {

    /*обертка группы элементов для слайдера*/
		let divBestReceipt = $(".best-receipt-item");

		for(let i = 0; i < divBestReceipt.length; i+=3) {
			divBestReceipt.slice(i, i+3).wrapAll("<div class='slider-triple-element'></div>");
		}

		//слайдеры

		let slideIndexBest = 1,
			slideIndexFast = 1;

		const slidesBest = $('.slider-triple-element'),
			prevBest = $('.offer__slider-prev'),
			nextBest = $('.offer__slider-next'),
			slidesFast = $('.slider-quattro-element'),
			prevFast = $('.offer__slider-prev-fast'),
			nextFast = $('.offer__slider-next-fast');
			
		showBestSlides(slideIndexBest);
	
		function showBestSlides(n) {
			if (n > slidesBest.length) {
				slideIndexBest = 1;
			}
			if (n < 1) {
				slideIndexBest = slidesBest.length;
			}
	
			slidesBest.each(function(index, value){
				$(value).css('display', 'none')
			});
			$(slidesBest[slideIndexBest - 1]).css('display', 'flex');   
		}
	
		function plusBestSlides (n) {
			showBestSlides(slideIndexBest += n);
		}
		prevBest.on('click', function(){
			plusBestSlides(-1);
		});
		nextBest.on('click', function(){
			plusBestSlides(1);
		});
		

		showFastSlides(slideIndexFast);
	
		function showFastSlides(n) {
			if (n > slidesFast.length) {
				slideIndexFast = 1;
			}
			if (n < 1) {
				slideIndexFast = slidesFast.length;
			}
	
			slidesFast.each(function(index, value){
				$(value).css('display', 'none')
			});
			$(slidesFast[slideIndexFast - 1]).css('display', 'flex');   
		}
	
		function plusFastSlides (n) {
			showFastSlides(slideIndexFast += n);
		}
		prevFast.on('click', function(){
			plusFastSlides(-1);
		});
		nextFast.on('click', function(){
			plusFastSlides(1);
		});
		

		//динамика названий
		if ($(window).width() > 950) {
			$('.dark', this).on('mouseover', function () {
				$('.bestItemName', this).stop().animate({
					marginTop: '200px'		
				}, 500);
		   });
		   $('.dark',this).on('mouseout', function () {
				$('.bestItemName', this).stop().animate({
					marginTop: '225px'		
				}, 500);
		   });
		   
		   $('.dark').on('mouseover', function () {
				$('.fastItemName', this).stop().animate({
				  	marginTop: '160px'		
				}, 500);
		   });
		  $('.dark').on('mouseout', function () {
				$('.fastItemName', this).stop().animate({
					marginTop: '175px'		
				}, 500);
		   });   	
		}	  
		
});
