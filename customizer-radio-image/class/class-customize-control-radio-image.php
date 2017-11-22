<?php
/**
 * The radio image customize control extends the WP_Customize_Control class.  This class allows
 * developers to create a list of image radio inputs.
 *
 * Note, the `$choices` array is slightly different than normal and should be in the form of
 * `array(
 *  $value => array( 'url' => $image_url, 'label' => $text_label ),
 *  $value => array( 'url' => $image_url, 'label' => $text_label ),
 * )`
 *
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2015, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @package customizer-controls
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Radio image customize control.
 *
 * @since  1.1.24
 * @access public
 */
class Customize_Control_Radio_Image extends WP_Customize_Control {
	/**
	 * The type of customize control being rendered.
	 *
	 * @since 1.1.24
	 * @var   string
	 */
	public $type = 'radio-image';
	/**
	 * Displays the control content.
	 *
	 * @since  1.1.24
	 * @access public
	 * @return void
	 */
	public function render_content() {
		/* If no choices are provided, bail. */
		if ( empty( $this->choices ) ) {
			return;
		} ?>

		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>

		<div id="<?php echo esc_attr( "input_{$this->id}" ); ?>">

			<?php foreach ( $this->choices as $value => $args ) : ?>

				<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}" ); ?>" id="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> />

				<label for="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>">
					<?php if ( ! empty( $args['label'] ) ) { ?>
						<span class="screen-reader-text"><?php echo esc_html( $args['label'] ); ?></span>
						<?php
}
?>
					<img src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" 
											<?php
											if ( ! empty( $args['label'] ) ) {
												echo 'alt="' . esc_attr( $args['label'] ) . '"'; }
?>
	/>
				</label>

			<?php endforeach; ?>

		</div><!-- .image -->

		<script type="text/javascript">
			jQuery( document ).ready( function() {
				jQuery( '#<?php echo esc_attr( "input_{$this->id}" ); ?>' ).buttonset();
			} );
		</script>
	<?php
	}
	/**
	 * Loads the jQuery UI Button script and hooks our custom styles in.
	 *
	 * @since  1.1.24
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );
		add_action( 'customize_controls_print_styles', array( $this, 'print_styles' ) );
	}
	/**
	 * Outputs custom styles to give the selected image a visible border.
	 *
	 * @since  1.1.24
	 * @access public
	 * @return void
	 */
	public function print_styles() {
	?>

		<style type="text/css" id="hybrid-customize-radio-image-css">
			.customize-control-radio-image .ui-buttonset {
				text-align: center;
			}

			.customize-control-radio-image label {
				display: inline-block;
				max-width: 33.3%;
				padding: 3px;
				font-size: inherit;
				line-height: inherit;
				height: auto;
				cursor: pointer;
				border-width: 0;
				-webkit-appearance: none;
				-webkit-border-radius: 0;
				border-radius: 0;
				white-space: nowrap;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				color: inherit;
				background: none;
				-webkit-box-shadow: none;
				box-shadow: none;
				vertical-align: inherit;
			}

			.customize-control-radio-image label:first-of-type {
				float: left;
			}
			.customize-control-radio-image label:nth-of-type(n + 3){
				float: right;
			}

			.customize-control-radio-image label:hover {
				background: none;
				border-color: inherit;
				color: inherit;
			}

			.customize-control-radio-image label:active {
				background: none;
				border-color: inherit;
				-webkit-box-shadow: none;
				box-shadow: none;
				-webkit-transform: none;
				-ms-transform: none;
				transform: none;
			}

			.customize-control-radio-image img { border: 1px solid transparent; }
			.customize-control-radio-image .ui-state-active img {
				border-color: #5b9dd9;
				-webkit-box-shadow: 0 0 3px rgba(0,115,170,.8);
				box-shadow: 0 0 3px rgba(0,115,170,.8);
			}
		</style>
	<?php
	}
}
