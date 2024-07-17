<?php
$title_item= get_field('title_Items');
$items_list = get_field('items_list');
?>
<?php  if ( isset( $items_list ) && ! empty( $items_list ) ):?>
    <section class="why_block">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="title title-2"><?php echo $title_item; ?></p>
                </div>
                <div class="col-12 mt-5">
                    <div class="row">
                        <?php foreach ( $items_list as $key => $value ):?>
                            <div class="col-md-3 col-sm-6 col-12 d-flex">
                                <div class="why_block-item">
                                    <div class="why_block-item-icon">
                                        <?php if(!empty($value['svg'])): ?>
                                            <div class="svg"><?php echo $value['svg'];?></div>
                                        <?php else: ?>
                                            <div class="image"><?php  echo wp_get_attachment_image($value['image']['ID'], 'full');?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="why_block-item-content">
                                        <div class="content">
                                            <p class="why_block-item-title"><?php echo $value['name']; ?></p>
                                            <?php echo $value['text']; ?>
                                        </div>
                                        <div class="footer">
                                            <?php if($value['is_link'] and !empty($value['link'])): ?>
                                                <a class="why_block-item-link btn btn-primary" target="<?php echo $value['link']['target'] ?>" href="<?php echo $value['link']['url'];?>"><?php echo $value['link']['title'] ?></a>
                                            <?php elseif(!empty($value['file'])): ?>
                                                <a class="why_block-item-link btn btn-primary" href="<?php echo $value['file']['url'];?>" download="<?php echo $value['file']['filename'];?>">Download</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php  endif; ?>
