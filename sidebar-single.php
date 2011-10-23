<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

?>
<div id="single-sidebar" class="widget-area" role="complementary">
	<ul class="xoxo">
	
	
		<li id="meta" class="widget-container widget ">
			<h3 class="widget-title"><?php _e( 'Artikelinfo', 'buergerlobby' ); ?></h3>
			<div class="artikelinfo">
				<?php global $post; ?>
				Ver&ouml;ffentlicht am <?php echo the_date(); ?><br /> 
				von <?php echo get_the_author(); ?>
			</div>
		</li>
	
		<?php if ( is_active_sidebar( 'single-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'single-sidebar' ); ?>
		<?php endif; ?>				
	</ul>
</div>