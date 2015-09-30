<?php
/**
 * @package PixelSpoke Boilerplate
 */
?>

<div class="post_body_wrap">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_body' ); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry_title">', '</h1>' ); ?>

			<div class="entry-meta">
				<?php fitztogether_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php fitztogether_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>
