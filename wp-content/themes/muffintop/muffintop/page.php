<?php get_header(); ?>

<div id="copy">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
				<h2><?php the_title(); ?></h2>

				<?php the_content(); ?>

			</div>
		<?php endwhile; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>

</div><!-- /copy -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>