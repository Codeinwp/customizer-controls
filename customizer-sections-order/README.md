# Customizer sections order
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://opensource.org/licenses/MIT) [![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)](https://twitter.com/intent/tweet?text=Check%20out%20this%20awesome%20customizer%20control%20from%20@Themeisle%20team!%20https://github.com/Codeinwp/customizer-controls/tree/master/customizer-sections-order)  

Customizer sections order allow you to change sections order on your frontpage or wherever you want to use it.

![demo](http://res.cloudinary.com/vertigo-studio-srl/image/upload/v1508933897/GIF-1_kmjg8l.gif)  

### Installation and setup
This control it's a little bit trickier to configure. Here's what you'll need to do:
#### Step 1
First of all, copy the folder in the root of your theme and add the following function in `functions.php` or `customizer.php`.
    
    function load_customize_classes( $wp_customize ) {  
        require get_template_directory() . '/customizer-repeater/functions.php';
    }
    add_action( 'customize_register', 'load_customize_classes', 0 );
    
 
#### Step 2
Create a customizer hidden control to store data from sections order. It's already there in `sections_order_register_control` function, you'll just need to edit it's name and section. If you edit its name, make sure you change it in `sections_order_section_priority` and `sections_order_refresh_positions` functions too.
                                                                                                                                                                                                                                          

#### Step 3  
There are three things that we need to specify in order to make this control work 
##### 1.Sections Container  
We need to specify where the sections order will be.  
If you have a panel named 'frontpage_sections' where you store all the sections then your section container will be:  
`#accordion-panel-frontpage_sections > ul, #sub-accordion-panel-frontpage_sections`  
Add this string in `customizer-sections-order.php` in `sections_order_script` function at `sections_container` key.

##### 2.Blocked items
Let's say we have a slider section at the beginning of our site and we don't want it to move. If we registered that section like this: `$wp_customize->add_section( 'mytheme_top_slider' , array( ... ) )`, then our blocked item will be `#accordion-section-mytheme_top_slider` . If there are more sections you want to block just add them in the same string separated by a coma `#accordion-section-mytheme_top_slider, #accordion-section-my_other_bocked_section`.  
Add this string in `customizer-sections-order.php` in `sections_order_script` function at `blocked_items` key.

##### 3.Input for saved data
In step 2 we've created a customizer control named `sections_order` to store in it the order of sections. Because of that, our saved data input will be `#customize-control-sections_order input`.  
Add this string in `customizer-sections-order.php` in `sections_order_script` function at `saved_data_input` key.


#### Step 4
In your theme files where you've declared the sections in that panel, make sure you add `section_priority` filter on priority attribute. Here's an example:

    $wp_customize->add_section(
        'hestia_features', array(
            'title'    => esc_html__( 'Features', 'hestia-pro' ),
            'panel'    => 'hestia_frontpage_sections',
            'priority' => apply_filters( 'section_priority', 10, 'hestia_features' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
        )
    );

#### Step 5
Replace panel name and theme prefix in `css/customizer-sections-order-style.css`.

We're done with the setup! I know it's a little bit tricky but it's worth it!

### How to use it
Now, you can get your sections order by doing this:
    
    $orders = get_theme_mod( 'sections_order' );
    
If you display this it will show you an array with your sections and priorities. What we're doing is to have a function that displays each section and add it to an action based on its priority. Then just call do_action and the sections are displaying in desired order.


### Contribute

You can make this better by contributing. If you find a bug or simply want to contribute to this collection, submit your pull request and we'll have a look on it.  

How can you help?
- Submit a bug
- Fix reported bugs
- Share with us another cool control