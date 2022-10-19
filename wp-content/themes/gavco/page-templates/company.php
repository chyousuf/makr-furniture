<?php
/*
    * Template Name: Company
    */
get_header();
    $id = get_the_ID();
    get_template_part( 'inc/page-banner' ); ?>
    <main id="main">
        <div class="block pb-4">
            <div class="container">
                <?php the_field('page_content'); ?>
            </div>
        </div>
        <section class="block p-0 tab-area">
            <div class="container d-flex d-lg-block">
                <nav class="mb-5 tab-nav d-none d-md-block">
                    <div class="nav nav-tabs d-flex justify-content-between" id="nav-tab" role="tablist">
                        <?php $count = 1;
                        if( have_rows('company_tabs') ):
                            while ( have_rows('company_tabs') ) : the_row(); ?>
                                <a class="nav-item nav-link <?php if($count == 1){echo 'active';} ?>"  data-toggle="tab" href="#<?php echo 'ctab'.$count; ?>" role="tab" ><?php the_sub_field('heading'); ?></a>
                            <?php $count++;
                            endwhile;
                        endif; ?>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <?php $count = 1;
                    if( have_rows('company_tabs') ):
                        while ( have_rows('company_tabs') ) : the_row(); ?>
                            <div class="tab-pane fade show <?php if($count == 1){echo 'active';} ?>" id="<?php echo 'ctab'.$count; ?>" role="tabpanel">
                                <a href="#" class="opener"><?php the_sub_field('heading'); ?></a>
                                <div class="data">
                                    <?php
                                        $tab_content = get_sub_field('content');
                                        if(!empty($tab_content)){echo $tab_content;}
                                        else{echo '<p><b>Coming soon</b></p>';}
                                    ?>
                                </div>
                            </div>
                        <?php $count++;
                        endwhile;
                    endif; ?>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>
