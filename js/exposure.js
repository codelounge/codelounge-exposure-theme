/*
Copyright: © 2011 Thomas Stein, CodeLounge.de
<mailto:info@codelounge.de> <http://www.codelounge.de/>

Released under the terms of the GNU General Public License.
You should have received a copy of the GNU General Public License,
along with this software. In the main directory, see: licence.txt
If not, see: <http://www.gnu.org/licenses/>.
*/

/*
 * MBP - Mobile boilerplate helper functions
 */
(function(document){
 
	window.MBP = window.MBP || {};
	 
	// Fix for iPhone viewport scale bug
	// http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
	 
	MBP.viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]');
	MBP.ua = navigator.userAgent;
	 
	MBP.scaleFix = function () {
	  if (MBP.viewportmeta && /iPhone|iPad/.test(MBP.ua) && !/Opera Mini/.test(MBP.ua)) {
	    MBP.viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
	    document.addEventListener("gesturestart", MBP.gestureStart, false);
	  }
	};
	MBP.gestureStart = function () {
	    MBP.viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
	};
	 
	// Hide URL Bar for iOS
	// http://remysharp.com/2010/08/05/doing-it-right-skipping-the-iphone-url-bar/
	 
	MBP.hideUrlBar = function () {
	    /iPhone/.test(MBP.ua) && !pageYOffset && !location.hash && setTimeout(function () {
	      window.scrollTo(0, 1);
	    }, 1000),
	    /iPad/.test(MBP.ua) && !pageYOffset && !location.hash && setTimeout(function () {
	        window.scrollTo(0, 1);
	      }, 1000);
	};


});
jQuery( function() {

	$("a.facebox").fancybox();
	//$("a.fancybox").prettyPhoto({
	//	social_tools: false
	//});
	
	jQuery('.entenlogo').click(function() {
		$('.entenlogo').hide();
	});

	var current_url = $(location).attr('href');
	//console.log($(location).attr('href'));
	jQuery('body').bind( 'taphold', function( e ) {
		//$('#next_post_link').attr('refresh');
		//$('#previous_post_link').attr('refresh');
		$('#page').page('refresh');
		var next_url = $('#next_post_link').attr('href');
		var previous_url = $('#previous_post_link').attr('href');
		console.log(next_url  + ' --- ' + previous_url);
		e.stopImmediatePropagation();
		return false;
	} ); 
 
	jQuery('body').bind( 'swipeleft', function( e ) {
		var next_url = $('.ui-page-active #next_post_link').attr('href');
		var previous_url = $('.ui-page-active #previous_post_link').attr('href');
		console.log("Swiped Left: " + next_url  + ' --- ' + previous_url);
		
		if (undefined != previous_url) {
        	//$.mobile.changePage( previous_url,"slide", true);
        	$.mobile.changePage( previous_url, {
        		transition: "slide",
        		reverse: false,
        		changeHash: true
        	});	
        	e.stopImmediatePropagation();
    		return false;
		}
		
	} ); 
 
	jQuery('body').bind( 'swiperight', function( e ) {
		var next_url = $('.ui-page-active #next_post_link').attr('href');
		var previous_url = $('.ui-page-active #previous_post_link').attr('href');
		console.log("Swiped Right: " + next_url  + ' --- ' + previous_url);
       
        if (undefined != next_url) {
        	//$.mobile.changePage( next_url, "slide", true);
        	$.mobile.changePage( next_url, {
        		transition: "slide",
        		reverse: true,
        		changeHash: true
        	});	
        	e.stopImmediatePropagation();
    	    return false;
        }
	    
	} ); 
	
	
	
  
} ); 




