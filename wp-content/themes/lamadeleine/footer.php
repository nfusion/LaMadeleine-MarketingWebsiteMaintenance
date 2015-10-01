			<div id="footer">
				<div id="footerFlash"><img src="<?php echo get_template_directory_uri(); ?>/images/img_home-bottom-temp.png" width="751" height="83" border="0" alt="Temporary image for flash" /></div>

				<div id="footerLinks">

					<?php if( is_front_page() ) : ?>
					<p style="margin: 10px 0pt 40px 70px;"><a href="https://order.lamadeleine.com/"><img border="0" alt="Catering by Le Madeleine" src="/img/LAMAD-8519-5-Catering_468x70.jpg" /></a></p>
					<?php endif; ?>

					<?php wp_nav_menu(array('theme_location' => 'footer_navigation', 'walker' => new Roots_Navbar_Nav_Walker())); ?>
				</div>
				<p id="copyright">&copy; 2013 La Madeleine de Corps, Inc.</p>
			</div>
		</div>
	</div>
<script type="text/javascript">
//<![CDATA[
if(typeof sIFR == "function"){
	sIFR.replaceElement(named({sSelector:"h1.sifr", sFlashSrc:"<?php echo get_template_directory_uri(); ?>/swf/clarendon.swf", sColor:"#291107", sLinkColor:"#291107", sBgColor:"#FFFFFF", sHoverColor:"#291107", sWmode:"transparent", nPaddingTop:20, nPaddingBottom:20}));
	sIFR.replaceElement(named({sSelector:"h4.sifr1", sFlashSrc:"<?php echo get_template_directory_uri(); ?>/swf/clarendon.swf", sColor:"#291107", sLinkColor:"#291107", sBgColor:"#FFFFFF", sHoverColor:"#291107", sWmode:"transparent", nPaddingTop:0, nPaddingBottom:0, nPaddingRight:0}));
};
//]]>
</script>
<?php wp_footer(); ?>
<?php roots_footer(); ?>
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
</body>
</html>