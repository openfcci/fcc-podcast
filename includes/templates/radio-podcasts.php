<?php ?>
<!-- *** PODCASTS *** -->
<h2 class="section-title">PODCASTS</h2>
<?php
/* Begin the Loop */
wp_reset_query(); // TODO: Remove?

global $do_not_duplicate;
global $post;

# WP_Query arguments
$args = array (
  'post__not_in' => $do_not_duplicate, # Ignore "This Week's Show" post
	'post_type'              => array( 'podcasts' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page'         => '3',
  'order'                  => 'DESC',
	'cache_results'          => true,
	'update_post_meta_cache' => true,
	'update_post_term_cache' => true,
);

$the_query = new WP_Query( $args );
if ( $the_query->have_posts()  ) { # IF

  while ( $the_query->have_posts() ) { # WHILE
    $the_query->the_post();
    $do_not_duplicate[] = $post->ID;
    $id = (int) $post->ID;
    if (isset($do_not_duplicate)) {

    /**** POST META  *****/
    $podcast_number = get_post_meta($id, 'podcast_episode_number', true);

    $segment_description = the_content();

    $segment_link = get_permalink($id);
    ?>

  <div class="podcast-post">
    <p class="podcast-title" style="text-align: left">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
    </p>
    <ul>
      <?php
      	echo '<p><span class="segment--description">' . $segment_description . '</span></p>';
			?>
    </ul>
  </div>


<?php } #endif
  } #endwhile; ?>

<div class="nav-next alignright">
  <a href="<?php echo get_post_type_archive_link( 'podcasts' ); ?>"> See More Podcasts ›</a>
</div>

<?php
  # Restore original Post Data
  wp_reset_postdata();
  wp_reset_query(); // TODO: Remove?
} # endif;
?>
<!-- END STATIONS-->
<?php
