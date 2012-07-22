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
 * The Template for displaying all single posts.
 *
 * @package Exposure
 * @author Thomas Stein
 * @since 0.1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="container" role="main"  >

				<?php while ( have_posts() ) : the_post(); ?>
								
					<?php get_template_part( 'content', 'single' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>