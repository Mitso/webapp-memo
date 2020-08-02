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
    global $wp_query;
    $postid = $wp_query->post->ID;


    $args = array(
      'meta_key' => 'topics_status',
      'meta_value' => 'pending',
    );
    $the_query = new WP_Query($args);
  ?>

  <div class="filters">
    <ul class="filters-list">
      <li class="filters-list__item selected">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="filters__label selected">All</a>
      </li>

      <li class="filters-list__item selected">
        <?php
          if(get_post_meta($postid, 'topics_status', true)){
          ?>
            <a class="filters__label selected"
              href="<?php echo get_post_meta($postid, 'topics_status', true) ?>"
              title="Movie Website">
              <?php
                echo get_post_meta($postid, 'topics_status', true);
                wp_reset_query();
              ?>
            </a>
          <?php
          }
          ?>
      </li>
    </ul>
  </div>


  <div class="article-list">
    <?php if($the_query->have_posts()) : ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post();
        $customDurationField = get_post_meta($post->ID, 'topic_duration', true);
      ?>
      <div class="article-list__item">
        <span class="article__month"><?php the_time('M'); ?></span>
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
          <?php
            if(!empty(get_the_tags())) { ?>
              <h6 class="article__tag">
            <?php
                foreach( (get_the_tags($post->ID)) as $tag) { ?>
                  Level: <?php echo $tag->name; ?>
              <?php
            }?>
            </h6>
          <?php
            }
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
        <div class="article__excerpt">
          <?php the_excerpt(); ?>
        </div>
        <!-- ASSUME SHOWS UNDER ALL FILTER -->
        <div class="call-to-action">
          <button id="start_course_<?php echo $post->ID ?>" class="call-to-action__button">
            Start course
          </button>
        </div>
      </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <br/>  <br/>


  <!-- List articles by filter -->

    <div class="article-list">
      <?php while ( have_posts() ) :
        the_post();
        $customDurationField = get_post_meta($post->ID, 'topic_duration', true);
      ?>
      <div class="article-list__item">
        <span class="article__month"><?php the_time('M'); ?></span>
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
          <?php
            if(!empty(get_the_tags())) { ?>
              <h6 class="article__tag">
            <?php
                foreach( (get_the_tags($post->ID)) as $tag) { ?>
                  Level: <?php echo $tag->name; ?>
              <?php
            }?>
            </h6>
          <?php
            }
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
        <div class="article__excerpt">
          <?php the_excerpt(); ?>
        </div>
        <!-- ASSUME SHOWS UNDER ALL FILTER -->
        <div class="call-to-action">
          <button id="start_course_<?php echo $post->ID ?>" class="call-to-action__button">
            Start course
          </button>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>
