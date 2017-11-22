# Customizer Repeater
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://opensource.org/licenses/MIT) [![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)](https://twitter.com/intent/tweet?text=Check%20out%20this%20awesome%20customizer%20control%20from%20@Themeisle%20team!%20https://github.com/Codeinwp/customizer-controls/tree/master/customizer-repeater)
### What is Customizer Repeater?

Customizer Repeater is a custom control for the WordPress Theme Customizer. It's designed to be super user-friendly not only for your customers but for you too.

![alt text](http://res.cloudinary.com/vertigo-studio-srl/image/upload/v1508771236/repeater_my0koa.gif)

### How to install?

To install Customizer repeater copy the folder in the root of your theme and add the following line in `functions.php` before you call your customizer.php file.
    
    
    require get_template_directory() . '/customizer-repeater/functions.php';
    
    
After you did this there's only one step left. Replace `'your-textdomain'` textdomain with yours.
That's all!

If you want to change its placement make sure you update files path in `functions.php` and `class/customizer-repeater-control.php` files. 

### How to use? (backend-part)

There are twelve types of fields that you can add in a box: 
- `customizer_repeater_image_control`
- `customizer_repeater_icon_control`
- `customizer_repeater_title_control`
- `customizer_repeater_subtitle_control`
- `customizer_repeater_text_control`
- `customizer_repeater_text2_control`
- `customizer_repeater_link_control`
- `customizer_repeater_link2_control`
- `customizer_repeater_shortcode_control`
- `customizer_repeater_repeater_control`
- `customizer_repeater_color_control`
- `customizer_repeater_color2_control`

To choose what your repeater will look, just enable fields in your control's oprions. Here's an example, add the following code in your theme's customizer.php:
    
    function xxx_customize_register( $wp_customize ) {
          if (class_exists( 'Customizer_Repeater' ) ){
              $wp_customize->add_setting( 'customizer_repeater_example', array(
                 'sanitize_callback' => 'customizer_repeater_sanitize'
              ));
              $wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'customizer_repeater_example', array(
                'label'   => esc_html__('Example','customizer-repeater'),
                'section' => 'my_section',
                'priority' => 1,
                'customizer_repeater_image_control' => true,
                'customizer_repeater_icon_control' => true,
                'customizer_repeater_title_control' => true,
                'customizer_repeater_subtitle_control' => true,
                'customizer_repeater_text_control' => true,
                'customizer_repeater_text2_control' => true,
                'customizer_repeater_link_control' => true,
                'customizer_repeater_link2_control' => true,
                'customizer_repeater_shortcode_control' => true,
                'customizer_repeater_repeater_control' => true,
                'customizer_repeater_color_control' => true,
                'customizer_repeater_color2_control' => true,
              ) ) );
          }
    }
    add_action( 'customize_register', 'xxx_customize_register' );
    
Customizer Repeater also supports default input. If you want to add default input for your repeater here's how you do it:

         $wp_customize->add_setting( 'customizer_repeater_example', array(
             'sanitize_callback' => 'customizer_repeater_sanitize',
             'default' => json_encode( array(
                /*Repeater's first item*/
                array("image_url" => get_template_directory_uri().'/images/companies/1.png' ,"link" => "#"), //every item in default string should have an unique id, it helps for translation
                /*Repeater's second item*/
                array("image_url" => get_template_directory_uri().'/images/companies/1.png' ,"link" => "#"),
                /*Repeater's third item*/
                array("image_url" => get_template_directory_uri().'/images/companies/1.png' ,"link" => "#"),
                ) )
         ) );


### How to use? (frontend-part)

To get the input from your control just call it in the normal way:

          $customizer_repeater_example = get_theme_mod('customizer_repeater_example', json_encode( array(/*The content from your default parameter or delete this argument if you don't want a default*/)) );
          /*This returns a json so we have to decode it*/
          $customizer_repeater_example_decoded = json_decode($customizer_repeater_example);
          foreach($customizer_repeater_example_decoded as $repeater_item){
              echo $repeater_item->icon_value;
              echo $repeater_item->text;
              echo $repeater_item->text2;
              echo $repeater_item->link;
              echo $repeater_item->link2;
              echo $repeater_item->image_url;
              echo $repeater_item->choice;
              echo $repeater_item->title;
              echo $repeater_item->subtitle;
              echo $repeater_item->shortcode;
              echo $repeater_item->color;
              echo $repeater_item->color2;
              /*Social repeater is also a repeater so we need to decode it*/
              $social_repeater = json_decode($repeater_item->social_repeater);
              foreach($social_repeater as $social_repeater){
                   echo $social_repeater->link;
                   echo $social_repeater->icon;
              }
          }
### Filters

In some cases you may want to rename labels for inputs. Let's say you use this control to display a testimonial section.
It's pretty confusing for the user to see "Title" instead of "Member name" or something else. Or in some cases you need a
textarea instead of a simple imput. Here's what you need to do:

          /**
           * Filter to modify input type in repeater control
           * You can filter by control id and input name.
           *
           * @param string $string Input label.
           * @param string $id Input id.
           * @param string $control Control name.
           * @modified 1.1.41
           *
           * @return string
           */
          function repeater_input_types( $string, $id, $control ) {
          	if ( $id === 'testimonials_content' ) { // here is the id of the control you want to change
          		if ( $control === 'customizer_repeater_subtitle_control' ) { //Here is the input you want to change
          			return 'textarea';
          		}
          	}
          	return $string;
          }
          add_filter( 'customizer_repeater_input_types_filter','repeater_input_types', 10 , 3 );
 
 
         **
          * Filter to modify input label in repeater control
          * You can filter by control id and input name.
          *
          * @param string $string Input label.
          * @param string $id Input id.
          * @param string $control Control name.
          * @modified 1.1.41
          *
          * @return string
          */
         function repeater_labels( $string, $id, $control ) {
         	if ( $id === 'testimonials_content' ) {
         		if ( $control === 'customizer_repeater_text_control' ) {
         			return esc_html__( 'Button Text','your-textdomain' );
         		}
            }
            return $string;
         }
         add_filter( 'repeater_input_labels_filter','repeater_labels', 10 , 3 );

### Contribute

Customizer Repeater is not perfect but it works! Do you want to make it better? Feel free to fork this and make changes on development branch.

### Contributors
Special thanks for making this awesome go to [@abaicus](https://github.com/abaicus).
