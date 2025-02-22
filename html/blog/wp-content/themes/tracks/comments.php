<?php
/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
        return;

// get user's comment display setting
$comments_display = get_theme_mod('ct_tracks_comments_setting');

// Get current post type
// Must maintain options as "postS, pageS, attachmentS", or existing users will need to reset their comment settings :/
$post_type = get_post_type() . 's';

// error prevention
if( is_array( $comments_display ) ) {

    // if the current post type is not included, don't display comments
    if( ! in_array( $post_type, $comments_display ) ) {
        return;
    }
}

if ( comments_open() ) { ?>

    <section id="comments" class="comments">
        <div class="comments-number">
            <h3>
                <?php comments_number( __( 'Be First to Comment', 'tracks' ), __( 'One Comment', 'tracks'), __( '% Comments', 'tracks' ) ); ?>
            </h3>
        </div>
            <ol class="comment-list">
                    <?php wp_list_comments(array( 'callback'=>'ct_tracks_customize_comments', 'max_depth'=>'7') ); ?>
            </ol><!-- .comment-list -->
            <?php    
            if( (get_option('page_comments') == 1) && (get_comment_pages_count() > 1) ) { ?>
                <nav class="comment-pagination">
                    <p class="previous-comment"><?php previous_comments_link(); ?></p><p class="next-comment"><?php next_comments_link(); ?></p>
                </nav>
            <?php } ?>
            <?php comment_form(); ?>
    </section><!-- #comments -->
<?php 
} elseif(!comments_open() && have_comments() && pings_open() ) { ?>
    <section id="comments" class="comments">
        <div class="comments-number">
            <h3>
<?php comments_number( __( 'Be First to Comment', 'tracks' ), __( 'One Comment', 'tracks'), __( '% Comments', 'tracks' ) ); ?>
            </h3>
        </div>
            <ol class="comment-list">
                    <?php wp_list_comments(array( 'callback'=>'ct_tracks_customize_comments', 'max_depth'=>'3') ); ?>
            </ol><!-- .comment-list -->
            <?php    
            if( (get_option('page_comments') == 1) && (get_comment_pages_count() > 1) ) { ?>
                <nav class="comment-pagination">
                    <p class="previous-comment"><?php previous_comments_link(); ?></p><p class="next-comment"><?php next_comments_link(); ?></p>
                </nav>
            <?php } ?>
            <p class="comments-closed pings-open">
                    <?php printf( __( 'Comments are closed, but <a href="%s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', 'tracks' ), esc_url( get_trackback_url() ) ); ?>
            </p><!-- .comments-closed .pings-open -->
    </section><!-- #comments -->
<?php
} elseif ( !comments_open() && have_comments() ) { ?>
    <section id="comments" class="comments">
        <div class="comments-number">
            <h3>
<?php comments_number( __( 'Be First to Comment', 'tracks' ), __( 'One Comment', 'tracks'), __( '% Comments', 'tracks' ) ); ?>
            </h3>
        </div>
            <ol class="comment-list">
                    <?php wp_list_comments(array( 'callback'=>'ct_tracks_customize_comments', 'max_depth'=>'3') ); ?>
            </ol><!-- .comment-list -->
            <?php    
            if( (get_option('page_comments') == 1) && (get_comment_pages_count() > 1) ) { ?>
                <nav class="comment-pagination">
                    <p class="previous-comment"><?php previous_comments_link(); ?></p><p class="next-comment"><?php next_comments_link(); ?></p>
                </nav>
            <?php } ?>
            <p class="comments-closed">
                <?php _e( 'Comments are closed.', 'tracks' ); ?>
            </p><!-- .comments-closed -->
    </section><!-- #comments -->
<?php 
} else { ?>

    <p class="comments-closed">
            <?php _e( 'Comments are closed.', 'tracks' ); ?>
    </p><!-- .comments-closed -->

<?php } ?>
<?php if( is_single() ) { ?>
<div <?php post_class(); ?>>
    <div class="entry-container">
        <?php get_template_part('sidebar','after-post-content'); ?>
    </div>
</div>
<?php } ?>