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

<header class="bg-[var(--brand-red)]">
    <div class="container">
        <div class="flex items-center justify-between">
            <a href="<?php echo home_url() ?>">
                <img class="w-full max-w-[275px]" src="<?php echo $logo['url'] ?>" alt="Samiad Logo">
            </a>
    
            <!-- Nav menu -->
            <div class="theme-main-menu">
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
            <div class="mobile-tav-trigger md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19">
                    <path id="Union_54" data-name="Union 54" d="M0,19V16H26v3Zm6.933-8V8H26v3ZM0,3V0H26V3Z" fill="#0f0f10"/>
                </svg>
            </div>         
    
        </div>
    </div>
</header>
