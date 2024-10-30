<?php

printf(
	'<textarea class="large-text" name="%s" rows="%s">%s</textarea>',
	esc_attr( $args[ 'id' ] ),
	esc_attr( isset( $args[ 'rows' ] ) ? absint( $args[ 'rows' ] ) : 5 ),
	esc_html( $value )
);

if ( isset( $args[ 'help' ] ) ) {
	$help = (array) $args[ 'help' ];

	foreach ( $help as $h ) {
		printf(
			'<p class="description">%s</p>',
			wp_kses_post( $h )
		);
	}
}
