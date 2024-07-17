<?php
add_action('wp_ajax_aaseya_loadmore', 'aaseya_loadmore');
add_action('wp_ajax_nopriv_aaseya_loadmore', 'aaseya_loadmore');

add_action('wp_ajax_aaseya_filter_post', 'aaseya_filter_post');
add_action('wp_ajax_nopriv_aaseya_filter_post', 'aaseya_filter_post');

add_action('wp_ajax_aaseya_loadmore_with_filter', 'aaseya_loadmore_with_filter');
add_action('wp_ajax_nopriv_aaseya_loadmore_with_filter', 'aaseya_loadmore_with_filter');

function aaseya_loadmore(){
    $offset = $_POST['offset'];
    $post_type = $_POST['post_type'];

    $query = new WP_Query( [
        'post_type' 		=> $post_type,
        'posts_per_page' 	=> 3,
        'orderby' 			=> 'date',
        'order'   			=> 'DESC',
        'post_status'       => 'publish',
        'offset'			=> aaseya_filter_post
    ] );
    $new_offset = $offset + 3;
    ob_start();
    ?>
    <?php if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php if($post_type == 'vacancies'): ?>
            <?php   get_template_part('loop-templates/content', 'vacancies');?>
        <?php elseif($post_type == 'events'): ?>
            <?php   get_template_part('loop-templates/content', 'events');?>
        <?php else:?>
            <div class="col-lg-4 post">
                <article id="post-<?php get_the_id(); ?>" <?php post_class(); ?>>
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
                        <?php
                        $post_id = get_the_ID();
                        $post_type = get_post_type();
                        $post_taxonomy = get_object_taxonomies( array( 'post_type' => $post_type ) )[0];
                        $terms = get_the_terms( $post_id, $post_taxonomy );
                        ?>
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
                            $post_short_description = get_field('post_short_description',$post_id);
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
                            <a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a>
                        </div>
                    </div>
                </article>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p style="color: #8b8989;font-size: 18px; text-align: center; margin-top: 20px;"><?php esc_html_e( 'Cannot search any articles.' ); ?></p>
    <?php endif; ?>

    <?php
    $return = ob_get_clean();

    echo json_encode( array('status' 		=> 200,
                            'render' 		=> $return,
                            'new_offset' 	=> $new_offset ) );
    die;
}

function aaseya_filter_post(){
    $offset = $_POST['offset'];
    $category = $_POST['category'];
    $post_type = $_POST['post_type'];
    $date_y = $_POST['y'];
    $date_m = $_POST['m'];

    if($post_type == 'bright_and_shiny'){
        $tax_name = 'category_bright';
    }elseif($post_type == 'newsroom'){
        $tax_name = 'category_news';
    }elseif ($post_type == 'vacancies'){
        $tax_name = 'location_vacancy';
    }elseif ($post_type == 'events'){
        $tax_name = 'location_event';
    }

    if($category != 0):
        $category_args = array(
            'taxonomy' => $tax_name,
            'field' => 'name',
            'terms' => $category
        );
    endif;
    $query_all = new WP_Query( [
        'post_type' 		=> $post_type,
        'posts_per_page' 	=> -1,
        'orderby' 			=> 'date',
        'order'   			=> 'DESC',
        'post_status'       => 'publish',
        'year'              => $date_y,
        'monthnum'          => $date_m,
        'offset'			=> 0,
        'tax_query' => array(
            'relation' => 'AND',
            $category_args
        ),
    ] );

    $query = new WP_Query( [
        'post_type' 		=> $post_type,
        'posts_per_page' 	=> 6,
        'orderby' 			=> 'date',
        'order'   			=> 'DESC',
        'post_status'       => 'publish',
        'year'              => $date_y,
        'monthnum'          => $date_m,
        'offset'			=> 0,
        'tax_query' => array(
            'relation' => 'AND',
            $category_args
        ),
    ] );
    $new_offset = $offset + 3;
    $post_count = $query_all->post_count;

    ob_start();
    ?>
    <?php if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php if($post_type == 'vacancies'): ?>
            <?php   get_template_part('loop-templates/content', 'vacancies');?>
        <?php elseif($post_type == 'events'): ?>
            <?php get_template_part('loop-templates/content', 'events');?>
        <?php else:?>
            <div class="col-lg-4 post">
            <article id="post-<?php get_the_id(); ?>" <?php post_class(); ?>>
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
                    <?php
                    $post_id = get_the_ID();
                    $post_type = get_post_type();
                    $post_taxonomy = get_object_taxonomies( array( 'post_type' => $post_type ) )[0];
                    $terms = get_the_terms( $post_id, $post_taxonomy );
                    ?>
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
                        $post_short_description = get_field('post_short_description',$post_id);
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
                        <a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a>
                    </div>
                </div>
            </article>
        </div>
        <?php endif; ?>
    <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <?php //var_dump($query); ?>
        <p style="color: #8b8989;font-size: 18px; text-align: center; margin-top: 20px;"><?php esc_html_e( 'Cannot search any articles.' ); ?></p>
    <?php endif; ?>

    <?php
    $return = ob_get_clean();

    echo json_encode( array('status' 		=> 200,
        'render' 		=> $return,
        'post_count'    => $post_count,
        'new_offset' 	=> $new_offset ) );
    die;
}

