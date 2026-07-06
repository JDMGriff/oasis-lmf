<?php 
// Theme support and custom menu registration
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

register_nav_menus( array(
    'header' => 'Custom Primary Menu',
  ) );

// Custom Menu Register
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
     )
   );
 }
add_action( 'init', 'register_my_menus' );


 // Add Custom CSS & Scripts
function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style('globals', get_template_directory_uri() . '/dist/style.css', array(), '1.0.0', 'all');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

// Add tailwind classes to active menu item
add_filter('nav_menu_css_class' , 'tailwind_active_menu_item' , 10 , 2);

function tailwind_active_menu_item ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

// Register ACF Blocks
require_once get_theme_file_path('/inc/register-blocks.php');

// Editor Styles
function inkwellAddEditorStyles() {
    add_theme_support('editor-styles');
    add_editor_style('dist/style.css');
}
add_action('after_setup_theme', 'inkwellAddEditorStyles');