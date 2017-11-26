<?php
/**
 * HP Layout Aufmacher.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="row flex-container" style="background-color: <?php echo( mmbeta_color($post->background_color) ); ?>">

  <?php
  $contrast_color = mmbeta_color($post->contrast_color);
  $attributes = $arrayName = array('class' => 'figure-img aufmacher');
  //Bild
  echo '<div class="flex-item aufmacher-img-container">' . wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'cover', false, $attributes  ) . '</div>';
  ?>
  <div class="flex-item aufmacher-text-container">
  <?php
  // Themenliste
  if( have_rows('themen') ):
      echo "<ul class='list-unstyled'>";
    // loop through the rows of data
      while ( have_rows('themen') ) : the_row();
  ?>

          <li class="aufmacher-list-item">
            <h5 class="topic-title"><?php the_sub_field('topic-title'); ?></h5>
            <p class="topic-teaser"><?php the_sub_field('topic-teaser'); ?></p>
          </li>

  <?php
      endwhile;
      echo "</ul>";
  else :

      the_excerpt();

  endif;

  ?>
    <button type="button" class="btn" style="background-color: <?php echo $contrast_color; ?>; border-color: <?php echo $contrast_color; ?>;">Heft kaufen</button>
  </div>
</div>