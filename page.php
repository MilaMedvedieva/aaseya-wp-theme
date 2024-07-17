<?php get_header(); ?>
    <?php
        $paralax_img = '';
        if (has_post_thumbnail()) {
            $paralax_img = '<div class="parallax-window" data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"></div>';
        }

        $is_show_testi= get_field('is_visible_testimonials');
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
                    <?php if (get_field('addition_title')) { ?>
                        <h1 class="paget-title"><?php the_field('addition_title'); ?></h1>
                    <?php } else { ?>
                        <h1 class="paget-title"><?php the_title(); ?></h1>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>

    <?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>

<?php get_footer(); ?>
