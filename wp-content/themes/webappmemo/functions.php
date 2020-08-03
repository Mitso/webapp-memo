<?php
/**
 * Header file for the Web App Memo WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Web App Memo
 * @since Web App Memo 1.0
 */
	add_action('wp_ajax_nopriv_filter_function', 'filter_function');
 add_action('wp_ajax_filter_function', 'filter_function'); // wp_ajax_{ACTION HERE}


 function filter_function(){
  // $args = array(
 	//  'orderby' => 'date', // we will sort posts by date
 	//  'order'	=> $_POST['date'] // ASC or DESC
  // );

	$meta_query = array('relation' => 'AND');
 	if( isset( $_POST['postfilter'] ) && $_POST['postfilter'] == 'on' )
		$args['meta_query'] = array( 'relation'=>'AND' );

 		$args['meta_query'][] = array(
			'key' => 'topics_status',
			'value' =>  $_POST['postfilter'],
			'compare' => 'LIKE'
 		);

 	$query = new WP_Query( $args );
 	if( $query->have_posts() ) :
 		while( $query->have_posts() ): $query->the_post();
 			echo '
			 	<h3 class="article__title">'. $query->post->post_title. '</h3>
			';
 		endwhile;
 		wp_reset_postdata();
 	else :
 		echo '<p class="article__error">No posts found</p>';
 	endif;

 	die();
 }


function webapp_js_scripts() {
	wp_enqueue_script(
		'ajax', // name your script so that you can attach other scripts and de-register, etc.
		get_template_directory_uri() . '/assets/js/main.js', // this is the location of your script file
		array('jquery'), // this array lists the scripts upon which your script depends
	);

	wp_localize_script('ajax','wp_ajax',
		array('ajax_url' => admin_url('admin-ajax.php'))
	);
}
add_action( 'wp_enqueue_scripts', 'webapp_js_scripts' );

function webapp_theme_support() {
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	 add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
}

add_action( 'after_setup_theme', 'webapp_theme_support' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 *
 * @return string $html
 */
function webapp_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'webapp_get_custom_logo' );
/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function webapp_custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'webapp_custom_excerpt_length', 999 );


/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function webapp_excerpt_more( $more ) {
  if ( ! is_single() ) {
    $more = sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
      get_permalink( get_the_ID() ),
      __( 'Read More', 'textdomain' )
    );
  }

  return $more;
}
add_filter( 'excerpt_more', 'webapp_excerpt_more' );


/**
*
*
*/
if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
