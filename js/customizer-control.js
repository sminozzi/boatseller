(function( $ ) {
    wp.customize.bind( 'ready', function() {
        var customize = this;
        var customize = wp.customize;
        customize.previewer.bind( 'preview-edit', function( data ) {
            var data = JSON.parse( data );
            var control = customize.control( data.name );
             if (data.name == 'boatseller_sidebar')
             {
                control =  customize.panel( 'widgets' );
             }
                 control.focus();
        } );
        /* end Sidebar------------- */
    } );
})( jQuery );