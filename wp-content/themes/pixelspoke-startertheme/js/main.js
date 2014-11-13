(function($) {
  $(document).ready(function() {

    // 1. Utility - Utility functions used throughout
    // 2. Modules - definitions of individually functioning pieces of code.
    //    2.1 Shared accross Pages
    // 3. Initilize - initialize all modules in one place so that we are sure
    //      everything happens in the right order
    // 4. Resize - Everything that happens on the resize event.

    //
    // 1. Utility
    //    Utility functions used throughout
    //

    // stuff I use throughout
    var $win = $(window),
        $body = $('body'),
        curWinWidth = $win.width(),
        curWinHeight = $win.height(),
        timer,
        prevLayoutView = 'small',
        layoutView = 'small',
        smallMax = 600,
        mediumMax = 992,
    checkLayout = function() {
      var $curWin = $(window);
      curWinWidth = $curWin.width();
      if ( curWinWidth <= smallMax ) {
        layoutView = 'small';
      } else if ( curWinWidth > smallMax && curWinWidth < mediumMax ) {
        layoutView = 'medium';
      } else {
        layoutView = 'large';
      }
      // console.log(layoutView);
    },
    resetHeight = function($els) {
      var elsLength = $els.length;
      for ( var i = 0; i < elsLength; i++ ) {
        $($els[i]).css({'minHeight': ''});
      }
    },
    levelHeight = function($els) {
      var maxHeight = 0,
          elsLength = $els.length;
      if ( elsLength > 0 ) {
        resetHeight($els);
        for (i = 0; i < elsLength; i++) {
          var $el = $($els[i]),
              elHeight = $el.outerHeight();
          if ( elHeight > maxHeight) {
            maxHeight = elHeight;
          }
        }
        for (i = 0; i < elsLength; i++) {
          $($els[i]).css({'minHeight': maxHeight});
        }
      }
    },
    // Resize Hero Background Images
    // setHeroImageSizes($images, $container);
    // this is a replacement for background-size: cover;
    setHeroImageSizes = function($heroImages, $localWin) {
      var heroImagesLength = $heroImages.length;
      curWinWidth = $localWin.width();
      curWinHeight = $localWin.height();
      var curWinRatio = curWinWidth/curWinHeight;
      // console.log(curWinWidth);
      for ( i = 0; i < heroImagesLength; i++ ) {
        var $curImg = $($heroImages[i]),
            curImgW = $curImg.attr('width'),
            curImgH = $curImg.attr('height'),
            curImgRatio = curImgW/curImgH,
            curImgCSS = {};
        // console.log(curImgW);
        if ( curWinRatio > curImgRatio ) {
          // console.log('window is wider than image');
          curImgCSS.height = curWinWidth*curImgH/curImgW;
          curImgCSS.width = curWinWidth;
        } else {
          // console.log('image is wider than window');
          curImgCSS.height = curWinHeight;
          curImgCSS.width = curImgW*curWinHeight/curImgH;
        }
        curImgCSS.marginTop = -1*curImgCSS.height/2;
        curImgCSS.marginLeft = -1*curImgCSS.width/2;
        $curImg.css(curImgCSS);
      }
    };

    //
    // 2. Modules
    //    definitions of individually functioning pieces of code.
    //

    //
    // 2.1 Shared accross Pages
    //

    //
    // 3. Initilize
    //    initialize all modules in one place so that we are sure everything
    //    happens in the right order
    //
    checkLayout();

    //
    // 4. Resize
    //    Everything that happens on the resize event.
    //    Resize is an important event, but it triggers waaaay too much.
    //    We throttle it here to only trigger what we need every 200 miliseconds.
    //
    function layoutChange() {
      if ( prevLayoutView !== layoutView ) {
        // functions that need to fire when breakpoints change
        prevLayoutView = layoutView;
      }
    }
    $win.resize(function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        // do resize stuff here
        checkLayout();
        layoutChange();
      }, 200);
    });

  }); // end $(document).ready()
})(jQuery);