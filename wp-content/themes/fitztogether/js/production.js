/* Modernizr 2.8.3 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-mq-cssclasses-teststyles-cssclassprefix:mz!
 */
;window.Modernizr=function(a,b,c){function w(a){j.cssText=a}function x(a,b){return w(prefixes.join(a+";")+(b||""))}function y(a,b){return typeof a===b}function z(a,b){return!!~(""+a).indexOf(b)}function A(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:y(f,"function")?f.bind(d||b):f}return!1}var d="2.8.3",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m={},n={},o={},p=[],q=p.slice,r,s=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},t=function(b){var c=a.matchMedia||a.msMatchMedia;if(c)return c(b)&&c(b).matches||!1;var d;return s("@media "+b+" { #"+h+" { position: absolute; } }",function(b){d=(a.getComputedStyle?getComputedStyle(b,null):b.currentStyle)["position"]=="absolute"}),d},u={}.hasOwnProperty,v;!y(u,"undefined")&&!y(u.call,"undefined")?v=function(a,b){return u.call(a,b)}:v=function(a,b){return b in a&&y(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=q.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(q.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(q.call(arguments)))};return e});for(var B in m)v(m,B)&&(r=B.toLowerCase(),e[r]=m[B](),p.push((e[r]?"":"no-")+r));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)v(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" mz-"+(b?"":"no-")+a),e[a]=b}return e},w(""),i=k=null,e._version=d,e.mq=t,e.testStyles=s,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" mz-js mz-"+p.join(" mz-"):""),e}(this,this.document);
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var element = document.getElementById( location.hash.substring( 1 ) );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
					element.tabIndex = -1;

				element.focus();
			}
		}, false );
	}
})();

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