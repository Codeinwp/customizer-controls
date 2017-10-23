<?php
/**
 * Sync functions for control.
 */

define( 'CUSTOMIZER_PAGE_EDITOR_VERSION', '1.1.0' );

/**
 * Require class file
 */
require get_template_directory() . '/customizer-page-editor/class/class-customizer-page-editor.php';

/**
 * Display editor for page editor control.
 */
function customizer_editor() {
	?>
	<div id="wp-editor-widget-container" style="display: none;">
		<a class="close" href="javascript:WPEditorWidget.hideEditor();"><span class="icon"></span></a>
		<div class="editor">
			<?php
			$settings = array(
				'textarea_rows' => 55,
				'editor_height' => 260,
			);
			wp_editor( '', 'wpeditorwidget', $settings );
			?>
			<p><a href="javascript:WPEditorWidget.updateWidgetAndCloseEditor(true);" class="button button-primary"><?php _e( 'Save and close', 'your-textdomain' ); ?></a></p>
		</div>
	</div>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'customizer_editor', 1 );

/**
 * Hestia allow all HTML tags in TinyMce editor.
 *
 * @param array $init_array TinyMce settings.
 *
 * @return array
 */
function customizer_editor_override_mce_options( $init_array ) {
	$opts = '*[*]';
	$init_array['valid_elements'] = $opts;
	$init_array['extended_valid_elements'] = $opts;
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'customizer_editor_override_mce_options' );
