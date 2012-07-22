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
 * The Sidebar containing the main widget area.
 *
 * @package Exposure
 * @author Thomas Stein
 * @since 0.1.0
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