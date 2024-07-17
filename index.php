<?php get_header(); ?>
<?php

$paralax_img = '';
if (has_post_thumbnail()) {
    $paralax_img = '<div class="parallax-window" data-parallax="scroll" data-image-src="/wp-content/uploads/2021/05/bright_shiny-scaled.jpg"></div>';
}
$is_show_testi= get_field('is_visible_testimonials');
?>
<main id="primary" class="site-main">
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
                    <h1 class="paget-title">
                        <?php
                        $postType = get_queried_object();
                        echo esc_html( $postType->labels->singular_name );
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="pageb articles-list">
        <div class="container">
            <div class="row">
                <?php
                if (have_posts()) {
                    // Start the Loop.
                    while (have_posts()) {
                        the_post();
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
                ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
