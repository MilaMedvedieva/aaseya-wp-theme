<?php /* Template Name: Life at Aaseya */ ?>
<?php get_header(); ?>
    <?php
        $is_show_testi = get_field('is_visible_testimonials');
        $paralax_img = '';
        if (has_post_thumbnail()) {
            $paralax_img = '<div class="parallax-window" data-position="top" data-bleed="10" data-natural-height="900"  data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"></div>';
        }

    if ( function_exists('get_field') )
    {
        $content = get_field('grid_content');
    }
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


    <?php  if ( isset( $content ) && ! empty( $content ) ):?>
        <section class="content-life">
            <div class="container">
                <?php
                $i=1;
                foreach ( $content as $key => $value ):
                    ?>
                    <div class="row <?php echo ($i % 2) ? 'odd':'even';?>">
                        <div class="col-lg-6 gutter-0 pos-relative">
                            <div class="photo">
                                <div class="photo-wrap">
                                    <?php echo wp_get_attachment_image( $value['image'], 'full' ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 gutter-0">
                            <div class="description">
                                <div class="description-text content">
                                    <h2><?php echo $value['title']; ?></h2>
                                    <p class="entry-info"><span><?php echo $value['job_title']; ?></span> <?php if(!empty($value['join_date'])):?> | <span><?php echo $value['join_date']; ?></span><?php endif; ?></p>
                                    <?php echo $value['description']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                endforeach;
                ?>
            </div>
        </section>
    <?php endif;?>

    <section class="serv-cont">
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
    <?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>

<?php get_footer(); ?>
