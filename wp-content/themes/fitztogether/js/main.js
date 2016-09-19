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

    // Returns a random integer between min (included) and max (excluded)
    // Using Math.round() will give you a non-uniform distribution!
    function getRandomInt(min, max) {
      min = Math.ceil(min);
      max = Math.floor(max);
      return Math.floor(Math.random() * (max - min)) + min;
    }

    //
    // 2. Modules
    //    definitions of individually functioning pieces of code.
    //

    // single header toggle
    var $headerToggle = $('#js-header_toggle'),
        $header = $('#js-header'),
      openHeader = function() {
        $headerToggle.addClass('open');
        $header.addClass('open');
      },
      closeHeader = function() {
        $headerToggle.removeClass('open');
        $header.removeClass('open');
      },
      toggleHeader = function() {
        if ( $headerToggle.hasClass('open') ) {
          closeHeader();
        } else {
          openHeader();
        }
      };
    $headerToggle.click(function() {
      toggleHeader();
    });


    //
    // Conversation Piece Audio Player
    var soundTest = new Audio('http://localhost:8888/fitztogether/wp-content/themes/fitztogether/audio/130.mp3');
    // soundTest.play();

    var $cpPlay = $('#js-cp_play'),
        $cpReplay = $('#js-cp_replay'),
        cpQuestions = ["74.mp3", "20.mp3", "77.mp3", "114.mp3", "21.mp3", "66.mp3", "80.mp3", "52.mp3", "126.mp3", "6.mp3", "5.mp3", "111.mp3", "84.mp3", "88.mp3", "95.mp3", "43.mp3", "134.mp3", "132.mp3", "86.mp3", "57.mp3", "110.mp3", "26.mp3", "87.mp3", "3.mp3", "36.mp3", "83.mp3", "27.mp3", "18.mp3", "78.mp3", "39.mp3", "97.mp3", "107.mp3", "42.mp3", "71.mp3", "61.mp3", "62.mp3", "123.mp3", "124.mp3", "53.mp3", "127.mp3", "112.mp3", "12.mp3", "131.mp3", "117.mp3", "31.mp3", "98.mp3", "75.mp3", "122.mp3", "14.mp3", "50.mp3", "35.mp3", "106.mp3", "65.mp3", "67.mp3", "130.mp3", "113.mp3", "81.mp3", "4.mp3", "10.mp3", "59.mp3", "73.mp3", "37.mp3", "103.mp3", "137.mp3", "99.mp3", "45.mp3", "125.mp3", "70.mp3", "135.mp3", "44.mp3", "41.mp3", "92.mp3", "8.mp3", "119.mp3", "2.mp3", "90.mp3", "9.mp3", "48.mp3", "56.mp3", "128.mp3", "29.mp3", "101.mp3", "32.mp3", "51.mp3", "108.mp3", "96.mp3", "72.mp3", "82.mp3", "104.mp3", "15.mp3", "116.mp3", "40.mp3", "28.mp3", "133.mp3", "64.mp3", "46.mp3", "25.mp3", "109.mp3", "54.mp3", "63.mp3", "55.mp3", "94.mp3", "139.mp3", "38.mp3", "13.mp3", "138.mp3", "11.mp3", "93.mp3", "85.mp3", "16.mp3", "24.mp3", "33.mp3", "118.mp3", "89.mp3", "7.mp3", "47.mp3", "69.mp3", "68.mp3", "120.mp3", "30.mp3", "79.mp3", "91.mp3", "136.mp3", "102.mp3", "34.mp3", "105.mp3", "19.mp3", "23.mp3", "76.mp3", "121.mp3", "1.mp3", "22.mp3", "58.mp3", "60.mp3", "17.mp3", "129.mp3", "49.mp3", "115.mp3", "100.mp3"],
        cpQuestionsLength = cpQuestions.length,
        cpIndex = getRandomInt(0, cpQuestionsLength),
      cpPlay = function() {
        var questionString = phpVars.site_url + "/wp-content/themes/fitztogether/audio/" + cpQuestions[cpIndex];
        new Audio(questionString).play();
      },
      cpPlayNext = function() {
        cpIndex++;
        if ( cpIndex >= cpQuestionsLength ) {
          cpIndex = 0;
        }
        cpPlay();
      };
    $cpPlay.click(function() {
      cpPlayNext();
    });
    $cpReplay.click(function() {
      cpPlay();
    });



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