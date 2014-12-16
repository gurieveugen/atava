function Transport(options)
{
	//                                       __  _          
	//     ____  _________  ____  ___  _____/ /_(_)__  _____
	//    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
	//   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
	//  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
	// /_/              /_/                                 
	this.options = options;
	this.container = '.transport';
	var $this = this;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	
	/**
	 * Launch the animation
	 */
	this.launch = function(){
		var count  = 0;
		var easing = 'linear';

		for(var key in this.options)
		{
			this.animate(this.options[key], this.getEasing(count));
			count++;
		}
	};

	/**
	 * Get easing type. 
	 * Check for even or odd. If even reutnr 'swing' else 'linear'.
	 * @param  integer count --- even or odd
	 * @return string --- easing type
	 */
	this.getEasing = function(count){
		if(count & 1)
		{
			return 'linear';
		}
		return 'swing';
	};

	/**
	 * Animate transport object
	 * @param  json single --- single transport options
	 * @param  string easing --- easing type [swing, linear]
	 */
	this.animate = function(single, easing){
		var t = jQuery(this.container + ' ' + single.selector);
		
		t.css({left : single.position.start + 'px'});
		t.animate({left: single.position.end + 'px'}, parseInt(single.delay), easing, function() { $this.animate(single, easing); });		
	};
}