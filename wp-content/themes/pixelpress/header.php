<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
$logo = get_field('logo', 'option');
?>

<header class="relative z-50 bg-[var(--brand-red)]">
    <div class="container">
        <div class="flex items-center justify-between">
            <a href="<?php echo home_url() ?>">
                <img class="w-full max-w-[275px]" src="<?php echo $logo['url'] ?>" alt="Logo">
            </a>
    
            <!-- Nav menu -->
            <div id="mobile-menu" class="theme-main-menu">
            <?php
                wp_nav_menu( array( 
                    'theme_location' => 'header-menu',
                    'menu_class'    => 'nav-menu',
                    'container'     => false,
                    'order' => 'ASC'
                ) ); 
            ?>
            </div>
            <!-- Mobile Nav Menu Trigger -->
            <button class="mobile-nav-trigger md:hidden" type="button" aria-controls="mobile-menu" aria-expanded="false" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
    
        </div>
    </div>
</header>
