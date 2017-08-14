<?php
/**
 * Template Name: Front Page Template
 *
 */

get_header();

?>

<?php while ( have_posts( ) ) : the_post(); ?>

<div class="background-repeat spacing-bottom" >

	<div class="container">

		<h1><?php the_title( ); ?></h1>

		<?php the_content( ); ?>
	</div>

</div>



<div class="spacing-bottom" >

	<div class="container">

		<?php echo get_field( "below_header" ); ?>

	</div>

</div>

<?php endwhile; // end of the loop. ?>

<!-- Add section for supprt -->


<hr>

<div class="container">

	<h2 class="spacing-bottom">New Updates</h2>

		<?php
		   // the query
		   $the_query = new WP_Query( array(
		     //'category_name' => 'news',
		      'posts_per_page' => 2,
		   ));
		?>

		<?php if ( $the_query->have_posts() ) : ?>
		  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="margin-bottom">

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
