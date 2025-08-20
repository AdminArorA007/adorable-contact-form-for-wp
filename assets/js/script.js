jQuery(document).ready(function($) {
    $('#adorable-cf-it-india-contact-form').on('submit', function(e) {
        // Basic client-side validation
        let isValid = true;
        
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('adorable-cf-it-india-error-field');
            } else {
                $(this).removeClass('adorable-cf-it-india-error-field');
            }
        });
        
        // Email validation
        const emailField = $(this).find('input[type="email"]');
        if (emailField.val() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.val())) {
            isValid = false;
            emailField.addClass('adorable-cf-it-india-error-field');
        }
        
        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            $('html, body').animate({
                scrollTop: $(this).find('.adorable-cf-it-india-error-field').first().offset().top - 100
            }, 500);
        }
    });
});