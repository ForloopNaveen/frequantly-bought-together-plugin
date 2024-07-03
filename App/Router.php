<?php
namespace Fbt\App;

use Fbt\App\Controller\Admin\Main;

defined("ABSPATH") OR die();

class Router {
    /**
     * This function contains all hooks to perform our plugin to frequently bought together products
     */
    function init() {


        add_filter('woocommerce_product_data_tabs', [Main::class,'addProductDataTab']);
        add_action('woocommerce_product_data_panels', [Main::class,'addProductDataFields']);
        add_action('woocommerce_process_product_meta', [Main::class,'saveProductDataFields']);
        add_action('woocommerce_after_single_product', [Main::class,'displayFrequentlyBoughtTogether']);
        add_action('wp_ajax_fbt_add_to_cart', [Main::class, 'addToCart']);


        // Add AJAX action hooks
        add_action('wp_enqueue_scripts', [Main::class,'enqueueScripts']);

    }
}

