        </main>
        <footer class="footer">
            <div class="container">
                <div class="footer-row">
                    <div class="footer-col">
                        <a class="footer-logo" href="<?php bloginfo('url'); ?>">
                            <img src="<?php bloginfo('stylesheet_directory'); ?>/static/img/logo-footer.svg" title="<?php bloginfo('name'); ?>" />
                        </a>
                    </div>
                    <div class="footer-col">
                        <div class="footer-menu">
                            <?php  $menu = get_field('menu', 'options');
                            if(isset($menu) && !empty($menu)):
                                foreach ($menu as $value):
                            ?>
                                <a href="<?php echo $value['link']['url'] ?>"><?php echo $value['link']['title'] ?></a>
                                <span class="caret">|</span>
                           <?php endforeach; endif; ?>
                        </div>
                        <?php  $social_icons = get_field('social_icons', 'options');?>
                        <?php if(isset($social_icons) && !empty($social_icons)): ?>
                        <div class="footer-social-menu">
                            <ul>
                                <?php foreach ($social_icons as $value):?>
                                    <li>
                                        <a href="<?php echo $value['link']?>" target="_blank">
                                            <?php echo $value['icon']?>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php  endif;?>
                        <div class="footer-text">
                            <p>Copyright &#169; <?php echo date('Y'); ?> Aaseya. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
