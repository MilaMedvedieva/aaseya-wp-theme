<?php
/**
 * The template for displaying all single posts
 * @package aaseya
 */

get_header();

$paralax_img = '';
if (has_post_thumbnail()) {
    $paralax_img = '<div class="parallax-window" data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"></div>';
}
if ( function_exists('get_field') )
{
    $block_downloads = get_field('block_downloads');
    $section_quote = get_field('section_quote');
    $section_content = get_field('section_content');
    $title_color = get_field('title_color_post');
}

$post_id = get_the_ID();
$post_type = get_post_type();
$post_taxonomy = get_object_taxonomies( array( 'post_type' => $post_type ) )[0];
$terms = get_the_terms( $post_id, $post_taxonomy );
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>>">
    <section class="paget">
        <div class="paget-inner">
            <div class="paget-top">
                <div class="container">
                    <?php the_crumbs(); ?>
                </div>
            </div>
            <div class="paget-bottom">
                <div class="container">
                    <h1 class="paget-title" style="color:<?= (isset($title_color) and !empty($title_color)) ? $title_color : ''?>;"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="post_thumbnail">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="post_thumbnail-wrap">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <div class="content-first pageb">
                <div class="container">
                    <div class="row">
                        <?php
                        $class_row = 'col-12';
                        $class_row_d = 'col-12';
                         if(isset($block_downloads) and !empty($block_downloads)){
                             $class_row = 'col-lg-8 col-md-12';
                             $class_row_d = 'col-lg-4 col-md-12';
                         }
                        ?>

                        <div class="<?php  echo $class_row;?>">
                            <div>
                                <?php echo do_shortcode('[Sassy_Social_Share title="Share"]'); ?>
                            </div>
                            <p class="post-data-info">
                                <span class="post-data-date"><?php echo get_the_date('n/j/Y'); ?></span>
                                <?php if ( !empty( $terms ) ): ?>
                                <span class="post-data-caret">|</span>
                                <span class="post-data-category">
                                   <span class="post-data-category">
                                    <?php $term_count = count($terms); $count = 1; foreach ($terms as $term ): ?>
                                    <span><?php echo $term->name; ?></span>
                                   <?php if($term_count != $count ) :?>
                                        <span class="post-data-caret">|</span>
                                    <?php endif; ?>
                                    <?php $count++;endforeach; ?>
                               </span>
                                </span>
                                <?php endif; ?>
                            </p>
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <?php if(isset($block_downloads) and !empty($block_downloads)):?>
                            <div class="content-downloads <?php  echo $class_row_d;?>">
                                <?php foreach ($block_downloads as $value): if(!$value['is_link']): ?>
                                    <div class="content-downloads-item">
                                        <p class="name"><?php echo $value['name'] ?></p>
                                        <a class="btn btn-primary" href="<?php echo $value['resources']['url'] ?>" download="<?php echo $value['resources']['filename'] ?>"><?php echo $value['cta_label'] ?></a>
                                    </div>
                                <?php else: ?>
                                    <div class="content-downloads-item">
                                        <p class="name"><?php echo $value['name'] ?></p>
                                        <a href="<?php echo $value['link']['url'] ?>" target="<?php echo $value['link']['target'] ?>" class="btn btn-primary" ><?php echo $value['link']['title'] ?></a>
                                    </div>
                                <?php endif; endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if(isset($section_quote['quote']) and !empty($section_quote['quote'])):?>
                <div class="content-quote">
                    <div class="container-full">
                        <div class="wrap parallax_banner" style="background-image: url(<?php  echo $section_quote['background'];?>)">
                            <div class="text">
                                <h3 class="text_quote"><?php  echo $section_quote['quote'];?></h3>
                                <p><?php  echo $section_quote['author'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="content-bottom">
                <div class="container">
                    <div class="row">
                        <?php if(isset($section_content) and !empty($section_content)):?>
                        <div class="col-12">
                            <div class="content">
                                <?php  echo $section_content;?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-12">
                            <?php echo do_shortcode('[Sassy_Social_Share title="Share"]'); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        endwhile;
        ?>
    </section>
</article>
<?php get_template_part( 'partials/lookingFor' );  ?>
<?php get_template_part( 'partials/ourCustomers' );  ?>
<?php
get_footer();
