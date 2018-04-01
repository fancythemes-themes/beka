<?php
/**
 * Custom template tags for this theme.
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function beka_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'beka_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'beka_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so beka_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so beka_categorized_blog should return false.
		return false;
	}
}


/**
 * Flush out the transients used in beka_categorized_blog.
 */
function beka_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Like, beat it. Dig?
	delete_transient( 'beka_categories' );
}

add_action( 'edit_category', 'beka_category_transient_flusher' );
add_action( 'save_post', 'beka_category_transient_flusher' );


if ( ! function_exists( 'beka_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function beka_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( ' %s', 'post date', 'beka' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( ' %s', 'post author', 'beka' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on"><span class="byline"><span class="fa fa-user"></span> ' . $byline . '</span><span class="post-date"><span class="fa fa-calendar-o"></span>' . $posted_on . '</span></span>'; // WPCS: XSS OK.

		if ( ! post_password_required() ) {
			echo '<span class="comments-link">';
			echo '<span class="icon-comments"><span class="fa fa-comment-o"></span></span>';
			comments_popup_link( esc_html__( 'No Comments', 'beka' ), esc_html__( '1', 'beka' ), esc_html__( '%', 'beka' ) );
			echo '</span>';
		}

	}

endif;


if ( ! function_exists( 'beka_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
 	 */
	function beka_post_navigation() {
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		// Don't print empty markup if there's nowhere to navigate.
		if ( ! $next && ! $previous ) {
			return;
		} ?>
        <nav class="navigation post-navigation textcenter clearfix" role="navigation">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '<div class="post-nav-links prev-link-wrapper"><div class="next-link"><span class="uppercase">' . esc_html__( "Published In", "beka" ) . '</span> %link' . "</div></div>" );
			else :
				previous_post_link( '<div class="post-nav-links prev-link-wrapper"><div class="post-nav-link-bg"></div><div class="prev-link"><span class="uppercase"><span class="fa fa-arrow-circle-left"></span> &nbsp;' . esc_html__( "Previous Article", "beka" ) . '</span><div class="nav-title"> %link</div>' . "</div></div>" );
				next_post_link( '<div class="post-nav-links next-link-wrapper"><div class="post-nav-link-bg"></div><div class="next-link"><span class="uppercase">' . esc_html__( "Next Article", "beka" ) . ' &nbsp;<span class="fa fa-arrow-circle-right"></span></span> <div class="nav-title"> %link</div>' . "</div></div>" );
			endif;
			?>
        </nav>
		<?php
	}

endif;


if ( ! function_exists( 'beka_related_posts' ) ) :
	/**
	 * Display related posts below posts.
	 */
	function beka_related_posts() {
		global $post;
		$empty_taxonomy = false;
		$categories     = get_the_category( $post->ID );
		if ( empty( $categories ) ) {
			$empty_taxonomy = true;
		} else {
			$category_ids = array();
			foreach ( $categories as $individual_category ) {
				$category_ids[] = $individual_category->term_id;
			}
			$args = array(
				'category__in'        => $category_ids,
				'post__not_in'        => array( $post->ID ),
				'posts_per_page'      => 2,
				'ignore_sticky_posts' => 1,
			);
		}

		if ( ! $empty_taxonomy ) {
			$my_query = new wp_query( $args );
			if ( $my_query->have_posts() ) {
				echo '<div class="related-posts">';
				echo '<h4>' . esc_html__( 'Related Posts', 'beka' ) . '</h4>';
				echo '<ul>';

				while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                    <li>
                        <div class="related-content">
                            <div class="excerpt">
                                <header>
                                    <h2 class="title"><a href="<?php the_permalink() ?>"
                                                         title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                </header>
								<?php
								$categories_list = get_the_category_list( esc_html__( ', ', 'beka' ) );
								if ( $categories_list && beka_categorized_blog() ) {
									printf( '<span class="cat-links">' . esc_html__( 'In %s', 'beka' ) . '</span>', $categories_list );
								}
								?>
                            </div>
                        </div>
                    </li>
					<?php
				endwhile;

				echo '</ul>';
				echo '</div>';
			}
		}

		wp_reset_postdata();
	}

endif;


/**
 * Output the Custom Logo and/or Site Name/Tagline.
 */
function beka_custom_logo() {

	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                      rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                     rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;

		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; ?></p>
			<?php
		endif;
	}
}


/**
 * Comments Callback.
 */
function beka_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) :
				echo get_avatar( $comment->comment_author_email, 107 );
			endif; ?>
        </div>
        <div class="commentBody">
            <div class="reply">
				<?php comment_reply_link( array_merge( $args, array(
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'reply_text' => esc_html__( ' Reply', 'beka' )
				) ) ); ?>
            </div>

            <span class="comment-meta">
                <?php printf( '<span class="fn"><strong>%s</strong></span>', get_comment_author_link() ); ?>
                <time itemprop="commentTime" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>">
                    <?php
                    /* translators: 1) Comment Date. 2) Comment Time. */
                    printf( esc_html__( '%1$s at %2$s', 'beka' ), get_comment_date(), get_comment_time() ); ?></time>
				<?php edit_comment_link( esc_html__( '(Edit)', 'beka' ), '  ', '' ); ?>
            </span>

			<?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'beka' ) ?></em>
                <br/>
			<?php endif; ?>

            <div class="comment-content">
				<?php comment_text() ?>
            </div>
        </div>
    </div>
	<?php
}
