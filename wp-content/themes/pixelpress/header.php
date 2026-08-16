<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$logo = get_field('logo', 'option');
?>

<header class="site-header sticky top-0 z-50 bg-[var(--brand-red)]">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <a class="site-header__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?> home">
                <img class="w-full max-w-[220px]" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: get_bloginfo('name')); ?>">
            </a>
    
            <!-- Nav menu -->
            <div id="mobile-menu" class="theme-main-menu">
            <?php
                wp_nav_menu( array( 
                    'theme_location' => 'header-menu',
                    'menu_class'    => 'nav-menu',
                    'container'     => false,
                    'fallback_cb'   => false,
                    'depth'         => 2,
                ) ); 
            ?>
            </div>
            <!-- Mobile Nav Menu Trigger -->
            <button class="mobile-nav-trigger lg:hidden" type="button" aria-controls="mobile-menu" aria-expanded="false" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
    
        </div>
    </div>
</header>
