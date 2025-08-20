<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function adorable_cf_it_india_contact_form() {
    // Initialize message variable
    $message = '';
    
    // Handle form submission
    if (isset($_POST['adorable_cf_it_india_submit']) && isset($_POST['adorable_cf_it_india_nonce'])) {
        $message = adorable_cf_it_india_handle_form_submission();
    }
    
    ob_start(); ?>
    
    <!-- Main Form Container -->
    <div style="max-width:600px; margin:0 auto; padding:30px; background:#ffffff; border-radius:8px; box-shadow:0 2px 15px rgba(0,0,0,0.1);">
        
        <!-- Message Container -->
        <div id="adorable-cf-it-india-message-container">
            <?php if (!empty($message)) : ?>
                <div style="margin-bottom:25px; padding:15px; border-radius:4px; <?php echo strpos($message, 'adorable-cf-it-india-error') ? 'background:#fde8e8; color:#d32f2f; border-left:4px solid #f44336;' : 'background:#edf7ed; color:#1e4620; border-left:4px solid #4caf50;'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Contact Form -->
        <form id="adorable-cf-it-india-contact-form" method="post" style="margin-top:20px;">
            <?php wp_nonce_field('adorable_cf_it_india_contact_form_action', 'adorable_cf_it_india_nonce'); ?>
            <input type="hidden" name="action" value="adorable_cf_it_india_ajax_submit">
            <input type="hidden" name="adorable_cf_it_india_page_url" id="adorable_cf_it_india_page_url" value="">
            
            <!-- Name Field -->
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:600; color:#333;">Name*</label>
                <input type="text" name="adorable_cf_it_india_name" id="adorable_cf_it_india_name" 
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:4px; font-size:15px;"
                       placeholder="e.g. John Smith"
                       value="<?php echo isset($_POST['adorable_cf_it_india_name']) ? esc_attr($_POST['adorable_cf_it_india_name']) : ''; ?>" 
                       required>
            </div>
            
            <!-- Email Field -->
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:600; color:#333;">Email*</label>
                <input type="email" name="adorable_cf_it_india_email" id="adorable_cf_it_india_email" 
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:4px; font-size:15px;"
                       placeholder="e.g. john@example.com"
                       value="<?php echo isset($_POST['adorable_cf_it_india_email']) ? esc_attr($_POST['adorable_cf_it_india_email']) : ''; ?>" 
                       required>
            </div>
            
            <!-- Subject Field -->
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:600; color:#333;">Subject</label>
                <input type="text" name="adorable_cf_it_india_subject" id="adorable_cf_it_india_subject" 
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:4px; font-size:15px;"
                       placeholder="What's this about?"
                       value="<?php echo isset($_POST['adorable_cf_it_india_subject']) ? esc_attr($_POST['adorable_cf_it_india_subject']) : ''; ?>">
            </div>
            
            <!-- Message Field -->
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:600; color:#333;">Message*</label>
                <textarea name="adorable_cf_it_india_message" id="adorable_cf_it_india_message" 
                       style="width:100%; min-height:120px; padding:12px; border:1px solid #ddd; border-radius:4px; font-size:15px; resize:vertical; line-height:1.5;"
                       placeholder="Please type your message (minimum 30 characters)"
                       required><?php echo isset($_POST['adorable_cf_it_india_message']) ? esc_textarea($_POST['adorable_cf_it_india_message']) : ''; ?></textarea>
            </div>
            
            <!-- Honeypot Field -->
            <div style="display:none;">
                <label for="adorable_cf_it_india_phone">Phone</label>
                <input type="text" name="adorable_cf_it_india_phone" id="adorable_cf_it_india_phone">
            </div>
            
            <!-- Submit Button -->
            <div>
                <button type="submit" name="adorable_cf_it_india_submit" id="adorable_cf_it_india_submit_btn"
                        style="background:#2271b1; color:white; padding:14px 28px; border:none; border-radius:4px; font-size:16px; font-weight:600; cursor:pointer; transition:background 0.3s ease;"
                        onmouseover="this.style.background='#135e96'"
                        onmouseout="this.style.background='#2271b1'">
                    Send Message
                </button>
            </div>
        </form>
        
        <!-- AJAX Script -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('adorable-cf-it-india-contact-form');
            const messageContainer = document.getElementById('adorable-cf-it-india-message-container');
            const submitBtn = document.getElementById('adorable_cf_it_india_submit_btn');
            
            // Set submission page URL
            document.getElementById('adorable_cf_it_india_page_url').value = window.location.href;
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Disable button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Sending...';
                
                // Submit via AJAX
                fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                    method: 'POST',
                    body: new FormData(form)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Show response message
                    messageContainer.innerHTML = `
                        <div style="margin-bottom:25px; padding:15px; border-radius:4px; 
                            ${data.success ? 
                              'background:#edf7ed; color:#1e4620; border-left:4px solid #4caf50;' : 
                              'background:#fde8e8; color:#d32f2f; border-left:4px solid #f44336;'}">
                            ${data.message}
                        </div>
                    `;
                    
                    // Reset form if successful
                    if (data.success) {
                        form.reset();
                        submitBtn.innerHTML = '✓ Sent!';
                    } else {
                        submitBtn.innerHTML = 'Try Again';
                    }
                    
                    // Re-enable button after delay
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        if (data.success) {
                            submitBtn.innerHTML = 'Send Another Message';
                        }
                    }, 2000);
                })
                .catch(error => {
                    messageContainer.innerHTML = `
                        <div style="margin-bottom:25px; padding:15px; border-radius:4px; 
                            background:#fde8e8; color:#d32f2f; border-left:4px solid #f44336;">
                            Connection error. Please try again.
                        </div>
                    `;
                    submitBtn.innerHTML = 'Try Again';
                    submitBtn.disabled = false;
                    console.error('Error:', error);
                });
            });
        });
        </script>
    </div>
    <?php
    return ob_get_clean();
}

