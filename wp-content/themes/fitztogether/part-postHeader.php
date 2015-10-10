<header class="entry-header">
	<?php
	if ( is_single() ) :
		the_title( '<h1 class="entry_title">', '</h1>' );
	else: ?>
		<h2 class="entry_title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	<?php endif; ?>

	<div class="entry-meta">
		<?php fitztogether_posted_on(); ?>
		<?php
		$cat_list = get_the_category_list( ', ' );
		echo ' - in: ' . $cat_list;
		?>
	</div><!-- .entry-meta -->
</header><!-- .entry-header -->