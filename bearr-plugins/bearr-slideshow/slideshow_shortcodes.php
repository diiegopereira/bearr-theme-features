<?php
/**
 * Shortcodes
 *
 *
 * @package bearr
 */

/*-----------------------------------------------------------------------------------*/
/*	Slide Item
/*-----------------------------------------------------------------------------------*/
function bearr_slide($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '',
		"textalign" => '',
	), $atts));

	global $post;

	$args = array(
		'post_type' => 'slider',
		'posts_per_page' => 1,
		'p' => $id
	);

	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) :
	while ($my_query->have_posts()) : $my_query->the_post();

	//enqueue css
	wp_enqueue_style( 'bearr-custom-slider-css', plugin_dir_url( __FILE__ ) . 'css/bearr_slideshow.css' );
	
	//Get Meta fields
	$slide_title = wp_kses_post( rwmb_meta( 'bearr_slide_title' ) );	
	$slide_text = wp_kses_post( rwmb_meta( 'bearr_slide_text' ) );
	$slide_link_text = esc_html( rwmb_meta( 'bearr_slide_link_text') );
	$slide_link = esc_url( rwmb_meta( 'bearr_slide_link') );

	$slide_picture_url = '';
	$slide_pictures = rwmb_meta( 'bearr_slide_image', 'size=full_hd' );
	foreach ( $slide_pictures as $slide_picture ) {
	   $slide_picture_url = esc_url( $slide_picture['url'] );
	}


	$slide_video_mp4 = esc_url( rwmb_meta( 'bearr_slide_video_mp4') );
	$slide_video_webm = esc_url( rwmb_meta( 'bearr_slide_video_webm') );
	$slide_video_ogv = esc_url( rwmb_meta( 'bearr_slide_video_ogv') );

	$slide_extra = rwmb_meta( 'bearr_slide_extra');

	$slide_textalign = esc_attr( rwmb_meta( 'bearr_slide_text_align') );

	$slide_overlay = '';

	$slide_overlay = esc_attr( rwmb_meta( 'bearr_slide_overlay') );

	

	$retour ='';
	
	$retour .='<div class="featured-slide slide bg-cover ' .$slide_overlay .' viewport" style="background-image: url(' .$slide_picture_url .');">';
		
		//Slide Video
		if ( !empty($slide_video_mp4) || !empty($slide_video_webm) || !empty($slide_video_ogv) ) {
			$retour .='<div class="slide-videobg">';
				$retour .='<video class="slide-video" preload="preload" autoplay="autoplay" loop="loop">';
					if ( !empty($slide_video_webm) ) {
						//webm
						$retour .='<source src="'.$slide_video_webm .'" type="video/webm"></source>';
					}
					if ( !empty($slide_video_mp4) ) {
						//webm
						$retour .='<source src="'.$slide_video_mp4 .'" type="video/mp4"></source>';
					}
					if ( !empty($slide_video_ogv) ) {
						//webm
						$retour .='<source src="'.$slide_video_ogv .'" type="video/ogv"></source>';
					}		
				$retour .='</video>';
			$retour .='</div>';
		}

		//Slide Content
		$retour .='<div class="container">';
			$retour .='<div class="slide-inner" style="text-align: '.$slide_textalign .'">';

				$retour .='<div class="slide-icon"></div>';
				if ( !empty($slide_title) ) {
					$retour .='<h1 class="slide-title">'.$slide_title .'</h1>' ;
				}
				if ( !empty($slide_text) ) {
					$retour .='<p class="slide-text">'.$slide_text.'</p>';
				}
				
				if (!empty($slide_link) && !empty($slide_link_text)) {
					$retour .='<a class="primary-btn light-color" href="'.$slide_link .'"><span>' .$slide_link_text .'</span></a>';
				}

				if ( !empty($slide_extra) ) {
					$retour .='<div class="slide-extra">'.do_shortcode( $slide_extra ).'</div>';
				}

			$retour .='</div>';
		$retour .='</div>';
	$retour .='</div>';

	endwhile; else:
	$retour ='';
	$retour .= "nothing found.";
	endif;

	//Reset Query
    wp_reset_query();
	
	return $retour;
}

add_shortcode("bearr-slide", "bearr_slide");
/*-----------------------------------------------------------------------------------*/
/*	Bearr Slider
/*-----------------------------------------------------------------------------------*/
function bearr_slider_scripts() { 
	//Deenqueue files
	wp_dequeue_style( 'owl-theme' );
	wp_dequeue_style( 'owl-carousel' );

	//Enqueue Files
	wp_enqueue_style( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'js/vendor/owl.carousel/assets/owl.carousel.css', array(), '9.9' );
	wp_enqueue_style( 'owl-theme', plugin_dir_url( __FILE__ ) . 'js/vendor/owl.carousel/assets/owl.theme.default.min.css',  array(), '9.9'  );
	wp_enqueue_script( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'js/vendor/owl.carousel/owl.carousel.min.js', array('jquery'), '20151215', true );
	if ( file_exists( get_template_directory() . '/framework/js/custom/custom-slider.js' ) ) {
		wp_enqueue_script( 'bearr-custom-slider-js', get_template_directory_uri() . '/framework/js/custom/custom-slider.js', array('jquery'), '20151215', true );
	}
	else {
		wp_enqueue_script( 'bearr-custom-slider-js', plugin_dir_url( __FILE__ ) . 'js/custom-slider.js', array('jquery'), '20151215', true );
	}
	//King Composer
	if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ){
	  add_action( 'admin_enqueue_scripts', 'bearr_slideshow_admin_js' );
	}
}

add_action( 'wp_enqueue_scripts', 'bearr_slider_scripts', 999 );

function bearr_slider($atts, $content = null) {
	extract(shortcode_atts(array(
		"ids" => '',
		"heightstyle" => '',
	), $atts));

	$slider_ids = explode(",", $ids);
	if ( $heightstyle == '1' ) {
		$slider_height = 'sliderviewport';
	} 
	else {
		$slider_height = '';
	}
	

	//Output
	$output = '';
	$output .= '<div class="main-carousel-wrapper '.$slider_height .'"><div class="owl-carousel main-carousel owl-theme">';
	foreach ($slider_ids as $slide_id) {
		$output .= do_shortcode("[bearr-slide id=".$slide_id."]");
	}
	$output .= '</div></div>';

	return $output;
}

add_shortcode("bearr-slider", "bearr_slider");