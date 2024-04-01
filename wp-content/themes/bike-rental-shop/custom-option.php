<?php

    $bike_rental_shop_theme_css= "";

    /*--------------------------- Scroll To Top Positions -------------------*/

    $bike_rental_shop_scroll_position = get_theme_mod( 'bike_rental_shop_scroll_top_position','Right');
    if($bike_rental_shop_scroll_position == 'Right'){
        $bike_rental_shop_theme_css .='#scroll-button{';
            $bike_rental_shop_theme_css .='right: 20px;';
        $bike_rental_shop_theme_css .='}';
    }else if($bike_rental_shop_scroll_position == 'Left'){
        $bike_rental_shop_theme_css .='#scroll-button{';
            $bike_rental_shop_theme_css .='left: 20px;';
        $bike_rental_shop_theme_css .='}';
    }else if($bike_rental_shop_scroll_position == 'Center'){
        $bike_rental_shop_theme_css .='#scroll-button{';
            $bike_rental_shop_theme_css .='right: 50%;left: 50%;';
        $bike_rental_shop_theme_css .='}';
    }

    /*--------------------------- Slider Image Opacity -------------------*/

    $bike_rental_shop_slider_img_opacity = get_theme_mod( 'bike_rental_shop_slider_opacity_color','');
    if($bike_rental_shop_slider_img_opacity == '0'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.1'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.1';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.2'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.2';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.3'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.3';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.4'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.4';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.5'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.5';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.6'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.6';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.7'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.7';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.8'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.8';
        $bike_rental_shop_theme_css .='}';
        }else if($bike_rental_shop_slider_img_opacity == '0.9'){
        $bike_rental_shop_theme_css .='#top-slider img{';
            $bike_rental_shop_theme_css .='opacity:0.9';
        $bike_rental_shop_theme_css .='}';
        }

    /*---------------------------Slider Height ------------*/

    $bike_rental_shop_slider_img_height = get_theme_mod('bike_rental_shop_slider_img_height');
    if($bike_rental_shop_slider_img_height != false){
        $bike_rental_shop_theme_css .='#top-slider .owl-carousel .owl-item img{';
            $bike_rental_shop_theme_css .='height: '.esc_attr($bike_rental_shop_slider_img_height).';';
        $bike_rental_shop_theme_css .='}';
    }

    /*---------------- Single post Settings ------------------*/

    $bike_rental_shop_single_post_navigation_show_hide = get_theme_mod('bike_rental_shop_single_post_navigation_show_hide',true);
    if($bike_rental_shop_single_post_navigation_show_hide != true){
        $bike_rental_shop_theme_css .='.nav-links{';
            $bike_rental_shop_theme_css .='display: none;';
        $bike_rental_shop_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $bike_rental_shop_product_sale = get_theme_mod( 'bike_rental_shop_woocommerce_product_sale','Right');
    if($bike_rental_shop_product_sale == 'Right'){
        $bike_rental_shop_theme_css .='.woocommerce ul.products li.product .onsale{';
            $bike_rental_shop_theme_css .='left: auto; right: 15px;';
        $bike_rental_shop_theme_css .='}';
    }else if($bike_rental_shop_product_sale == 'Left'){
        $bike_rental_shop_theme_css .='.woocommerce ul.products li.product .onsale{';
            $bike_rental_shop_theme_css .='left: 15px; right: auto;';
        $bike_rental_shop_theme_css .='}';
    }else if($bike_rental_shop_product_sale == 'Center'){
        $bike_rental_shop_theme_css .='.woocommerce ul.products li.product .onsale{';
            $bike_rental_shop_theme_css .='right: 50%;left: 50%;';
        $bike_rental_shop_theme_css .='}';
    }

    /*--------------------------- Woocommerce Related Products -------------------*/

    $bike_rental_shop_woocommerce_related_product_show_hide = get_theme_mod('bike_rental_shop_woocommerce_related_product_show_hide',true);
    if($bike_rental_shop_woocommerce_related_product_show_hide != true){
        $bike_rental_shop_theme_css .='.related.products{';
            $bike_rental_shop_theme_css .='display: none;';
        $bike_rental_shop_theme_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $bike_rental_shop_footer_bg_image = get_theme_mod('bike_rental_shop_footer_bg_image');
    if($bike_rental_shop_footer_bg_image != false){
        $bike_rental_shop_theme_css .='#colophon{';
            $bike_rental_shop_theme_css .='background: url('.esc_attr($bike_rental_shop_footer_bg_image).')!important;';
        $bike_rental_shop_theme_css .='}';
    }

    /*--------------------------- Copyright Background Color -------------------*/

    $bike_rental_shop_copyright_background_color = get_theme_mod('bike_rental_shop_copyright_background_color');
    if($bike_rental_shop_copyright_background_color != false){
        $bike_rental_shop_theme_css .='.footer_info{';
            $bike_rental_shop_theme_css .='background-color: '.esc_attr($bike_rental_shop_copyright_background_color).' !important;';
        $bike_rental_shop_theme_css .='}';
    }

    /*--------------------------- Featured Image Border Radius -------------------*/

    $bike_rental_shop_post_page_image_border_radius = get_theme_mod('bike_rental_shop_post_page_image_border_radius', 0);
    if($bike_rental_shop_post_page_image_border_radius != false){
        $bike_rental_shop_theme_css .='.article-box img{';
            $bike_rental_shop_theme_css .='border-radius: '.esc_attr($bike_rental_shop_post_page_image_border_radius).'px;';
        $bike_rental_shop_theme_css .='}';
    }

    /*--------------------------- Site Title And Tagline Color -------------------*/

    $bike_rental_shop_logo_title_color = get_theme_mod('bike_rental_shop_logo_title_color');
    if($bike_rental_shop_logo_title_color != false){
        $bike_rental_shop_theme_css .='p.site-title a, .navbar-brand a{';
            $bike_rental_shop_theme_css .='color: '.esc_attr($bike_rental_shop_logo_title_color).' !important;';
        $bike_rental_shop_theme_css .='}';
    }

    $bike_rental_shop_logo_tagline_color = get_theme_mod('bike_rental_shop_logo_tagline_color');
    if($bike_rental_shop_logo_tagline_color != false){
        $bike_rental_shop_theme_css .='.logo p.site-description, .navbar-brand p{';
            $bike_rental_shop_theme_css .='color: '.esc_attr($bike_rental_shop_logo_tagline_color).'  !important;';
        $bike_rental_shop_theme_css .='}';
    }