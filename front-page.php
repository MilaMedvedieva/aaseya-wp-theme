<?php get_header(); ?>
<?php $is_show_testi = get_field('is_visible_testimonials');
$bg_img = wp_get_attachment_image_src(get_field('b1_bgimg'), 'full'); ?>
<section class="home-block home-block1" style="background-image:url('<?php echo $bg_img[0]; ?>');">
    <div class="home-block1-top">
        <div class="container">
            <div class="home-block1-cont">
                <div class="home-block1-cont-titles">
                    <h1 class="home-block1-title title title-1" style="color:<?php the_field('b1_title_color'); ?>;"><?php the_field('b1_title'); ?></h1>
                    <p class="home-block1-text" style="color:<?php the_field('b1_title_color'); ?>;"><?php the_field('b1_subtitle'); ?></p>
                    <?php $button_link = get_field('b1_button_link'); ?>
                    <?php if ($button_link) { ?>
                        <p class="home-block1-btns">
                            <a class="btn btn-primary" target="<?php echo $button_link['target']?>" href="<?php echo $button_link['url']?>"><?php echo $button_link['title']?></a>
                        </p>
                    <?php } ?>
                </div>
                <?php if (have_rows('b1_blocks')) { ?>
                    <div class="home-block1-blocks">
                        <?php while (have_rows('b1_blocks')) { ?>
                            <?php the_row(); ?>
                            <div class="home-block1-block">
                                <div class="home-block1-block-row">
                                    <div class="home-block1-block-col home-block1-block-col-l">
                                        <div class="home-block1-block-cont">
                                            <p class="home-block1-block-title title title-2"><?php the_sub_field('title'); ?></p>
                                            <p class="home-block1-block-text"><?php the_sub_field('text'); ?></p>
                                        </div>
                                    </div>
                                    <div class="home-block1-block-col home-block1-block-col-r">
                                        <div class="home-block1-block-img">
                                            <?php echo wp_get_attachment_image(get_sub_field('image'), 'large'); ?>
                                            <div class="home-block1-block-btns">
                                                <a class="btn btn-primary" target="<?php echo get_sub_field('button_link')['target']?>" href="<?php echo get_sub_field('button_link')['url']?>"><?php echo get_sub_field('button_link')['title']?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="home-about">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-12">
                    <p class="home-about-title title title-2"><?php the_field('b2_title'); ?></p>
                </div>
                <div class="col-xl-9 col-md-12">
                    <div class="home-about-content content">
                        <?php the_field('b2_text'); ?>
                    </div>
                </div>
            </div>
            <?php if (have_rows('b2_blocks')) { ?>
                <div class="testi-slider">
                    <div class="testi-slider-inner">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php while (have_rows('b2_blocks')) { ?>
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
            <?php } ?>
        </div>
    </div>
</section>
<?php
    $home_banner_1 = get_field('banners_one');
    $bg_banner_1_url = wp_get_attachment_image_src($home_banner_1, 'full');

    if(isset($home_banner_1)&& !empty($home_banner_1)):
?>
    <div class="home-banner parallax_banner"  style="background-image: url(<?php echo $bg_banner_1_url[0];?>)"></div>
<?php endif; ?>
<?php
$services_list = get_field('services_list');
$services_title = get_field('services_title');
$services_subtitle = get_field('services_subtitle');
$services_link = get_field('services_link');
if(isset($services_list) and !empty($services_list)): ?>
    <section class="home-block home-services">
        <div class="container">
            <div class="row">
            <div class="col-xl-3 col-md-12">
                <p class="title title-2"><?php echo $services_title ?></p>
            </div>
            <div class="col-xl-9 col-md-12">
                <div class="home-services-subtitle content">
                    <p><?php echo $services_subtitle ?></p>
                </div>
                <div class="row home-services-list">
                    <?php
                    foreach ( $services_list as $key => $value ):
                        $bg_image = wp_get_attachment_image_src($value['image'], 'full');
                        ?>
                        <div class="col-xl-6  col-lg-6 col-md-12">
                            <?php if(!empty($value['link'])): ?>
                            <a  class="item" target="<?php echo $value['link']['target']?>" href="<?php echo $value['link']['url']?>">
                                <h3 class="title"><?php echo $value['title']?></h3>
                                <div class="image" style="background-image: url(<?php echo $bg_image[0];?>)"></div>
                                <div class="content">
                                    <p><?php echo $value['description']?></p>
                                </div>
                            </a>
                            <?php else: ?>
                                <div class="item">
                                    <h3 class="title"><?php echo $value['title']?></h3>
                                    <div class="image" style="background-image: url(<?php echo $bg_image[0];?>)"></div>
                                    <div class="content">
                                        <p><?php echo $value['description']?></p>
                                    </div>
                                </div>
                            <?php endif;; ?>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <?php if(!empty($services_link)): ?>
                    <div class="block-testimonials-link">
                        <a class="btn btn-primary" href="<?php echo $services_link['url'] ?>" target="<?php echo $services_link['target'] ?>"><?php echo $services_link['title'] ?></a>
                    </div>
                <?php endif;?>
            </div>
        </div>
        </div>
    </section>
<?php endif; ?>

<section class="home-block home-block2">
    <div class="container">
        <div class="home-block2-cont">
            <div class="home-block2-row">
                <div class="home-block2-col home-block2-col-l">
                    <p class="home-block2-title title title-2"><?php the_field('b3_title'); ?></p>
                </div>
                <div class="home-block2-col home-block2-col-r">
                    <p class="home-block2-text content"><?php the_field('b3_text'); ?></p>
                </div>
            </div>
        </div>
        <?php if (have_rows('b3_blocks')) { ?>
            <div class="numbers">
                <?php while (have_rows('b3_blocks')) { ?>
                    <?php the_row(); ?>
                    <div class="numbers-item">
                        <p class="numbers-item-title"><?php the_sub_field('title'); ?></p>
                        <p class="numbers-item-text"><?php the_sub_field('text'); ?></p>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>

<?php
$home_banner_2 = get_field('banners_two');
$bg_banner_2_url = wp_get_attachment_image_src($home_banner_2, 'full');
if(isset($home_banner_2)&& !empty($home_banner_2)):
    ?>
    <div class="home-banner parallax_banner"  style=" background-image: url(<?php echo $bg_banner_2_url[0];?>)"></div>
<?php endif; ?>



<?php
    $life_title = get_field('life_title');
    $life_link = get_field('life_link');
    $life_content = get_field('life_content');
    if(isset($life_content) and !empty($life_content)):
?>
    <section class="life-aaseya">
      <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-12">
                <p class="title title-2"><?php echo $life_title;?></p>
            </div>
            <div class="col-xl-9 col-md-12">
                <div class="content">
                    <?php echo $life_content;?>
                    <a class="btn btn-primary" href="<?php echo $life_link['url'];?>" target="<?php echo $life_link['target'];?>"><?php echo $life_link['title'];?></a>
                </div>
            </div>
        </div>
    </div>
    </section>
<?php endif;?>
<?php get_template_part( 'partials/brightAndShiny' );  ?>
<?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
<?php get_template_part( 'partials/lookingFor' );  ?>
<?php get_template_part( 'partials/ourCustomers' );  ?>
<?php get_footer(); ?>
