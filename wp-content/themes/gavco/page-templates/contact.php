<?php
/*
    * Template Name: Contact
    */
get_header();
    $id = get_the_ID();
    $number = get_field('phone_number','options');
    $telnumber = preg_replace("/[^0-9]/", "", $number);
    $email = get_field('email','options');
    $fax = get_field('fax','options');
    $address = get_field('address','options');
    get_template_part( 'inc/page-banner' ); ?>
    <main id="main">
        <div class="block contact-block">
            <div class="container">
                <div class="row contact-info">
                    <div class="col-lg-3 col-md-6 col-12 box">
                        <h3>Contact <br> Details:</h3>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 box">
                        <h4><span>Location</span></h4>
                        <address><b><?php echo get_bloginfo( 'name' ); ?></b><br> <?php echo $address; ?></address>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 box">
                        <h4><span>Phone</span></h4>
                        <ul>
                            <li><span>Phone:</span><a href="tel:<?php echo $telnumber; ?>"><?php echo $number; ?></a></li>
                            <li><span>Fax:  </span><a href="#"><?php echo $fax; ?></a></li>
                            <li><span>Email:</span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 box">
                        <?php the_field('timing','options'); ?>
                    </div>
                </div>
                <div class="map">
                    <?php the_field('map','options'); ?>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <h3>Get in Touch:</h3>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12 contact-form">
                        <?php echo do_shortcode('[contact-form-7 id="105" title="contact form"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>
