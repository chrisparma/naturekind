<?php

    // Generate & Send Verification Code
    add_action('wp_ajax_send_email_verification', 'send_email_verification_code');
    add_action('wp_ajax_nopriv_send_email_verification', 'send_email_verification_code');

    function send_email_verification_code() {
        if (!isset($_POST['email']) || !is_email($_POST['email'])) {
            wp_send_json_error('Invalid email.');
        }
    
        $email = sanitize_email($_POST['email']);
        $transient_key = 'cf7_email_code_' . md5($email);
    
        // Detect if we're on a DDEV/local environment
        $is_local = strpos($_SERVER['HTTP_HOST'], '.ddev.site') !== false || $_SERVER['HTTP_HOST'] === 'localhost';
    
        if ($is_local) {
            $code = 'local';
            set_transient($transient_key, $code, 10 * MINUTE_IN_SECONDS);
            wp_send_json_success('Local verification code set (use: local)');
        } else {
            $code = rand(100000, 999999);
            set_transient($transient_key, $code, 10 * MINUTE_IN_SECONDS);
    
            $subject = 'Your Verification Code';
            $message = "Your verification code is: $code";
            $headers = ['Content-Type: text/html; charset=UTF-8'];
    
            $sent = wp_mail($email, $subject, $message, $headers);
    
            if ($sent) {
                wp_send_json_success('Verification code sent!');
            } else {
                wp_send_json_error('Failed to send email.');
            }
        }
    }    

    // Validate verification code before submission
    add_filter('wpcf7_validate_email*', 'cf7_validate_email_code', 20, 2);
    function cf7_validate_email_code($result, $tag) {
        $tag_name = $tag['name'];
        if ($tag_name === 'your-email') {
            $email = isset($_POST[$tag_name]) ? sanitize_email($_POST[$tag_name]) : '';
            $user_code = isset($_POST['email_code']) ? sanitize_text_field($_POST['email_code']) : '';
            $stored_code = get_transient('cf7_email_code_' . md5($email));

            if (!$stored_code || $user_code != $stored_code) {
                $result->invalidate($tag, "Invalid or expired verification code.");
            }
        }

        return $result;
    }

    function enqueue_email_verification_script() {
        wp_enqueue_script(
            'cf7-email-verification',
            get_template_directory_uri() . '/assets/js/cf7-email-verification.js',
            array('jquery'), // dependencies
            null,
            true
        );
    
        wp_localize_script('cf7-email-verification', 'cf7_email_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'user_email' => is_user_logged_in() ? wp_get_current_user()->user_email : '',
        ));        
    }
    add_action('wp_enqueue_scripts', 'enqueue_email_verification_script');
    
    add_filter('wpcf7_autop_or_not', '__return_false');

    add_action('wp_ajax_validate_code', 'validate_email_code_ajax');
    add_action('wp_ajax_nopriv_validate_code', 'validate_email_code_ajax');

    function validate_email_code_ajax() {
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $code = isset($_POST['code']) ? sanitize_text_field($_POST['code']) : '';

        if (!$email || !$code) {
            wp_send_json_error('Missing data.');
        }

        $stored_code = get_transient('cf7_email_code_' . md5($email));

        if ($stored_code && $stored_code === $code) {
            wp_send_json_success('Code is valid.');
        } else {
            wp_send_json_error('Invalid or expired code.');
        }
    }
