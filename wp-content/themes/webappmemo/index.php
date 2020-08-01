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
<?php get_header(); ?>
<div class="content">
  <div class="article">
    <div class="content-list">
      <?php
        if ( have_posts() ) {
          $i = 0;
          while ( have_posts() ) {

            the_post();
            ?>
              <div class="item">
              <h2 class="article__title"><?php the_title(); ?></h2>
              <h4 class="article__subtitle">Posted on <?php the_time('F jS, Y') ?></h4>

              <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
                <div class="article__thumbnail">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
                  </a>
                </div>
              <?php endif; ?>
              <p class="article__body">
                <?php the_excerpt(__('(more...)')); ?>
              </p>
              <div>
            <?php
          }
        } else { ?>
          <p class="article__error"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
      <?php } ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
