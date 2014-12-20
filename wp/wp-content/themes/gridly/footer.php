	

<?php if ( is_active_sidebar( 'gridly_footer')) { ?>     
   <div id="footer-area">
			<?php dynamic_sidebar( 'gridly_footer' ); ?>
        </div><!-- // footer area -->   
<?php }  ?>     
      


  
     
</div><!-- // wrap -->   
 <div id="copyright">
	<!-- danzi.tn@20141219 -->
	<div id="address_container"> 
		<div class="footer_address"> 
			<ul>
				<li>THOMAS FRENEZ</li>
				<li>&copy; <?php echo date("Y"); echo " "; bloginfo('name'); ?></li>
				<li><a href="<?php echo esc_url( __('http://www.eleventhemes.com/', 'eleventhemes') ); ?>" title="Eleven WordPress Themes" target="_blank">Theme by Eleven Themes</a></li>
			</ul>
		</div> 
		<div class="footer_address">
			<ul>
				<li>p.zza San Giovanni 2</li>
				<li>38017 Mezzolombardo (TN)</li>
				<li>t. +39 0461 600131</li>
				<li>f. +39 0461 600573</li>
				<li>mail@theincline.it</li>
			</ul>
		</div>
		<div class="footer_address">
			<ul>
				<li>pec: thomas.frenez@ingpec.eu</li>
				<li>PIVA: 01601180225</li>
				<li>CF: FRNTMS71M15F187D</li>
			</ul>
		</div>
	</div> 
	<!-- danzi.tn@20141219e -->
</div><!-- // copyright --> 
	<?php wp_footer(); ?>	
</body>
</html>