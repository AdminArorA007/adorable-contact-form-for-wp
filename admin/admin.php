<?php
function adorable_cf_it_india_add_admin_page() {
    add_menu_page(
        'Adorable Contact Form',
        'Contact Form',
        'manage_options',
        'adorable_contact_form',
        'adorable_cf_it_india_admin_page_markup',
        'dashicons-email-alt',
        20
    );
}
add_action('admin_menu', 'adorable_cf_it_india_add_admin_page');

function adorable_cf_it_india_admin_page_markup() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e(get_admin_page_title()); ?></h1>
        <p>Welcome to the Adorable Contact Form plugin. Use the shortcode <code>[adorable_contact_form]</code> in any post or page.</p>
    </div>
    <?php
}