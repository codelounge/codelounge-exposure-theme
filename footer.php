<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo" class="wrapper footer">
		<div class="footer_wrapper">
			<div class="alignright">Powered by <a href="http://www.codelounge.de" target="blank">Exposure-Theme</a></div>
			<div class="alignleft"><span class="entegut">Ente gut, alles gut!</span></div>
			<div class="clear"></div>
		</div>
		
		<div data-role="footer" class="nav-glyphish">
			<div data-role="navbar" class="nav-glyphish" data-grid="b">
				<ul>
					<li><a href="<?php echo bloginfo('url'); ?>" id="home" data-icon="custom">Home</a></li>
					<li><a href="#" id="beer" data-icon="custom">Beer</a></li>
					<li><a href="#" id="impressum" data-icon="custom">Impressum</a></li>
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

</body>
</html>