<?php /* Template Name: Services page */ ?>
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
                    <?php $title_img = get_field('title_img'); ?>
                    <?php if ($title_img): ?>
                        <div class="pageb-title-img">
                            <?php echo wp_get_attachment_image($title_img, 'large'); ?>
                        </div>
                    <?php else: ?>
                        <p class="pageb-title title title-2"><?php the_field('addition_title'); ?></p>
                    <?php endif;?>
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
        <section class="serv-testi">
            <div class="container">
                <div class="testi-slider">
                    <div class="testi-slider-inner">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php while (have_rows('blocks_b1')) { ?>
                                    <?php the_row(); ?>
                                    <div class="swiper-slide">
                                        <div class="testi-slider-item">
                                            <p class="testi-slider-item-title"><?php the_sub_field('title'); ?></p>
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
                <?php if (get_field('link_b1')): ?>
                    <div class="serv-testi-link">
                        <a class="btn btn-primary" href="<?php echo get_field('link_b1')['url']; ?>" target="<?php echo get_field('link_b1')['target']; ?>"><?php echo get_field('link_b1')['title']; ?></a>
                    </div>
                <?php endif;?>
            </div>
        </section>
    <?php } ?>

   <?php
       $title_download= get_field('title_download');
       $items_download = get_field('items_download');
   ?>
    <?php  if ( isset( $items_download ) && ! empty( $items_download ) ):?>
    <section class="block-download">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-12">
                <p class="title title-2"><?php echo $title_download; ?></p>
            </div>
            <div class="col-xl-8 col-12">
                <div class="row">
                    <?php foreach ( $items_download as $key => $value ):?>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="block-download-item">
                            <div class="block-download-item-wrap" style="background-image: url(<?php echo $value['background']; ?>)">
                                <p class="block-download-item-title"><?php echo $value['name']; ?></p>
                            </div>
                            <?php if($value['is_link']): ?>
                                <a class="block-download-item-link btn btn-primary" target="<?php echo $value['link']['target'] ?>" href="<?php echo $value['link']['url'];?>"><?php echo $value['link']['title'] ?></a>
                            <?php else: ?>
                                <a class="block-download-item-link btn btn-primary" href="<?php echo $value['file']['url'];?>" download="<?php echo $value['file']['filename'];?>">Download</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php  endif; ?>

    <?php if (have_rows('blocks_b2')) { ?>
    <?php
        $is_overview = get_field('services_overview');
        $new_bg ='';
        $new_item_bg ='';
        if($is_overview){
            $new_bg = 'background-color: #f8f8f8';
            $new_item_bg = 'background-color: #fff';
        }
    ?>
    <section class="serv-services" style="<?php echo $new_bg; ?>">
            <div class="container">
                <div class="serv-services-items">
                    <?php while (have_rows('blocks_b2')) { ?>
                        <?php the_row(); ?>
                        <div class="serv-services-item" style="<?php echo $new_item_bg; ?>">
                            <p class="serv-services-item-title"><?php the_sub_field('title'); ?></p>
                            <div class="serv-services-item-img">
                                <?php echo wp_get_attachment_image(get_sub_field('image'), 'large'); ?>
                            </div>
                            <p class="serv-services-item-cont content"><?php the_sub_field('text'); ?></p>

                            <?php
                                $link = get_sub_field('link');
                                $link_type = $link['is_type'];
                                $link_simple = $link['link'];
                                $download_file = $link['download']['url'];
                                $download_CTA = $link['text_cta'];
                                if($link_type == "Simple link" and !empty($link_simple)):
                            ?>
                                 <div class="serv-services-item-sta">
                                    <a class="btn btn-primary" href="<?php echo $link_simple['url'];?>" target="<?php echo $link_simple['target'];?>" ><?php echo $link_simple['title'];?></a>
                                 </div>
                                 <?php elseif($link_type == "Download" and !empty($download_file)): ?>
                                 <div class="serv-services-item-sta">
                                    <a class="btn btn-primary" href="<?php echo $download_file;?>" download="<?php echo $link['download']['filename'];?>"><?php echo $download_CTA;?></a>
                                 </div>
                                <?php endif; ?>

                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <section class="serv-cont">
        <div class="container">
            <div class="serv-cont-inner">
                <p class="serv-cont-title"><?php the_field('title_b3'); ?></p>
                <p class="serv-cont-cont content"><?php the_field('text_b3'); ?></p>
                <div class="serv-cont-btns">
                    <a class="btn btn-primary" href=<?php the_field('opti_cb_link', 'option'); ?>><?php the_field('opti_cb_text', 'option'); ?></a>
                </div>
            </div>
        </div>
    </section>


<?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
<?php get_template_part( 'partials/lookingFor' );  ?>
<?php get_template_part( 'partials/ourCustomers' );  ?>
<?php get_footer(); ?>
