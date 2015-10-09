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
			<?php
			$flexible_content = get_field('post_content');
			if ( is_array($flexible_content) ) :
				foreach ($flexible_content as $block_key => $block) :
					switch ($block['acf_fc_layout']) :
						case 'text_area':
							echo $block['text_content'];
							break;

						case 'media_object':
							$post_image_class = 'post_image';

							$image_alignment = strtolower($block['alignment']);
							$image_alignment = str_replace( ' ', '_', $image_alignment );
							$post_image_class .= ' post_image__' . $image_alignment;

							$image_size = strtolower($block['size']);
							$image_size = str_replace( 'extra ', 'x-', $image_size );
							$post_image_class .= ' post_image__' . $image_size;

							// echo '$image_size: ' . $image_size . '</br>';
							// echo '<pre>';
							// print_r($block);
							// echo '</pre>';

							$img_set_args = array();
							$img_args = array(
								'image' => $block['image'],
								'class' => $post_image_class,
								'size' => $image_size,
								'imgSetArgs' => $img_set_args
							);

							$img_wrap_class = 'post_image_wrap';
							if ( $block['size'] == 'Extra Large' ) :
								$img_wrap_class = ' post_image_wrap__large';
							endif;

							echo '<div class="' . $img_wrap_class . '">';
								echo acf_image( $img_args );
							echo '</div>';

							break;

						default:
							# code...
							break;
					endswitch;
				endforeach;
			endif;
			?>
			<?php // the_content(); ?>
		</div><!-- .single_post_content -->

		<footer class="entry-footer">
			<?php fitztogether_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>
