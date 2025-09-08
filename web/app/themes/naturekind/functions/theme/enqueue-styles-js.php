<?php
    /**
     * Loading All CSS Stylesheets and Javascript Files.
     *
     * @since v1.0
     *
     * @return void
     */
    function naturekind_scripts_loader() {
        $theme_version = wp_get_theme()->get( 'Version' );

        // 1. Styles.
        wp_enqueue_style('bootstrap-icons', '/wp-includes/fonts/bootstrap-icons/bootstrap-icons.min.css');
        // wp_enqueue_style( 'select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
        wp_enqueue_style( 'general', get_theme_file_uri( '/assets/css/general.min.css' ), array(), $theme_version, 'all' );
        wp_enqueue_style( 'woocommerce-overrides', get_theme_file_uri( '/assets/css/woocommerce-overrides.min.css' ), array(), $theme_version, 'all' );
        wp_enqueue_style( 'style', get_theme_file_uri( 'style.css' ), array(), $theme_version, 'all' );
        wp_enqueue_style( 'main', get_theme_file_uri( 'build/main.css' ), array(), $theme_version, 'all' ); // main.scss: Compiled Framework source + custom styles.
    
        if ( is_rtl() ) {
            wp_enqueue_style( 'rtl', get_theme_file_uri( 'build/rtl.css' ), array(), $theme_version, 'all' );
        }

        // 2. Scripts.
        // wp_enqueue_script( 'select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ), null, true );
        wp_enqueue_script( 'mainjs', get_theme_file_uri( 'build/main.js' ), array(), $theme_version, true );
        wp_enqueue_script( 'generaljs', get_theme_file_uri( 'assets/js/general.js' ), array(), $theme_version, true );
        wp_enqueue_script( 'menujs', get_theme_file_uri( 'assets/js/menu.js' ), array(), $theme_version, true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        
    }
    add_action( 'wp_enqueue_scripts', 'naturekind_scripts_loader' );

    function dequeue_woocommerce_styles_on_shop() {
        if ( is_shop() || is_post_type_archive( 'product' ) ) {
            // Dequeue WooCommerce styles
            wp_dequeue_style( 'woocommerce-general' );
            wp_dequeue_style( 'woocommerce-layout' );
            wp_dequeue_style( 'woocommerce-smallscreen' );
            wp_dequeue_style( 'woocommerce-inline' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_styles_on_shop', 100 );

    function naturekind_loop_shop_columns( $columns ) {
        // Set your desired number of columns here
        return is_active_sidebar( 'primary_widget_area' ) ? 3 : 4;
    }
    add_filter( 'loop_shop_columns', 'naturekind_loop_shop_columns', 20 );
    