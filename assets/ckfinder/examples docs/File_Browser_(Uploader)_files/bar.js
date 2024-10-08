$(document).ready(function() {

    // notification bar
    function anim(duration){
        $('#mint').animate(
            {height: 'toggle'},
            {duration: duration}
        );
    }

    $('#closebtn').click(function() {
        $('#mintbar').slideUp();
        $.cookie("bar", 1, { expires : 10, path: '/' });
        anim(600);
    });

    $('#mint').click(function() {
        anim(600);
        $.cookie("bar", null);
        $('#mintbar').slideDown('slow');
    });

    if ($.cookie('bar')) {
        $('#mintbar').hide();
        $('#mint').show();
    }
    // notification bar

});


(function($, document) {

        var pluses = /\+/g;
        function raw(s) {
                return s;
        }
        function decoded(s) {
                return decodeURIComponent(s.replace(pluses, ' '));
        }

        $.cookie = function(key, value, options) {

                // key and at least value given, set cookie...
                if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value == null)) {
                        options = $.extend({}, $.cookie.defaults, options);

                        if (value == null) {
                                options.expires = -1;
                        }

                        if (typeof options.expires === 'number') {
                                var days = options.expires, t = options.expires = new Date();
                                t.setDate(t.getDate() + days);
                        }

                        value = String(value);

                        return (document.cookie = [
                                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                                options.path    ? '; path=' + options.path : '',
                                options.domain  ? '; domain=' + options.domain : '',
                                options.secure  ? '; secure' : ''
                        ].join(''));
                }

                // key and possibly options given, get cookie...
                options = value || $.cookie.defaults || {};
                var decode = options.raw ? raw : decoded;
                var cookies = document.cookie.split('; ');
                for (var i = 0, parts; (parts = cookies[i] && cookies[i].split('=')); i++) {
                        if (decode(parts.shift()) === key) {
                                return decode(parts.join('='));
                        }
                }
                return null;
        };

        $.cookie.defaults = {};

})(jQuery, document);