function aaseya_loadmore_with_filter(){
    $offset = $_POST['offset'];
    $post_type = $_POST['post_type'];

    $category = $_POST['category'];
    $post_type = $_POST['post_type'];
    $date_y = $_POST['y'];
    $date_m = $_POST['m'];


    if($post_type == 'bright_and_shiny'){
        $tax_name = 'category_bright';
    }elseif($post_type == 'newsroom'){
        $tax_name = 'category_news';
    }elseif ($post_type == 'vacancies'){
        $tax_name = 'location_vacancy';
    }elseif ($post_type == 'events'){
        $tax_name = 'location_event';
    }

    if($category != 0):
        $category_args = array(
            'taxonomy' => $tax_name,
            'field' => 'name',
            'terms' => $category
        );
    endif;


    $query = new WP_Query( [
        'post_type' 		=> $post_type,
        'posts_per_page' 	=> 3,
        'orderby' 			=> 'date',
        'order'   			=> 'DESC',
        'post_status'       => 'publish',
        'year'              => $date_y,
        'monthnum'          => $date_m,
        'offset'			=> $offset,
        'tax_query' => array(
            'relation' => 'AND',
            $category_args
        ),
    ] );
    $query_all = new WP_Query( [
        'post_type' 		=> $post_type,
        'posts_per_page' 	=> -1,
        'orderby' 			=> 'date',
        'order'   			=> 'DESC',
        'post_status'       => 'publish',
        'year'              => $date_y,
        'monthnum'          => $date_m,
        'offset'			=> 0,
        'tax_query' => array(
            'relation' => 'AND',
            $category_args
        ),
    ] );
    $post_count = $query_all->post_count;
    $new_offset = $offset + 3;
    ob_start();
    ?>
    <?php if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php if($post_type == 'vacancies'): ?>
            <?php   get_template_part('loop-templates/content', 'vacancies');?>
        <?php elseif($post_type == 'events'): ?>
            <?php get_template_part('loop-templates/content', 'events');?>
        <?php else:?>
            <div class="col-lg-4 post">
                <article id="post-<?php get_the_id(); ?>" <?php post_class(); ?>>
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
                        <?php
                        $post_id = get_the_ID();
                        $post_type = get_post_type();
                        $post_taxonomy = get_object_taxonomies( array( 'post_type' => $post_type ) )[0];
                        $terms = get_the_terms( $post_id, $post_taxonomy );
                        ?>
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
                            $post_short_description = get_field('post_short_description',$post_id);
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
                            <a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a>
                        </div>
                    </div>
                </article>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p style="color: #8b8989;font-size: 18px; text-align: center; margin-top: 20px;"><?php esc_html_e( 'Cannot search any articles.' ); ?></p>
    <?php endif; ?>

    <?php
    $return = ob_get_clean();

    echo json_encode( array('status' 		=> 200,
        'render' 		=> $return,
        'post_count'    => $post_count,
        'new_offset' 	=> $new_offset ) );
    die;
}


