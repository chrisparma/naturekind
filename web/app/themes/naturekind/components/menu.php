<?php
    function display_menu() {?>
        <div id="navbar" class="collapse navbar-collapse">
            <?php
                // Loading WordPress Custom Menu (theme_location).
                wp_nav_menu(
                    array(
                        'menu_class'     => 'navbar-nav mx-auto text-uppercase',
                        'container'      => '',
                        'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'         => new WP_Bootstrap_Navwalker(),
                        'theme_location' => 'main-menu',
                    )
                );
            ?>
        </div><!-- /.navbar-collapse -->
    <?php }