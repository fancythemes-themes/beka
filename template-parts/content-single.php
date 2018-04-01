<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail">
			<?php the_post_thumbnail( 'featured' ); ?>
        </a>
	<?php endif; ?>
    <div class="post-content">
        <span class="post-cats"><?php the_category( ', ' ); ?></span>
        <header class="entry-header clearfix">
			<?php
            the_title( '<h1 class="entry-title">', '</h1>' );

			if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
					<?php beka_posted_on(); ?>
                </div>
				<?php
			endif; ?>
        </header>

        <div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beka' ),
				'after'  => '</div>',
			) ); ?>
        </div>

        <footer class="entry-footer">
	        <?php if ( ! post_password_required() ) : ?>

		        <?php
		        /**
		         * Post Tags.
		         */
		        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'tags separator', 'beka' ) );

		        if ( $tags_list ) : ?>
                    <p class="link-tag">
                        <span><?php esc_html_e( 'Tagged with: ', 'beka' ); ?></span> <?php echo $tags_list; ?>
                    </p>
		        <?php endif; ?>

	        <?php endif; ?>

            <div class="share-buttons">
                <h1><?php esc_html_e( 'Share this:', 'beka' ); ?></h1>
                <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( esc_url( get_the_permalink() ) ) ?>&amp;t=<?php echo urlencode( esc_attr( get_the_title() ) ) ?>"><span
                            class="fa fa-facebook"></span></a>
                <a href="https://twitter.com/share?text=<?php echo urlencode( esc_attr( get_the_title() ) ) ?>&amp;url=<?php echo urlencode( esc_url( get_the_permalink() ) ) ?>"><span
                            class="fa fa-twitter"></span></a>
                <a href="https://plus.google.com/share?url=<?php echo urlencode( esc_url( get_the_permalink() ) ) ?>"><span
                            class="fa fa-google-plus"></span></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;title=<?php echo urlencode( esc_attr( get_the_title() ) ) ?>&amp;url=<?php echo urlencode( esc_url( get_the_permalink() ) ) ?>"><span
                            class="fa fa-linkedin"></span></a>
                <a href="mailto:?subject=<?php echo urlencode( esc_attr( get_the_title() ) ) ?>&amp;body=<?php echo urlencode( esc_url( get_the_permalink() ) ) ?>"><span
                            class="fa fa-envelope-o"></span></a>
            </div>
        </footer>
    </div>
</article>
