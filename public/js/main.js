(function($){
	var post, scrollTop, docHeight, windowHeight;

	post = $('.post');
	docHeight = $(document).height();
	windowHeight = $(window).height();

	post.each(function(){
		if ($(this).offset().top < windowHeight) {
			$(this).addClass('is-showing');
		}		
	});

	$(window).scroll(function(){

		scrollTop = $(document).scrollTop();

		post.each(function(){
			if ($(this).offset().top <= scrollTop + (windowHeight - 50)) {
				$(this).addClass('is-showing');
			}
		});

	});

}(jQuery))