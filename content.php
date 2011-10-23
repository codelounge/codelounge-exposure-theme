<?php
/**
 * The default template for displaying content
 *
 * @package Exposure
 * @since 0.1.0
 * @author Thomas Stein
 */
?>
	<?php exposure_content_nav( 'nav-above' ); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="sb_image">
			<?php if (has_post_thumbnail($post->ID)) :?>
				<?php $thumbnail_post = get_post(get_post_thumbnail_id($post->ID));?>
				<?php the_post_thumbnail('fullscreen-landscape'); ?>
				<div class="sb_image_desc"><?php echo $thumbnail_post->post_excerpt; ?></div>	
				<div class="sb_image_credit"><?php echo $thumbnail_post->post_content;?></div>
				<div class="entenlogo" />
			<?php endif; ?>
		</div>
		
		<div class="content_wrapper">
			<section id="content">	
				<h1><?php the_title(); ?></h1>
				<?php the_content();?>
				<?php comments_template( '', true ); ?>
			</section>
			<section id="sidebar">
				<?php get_sidebar('single'); ?>
			</section>
			<div class="clear"></div>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
