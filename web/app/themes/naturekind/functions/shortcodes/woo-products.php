<?php
    function custom_woocommerce_products_shortcode($atts) {
        
        $atts = shortcode_atts([
            'number' => 4,  // Default number of products
            'type'   => 'random', // Default type of products
            'category' => '', // Category slug (only used for 'category' type)
        ], $atts, 'custom_products');
    
        $args = [
            'post_type'      => 'product',
            'posts_per_page' => intval($atts['number']),
            'orderby'        => 'date', // Default ordering
            'order'          => 'DESC',
        ];
    
        switch ($atts['type']) {
            case 'recently_viewed':
                if (!isset($_SESSION)) session_start();
                $viewed_products = !empty($_SESSION['woocommerce_recently_viewed']) ? array_reverse(array_filter(explode('|', $_SESSION['woocommerce_recently_viewed']))) : [];
                $args['post__in'] = $viewed_products;
                $args['orderby']  = 'post__in';
                break;
    
            case 'category':
                if (!empty($atts['category'])) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => sanitize_text_field($atts['category']),
                        ],
                    ];
                }
                break;
    
            case 'most_popular':
                $args['meta_key'] = 'total_sales';
                $args['orderby']  = 'meta_value_num';
                break;
    
            case 'random':
            default:
                $args['orderby'] = 'rand';
                break;
        }
    
        $query = new WP_Query($args);
    
        ob_start();
    
        if ($query->have_posts()) {
            echo '<ul class="products columns-4">'; // WooCommerce product grid container
    
            while ($query->have_posts()) {
                $query->the_post();
                wc_get_template_part('content', 'product'); // Use WooCommerce's template
            }
    
            echo '</ul>';
        } else {
            echo '<p>No products found.</p>';
        }
    
        wp_reset_postdata();
    
        return ob_get_clean();
    }
    add_shortcode('custom_products', 'custom_woocommerce_products_shortcode');

    /*
    WooCommerce automatically tracks recently viewed products, but if they don’t appear, ensure session tracking is enabled in your theme
    */
    add_action('wp', function () {
        if (!session_id()) {
            session_start();
        }
    });
    