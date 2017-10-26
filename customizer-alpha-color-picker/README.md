# Alpha Color Picker #
[![Travis](https://img.shields.io/badge/license-GPL-green.svg)](https://www.gnu.org/licenses/gpl-3.0.en.html) [![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)](https://twitter.com/intent/tweet?text=Check%20out%20this%20awesome%20customizer%20control%20from%20@Themeisle%20team!%20https://github.com/Codeinwp/customizer-controls/tree/master/customizer-alpha-color-picker)  

Ever wanted to pick an RGBa color using the WordPress color picker in the Customizer? Now you can with this drop-in replacement for the stock WP color picker control.

Here's what it looks like:

![WordPress Alpha Color Picker](http://res.cloudinary.com/vertigo-studio-srl/image/upload/v1508841053/alpha-color-picker_mk2pom.gif)

A jQuery plugin version of this alpha color picker that can be used in the admin outside of the Customizer can be found [here](https://github.com/BraadMartin/components/tree/master/alpha-color-picker).

### How to install

To install Customizer repeater copy the folder in the root of your theme and add the following code in `functions.php` or in `customizer.php` file.

    function load_customize_classes( $wp_customize ) {  
        require get_template_directory() . '/customizer-repeater/functions.php';
    }
    add_action( 'customize_register', 'load_customize_classes', 0 );
         

That's all!

### How to use

Drop this in your theme or plugin's customizer.php file:

```php
function xxx_customize_register( $wp_customize ) {

    if( class_exists('Customize_Alpha_Color_Control'){
        // Alpha Color Picker setting.
        $wp_customize->add_setting(
            'alpha_color_setting',
            array(
                'default'     => 'rgba(209,0,55,0.7)',
                'type'        => 'theme_mod',
                'capability'  => 'edit_theme_options',
                'transport'   => 'postMessage'
            )
        );
    
        // Alpha Color Picker control.
        $wp_customize->add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'alpha_color_control',
                array(
                    'label'         => __( 'Alpha Color Picker', 'yourtextdomain' ),
                    'section'       => 'colors',
                    'settings'      => 'alpha_color_setting',
                    'show_opacity'  => true, // Optional.
                    'palette'	=> array(
                        'rgb(150, 50, 220)', // RGB, RGBa, and hex values supported
                        'rgba(50,50,50,0.8)',
                        'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
                        '#00CC99' // Mix of color types = no problem
                    )
                )
            )
        );
    }
}
add_action( 'customize_register', 'xxx_customize_register' );
```

### More Information ###

More detailed usage information [here](http://braadmartin.com/alpha-color-picker-control-for-the-wordpress-customizer/).

Feedback and pull requests are encouraged!

### Contribute

You can make this better by contributing. If you find a bug or simply want to contribute to this collection, submit your pull request and we'll have a look on it.  

How can you help?
- Submit a bug
- Fix reported bugs
- Share with us another cool control