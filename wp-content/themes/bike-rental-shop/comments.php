<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bike Rental Shop
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $bike_rental_shop_comments_number = get_comments_number();
            if ( '1' === $bike_rental_shop_comments_number ) {
                /* translators: %s: post title */
                printf( esc_html__( 'One thought on &ldquo;%s&rdquo;', 'bike-rental-shop' ), esc_html( get_the_title() ) );
            } else {
                printf(
                    esc_html(
                        /* translators: 1: number of comments, 2: post title */
                        _nx(
                            '%1$s thought on &ldquo;%2$s&rdquo;',
                            '%1$s thoughts on &ldquo;%2$s&rdquo;',
                            $bike_rental_shop_comments_number,
                            'comments title',
                            'bike-rental-shop'
                        )
                    ),
                    esc_html( number_format_i18n( $bike_rental_shop_comments_number ) ),
                    esc_html( get_the_title() )
                );
            }
            ?>
        </h2>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bike-rental-shop' ); ?></h2>
                <div class="nav-links">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'bike-rental-shop' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'bike-rental-shop' ) ); ?></div>
                </div>
            </nav>
        <?php endif; // Check for comment navigation. ?>
        <ul class="comment-list">
            <?php
                wp_list_comments( array( 'callback' => 'bike_rental_shop_comment', 'avatar_size' => 50 ));
            ?>
        </ul>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bike-rental-shop' ); ?></h2>
                <div class="nav-links">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'bike-rental-shop' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'bike-rental-shop' ) ); ?></div>
                </div>
            </nav>
        <?php
        endif; // Check for comment navigation.

    endif; // Check for have_comments().

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bike-rental-shop' ); ?></p>
    <?php
    endif; ?>

     <?php
        comment_form( array(
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h2>',
            'title_reply' => esc_html(get_theme_mod('bike_rental_shop_single_post_comment_title',__('Leave a Reply','bike-rental-shop' )) ),
            'label_submit' => esc_html(get_theme_mod('bike_rental_shop_single_post_comment_btn_text',__('Post Comment','bike-rental-shop' )) ),
        ) );
    ?>
</div>