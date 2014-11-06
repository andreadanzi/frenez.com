	

<?php if ( is_active_sidebar( 'gridly_footer')) { ?>     
   <div id="footer-area">
			<?php dynamic_sidebar( 'gridly_footer' ); ?>
        </div><!-- // footer area -->   
<?php }  ?>     
      


  
     
</div><!-- // wrap -->   
 <div id="copyright">
 <p>&copy; <?php echo date("Y"); echo " "; bloginfo('name'); ?> | THOMAS FRENEZ p.zza San Giovanni 2, 38017 Mezzolombardo (TN), t. +39 0461 600131 f. +39 0461 600573 mail@theincline.it pec: thomas.frenez@ingpec.eu PIVA: 01601180225 CF: FRNTMS71M15F187D | <a href="<?php echo esc_url( __('http://www.eleventhemes.com/', 'eleventhemes') ); ?>" title="Eleven WordPress Themes" target="_blank">Theme by Eleven Themes </a></p>
 </div><!-- // copyright --> 
	<?php wp_footer(); ?>
	
</body>
</html>