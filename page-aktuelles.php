<?php
/**
 * The template for displaying the Aktuelles-Page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php $query = new WP_Query( array( 'category_name' => 'aktuelles' ) ); ?>
      <?php if ( $query->have_posts() ) : ?>
      <div class="">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        
        <article class="row">
          <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
          <?php $caption = get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
          <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            <a class="img-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <figure class="figure col-sm-3">
                <img src="<?php echo $image[0] ?>" alt="<?php echo $caption ?>" class="img-responsive figure-img">
                <figcaption class="figure-caption"><?php echo $caption ?></figcaption>
              </figure>
            </a>
            <div class="col-sm-9">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <h2><?php the_title(); ?></h2>
              </a>
              <div class="lead"><?php the_excerpt(); ?></div>
            </div>
          </div>
        </article> 


        <?php endwhile; // End of the loop. ?>
      </div>
      <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->
<?php get_footer(); ?>