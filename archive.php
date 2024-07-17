<?php get_header(); ?>
<?php
global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$max_num_page =  $wp_query->max_num_pages;
$paralax_img = '<div class="parallax-window" data-parallax="scroll" data-image-src="/wp-content/uploads/2021/05/man-min.jpg"></div>';
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
                        <h1 class="paget-title"> <?php $postType = get_queried_object();echo esc_html( $postType->labels->singular_name ); ?></h1>
                    </div>
                </div>
            </div>
        </section>

  <section class="page-archive pageb">
            <div class="container">
                <?php
                $post_type = get_post_type();

                $query = new WP_Query([
                    'post_type' 		=> $post_type,
                    'posts_per_page' 	=> 6,
                    'orderby' 			=> 'date',
                    'order'   			=> 'desc',
                    'offset'			=> 0,
                    'post_status' => 'publish',
                ]);
                ?>
                <div class="render_area articles-list row">
                    <?php

                    if ($query->have_posts()) {
                        // Start the Loop.
                        while ($query->have_posts()) {
                            $query->the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('loop-templates/content', get_post_format());
                        }
                    } else {
                        get_template_part('loop-templates/content', 'none');
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

  <section class="articles-pagination">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <input id="posts_count" type="hidden" value="<?= $max_num_page;?>">
                            <input id="posts_offset" type="hidden" value="6">
                            <input id="posts_type" type="hidden" value="<?= get_post_type();?>">
                            <div class="btn btn-primary btn-loadmore">More posts</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

  <?php get_template_part( 'partials/lookingFor' );  ?>
  <?php get_template_part( 'partials/ourCustomers' );  ?>
<?php get_footer(); ?>
