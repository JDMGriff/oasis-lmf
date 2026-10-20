<?php
    $title = get_field('title');
    $introCopy = get_field('intro_copy');
    $boardMembers = get_field('board_members');
    $teamContacts = get_field('team_contacts');
    $contactsTitle = get_field('contacts_title');
    $blockId = sanitize_html_class($block['id'] ?? uniqid('board-members-'));
?>
<?php if($boardMembers): ?>
<section class="py-20 bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <h3 class="title-mark mb-4">
            <?php echo $title ?>
        </h3>

        <div class="mt-6 mb-10">
            <?php echo $introCopy ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($boardMembers as $memberIndex => $member):
                $memberId = $member->ID;
                $position = get_field('position', $memberId);
                $aboutMember = get_field('about_member', $memberId);
                $memberBioId = sprintf('member-bio-%s-board-%d-%d', $blockId, $memberIndex, $memberId);
            ?>
            <div class="flex flex-col h-full text-center">
                    <?php if (has_post_thumbnail($memberId)) : ?>
                        <?php echo get_the_post_thumbnail($memberId, 'full', [ 'class' => 'board-member-headshot mx-auto' ]); ?>
                    <?php endif; ?>

                <h5 class="text-xl font-semibold mt-4 mb-2">
                    <?php echo get_the_title($memberId); ?>
                </h5>

                <div class="text-[var(--brand-red)] mb-2 font-semibold">
                    <?php echo $position; ?>
                </div>

                <div id="<?php echo esc_attr($memberBioId); ?>" class="member-bio mb-4">
                    <?php echo $aboutMember; ?>
                </div>

                <button class="member-bio-trigger text-[var(--brand-red)] font-medium pb-1" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($memberBioId); ?>">
                    Read More
                </button>
            </div>
            <?php endforeach; ?>
        </div>   
        
        <?php if($teamContacts): ?>
            <h3 class="title-mark mt-20 mb-10">
                <?php echo $contactsTitle ?>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach($teamContacts as $contactIndex => $contact):
                    $contactId = $contact->ID;
                    $position = get_field('position', $contactId);
                    $aboutMember = get_field('about_member', $contactId);
                    $contactBioId = sprintf('member-bio-%s-contact-%d-%d', $blockId, $contactIndex, $contactId);
                ?>
                <div class="flex flex-col h-full text-center">
                        <?php if (has_post_thumbnail($contactId)) : ?>
                            <?php echo get_the_post_thumbnail($contactId, 'full', [ 'class' => 'board-member-headshot mx-auto' ]); ?>
                        <?php endif; ?>

                    <h5 class="text-xl font-semibold mt-4 mb-2">
                        <?php echo get_the_title($contactId); ?>
                    </h5>

                    <div class="text-[var(--brand-red)] mb-2 font-semibold">
                        <?php echo $position; ?>
                    </div>

                    <div id="<?php echo esc_attr($contactBioId); ?>" class="member-bio mb-4">
                        <?php echo $aboutMember; ?>
                    </div>

                    <button class="member-bio-trigger text-[var(--brand-red)] font-medium pb-1" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($contactBioId); ?>">
                        Read More
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>     
    </div>
</section>
<?php endif; ?>
