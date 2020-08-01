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

?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 10]><html class="no-js lt-ie9 ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <title>Web App Memo</title>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" >
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>

  <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/js/jquery-ui.min.js'; ?>">
  </script>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/sass/style.css'; ?>">
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
</head>
<body <?php body_class(); ?>>
  <?php
    wp_body_open();
  ?>
  <div class="wrapper">
    <section class="sidebar">
      <div class="logo">
        <!-- UPLOAD IMAGE --->
        <div class="title">
          <?php if ( is_front_page() ) : ?>
            <h1 class="title__name">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>"  class="title__anchor" rel="home">
                <?php bloginfo( 'name' ); ?>
              </a>
            </h1>
          <?php else : ?>
            <p class="title__name">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="title__anchor" rel="home">
                <?php bloginfo( 'name' ); ?>
              </a>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <menu>
        <ul>

        </ul>
      </menu>
    </section>
    <section class="container">
      <header class="header">
        <div class="header__category">
          <!-- This must pull through from CMS -->
          <h1 class="header__category-title">Courses</h1>
        </div>
        <div class="header__search">
          <?php
          // Check whether the header search is activated in the customizer.
          $enable_header_search = get_theme_mod( 'enable_header_search', true );
          if ( true === $enable_header_search ) {
          ?>
            <button class="search" aria-expanded="false">
              <span class="search__text"><?php _e( 'Search', 'Searching' ); ?></span>
            </button>
          <?php } ?>
        </div>
      </header>
