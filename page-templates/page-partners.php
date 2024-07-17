<?php /* Template Name: Partners page */ ?>
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
                    <h1 class="paget-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pageb serv-pageb">
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
    <?php get_template_part( 'partials/why_block' );  ?>
    <?php if (have_rows('items_slider')) { ?>
        <section class="serv-testi">
            <div class="container">
                <div class="testi-slider">
                    <div class="testi-slider-inner">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php while (have_rows('items_slider')) { ?>
                                    <?php the_row(); ?>
                                    <div class="swiper-slide">
                                        <div class="testi-slider-item">
                                            <p class="testi-slider-item-title"><?php the_sub_field('title'); ?></p>
                                            <p class="testi-slider-item-text"><?php the_sub_field('content'); ?></p>
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
                <?php if (get_field('link_slider')): ?>
                    <div class="serv-testi-link">
                        <a class="btn btn-primary" href="<?php echo get_field('link_slider')['url']; ?>" target="<?php echo get_field('link_slider')['target']; ?>"><?php echo get_field('link_slider')['title']; ?></a>
                    </div>
                <?php endif;?>
            </div>
        </section>
    <?php } ?>
    <?php if (have_rows('tabs')): ?>
    <?php $tabs_block = get_field('tabs');?>
        <section class="pageb pageb-tabs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs pageb-tabs-nav" id="myTab" role="tablist">
                        <?php  $index = 1; foreach ($tabs_block as  $tab):?>
                            <li class="nav-item pageb-tabs-nav-item" role="presentation">
                                <button class="nav-link pageb-tabs-nav-item-link <?php echo ($index == 1) ? 'active': ''; ?>"
                                        id="name<?php echo $index;?>-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#name<?php echo $index;?>"
                                        type="button"
                                        role="tab"
                                        aria-controls="name<?php echo $index;?>"
                                        aria-selected="<?php echo ($index == 1) ? 'true': 'false'; ?>">
                                     <?php echo $tab['name'];?>
                                    <span class="caret"></span>
                                </button>
                            </li>
                        <?php $index++; endforeach; ?>
                    </ul>
                    <div class="tab-content pageb-tabs-content" id="myTabContent">
                        <?php  $index_tab = 1; foreach ($tabs_block as  $value):?>
                            <div class="tab-pane fade <?php echo ($index_tab == 1) ? 'active show ': ''; ?>" id="name<?php echo $index_tab;?>" role="tabpanel" aria-labelledby="name<?php echo $index_tab;?>-tab">
                                <div class="pageb-tabs-content-wrap">
                                    <div class="image">
                                        <?php echo wp_get_attachment_image($value['image']['ID'], 'full'); ?>
                                    </div>
                                    <div class="text content">
                                        <?php echo $value['content'];?>
                                        <?php if(isset($value['link']['url']) && !empty($value['link']['url'])): ?>
                                            <span class="btn-wrap">
                                              <a class="btn btn-primary" target="<?php echo $value['link']['target'] ?>" href=<?php echo $value['link']['url']; ?>> <?php echo $value['link']['title']; ?></a>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php $index_tab++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif;?>
    <section class="serv-cont page-partners">
        <div class="container">
            <div class="serv-cont-inner">
                <p class="serv-cont-title"><?php the_field('title_info'); ?></p>
                <p class="serv-cont-cont content"><?php the_field('text_info'); ?></p>
                <div class="serv-cont-btns">
                    <a class="btn btn-primary" href=<?php echo get_field('link_info')['url']; ?>> <?php echo get_field('link_info')['title']; ?></a>
                </div>
            </div>
        </div>
    </section>

<?php get_template_part( 'partials/brightAndShiny' );  ?>
<?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
<?php get_template_part( 'partials/lookingFor' );  ?>
<?php get_template_part( 'partials/ourCustomers' );  ?>
<?php get_footer(); ?>
