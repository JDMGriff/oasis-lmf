<?php
    $blockTitle = get_field('block_title');
    $videoLibrary = get_field('video_library');
    $links = get_field('links');
?>
<section class="latest-blogs py-10 lg:py-40 bg-[var(--off-white)]">
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

        <!-- Links -->
        <?php if($links): ?>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full lg:max-w-[80%] mt-10">
                <?php foreach($links as $link):
                    $linkItem = $link['link_item'];    
                ?>

                    <a class="bg-white rounded-[6px] p-8 flex items-center mb-4 transition-all duration-200 group hover:-translate-y-2 hover:shadow-md" target="_blank" href="<?php echo $linkItem['url'] ?>" class="flex items-center">
                        <img class="mr-6 max-w-[30px]" src="<?php echo get_template_directory_uri() ?>/dist/images/github-icon.svg" alt="GitHub Icon">

                        <h5 class="text-lg font-semibold">
                            <?php echo $linkItem['title'] ?>
                        </h5>

                        <svg class="ml-auto transition-all duration-200 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="15.724" height="10.305" viewBox="0 0 15.724 10.305">
                        <path id="Union_32" data-name="Union 32" d="M21.082,10.495a.765.765,0,0,1,0-1.084l3.065-3.065H11.775a.775.775,0,0,1,0-1.55H24.069L21.075,1.737a.789.789,0,0,1,0-1.1.746.746,0,0,1,1.072,0L26.417,5a.688.688,0,0,1,.083.072.767.767,0,0,1,0,1.084L22.165,10.5a.767.767,0,0,1-1.084,0Z" transform="translate(-11 -0.414)" fill="#d9272d"/>
                        </svg>
                    </a>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
