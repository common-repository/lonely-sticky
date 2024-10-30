<?php

printf(
	'%s<select name="%s">',
	isset( $args[ 'before' ] ) ? wp_kses_post( $args[ 'before' ] ) . ' ' : '',
	esc_attr( $args[ 'id' ] )
);

foreach ( $args[ 'options' ] as $option_key => $option_value ) {
	if ( is_array( $option_value ) ) {
		printf(
			'<optgroup label="%s">',
			esc_attr( $option_value[ 'label' ] )
		);

		foreach ( $option_value[ 'options' ] as $v => $l ) {
			printf(
				'<option value="%s"%s>%s</option>',
				esc_attr( $v ),
				esc_attr( $value == $v ? ' selected' : '' ),
				esc_html( $l )
			);
		}

		echo '</optgroup>';
	}
	else {
		printf(
			'<option value="%s"%s>%s</option>',
			esc_attr( $option_key ),
			esc_attr( $value == $option_key ? ' selected' : '' ),
			esc_html( $option_value )
		);
	}
}

printf(
	'</select>%s',
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
