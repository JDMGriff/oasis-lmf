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
    wp_enqueue_style(
        'pixelpress-app',
        get_template_directory_uri() . '/dist/app.css',
        array(),
        filemtime(get_template_directory() . '/dist/app.css'),
        'all'
    );
    wp_enqueue_script(
        'pixelpress-app',
        get_template_directory_uri() . '/dist/app.js',
        array(),
        filemtime(get_template_directory() . '/dist/app.js'),
        true
    );
    wp_localize_script('pixelpress-app', 'pixelpressAjax', array(
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('pixelpress_load_more'),
    ));
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

function pixelpress_load_more_posts() {
    check_ajax_referer('pixelpress_load_more', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 2;
    $posts = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 8,
        'post_status'    => 'publish',
        'paged'          => $page,
    ));

    ob_start();

    while($posts->have_posts()) {
        $posts->the_post();
        ?>
        <article class="flex flex-col h-full">
            <a href="<?php the_permalink(); ?>">
                <?php if(has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('full'); ?>
                <?php endif; ?>

                <div class="text-xs text-white bg-[var(--brand-red)] rounded-full px-2 py-1 inline-block mt-4 font-semibold">
                    <?php echo get_the_date('F, Y'); ?>
                </div>

                <h5 class="text-xl font-semibold mt-3 mb-2"><?php the_title(); ?></h5>
            </a>

            <p class="mb-4">
                <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
            </p>

            <a class="latest-blogs-rm mt-auto font-medium inline-block w-max pb-1 border-b border-[var(--brand-red)]" href="<?php the_permalink(); ?>">
                Read More
            </a>
        </article>
        <?php
    }

    $html = ob_get_clean();
    $hasMore = $page < $posts->max_num_pages;

    wp_reset_postdata();

    wp_send_json_success(array(
        'html'     => $html,
        'has_more' => $hasMore,
    ));
}
add_action('wp_ajax_pixelpress_load_more_posts', 'pixelpress_load_more_posts');
add_action('wp_ajax_nopriv_pixelpress_load_more_posts', 'pixelpress_load_more_posts');

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
