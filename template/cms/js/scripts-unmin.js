// JScript
var base_url = jQuery('base').attr('url');

// Slideshow
jQuery(document).ready(function($){
    if(jQuery('.swiper-parent')[0]) {
        var swiperSlider = new Swiper('.swiper-parent',{
            paginationClickable: false,
            slidesPerView: 1,
            grabCursor: true,
            lazyLoading: true,
            loop: true,
            autoplay: 10000,
            onSwiperCreated: function(swiper){
                $('[data-caption-animate]').each(function(){
                    var $toAnimateElement = $(this);
                    var toAnimateDelay = $(this).attr('data-caption-delay');
                    var toAnimateDelayTime = 0;
                    if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 1400; } else { toAnimateDelayTime = 1400; }
                    if( !$toAnimateElement.hasClass('animated') ) {
                        $toAnimateElement.addClass('not-animated');
                        var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                        setTimeout(function() {
                            $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
                        }, toAnimateDelayTime);
                    }
                });
                IGNITE.slider.swiperSliderMenu();
            },
            onSlideChangeEnd: function(swiper){
                $('#slider .swiper-slide').each(function(){
                    if($(this).find('video').length > 0) { $(this).find('video').get(0).pause(); }
                });
                $('#slider .swiper-slide:not(".swiper-slide-active")').each(function(){
                    if($(this).find('video').length > 0) {
                        if($(this).find('video').get(0).currentTime != 0 ) $(this).find('video').get(0).currentTime = 0;
                    }
                });
                if( $('#slider .swiper-slide.swiper-slide-active').find('video').length > 0 ) { $('#slider .swiper-slide.swiper-slide-active').find('video').get(0).play(); }

                $('#slider .swiper-slide.swiper-slide-active [data-caption-animate]').each(function(){
                    var $toAnimateElement = $(this);
                    var toAnimateDelay = $(this).attr('data-caption-delay');
                    var toAnimateDelayTime = 0;
                    if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 300; } else { toAnimateDelayTime = 300; }
                    if( !$toAnimateElement.hasClass('animated') ) {
                        $toAnimateElement.addClass('not-animated');
                        var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                        setTimeout(function() {
                            $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
                        }, toAnimateDelayTime);
                    }
                });
            }
        });

        $('#slider-arrow-left').on('click', function(e){
            e.preventDefault();
            swiperSlider.swipePrev();
        });

        $('#slider-arrow-right').on('click', function(e){
            e.preventDefault();
            swiperSlider.swipeNext();
        });

        $('#slide-number-current').html(swiperSlider.activeIndex + 1);
        $('#slide-number-total').html(swiperSlider.slides.length);

        $('.swiper-slide').height($(window).height());
    }
}); 

// Package list
jQuery(document).ready(function($) {

    var ocTeam = $("#oc-team-list");

    ocTeam.owlCarousel({
        responsive:{
            0:{ items:1 },
            600:{ items:1 },
            1000:{ items:1 }
        },
        margin: 30,
        nav: false,
        dots:true,
        mouseDrag:false,
        touchDrag:false,
        pullDrag:false,
        freeDrag:false,
        smartSpeed:1500,
        loop:true,
        navRewind:true,
        autoplay:false
    });

});

// Testimonial
jQuery(document).ready(function($) {

    var Testimonial = $("#testimonials-list");

    Testimonial.owlCarousel({
        items: 1,
        margin: 30,
        nav: false,
        dots:true,
        mouseDrag:false,
        touchDrag:false,
        pullDrag:false,
        freeDrag:false,
        smartSpeed:1500,
        loop:true,
        autoplayTimeout:9000,
        navRewind:true,
        autoplay:true
    });

});


// Video home page
/*jQuery(document).ready(function($){
	if(jQuery('.swiper-parent')[0])	{
	    var swiperSlider = new Swiper('.swiper-parent',{
	        paginationClickable: false,
	        slidesPerView: 1,
	        grabCursor: true,
	        onSwiperCreated: function(swiper){
	            $('[data-caption-animate]').each(function(){
	                var $toAnimateElement = $(this);
	                var toAnimateDelay = $(this).attr('data-caption-delay');
	                var toAnimateDelayTime = 0;
	                if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 1400; } else { toAnimateDelayTime = 1400; }
	                if( !$toAnimateElement.hasClass('animated') ) {
	                    $toAnimateElement.addClass('not-animated');
	                    var elementAnimation = $toAnimateElement.attr('data-caption-animate');
	                    setTimeout(function() {
	                        $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
	                    }, toAnimateDelayTime);
	                }
	            });
	            IGNITE.slider.swiperSliderMenu();
	        },
	        onSlideChangeEnd: function(swiper){
	            $('#slider .swiper-slide').each(function(){
	                if($(this).find('video').length > 0) { $(this).find('video').get(0).pause(); }
	            });
	            $('#slider .swiper-slide:not(".swiper-slide-active")').each(function(){
	                if($(this).find('video').length > 0) {
	                    if($(this).find('video').get(0).currentTime != 0 ) $(this).find('video').get(0).currentTime = 0;
	                }
	            });
	            if( $('#slider .swiper-slide.swiper-slide-active').find('video').length > 0 ) { $('#slider .swiper-slide.swiper-slide-active').find('video').get(0).play(); }

	            $('#slider .swiper-slide.swiper-slide-active [data-caption-animate]').each(function(){
	                var $toAnimateElement = $(this);
	                var toAnimateDelay = $(this).attr('data-caption-delay');
	                var toAnimateDelayTime = 0;
	                if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 300; } else { toAnimateDelayTime = 300; }
	                if( !$toAnimateElement.hasClass('animated') ) {
	                    $toAnimateElement.addClass('not-animated');
	                    var elementAnimation = $toAnimateElement.attr('data-caption-animate');
	                    setTimeout(function() {
	                        $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
	                    }, toAnimateDelayTime);
	                }
	            });
	        }
	    });

	    $('#slider-arrow-left').on('click', function(e){
	        e.preventDefault();
	        swiperSlider.swipePrev();
	    });

	    $('#slider-arrow-right').on('click', function(e){
	        e.preventDefault();
	        swiperSlider.swipeNext();
	    });

	    $('#slide-number-current').html(swiperSlider.activeIndex + 1);
	    $('#slide-number-total').html(swiperSlider.slides.length);
	}
});*/

