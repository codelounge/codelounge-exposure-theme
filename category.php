<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

	<section id="primary">
		<div id="container" role="main">
				
			<?php exposure_category_nav('category-nav'); ?>
			
			<div class="content_wrapper">
				<section id="content">
					<h1><?php echo single_cat_title(); ?></h1>
					<div class="category_description"><?php echo category_description(); ?></div>
				</section>
			</div>
			<div class="clear"></div>
				
			<?php if ( have_posts() ) : ?>

				
				<div class="category_view">
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
					
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 	*/	
							get_template_part( 'content-category', get_post_format() );
						?>
					
					<?php endwhile; ?>
				</div>
				<div class="clear"></div>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'exposure' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'exposure' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->
		<div class="clear"></div>
		
<?php get_footer(); ?>
