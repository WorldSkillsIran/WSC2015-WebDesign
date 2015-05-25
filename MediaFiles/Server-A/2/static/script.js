
var selectedBrick;
var selectedStack;

$(".stack").click(function(){
	
	if(selectedStack!=$(this).attr('id')){
		$(this).find('.bricks').prepend($('#'+selectedStack).find(".b"+selectedBrick));
		$(".brick").removeClass("selected");
	}



});


$(".brick").click(function() {
	$(".brick").removeClass("selected");
	$(this).addClass("selected");
	selectedBrick=$(this).data('id');
	selectedStack=$(this).parent().parent().attr('id');
	

});


