<?php
if ( function_exists('get_field') )
{
    $title = get_field('lookingFor-title','options');
    $lookingFor = get_field('lookingfor-items','options');
}
?>
<?php  if ( isset( $lookingFor ) && ! empty( $lookingFor ) ):?>
    <section class="block-lookingFor">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    <p class="title title-2"><?php echo $title ?></p>
                </div>
                <div class="col-xl-8 col-12">
                    <div class="row">
                        <?php
                        foreach ( $lookingFor as $key => $value ):
                            ?>
                            <div class="col-md-3">
                                <div class="block-lookingFor-item">
                                    <div class="block-lookingFor-item-icon">
                                        <div class="icon-wrap">
                                            <?php if(!empty($value['svg'])):
                                                    echo $value['svg'];
                                                else:
                                                    echo wp_get_attachment_image($value['image']['ID'], 'full');
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                    <p class="block-lookingFor-item-title"><?php echo $value['title']; ?></p>
                                    <a class="block-lookingFor-item-link btn btn-primary" href="<?php echo $value['link']['url']; ?>" target="<?php echo $value['link']['target']; ?>"><?php echo $value['link']['title']; ?></a>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php  endif; ?>