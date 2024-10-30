<?php if ( ! defined( 'LONELY_STICKY' ) ) die( 'Forbidden' );

if ( ! function_exists( 'lonely_sticky_get_num' ) ) :

	/**
	 * Get the maximum number of sticky posts that should be present at once.
	 *
	 * @since 1.1.0
	 * @return integer
	 */
	function lonely_sticky_get_num() {
		$num = get_option( 'lonely_sticky_num' );

		if ( $num === false ) {
			$num = 1;
		}

		return absint( $num );
	}

endif;

if ( ! function_exists( 'lonely_sticky_maybe_stick_posts' ) ) :

	/**
	 * Return a list of post IDs of the latest sticky posts ordered by their date.
	 *
	 * @since 1.1.0
	 * @param integer $num How many post IDs to return.
	 * @return array
	 */
	function lonely_sticky_maybe_stick_posts( $num ) {
		$num = absint( $num );
		$sticky_posts = get_option( 'sticky_posts' );

		$posts = get_posts( array(
			'post__in' => $sticky_posts
		) );

		$posts = array_slice( $posts, 0, $num );
		return wp_list_pluck( $posts, 'ID' );
	}

endif;

if ( ! function_exists( 'sync_lonely_sticky_num' ) ) :

	/**
	 * Whenever the number of concurrent sticky posts option is changed, update
	 * the sticky posts status.
	 *
	 * @since 1.1.0
	 */
	function sync_lonely_sticky_num() {
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			return;
		}

		$first_use = get_option( 'lonely_sticky_num' ) === false;
		$sticky_posts = get_option( 'sticky_posts' );
		$sticky_posts_count = count( $sticky_posts );

		if ( $first_use && $sticky_posts_count > 1 ) {
			update_option( 'lonely_sticky_num', $sticky_posts_count );
		}

		$value = lonely_sticky_get_num();

		if ( $value === 0 ) {
			$sticky_posts = array();
			update_option( 'sticky_posts', $sticky_posts );
		}
		elseif ( count( $sticky_posts ) > $value ) {
			$sticky_posts = lonely_sticky_maybe_stick_posts( $value );
			update_option( 'sticky_posts', $sticky_posts );
		}
	}

	add_action( 'admin_init', 'sync_lonely_sticky_num' );

endif;

if ( ! function_exists( 'lonely_sticky' ) ) :

	/**
	 * When saving a post that has been flagged as sticky, automatically unstick
	 * other posts.
	 *
	 * @since 1.0
	 * @param integer $post_id The ID of the post being saved.
	 */
	function lonely_sticky( $post_id ) {
		if ( 'post' !== get_post_type( $post_id ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_others_posts' ) ) {
			return;
		}

		$post_data = $_POST;
		$is_inline_edit = check_ajax_referer( 'inlineeditnonce', '_inline_edit', false );

		if ( $is_inline_edit || ( isset( $post_data['visibility'] ) && $post_data['visibility'] === 'public' ) ) {
			if ( isset( $post_data['sticky'] ) && $post_data['sticky'] === 'sticky' ) {
				$num = lonely_sticky_get_num();
				$sticky_posts = array();

				switch ( $num ) {
					case 0:
						break;
					case 1:
						$sticky_posts[] = $post_id;
						break;
					default:
						$currently_sticked_posts = get_option( 'sticky_posts' );

						if ( count( $currently_sticked_posts ) < $num ) {
							$sticky_posts = $currently_sticked_posts;
						}
						else {
							$sticky_posts = lonely_sticky_maybe_stick_posts( $num-1 );
						}

						$sticky_posts[] = $post_id;

						break;
				}

				update_option( 'sticky_posts', $sticky_posts );
			}
		}
	}

	add_action( 'save_post', 'lonely_sticky' );

endif;
