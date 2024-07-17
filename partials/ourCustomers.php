<?php
if ( function_exists('get_field') )
{
    $title = get_field('ourCustomers_title','options');
    $ourCustomers = get_field('ourCustomers_icons','options');
}
?>
<?php  if ( isset( $ourCustomers ) && ! empty( $ourCustomers ) ):?>
    <section class="block-ourCustomers">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    <p class="title title-2"><?php echo $title ?></p>
                </div>
                <div class="col-xl-8 col-12">
                    <div class="ourCustomers-slider">
                        <div class="ourCustomers-slider-inner">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ( $ourCustomers as $value ):
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="ourCustomers-slider-item">
                                                <div class="icon">
                                                    <?php echo wp_get_attachment_image( $value, 'full' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php  endif; ?>
