<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bike Rental Shop
 */

$bike_rental_shop_single_page_title =  get_theme_mod( 'bike_rental_shop_single_page_title', 1 );
$bike_rental_shop_single_page_thumb =  get_theme_mod( 'bike_rental_shop_single_page_thumb', 1 );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if( $bike_rental_shop_single_page_title == 1 ) {?>
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <?php }?>
    </header>
    <?php if( $bike_rental_shop_single_page_thumb == 1 ) {?>
        <?php if(has_post_thumbnail()) {?>
            <hr>
                <?php the_post_thumbnail(); ?>
            <hr>
        <?php }?>
    <?php }?>
    <div class="entry-content">
        <?php the_content();
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'bike-rental-shop'),
                'after' => '</div>',
            ));
        ?>
    </div>

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
                edit_post_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Edit <span class="screen-reader-text">%s</span>', 'bike-rental-shop'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        esc_html( get_the_title())
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            ?>
        </footer>
    <?php endif; ?>
</article>