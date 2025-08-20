<?php
function adorable_cf_it_india_register_scripts() {
    wp_enqueue_style('adorable-cf-it-india-style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_script('adorable-cf-it-india-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'adorable_cf_it_india_register_scripts');