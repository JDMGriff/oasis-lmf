<!-- ACF Options -->
<?php
    $logo = get_field('logo', 'option');
    $address = get_field('company_address', 'option');
    $emails = get_field('company_emails', 'option');
    $socials = get_field('social_media', 'option');
?>

<footer class="footer red-grad-bg pt-12">
    <div class="container mx-auto px-4 flex flex-col items-start justify-between md:flex-row">
        <div class="w-full md:max-w-[25%] text-center md:text-left">
            <!-- Logo -->
            <?php if($logo['url']): ?>
                <a class="" href="<?php echo home_url() ?>">
                    <img class="w-full max-w-[275px] mx-auto mb-8 md:mb-0 md:mr-auto md:ml-0" src="<?php echo $logo['url'] ?>" alt="Logo">
                </a>
            <?php endif; ?>

            <!-- Company Address -->
            <?php if($address): ?>
                <div class="text-white">
                    <?php echo $address; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="w-full md:max-w-[50%] pt-4 text-center my-8 md:my-0 md:text-left">
            <!-- Footer menu -->
            <div class="theme-footer-menu">
            <?php
                wp_nav_menu( array( 
                    'theme_location' => 'footer-menu',
                    'menu_class'    => 'footer-nav-menu',
                    'container'     => false,
                    'order' => 'ASC'
                ) ); 
            ?>
            </div>            
        </div>
        <div class="w-full md:max-w-[25%] pt-4">
            <!-- Email Adresses -->
            <?php if($emails): ?>
                <div class="flex flex-col justify-center items-center md:justify-end md:items-end">
                    <?php foreach($emails as $email):
                        $emailAddress = $email['email_address']    
                    ?>
                        <a class="text-white mb-4" href="mailto:<?php echo $emailAddress ?>">
                            <?php echo $emailAddress ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!-- Social Media -->
            <?php if($socials): ?>
                <div class="flex items-center justify-center md:justify-end gap-4">
                    <?php foreach($socials as $social):
                        $icon = $social['icon'];
                        $url = $social['url'];
                    ?>
                        <a href="<?php echo $url ?>">
                            <img src="<?php echo $icon['url'] ?>" alt="Social Icon">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="sub-footer bg-[var(--dark-red)] mt-12 py-4">
        <div class="container mx-auto px-4">
            <p class="text-white text-center md:text-left">Copyright © <?php echo date('Y') ?> Oasis Loss Modelling Framework Ltd</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
