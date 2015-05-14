$(function(){
  /* Restaurant Menu */
  $('[href="#menu"]').click(function(){
    $('#menu').toggleClass('show');
    return false;
  });
  $('[href="#close-menu"]').click(function(){
    $('#menu').removeClass('show');
    return false;
  });


  /* Forms submissiong */
  $('.label').addClass('hiding');
  $('[type="submit"]').click(function(){
    if (Math.random()>0.5) {
      $('.success.label').removeClass('hiding');
    } else {
      $('.alert.label').removeClass('hiding');
    }
    return false;
  });


  /* Tabs */
  // show the first tab.
  $('.tab-content:first').addClass('active');

  // indicate first tab is active.
  $('.tabs > a').removeClass('active');
  $('.tabs > a:first').addClass('active');

  // when click on the tab link.
  $('.tabs > a').click(function(){
    // get the href, which is #tab1, #tab2 or #tab3
    var href = $(this).attr('href');

    // hide all tabs.
    $('.tab-content').removeClass('active')

    // show only the target tab.
    $(href).addClass('active')

    // indicate target tab is active.
    $('.tabs > a').removeClass('active');
    $('.tabs > a[href=' + href + ']:first').addClass('active');

    // disable default browser behavior.
    return false;
  });
});