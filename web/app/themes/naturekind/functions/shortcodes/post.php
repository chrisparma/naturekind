<?php
    // Shortcode to get the current post title
    function get_current_post_title_shortcode() {
        if (is_singular()) {
            return get_the_title();
        }
        return '';
    }
    add_shortcode('current_post_title', 'get_current_post_title_shortcode');

    // Shortcode to get the current post content
    function get_current_post_content_shortcode() {
        if (is_singular()) {
            return apply_filters('the_content', get_the_content());
        }
        return '';
    }
    add_shortcode('current_post_content', 'get_current_post_content_shortcode');

    // function add_elementor_template_meta_box() {
    //     add_meta_box(
    //         'elementor_template_meta_box',
    //         'Select Elementor Template',
    //         'elementor_template_meta_box_callback',
    //         'page',
    //         'side'
    //     );
    // }
    // add_action('add_meta_boxes', 'add_elementor_template_meta_box');
    
    // function elementor_template_meta_box_callback($post) {
    //     $selected_template = get_post_meta($post->ID, '_elementor_template', true);
    //     $templates = get_posts(['post_type' => 'elementor_library', 'posts_per_page' => -1]);
    
    //     echo '<select name="elementor_template" id="elementor_template">';
    //     echo '<option value="">-- Select Template --</option>';
    //     foreach ($templates as $template) {
    //         $selected = ($selected_template == $template->ID) ? 'selected' : '';
    //         echo '<option value="' . $template->ID . '" ' . $selected . '>' . $template->post_title . '</option>';
    //     }
    //     echo '</select>';
    // }
    
    // function save_elementor_template_meta_box($post_id) {
    //     if (isset($_POST['elementor_template'])) {
    //         update_post_meta($post_id, '_elementor_template', $_POST['elementor_template']);
    //     }
    // }
    // add_action('save_post', 'save_elementor_template_meta_box');
    

    // function render_selected_elementor_template() {
    //     if (is_page()) {
    //         $template_id = get_post_meta(get_the_ID(), '_elementor_template', true);
    //         if ($template_id) {
    //             echo \Elementor\Plugin::$instance->frontend->get_builder_content($template_id);
    //             return;
    //         }
    //     }
    // }
    // add_action('wp_head', 'render_selected_elementor_template');