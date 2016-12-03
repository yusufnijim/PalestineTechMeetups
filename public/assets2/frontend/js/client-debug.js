$(document).ready(function() {

  //convert images into backgrounds and fit them
  $('.image-bg img').each(function (i, image) {
    $(this).closest('.image-bg').css({
      'background-image': 'url(' + $(this).attr('src') + ')'
    });
    $(this).hide();
  });

  //trigger sidebar
  $('.sidebar-trigger').on('click', function () {
    var sidebar = $('.sidebar');
    if (sidebar.hasClass('hidden')) {
      sidebar.removeClass('hidden');
    } else {
      sidebar.addClass('hidden');
    }
  });

  //on resize the screen
  $(window).on('resize', function () {
    //hide sidebar if opened
    $('.sidebar').addClass('hidden');
  });
});
