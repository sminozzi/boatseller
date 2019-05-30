/**
 * Live-update changed settings in real time in the Customizer preview.
 */
( function( $ ) {
 var customize = wp.customize;
$( document.body ).on( 'click', '.customizer-edit', function(){
    customize.preview.send( 'preview-edit', $( this ).data( 'control' ) );
});   
/* ////////// end  */    
	var style = $( '#boatseller-color-scheme-css' ),
		api = wp.customize;
	if ( ! style.length ) {
		style = $( 'head' ).append( '<style type="text/css" id="boatseller-color-scheme-css" />' )
		                    .find( '#boatseller-color-scheme-css' );
	}
	// Site title.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	// Site tagline.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Add custom-background-image body class when background image is added.
	api( 'background_image', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).toggleClass( 'custom-background-image', '' !== to );
		} );
	} );
	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'update-color-scheme-css', function( css ) {
			style.html( css );
		} );
	} );
    /*2018 */
	//Update icon search in real time...
  	api( 'boatseller_search_icon', function( value ) {
		value.bind( function( to ) {
    	} );
	} );  
	wp.customize( 'boatseller_search_icon', function( value ) {
		value.bind( function( newval ) {
            if(newval)
             {
               $('#search-toggle').show();
             }
             else
              {
               $('#search-toggle').hide();
             }            
		} );
	} );
 	var boatseller_search_icon = boatseller_php_vars.boatseller_search_icon;
    if(boatseller_search_icon == '1')
    {
      $('#search-toggle').show(); 
    }
    else
    {
      $('#search-toggle').hide();  
    }
} )( jQuery );