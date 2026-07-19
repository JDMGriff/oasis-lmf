<?php
$blockTitle = get_field('block_title');
$coreComponentTitle = get_field('core_components_title');
$coreComponents = get_field('core_components');
$devSupportTitle = get_field('dev_support_title');
$devSupportLinks = get_field('dev_support_links');
?>

<section class="py-10 lg:py-40 bg-cover bg-center bg-[var(--off-white)]">
    <div class="container px-4 mx-auto">
        <?php if($blockTitle): ?>
            <h3 class="title-mark mb-10">
                <?php echo $blockTitle ?>
            </h3>
        <?php endif; ?>

        <div class="grid gap-8 lg:gap-32 grid-cols-1 lg:grid-cols-2">
            <!-- Core Components -->
            <?php if($coreComponents):?>
                <div>
                    <h4 class="text-[var(--off-black-light)] mb-4">
                        <?php echo $coreComponentTitle ?>
                    </h4>
                    <div class="flex flex-col">
                        <?php foreach ($coreComponents as $component):
                            $link = $component['link'];
                        ?>
    
                            <a class="bg-white rounded-[6px] p-8 flex items-center mb-4 transition-all duration-200 group hover:-translate-y-2 hover:shadow-md" target="_blank" href="<?php echo $link['url'] ?>" class="flex items-center">
                                <img class="mr-6" src="<?php echo get_template_directory_uri() ?>/dist/images/core-component-icon.svg" alt="Core Component Icon">
    
                                <h5 class="text-lg font-semibold">
                                    <?php echo $link['title'] ?>
                                </h5>
    
                                <svg class="ml-auto transition-all duration-200 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="15.724" height="10.305" viewBox="0 0 15.724 10.305">
                                <path id="Union_32" data-name="Union 32" d="M21.082,10.495a.765.765,0,0,1,0-1.084l3.065-3.065H11.775a.775.775,0,0,1,0-1.55H24.069L21.075,1.737a.789.789,0,0,1,0-1.1.746.746,0,0,1,1.072,0L26.417,5a.688.688,0,0,1,.083.072.767.767,0,0,1,0,1.084L22.165,10.5a.767.767,0,0,1-1.084,0Z" transform="translate(-11 -0.414)" fill="#d9272d"/>
                                </svg>
                            </a>
    
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Core Components -->
            <?php if($devSupportLinks): ?>
                <div>
                    <h4 class="text-[var(--off-black-light)] mb-4">
                        <?php echo $devSupportTitle ?>
                    </h4>                
                    <div class="flex flex-col">
                        <?php foreach ($devSupportLinks as $devLink):
                            $link = $devLink['link'];
                        ?>
    
                            <a class="bg-white rounded-[6px] p-8 flex items-center mb-4 transition-all duration-200 group hover:-translate-y-2 hover:shadow-md" target="_blank" href="<?php echo $link['url'] ?>" class="flex items-center">
                                <img class="mr-6" src="<?php echo get_template_directory_uri() ?>/dist/images/dev-support-icon.svg" alt="Dev Suppport Icon">
    
                                <h5 class="text-lg font-semibold">
                                    <?php echo $link['title'] ?>
                                </h5>
    
                                <svg class="ml-auto transition-all duration-200 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="15.724" height="10.305" viewBox="0 0 15.724 10.305">
                                <path id="Union_32" data-name="Union 32" d="M21.082,10.495a.765.765,0,0,1,0-1.084l3.065-3.065H11.775a.775.775,0,0,1,0-1.55H24.069L21.075,1.737a.789.789,0,0,1,0-1.1.746.746,0,0,1,1.072,0L26.417,5a.688.688,0,0,1,.083.072.767.767,0,0,1,0,1.084L22.165,10.5a.767.767,0,0,1-1.084,0Z" transform="translate(-11 -0.414)" fill="#d9272d"/>
                                </svg>
                            </a>
    
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>