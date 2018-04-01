<?php
/**
 * Custom functions that act independently of the theme templates.
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function beka_body_classes( $classes ) {
	/**
	 * Adds a class of group-blog to blogs with more than 1 published author.
	 */
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	/**
	 * Adds a class of hfeed to non-singular pages.
	 */
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}

add_filter( 'body_class', 'beka_body_classes' );


/**
 * Adds post classes.
 *
 * @param $classes
 *
 * @return array
 */
function beka_post_classes( $classes ) {
	global $first_post;

	if ( $first_post === true ) {
		$classes[] = 'first_post';
	} elseif ( ! is_singular() ) {
		$classes[] = 'grid';
	}

	return $classes;
}

add_filter( 'post_class', 'beka_post_classes' );


if ( ! function_exists( 'beka_cat_count' ) ) {
	/**
	 * Add Span tag Around Categories Post Count.
	 *
	 * @param $links
	 *
	 * @return mixed
	 */
	function beka_cat_count( $links ) {

		return str_replace( array( '</a> (', ')' ), array( '<span class="cat-count">(', ')</span></a>' ), $links );
	}
}

add_filter( 'wp_list_categories', 'beka_cat_count' );


if ( ! function_exists( 'beka_archive_count' ) ) {
	/**
	 * Add Span tag Around Archives Post Count.
	 *
	 * @param $links
	 *
	 * @return mixed
	 */
	function beka_archive_count( $links ) {

		return str_replace( array( '</a>&nbsp;(', ')' ), array( '<span class="cat-count">(', ')</span></a>' ), $links );
	}
}

add_filter( 'get_archives_link', 'beka_archive_count' );


/**
 * Limit the Length of Excerpt.
 *
 * @param $length
 *
 * @return string
 */
function beka_excerpt_length( $length ) {

	return (int) apply_filters( 'beka_excerpt_length', 42 );
}

add_filter( 'excerpt_length', 'beka_excerpt_length', 999 );


/**
 * Remove &hellip from excerpt.
 *
 * @param $more
 *
 * @return string
 */
function beka_excerpt_more( $more ) {

	return (string) apply_filters( 'beka_excerpt_more', '' );
}

add_filter( 'excerpt_more', 'beka_excerpt_more' );
