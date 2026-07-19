<?php
    $contactsTitle = get_field('contacts_title');
    $contactInfo = get_field('contact_info');
    $keyContactsTitle = get_field('key_contacts_title');
    $keyContacts = get_field('key_contacts');
    $followsUsTitle = get_field('follow_us_title');
    $followLinks = get_field('follow_links');
?>

<section class="bg-[var(--off-white)]">
    <div class="container mx-auto py-20 px-4 border-t border-[#707070/25]">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-32">
            <!-- Contact Details -->
            <div class="flex flex-col">
                <h3 class="title-mark mb-4">
                    <?php echo $contactsTitle ?>
                </h3>
                <span class="contact-information">
                    <?php echo $contactInfo ?>
                </span>
            </div>
            <!-- Key Contacts & Follow -->
            <div class="flex flex-col">
                <h3 class="title-mark mb-4">
                    <?php echo $keyContactsTitle ?>
                </h3>
                <?php foreach($keyContacts as $keyContact):
                    $name = $keyContact['name'];
                    $position = $keyContact['position'];
                    $email = $keyContact['email'];
                ?>
                    <p>
                        <strong><?php echo $name ?></strong>,
                        <?php echo $position ?>
                    </p>
                    <a class="text-[var(--brand-red)] mb-4" href="mailto:<?php echo $email ?>">
                        <?php echo $email ?>
                    </a>
                <?php endforeach; ?>
                <h3 class="title-mark mt-6 mb-4">
                    <?php echo $followsUsTitle ?>
                </h3>
                <div class="flex items-center gap-4">
                    <?php foreach($followLinks as $followLink):
                        $link = $followLink['link'];
                    ?>
                        <?php if($link): ?>
                            <a class="bg-[var(--brand-red)] text-white font-semibold px-6 py-4 w-max rounded-[4px]" href="<?php echo $link['url'] ?>">
                                <?php echo $link['title'] ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>                
                </div>
            </div>
        </div>
    </div>
</section>
