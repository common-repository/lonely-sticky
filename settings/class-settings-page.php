<?php if ( ! defined( 'LONELY_STICKY' ) ) die( 'Forbidden' );

/**
 * Settings page class.
 *
 * @since 1.0.0
 */
class LonelySticky_Settings_Page {

	/**
	 * The capability required to manage the settings page.
	 *
	 * @var string
	 */
	private $_id = '';

	/**
	 * The capability required to manage the settings page.
	 *
	 * @var string
	 */
	private $_capability = 'manage_options';

	/**
	 * Settings sections array.
	 *
	 * @var array
	 */
	private $_sections = array();

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 * @param string $id The page ID.
	 * @param array $args The page creation arguments.
	 */
	public function __construct( $id, $args = array() ) {
		$this->_id = sanitize_text_field( $id );

		if ( isset( $args[ 'capability' ] ) ) {
			$this->_capability = sanitize_text_field( $args[ 'capability' ] );
		}

		if ( isset( $args[ 'sections' ] ) ) {
			$this->_sections = $args[ 'sections' ];

			add_action( 'admin_init', array( $this, 'build_settings' ) );
		}

		add_action( 'admin_menu', array( $this, 'create' ) );
	}

	/**
	 * Get the page ID.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_id() {
		return $this->_id;
	}

	/**
	 * Get the page capability.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_capability() {
		return $this->_capability;
	}

	/**
	 * Recursively sanitize array data (both key and value).
	 *
	 * @since 1.0.0
	 * @param array $arr The array to be sanitized.
	 * @return array
	 */
	public function sanitize_array( $arr ) {
		$sanitized_array = array();

		foreach ( $arr as $k => $v ) {
			$sanitized_array[ sanitize_text_field( $k ) ] = sanitize_text_field( $v );
		}

		return $sanitized_array;
	}

	/**
	 * Build the settings from their configuration array.
	 *
	 * @since 1.0.0
	 */
	public function build_settings() {
		foreach ( $this->_sections as $section_id => $section ) {
			add_settings_section(
				$section_id,
				$section[ 'label' ],
				isset( $section[ 'callback' ] ) && is_callable( $section[ 'callback' ] ) ? $section[ 'callback' ] : '__return_false',
				$this->get_id()
			);

			foreach ( $section[ 'fields' ] as $field_id => $field ) {
				$raw_value = get_option( $field_id );
				$default_sanitization_method = 'sanitize_text_field';

				if ( is_array( $raw_value ) ) {
					$default_sanitization_method = array( $this, 'sanitize_array' );
				}

				register_setting(
					$this->get_id(),
					$field_id,
					isset( $field[ 'sanitize' ] ) && is_callable( $field[ 'sanitize' ] ) ? $field[ 'sanitize' ] : $default_sanitization_method
				);

				$field_args         = $field;
				$field_args[ 'id' ] = $field_id;

				add_settings_field(
					$field_id,
					$field[ 'label' ],
					array( $this, 'display_field' ),
					$this->get_id(),
					$section_id,
					$field_args
				);
			}
		}
	}

	/**
	 * Create the settings page.
	 *
	 * @since 1.0.0
	 */
	public function create() {
		add_options_page( 'Lonely Sticky', 'Lonely Sticky', $this->get_capability(), $this->get_id(), array( $this, 'display' ) );
	}

	/**
	 * Display the settings page.
	 *
	 * @since 1.0.0
	 */
	public function display() {
		if ( ! current_user_can( $this->_capability ) ) {
			return;
		}

		$settings_page_template = trailingslashit( dirname( __FILE__ ) ) . 'templates/settings-page.php';

		require_once apply_filters( 'lonely_sticky_settings_page_template', $settings_page_template );
	}

	/**
	 * Display a single setting field.
	 *
	 * @since 1.0.0
	 * @param array $args Field arguments.
	 */
	public function display_field( $args ) {
		$value = call_user_func( $args[ 'sanitize' ], get_option( $args[ 'id' ] ) );

		require trailingslashit( dirname( __FILE__ ) ) . 'templates/setting-field-' . esc_attr( $args[ 'type' ] ) . '.php';
	}

}
