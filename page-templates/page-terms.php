<?php /* Template Name: Terms | Privacy | Cookies */ ?>
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
    <section class="pageb terms-pageb-first">
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
    <?php
        $items= get_field('items');
        if(isset($items) and !empty($items)):
            foreach ($items as $value):
    ?>
       <section class="pageb terms-pageb">
           <div class="container">
             <div class="pageb-row">
                 <div class="pageb-col pageb-col-l">
                    <p class="pageb-title title title-2"><?php echo $value['heading']; ?></p>
                  </div>
                  <div class="pageb-col pageb-col-r">
                     <div class="pageb-content content">
                        <?php echo $value['content']; ?>
                     </div>
                  </div>
             </div>
           </div>
       </section>
    <?php endforeach; endif;?>




    <?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>

<?php get_footer(); ?>
