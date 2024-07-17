<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package VirtuClean
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

$post_id = get_the_ID();
$post_type = get_post_type();
$post_taxonomy = get_object_taxonomies( array( 'post_type' => $post_type ) )[0];
$terms = get_the_terms( $post_id, $post_taxonomy );

?>
<div class="col-lg-4 col-md-6 col-12 post">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post-thumbnail">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php
                $thumbnail_img = get_field('thumbnail_image');
                $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                if(isset($thumbnail_img) && !empty($thumbnail_img)):
                    $image_post = $thumbnail_img;
                else:
                    $image_post = $thumbnail_id;
                endif;
                $src_large = wp_get_attachment_image_src( $image_post, 'large' );
                ?>
                <img src="<?php echo $src_large[0] ?>"
                     data-src="<?php echo $src_large[0] ?>"
                     class="post_thumbnail-image"
                     height="255"
                     alt="<?php the_title(); ?>"
                >
            <?php endif; ?>
        </div>
        <div class="post-inner">
            <div class="post-data">
                <h3 class="title"><?php the_title(); ?></h3>
                <p class="post-data-info">
                    <span class="post-data-date"><?php echo get_the_date('n/j/Y'); ?></span>
                    <?php  if ( !empty( $terms ) ): ?>
                        <span class="post-data-caret">|</span>
                        <span class="post-data-category">
                        <?php $term_count = count($terms); $count = 1; foreach ($terms as $term ): ?>
                           <span><?php echo $term->name; ?></span>
                           <?php if($term_count != $count ) :?>
                             <span class="post-data-caret">|</span>
                           <?php endif; ?>
                        <?php $count++;endforeach; ?>
                       </span>
                    <?php endif; ?>
                </p>
            </div>
            <div class="post-content content">
                <?php
                $post_short_description = get_field('post_short_description');
                if(isset($post_short_description) and !empty($post_short_description)):
                    echo wp_trim_words( $post_short_description, 30, ' ...' );
                else:
                    $args = array(
                        'maxchar'   => 150,
                        'text'      => '',
                        'autop'     => true,
                        'save_tags' => '',
                        'more_text' => '...',
                    );
                    echo kama_excerpt( $args );
                endif;
                ?>
            </div>
            <div class="post-link">
                <a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?=get_field('sta_label_archive','options')?></a>
            </div>
        </div>
    </article>
</div>