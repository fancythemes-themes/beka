<?php

class Beka_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		parent::__construct( 'beka_recent_posts', esc_html__( '(Beka) Recent Posts', 'beka' ), array(
			'description' => esc_html__( 'A widget to show recent posts', 'beka' ),
		) );
	}

	public function widget( $args, $instance ) {
		$title      = apply_filters( 'widget_title', $instance['title'] );
		$quantity   = absint( $instance['quantity'] );
		$show_thumb = (int) $instance['show_thumb'];
		$show_cat   = (int) $instance['show_cat'];

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
        <div class="tabs-widget">
            <ul>
				<?php
				$recent_posts = new WP_Query( array(
					'showposts'           => $quantity,
					'order'               => 'DESC',
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
				) );

				if ( $recent_posts->have_posts() ) :
					while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                        <li>
							<?php if ( $show_thumb === 1 && has_post_thumbnail() ) : ?>
                                <div class="thumbnail">
                                    <a class="featured-thumbnail widgetthumb"
                                       href='<?php the_permalink(); ?>'><?php the_post_thumbnail( 'beka-widget' ); ?></a>
                                </div>
							<?php endif; ?>
                            <div class="info">
								<?php if ( $show_cat === 1 ) : ?>
                                    <span class="meta">
                                        <span class="post-cats"><?php the_category( ', ' ); ?></span>
                                    </span>
								<?php endif; ?>
                                <span class="widgettitle"><a href="<?php the_permalink(); ?>"
                                                             title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
                            </div>
                        </li>
						<?php
					endwhile;
				else:
                    ?><li><?php esc_html_e( 'Nothing to show.', 'beka' ); ?></li><?php
				endif;

				wp_reset_postdata();
				?>
            </ul>
        </div>
		<?php

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['quantity']   = absint( $new_instance['quantity'] );
		$instance['show_thumb'] = intval( $new_instance['show_thumb'] );
		$instance['show_cat']   = intval( $new_instance['show_cat'] );

		return $instance;
	}

	public function form( $instance ) {
		$defaults   = array(
			'title'      => esc_html__( 'Recent Posts', 'beka' ),
			'quantity'   => 4,
			'show_thumb' => 1,
			'show_cat'   => 1,
		);
		$instance   = wp_parse_args( (array) $instance, $defaults );
		$quantity   = absint( $instance['quantity'] );
		$show_thumb = isset( $instance['show_thumb'] ) ? intval( $instance['show_thumb'] ) : 1;
		$show_cat   = isset( $instance['show_cat'] ) ? intval( $instance['show_cat'] ) : 1;
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'beka' ); ?></label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   value="<?php echo esc_attr( esc_html( $instance['title'] ) ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'quantity' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'beka' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'quantity' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'quantity' ) ); ?>">
                <option value="1" <?php selected( 1, $quantity ); ?>><?php echo number_format_i18n( 1 ); ?></option>
                <option value="2" <?php selected( 2, $quantity ); ?>><?php echo number_format_i18n( 2 ); ?></option>
                <option value="3" <?php selected( 3, $quantity ); ?>><?php echo number_format_i18n( 3 ); ?></option>
                <option value="4" <?php selected( 4, $quantity ); ?>><?php echo number_format_i18n( 4 ); ?></option>
                <option value="5" <?php selected( 5, $quantity ); ?>><?php echo number_format_i18n( 5 ); ?></option>
                <option value="6" <?php selected( 6, $quantity ); ?>><?php echo number_format_i18n( 6 ); ?></option>
                <option value="7" <?php selected( 7, $quantity ); ?>><?php echo number_format_i18n( 7 ); ?></option>
                <option value="8" <?php selected( 8, $quantity ); ?>><?php echo number_format_i18n( 8 ); ?></option>
                <option value="9" <?php selected( 9, $quantity ); ?>><?php echo number_format_i18n( 9 ); ?></option>
                <option value="10" <?php selected( 10, $quantity ); ?>><?php echo number_format_i18n( 10 ); ?></option>
                <option value="11" <?php selected( 11, $quantity ); ?>><?php echo number_format_i18n( 11 ); ?></option>
                <option value="12" <?php selected( 12, $quantity ); ?>><?php echo number_format_i18n( 12 ); ?></option>
                <option value="13" <?php selected( 13, $quantity ); ?>><?php echo number_format_i18n( 13 ); ?></option>
                <option value="14" <?php selected( 14, $quantity ); ?>><?php echo number_format_i18n( 14 ); ?></option>
                <option value="15" <?php selected( 15, $quantity ); ?>><?php echo number_format_i18n( 15 ); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( "show_thumb" ) ); ?>">
                <input type="checkbox" class="checkbox"
                       id="<?php echo esc_attr( $this->get_field_id( "show_thumb" ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( "show_thumb" ) ); ?>"
                       value="1" <?php checked( 1, $show_thumb, true ); ?> />
				<?php esc_html_e( 'Show Thumbnails', 'beka' ); ?>
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( "show_cat" ) ); ?>">
                <input type="checkbox" class="checkbox"
                       id="<?php echo esc_attr( $this->get_field_id( "show_cat" ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( "show_cat" ) ); ?>"
                       value="1" <?php checked( 1, $show_cat, true ); ?> />
				<?php esc_html_e( 'Show Catogory', 'beka' ); ?>
            </label>
        </p>
		<?php
	}

} // Class beka_recent_posts ends here
