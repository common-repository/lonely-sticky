<div class="wrap ev-plugin-settings_w">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<div class="ev-plugin-content_w">
		<form action="options.php" method="post">
			<?php
				settings_fields( $this->get_id() );

				do_settings_sections( $this->get_id() );

				submit_button( __( 'Save Settings', 'lonely-sticky' ) );
			?>
		</form>
	</div>
	<div class="ev-plugin-side_w">
		<h3><?php esc_html_e( 'Premium WordPress themes & plugins', 'lonely-sticky' ) ?></h3>
		<p><?php echo wp_kses_post( __( 'We are <strong>Evolve</strong> and we offer solutions for your projects with WordPress.<br>Come and meet us... we have <em>cookies</em> (good ones!)', 'lonely-sticky' ) ); ?></p>
		<?php printf( '<a href="%s" class="button button-primary" target="_blank">%s</a>', esc_attr( 'https://justevolve.it' ), esc_html__( 'Visit our website!', 'lonely-sticky' ) ); ?>
		<hr>
		<?php
			printf( '<a href="%s" target="_blank"><img src="%s" width="92" height="35" class="ev-plugin-madeby" /></a>',
				esc_attr( 'https://justevolve.it' ),
				esc_attr( LONELY_STICKY_URI . 'assets/img/made_by_logo.png' ) )
		?>
	</div>
</div>
