<?php
if ( function_exists('get_field') ) {
    $selected = get_field('bright_and_shiny_articles');
}
$query = new WP_Query([
    'post_type' 		=> 'bright_and_shiny',
    'posts_per_page' 	=> 3,
    'orderby' 			=> 'date',
    'order'   			=> 'desc',
    'offset'			=> 0,
    'post_status' => 'publish'
]);
?>
<?php if( !empty($selected) or $query->have_posts()): ?>
<section class="block_BrightandShiny">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="title title-2">Bright and shiny</p>
            </div>
        </div>
        <div class="row articles-list">
            <?php if(isset($selected) and !empty($selected)): ?>
                <?php
                  $selected_post = array();
                  foreach ( $selected as $key => $value ):
                      $post_id = $value;
                      $post_id_2 = get_post( $value );
                  ?>
                      <div class="col-lg-4 col-md-6 col-12 post">
                        <article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
                            <div class="post-thumbnail">
                                <?php if ( has_post_thumbnail($post_id) ) : ?>
                                    <?php
                                    $thumbnail_id = get_post_thumbnail_id( $post_id );
                                    $src_large = wp_get_attachment_image_src( $thumbnail_id, 'large' );
                                    ?>
                                    <img src="<?php echo $src_large[0] ?>"
                                         data-src="<?php echo $src_large[0] ?>"
                                         class="post_thumbnai-image"
                                         height="300"
                                         alt="<?php  echo get_the_title($post_id); ?>"
                                    >
                                <?php endif; ?>
                            </div>
                            <div class="post-inner">
                                <div class="post-data">
                                    <h3 class="title"><?php echo get_the_title($post_id); ?></h3>
                                    <p class="post-data-info">
                                        <span class="post-data-date"><?php echo get_the_date('n/j/Y',$post_id); ?></span>
                                        <span class="post-data-caret">|</span>
                                        <span class="post-data-category">
                                        <?php
                                        $post_type = get_post_type($post_id);
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
                                    </p>
                                </div>
                                <div class="post-content content">
                                    <?php
                                    $content = $post_id_2->post_content;
                                    echo wp_trim_words( $content, 25, ' ...' );
                                    ?>
                                </div>
                                <div class="post-link">
                                    <a class="btn btn-primary" href="<?php echo get_the_permalink($post_id); ?>" title="<?php echo get_the_title($post_id); ?>"><?=get_field('sta_label_archive','options')?></a>
                                </div>
                            </div>
                        </article>
                      </div>
                  <?php
                  endforeach;
                else: ?>
                <?php
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('loop-templates/content', get_post_format());
                    }
                }
                wp_reset_postdata();
                ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
