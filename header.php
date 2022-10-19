<?php
    get_template_part( 'inc/head' );
    $logo = get_field('logo','options');
    $logo_white = get_field('white_logo','options');
    //$number = get_field('phone_number','options');
    //$telnumber = preg_replace("/[^0-9]/", "", $number);
?>
<body <?php if(is_front_page()){echo 'class="home"'; }else {echo 'class="'.body_class().'"';}?> >
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WSHLWNH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PDH236PTSL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PDH236PTSL');
</script>
    <div id="wrapper">
        <div class="top-bar">
            Don't worry you're in the right place! Gavco is now Makr Furniture
            <a href="#" id="topbar-close" class="d-inline-block"><img src="<?php bloginfo('template_url'); ?>/images/cancel.png" width="25" height="25" class="img-fluid" alt=""></a>
        </div>
        <header id="header" class="header fixed">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="header-bar">
                        <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                            <?php
                            if(is_search()){
                                $logo_image1 = get_template_directory_uri().'/images/logo.png';
                                $logo_image2 = get_template_directory_uri().'/images/inner-logo.png'; ?>
                                <img src="<?php echo $logo_image2; ?>" class="onwhite" width="125" height="62" alt="makr">
                            <?php } else { ?>
                                <img src="<?php echo $logo; ?>" width="125" height="62" class="onwhite" alt="makr">
                            <?php } ?>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupported1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupported1">
                        <?php
                            echo str_replace( '<li class="', '<li class="',
                                wp_nav_menu( array(
                                'container'       => false,
                                'theme_location' => 'header',
                                'items_wrap'      => '<ul class="navbar-nav m-auto nav" id="nav">%3$s</ul>',
                                'menu_class' => ''
                            )));
                        ?>
                    </div>
                    <form action="<?php echo esc_url(home_url('/')); ?>" class="search-form" method="get">
                        <a href="#" class="search-opner"><i class="icon-search"></i></a>
                        <div class="field">
                            <input placeholder="Search Product" name="s" class="input" type="search">
                            <button aria-label="submit" type="submit"><i class="icon-search"></i><span class="d-none">submit</span></button>
                        </div>
                    </form>
                    <a href="<?php echo get_page_link(25); ?>" class="btn btn-primary d-none d-md-inline-block">Contact Us</a>
                </nav>
            </div>
        </header>
<?php 
$_SESSION['attribute_grommet_color_price1'] = get_field('grommet_color_price','options'); 
$_SESSION['attribute_finish_price1'] = get_field('premium_finish','options'); 
$_SESSION['attribute_pedestal_price1'] = get_field('pedestal_price','options'); 
?>