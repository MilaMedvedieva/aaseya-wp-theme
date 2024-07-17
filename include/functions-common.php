<?php
//show only published post
add_filter('acf/fields/relationship/query', 'filter_acf_relationship', 10, 3);

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});



add_filter( 'show_admin_bar', 'hide_admin_bar' );
add_action('admin_menu', 'remove_posts_menu');


/**
 * Cuts the specified text up to specified number of characters.
 * Strips any of shortcodes.
 *
 * @author Kama (wp-kama.ru)
 *
 * @version 2.7.1
 *
 * @param string|array $args {
 *     Optional. Arguments to customize output.
 *
 *     @type int       $maxchar            Макс. количество символов.
 *     @type string    $text               Текст который нужно обрезать. По умолчанию post_excerpt, если нет post_content.
 *                                         Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
 *                                         все до `<!--more-->` вместе с HTML.
 *     @type bool      $autop              Заменить переносы строк на `<p>` и `<br>` или нет?
 *     @type string    $more_text          Текст ссылки `Читать дальше`.
 *     @type string    $save_tags          Теги, которые нужно оставить в тексте. Например `'<strong><b><a>'`.
 *     @type string    $sanitize_callback  Функция очистки текста.
 *     @type bool      $ignore_more        Нужно ли игнорировать <!--more--> в контенте.
 *
 * }
 *
 * @return string HTML
 */
function kama_excerpt( $args = '' ): string {
    global $post;

    $default = array(
        'maxchar'   => 350,
        'text'      => '',
        // Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
        'autop'     => true,
        'save_tags' => '',
        'more_text' => __('Читати далі', 'woocommerce'),
    );

    if( is_array($args) ) $_args = $args;
    else                  parse_str( $args, $_args );

    $rg = (object) array_merge( $default, $_args );
    if( ! $rg->text ) $rg->text = $post->post_excerpt ?: $post->post_content;
    $rg = apply_filters( 'kama_excerpt_args', $rg );

    $text = $rg->text;
    $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
    $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // убираем шоткоды: [singlepic id=3]. Учитывает markdown
    $text = trim( $text );

    // <!--more-->
    if( strpos( $text, '<!--more-->') ){
        preg_match('/(.*)<!--more-->/s', $text, $mm );

        $text = trim($mm[1]);

        $text_append = ' <a href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
    }
    // text, excerpt, content
    else {
        $text = trim( strip_tags($text, $rg->save_tags) );

        // Обрезаем
        if( mb_strlen($text) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace('~(.*)\s[^\s]*$~s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
        }
    }

    // Сохраняем переносы строк. Упрощенный аналог wpautop()
    if( $rg->autop ){
        $text = preg_replace(
            array("~\r~", "~\n{2,}~", "~\n~",   '~</p><br ?/>~'),
            array('',     '</p><p>',  '<br />', '</p>'),
            $text
        );
    }

    $text = apply_filters( 'kama_excerpt', $text, $rg );

    if( isset($text_append) ) $text .= $text_append;

    return ($rg->autop && $text) ? "<p>$text</p>" : $text;
}

//archives ( for custom post type)
function wp_get_cpt_archives( $cpt = 'post', $args = array() ) {
    // if cpt is post run the core get archives
    if ( $cpt === 'post' ) return wp_get_archives($args);

    // if cpt doesn't exists return error
    if ( ! post_type_exists($cpt) ) return new WP_Error('invalid-post-type');

    $pto = get_post_type_object($cpt);

    // if cpt doesn't have archive return error
    if ( ! $pto = get_post_type_object( $cpt ) ) return false;

    $types = array('monthly' => 'month', 'daily' => 'day', 'yearly' => 'year');

    $type = isset( $args['type'] ) ?  $args['type'] : 'monthly';

    if ( ! array_key_exists($type, $types) ) {
        // supporting only 'monthly', 'daily' and 'yearly' archives
        return FALSE;
    }
    $done_where = $done_link = FALSE;
    // filter where
    add_filter( 'getarchives_where' , function( $where ) use (&$done_where, $cpt) {
        if ( $done_where ) return $where;
        return str_replace( "post_type = 'post'" , "post_type = '{$cpt}'" , $where );
    });

    // filter link
    add_filter( "{$types[$type]}_link", function( $url ) use (&$done_link, $pto, $cpt) {
        if ( $done_link ) return $url;
        // if no pretty permalink add post_type url var
        // if ( get_option( 'permalink_structure' ) || ! $pto->rewrite ) {
        if ( ! get_option( 'permalink_structure' ) || ! $pto->rewrite ) {
            return add_query_arg( array( 'post_type' => $cpt ), $url );
        } else { // pretty permalink
            global $wp_rewrite;
            $slug = is_array( $pto->rewrite ) ? $pto->rewrite['slug'] : $cpt;
            $base = $pto->rewrite['with_front'] ? $wp_rewrite->front : $wp_rewrite->root;
            $home = untrailingslashit( home_url( $base ) );
            return str_replace( $home,  home_url( $base . $slug ), $url );
        }
    });

    // get original echo arg and then set echo to false
    $notecho = isset($args['echo']) && empty($args['echo']);
    $args['echo'] = FALSE;

    // get archives
    $archives = wp_get_archives($args);

    // prevent filter running again
    $done_where = $done_link = TRUE;

    // echo or return archives
    if ( $notecho ) {
        return $archives;
    } else {
        echo $archives;
    }
}



add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});






function remove_posts_menu() {
    remove_menu_page('edit.php');
}


function hide_admin_bar(){ return false; }


function filter_acf_relationship ($args, $field, $post_id) {
    $args['post_status'] = 'publish';
    return $args;
}


