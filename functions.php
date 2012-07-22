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
 * Exposure functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, exposure_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'exposure_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Exposure
 * @author Thomas Stein
 * @since 0.1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run exposure_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'exposure_setup' );

if ( ! function_exists( 'exposure_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override exposure_setup() in a child theme, add your own exposure_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function exposure_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'exposure' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'exposure', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	//require( dirname( __FILE__ ) . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
//	require( dirname( __FILE__ ) . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'exposure' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// Add support for custom backgrounds
//	add_custom_background();

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	// set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add Twenty Eleven's custom image sizes
	add_image_size( 'large-feature', 1024, 1024, false ); // Used for large feature (header) images
	add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist
	add_image_size( 'category-view', 300, 225, true);
	add_image_size( 'fullscreen-landscape', 1024, 1024, true);

	// Add additional css styles for mobile devices
	detect_mobile_devices();
	
}
endif; // exposure_setup

/**
 * Detect mobile Devices
 */
function detect_mobile_devices() {
	$ipad = "Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.10";
	$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
	if ($isiPad) {

		wp_enqueue_style('ipad-landscape.css', get_bloginfo('template_url').'/css/ipad-landscape.css', false, '1.0', 'all and (orientation:landscape)');
		wp_enqueue_style('ipad-portrait.css', get_bloginfo('template_url').'/css/ipad-portrait.css', false, '1.0', 'all and (orientation:portrait)');

	}
}

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function exposure_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'exposure_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function exposure_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'exposure' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and exposure_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function exposure_auto_excerpt_more( $more ) {
	return ' &hellip;' . exposure_continue_reading_link();
}
add_filter( 'excerpt_more', 'exposure_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function exposure_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= exposure_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'exposure_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function exposure_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'exposure_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function exposure_widgets_init() {

	// register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'exposure' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Single Page Sidebar', 'exposure' ),
		'id' => 'single-sidebar',
		'description' => __( 'The sidebar for the Single Pages', 'exposure' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'exposure_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function exposure_content_nav( $nav_id ) {
	global $wp_query;
	
	$prev = get_previous_post();
	$next = get_next_post(); ?>
	
		<nav id="<?php echo $nav_id; ?>" data-theme="a" data-position="inline" data-role="header" role="banner">
			<?php if (false != $next) : ?>
				<a href="<?php echo get_permalink($next->ID); ?>" id="next_post_link" data-theme="a" data-icon="arrow-l"  data-prefetch data-direction="reverse"><?php echo $next->post_title;?></a> 
			<?php endif ; ?>
			
			<h1 class="ui-title" tabindex="0" role="heading" aria-level="1"><?php the_title(); ?></h1>
					
			<?php if (false != $prev) : ?>
				<a href="<?php echo get_permalink($prev->ID); ?>" id="previous_post_link" data-theme="a" data-icon="arrow-r" data-iconpos="right" class="ui-btn-right" data-prefetch ><?php echo $prev->post_title;?></a> 
			<?php endif; ?>
			
		</nav>
		<div id="hidden_nav"></div>
	<?php 
	
}

/**
* Display navigation to next/previous pages when applicable
*/
function exposure_category_nav( $nav_id ) {
	global $wp_query;

	
	$next_posts_link = get_next_posts_link('&Auml;ltere Eintr&auml;ge');
	$previous_posts_link = get_previous_posts_link('Neuere Eintr&auml;ge'); ?>
	
		<nav id="<?php echo $nav_id; ?>" data-theme="a" data-position="inline" data-role="header" role="banner">
			<?php if (false != $previous_posts_link) : ?>
				<?php echo $previous_posts_link; ?>
			<?php endif; ?>
			<h1><?php echo single_cat_title(); ?></h1>
			<?php if (false != $next_posts_link) : ?>
				<?php echo $next_posts_link; ?>
			<?php endif; ?>
			
		</nav>
		<div id="hidden_nav"></div>
	<?php 
}

/**
 * Add styling for jquery mobile to the next-posts-link
 */
function add_next_posts_link_attributes() {
	return 'id="previous_post_link" data-theme="a" class="ui-btn-right" data-icon="arrow-r" data-iconpos="right" data-prefetch data-direction="reverse"';
}
add_filter('next_posts_link_attributes', 'add_next_posts_link_attributes' );

/**
* Add styling for jquery mobile to the previous-posts-link
*/
function add_previous_posts_link_attributes() {
	return 'id="next_post_link" data-theme="a" data-icon="arrow-l"  data-prefetch';
}
add_filter('previous_posts_link_attributes', 'add_previous_posts_link_attributes' );


/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function exposure_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'exposure_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own exposure_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function exposure_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'exposure' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'exposure' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-image ">
				<div class="comment-author vcard small">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

					?>

					<?php edit_comment_link( __( 'Edit', 'exposure' ), '<span class="small">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'exposure' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>
			
			<div class="comment-container">
			    <div class="comment-meta">
			    <span class="comment-author"><?php echo get_comment_author_link() ?></span> - <?php echo get_comment_date(); ?>&nbsp;<?php echo get_comment_time(); ?> Uhr
			    </div>
			<?php 
				/* translators: 1: comment author, 2: date and time */
				/*printf( __( '%1$s on %2$s <span class="says">said:</span>', 'exposure' ),
				sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
				sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
				esc_url( get_comment_link( $comment->comment_ID ) ),
				get_comment_time( 'c' ),
				/* translators: 1: date, 2: time */
			/*	sprintf( __( '%1$s at %2$s', 'exposure' ), get_comment_date(), get_comment_time() )
				)
				); */
				?>
				<div class="comment-content">
				
				
				<?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'exposure' ) ) ) ); ?>
				</div><!-- .reply -->
			</div>
			<div class="clear"></div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for exposure_comment()

