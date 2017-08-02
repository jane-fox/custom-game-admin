<?php
/**
 * Template Name: Front Page Template
 *
 */

get_header();

?>

<?php while ( have_posts( ) ) : the_post(); ?>

<div class="background-image" style="background-image: url('<?php the_post_thumbnail_url("full"); ?>');">

	<div class="container">

		<h1><?php the_title( ); ?></h1>

		<?php the_content( ); ?>
	</div>

</div>

<?php endwhile; // end of the loop. ?>



<div class="container">

		<?php
		   // the query
		   $the_query = new WP_Query( array(
		     //'category_name' => 'news',
		      'posts_per_page' => 3,
		   ));
		?>

		<?php if ( $the_query->have_posts() ) : ?>
		  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="row text-center margin-bottom">

				<h3><?php the_title(); ?></h3>
				<p><?php the_excerpt(); ?></p>
			</div>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

		<?php else : ?>
		  <p><?php __('No News'); ?></p>
		<?php endif; ?>
</div>


<?php get_footer(); ?>
