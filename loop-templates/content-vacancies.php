<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package VirtuClean
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

$block_downloads = get_field('block_downloads', get_the_ID());

?>
<div class="col-12 post">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post-inner">
            <div class="post-data">
                <h3 class="title"><?php the_title(); ?></h3>
                <p class="post-data-info">
                    <span class="post-data-date">Date published <?php echo get_the_date('n/Y'); ?></span>
                    <span class="post-data-caret">|</span>
                    <span class="post-data-category">
                    <?php
                        $post_id = get_the_ID();
                        $post_type = get_post_type();
                        $post_taxonomy = get_object_taxonomies( array( 'post_type' => $post_type ) )[0];
                        $terms = get_the_terms( $post_id, $post_taxonomy );
                        $term_count = count($terms);
                        if ( !empty( $terms ) ):
                            $count = 1;
                            foreach ($terms as $term ):
                        ?>
                             <span><?php echo $term->name; ?></span>
                             <?php if($term_count != $count ) :?>
                                <span class="post-data-caret">|</span>
                             <?php endif; ?>
                    <?php
                             $count++;
                        endforeach;
                    endif;
                    ?>
                   </span>
                    <?php if(!empty(get_field('salary'))): ?>
                    <span class="post-data-caret">|</span>
                    <span class="post-data-caret"><?php echo get_field('salary');?></span>
                    <?php endif; ?>
                </p>
            </div>
            <div class="post-content content">
                <?php $content = the_content(); echo $content; ?>
            </div>
            <div class="post-link">
                <?php if(isset($block_downloads) and !empty($block_downloads)):?>
                    <?php foreach ($block_downloads as $value): if(!$value['is_link']): ?>
                      <a href="<?php echo $value['resources']['url'] ?>" class="btn btn-primary btn-download" download="<?php echo $value['resources']['filename'] ?>"><?php echo $value['cta_label'] ?></a>
                    <?php else: ?>
                      <a href="<?php echo $value['link']['url'] ?>?job=<?php echo $post_id;?>" class="btn btn-primary" ><?php echo $value['link']['title'] ?></a>
                    <?php endif; endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>