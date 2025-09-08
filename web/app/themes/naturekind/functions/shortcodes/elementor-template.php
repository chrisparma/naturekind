<?php
    function load_elementor_template_shortcode($atts) {
        // Parse shortcode attributes
        $atts = shortcode_atts([
            'id' => ''
        ], $atts, 'elementor_template');
    
        $template_id = intval($atts['id']);
    
        // Ensure Elementor is loaded and a valid ID is provided
        if ($template_id && did_action('elementor/loaded')) {
            return \Elementor\Plugin::$instance->frontend->get_builder_content($template_id, false);
        }
    
        return '<p style="color: red;">Invalid Elementor Template ID.</p>';
    }
    add_shortcode('elementor_template', 'load_elementor_template_shortcode');
    