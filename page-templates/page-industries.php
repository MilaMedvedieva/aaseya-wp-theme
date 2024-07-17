<?php /* Template Name: Industries page */ ?>
<?php get_header(); ?>
    <?php
        $is_show_testi = get_field('is_visible_testimonials');
        $paralax_img = '';
        if (has_post_thumbnail()) {
            $paralax_img = '<div class="parallax-window" data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"></div>';
        }

        $imagelogoaward = get_field('imagelogoaward');
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


    <?php if (isset($imagelogoaward) && !empty($imagelogoaward)) : ?>
        <section class="pageb serv-pageb pageb-award">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <p class="pageb-title title title-2"><?php the_field('addition_title'); ?></p>
                        <div class="pageb-content content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <?php foreach ($imagelogoaward as $value): ?>
                        <div class="pageb-award-item">
                            <div class="image">
                                <?php echo wp_get_attachment_image($value['image'], 'full'); ?>
                            </div>
                            <p><?php echo $value['text']; ?></p>
                        </div>
                         <?php endforeach;?>

                    </div>
                </div>
            </div>
        </section>
    <?php else:?>
        <section class="pageb">
            <div class="container">
                <div class="pageb-row">
                    <div class="pageb-col pageb-col-l">
                        <p class="pageb-title title title-2"><?php the_field('addition_title'); ?></p>
                    </div>
                    <div class="pageb-col pageb-col-r">
                        <div class="pageb-content content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>

<?php if (have_rows('service')) { ?>
    <?php
    $is_overview = get_field('service');
    ?>
    <section class="serv-services" style="background: #F8F8F8;">
        <div class="container">
            <div class="serv-services-items">
                <div class="row">
                    <?php while (have_rows('service')) { ?>
                        <?php the_row(); ?>
                        <div  class="serv-services-item">
                            <p class="serv-services-item-title"><?php the_sub_field('name'); ?></p>
                            <div class="serv-services-item-img">
                                <?php echo wp_get_attachment_image(get_sub_field('image'), 'large'); ?>
                            </div>
                            <p class="serv-services-item-cont content"><?php the_sub_field('text'); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

    <section class="serv-cont">
        <div class="container">
            <div class="serv-cont-inner">
                <p class="serv-cont-title"><?php the_field('title_info'); ?></p>
                <p class="serv-cont-cont content"><?php the_field('text_info'); ?></p>
                <div class="serv-cont-btns">
                    <a class="btn btn-primary" href=<?php echo get_field('link')['url']; ?>> <?php echo get_field('link')['title']; ?></a>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part( 'partials/brightAndShiny' );  ?>
    <?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>
<?php get_footer(); ?>
