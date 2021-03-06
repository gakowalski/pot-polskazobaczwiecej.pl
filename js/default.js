jQuery(document).ready(function(){
  jQuery('#contrast>a').click(function() {
    var high_contrast_enabled = jQuery('body').hasClass('high-contrast');
    document.cookie = "high_contrast=" + (high_contrast_enabled === true? 0 : 1);
    location.reload(true);
    return false;
  });
  jQuery('#font-resize-small').click(function() {
    jQuery('html').css('font-size', '10px');
    document.cookie = "font_resize=small";
    return false;
  });
  jQuery('#font-resize-medium').click(function() {
    jQuery('html').css('font-size', '13px');
    document.cookie = "font_resize=medium";
    return false;
  });
  jQuery('#font-resize-large').click(function() {
    jQuery('html').css('font-size', '16px');
    document.cookie = "font_resize=large";
    return false;
  });

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

  jQuery('span.countUp').each(function () {
    jQuery(this).countup(jQuery(this).text() / 1);
  });

  jQuery("span.js-rotating").Morphext({
      animation: "bounceIn",
  });
});
