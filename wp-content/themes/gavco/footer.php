    <?php
        $logo = get_field('logo','options');
        $number = get_field('phone_number','options');
        $telnumber = preg_replace("/[^0-9]/", "", $number);
        $email = get_field('email','options');
        $fax = get_field('fax','options');
        $address = get_field('address','options');
        $facebook = get_field('facebook_link','options');
        $twitter = get_field('twiiter_link','options');
        $instagram = get_field('instagram_link','options');
        $pinterest = get_field('pinterest_link','options');
        $tumblr = get_field('tumblr_link','options');
        $linkedin = get_field('linkedin_link','options');
    ?>

    <footer id="footer">
        <!-- <div class="social">
            <div class="container">
                <ul class="w-100 d-flex justify-content-around">
                    <li class="col facebook"><a href="<?php //echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="col twitter"><a href="<?php //echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="col instagram"><a href="<?php //echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li class="col pinterest"><a href="<?php //echo $pinterest; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                    <li class="col tumblr"><a href="<?php //echo $tumblr; ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                </ul>
            </div>
        </div> -->
        <div class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3  mb-3">
                        <div class="logo">
                            <a href="<?php echo get_home_url(); ?>">
                                <?php if(is_search()){
                                    $logo_image1 = get_template_directory_uri().'/images/logo.png';
                                    $logo_image2 = get_template_directory_uri().'/images/inner-logo.png'; ?>
                                    <img src="<?php echo $logo_image2; ?>" width="166" height="82" alt="makr">
                                <?php } else { ?>
                                    <img src="<?php echo $logo; ?>" width="166" height="82" alt="makr">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="social-link mb-2">
                            <ul class="w-100 d-flex justify-content-around">
								<?php if(!empty($pinterest) && $pinterest != '#'){ ?>
                                	<li class="col pinterest pl-0"><a href="<?php echo $pinterest; ?>" target="_blank"><i class="fa fa-pinterest"></i><span class="d-none">Pinterest</span></a></li>
								<?php }
								if(!empty($twitter) && $twitter != '#'){ ?>
									<li class="col twitter pl-0"><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i><span class="d-none">Twitter</span></a></li>
								<?php }
                                if(!empty($linkedin) && $linkedin != '#'){ ?>
									<li class="col pinterest pl-0"><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i><span class="d-none">Linkedin</span></a></li>
								<?php }
                                if(!empty($facebook) && $facebook != '#'){ ?>
									<li class="col pinterest pl-0"><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i><span class="d-none">Facebook</span></a></li>
								<?php }
                                if(!empty($instagram) && $instagram != '#'){ ?>
									<li class="col pinterest pl-0"><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i><span class="d-none">instagram</span></a></li>
								<?php }
								if(!empty($tumblr) && $tumblr != '#'){ ?>
									<li class="col tumblr pl-0"><a href="<?php echo $tumblr; ?>" target="_blank"><i class="fa fa-tumblr"></i><span class="d-none">Tumbler</span></a></li>
								<?php } ?>
                            </ul>
                        </div>
                        <span class="copyright">&copy; Copyright <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?></span>
                        <span class="designby">Designed by: <a href="https://www.espinspire.com/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/espis.png" width="59" height="19" alt="https://www.espinspire.com/"></a></span>
                    </div>
                    <div class="col-6 col-lg-3 mb-3">
                        <h3>Categories</h3>
                        <?php
                            echo str_replace( '<li class="', '<li class="',
                                wp_nav_menu( array(
                                'container'       => false,
                                'theme_location' => 'categories',
                                'items_wrap'      => '<ul>%3$s</ul>',
                                'menu_class' => ''
                            )));
                        ?>
                    </div>
                    <div class="col-6 col-lg-2 mb-3">
                        <h3>Products</h3>
                        <?php
                            echo str_replace( '<li class="', '<li class="',
                                wp_nav_menu( array(
                                'container'       => false,
                                'theme_location' => 'products-menu',
                                'items_wrap'      => '<ul>%3$s</ul>',
                                'menu_class' => ''
                            )));
                        ?>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <h3>About Us</h3>
                        <!-- <address><?php echo $address; ?></address>
                        <dl><dt>Phone:</dt><dd><a href="tel:<?php echo $telnumber; ?>"><?php echo $number; ?></a></dd></dl>
                        <dl><dt>Fax:  </dt><dd><a href="#"><?php echo $fax; ?></a></dd></dl>
                        <dl><dt>Email:</dt><dd><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></dd></dl> -->
                        <?php
                            echo str_replace( '<li class="', '<li class="',
                                wp_nav_menu( array(
                                'container'       => false,
                                'theme_location' => 'about-menu',
                                'items_wrap'      => '<ul>%3$s</ul>',
                                'menu_class' => ''
                            )));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<?php get_template_part( 'inc/foot' ); ?>
