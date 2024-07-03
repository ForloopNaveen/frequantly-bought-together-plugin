    <?php
    /*
     * Plugin Name: Frequently Bought Together
     * Description: This is a plugin to set a frequent products to the product.
     * Licence: GPL2 or latest
     * Author: Naveen
     * Text Domain: frequently-bought-together
     * Slug: frequently-bought-together
     * Domain Path: /i18n/languages
     */

    defined("ABSPATH") or die();

    if(file_exists(__DIR__ . "/vendor/autoload.php")) {
        require_once __DIR__ . "/vendor/autoload.php";
    }

    if(class_exists("\Fbt\App\Router")) {
        $router = new \Fbt\App\Router();
        $router->init();
    }


//    add_filter('fbt_change_button_name', function($value) {
//        return 'tesdgagt';
//    });


