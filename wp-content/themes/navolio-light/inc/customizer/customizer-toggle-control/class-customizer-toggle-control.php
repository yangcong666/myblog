<?php
/**
 * Toggle Control
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}
class Navolio_Light_Toggle_Control extends WP_Customize_Control {
	public $type = 'ios';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 1.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'navolio-light-customizer-toggle-control', get_theme_file_uri( '/inc/customizer/customizer-toggle-control/js/customizer-toggle-control.js' ), array( 'jquery' ), rand(), true );
		wp_enqueue_style( 'navolio-light-pure-css-toggle-buttons', get_theme_file_uri( '/inc/customizer/customizer-toggle-control/css/pure-css-togle-buttons.css' ), array(), rand() );

		$css = '
			.disabled-control-title {
				color: #a0a5aa;
			}
			input[type=checkbox].tgl-light:checked + .tgl-btn {
				background: #0085ba;
			}
			input[type=checkbox].tgl-light + .tgl-btn {
			  background: #a0a5aa;
			}
			input[type=checkbox].tgl-light + .tgl-btn:after {
			  background: #f7f7f7;
			}

			input[type=checkbox].tgl-ios:checked + .tgl-btn {
			  background: #0085ba;
			}

			input[type=checkbox].tgl-flat:checked + .tgl-btn {
			  border: 4px solid #0085ba;
			}
			input[type=checkbox].tgl-flat:checked + .tgl-btn:after {
			  background: #0085ba;
			}

		';
		wp_add_inline_style( 'navolio-light-pure-css-toggle-buttons' , $css );
	}

	/**
	 * Render the control's content.
	 * 
	 * @version 1.0
	 */
	public function render_content() { ?>
		<label>
			<div class="toggle-render-element">
				<span class="customize-control-title toggle-element-title"><?php echo esc_html( $this->label ); ?></span>
				<input id="cb<?php echo esc_attr($this->instance_number); ?>" type="checkbox" class="tgl tgl-<?php echo esc_attr($this->type); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
				<label for="cb<?php echo esc_attr($this->instance_number); ?>" class="tgl-btn"></label>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
			<?php endif; ?>
		</label>
	<?php }
}
