<?php
    $blockTitle = get_field('block_title');
    $links = get_field('links');
?>
<section class="latest-blogs pb-10 lg:pb-40 bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <?php if($blockTitle): ?>
            <h3 class="title-mark mb-10">
                <?php echo $blockTitle ?>
            </h3>
        <?php endif; ?>

        <!-- Links -->
        <?php if($links): ?>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full mt-10">
                <?php foreach($links as $link):
                    $linkTitle = $link['link_title'];
                    $linkDesc = $link['link_description'];
                    $linkUrl = $link['link_url']['url'];
                ?>

                    <a class="bg-white rounded-[6px] p-8 flex items-center mb-4 transition-all duration-200 group hover:-translate-y-2 hover:shadow-md" target="_blank" href="<?php echo $linkUrl ?>" class="flex items-center">
                        <div class="">
                            <h5 class="text-lg font-semibold">
                                <?php echo $linkTitle ?>
                            </h5>
                            <span>
                                <?php echo $linkDesc ?>
                            </span>
                        </div>

                        <svg class="ml-auto flex-shrink-0 transition-all duration-200 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="15.724" height="10.305" viewBox="0 0 15.724 10.305">
                        <path id="Union_32" data-name="Union 32" d="M21.082,10.495a.765.765,0,0,1,0-1.084l3.065-3.065H11.775a.775.775,0,0,1,0-1.55H24.069L21.075,1.737a.789.789,0,0,1,0-1.1.746.746,0,0,1,1.072,0L26.417,5a.688.688,0,0,1,.083.072.767.767,0,0,1,0,1.084L22.165,10.5a.767.767,0,0,1-1.084,0Z" transform="translate(-11 -0.414)" fill="#d9272d"/>
                        </svg>
                    </a>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
