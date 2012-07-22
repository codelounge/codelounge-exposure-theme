<?php
/*
Copyright: © 2011 Thomas Stein, CodeLounge.de
<mailto:info@codelounge.de> <http://www.codelounge.de/>

Released under the terms of the GNU General Public License.
You should have received a copy of the GNU General Public License,
along with this software. In the main directory, see: licence.txt
If not, see: <http://www.gnu.org/licenses/>.
*/

/**
 * The default template for displaying content
 *
 * @package Exposure
 * @author Thomas Stein
 * @since 0.1.0
 */
?>
	<?php exposure_content_nav( 'nav-above' ); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="sb_image">
			<?php if (has_post_thumbnail($post->ID)) :?>
				<?php $thumbnail_post = get_post(get_post_thumbnail_id($post->ID));?>
				<?php the_post_thumbnail('fullscreen-landscape'); ?>
				<a href="https://github.com/codelounge/codelounge-exposure-theme"><img style="position: absolute; top: 0; left: 0; border: 0;" src="<?php echo bloginfo('template_url'); ?>/images/forkme_left_red_aa0000.png" alt="Fork me on GitHub"></a>
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
