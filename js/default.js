jQuery(document).ready(function(){
  /* back-to-top scrolling code from Rafał Dragon */
  //Check to see if the window is top if not then display button
  jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 100) {
      jQuery('#back-to-top').fadeIn();
    } else {
      jQuery('#back-to-top').fadeOut();
    }
  });

  //Click event to scroll to top
  jQuery('#back-to-top').css('display', 'none');
  jQuery('#back-to-top').click(function(){
    jQuery('html, body').animate({scrollTop : 0},800);
    return false;
  });
});
