<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the class=container div and all content after
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
?>

	<div id="footer">
		<div class="footer-wrapper">
			<div class="footer-links">
					<p>&copy; <?php echo date('Y'); ?> La Madeleine de Corps, Inc</p>
					<p><a href="#">Privacy Policy</a></p>
					<p><a href="#">Terms &amp; Conditions</a></p>
			</div>
		</div>
	</div>
			
	</div><!-- Container End -->

	<!-- Prompt IE 6/7 users to install Chrome Frame. Remove this if you want to support IE 6/7.
	     chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 8]>
		<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

	<?php wp_footer(); ?>

</body>
</html>