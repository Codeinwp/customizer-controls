# WYSIWYG
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://opensource.org/licenses/MIT) [![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)](https://twitter.com/intent/tweet?text=Check%20out%20this%20awesome%20customizer%20control%20from%20@Themeisle%20team!%20https://github.com/Codeinwp/customizer-controls/tree/master/customizer-page-editor)

### What is WYSIWYG Control?

WYSIWYG Control is a text editor directly in your customizer.

![alt text](http://res.cloudinary.com/vertigo-studio-srl/image/upload/v1508773898/wysiwyg_q2wutj.gif)

### How to install?

To install Customizer repeater copy the folder in the root of your theme and add the following line in `functions.php` before you call your customizer.php file.
    
    function load_customize_classes( $wp_customize ) {  
         require get_template_directory() . '/customizer-page-editor/customizer-page-editor.php';';
    }
    add_action( 'customize_register', 'load_customize_classes', 0 )
         

After you did this there's only one step left. Replace `your-textdomain` textdomain with yours.
That's all!

If you want to change its placement make sure you update files path in `functions.php` and `class/customizer-repeater-control.php` files. 

### How to use? (backend-part)

Here's an example of how to add this control, add the following code in your theme's `customizer.php`:

    function xxx_customize_register( $wp_customize ) {
        if (class_exists( 'Customizer_Page_Editor' ){
            $wp_customize->add_setting(
                'customizer_page_editor', array(
                    'sanitize_callback' => 'wp_kses_post',
                )
            );
          
            $wp_customize->add_control(
                new Customizer_Page_Editor(
                    $wp_customize, 'customizer_page_editor', array(
                        'label'                      => esc_html__( 'Editor', 'your-textdomain' ),
                        'section'                    => 'my_section',
                        'priority'                   => 30,
                    )
                )
            );
        }
    }
    add_action( 'customize_register', 'xxx_customize_register' );


WYSIWYG control also supports default input. If you want to add default input for your repeater here's how you do it:

         $wp_customize->add_setting(
             'customizer_page_editor', array(
                 'sanitize_callback' => 'wp_kses_post',
                 'default' => __( 'Your content here', 'your-textdomain'),
             )
         );


### How to use? (frontend-part)

To get the input from your control just call it in the normal way:

      $customizer_page_editor = get_theme_mod('customizer_page_editor', __( 'Your content here', 'your-textdomain') );
      echo wp_kses_post( $customizer_page_editor );

### Contribute

You can make this better by contributing. If you find a bug or simply want to contribute to this collection, submit your pull request and we'll have a look on it.  

How can you help?
- Submit a bug
- Fix reported bugs
- Share with us another cool control

