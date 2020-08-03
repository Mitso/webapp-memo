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
      <?php
      $args = array(
        'exclude' => array(1),
        'option_all' => 'All',
        'meta_query' => array (
          array (
            'key' => 'topics_status',
            'value' => array('','pending','current','complete'),
            'compare' => 'IN'
          )
        )
      );
      $the_query = new WP_Query($args);
        ?>
        <li class="filters-list__item">
          
          <a class="filters__label" href="<?php echo esc_url( home_url( '/' ) )?>">All</a>
        </li>
      <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="FormDribble">
      <?php if($the_query->have_posts()) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
          <li class="filters-list__item">
            <?php
              $statuses = get_post_meta($post->ID, 'topics_status', false);
              /*
              If $term is empty
              */
              //echo '<a href="'.esc_url( home_url( '/' ) );.'" class="filters__label selected">All</a>'
              if( count( $statuses ) != 0) {
              // if categories exist, display the dropdown
                foreach ( array_unique( $statuses )  as $term ) :
                  echo '
                  <input id="id_' . $term . '" type="checkbox"  class="list__input" name="postfilter" value="' . $term . '"/>
                  ';
            ?>
                  <label for="<?php echo 'id_' . $term . ''?>" class="filters__label">
                    <?php
                     echo $term;
                     wp_reset_query();?>
                  </label>
            <?php
                endforeach;
              }
            ?>
          </li>
        <?php endwhile; ?>
      <?php endif; ?>
      <input type="hidden" name="action" value="myfilter"/>
      <input id="submit" type="submit"/>
    </form>
    </ul>
  </div>
  <div id="response" class="article-list">
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
      </div>
    <?php endwhile; ?>
  </div>

</div>
<?php get_footer(); ?>
