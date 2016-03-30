	<footer id="footer" role="contentinfo">
		<div class="container">
			<div id="footer_content">
				<img id="footer_catering" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-small.png" alt="Catering by La Madeleine" />
				<img id="footer_lamad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/lamad-logo.png" alt="La Madeleine" />

				<nav id="nav_footer" role="navigation">
					<?php wp_nav_menu( array('menu' => 'Footer' )); ?>
				</nav>

				<div id="copyright">
					<p><a target="_blank" href="http://lamadeleine.com/">visit LaMadeleine.com</a><br />
					&copy; <?php echo date("Y"); ?> La Madeleine De Corps, Inc.</p>
				</div>

				<div class="clear"></div>
			</div>
		</div><!-- /.container -->
	</footer><!-- /#footer -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45813434-1', 'https://order.lamadeleine.com/');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
</body>
</html>
