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
    public static function addProductDataTab(array $tabs): array
    {

            $tabs['fbt'] = array(
                'label' => esc_html__('Frequently Bought Together', 'frequently-bought-together'),
                'target' => 'fbt_product_data',
                'class' => array('show_if_simple', 'show_if_variable'),
                'priority' => 60,
            );

        return $tabs;
    }

    /**
     * This is a function to display the all products to select frequent products
     */
    public static function addProductDataFields() {

        if(file_exists(plugin_dir_path(__FILE__). '../../View/Main.php')) {
            include(plugin_dir_path(__FILE__) . '../../View/Main.php');
        }else{
            echo esc_html__("The file doesn't exist", "frequently-bought-together");
        }

    }


    /**
     * This is function to save the selected frequent products
     * @param int $post_id
     */
    public static function saveProductDataFields(int $post_id) {
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
            echo esc_html__("The file doesn't exist", "frequently-bought-together");
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
            echo esc_html__("Product added to cart successfully!.","frequently-bought-together");
             }

    }

    /**
     * Create an option settings for change button names and extra facilities
     */
    public   function addSettingPage() {
    add_options_page(
        'frequently-bought-together',
        'fbt-settings',
        'manage_options',
        'frequently-bought-together',
        [$this,'myFbtSettingsPage'],
        20
    );

  }

    /**
     * The function hold the HTML elements of our setting page
     */
  public function myFbtSettingsPage() {

       if(file_exists(plugin_dir_path(__FILE__) . '../../View/fbt-setting-page.php')) {
           include(plugin_dir_path(__FILE__) . '../../View/fbt-setting-page.php');
       }
  }

    /**
     * The function register our all setting
     */
    public function registerSettings() {
        register_setting('fbt_settings_group', 'fbt_passage_text');
        register_setting('fbt_settings_group', 'fbt_button_text');
        register_setting('fbt_settings_group', 'fbt_title_text');

            add_settings_section(
                'fbt-settings-section',
                esc_html__('Frequently-bought-together plugin setting Settings','frequently-bought-together'),
                null,
                'frequently-bought-together'
            );

            add_settings_field(
                'fbt_title_text_field',
                esc_html__('Title Text','frequently-bought-together'),
                [$this, 'titleTextField'],
                'frequently-bought-together',
                'fbt-settings-section'
            );

            add_settings_field(
                'fbt_button_text_field',
                esc_html__('Button Text','frequently-bought-together'),
                [$this, 'buttonTextFieldRender'],
                'frequently-bought-together',
                'fbt-settings-section'
            );

            add_settings_field(
                'fbt_passage_text_field',
                esc_html__('Passage Text','frequently-bought-together'),
                [$this, 'passageTextFieldRender'],
                'frequently-bought-together',
                'fbt-settings-section'
            );
    }

    /**
     * This function is used for the first value of our settings that is a title of our plugin page
     */
    public function titleTextField() {
        $value = get_option('fbt_title_text');
        echo '<input type="text" id="fbt_title_text_field" style="width:50%;" name="fbt_title_text" value="' . esc_attr($value) . '" required autocomplete="off"/>';
    }

    /**
     * This function hold the button value
     */
    public function buttonTextFieldRender() {
        $value = get_option('fbt_button_text');
        echo '<input type="text" id="fbt_button_text_field" style="width:50%;" name="fbt_button_text" value="' . esc_attr($value) . '" required autocomplete="off"/>';
    }

    /**
     * This function hold the description box.
     */
    public function passageTextFieldRender() {
        $value = get_option('fbt_passage_text');
        echo '<textarea style="width: 50%; height: 70px" name="fbt_passage_text" autocomplete="off" id="fbt_passage_text_field">' . $value . '</textarea>';
    }

}

