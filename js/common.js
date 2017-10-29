jQuery(function($) {

  /* コンポーネント以外の自作スクリプトはこの中へ記述します */
  /*============================================================*/











  /* Custom Post Type Widgetsのアーカイブリンクのバグ修正 */
  /*--------------------------------------------------*/
  var findSidebarAnchor = $('.widget_archive').find('a');
  if($(findSidebarAnchor).length){
    jQuery.each(findSidebarAnchor, function() {
      var thisHref    = $(this).attr('href');
      var thisUrlArr  = thisHref.split('/');
      var newsSlug    = thisUrlArr[thisUrlArr.length-4];
      var replaceHref = thisHref;
      if(thisUrlArr[thisUrlArr.length-5]===newsSlug) {
        replaceHref =  thisHref.replace(newsSlug + '/' + newsSlug , newsSlug);
      }
      $(this).attr('href', replaceHref);
    });
  }

  var findSidebarOption = $('select[name=archive-dropdown]').find('option');
  if($(findSidebarOption).length){
    jQuery.each(findSidebarOption, function() {
      var thisHref    = $(this).attr('value');
      var thisUrlArr  = thisHref.split('/');
      var newsSlug    = thisUrlArr[thisUrlArr.length-4];
      var replaceHref = thisHref;
      if(thisUrlArr[thisUrlArr.length-5]===newsSlug) {
        replaceHref =  thisHref.replace(newsSlug + '/' + newsSlug , newsSlug);
      }
      $(this).attr('value', replaceHref);
    });
  }

});

/* コンポーネント付随のスクリプトはこの下へ記述します */
/*============================================================*/





/* pagetop170 */
/*--------------------------------------------------*/

(function($) {

  var $pagetop170 = $('.pagetop170');

  $(window).on('load scroll', function() {

    var scrT = $(this).scrollTop();

    if (scrT <= 200) {
      $pagetop170.stop().fadeOut();
    } else if (200 < scrT) {
      $pagetop170.stop().fadeIn();
    }

  });

  $pagetop170.on('click', function() {
    $(htmlorbody).animate({
      scrollTop: 0
    }, {
      duration: 500,
      easing: 'easeOutQuart'
    });
  });

})(jQuery);
