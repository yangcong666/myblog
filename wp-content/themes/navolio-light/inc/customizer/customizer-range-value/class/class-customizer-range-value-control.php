<?php
/**
 * The range value customize control extends the WP_Customize_Control class.
 *
 * @package Navolio Light
 * @since Navolio Light 1.0
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2016, Soderlind
 * @link       https://github.com/soderlind/class-customizer-range-value-control/blob/master/README.md
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Customizer_Range_Value_Control
 *
 * @since 1.0
 * @modified 1.0
 * @access public
 */
class Navolio_Light_Customizer_Range_Value_Control extends WP_Customize_Control {

	/**
	 * Control type
	 *
	 * @var string
	 */
	public $type = 'range-value';

	/**
	 * Flag that enables media queries
	 *
	 * @var bool
	 */
	public $media_query = false;

	/**
	 * Settings for range inputs.
	 *
	 * @var array|mixed
	 */
	public $input_attr = array();

	/**
	 * Add/remove from fixed value flag
	 *
	 * @var bool
	 */
	public $sum_type = false;

	/**
	 * Navolio_Light_Customizer_Range_Value_Control constructor.
	 *
	 * @param WP_Customize_Manager $manager Customize manager.
	 * @param string               $id Control id.
	 * @param array                $args Control arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		if ( ! empty( $args['media_query'] ) ) {
			$this->media_query = (bool) $args['media_query'];
		}

		if ( ! empty( $args['input_attr'] ) ) {
			$this->input_attr = $args['input_attr'];
		}

		if ( ! empty( $args['sum_type'] ) ) {
			$this->sum_type = $args['sum_type'];
		}
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 1.0
	 * @modified 1.1.38
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'customizer-range-value-control', get_template_directory_uri() . '/inc/customizer/customizer-range-value/js/customizer-range-value-control.js', array( 'jquery', 'customize-base' ), '1.0', true );
		wp_enqueue_style( 'customizer-range-value-control', get_template_directory_uri() . '/inc/customizer/customizer-range-value/css/customizer-range-value-control.css', array(), '1.0' );
	}

	/**
	 * Handles input value.
	 *
	 * @scustomizere 1.1.38
	 * @return array
	 */
	public function json() {
		$json = parent::json();

		$json['value'] = $this->value();

		$json['default_value'] = ! empty( $this->setting->default ) ? $this->setting->default : '0';

		$json['desktop_value'] = ! $this->is_json( $json['value'] ) ? $json['value'] : $json['default_value'];

		if ( $this->is_json( $json['value'] ) ) {
			$decoded_value         = json_decode( $json['value'], true );
			$json['desktop_value'] = $decoded_value['desktop'];
		} else {
			$json['desktop_value'] = $json['value'];
		}
		$json['sum_type']    = $this->sum_type;
		$json['media_query'] = $this->media_query;
		$json['link']        = $this->get_link();
		if ( ! $this->contains_array( $this->input_attr ) ) {
			$json['min']  = ! empty( $this->input_attr['min'] ) ? $this->input_attr['min'] : 0;
			$json['max']  = ! empty( $this->input_attr['max'] ) ? $this->input_attr['max'] : 1;
			$json['step'] = ! empty( $this->input_attr['step'] ) ? $this->input_attr['step'] : 1;
		} else {
			foreach ( $this->input_attr as $device => $value ) {
				$json[ $device ] = $value;
			}
		}

		return $json;
	}

	/**
	 * Check if an array contains another array.
	 *
	 * @since 1.1.53
	 * @param array $array Array to check.
	 */
	private function contains_array( $array ) {
		foreach ( $array as $value ) {
			if ( is_array( $value ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if a string is in json format
	 *
	 * @param  string $string Input.
	 *
	 * @since 1.0
	 * @access public
	 * @return bool
	 */
	public function is_json( $string ) {
		return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
	}

	/**
	 * Render the control's content.
	 *
	 * @since 1.0
	 * @modified 1.0
	 * @access public
	 */
	protected function content_template() {
	?>
		<# if ( data.label ) { #>
			<span class="customize-control-title">
				<span>{{{ data.label }}}</span>
				<# if ( data.description ) { #>
					<i class="dashicons dashicons-editor-help" style="vertical-align: text-bottom;" title="{{{ data.description }}}"></i>
				<# } #>
			</span>
			<# if ( data.media_query ) { #>
				<ul class="responsive-switchers">
					<li class="desktop">
						<button type="button" class="preview-desktop active" data-device="desktop">
							<i class="dashicons dashicons-desktop"></i>
						</button>
					</li>
				</ul>
			<# } #>
		<# }
		var min, max, step, default_value;
		if( data.min ){
			min = data.min;
		}
		if( data.max ){
			max = data.max;
		}
		if( data.step ){
			step = data.step;
		}
		if( data.default_value ){
			default_value = data.default_value;
		}
		if( data.desktop ){
			if ( data.desktop.min ){
				min = data.desktop.min;
			}
			if ( data.desktop.max ){
				max = data.desktop.max;
			}
			if ( data.desktop.step ){
				step = data.desktop.step;
			}
			if ( data.desktop.default_value ){
				default_value = data.desktop.default_value;
			}
		}
		if( data.desktop_value ){
			value = data.desktop_value;
		} else {
			if( default_value ) {
				value = default_value;
			}
		}
		if( data.sum_type === true ){
			input_type = 'text';
		} else {
			input_type = 'number';
		}
		#>
		<div class="range-slider <# if ( data.media_query ) { #>has-media-queries<# }#>">
			<div class="desktop-range active">
				<input type="range" class="range-slider__range" title="{{{data.label}}}" min="{{min}}" max="{{max}}" step="{{step}}" data-query="desktop" data-default="{{default_value}}" value="{{ value }}">
				<input type="{{input_type}}" class="range-slider-value" title="{{{data.label}}}" min="{{min}}" max="{{max}}" step="{{step}}" value="<# if( data.sum_type === true && value >= 0 ){ #> +<# } #>{{ value }}">
				<span class="range-reset-slider"><span class="dashicons dashicons-image-rotate"></span></span>
			</div>
			<input type="hidden" class="range-collector" title="{{{data.label}}}" value="{{ data.value }}" {{{ data.link }}} >
		</div>
		<?php
	}
}

/**
 * Sanitize values for range inputs.
 *
 * @param string $input Control input.
 * @since 1.0
 */
function navolio_light_sanitize_range_value( $input ) {
	if ( navolio_light_is_json( $input ) ) {
		$range_value            = json_decode( $input, true );
		$range_value['desktop'] = ! empty( $range_value['desktop'] ) || $range_value['desktop'] === '0' ? floatval( $range_value['desktop'] ) : '';
		return json_encode( $range_value );
	}
	return floatval( $input );
}
