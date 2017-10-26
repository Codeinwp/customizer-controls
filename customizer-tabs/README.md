# Customizer tabs
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://opensource.org/licenses/MIT) [![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)](https://twitter.com/intent/tweet?text=Check%20out%20this%20awesome%20customizer%20control%20from%20@Themeisle%20team!%20https://github.com/Codeinwp/customizer-controls/tree/master/customizer-tabs)  

Customizer tabs control comes from the need to better organize your controls in customizer. It's not really a control but it comes in handy when you have too many controls and you want to organize them better.

![Demo](http://res.cloudinary.com/vertigo-studio-srl/image/upload/v1509018763/GIF-4_s28vev.gif)
### Installation

Copy the folder in the root of your theme and add the following function in `functions.php` or `customizer.php`.
    
    function load_customize_classes( $wp_customize ) {  
        require get_template_directory() . '/customizer-tabs/class/class-customizer-tabs-control.php';
    }
    add_action( 'customize_register', 'load_customize_classes', 0 );
    
### How to use

Add the following function to your `customizer.php` or `functions.php` file. 

    function tabs_register( $wp_customize ) {
        $wp_customize->add_setting(
            'my_tabs', array(
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            new Customizer_Tabs_Control(
                $wp_customize, 'my_tabs', array(
                    /* Make sure you edit the following parameters*/
                    'section' => 'my_section',
                    'tabs'    => array(
                        'font_family' => array(
                            'nicename' => esc_html__( 'Tab1', 'your-textdomain' ),
                            'icon'     => 'font',
                            'controls' => array(
                                'hestia_headings_font',
                                'hestia_body_font',
                                'hestia_font_subsets',
                            ),
                        ),
                        'font_sizes'   => array(
                            'nicename' => esc_html__( 'Tab2', 'your-textdomain' ),
                            'icon'     => 'text-height',
                            'controls' => array(
                                'control_id_1',
                                'control_id_2',
                                'control_id_3',
                                'control_id_4',
                            ),
                        ),
                    ),
                )
            )
        );
    }
    add_action( 'customize_register', 'tabs_register' );
    
- `nicename` parameter is the text that appears on tab.
- `icon` parameter is the FontAwesome class without the `fa-` prefix  
    Note: In order to show the icon, make sure you enqueue FontAwesome in customizer.
- `controls` parameter is an array with all the controls ids that you want to show in that area.

 ### Contribute
 
 You can make this better by contributing. If you find a bug or simply want to contribute to this collection, submit your pull request and we'll have a look on it.  
 
 How can you help?
 - Submit a bug
 - Fix reported bugs
 - Share with us another cool control