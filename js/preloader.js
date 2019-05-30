var boatPreloader = {
	speed : 5000,  /* Max time... for safety */
	elem : 'boat-loader-wraps',
	elemInner : '',
	preloaderOn : function () {
		var el = document.getElementsByTagName('html')[0];         
        var newElem = document.createElement ("div");
    	cdiv = document.createElement('div');
		cdiv.id = this.elem;
		cdiv.innerHTML = '<div id="boat-animates">'+this.elemInner+'</div>';
        newElem.appendChild(cdiv);
        el.appendChild(cdiv); 
	},
	preloaderOff : function() {	
		function fadeoutFn (elem, fadespeed ) {
    		var elem = document.getElementById(elem);
			if(elem.style.display!='none'){
				document.getElementById('boat-animates').style.display='none';
				if (!elem.style.opacity) {
					elem.style.opacity = 1;
				}
				var outInterval = setInterval(function() {
					elem.style.opacity -= 0.05;
					if (elem.style.opacity <= 0) {
						clearInterval(outInterval);
            			elem.style.display='none';
					} 
				}, fadespeed/50 );
			}		
		}
		var elem = this.elem,	
		fadeout = function(){
			 fadeoutFn(elem, 1000);
		}
		setTimeout(fadeout, this.speed);
	},
	start : function() {
		this.preloaderOn();	
	    this.preloaderOff(); /* Activate Security... */		
	}	 
}
boatPreloader.speed = 5000; /* Max time... for safety */
boatPreloader.elem = 'boat-loader';
boatPreloader.elemInner = 'Loading...';
boatPreloader.start();
/*
jQuery(function() {
        console.log( "ready!" );
});
*/