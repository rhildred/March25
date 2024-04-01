(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-bike_rental_shop_options-';
		
		// Label
		function bike_rental_shop_customizer_label( id, title ) {

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'bike_rental_shop_preloader_hide' || id === 'bike_rental_shop_sticky_header' || id === 'bike_rental_shop_scroll_hide' || id === 'bike_rental_shop_scroll_top_position' || id === 'bike_rental_shop_woocommerce_product_sale' || id === 'bike_rental_shop_woocommerce_related_product_show_hide') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Colors

			if ( id === 'bike_rental_shop_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			//  Header

			if ( id === 'bike_rental_shop_phone' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Social Icon

			if ( id === 'bike_rental_shop_facebook_url' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'bike_rental_shop_top_slider_page1' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider Porduct

			if ( id === 'bike_rental_shop_new_product_number' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Recent Product

			if ( id === 'bike_rental_shop_recent_product_number' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
	
			// Footer

			if ( id === 'bike_rental_shop_footer_bg_image' || id === 'bike_rental_shop_show_hide_copyright') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Setting

			if ( id === 'bike_rental_shop_single_post_thumb' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Comment Setting

			if ( id === 'bike_rental_shop_single_post_comment_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Post Setting

			if ( id === 'bike_rental_shop_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Page Setting

			if ( id === 'bike_rental_shop_single_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Woocommerce Setting

			if ( id === 'bike_rental_shop_product_per_page' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-bike_rental_shop_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

     	// Site Identity
		bike_rental_shop_customizer_label( 'custom_logo', 'Logo Setup' );
		bike_rental_shop_customizer_label( 'site_icon', 'Favicon' );

		// General Setting
		bike_rental_shop_customizer_label( 'bike_rental_shop_preloader_hide', 'Preloader' );
		bike_rental_shop_customizer_label( 'bike_rental_shop_sticky_header', 'Sticky Header' );
		bike_rental_shop_customizer_label( 'bike_rental_shop_scroll_hide', 'Scroll To Top' );
		bike_rental_shop_customizer_label( 'bike_rental_shop_scroll_top_position', 'Scroll to top Position' );
		bike_rental_shop_customizer_label( 'bike_rental_shop_woocommerce_product_sale', 'Woocommerce Product Sale Positions' );
		bike_rental_shop_customizer_label( 'bike_rental_shop_woocommerce_related_product_show_hide', 'Woocommerce Related Products' );

		// Colors
		bike_rental_shop_customizer_label( 'bike_rental_shop_theme_color', 'Theme Color' );
		bike_rental_shop_customizer_label( 'background_color', 'Colors' );
		bike_rental_shop_customizer_label( 'background_image', 'Image' );

		//Header Image
		bike_rental_shop_customizer_label( 'header_image', 'Header Image' );

		// Header
		bike_rental_shop_customizer_label( 'bike_rental_shop_phone', 'Email' );

		// Social Icon
		bike_rental_shop_customizer_label( 'bike_rental_shop_facebook_url', 'Social Links' );

		//Slider
		bike_rental_shop_customizer_label( 'bike_rental_shop_top_slider_page1', 'Slider' );
		
		// Slider Porduct
		bike_rental_shop_customizer_label( 'bike_rental_shop_new_product_number', 'Slider Porduct' );

		// Recent Product
		bike_rental_shop_customizer_label( 'bike_rental_shop_recent_product_number', 'Recent Product' );

		//Footer
		bike_rental_shop_customizer_label( 'bike_rental_shop_footer_bg_image', 'Footer' );
		bike_rental_shop_customizer_label( 'bike_rental_shop_show_hide_copyright', 'Copyright' );

		// Single Post Setting
		bike_rental_shop_customizer_label( 'bike_rental_shop_single_post_thumb', 'Single Post Setting' );
		bike_rental_shop_customizer_label( 'bike_rental_shop_single_post_comment_title', 'Single Post Comment' );

		// Post Setting
		bike_rental_shop_customizer_label( 'bike_rental_shop_post_page_title', 'Post Setting' );

		// Page Setting
		bike_rental_shop_customizer_label( 'bike_rental_shop_single_page_title', 'Page Setting' );
	
		// Woocommerce Setting
		bike_rental_shop_customizer_label('bike_rental_shop_product_per_page', 'Woocommerce Setting');

	});

})( jQuery );
