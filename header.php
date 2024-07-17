<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-104670948-1"></script>
        <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','UA-104670948-1');</script>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <?php wp_head(); ?>

        <?php if(is_page_template('page-templates/page-contact.php')): ?>
            <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.js'></script>
            <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.css' rel='stylesheet' />
	    <?php endif; ?>
    </head>
	<body <?php body_class(); ?>>
        <main id="site-content" role="main">
            <header id="header" class="header">
                <nav class="navbar navbar-expand-lg navbar-header">
                    <div class="container">
                        <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                            <img src="<?php bloginfo('stylesheet_directory'); ?>/static/img/logo.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
                        </a>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopMenu" aria-controls="navbarTopMenu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                                <span class="navbar-toggler-icon-line"></span>
                                <span class="navbar-toggler-icon-line"></span>
                                <span class="navbar-toggler-icon-line"></span>
                            </span>
                        </button>
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'menu_primary',
                                'depth' => 2,
                                'container' => 'div',
                                'container_class' => 'collapse navbar-collapse',
                                'container_id' => 'navbarTopMenu',
                                'menu_class' => 'navbar-nav mr-auto',
                                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                                'walker' => new WP_Bootstrap_Navwalker(),
                            ));
                        ?>
                        <div class="navbar-contact">
                            <a class="navbar-contact-btn" href=<?php the_field('opti_cb_link', 'option'); ?>><?php the_field('opti_cb_text', 'option'); ?></a>
                        </div>
                        <div class="navbar-search-form">
                            <?php get_search_form(); ?>
                            <button type="button" name="search-show" class="fa fa-search search-show" aria-label="Search keywords" title="Search keywords">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.264" height="21.22" viewBox="0 0 20.264 21.22"><g transform="translate(-1204.057 -26.013)"><g transform="translate(1204.057 26.013)" fill="none" stroke="#06bee1" stroke-width="2"><circle cx="8" cy="8" r="8" stroke="none"/><circle cx="8" cy="8" r="7" fill="none"/></g><line x2="6.386" y2="6.386" transform="translate(1217.227 40.14)" fill="none" stroke="#06bee1" stroke-width="2"/></g></svg>
                            </button>
                            <button type="button" name="search-close" class="fa fa-close-button search-close" aria-label="Search close" style="display: none;">
                                <svg height="15pt" viewBox="0 0 329.26933 329" width="15pt" xmlns="http://www.w3.org/2000/svg"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
                            </button>
                        </div>
                    </div>
                </nav>
            </header>
