<div class="author-info-container">
    <div class="author-box clearfix">
        <div class="author-box-avtar">
			<?php echo get_avatar( get_the_author_meta( 'email' ), '81' ); ?>
        </div>
        <div class="author-info">
            <div class="author-head">
                <h5><?php printf(
						esc_html__( '%s (Author)', 'beka' ),
						get_the_author_meta( 'display_name' )
					); ?></h5>
                <div class="author-social">
					<?php
					$facebook = get_the_author_meta( 'facebook' );
					if ( ! empty( $facebook ) ) : ?>
                        <span class="author-fb"><a class="fa fa-facebook"
                                                   href="<?php echo esc_url( $facebook ); ?>"></a></span>
					<?php endif;

					$twitter = get_the_author_meta( 'twitter' );
					if ( ! empty( $twitter ) ) : ?>
                        <span class="author-twitter"><a class="fa fa-twitter"
                                                        href="<?php echo esc_url( $twitter ); ?>"></a></span>
					<?php endif;

					$google = get_the_author_meta( 'googleplus' );
					if ( ! empty( $google ) ) : ?>
                        <span class="author-gp"><a class="fa fa-google-plus"
                                                   href="<?php echo esc_url( $google ); ?>"></a></span>
					<?php endif;

					$linkedin = get_the_author_meta( 'linkedin' );
					if ( ! empty( $linkedin ) ) : ?>
                        <span class="author-linkedin"><a class="fa fa-linkedin"
                                                         href="<?php echo esc_url( $linkedin ); ?>"></a></span>
					<?php endif;

					$pinterest = get_the_author_meta( 'pinterest' );
					if ( ! empty( $pinterest ) ) : ?>
                        <span class="author-pinterest"><a class="fa fa-pinterest"
                                                          href="<?php echo esc_url( $pinterest ); ?>"></a></span>
					<?php endif;

					$dribbble = get_the_author_meta( 'dribbble' );
					if ( ! empty( $dribbble ) ) : ?>
                        <span class="author-dribbble"><a class="fa fa-dribbble"
                                                         href="<?php echo esc_url( $dribbble ); ?>"></a></span>
					<?php endif; ?>
                </div>
            </div>
            <p><?php the_author_meta( 'description' ) ?></p>
        </div>
    </div>
</div>