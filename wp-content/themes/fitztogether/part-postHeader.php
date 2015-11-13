<header class="entry-header">
	<?php
	if ( is_single() || is_page() ) :
		the_title( '<h1 class="entry_title">', '</h1>' );
	else: ?>
		<h2 class="entry_title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	<?php endif; ?>

	<?php if ( !is_page() ) : ?>
		<div class="entry-meta">
			Posted
			<?php fitztogether_posted_on(); ?>
			<?php
			$cat_list = get_the_category_list( ', ' );
			echo ' in ' . $cat_list;
			?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

</header><!-- .entry-header -->