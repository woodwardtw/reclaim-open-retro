<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Reclaim_Open_Retro_v_Justin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php
			//reclaim_open_retro_v_justin_posted_by();
			reclaim_open_retro_v_justin_posted_on();
			?>
		</div><!-- .entry-meta -->
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
	</header><!-- .entry-header -->

	<?php reclaim_open_retro_v_justin_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_content(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php reclaim_open_retro_v_justin_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
