<?php
    $blockTitle = get_field('block_title');
    $videoLibrary = get_field('video_library');
?>
<section class="latest-blogs pb-10 lg:pb-40 bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <?php if($blockTitle): ?>
            <div class="w-full flex flex-col items-start md:flex-row md:items-center justify-between">
                <h3 class="title-mark mb-10">
                    <?php echo $blockTitle ?>
                </h3>

                <a class="text-rm text-[var(--brand-red)] font-semibold mb-6 md:mb-0" target="_blank" href="https://www.youtube.com/@oasislossmodellingframewor5941">
                    Visit YouTube
                </a>
            </div>
        <?php endif; ?>

        <!-- Video Library Loop -->
        <?php if($videoLibrary): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <?php foreach ($videoLibrary as $video):
                    $videoTitle = $video['video_title'];
                    $videoLink = $video['video_link'];
                    $videoEmbed = $video['video_embed'];
                ?>
                    <article class="flex flex-col h-full">
                        <?php if($videoEmbed): ?>
                            <div class="embed-container rounded-[6px]">
                                <?php echo $videoEmbed ?>
                            </div>
                        <?php endif; ?>

                        <h5 class="text-xl font-semibold mt-3 mb-2">
                            <?php echo $videoTitle; ?>
                        </h5>

                        <a target="_blank" class="latest-blogs-rm mt-auto font-medium inline-block w-max pb-1 border-b border-[var(--brand-red)]" href="<?php echo $videoLink; ?>">
                            Watch on YouTube
                        </a>
                    </article> 
                <?php endforeach; ?>  
            </div>
        <?php endif; ?>
    </div>
</section>
