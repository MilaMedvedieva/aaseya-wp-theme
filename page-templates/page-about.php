<?php /* Template Name: About page */ ?>
<?php get_header(); ?>
    <?php
        $paralax_img = '';
        if (has_post_thumbnail()) {
            $paralax_img = '<div class="parallax-window"  data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"></div>';
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
                    <h1 class="paget-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pageb about-pageb">
        <div class="container">
            <div class="pageb-row">
                <div class="pageb-col pageb-col-l">
                    <?php if (get_field('addition_title')) { ?>
                        <p class="pageb-title title title-2"><?php the_field('addition_title'); ?></p>
                    <?php } else { ?>
                        <p class="pageb-title title title-2"><?php the_title(); ?></p>
                    <?php } ?>
                </div>
                <div class="pageb-col pageb-col-r">
                    <div class="pageb-content content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (have_rows('blocks_b1')) { ?>
        <section class="about-testi">
            <div class="container">
                <div class="testi-slider">
                    <div class="testi-slider-inner">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php while (have_rows('blocks_b1')) { ?>
                                    <?php the_row(); ?>
                                    <div class="swiper-slide">
                                        <div class="testi-slider-item">
                                            <p class="testi-slider-item-text"><?php the_sub_field('text'); ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    <?php } ?>
    <section class="pageb about-pageb about-values">
        <div class="container">
            <div class="pageb-row">
                <div class="pageb-col pageb-col-l">
                    <p class="pageb-title title title-2"><?php the_field('title_b2'); ?></p>
                </div>
                <div class="pageb-col pageb-col-r">
                    <div class="pageb-content content">
                        <p><?php the_field('text_b2'); ?></p>
                    </div>
                    <?php if (have_rows('blocks_b2')) { ?>
                        <div class="about-values-blocks">
                            <?php while (have_rows('blocks_b2')) { ?>
                                <?php the_row(); ?>
                                <div class="about-values-block">
                                    <div class="about-values-block-icon">
                                        <?php echo wp_get_attachment_image(get_sub_field('icon'), 'full'); ?>
                                    </div>
                                    <p class="about-values-block-title"><?php the_sub_field('title'); ?></p>
                                    <p class="about-values-block-text content"><?php the_sub_field('text'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    $about_banner = get_field('about_banner');
    $about_banner_url = wp_get_attachment_image_src($about_banner, 'full');
    if(isset($about_banner)&& !empty($about_banner)):
        ?>
        <div class="parallax_banner"  style=" background-image: url(<?php echo $about_banner_url[0];?>)"></div>

    <?php endif; ?>

    <section id="about-tech" class="pageb about-pageb about-tech">
        <div class="container">
            <div class="pageb-row">
                <div class="pageb-col pageb-col-l">
                    <p class="pageb-title about-tech-title title title-2"><?php the_field('title_b3'); ?></p>
                </div>
                <div class="pageb-col pageb-col-r">
                    <div class="content about-tech-content">
                        <?php the_field('text_b3'); ?>
                    </div>
                    <div class="about-tech-btns">
                        <a class="btn btn-primary" target="_blank" href="<?php the_field('button_link_b3'); ?>"><?php the_field('button_text_b3'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        $about_banner_s = get_field('about_banner_second');
        $about_banner_url_s = wp_get_attachment_image_src($about_banner_s, 'full');
     if(isset($about_banner_s)&& !empty($about_banner_s)):
        ?>
        <div class="parallax_banner"  style=" background-image: url(<?php echo $about_banner_url_s[0];?>)"></div>

     <?php endif; ?>

    <section id="about-team" class="about-team">
        <div class="container">
            <p class="about-team-title title title-2"><?php the_field('title_b4'); ?></p>
            <?php if (have_rows('blocks_b4')) { ?>
                <div class="about-team-blocks">
                    <?php while (have_rows('blocks_b4')) { ?>
                        <?php the_row(); ?>
                        <div class="about-team-block">
                            <div class="about-team-block-top">
                                <p class="about-team-block-name"><?php the_sub_field('name'); ?></p>
                                <p class="about-team-block-position"><?php the_sub_field('position'); ?></p>
                            </div>
                            <div class="about-team-block-img">
                                <?php echo wp_get_attachment_image(get_sub_field('image'), 'full'); ?>
                                <div class="about-team-block-hover">
                                    <div class="about-team-block-cont content">
                                        <?php the_sub_field('text'); ?>
                                    </div>
                                    <?php if (have_rows('icons')) { ?>
                                        <ul class="about-team-block-icons">
                                            <?php while (have_rows('icons')) { ?>
                                                <?php the_row(); ?>
                                                <?php $social_links = get_sub_field('link'); ?>
                                                <?php if ($social_links) { ?>
                                                    <li class="about-team-block-icon">
                                                        <a class="about-team-block-icon-link" target="_blank" href="<?php echo $social_links; ?>">
                                                            <?php echo wp_get_attachment_image(get_sub_field('icon'), 'full'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>

<?php get_footer(); ?>
