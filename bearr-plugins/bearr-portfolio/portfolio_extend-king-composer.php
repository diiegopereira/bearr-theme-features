<?php
/**
 * King Composer - Extend
 *
 *
 * @package bearr
 */

if(!function_exists('is_plugin_active')){
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ){
  add_action('init', 'bearr_portfolio_kingc_map_init', 99 );
}

function bearr_portfolio_kingc_map_init(){

   global $kc;

/*-----------------------------------------------------------------------------------*/
/* portfolio Carousel
/*-----------------------------------------------------------------------------------*/

$portfolio_taxonomies = get_terms( array('taxonomy' => 'portfoliocategory', 'fields' => 'id=>name', 'hide_empty' => false, ) );


$kc->add_map( 
   array(
      'bearr-portfolio' => array(
         'name' => 'Portfolio Grid',
         'description' => 'Displays your Portfolio Projects',
         'category' => 'Built by ThemeBear',
         'admin_view' => 'bearr_kingc_portfolio',
         'icon' => 'bkci-portfolio',             
         'params' => array(
            array(
              'name' => 'postsperpage',
              'label' => 'Number of projects',
              'type' => 'number_slider',             
              'options' => array(    // REQUIRED
                  'min' => 1,
                  'max' => 60,
                  'unit' => '',
                  'show_input' => true
              ),
              'value' => '9',
              'description' => 'Number of projects to be displayed.',
            ),
            array(
              'name' => 'type',
              'label' => 'Display Specific Portfolio Category',
              'type' => 'toggle',
              'description' => 'Turn on to display only one category.',
            ),
             array(
              'name' => 'taxonomy',
              'label' => 'Portfolio Category',
              'type' => 'dropdown',             
              'options' => $portfolio_taxonomies,
              'description' => 'Select the category you want to show.',
              'relation' => array(
                  'parent'    => 'type',
                  'show_when' => 'yes',
              )
            ),
            array(
              'name' => 'showfilter',
              'label' => 'Show filter?',
              'type' => 'dropdown',             
              'options' => array(            
                  "yes" => "Yes",  
                  "no" => "No",       
               ),
              'description' => 'Select what happens when the user clicks on any item in the portfolio.',
              'relation' => array(
                  'parent'    => 'type',
                  'hide_when' => 'yes',
              )
            ),
            array(
              'name' => 'style',
              'label' => 'Grid Style',
              'type' => 'dropdown',             
              'options' => array(            
                  "masonry" => "Masonry",  
                  "box" => "Boxes",          
               ),
              'description' => 'Select the style of the projects grid.',
            ),
            array(
              'name' => 'margin',
              'label' => 'Use item margin?',
              'type' => 'dropdown',             
              'options' => array(            
                  "yes" => "Yes",  
                  "no" => "No",       
               ),
              'description' => 'Select if you want a space between itens.',
            ),
            array(
              'name' => 'columns',
              'label' => 'Number of Columns',
              'type' => 'dropdown',             
              'options' => array(            
                  "2" => "Two Columns",  
                  "3" => "Three Columns",   
                  "4" => "Four Columns",        
               ),
              'description' => 'Select the number of columns per row.',
            ),
            array(
              'name' => 'linkto',
              'label' => 'Link to',
              'type' => 'dropdown',             
              'options' => array(            
                  "image" => "Featured Image with Lightbox",  
                  "project" => "Project Details Page",       
               ),
              'description' => 'Select what happens when the user clicks on any item in the portfolio.',
            ),
            

         )
      )
   )
);

} //end of function