function adorable_cf_it_india_handle_form_submission() {
    // Verify nonce first
    if (!wp_verify_nonce($_POST['adorable_cf_it_india_nonce'], 'adorable_cf_it_india_contact_form_action')) {
        return '<div class="adorable-cf-it-india-error">Security verification failed. Please try again.</div>';
    }
    
    // Honeypot check
    if (!empty($_POST['adorable_cf_it_india_phone'])) {
        return ''; // Silent fail for bots
    }
    
    // Basic validation
    if (empty($_POST['adorable_cf_it_india_name']) || empty($_POST['adorable_cf_it_india_email']) || empty($_POST['adorable_cf_it_india_message'])) {
        return '<div class="adorable-cf-it-india-error">Please fill in all required fields.</div>';
    }
    
    if (!is_email($_POST['adorable_cf_it_india_email'])) {
        return '<div class="adorable-cf-it-india-error">Please enter a valid email address.</div>';
    }
    
    // Get submission page URL
    $submission_url = !empty($_POST['adorable_cf_it_india_page_url']) ? esc_url($_POST['adorable_cf_it_india_page_url']) : home_url();
    
    // Prepare email content
    $admin_email = get_option('admin_email');
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . sanitize_text_field($_POST['adorable_cf_it_india_name']) . ' <' . sanitize_email($_POST['adorable_cf_it_india_email']) . '>'
    ];
    
    // Admin Email
    $admin_subject = 'Contact form: ' . (!empty($_POST['adorable_cf_it_india_subject']) ? 
                     sanitize_text_field(stripslashes($_POST['adorable_cf_it_india_subject'])) : 'No Subject');
    
    $admin_message = sprintf(
        '<html>
        <body style="font-family:Arial,sans-serif;line-height:1.6;color:#333;">
            <h2 style="color:#2271b1;">New Contact Form Submission</h2>
            <p><strong>Submitted from:</strong> <a href="%s">%s</a></p>
            <table style="width:100%%;border-collapse:collapse;margin:15px 0;">
                <tr><td style="padding:10px;border:1px solid #ddd;width:150px;font-weight:bold;background:#f9f9f9;">Name:</td>
                    <td style="padding:10px;border:1px solid #ddd;">%s</td></tr>
                <tr><td style="padding:10px;border:1px solid #ddd;font-weight:bold;background:#f9f9f9;">Email:</td>
                    <td style="padding:10px;border:1px solid #ddd;">%s</td></tr>
                %s
                <tr><td style="padding:10px;border:1px solid #ddd;font-weight:bold;background:#f9f9f9;vertical-align:top;">Message:</td>
                    <td style="padding:10px;border:1px solid #ddd;white-space:pre-wrap;">%s</td></tr>
            </table>
            <p style="font-size:0.9em;color:#777;margin-top:20px;border-top:1px solid #eee;padding-top:10px;">
                Adorable Contact Form by IT-INDIA.org
            </p>
        </body>
        </html>',
        $submission_url,
        $submission_url,
        sanitize_text_field($_POST['adorable_cf_it_india_name']),
        sanitize_email($_POST['adorable_cf_it_india_email']),
        (!empty($_POST['adorable_cf_it_india_subject']) ? 
            '<tr><td style="padding:10px;border:1px solid #ddd;font-weight:bold;background:#f9f9f9;">Subject:</td>
             <td style="padding:10px;border:1px solid #ddd;">' . sanitize_text_field(stripslashes($_POST['adorable_cf_it_india_subject'])) . '</td></tr>' : ''),
        stripslashes(wp_kses_post($_POST['adorable_cf_it_india_message'])),
        $submission_url
    );
    
    // User Confirmation Email
    $user_headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . get_bloginfo('name') . ' <' . $admin_email . '>'
    ];
    
    $user_message = sprintf(
        '<html>
        <body style="font-family:Arial,sans-serif;line-height:1.6;color:#333;">
            <h2 style="color:#2271b1;">Thank you for contacting us!</h2>
            <p>We\'ve received your message submitted from: <a href="%s">%s</a></p>
            <div style="background:#f9f9f9;border-left:3px solid #2271b1;padding:15px;margin:20px 0;">
                <h3 style="margin-top:0;color:#2271b1;">Your Message:</h3>
                <div style="white-space:pre-wrap;">%s</div>
            </div>
            <p>We\'ll respond to you at: <strong>%s</strong></p>
            <p style="font-size:0.9em;color:#777;margin-top:20px;border-top:1px solid #eee;padding-top:10px;">
                Sent from: <a href="%s">%s</a>
            </p>
        </body>
        </html>',
        $submission_url,
        $submission_url,
        stripslashes(wp_kses_post($_POST['adorable_cf_it_india_message'])),
        sanitize_email($_POST['adorable_cf_it_india_email']),
        home_url(),
        get_bloginfo('name')
    );
    
    // Send emails
    $admin_sent = wp_mail($admin_email, $admin_subject, $admin_message, $headers);
    $user_sent = wp_mail(sanitize_email($_POST['adorable_cf_it_india_email']), 'We received your message', $user_message, $user_headers);
    
    if ($admin_sent && $user_sent) {
        return '<div class="adorable-cf-it-india-success">Thank you! Your message has been sent.</div>';
    }
    
    return '<div class="adorable-cf-it-india-error">There was an error sending your message. Please try again later.</div>';
}

// AJAX Handlers
add_action('wp_ajax_adorable_cf_it_india_ajax_submit', 'adorable_cf_it_india_ajax_handler');
add_action('wp_ajax_nopriv_adorable_cf_it_india_ajax_submit', 'adorable_cf_it_india_ajax_handler');

function adorable_cf_it_india_ajax_handler() {
    $message = adorable_cf_it_india_handle_form_submission();
    wp_send_json([
        'success' => strpos($message, 'adorable-cf-it-india-success') !== false,
        'message' => $message
    ]);
}

// SHORTCODE REGISTRATION
add_shortcode('adorable_contact_form', 'adorable_cf_it_india_contact_form');