if ( ! function_exists( 'exposure_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own exposure_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function exposure_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'exposure' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'exposure' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function exposure_body_classes( $classes ) {

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'exposure_body_classes' );

/**
* Show's a formated version of thr print_r() function
*
* @param mixed $mVar Variable to be displayed
*/
function printR($mVar, $sOutput_file=null)
{
	// Array of variables
	$aVars = array($mVar);
	if(func_num_args() > 2)
	{
		for($i = 2; $i < func_num_args(); $i++)
		{
			$aVars[] = func_get_arg($i);
		}
	}

	// output
	foreach($aVars as $mVar)
	{
		if(is_null($sOutput_file))
		{
			// output as html
			echo "<pre style='text-align: left;font-size: larger; border: 2px dashed #FF0000;background-color: #FFF; color: #000;'>";
			$mVar = print_r($mVar, true);
			$mVar = preg_replace("!(.*)\[(.*)\]( => .*)!"                           , "\\1<span style='color: #f00;'>[\\2]</span>\\3", $mVar);
			$mVar = preg_replace("!(.*) => ([a-zA-Z_0-9\-]+ Object\s+)!iU"          , "\\1 => <span style='color: #8232BF; font-weight: bold;'>\\2</span>", $mVar);
			$mVar = preg_replace("!([a-zA-Z_0-9\-]+ Object\s)!"                     , "<span style='color: #8232BF; font-weight: bold;'>\\1</span>", $mVar);
			$mVar = preg_replace("!(.*) => ([0-9\.]+\s)!"                           , "\\1 => <span style='color: #DC4FD7;'>\\2</span>", $mVar);
			$mVar = preg_replace("!(.*) => (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\s)!", "\\1 => <span style='color: #0056E4;'>\\2</span>", $mVar);
			$mVar = preg_replace("!(.*) => (\d{4}-\d{2}-\d{2}\s)!"                  , "\\1 => <span style='color: #0056E4;'>\\2</span>", $mVar);
			$mVar = preg_replace("!(.*) => (\d{2}:\d{2}:\d{2}\s)!"                  , "\\1 => <span style='color: #0056E4;'>\\2</span>", $mVar);
			$mVar = preg_replace("!(.*) => (\s{2,})!"                               , "\\1 => <span style='color: #FFA810;'>NULL OR \"\"</span>\\2", $mVar);
			$mVar = preg_replace("!(.*) => ([a-fA-F0-9]{32})(\s+)!"                 , "\\1 => <span style='color: #119E2B;'>\\2</span>\\3", $mVar);
			echo $mVar;
			echo "</pre>";
		}
		else
		{
			// output to file
			if($sOutput_file === true)
			{
				$sOutput_file = 'debug.txt';
			}

			$rFp = fopen($sOutput_file, 'a');
			fwrite($rFp, print_r($mVar, true));
			fwrite($rFp, "\n");
			fclose($rFp);
		}
	}

}
