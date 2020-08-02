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
  <?php
    global $post;
  ?>

  <div class="filters">
    <ul class="filters-list">
      <li class="filters-list__item selected">
        <p class="filters__label selected">All</p>
      </li>
    </ul>
  </div>

  <!-- List articles by filter -->
  <?php while ( have_posts() ) :
    the_post();
    $customDurationField = get_post_meta($post->ID, 'topic_duration', true);
  ?>
  <p><?php echo $customStatucMeta; ?></p>

  <div class="article-list">

      <div class="article-list__item">
        <h3 class="article__title"><?php the_title(); ?></h3>
        <h5 class="article__cat">
          <?php foreach( (get_the_category($post->ID)) as $category) { ?>
            <!--<a href="<?php/* echo get_category_link($category);*/?>"></a>-->
            <?php
              if($category->category_parent !== 0 ) {
                echo $category->cat_name;
              }
            ?>
          <?php } ?>
        </h5>
        <div class="article_extra">
          <h6 class="article__tag">Level:
            <span class="article__tag-value"><?php foreach( (get_the_tags($post->ID)) as $tag) { ?>
              <!--<a href="<?php/* echo get_category_link($category);*/?>"></a>-->
              <?php echo $tag->name; ?>
            <?php } ?></span>
          </h6>

          <?php
            if($customDurationField !== '') {
              ?>
              <h6 class="article__duration">Duration: <?php echo $customDurationField; ?></h6>
          <?php
            }
          ?>
        </div>

        <p class="article__subtitle"><?php the_time('F jS, Y') ?></p>
        <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
          <div class="article__thumbnail">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail(); ?>
            </a>
          </div>
        <?php endif; ?>
        <p class="article__body">
          <?php the_excerpt(__('(more...)')); ?>
        </p>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
