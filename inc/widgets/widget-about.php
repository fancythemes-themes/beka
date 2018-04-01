<?php

class Beka_Widget_About extends WP_Widget {

	function __construct() {
		parent::__construct( 'beka_about_widget', esc_html__( '(Beka) About Widget', 'beka' ), array(
			'description' => esc_html__( 'A widget to show author description and image', 'beka' ),
		) );
	}

	public function widget( $args, $instance ) {
		$title              = apply_filters( 'widget_title', $instance['title'] );
		$author_description = $instance['author_description'];
		$author_image       = $instance['author_image'];
		$fb_url             = $instance['fb_url'];
		$twtr_url           = $instance['twtr_url'];
		$gp_url             = $instance['gp_url'];
		$inst_url           = $instance['inst_url'];

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
        <div class="about-widget">
			<?php
			if ( ! empty( $author_image ) ) :
				echo '<img src="' . esc_url( $author_image ) . '" width="262" height="274">';
			endif;

			if ( ! empty( $author_description ) ) :
				echo esc_html( $author_description );
			endif; ?>
            <div class="author-social">
                <?php if ( ! empty( $fb_url ) ) :
                    ?><span class="author-facebook"><a href="<?php echo esc_url( $fb_url ); ?>"><i class="fa fa-facebook"></i></a></span><?php
                endif;

                if ( ! empty( $twtr_url ) ) :
                    ?><span class="author-twitter"><a href="<?php echo esc_url( $twtr_url ); ?>"><i class="fa fa-twitter"></i></a></span><?php
                endif;

                if ( ! empty( $gp_url ) ) :
                    ?><span class="author-googleplus"><a href="<?php echo esc_url( $gp_url ); ?>"><i class="fa fa-google"></i></a></span><?php
                endif;

                if ( ! empty( $inst_url ) ) :
                    ?><span class="author-instagram"><a href="<?php echo esc_url( $inst_url ); ?>"><i class="fa fa-instagram"></i></a></span><?php
                endif; ?>
            </div>
        </div>
		<?php

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance                       = $old_instance;
		$instance['title']              = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['author_description'] = ( ! empty( $new_instance['author_description'] ) ) ? wp_strip_all_tags( $new_instance['author_description'] ) : '';
		$instance['author_image']       = ( ! empty( $new_instance['author_image'] ) ) ? esc_url_raw( $new_instance['author_image'] ) : '';
		$instance['fb_url']             = ( ! empty( $new_instance['fb_url'] ) ) ? esc_url_raw( $new_instance['fb_url'] ) : '';
		$instance['twtr_url']           = ( ! empty( $new_instance['twtr_url'] ) ) ? esc_url_raw( $new_instance['twtr_url'] ) : '';
		$instance['gp_url']             = ( ! empty( $new_instance['gp_url'] ) ) ? esc_url_raw( $new_instance['gp_url'] ) : '';
		$instance['inst_url']           = ( ! empty( $new_instance['inst_url'] ) ) ? esc_url_raw( $new_instance['inst_url'] ) : '';

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {

		}
		$defaults = array(
			'title'              => esc_html__( 'About', 'beka' ),
			'author_description' => '',
			'author_image'       => '',
			'fb_url'             => '',
			'twtr_url'           => '',
			'gp_url'             => '',
			'inst_url'           => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'beka' ); ?></label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   value="<?php echo esc_attr( esc_html( $instance['title'] ) ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'author_image' ) ); ?>"><?php esc_html_e( 'Author Image URL:', 'beka' ); ?></label>
            <input type="url" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'author_image' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'author_image' ) ); ?>"
                   value="<?php echo esc_url( $instance['author_image'] ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'author_description' ) ); ?>"><?php esc_html_e( 'Author Description:', 'beka' ) ?></label>
            <textarea class="widefat" cols="20" rows="10"
                      id="<?php echo esc_attr( $this->get_field_id( 'author_description' ) ); ?>"
                      name="<?php echo esc_attr( $this->get_field_name( 'author_description' ) ); ?>"
            ><?php echo esc_html( $instance['author_description'] ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>"><?php esc_html_e( 'Facebook URL:', 'beka' ); ?></label>
            <input type="url" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'fb_url' ) ); ?>"
                   value="<?php echo esc_url( $instance['fb_url'] ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twtr_url' ) ); ?>"><?php esc_html_e( 'Twitter URL:', 'beka' ); ?></label>
            <input type="url" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'twtr_url' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'twtr_url' ) ); ?>"
                   value="<?php echo esc_url( $instance['twtr_url'] ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'gp_url' ) ); ?>"><?php esc_html_e( 'Google Plus URL:', 'beka' ); ?></label>
            <input type="url" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'gp_url' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'gp_url' ) ); ?>"
                   value="<?php echo esc_url( $instance['gp_url'] ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'inst_url' ) ); ?>"><?php esc_html_e( 'Instagram URL:', 'beka' ); ?></label>
            <input type="url" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'inst_url' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'inst_url' ) ); ?>"
                   value="<?php echo esc_url( $instance['inst_url'] ); ?>"/>
        </p>
		<?php
	}

} // Class beka_about_widget ends here
