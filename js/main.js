jQuery(document).ready(function(){
	// ==============================================================
	// Transport launch
	// ==============================================================
	var transport = new Transport({
		quad : { 
			selector: '.quad',
			delay: '8000',
			position: {
				start: 1400,
				end: -200
			}
		},
		minivan : { 
			selector: '.minivan',
			delay: '10000',
			position: {
				start: -300,
				end: 1500
			}
		},
		bus : { 
			selector: '.bus',
			delay: '12000',
			position: {
				start: 1500,
				end: -300
			}
		},
		quad_flip : { 
			selector: '.quad_flip',
			delay: '14000',
			position: {
				start: -200,
				end: 1400
			}
		},
		car : { 
			selector: '.car',
			delay: '16000',
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
});