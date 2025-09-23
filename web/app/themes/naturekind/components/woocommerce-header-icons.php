<?php
    function display_woocommerce_icons() {
        // Check if WooCommerce is active
        if (class_exists('WooCommerce')) {
            ?>
            <div class="woocommerce-icons left-right-col-wrapper d-flex align-items-center gap-3">
                <!-- Account Icon -->
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="hidden-sm header-links account-icon">
                    <i class="fa-light fa-user"></i>
                </a>

                <!-- Wishlist Icon (Requires a wishlist plugin like YITH Wishlist) -->
                <?php if (function_exists('YITH_WCWL')) : ?>
                    <a href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>" class="header-links wishlist-icon">
                        <i class="bi bi-heart"></i>
                    </a>
                <?php endif; ?>

                <!-- Cart Icon with Badge -->
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="position-relative header-links cart-icon">
                    <i class="bi bi-bag"></i>
                    <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
                    <?php if ($cart_count > 0) : ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo esc_html($cart_count); ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
            <?php
        }
    }
