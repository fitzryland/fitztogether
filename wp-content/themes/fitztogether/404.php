<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package PixelSpoke Boilerplate
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main page_wrap" role="main">

			<section class="error-404 not-found page_content">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'fitztogether' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<h4>Maybe check out some of these posts:</h4>
					<?php
					$recent_posts_args = array(
							'posts_per_page' => 5
						);
					$recent_posts = get_posts($recent_posts_args);
					if ( count($recent_posts) > 0 ) :
						?>
						<ul class="recent_post_list">
							<?php foreach ($recent_posts as $post_key => $recent_post) : ?>
								<li>
									<a href="<?php echo get_permalink($recent_post->ID); ?>">
										<?php echo $recent_post->post_title; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
