# Customizer tabs

Customizer tabs control comes from the need to better organize your controls in customizer. It's not really a control but it comes in handy when you have too many controls.

### Installation

Copy the folder in the root of your theme and add the following function in `functions.php` or `customizer.php`.
    
    function load_customize_classes( $wp_customize ) {  
        require get_template_directory() . '/customizer-tabs/class/class-customizer-tabs-control.php';
    }
    add_action( 'customize_register', 'load_customize_classes', 0 );
    
 