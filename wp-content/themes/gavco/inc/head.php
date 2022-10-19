<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php 
    $meta_title = '';
    $meta_description = '';
    $meta_keyword = '';
    $currentCat = get_queried_object();
    $pid = get_the_ID();
    if(is_product_category()){
        // $meta_title = get_field( 'meta_title',$currentCat);
        // $meta_description = get_field( 'meta_description',$currentCat);
        // $meta_keyword = get_field( 'meta_keyword',$currentCat);
        if ( !empty(get_field( 'meta_title',$currentCat)) ): ?>
        <?php $meta_title = get_field( 'meta_title',$currentCat); else: $meta_title = $currentCat->name; ?>
        <?php endif; ?>
        <title><?php echo $meta_title; ?></title>
        <?php if ( get_field( 'meta_description',$currentCat) ): ?>
            <?php $meta_description = get_field( 'meta_description',$currentCat); else: $meta_description = ''; ?>
        <?php endif; ?>
        <meta name="description" content="<?php echo $meta_description ?>">
        <?php if ( get_field( 'meta_keyword',$currentCat) ): ?>
            <?php $meta_keyword = get_field( 'meta_keyword',$currentCat); else: $meta_keyword = '' ?>
        <?php endif; ?>
        <meta name="keywords" content="<?php echo $meta_keyword; ?>">
        <?php if ( get_field( 'meta_box',$currentCat) ): ?>
            <?php the_field( 'meta_box',$currentCat); ?>
        <?php endif; ?>
        <?php if ( get_field( 'meta_open_graphs',$currentCat) ): ?>
            <?php the_field( 'meta_open_graphs',$currentCat); ?>
        <?php endif;
    } else {
        if(is_shop()){
            if ( !empty(get_field( 'meta_title',119 )) ): ?>
            <?php $meta_title = get_field( 'meta_title',119 ); else: $meta_title = get_the_title(119); ?>
            <?php endif; ?>
            <title><?php echo $meta_title; ?></title>
        <?php } else {
            if ( !empty(get_field( 'meta_title' )) ): ?>
                <?php $meta_title = get_field( 'meta_title' ); else: $meta_title = get_the_title(); ?>
            <?php endif; ?>
            <title><?php echo $meta_title; ?></title>
        <?php } 
        if ( get_field( 'meta_description' ) ): ?>
            <?php $meta_description = get_field( 'meta_description' ); else: $meta_description = ''; ?>
        <?php endif; ?>
        <meta name="description" content="<?php echo $meta_description ?>">
        <?php if ( get_field( 'meta_keyword' ) ): ?>
            <?php $meta_keyword = get_field( 'meta_keyword' ); else: $meta_keyword = '' ?>
        <?php endif; ?>
        <meta name="keywords" content="<?php echo $meta_keyword; ?>">
        <?php if ( get_field( 'meta_box' ) ): ?>
            <?php the_field( 'meta_box' ); ?>
        <?php endif; ?>
        <?php if ( get_field( 'meta_open_graphs' ) ): ?>
            <?php the_field( 'meta_open_graphs' ); ?>
        <?php endif;
    } ?>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="preload" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></noscript>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,900|Raleway:100,200,300,400,500,700|Big+Shoulders+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,900|Raleway:100,200,300,400,500,700|Big+Shoulders+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700&display=swap"></noscript>
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,900|Raleway:100,200,300,400,500,700|Big+Shoulders+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700&display=swap" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="<?php //bloginfo('template_url'); ?>/css/common.css"> -->
    <link rel="preload" href="<?php bloginfo('template_url'); ?>/css/common.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/common.css"></noscript>
    <?php if(is_front_page()){ ?>
        <link rel="preload" href="<?php bloginfo('template_url'); ?>/css/home.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/home.css"></noscript>
        <!-- <link rel="stylesheet" href="<?php //bloginfo('template_url'); ?>/css/home.css"> -->
    <?php } else {?>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/all.css">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/woocommerce-style.css">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/fancybox.css" />
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/fancybox-demo.css" />
    <?php }?>
    <?php wp_head(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167289970-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-167289970-1');
  </script> -->
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WSHLWNH');</script>
<!-- End Google Tag Manager -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-211427523-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-211427523-1');
</script>

<!-- Clarity tracking code for https://www.makr-furniture.com/ -->
<script>
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "92y066hdsd");
</script>

</head>