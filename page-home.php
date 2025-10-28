<?php
/**
 * Template Name: Home
 * Template Post Type: page
 *
 * Page template that displays only the single most recent 'session' custom post.
 * Based on the theme's `page.php` output.
 *
 * @package Reclaim_Open_Retro_v_Justin
 */

get_header();
?>

	<main id="primary" class="site-main">

    <?php
    // Query the single most recent 'session' post
    $args = array(
        'post_type'      => 'session',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $session_query = new WP_Query( $args );

    $session_id = 0;
    if ( $session_query->have_posts() ) {
        while ( $session_query->have_posts() ) {
            $session_query->the_post();

            /*
             * Reuse the theme's template part for rendering posts.
             * `template-parts/content.php` handles generic post output.
             */
            get_template_part( 'template-parts/content' );

            // If comments are open or there is at least one comment, show template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

            // capture the displayed session post ID so sidebar can use it
            $session_id = get_the_ID();
        }
        wp_reset_postdata();
        if ( $session_id ) {
            $GLOBALS['reclaim_live_chat_post_id'] = $session_id;
        }
    } else {
        // No sessions found — show friendly message
        echo '<p>' . esc_html__( 'No sessions found.', 'reclaim-open-retro-v-justin' ) . '</p>';
    }
    ?>

	</main><!-- #main -->

<?php
get_sidebar();

// cleanup the global after sidebar rendered to avoid leaking into other templates
if ( isset( $GLOBALS['reclaim_live_chat_post_id'] ) ) {
    unset( $GLOBALS['reclaim_live_chat_post_id'] );
}

get_footer();
?>
