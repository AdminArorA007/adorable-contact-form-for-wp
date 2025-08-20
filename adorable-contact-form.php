<?php
/*
Plugin Name: Adorable Contact Form by IT-INDIA.org
Description: An adorable contact form plugin for WordPress with smooth Ajax flow, Nonce verification, Honeypot field and superb UX n Ui. Short Code: [adorable_contact_form]
 * Version: 1.0
 * Author: Sameer Arora <admin@it-india.org>
 * Author URI: https://www.it-india.org
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Very Simple yet powerful and decent Contact Form
 * A very simple contact form plugin that allows users to send messages directly to the site administrator.
 * This plugin includes fields for name, email, subject, and message.
 * This plugin is designed to be lightweight and easy to use, making it suitable for users who need a basic contact form without complex features.
 * * This plugin does not store any data in the database, it simply sends an email to the site administrator.
 * * This plugin is ideal for small websites or personal blogs that require a straightforward contact form solution.
 * * This plugin is released under the GPL2 license, which means it is free to use, modify, and distribute.
 * * * This plugin is compatible with WordPress version 5.0 and above, and requires PHP version 7.0 or higher.
 * * * This plugin is designed to be easy to install and configure, with no additional settings required, just insert the short code: [adorable_contact_form]
 * * * This plugin is a great choice for users who want a simple and effective way to allow visitors to contact them.
 * * * This plugin is developed by Sameer Arora, a WordPress enthusiast and developer.
 * * * This plugin is a great way to enhance user engagement on your website by providing a simple and effective way for visitors to reach out.
 * 
 * 
 */

// Security check
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants FIRST
define('ADORABLE_CF_IT_INDIA_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('ADORABLE_CF_IT_INDIA_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load plugin files
require_once(ADORABLE_CF_IT_INDIA_PLUGIN_PATH . 'includes/scripts.php');
require_once(ADORABLE_CF_IT_INDIA_PLUGIN_PATH . 'includes/shortcode.php');
require_once(ADORABLE_CF_IT_INDIA_PLUGIN_PATH . 'includes/functions.php');

// Create admin menu
require_once(ADORABLE_CF_IT_INDIA_PLUGIN_PATH . 'admin/admin.php');