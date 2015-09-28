<?php
/**
 * @package PixelSpoke Boilerplate
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_body' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php fitztogether_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'fitztogether' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php fitztogether_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
