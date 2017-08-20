<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

  <div id="primary" class="content-area">

    <div class="row">
    <?php 
      $kategorie = mmbeta_die_preiskategorie_object();
      $preis = get_term($kategorie->parent, 'preise')->slug;

      while ( have_posts() ) : the_post(); 
    ?>
      
      <?php 
      get_template_part( 'template-parts/content', get_post_type( $post ) ); 

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
      ?>
      
    <?php endwhile; // End of the loop. ?>
    </div>


    <!-- Other winners' cards -->

    <?php
      if ( ! post_password_required() ) {  
      
      if ( $kategorie->name !== 'JDJ' && $kategorie->name !=='Lebenswerk' ){ ?>
        <div class="lead m-b">Außerdem wurden <?php if( $preis !== "top-30-bis-30" ) : echo "in der Kategorie "; endif; ?><?php mmbeta_die_preiskategorie(); ?> ausgezeichnet:</div>
      <?php } 

        $die_ID = $post->ID;


        $args = array(
            'post_type' => 'preistraeger',
            'tax_query' => array(
              array(
                'taxonomy' => 'preise',
                'field'    => 'slug',
                'terms'    => $kategorie->slug,
              ),
            ),
            'post__not_in' => array( $die_ID ),
            'meta_key' => 'platz',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
          );
          $query = new WP_Query( $args );
      

      if ($query->have_posts()): ?>
        <div class="row card-cluster">
          <?php while ($query->have_posts()): $query->the_post();?>
            <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3 preistraeger-card">
              <a href="<?php the_permalink(); ?>">
                <article class="card">
                  <?php if ($preis === "top-30-bis-30") : 
                    $card_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'card' );
                  ?>
                    <img class="card-img-top figure-img" src="<?php echo $card_image[0]; ?>">
                  <?php endif; ?>
                  <div class="card-block">
                    <h4 class="card-title"><?php the_title(); ?></h4>
                    <p class="card-text"><?php the_field( "position" ); ?></p>
                  </div>
                  <?php if ($preis !== "top-30-bis-30") : ?>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-jdj-faded">
                      <strong>Platz:</strong> <?php the_field('platz'); ?></li>
                    <li class="list-group-item"><strong>Kategorie:</strong> <?php mmbeta_die_preiskategorie(); ?></li>
                  </ul>
                  <div class="card-block">
                    <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Begründung</a>  
                  </div> 
                  <?php endif; ?>
                </article>
              </a>
            </div>
          <?php endwhile;?>
        </div>
      <?php endif;?>
<?php } //end of no password ?>




  </div><!-- #primary -->

<?php get_footer(); ?>