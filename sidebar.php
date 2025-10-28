<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Reclaim_Open_Retro_v_Justin
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php reclaim_live_chat( isset( $GLOBALS['reclaim_live_chat_post_id'] ) ? $GLOBALS['reclaim_live_chat_post_id'] : null );?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
