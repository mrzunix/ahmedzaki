<div class="footer-columns pure-g">
	<?php if(is_active_sidebar('footer-area')) : ?>
		<div id="footer-widget" class="footer-1 <?php echo simply_pure_sidebars_class('footer'); ?>">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area')); ?>	
		</div>
	<?php endif; if(is_active_sidebar('footer-area-2')) : ?>
		<div id="footer-widget" class="footer-2 <?php echo simply_pure_sidebars_class('footer'); ?>">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area-2')); ?>	
		</div>
	<?php endif; if(is_active_sidebar('footer-area-3')) : ?>
		<div id="footer-widget" class="footer-3 <?php echo simply_pure_sidebars_class('footer'); ?>">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area-3')); ?>	
		</div>
	<?php endif; ?>
	<div class="clearfix"></div>
</div>
<div class="footer">
	&copy; <?php echo Date('Y'); ?> <?php bloginfo('title'); ?> - <?php _e('Theme by ', 'simply-pure');?><a href="<?php  echo esc_url( __( 'http://www.best2know.info/', 'simply-pure' ) ); ?>" class="post-category author_link">Ritesh Sanap</a>
</div>
</div><!-- end Content -->
<?php get_sidebar(); ?>
</div> <!-- end #layout -->
<?php wp_footer(); ?>
</body>
</html>
