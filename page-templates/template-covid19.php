<?php
/*
    * Template Name: Covid19 template
    */
get_header();
get_template_part( 'inc/page-banner' ); ?>
<main id="main" class="bg">
    <div class="block options">
        <div class="container text-center">
            <?php the_field('page_content'); ?>
        </div>
        <div class="wrap">
	        <?php if( have_rows('sanitization_banners') ):
	            while ( have_rows('sanitization_banners') ) : the_row(); ?>
	            	<div class="block text-center d-inline-block">
	                    <img src="<?php the_sub_field('sanitization_banner_image'); ?>" class="img-fluid" alt="Image">
	                    <div class="head-outer">
	                    	<div class="head">
	                        	<?php the_sub_field('banner_image_caption'); ?>
	                        </div>
	                    </div>
	                </div>
	            <?php endwhile;
	        endif; ?>
	    </div>
    </div>
</main>
<style type="text/css">
	.wrap .block{
	position: relative;
	padding: 0;
	margin-bottom: 30px;
}
.wrap .block:hover{color: #585858;}
.head-outer{
	position: absolute;
	left: 0;
	right: 0;
	top: 0;
	z-index: 999;
	padding: 50px 0;
	background:#fff;
}
.head-outer .subtext{
	font-size: 24px;
	font-weight: 300;
}
.block .head-outer .subtitle{
	text-transform: uppercase;
	display: block;
}
.block:nth-child(odd) .head-outer{
	background: none;
}
.block:nth-child(odd) .head-outer .subtitle{margin-bottom: 35px;}
.block:nth-child(odd) .head-outer h2, .block:nth-child(odd) .head-outer .subtext, .block:nth-child(odd) .head-outer .subtitle{
	color: #fff;
}
.block:nth-child(odd) .head-outer .head{
	background: rgba(0,0,0,0.44);
	display: inline-block;
	padding: 40px 220px;
}
@media screen and (max-width:1199px){
	.head-outer .subtext{font-size: 20px;}
	.head-outer{padding: 15px 0;}
}
@media screen and (max-width:991px){
	.wrap .block{margin-bottom: 15px;}
	.block .subtitle, .head-outer .subtext{font-size: 16px;}
	.block h2{font-size: 25px;}
	.block:nth-child(2n+1) .head-outer .subtitle{margin-bottom: 20px;}
	.block:nth-child(2n+1) .head-outer .head{
		padding: 20px 60px;
	}
}
@media only screen and (max-width:767px){
	.head-outer{
		position: static;
	}
	.block:nth-child(2n+1) .head-outer h2, .block:nth-child(2n+1) .head-outer .subtext, .block:nth-child(2n+1) .head-outer .subtitle{
		color: #585858;
	}
	.block:nth-child(2n+1) .head-outer .head{
		background: none;
		padding: 0;
	}
} 
</style>
<?php get_footer(); ?>