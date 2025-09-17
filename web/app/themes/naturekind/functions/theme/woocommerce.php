<?php
    // Remove default sale badge
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

    // Add custom badges
    add_action( 'woocommerce_before_shop_loop_item_title', 'add_custom_product_badges', 10 );

    function add_custom_product_badges() {
        global $product;
        if ( ! $product ) return;

        $badges  = '';

        // Sale badge
        if ( $product->is_on_sale() ) {
            $badges .= '<span class="product-badge onsale">Sale!</span>';
        }

        // NEW badge — products created in the last X days
        $newness_days = 30; 
        $created = $product->get_date_created();
        $created_ts = $created ? $created->getTimestamp() : strtotime( get_post_field( 'post_date', $product->get_id() ) );
        if ( $created_ts && ( time() - $created_ts ) < DAY_IN_SECONDS * $newness_days ) {
            $badges .= '<span class="product-badge new">New</span>';
        }

        // LOW STOCK badge — only for products that manage stock and have small qty
        if ( $product->managing_stock() ) {
            $qty = $product->get_stock_quantity();
            if ( $qty !== null && $qty > 0 && $qty <= 5 ) {
                $badges .= '<span class="product-badge low-stock">Low Stock</span>';
            }
        }

        // Output the badges
        if ( $badges ) {
            echo '<span class="product-badge-wrapper" aria-hidden="true">' . $badges . '</span>';
        }
    }

