$.fn.extend({
	bubbleIt: function(){
		var $this = $(this);
		$this.append('<div class="bubble"></div>');
		$this.click(function(e){
			$this.children().css('top', e.originalEvent.layerY - ($this.children().height()/2));
			$this.children().css('left', e.originalEvent.layerX - ($this.children().width()/2));
			$this.children().addClass('bubbleAnimation');
			setTimeout(function(){
				$this.children().removeClass('bubbleAnimation');				
			}, 400);
		});
	}
});

$('.bubbleIt').bubbleIt();