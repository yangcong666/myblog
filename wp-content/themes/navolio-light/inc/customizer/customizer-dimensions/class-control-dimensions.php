<?php
/**
 * Customizer Control: navolio-light-dimensions.
 *
 * @package     Navolio Light WordPress theme
 * @subpackage  Customizer Controls
 * @see   		https://github.com/aristath/kirki
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Buttonset control
 */
class Navolio_Light_Customizer_Dimensions_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'navolio-light-dimensions';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {

		wp_enqueue_script( 'navolio-light-dimensions', get_theme_file_uri( '/inc/customizer/customizer-dimensions/dimensions.js' ), array( 'jquery', 'customize-base' ), false, true );

		wp_localize_script( 'navolio-light-dimensions', 'novoliolightwpL10n', $this->l10n() );
		wp_enqueue_style( 'navolio-light-dimensions', get_theme_file_uri( '/inc/customizer/customizer-dimensions/dimensions.css' ), null );
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 *
	 * @see WP_Customize_Control::render()
	 */
	protected function render() {
		$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
		$class = 'customize-control has-switchers customize-control-' . $this->type;

		?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
			<?php $this->render_content(); ?>
		</li><?php
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['id'] 		= $this->id;
		$this->json['l10n']    	= $this->l10n();
		$this->json['title'] 	= esc_html__( 'Link values together', 'navolio-light' );

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

		$this->json['desktop'] = array();
	    $this->json['tablet']  = array();
	    $this->json['mobile']  = array();

	    foreach ( $this->settings as $setting_key => $setting ) {

	    	list( $_key ) = explode( '_', $setting_key );

	        $this->json[ $_key ][ $setting_key ] = array(
	            'id'        => $setting->id,
	            'link'      => $this->get_link( $setting_key ),
	            'value'     => $this->value( $setting_key ),
	        );
	    }

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<# if ( data.label ) { #>
			<span class="customize-control-title">
				<span>{{{ data.label }}}</span>

				<ul class="responsive-switchers">
					<li class="desktop">
						<button type="button" class="preview-desktop active" data-device="desktop">
							<i class="dashicons dashicons-desktop"></i>
						</button>
					</li>
					<li class="tablet">
						<button type="button" class="preview-tablet" data-device="tablet">
							<i class="dashicons dashicons-tablet"></i>
						</button>
					</li>
					<li class="mobile">
						<button type="button" class="preview-mobile" data-device="mobile">
							<i class="dashicons dashicons-smartphone"></i>
						</button>
					</li>
				</ul>

			</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul class="desktop control-wrap active">
	        <# _.each( data.desktop, function( args, key ) { #>
	            <li class="dimension-wrap {{ key }}">
	                <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
	                <span class="dimension-label">{{ data.l10n[ key ] }}</span>
	            </li>
	        <# } ); #>

	        <li class="dimension-wrap">
	            <div class="link-dimensions">
	                <span class="dashicons dashicons-admin-links navolio-light-linked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
	                <span class="dashicons dashicons-editor-unlink navolio-light-unlinked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
	            </div>
	        </li>
	    </ul>

	    <ul class="tablet control-wrap">
	        <# _.each( data.tablet, function( args, key ) { #>
	            <li class="dimension-wrap {{ key }}">
	                <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
	                <span class="dimension-label">{{ data.l10n[ key ] }}</span>
	            </li>
	        <# } ); #>

	        <li class="dimension-wrap">
	            <div class="link-dimensions">
	                <span class="dashicons dashicons-admin-links navolio-light-linked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
	                <span class="dashicons dashicons-editor-unlink navolio-light-unlinked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
	            </div>
	        </li>
	    </ul>

	    <ul class="mobile control-wrap">
	        <# _.each( data.mobile, function( args, key ) { #>
	            <li class="dimension-wrap {{ key }}">
	                <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
	                <span class="dimension-label">{{ data.l10n[ key ] }}</span>
	            </li>
	        <# } ); #>

	        <li class="dimension-wrap">
	            <div class="link-dimensions">
	                <span class="dashicons dashicons-admin-links navolio-light-linked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
	                <span class="dashicons dashicons-editor-unlink navolio-light-unlinked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
	            </div>
	        </li>
	    </ul>

		<?php
	}

	/**
	 * Returns an array of translation strings.
	 *
	 * @access protected
	 * @param string|false $id The string-ID.
	 * @return string
	 */
	protected function l10n( $id = false ) {
		$translation_strings = array(
			'desktop_top' 		=> esc_attr__( 'Top', 'navolio-light' ),
			'desktop_right' 	=> esc_attr__( 'Right', 'navolio-light' ),
			'desktop_bottom' 	=> esc_attr__( 'Bottom', 'navolio-light' ),
			'desktop_left' 		=> esc_attr__( 'Left', 'navolio-light' ),
			'tablet_top' 		=> esc_attr__( 'Top', 'navolio-light' ),
			'tablet_right' 		=> esc_attr__( 'Right', 'navolio-light' ),
			'tablet_bottom' 	=> esc_attr__( 'Bottom', 'navolio-light' ),
			'tablet_left' 		=> esc_attr__( 'Left', 'navolio-light' ),
			'mobile_top' 		=> esc_attr__( 'Top', 'navolio-light' ),
			'mobile_right' 		=> esc_attr__( 'Right', 'navolio-light' ),
			'mobile_bottom' 	=> esc_attr__( 'Bottom', 'navolio-light' ),
			'mobile_left' 		=> esc_attr__( 'Left', 'navolio-light' ),
		);
		if ( false === $id ) {
			return $translation_strings;
		}
		return $translation_strings[ $id ];
	}
}
