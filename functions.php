<?php
/**
 * snae functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package snae
 */

require_once( __DIR__ . '/inc/custom-fields.php');
require_once( __DIR__ . '/inc/artists.php');
require_once( __DIR__ . '/inc/workshops.php');

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'snae_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function snae_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on snae, use a find and replace
		 * to change 'snae' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'snae', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'snae' ),
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
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'snae_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'snae_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function snae_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'snae_content_width', 640 );
}
add_action( 'after_setup_theme', 'snae_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function snae_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'snae' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'snae' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'snae_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function snae_scripts() {
	wp_enqueue_style( 'snae-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), _S_VERSION );

	wp_enqueue_style( 'snae-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'snae-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'snae-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (is_singular() && get_post_type() == 'workshops') {
		wp_enqueue_script( 'workshop_photo', get_template_directory_uri() . '/assets/js/workshop_photo.js', array(), _S_VERSION);
	}
}
add_action( 'wp_enqueue_scripts', 'snae_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Disable access to author page
function snae_disable_author_page() {
    global $wp_query;

    if ( is_author() ) {
        // Redirect to homepage
        wp_redirect(get_option('home'));
    }
}

add_action('template_redirect', 'snae_disable_author_page');

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/* Remove website field from comments form */

function remove_website_field($fields) {
	    unset($fields['url']);
		    return $fields;
}
 
add_filter('comment_form_default_fields', 'remove_website_field');

/* Move comment field and opt in to bottom in comments form */

function move_comment_fields( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;

		$cookies_field = $fields['cookies'];
		unset( $fields['cookies'] );
		$fields['cookies'] = $cookies_field;


		return $fields;
}

add_filter( 'comment_form_fields', 'move_comment_fields' );

function custom_reply_title( $defaults ){
  $defaults['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';
  $defaults['title_reply_after'] = '</h2>';
  return $defaults;
}

add_filter( 'comment_form_defaults', 'custom_reply_title' );

add_action( 'admin_init', 'hide_editor' );

function snae_register_footer_nav_menus(){
	register_nav_menus( array(
		'footer_1' => __('First footer menu'),
		'footer_2' => __('Second footer menu'),
		'footer_3' => __('Third footer menu'),
		'footer_4' => __('Fourth footer menu')
	));
}

add_action('after_setup_theme','snae_register_footer_nav_menus', 0);
