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
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Exposure
 * @author Thomas Stein
 * @since 0.1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo" class="wrapper footer">
		<div class="footer_wrapper">
			<div class="alignright">Powered by <a href="http://www.codelounge.de" target="blank">Exposure-Theme</a> (Version: 0.1.0)</div>
			<div class="alignleft"><span class="entegut">Ente gut, alles gut!</span></div>
			<div class="clear"></div>
		</div>
		
		<div data-role="footer" class="nav-glyphish">
			<div data-role="navbar" class="nav-glyphish" data-grid="c">
				<ul>
					<li><a href="<?php echo bloginfo('url'); ?>" id="home" data-icon="custom">Home</a></li>
					<li><a href="<?php echo get_permalink(33); ?>" id="beer" data-icon="custom">Beer</a></li>
					<li><a href="http://www.codelounge.de/forum/tracker/project-19-wordpress-exposure-theme/" id="radar" data-icon="custom" target="blank">Bugtracker</a></li>
					<li><a href="<?php echo get_permalink(31); ?>" id="impressum" data-icon="custom">Impressum</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /footer -->

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>
			
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php 
// Add Piwik only on Ententour Live-Site
// This should be changed on your install of the Exposure Theme installation
if ($_SERVER['SERVER_NAME'] == 'xxx.ententour.de') : ?>
<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://statistik.codelounge.de/" : "http://statistik.codelounge.de/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
  var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 5);
  piwikTracker.trackPageView();
  piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://statistik.codelounge.de/piwik.php?idsite=5" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
<?php endif; ?>

</body>
</html>