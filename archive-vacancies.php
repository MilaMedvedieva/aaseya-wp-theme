<?php get_header(); ?>
<?php
global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$max_num_page =  $wp_query->max_num_pages;
$bg_image = get_field('vacancies_bg','options');
$archive_title = get_field('vacancies_title','options');

$post_type = get_queried_object()->name;

$query = new WP_Query([
    'post_type' 		=> $post_type,
    'posts_per_page' 	=> 6,
    'orderby' 			=> 'date',
    'order'   			=> 'desc',
    'offset'			=> 0,
    'post_status' => 'publish',
]);
$category = get_terms([
    'taxonomy' => 'location_vacancy',
    'hide_empty' => false,
]);
$args_date = array(
    'type'         => 'monthly',
    'format'       => 'option',
    'post_status' => 'publish',
    'show_post_count' => 1,
);
?>
  <section class="paget">
      <div class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $bg_image['url'] ?>"></div>
      <div class="paget-inner">
                <div class="paget-top">
                    <div class="container">
                        <?php the_crumbs(); ?>
                    </div>
                </div>
                <div class="paget-bottom">
                    <div class="container">
                        <?php if(isset($archive_title) && !empty($archive_title)): ?>
                            <h1 class="paget-title"> <?php echo $archive_title;?></h1>
                        <?php else: ?>
                            <h1 class="paget-title"> <?php $postType = get_queried_object();echo esc_html( $postType->labels->name ); ?></h1>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

       <section class="page-archive pageb">
            <div class="container">
                <?php if ($query->have_posts()): ?>
                <div class="filter_post row">
                    <div class="col-12">
                        <form action="#" method="post" accept-charset="utf-8" class="filter_post_form" id="filter_post_form">
                            <div class="wrapper">
                                <?php if ( isset($category) && !empty($category)): ?>
                                  <div class="f_category" >
                                    <select class="filter_select filter_by_locations " style="opacity: 0;" id="filter_by_category"  name="category []" multiple="multiple">
                                        <?php
                                            foreach ($category as $key => $value) {
                                        ?>
                                                <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <?php endif; ?>
                                <div class="f_date" style="display: none">
                                    <select class="filter_select" name="archive-dropdown" id="filter_by_date">
                                        <option></option>
                                        <option>All</option>
                                        <?php  echo wp_get_cpt_archives('vacancies',$args_date); ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
                <div class="loader_post">
                    <img src="/wp-content/uploads/2021/06/Balls-line.gif" alt="">
                </div>
                <div class="render_area articles-list row">
                    <?php

                    if ($query->have_posts()) {
                        // Start the Loop.
                        $_year_mon = '';   // previous year-month value
                        $_has_grp = false; // TRUE if a group was opened
                        while ($query->have_posts()) {
                            $query->the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('loop-templates/content', 'vacancies');
                        }
                    } else {
                        get_template_part('loop-templates/content', 'none');
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

<?php if ($query->have_posts()): ?>
  <section class="articles-pagination">
    <div class="container">
       <div class="row">
          <div class="col-12">
            <div>
             <input id="posts_count" type="hidden" value="<?= $query->found_posts;?>">
             <input id="posts_offset" type="hidden" value="6">
             <input id="posts_type" type="hidden" value="<?= get_post_type();?>">
                <?php if ( $query->found_posts > 6 ): ?>
                    <div class="btn btn-primary btn-loadmore">More posts</div>
                <?php endif;?>
            </div>
            <div class="with_filter_load_more">
              <input id="post_load_more_offset_with_filter" type="hidden" value="6">
              <input id="posts_count_with_filter" type="hidden" value="<?= $max_num_page;?>">
                <?php if ( $query->found_posts > 6 ): ?>
                    <div class="btn btn-primary" id="post_load_more_with_filter">More posts</div>
                <?php endif;?>
            </div>
         </div>
       </div>
    </div>
  </section>
<?php endif; ?>

  <?php get_template_part( 'partials/lookingFor' );  ?>
  <?php get_template_part( 'partials/ourCustomers' );  ?>
<?php get_footer(); ?>
