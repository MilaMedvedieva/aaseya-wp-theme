<?php
if ( function_exists('get_field') ) {
    $selected = get_field('testi_list');
    $title = get_field('testimonials_title','options');
    $testimonials_link = get_field('testimonials_link','options');
}
$query = new WP_Query([
    'post_type' 		=> 'testimonials',
    'posts_per_page' 	=> -1,
    'orderby' 			=> 'date',
    'order'   			=> 'desc',
    'offset'			=> 0,
    'post_status' => 'publish'
]);
?>

<?php if( !empty($selected) or $query->have_posts()): ?>
<section class="block-testimonials">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-12">
                <p class="title title-2"><?= $title;?></p>
            </div>
            <div class="col-xl-8 col-12">
                <div class="testimonials-slider block-testimonials-slider">
                    <div class="testimonials-slider-inner">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                  <?php
                                    if ( isset( $selected ) && ! empty( $selected ) ){
                                        foreach ( $selected as $key => $value ):
                                            $post_id = $value;
                                            $post_signature = get_field('signature',$post_id);
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="testimonials-slider-item">
                                                    <p class="testimonials-slider-item-text">“<?php echo get_post_field('post_content', $post_id) ?>”</p>
                                                    <p class="testimonials-slider-item-signature"><?php echo $post_signature; ?></p>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                    }else{

                                        if ($query->have_posts()) {
                                            while ($query->have_posts()) {
                                                $query->the_post();
                                                $post_id = get_the_ID();;
                                                $post_signature = get_field('signature',$post_id);
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="testimonials-slider-item">
                                                        <p class="testimonials-slider-item-text">“<?php echo get_post_field('post_content', $post_id) ?>”</p>
                                                        <p class="testimonials-slider-item-signature"><?php echo $post_signature; ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        wp_reset_postdata();
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <?php if(!empty($testimonials_link)):?>
                    <div class="block-testimonials-link">
                        <a class="btn btn-primary" href="<?php echo $testimonials_link['url'] ?>" target="<?php echo $testimonials_link['target'] ?>"><?php echo $testimonials_link['title'] ?></a>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<?php  endif; ?>
