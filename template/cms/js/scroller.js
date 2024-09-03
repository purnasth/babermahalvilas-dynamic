jQuery(function ($) {

    /**
     * This small plugin will scrollTo a target, smoothly
     *
     * First argument = time to scroll to the target
     * Second argument = set the hash in the current url?
     */
    $.fn.smoothScroll = function(t, setHash) {
        // Set time to t variable to if undefined 500 for 500ms transition
        t = t || 500;
        setHash = (typeof setHash == 'undefined') ? true : setHash;
    
        // Return this as a proper jQuery plugin
        return this.each(function() {
            $('html, body').animate({
                scrollTop: $(this).offset().top
            }, t);
    
            // Lets set the hash to the current ID since if an event was prevented this doesn't get done
            if (this.id && setHash) {
                window.location.hash = this.id;
            }
        });
    };

});

if (window.location.hash) {
    window.scrollTo(0,0);
    $(window.location.hash).smoothScroll();
}

$('a[href^="#"]').click(function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    
    // In this case we have only a hash, so maybe we want to scroll to the top of the page?
    if(href.length === 1) { href = 'body' }
      
    $(href).smoothScroll();
});