<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// if uninstall not called from WordPress exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

if (defined('WC_REMOVE_ALL_DATA') && WC_REMOVE_ALL_DATA === true) {
    //drop a custom swissbilling admin config options
    delete_option('woocommerce_swissbilling_settings');

    // drop a custom database table
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}swissbilling_order");
}