// News blog
jQuery(window).load(function(){

	if(jQuery('#posts')[0]) {
	    var $container = jQuery('#posts');
	    
	    $container.isotope({ transitionDuration: '0.65s' });
	    
	    jQuery(window).resize(function() {
	        $container.isotope('layout');
	    });
	}

});

// Gallery
jQuery(window).load(function(){

	if(jQuery('#portfolio')[0]) {
	    var $container = jQuery('#portfolio');

	    $container.isotope({ transitionDuration: '0.65s' });

	    jQuery('#portfolio-filter a').click(function(){
	        jQuery('#portfolio-filter li').removeClass('activeFilter');
	        jQuery(this).parent('li').addClass('activeFilter');
	        var selector = jQuery(this).attr('data-filter');
	        $container.isotope({ filter: selector });
	        return false;
	    });

	    jQuery('#portfolio-shuffle').click(function(){
	        $container.isotope('updateSortData').isotope({
	            sortBy: 'random'
	        });
	    });

	    jQuery(window).resize(function() {
	        $container.isotope('layout');
	    });
	}

});

jQuery(document).ready(function () {
    $('#map').addClass('scrolloff');                // set the mouse events to none when doc is ready
    
    jQuery('#overlay').on("mouseup",function(){          // lock it when mouse up
        jQuery('#map').addClass('scrolloff'); 
        //somehow the mouseup event doesn't get call...
    });
    jQuery('#overlay').on("mousedown",function(){        // when mouse down, set the mouse events free
        $('#map').removeClass('scrolloff');
    });
    jQuery("#map").mouseleave(function () {              // becuase the mouse up doesn't work... 
        jQuery('#map').addClass('scrolloff');            // set the pointer events to none when mouse leaves the map area
                                                    // or you can do it on some other event
    });         
});

// Reservation
jQuery(document).ready(function() {

   if(jQuery('#roombooking')[0]){
        $('#checkin').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: '0',
            maxDate: '+2Y',
            onSelect: function(dateStr) {
                var d1 = $(this).datepicker("getDate");
                d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
                var d2 = $(this).datepicker("getDate");
                d2.setDate(d2.getDate() + 180); // change to + 180 if necessary   
                $("#checkout").datepicker("option", "minDate", d1);
                $("#checkout").datepicker("option", "maxDate", d2);
            }
        });
        $('#checkout').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: $("#checkin").datepicker("getDate"),
            maxDate: '+2Y'
        });
        
        jQuery("#roombooking")[0].reset();
        jQuery("#roombooking").validate({
            errorElement: 'span',
            errorClass: 'validate-has-error',
            rules: {
                fullname: { required: true },
                mailaddress: { required: true, email: true },
                phone: { required: true },
                address: { required: true },
                country: { required: true },
                checkin: { required: true, date:true },
                checkout: { required: true, date:true },               
                userstring:{
                    required:true,
                    minlength:5,
                    remote: {
                        url: base_url+"captcha/checkcaptcha.php",
                        type: "post"
                    }
                }
            },
            messages:{  
                fullname: { required: "Enter your Fullname", },            
                mailaddress: { required: "Enter your email address", email: "Enter a VALID email address" },
                phone: { required: "Enter your Phone No." },
                address: { required: "Enter your Address" },
                country: { required: "Choose your Country" },
                checkin: { required: "Choose your Check-In Date", date:"Date Format Not Match (yy-mm-dd)" },
                checkout: { required: "Choose your Check-Out Date", date:"Date Format Not Match (yy-mm-dd)" },               
                userstring:{
                    required: 'Enter Security Code',
                    minlength: 'Security Code must be at least 5 characters',
                    remote: "Security Code Not match"     
                }                       
            },      
            submitHandler:function(form){               
                var Frmval = jQuery("#roombooking").serialize();  
                jQuery("#btn-booking").attr("disabled","true").val('Processing...');
                jQuery.ajax({
                    type: "POST",
                    dataType:"JSON",
                    url: base_url+"booking_action.php",
                    data:"action=forbooking&"+Frmval,
                    success:function(data){
                        var msg=eval(data); 
                        jQuery("#btn-booking").removeAttr("disabled").val('Send');    
                        alert(msg.message);
                        jQuery("#roombooking")[0].reset();
                    }               
                });
                return false;
            }
        });
    }
 
    if($('.fancybox')[0]) {
        $('.fancybox').fancybox();
    }
})

function updateCaptcha(c){
    var d = new Date();
    c.src= base_url+'captcha/imagebuilder.php?rand='+d.getTime();
}