(function (jQuery, undefined) {

	function addSource(elem, path) {
		if ($(elem).length===0) {
			$("<audio></audio>").attr({
			'id':'audio', 
			'volume':1.0
		}).appendTo("body");
		}
  		$(elem).attr('src', path);
		$(elem)[0].play();
		$(elem)[0].muted = false;
	}

    // Set values to cookies.
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/ ';
        javascript:window.location.reload();
    }


    // Get value from cookies.
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
	
	//please replace URL with your TTS service 
	const TEXT_TO_SPEECH_URL = "URL";

    jQuery(document).ready(function () {

        var tts_cookie = getCookie("tts");

        if (tts_cookie == 'true') {
		 var main = this;
		main.texToSpeak = "";
		

        jQuery('span,a,li,h1,h2,h3,h4,h5,h6,h7,h8,h9,p,button,input,speak,img').each(function (index, item) {
		     if (jQuery(item).contents().length==1 && jQuery(item).text()!==undefined && jQuery(item).text()!=="") {
				jQuery(item).addClass("speak");
		     }
                });
		

		jQuery(".speak").hover(function(){
			var self = this;
			if (jQuery(self).is("img")) {
				text = jQuery(self).attr("alt");
				 timer = window.setTimeout(function () {
                                        addSource('#audio', TEXT_TO_SPEECH_URL + "?text="+text);
                                },1200);
                               
			}
			if (jQuery(self).text()!==main.textToSpeak) {
				timer = window.setTimeout(function () {
	                		addSource('#audio', TEXT_TO_SPEECH_URL+"?text="+jQuery.trim(jQuery(self).text()));
				},1200);
				main.textToSpeak = jQuery(self).text()
			}
        	},function(e){
			window.clearTimeout(timer);
		});
        }


        // if the ESC key is tapped
        jQuery('body').keyup(function (e) {
            // ESC key maps to keycode `27`
            if (e.keyCode == 27) {

                // call the close and reset function
                close_video_modal();

            }
        });


    });


})(jQuery);
