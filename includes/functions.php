<?php
// Helper functions for the plugin

function adorable_cf_it_india_get_option($option, $default = '') {
    $value = get_option($option, $default);
    return apply_filters("adorable_cf_it_india_option_{$option}", $value);
}

function adorable_cf_it_india_sanitize_text($input) {
    return sanitize_text_field($input);
}

function adorable_cf_it_india_sanitize_email($input) {
    return sanitize_email($input);
}


add_action('wp_ajax_adorable_cf_it_india_ajax_submit', 'adorable_cf_it_india_handle_ajax_submission');
add_action('wp_ajax_nopriv_adorable_cf_it_india_ajax_submit', 'adorable_cf_it_india_handle_ajax_submission');

function adorable_cf_it_india_handle_ajax_submission() {
    $message = adorable_cf_it_india_handle_form_submission(); // Reuse our existing function
    $response = array(
        'success' => strpos($message, 'adorable-cf-it-india-success') !== false,
        'message' => $message
    );
    wp_send_json($response);
}