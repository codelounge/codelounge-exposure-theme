<article id="post-<?php echo the_ID();?>" class="category_post">

	<?php if (has_post_thumbnail($post->ID)) :?>
		<div class="category_image">
			<a href="<?php echo get_permalink($post->ID); ?>">	
				<?php $thumbnail_post = get_post(get_post_thumbnail_id($post->ID));?>
				<?php the_post_thumbnail('category-view'); ?>
			</a>
			<div class="category_image_desc"><?php echo the_title(); ?></div>
		</div>
	<?php endif; ?>
</article>