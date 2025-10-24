<?php
/**
 * Reclaim Open Retro v Justin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Reclaim_Open_Retro_v_Justin
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function reclaim_open_retro_v_justin_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Reclaim Open Retro v Justin, use a find and replace
		* to change 'reclaim-open-retro-v-justin' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'reclaim-open-retro-v-justin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'reclaim-open-retro-v-justin' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'reclaim_open_retro_v_justin_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'reclaim_open_retro_v_justin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function reclaim_open_retro_v_justin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'reclaim_open_retro_v_justin_content_width', 640 );
}
add_action( 'after_setup_theme', 'reclaim_open_retro_v_justin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function reclaim_open_retro_v_justin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'reclaim-open-retro-v-justin' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'reclaim-open-retro-v-justin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'reclaim_open_retro_v_justin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function reclaim_open_retro_v_justin_scripts() {
	wp_enqueue_style( 'reclaim-open-retro-v-justin-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'reclaim-open-retro-v-justin-style', 'rtl', 'replace' );

	wp_enqueue_script( 'reclaim-open-retro-v-justin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'reclaim_open_retro_v_justin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom data
 */
require get_template_directory() . '/inc/data.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function enqueue_gif_picker_js() {
    if (is_page('submit-a-proposal')) {
        wp_enqueue_script(
            'gif-picker',
            get_template_directory_uri() . '/js/gif-picker.js',
            array('jquery'), // dependencies
            '1.0.0',
            true // load in footer
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_gif_picker_js');

//ALL USERS LOOP

function the_reclaim_users(){
	 $users = get_users();

        if ( ! empty( $users ) ) {
            echo '<ul class="user-list">';
            foreach ( $users as $user ) {
                echo '<li>';
                echo get_avatar( $user->ID, 96 ); // User avatar
                echo '<h2>' . esc_html( $user->display_name ) . '</h2>'; // User display name linking to their author archive
                //echo '<p>' . esc_html( $user->description ) . '</p>'; // User biography
                $args = array(
                	'author' => $user->ID,                	
                );
                $posts = get_posts($args);
                foreach ($posts as $key => $post) {
                	// code...                	
                	echo "<div><a href='{$post->guid}'>{$post->post_title}</a></div>";
                }

                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No users found.</p>';
        }
}


//ACF TO JSON
function acf_to_rest_api_presentation($response, $post, $request) {
    if (!function_exists('get_fields')) return $response;

    if (isset($post)) {
        $acf = get_fields($post->id);
        $response->data['mbs'] = $acf;
    }
    return $response;
}
add_filter('rest_prepare_presentation', 'acf_to_rest_api_presentation', 10, 3);

// menu json api via https://stackoverflow.com/a/66157232/3390935

function wp_menu_route() {
    $menuLocations = get_nav_menu_locations(); // Get nav locations set in theme, usually functions.php)
    return $menuLocations;
    }

    add_action( 'rest_api_init', function () {
        register_rest_route( 'custom', '/menu/', array(
        'methods' => 'GET',
        'callback' => 'wp_menu_route',
    ) );
} );

function wp_menu_single($data) {
    $menuID = $data['id']; // Get the menu from the ID
    $primaryNav = wp_get_nav_menu_items($menuID); // Get the array of wp objects, the nav items for our queried location.
    return $primaryNav;
    }

    add_action( 'rest_api_init', function () {
        register_rest_route( 'custom', '/menu/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'wp_menu_single',
    ) );
} );


/*
*
*User Registration
*
*/ 
add_action( 'gform_advancedpostcreation_post_after_creation', 'justin_session_user_creation', 10, 4 );

function justin_session_user_creation($post_id, $feed, $entry, $form ){
	//write_log($entry);
	$email = $entry["3"];
	$gif_url = $entry["10"];
	$extra_authors = $entry["12"];
	$resource = $entry["13"];
	$gif_id = $entry["16"];

	//USER STUFF
	if (get_user_by('email', $email)){
      $user = get_user_by('email', $email);
      $user_id = $user->ID;      
  	} else {
	    $chop = strpos($email,'@', 0);
	    $username = substr($email, 0, $chop);
	    $pw = 'Reclaim2025!';
	    $user_id = wp_create_user($username, $pw, $email);
    }
  	if($user_id){ // if the user exists/if creating was successful.
    	$user = new WP_User( $user_id ); // load the new user
    	$user->set_role('author'); 
	}

	//assign user to post as author
	$arg = array(
		'ID' => $post_id,
		'post_author' => $user_id
	);
	wp_update_post($arg);
	set_post_thumbnail( $post_id, $gif_id);//set featured image
	wp_update_post(array(
	    'ID'           => $gif_id,
	    'post_excerpt' => 'Used',
	));
}

function justin_power_password_reset($user_id){	
	$new_password = 'Reclaim25!';	
	wp_set_password( $new_password, $user_id );
}

/*
**
** save acf
**
*/
//save acf json
add_filter('acf/settings/save_json', 'reclaim_open_json_save_point');
 
function reclaim_open_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json'; 
    
    
    // return
    return $path;
    
}


// load acf json
add_filter('acf/settings/load_json', 'reclaim_open_json_load_point');

function reclaim_open_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory()  . '/acf-json';
    
    // return
    return $paths;
    
}


//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}


//Minimal-ize WP
function posts_for_current_author($query) {
    global $pagenow;
 
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
 
    if( !current_user_can( 'manage_options' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');


function justin_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}


//redirect authors
function justin_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {

        if ( in_array( 'author', $user->roles ) ) {
        	 return home_url().'/sessions/';//OR to the session post?
        } else {
        	return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'justin_login_redirect', 10, 3 );

/*
****************
BY DEFAULT ACF HIDES THE CUSTOM FIELDS - I LIKE TO SEE THEM
****************
*/

//ACF allow us to see custom fields in editor view
add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );

function reclaim_live_chat(){
	//LIVE CHAT
	global $post;
	$post_id = $post->ID;
	$live_chat = get_field('live_chat', $post_id);
	if($live_chat === TRUE){
		echo do_shortcode("[sacpro form_id='{$post_id}']");
	}
}

function reclaim_static_chat() {
    global $wpdb, $post;
    
    $post_id = $post->ID;
    $live_chat = get_field('live_chat', $post_id);
    
    if($live_chat === FALSE){
        $blog_id = get_current_blog_id();
        $prefix = $wpdb->get_blog_prefix($blog_id);
        $table_name = "{$prefix}sacpro_{$post_id}";
        
        $results = $wpdb->get_results("SELECT * FROM {$table_name}");
        
        if (!empty($results)) {
            $previous_user = null;
            $block = '';
            echo '<div class="static-chat-container"><h3>Comments Archive</h3>';
            foreach ($results as $row) {
                $user_name = $row->user_name;
                $text = $row->text;
                
                // If new user, close previous block and start new one
                if ($previous_user !== $user_name) {
                    if ($previous_user !== null) {
                        echo '</div>'; // Close previous message-block
                    }
                    echo '<div class="message-block">';
                }
                
                echo "<div class='message'><strong>{$user_name}:</strong> {$text}</div>";
                
                $previous_user = $user_name;
            }
            
            // Close final message-block
            if ($previous_user !== null) {
                echo '</div>';
            }
			echo '</div>'; // Close static-chat-container
        }
    }
}