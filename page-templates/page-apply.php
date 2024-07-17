<?php /* Template Name: Apply page */ ?>
<?php get_header(); ?>
    <?php
        $is_show_testi= get_field('is_visible_testimonials');
        $paralax_img = '';
        if (has_post_thumbnail()) {
            $paralax_img = '<div class="parallax-window" data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"></div>';
        }

       $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       $url_components = parse_url($actual_link);
       parse_str($url_components['query'], $params);


    ?>
    <section class="paget">
        <?php echo $paralax_img; ?>
        <div class="paget-inner">
            <div class="paget-top">
                <div class="container">
                    <?php the_crumbs(); ?>
                </div>
            </div>
            <div class="paget-bottom">
                <div class="container">
                    <h1 class="paget-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pageb contpage-pageb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (!empty($params['job'])) { ?>
                        <p class="pageb-title title title-2" data-job-title="<?php echo get_the_title($params['job']); ?>">Apply for ‘<?php echo get_the_title($params['job']); ?>’</p>
                    <?php } else { ?>
                        <p class="pageb-title title title-2"><?php the_title(); ?></p>
                    <?php } ?>
                </div>
                <div class="offset-xl-3 col-xl-9">
                    <div class="contpage-form form">
                        <?php echo do_shortcode('[contact-form-7 id="684" title="Apply Form"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>


<?php get_footer(); ?>
