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
 * The main template file.
 * 
 * @package Exposure
 * @author Thomas Stein
 * @since 0.1.1
 */

get_header(); ?>

    <?php 
    // Create a custom query to only show the latest post on the frontpage
    global $wp_query;
    
    query_posts(array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'status' => 'publish',
        
    ));
    // Some little trick to display comments via the commments_template on the home-page
    $wp_query->is_single = true;
    $wp_query->is_home = false;
    ?>

    <div id="primary">
        <div id="container" role="main">
                
        <?php if ( have_posts() ) : ?>
                
            <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
                    <?php get_template_part( 'content' ); ?>

                <?php endwhile; ?>

                <?php //exposure_content_nav( 'nav-below' ); ?>

            <?php else : ?>

                <article id="post-0" class="post no-results not-found">
                    <header class="entry-header">
                        <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-0 -->

        <?php endif; ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>