<!-- ACF Options -->
<?php
    $logo = get_field('logo', 'option');
    $address = get_field('company_address', 'option');
    $emails = get_field('company_emails', 'option');
    $social = get_field('social_media', 'option');
?>

<footer class="footer py-8 border-t border-[#999]">
    <div class="container mx-auto px-4 flex flex-col items-center justify-between md:flex-row">
        <div class="w-full md:max-w-[25%]">
            <!-- Logo -->
            <?php if($logo['url']): ?>
                <a href="<?php echo home_url() ?>">
                    <img class="w-full max-w-[275px]" src="<?php echo $logo['url'] ?>" alt="Logo">
                </a>
            <?php endif; ?>

            <!-- Company Address -->
            <?php if($address):
                echo $address;
            endif; ?>
        </div>
        <div class="w-full md:max-w-[50%]">
            <!-- Footer menu -->
            <div class="theme-main-menu">
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
        <div class="w-full md:max-w-[25%]">
            <!-- Email Adresses -->
            <?php foreach($emails as $email):
                $emailAddress = $email['email_address']    
            ?>
                <a href="mailto:<?php echo $emailAddress ?>">
                    <?php echo $emailAddress ?>
                </a>
            <?php endforeach; ?>

        </div>
    </div>
</footer>

<?php wp_footer(); ?>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/dist/app.js"></script>
</body>
</html>