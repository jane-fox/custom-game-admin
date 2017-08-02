<?php
/**
 * Template Name: Front Page Template
 *
 */

get_header();

?>

<?php while ( have_posts( ) ) : the_post(); ?>

<div class="background-image" style="background-image: url('<?php the_post_thumbnail_url("full"); ?>');">


		<div class="content">


				<?php the_content( ); ?>



		</div>

</div>
<?php endwhile; // end of the loop. ?>



<div class="container">
<div class="row text-center margin-bottom">

<?php //echo get_field("below_display"); ?>

<?php while ( have_posts( ) ) : the_post(); ?>

	<?php the_content( ); ?>


<?php endwhile; // end of the loop. ?>

</div>
</div>


<?php get_footer(); ?>
