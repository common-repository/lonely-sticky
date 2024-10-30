<?php

printf(
	'%s<input class="small-text" name="%s" type="number" min="0" value="%s">%s',
	isset( $args[ 'before' ] ) ? wp_kses_post( $args[ 'before' ] ) . ' ' : '',
	esc_attr( $args[ 'id' ] ),
	esc_attr( $value ),
	isset( $args[ 'after' ] ) ? ' ' . wp_kses_post( $args[ 'after' ] ) : ''
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