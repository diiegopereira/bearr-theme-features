<?php
/**
 * Visual Composer - Extend
 *
 *
 * @package bearr
 */

if(!function_exists('is_plugin_active')){
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ){
  add_action('init', 'bearr_blogroll_kingc_map_init', 99 );
}



function bearr_blogroll_kingc_map_init(){

   global $kc;


/*-----------------------------------------------------------------------------------*/
/* BLogroll Carousel
/*-----------------------------------------------------------------------------------*/
$blog_categories = get_terms( array('taxonomy' => 'category', 'fields' => 'id=>name', 'hide_empty' => false, ) );

$blog_posttypes = get_post_types();

$kc->add_map( 
   array(
      'bearr-blogroll' => array(
         'name' => 'Blogroll Carousel',
         'description' => 'Carousel showing recent posts.',
         'category' => 'Built by ThemeBear',
         'admin_view' => 'bearr_kingc_blogroll',
         'icon' => 'bkci-blogroll',           
         'params' => array(
            array(
              'name' => 'postsperpage',
              'label' => 'Number of posts',
              'type' => 'number_slider',             
              'options' => array(    // REQUIRED
                  'min' => 1,
                  'max' => 24,
                  'unit' => '',
                  'show_input' => true
              ),
              'value' => '9',
              'description' => 'Number of posts to be displayed.',
            ), 
            array(
              'name' => 'display',
              'label' => 'Display',
              'type' => 'radio',  // USAGE RADIO TYPE
              'options' => array(    // REQUIRED
                'default' => 'All Blog Posts',
                'custom_cat' => 'Posts from Specific Category',
                'custom_posttype' => 'Posts from a Custom Post Type',
                //'custom_taxonomy' => 'Posts from a Custom Taxonomy',
              ),             
              'value' => 'default', // remove this if you do not need a default content 
              'description' => 'Select what you want to show on the blogroll.',
            ), 
            array(
              'name' => 'category',
              'label' => 'Category',
              'type' => 'dropdown',             
              'options' => $blog_categories,
              'description' => 'Select the category you want to show.',
              'relation' => array(
                  'parent'    => 'display',
                  'show_when' => 'custom_cat',
              )
            ),
            array(
              'name' => 'posttype',
              'label' => 'Post Type',
              'type' => 'dropdown',             
              'options' => $blog_posttypes,
              'description' => 'Select the post type you want to show.',
              'relation' => array(
                  'parent'    => 'display',
                  'show_when' => 'custom_posttype',
              )
            ),         
         )
      )
   )
);


} //end of function



