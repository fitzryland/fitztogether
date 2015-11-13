<?php
/**
 * @package PixelSpoke Boilerplate
 */
?>

<div class="post_body_wrap">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_body' ); ?>>

		<?php get_template_part( 'part', 'postHeader' ); ?>

		<div class="single_post_content">
			<div class="single_post_content--header_wrap">
				<?php
				$img_set_args = array();
				$header_image_args = array(
					'image' => get_field('header_image'),
					'class' => 'single_post_content--header',
					'size' => 'xx-large',
					'imgSetArgs' => $img_set_args
				);
				echo acf_image($header_image_args);
				?>
			</div>

			<?php get_template_part( 'part', 'flexibleContent' ); ?>

		</div><!-- .single_post_content -->

		<!-- <footer class="entry-footer">
			<?php // fitztogether_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>
