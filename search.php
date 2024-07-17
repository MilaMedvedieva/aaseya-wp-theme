<?php
/**
 * The template for displaying search results pages.
 *
 * @package aaseya
 */

get_header();
?>

    <section class="paget paget-search">
        <div class="paget-inner">
            <div class="paget-top">
                <div class="container">
                    <nav class="crumbs">
                        <a href="http://dev-aaseya.test/">Home</a>
                        <span class="sep">&gt;</span>
                        <?php if ( have_posts() ) : ?>
                            <span><?php printf( __( 'Search Results for: %s', 'blink' ), get_search_query() ); ?></span>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
    </section>
	<section  class="pageb content-search">
        <div class="container">
            <div class="row">
                <?php if ( have_posts() ) : ?>
                <div class="col-12">
                    <div class="page-header">
                        <h1 class="pageb-title title title-2"><span><?php printf( __( 'Search Results for: %s', 'blink' ), get_search_query() ); ?></span></h1>
                    </div><!-- .page-header -->
                </div>
                <div class="col-12">
                    <?php /* Start the Loop */ ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('loop-templates/content', 'search');
                        ?>

                    <?php endwhile; ?>

                    <div class="search-pagination">
                        <?php the_posts_pagination(array(
                            'show_all'     => false,
                            'end_size'     => 1,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text' => __('<span class="meta-nav">←</span> Newer post', 'aaseya'),
                            'next_text' => __('Older post <span class="meta-nav">→</span>', 'aaseya'),
                            'add_args'     => false
                        ));?>
                    </div>

                    <?php else : ?>

                    <?php get_template_part( 'loop-templates/content', 'none' ); ?>
                </div>
            </div>
        </div>

		<?php endif; ?>

	</section>



    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>

<?php get_footer(); ?>

