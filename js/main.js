jQuery(document).ready(function(){
	// ==============================================================
	// Transport launch
	// ==============================================================
	var transport = new Transport({
		quad : { 
			selector: '.quad',
			delay: '16000',
			position: {
				start: 1400,
				end: -200
			}
		},
		minivan : { 
			selector: '.minivan',
			delay: '20000',
			position: {
				start: -300,
				end: 1500
			}
		},
		bus : { 
			selector: '.bus',
			delay: '24000',
			position: {
				start: 1500,
				end: -300
			}
		},
		quad_flip : { 
			selector: '.quad_flip',
			delay: '28000',
			position: {
				start: -200,
				end: 1400
			}
		},
		car : { 
			selector: '.car',
			delay: '32000',
			position: {
				start: 1400,
				end: -200
			}
		},
	});

	transport.launch();
	// ==============================================================
	// Countries SHOW/HIDE
	// ==============================================================
	jQuery('.countries li a').click(function(e){
		var href = jQuery(this).attr('href').replace('#', '');
		jQuery('.countries-info li').each(function(){
			jQuery(this).hide();
		});
		jQuery('.countries-info li.' + href).fadeIn();
		e.preventDefault();
	});
	// ==============================================================
	// Main slider
	// ==============================================================
	if(jQuery('.main-slider aside').length)
	{
		jQuery('.main-slider aside').flexslider({
			animation: "fade",
			slideshowSpeed: 50*1000,
			controlNav: true,
			directionNav: false,
			after: function(slider){
				current_slide = slider.slides[slider.currentSlide];
				jQuery(current_slide).parents('aside').find('.flexslider-title').html( 
					String.Format(
						'<span class="title">{0}</span><span class="subtitle">{1}</span>',
						jQuery(current_slide).find( 'figure figcaption span.title' ).text().trim(),
						jQuery(current_slide).find( 'figure figcaption span.subtitle' ).text().trim()
					)
				);
			}
		});	
		var first_slide = jQuery('.main-slider aside ul li:first figure figcaption');
		var title = first_slide.find('span.title').text().trim();
		var subtitle = first_slide.find('span.subtitle').text().trim();

		jQuery('.main-slider aside').append(
			String.Format(
				'<div class="flexslider-title"><span class="title">{0}</span><span class="subtitle">{1}</span></div>',
				title, subtitle
			)
		);
	}
	
	// ==============================================================
	// boutique
	// ==============================================================
	jQuery('.boutique').boutique({
		front_img_width:   250,
		frames:            7,
		starter:           1,
		speed:             500,
		hovergrowth:       0,
		front_topmargin:   0,
		behind_size:       0.9,
		behind_topmargin:  20,
		behind_distance:   140,
		behind_opacity:    1,
		back_size:         0.7,
		back_topmargin:    60,
		back_opacity:      1,
		autoplay_interval: 4000,
		freescroll:        false,
		text_front_only:   true,
		text_opacity:      0,
		keyboard:          false
	});

	jQuery('.boutique-frame img').dblclick(function(e) {
		var url = jQuery(this).data('url');
		window.open(url);
		e.preventDefault();
	});
	// ==============================================================
	// Selecter
	// ==============================================================
	jQuery("select").selecter();
	// ==============================================================
	// Datepicker
	// ==============================================================
	jQuery('.date').datepicker({
        dateFormat : 'dd.mm.yy',
        showOn: "button",
		buttonImage: defaults.template_url + '/images/datepicker.png',
		buttonImageOnly: true,
		buttonText: "Select date"
    });
	// ==============================================================
	// Chat
	// ==============================================================
	jQuery('.chat').click(function(e){
		if(jQuery('#chat').css('display') == 'none')
		{
			jQuery('#chat').fadeIn();
		}
		else
		{
			jQuery('#chat').fadeOut();
		}
		e.preventDefault();
	});
	// ==============================================================
	// Google maps
	// ==============================================================
	if(jQuery('#map-canvas').length)
	{
		google.maps.event.addDomListener(window, 'load', initializeGMap);
	}
	// ==============================================================
	// Fancybox
	// ==============================================================
	jQuery(".fancybox-inline").fancybox({
		width	: 1000,
		height	: 600,
		fitToView	: false,
		autoSize	: false,
		closeClick	: false,
		beforeShow: function(){
			jQuery('.images-block aside').resize();
		},
		afterShow: function() {
			jQuery('.images-block aside').resize();
		}
	});
	// ==============================================================
	// Fancybox slider
	// ==============================================================
	jQuery('.images-block aside').flexslider({
		animation: 'slide',
		itemWidth: 315,
		loop: true,
		reverse: true,
		start: function(slider){
        	jQuery('.images-block aside').resize();
    	}
	});
});

function initializeGMap() 
{
	var myLatlng = new google.maps.LatLng(jQuery('#map-canvas').data('lat'), jQuery('#map-canvas').data('lng'));
	var mapOptions = {
		zoom: 14,
		center: myLatlng
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: 'My location!'
	});
}