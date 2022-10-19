<div class="slideshow">
    <div class="slideset">
        <?php if (have_rows('banner', 29)) :
            while (have_rows('banner', 29)) : the_row(); ?>
                <div class="slide">
                    <?php
                    $banner_video_link1 = get_sub_field('banner_video_link');
                    preg_match('/src="(.+?)"/', $banner_video_link1, $matches);
                    $banner_video_link = $matches[1];
                    if (!empty($banner_video_link)) { ?>
                        <style type="text/css">
                            .product-banner-video iframe {
                                width: 100%;
                                /*height: 546px;*/
                                border: none;
                            }

                            .iframe-outer {
                                /*height: 600px;*/
                                overflow: hidden;
                            }

                            /*@media only screen and (min-width:1399px){
                                .iframe-outer{
                                    height: 750px;
                                }
                            }
                            @media only screen and (min-width:768px) and (max-width:1199px){
                                .iframe-outer{
                                    height: 380px;
                                }
                            }*/
                            /*@media only screen and (max-width:767px){
                               .iframe-outer{
                                    height: 250px;
                                } 
                            } */
                        </style>
                        <div class="iframe-outer">
                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?php echo $banner_video_link; ?>&autoplay=1&loop=1&autopause=0&muted=1&controls=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>
                            <script src="https://player.vimeo.com/api/player.js"></script>
                        </div>

                        <!-- <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?php //echo $banner_video_link; 
                                                                                                ?>&autoplay=1&loop=1&autopause=0&muted=1&controls=0" frameborder="0" allow="autoplay"></iframe></div> -->
                    <?php } else {
                        $image = get_sub_field('banner_image');
                        $mobile = 'medium';
                        $tablet = 'large';
                        $full = 'full';
                    ?>
                        <picture>
                            <source srcset="<?php echo wp_get_attachment_image_url($image['ID'], $mobile); ?>" width="640" height="275" media="(max-width: 767px)">
                            <source srcset="<?php echo wp_get_attachment_image_url($image['ID'], $tablet); ?>" media="(max-width: 1024px)">
                            <img src="<?php echo wp_get_attachment_image_url($image['ID'], $full); ?>" alt="image description">
                        </picture>
                    <?php } ?>
                    <!-- <img src="<?php //the_sub_field('banner_image'); 
                                    ?>" alt="Image Here"> -->
                    <div class="caption container">
                        <div class="inner">
                            <?php the_sub_field('caption'); ?>
                        </div>
                    </div>
                </div>
        <?php endwhile;
        endif; ?>
    </div>
    <!-- <div class="pagination container justify-content-end"></div> -->
    <div class="arrows justify-content-between">
        <a href="#" class="btn-prev"><img src="<?php bloginfo('template_url'); ?>/images/left-arrow.png" width="35" height="35" class="img-fluid" alt=""></a>
        <a href="#" class="btn-next"><img src="<?php bloginfo('template_url'); ?>/images/right-arrow.png" width="35" height="35" class="img-fluid" alt=""></a>
    </div>
</div>