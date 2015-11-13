<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<div class="single_post_nav_wrap">
				<div class="single_post_nav">
					<?php fitztogether_post_nav(); ?>
				</div>
			</div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
