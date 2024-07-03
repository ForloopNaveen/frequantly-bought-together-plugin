<?php

namespace Fbt\App\Controller\Admin;

defined("ABSPATH") or die();

class Main {
    /**
     * This is a function to add a product tap in add product's product details section
     *
     * @param array $tabs
     * $return array
     */
    public static function addProductDataTab($tabs) {
        if (is_array($tabs)) {
            $tabs['fbt'] = array(
                'label' => esc_html__('Frequently Bought Together', 'frequently-bought-together'),
                'target' => 'fbt_product_data',
                'class' => array('show_if_simple', 'show_if_variable'),
                'priority' => 60,
            );
        }
        return $tabs;
    }

    /**
     * This is a function to display the all products to select frequent products
     */
    public static function addProductDataFields() {

        if(file_exists(plugin_dir_path(__FILE__). '../../View/Main.php')) {
            include(plugin_dir_path(__FILE__) . '../../View/Main.php');
        }else{
            echo "The file doesn't exist";
        }

    }


    /**
     * This is function to save the selected frequent products
     * @param int $post_id
     */
    public static function saveProductDataFields($post_id) {
        // Save the custom field value
        if (isset($_POST['fbt_products'])) {
            update_post_meta($post_id, '_fbt_products', $_POST['fbt_products']);
        } else {
            delete_post_meta($post_id, '_fbt_products');
        }
    }


    /**
     * This is a function to handle scripts
     */
    public static function enqueueScripts() {
        if (is_product()) {
            wp_enqueue_style('my-contact-plugin-styles', plugin_dir_url(__FILE__) . '../../../Assets/css/style.css');
            wp_enqueue_script('fbt-script', plugin_dir_url(__FILE__) . '../../../Assets/js/fbt-script.js', array('jquery'), null, true);
            wp_localize_script('fbt-script', 'fbt_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
        }
    }


    /**
     * This is a function to display the frequent products in the frontend
     */
    public static function displayFrequentlyBoughtTogether() {
        if(file_exists(plugin_dir_path( __FILE__ ) . '../../View/fbt-products.php')) {
            include(plugin_dir_path(__FILE__) . '../../View/fbt-products.php');
        }else{
            echo "The file doesn't exist";
        }
    }

    /**
     * This is a function that handle the add to cart functionality.
     */
    public static function addToCart() {
        if (isset($_POST['product_ids'])) {
            foreach ($_POST['product_ids'] as $product_id) {
                     WC()->cart->add_to_cart($product_id);
            }
            echo "Product added to cart successfully!.";
             }
        wp_die();
    }

}

