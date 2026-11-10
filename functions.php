<?php

/* Disable the Admin Bar. */
add_filter( 'show_admin_bar', '__return_false' );

function hide_admin_bar_settings() {
?>
<style type="text/css">
    .show-admin-bar {
        display: none;
    }
</style>
<?php
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            ?>
<li class="post pingback">
    <p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
                <?php
            break;
        default :
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment">
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <?php
                            $avatar_size = 68;
                            if ( '0' != $comment->comment_parent )
                                $avatar_size = 39;

                            echo get_avatar( $comment, $avatar_size );

                            /* translators: 1: comment author, 2: date and time */
                            printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
                                sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                    esc_url( get_comment_link( $comment->comment_ID ) ),
                                    get_comment_time( 'c' ),
                                    /* translators: 1: date, 2: time */
                                    sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
                                )
                            );
                            ?>

                            <?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                        </div><!-- .comment-author .vcard -->

                        <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
                        <br />
                        <?php endif; ?>

                    </footer>

                    <div class="comment-content"><?php comment_text(); ?></div>

                    <div class="reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div><!-- .reply -->
                </article><!-- #comment-## -->

            <?php
            break;
    endswitch;
}
endif; // ends check for twentyeleven_comment()
/*
function tag_to_keywords(){
    global $post;
    $tags = get_the_tags($post->ID);
    if(count($tags) > 0) {
        $keywords = '';
        foreach( $tags as $tag) {
            $keywords .= $tag->name . ', ';
        }
        $keywords = substr($keywords, 0, -2);
        echo $keywords;
    }
}

function content_to_meta(){
    global $post;
    $content = $post->content;
    $key = mb_substr($content, 0, 15, 'UTF-8');
    echo $key;
}
*/

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'id'            => 'sidebar-1',
		'name'          => 'Sidebar',
		'before_widget' => '<section>',
		'after_widget'  => '</section>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>'
	) );
} );
?>
