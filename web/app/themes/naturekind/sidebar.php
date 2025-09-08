<?php
/**
 * Sidebar Template.
 */

if ( is_active_sidebar( 'primary_widget_area' ) || is_archive() || is_single() ) :
?>
<!-- order-sm-last -->
<div id="sidebar" class="col-md-3 order-md-first col-sm-12">
	<?php
		if ( is_active_sidebar( 'primary_widget_area' ) ) :
	?>
		<div id="widget-area" class="widget-area" role="complementary">
			<?php
				dynamic_sidebar( 'primary_widget_area' );

				if ( current_user_can( 'manage_options' ) ) :
			?>
				<span class="edit-link"><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="badge bg-secondary"><?php esc_html_e( 'Edit', 'naturekind' ); ?></a></span><!-- Show Edit Widget link -->
			<?php
				endif;
			?>
		</div><!-- /.widget-area -->
	
	<?php
		endif;
	?>
</div><!-- /#sidebar -->
<?php
	endif;
?>
