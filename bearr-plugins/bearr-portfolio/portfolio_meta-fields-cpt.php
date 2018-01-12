<?php
/**
 * Meta Boxes Configurations
 *
 *
 * @package bearr
 */


add_filter( 'rwmb_meta_boxes', 'bearr_portfolio_meta_boxes' );
function bearr_portfolio_meta_boxes( $meta_boxes ) {
	$prefix = 'bearr_';	

	/*portfolio*/
    $meta_boxes[] = array(
        'title'      => __( 'Project Details', 'bearr' ),
        'post_types' => 'portfolio',
        'fields'     => array(
            array(
                'id'   => $prefix. 'portfolio_subtitle',
                'name' => __( 'Project Subtitle', 'bearr' ),
                'type' => 'text',
            ),
            array(
                'id'   => $prefix. 'portfolio_hero',
                'name' => __( 'Main Image', 'bearr' ),
                'type' => 'image_upload',
                'max_file_uploads' => 1,
            ),            
            array(
                'id'   => $prefix. 'portfolio_client',
                'name' => __( 'Client', 'bearr' ),
                'type' => 'text',
            ),
            array(
                'id'   => $prefix. 'portfolio_url',
                'name' => __( 'Project URL', 'bearr' ),
                'type' => 'url',
            ), 
            array(
                'id'   => $prefix. 'portfolio_gallery',
                'name' => __( 'Project Gallery', 'bearr' ),
                'type' => 'image_upload',
            ),
        ),
    );

    return $meta_boxes;
}


$bearr_setup_portfolio_templates = get_option( 'bearr_setup_portfolio_template' );
if ( $bearr_setup_portfolio_templates == 'true') {
   add_filter( 'rwmb_meta_boxes', 'bearr_portfolio_template_meta_boxes' );
}

function bearr_portfolio_template_meta_boxes( $meta_boxes ) {
    $prefix = 'bearr_'; 

    /*portfolio*/
    $meta_boxes[] = array(
        'title'      => __( 'Project: Details Page', 'bearr' ),
        'post_types' => 'portfolio',
        'fields'     => array(
            array(
               'id'   => $prefix. 'portfolio_page_template',
                'name' => __( 'Page Template', 'bearr' ),
                'type' => 'radio',
                'std'   => 'main',
                'inline' => false,
                'options' => array(
                    'main' => __( 'Main Template', 'bearr' ),
                    'builder' => __( 'Blank Template: Use page builder to build a custom page', 'bearr' ),
                ),
            ),
        ),
    );

    return $meta_boxes;
}