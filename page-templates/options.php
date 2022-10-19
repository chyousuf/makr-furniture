<?php
/*
    * Template Name: Options
    */
get_header();
get_template_part( 'inc/page-banner' ); ?>
<style>
	.logos .inner{
	padding: 46px;
	box-shadow: 0 0 20px rgba(0,0,0,0.1);
	height:calc(100% - 30px);
	margin: 0 0 30px;
	display: flex;
	flex-direction: column;
	justify-content: center;

}
</style>
<main id="main" class="bg">
    <div class="block options">
        <div class="container text-center">
            <a href="#main" id="back-top" class="d-none"><i class="fa fa-arrow-up"></i></a>
            <!-- <h2 class="d-block mb-4">Jump To</h2>
            <i class="fa fa-arrow-down" style="font-size: 25px;"></i> -->
            <div class="options-page-tabs">
                <a class="nav-link btn btn-primary" href="#finishes">Finishes</a>
                <a class="nav-link btn btn-primary" href="#textiles">Textiles</a>
                <a class="nav-link btn btn-primary" href="#pulls">Pulls</a>
                <a class="nav-link btn btn-primary" href="#legs">Legs</a>
                <a class="nav-link btn btn-primary" href="#edges">Edges</a>
                <!-- <a class="nav-link btn btn-primary" href="#grommets">Grommets</a> -->
            </div>
            <h2 id="finishes">FINISHES</h2>
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#finishes-standard" role="tab">TFL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finishes-premium" role="tab">HPL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#mirlux" role="tab">MIRLUX</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pet" role="tab">PET</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finix" role="tab">Fenix</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#butcher" role="tab">Wood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#solid-surface" role="tab">Solid Surface</a>
                </li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent2">
                <div class="tab-pane fade show active" id="finishes-standard" role="tabpanel">
                    <p><?php the_field('standard_finish_content'); ?></p>
                    <div class="row products-list thumb-list">
                        <?php if( have_rows('standard_finishes') ):
                            while ( have_rows('standard_finishes') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery1]" title="<?php the_sub_field('standard_finish_name'); ?>" href="<?php the_sub_field('standard_finish_image'); ?>"><img src="<?php the_sub_field('standard_finish_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('standard_finish_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="finishes-premium" role="tabpanel">
                    <p><?php the_field('premium_finish_content'); ?></p>
                    <div class="row products-list thumb-list">
                        <?php if( have_rows('premium_finishes') ):
                            while ( have_rows('premium_finishes') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery2]" title="<?php the_sub_field('premium_finish_name'); ?>" href="<?php the_sub_field('premium_finish_image'); ?>"><img src="<?php the_sub_field('premium_finish_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('premium_finish_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                    <p class="text-left"><small><?php the_field('finishes_content'); ?></small></p>
                </div>
                <div class="tab-pane fade" id="mirlux" role="tabpanel">
                    <p><?php the_field('mirlux_content'); ?></p>
                    <img src="<?php the_field('mirlux_banner'); ?>" class="img-fluid mb-5" alt="">
                    <?php if( have_rows('mirlux_finishes') ): ?>
                        <div class="row products-list mb-5 thumb-list">
                            <?php while ( have_rows('mirlux_finishes') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery3]" title="<?php the_sub_field('mirlux_finishes_name'); ?>" href="<?php the_sub_field('mirlux_finishes_image'); ?>"><img src="<?php the_sub_field('mirlux_finishes_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('mirlux_finishes_name'); ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php if( have_rows('mirlux_colors') ): ?>
                        <div class="row products-list thumb-list">
                            <?php while ( have_rows('mirlux_colors') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery4]" title="<?php the_sub_field('mixlux_finishe_color'); ?>" href="<?php the_sub_field('mixlux_finishe_image'); ?>"><img src="<?php the_sub_field('mixlux_finishe_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('mixlux_finishe_color'); ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="pet" role="tabpanel">
                    <p><?php the_field('pet_content'); ?></p>
                    <img src="<?php the_field('pet_banner'); ?>" class="img-fluid mb-5" alt="">
                    <?php if( have_rows('PET_finishes') ): ?>    
                        <div class="row products-list mb-5 thumb-list">
                            <?php while ( have_rows('PET_finishes') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery3]" title="<?php the_sub_field('pet_finishes_name'); ?>" href="<?php the_sub_field('pet_finishes_image'); ?>"><img src="<?php the_sub_field('pet_finishes_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('pet_finishes_name'); ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <div class="row products-list thumb-list">
                        <?php if( have_rows('pet_colors') ):
                            while ( have_rows('pet_colors') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery4]" title="<?php the_sub_field('pet_finishe_color'); ?>" href="<?php the_sub_field('pet_finishe_image'); ?>"><img src="<?php the_sub_field('pet_finishe_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('pet_finishe_color'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="finix" role="tabpanel">
                    <p><?php the_field('fenix_content'); ?></p>
                    <img src="<?php the_field('fenix_banner'); ?>" class="img-fluid mb-5" alt="">
                    <div class="row products-list mb-5 thumb-list">
                        <?php if( have_rows('fenix_finishes') ):
                            while ( have_rows('fenix_finishes') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- <div class="image-holder"><img src="<?php the_sub_field('fenix_finishes_image'); ?>" class="img-fluid" alt=""></div>
                                    <span class="title"><?php the_sub_field('fenix_finishes_name'); ?></span> -->
                                    <a class="image-holder" rel="lightbox[gallery3]" title="<?php the_sub_field('fenix_finishes_name'); ?>" href="<?php the_sub_field('fenix_finishes_image'); ?>"><img src="<?php the_sub_field('fenix_finishes_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('fenix_finishes_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                    <div class="row products-list thumb-list">
                        <?php if( have_rows('fenix_finishes_colors') ):
                            while ( have_rows('fenix_finishes_colors') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery4]" title="<?php the_sub_field('fenix_finishe_color'); ?>" href="<?php the_sub_field('fenix_finishe_image'); ?>"><img src="<?php the_sub_field('fenix_finishe_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('fenix_finishe_color'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="butcher" role="tabpanel">
                    <p><?php the_field('butcher_block_content'); ?></p>
                    <img src="<?php the_field('butcher_block_banner'); ?>" class="img-fluid mb-5" alt="">
                    <p><?php the_field('wood_block_content2'); ?></p>
                    <p><?php the_field('wood_block_content3'); ?></p>
                    <img src="<?php the_field('wood_block_banner3'); ?>" class="img-fluid mb-5" alt="">
                    <div class="row products-list mb-5 thumb-list">
                        <?php if( have_rows('butcher_block_colors') ):
                            while ( have_rows('butcher_block_colors') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery5]" title="<?php the_sub_field('butcher_block_color_name'); ?>" href="<?php the_sub_field('butcher_block_color_image'); ?>"><img src="<?php the_sub_field('butcher_block_color_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('butcher_block_color_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="solid-surface" role="tabpanel">
                    <p><?php the_field('solid_surface_content'); ?></p>
                    <img src="<?php the_field('solid_surface_banner'); ?>" class="img-fluid mb-5" alt="">
                    <div class="row products-list mb-5 thumb-list">
                        <?php if( have_rows('solid_surface_finishes') ):
                            while ( have_rows('solid_surface_finishes') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery7]" title="<?php the_sub_field('solid_surface_name'); ?>" href="<?php the_sub_field('solid_surface_image'); ?>"><img src="<?php the_sub_field('solid_surface_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('solid_surface_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                    <div class="row products-list thumb-list">
                        <?php if( have_rows('solid_surface_colors') ):
                            while ( have_rows('solid_surface_colors') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery8]" title="<?php the_sub_field('solid_surface_color_name'); ?>" href="<?php the_sub_field('solid_surface_color_image'); ?>"><img src="<?php the_sub_field('solid_surface_color_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('solid_surface_color_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
            </div>
            <?php the_field('textiles_content'); ?>
            <div class="row products-list mb-5 thumb-list">
                <ul class="nav nav-tabs w-100" id="myTab-textile" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#textile-standard" role="tab">STANDARD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#textile-premium" role="tab">PREMIUM</a>
                    </li>
                </ul>
                <div class="tab-content mb-5 w-100" id="myTabContent">
                    <div class="tab-pane fade show active w-100" id="textile-standard" role="tabpanel">
                        <?php if( have_rows('textiles') ): ?>
                            <div class="row products-list thumb-list">
                                <?php while ( have_rows('textiles') ) : the_row(); ?>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <a class="image-holder" rel="lightbox[gallery9]" title="<?php the_sub_field('textile_name'); ?>" href="<?php the_sub_field('textile_image'); ?>"><img src="<?php the_sub_field('textile_image'); ?>" class="img-fluid" alt=""></a>
                                        <span class="title"><?php the_sub_field('textile_name'); ?></span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane fade w-100" id="textile-premium" role="tabpanel">
                        <?php if( have_rows('textiles_premium') ): ?>
                            <div class="row products-list thumb-list">
                                <?php while ( have_rows('textiles_premium') ) : the_row(); ?>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <a class="image-holder" rel="lightbox[gallery99]" title="<?php the_sub_field('textile_name'); ?>" href="<?php the_sub_field('textile_image'); ?>"><img src="<?php the_sub_field('textile_image'); ?>" class="img-fluid" alt=""></a>
                                        <span class="title"><?php the_sub_field('textile_name'); ?></span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php the_field('options_content'); ?>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#pulls-standard" role="tab">STANDARD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pulls-premium" role="tab">PREMIUM</a>
                </li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="pulls-standard" role="tabpanel">
                    <div class="row products-list thumb-list">
                        <?php if( have_rows('standard_pulls') ):
                            while ( have_rows('standard_pulls') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                	<a class="image-holder" rel="lightbox[gallery10]" title="<?php the_sub_field('standard_pull_name'); ?>" href="<?php the_sub_field('standard_pull_image'); ?>"><img src="<?php the_sub_field('standard_pull_image'); ?>" class="img-fluid" alt=""></a>
                            		<span class="title"><?php the_sub_field('standard_pull_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="pulls-premium" role="tabpanel">
                    <div class="row products-list thumb-list">
                        <?php if( have_rows('premium_pulls') ):
                            while ( have_rows('premium_pulls') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery10]" title="<?php the_sub_field('premium_pulls_name'); ?>" href="<?php the_sub_field('premium_pulls_image'); ?>"><img src="<?php the_sub_field('premium_pulls_image'); ?>" class="img-fluid" alt=""></a>
                            		<span class="title"><?php the_sub_field('premium_pulls_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                    <p class="text-left"><small><?php the_field('pulls_content'); ?></small></p>
                </div>
            </div>
            <h2 id="legs">Legs</h2>
            <p class="text-center"><?php the_field('leg_content'); ?></p>
            <ul class="nav nav-tabs" id="myTab5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#bases" role="tab">Bases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#legs1" role="tab">Legs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#frames" role="tab">Frames</a>
                </li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent5">
                <div class="tab-pane fade" id="bases" role="tabpanel">
                    <div class="row products-list mb-5 thumb-list">
                        <?php if( have_rows('bases') ):
                            while ( have_rows('bases') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery11]" title="<?php the_sub_field('Bases_name'); ?>" href="<?php the_sub_field('Bases_image'); ?>"><img src="<?php the_sub_field('Bases_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('Bases_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="legs1" role="tabpanel">
                    <div class="row products-list mb-5 thumb-list">
                        <?php if( have_rows('legs') ):
                            while ( have_rows('legs') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery11]" title="<?php the_sub_field('leg_name'); ?>" href="<?php the_sub_field('leg_image'); ?>"><img src="<?php the_sub_field('leg_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('leg_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="frames" role="tabpanel">
                    <div class="row products-list mb-5 thumb-list">
                        <?php if( have_rows('frames') ):
                            while ( have_rows('frames') ) : the_row(); ?>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a class="image-holder" rel="lightbox[gallery11]" title="<?php the_sub_field('frames_name'); ?>" href="<?php the_sub_field('frames_image'); ?>"><img src="<?php the_sub_field('frames_image'); ?>" class="img-fluid" alt=""></a>
                                    <span class="title"><?php the_sub_field('frames_name'); ?></span>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
            </div>
            <?php
            if( !have_rows('casters') ):
                if(!empty(get_field('casters_content'))){ ?>
                    <h2>Casters</h2>
                    <p class="text-center"><?php the_field('casters_content'); ?></p>
                <?php }
            endif;
            if( have_rows('casters') ): ?>
                <h2>Casters</h2>
                <p class="text-center"><?php the_field('casters_content'); ?></p>
                <div class="row products-list mb-5 thumb-list">
                    <?php while ( have_rows('casters') ) : the_row(); ?>
                        <div class="col-lg-3 col-md-6 col-12">
                            <a class="image-holder" rel="lightbox[gallery12]" title="<?php the_sub_field('caster_name'); ?>" href="<?php the_sub_field('caster_image'); ?>"><img src="<?php the_sub_field('caster_image'); ?>" class="img-fluid" alt=""></a>
                            <span class="title"><?php the_sub_field('caster_name'); ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <p class="text-center"><?php the_field('edges_content'); ?></p>
            <div class="row products-list mb-5 thumb-list">
                <?php if( have_rows('edges') ):
                    while ( have_rows('edges') ) : the_row(); ?>
                        <div class="col-lg-3 col-md-6 col-12">
                            <a class="image-holder" rel="lightbox[gallery12]" title="<?php the_sub_field('edge_name'); ?>" href="<?php the_sub_field('edge_image'); ?>"><img src="<?php the_sub_field('edge_image'); ?>" class="img-fluid" alt=""></a>
                            <span class="title"><?php the_sub_field('edge_name'); ?></span>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
            <?php //the_field('grommet_content') ?>
        </div>
    </main>

<?php get_footer(); ?>