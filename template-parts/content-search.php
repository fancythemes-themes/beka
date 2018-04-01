<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( 'post' === get_post_type() ) : ?>

        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail">
                <?php the_post_thumbnail( 'beka-grid' ); ?>
            </a>
        <?php endif; ?>

        <div class="post-content">
            <span class="post-cats"><?php the_category( ', ' ); ?></span>
            <header class="entry-header clearfix">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                <span class="post-date clearfix">
                <span class="fa fa-calendar-o"></span>
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
                      title="<?php echo esc_html( get_the_date() ); ?>">
                    <?php the_time( 'F d, Y' ); ?>
                </time>
            </span>
            </header>
        </div>

	<?php else : ?>

        <header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header>

	<?php endif; ?>

    <div class="entry-summary">
		<?php the_excerpt(); ?>
    </div>

</article>
