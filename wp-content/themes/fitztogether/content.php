<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'part', 'postHeader' ); ?>

	<div class="single_post_content">
		<?php the_excerpt(); ?>
	</div><!-- .single_post_content -->

</article><!-- #post-## -->