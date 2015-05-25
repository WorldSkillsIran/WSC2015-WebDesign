var active = null;

var bricks = $('.brick');

var bricksCount = bricks.length;

$('.stack')
  .each(function () {
    var stackId = $(this).data('stack');
    $(this).find('.brick').each(function () {
      $(this).data('stack', stackId);
    });
  })
  .click(function (e) {
    e.preventDefault();

    if (active) {
        console.log(id);
      var id = $(active).data('id');

      window.location.href = '?fromStackId=' + $(active).data('stack') + '&toStackId=' + $(this).data('stack') + '&brickId=' + $(active).data('value');
    }
  });

bricks.click(function (e) {
  e.preventDefault();
  e.stopPropagation();

  if (active === this) {
    $(this).removeClass('active');
    active = null;
  } else {
    $(active).removeClass('active');
    $(this).addClass('active');
    active = this;
  }
});