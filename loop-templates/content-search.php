<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package VirtuClean
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-inner">
        <div class="post-data">
            <h3 class="title"><?php the_title(); ?></h3>
        </div>
        <div class="post-content content">
            <p>
                <?php
                $content = get_the_content();
                echo wp_trim_words($content, 35, ' .....');
                ?>
                <a class="btn btn-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?=get_field('sta_label_archive','options')?></a>
            </p>

        </div>
    </div>
</article>