	<footer id="footer" role="contentinfo">
		<div class="container">
			<div id="footer_content">
				<img id="footer_catering" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-small.png" alt="Catering by La Madeleine" />
				<img id="footer_lamad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/lamad-logo.png" alt="La Madeleine" />

				<nav id="nav_footer" role="navigation">
					<ul>
						<li><a href="/menu">view catering menu</a><li>
						<li><a href="/#location_list">find a café</a><li>
						<li><a href="/faqs#1">how to order</a><li>
						<li><a href="/faqs">frequently asked questions</a><li>
					</ul>
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

  ga('create', 'UA-45813434-1', 'cateringbylamadeleine.com');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
<?php /*
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-43765244-1");
pageTracker._trackPageview();
} catch(err) {}
</script>
*/ ?>
</body>
</html>