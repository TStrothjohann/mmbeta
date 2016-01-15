<?php
/**
 * Template part for displaying single Preisträger.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<article id="preistraeger-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="m-t m-b row">
    <div class="col-lg-3">
      <?php if (has_post_thumbnail()) : ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
        <?php $caption = get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
        <figure class="figure">
          <img src="<?php echo $image[0] ?>" alt="<?php echo $caption ?>" class="img-responsive figure-img">
          <figcaption class="figure-caption"><?php echo $caption ?></figcaption>
        </figure>
      <?php endif; ?>
    </div>
    <div class="col-lg-8">
    <?php if ( ! post_password_required() ) { ?>
        <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
        <h6 class="text-muted"><?php the_field( "position" ); ?></h6>
        <div class="lead"><strong>Kategorie:</strong> <?php mmbeta_die_preiskatekorie(); ?>, <strong>Platz: </strong><?php the_field('platz'); ?> </div>
        <div class="m-t"><?php the_field( "begruendung" ); ?></div>
    <?php  } else {
        the_excerpt();
      };
    
    ?>
    </div>
  </div><!-- .entry-content -->

</article><!-- #post-## -->