<!--
<?php
/*
  if ( have_posts() ) {
    $i = 0;
    while ( have_posts() ) {

      the_post();
      */?>
        <div class="item">
        <h2 class="article__title"><?php/* the_title(); */?></h2>
        <h4 class="article__subtitle">Posted on <?php/* the_time('F jS, Y') */?></h4>

        <?php/* if ( '' !== get_the_post_thumbnail() && ! is_single() ) : */?>
          <div class="article__thumbnail">
            <a href="<?php/* the_permalink(); */?>">
              <?php/* the_post_thumbnail( 'twentyseventeen-featured-image' ); */?>
            </a>
          </div>
        <?php/* endif; */?>
        <p class="article__body">
          <?php/* the_excerpt(__('(more...)')); */?>
        </p>
        <div>
      <?php/*
    }
  } else { */?>
    <p class="article__error"><?php/* _e('Sorry, no posts matched your criteria.'); */?></p>
<?php/* } */?>
-->

<div class="filters">
  <ul class="filters-list">
      <form action="<?php echo admin_url('admin-ajax.php')?>" method="POST" id="filter">
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
              foreach ( $statuses as $term ) :
                echo '
                <label>
                <input type="checkbox" name="postfilter" value="id_' . $term . '"/>
                </label>';
              endforeach;
          ?>
              <?php
              foreach(array_unique( $statuses ) as $status) {
              ?>
                <p class="filters__label selected">
                  <?php

                   echo $status;
                   wp_reset_query();?>
                </p>
          <?php
              }
            }
          ?>


        </li>
      <?php endwhile; ?>
    <?php endif; ?>
    <input type="hidden" name="action" value="myfilter">

  </form>
  </ul>
</div>




<!-- List articles by filter -->
  <div class="article-list">
    <?php /*
      while ( have_posts() ) :
      the_post();*/
    ?>
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
</div>
