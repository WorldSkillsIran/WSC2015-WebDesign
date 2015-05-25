var selectedBrick;
var selectedStack;
var currentStack;

$(".stack").click(function () {
    currentStack = $(this).data('id');

    if (selectedStack != currentStack) {
        //$(this).find('.bricks').prepend($('#' + selectedStack).find(".b" + selectedBrick));
        //$(".brick").removeClass("selected");

        window.location.href = '?fromStackId=' + selectedStack + '&toStackId=' + currentStack + '&brickId=' + selectedBrick;
    }
});


$(".brick").click(function () {
    $(".brick").removeClass("selected");
    $(this).addClass("selected");
    selectedBrick = $(this).data('id');
    selectedStack = $(this).parent().parent().data('id');
});


