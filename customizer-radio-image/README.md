# Customizer radio image 1.0.0
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)]() [![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)]()
### What is Customizer radio image ?

Customizer radio image is a nicer way to display a radio control in customizer

![alt text](http://res.cloudinary.com/vertigo-studio-srl/image/upload/v1508847878/select_oevdtd.gif)

### How to install?

To install Customizer radio image copy the folder in the root of your theme and add the following line in `functions.php` before you call your customizer.php file.

         require get_template_directory() . '/customizer-radio-image/class/class-customizer-control-radio-image.php';
         
That's all!

### How to use? (backend-part)

Here's an example of how to add this control, add the following code in your theme's customizer.php:

          if ( class_exists( 'Customizer_Control_Radio_Image' ) ) {
                  $wp_customize->add_setting(
                      'top_bar_alignment', array(
                          'default' => 'right',
                      )
                  );
          
                  $wp_customize->add_control(
                      new Customizer_Control_Radio_Image(
                          $wp_customize, 'top_bar_alignment', array(
                              'label' => esc_html__( 'Layout', 'your-textdomain' ),
                              'priority' => 99,
                              'section' => 'colors',
                              'choices' => array(
                                  'left' => array(
                                      'url' => trailingslashit( get_template_directory_uri() ) . '/customizer-radio-image/img/very-top-bar-layout-1.png',
                                      'label' => esc_html__( 'Left Sidebar', 'your-textdomain' ),
                                  ),
                                  'right' => array(
                                      'url' => trailingslashit( get_template_directory_uri() ) . '/customizer-radio-image/img/very-top-bar-layout-2.png',
                                      'label' => esc_html__( 'Right Sidebar', 'your-textdomain' ),
                                  ),
                              ),
                          )
                      )
                  );
              }

### How to use? (frontend-part)

To get the input from your control just call it in the normal way:

          $customizer_page_editor = get_theme_mod('top_bar_alignment');
          if( $customizer_page_editor === 'left' ){
            // Do something
          }
          if( $customizer_page_editor === 'right' ){
            // Do something
          }

### Contribute

You can make this better by contributing. If you find a bug or simply want to contribute to this collection, submit your pull request and we'll have a look on it.  

How can you help?
- Submit a bug
- Fix reported bugs
- Share with us another cool control

